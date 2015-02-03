<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inquiries_model extends CI_Model {
	
	/*
	* Properties
	*/
	private $_table_users;	
	private $_table_donate;	
	private $_table_applied_donation;
	private $_table_sms;
//----------------------------------------------------------------------
    
	/*
	* Constructor
	*/
	
	function __construct()
    {
        parent::__construct();
		
		//Load Table Names from Config
		$this->_table_users 			=  $this->config->item('table_users');
		$this->_table_donate 			=  $this->config->item('table_donate');
        $this->_table_user_profile 			=  $this->config->item('table_user_profile');
		$this->_table_applied_donation 	=  $this->config->item('table_applied_donation');
		$this->_table_sms =  $this->config->item('sms_management');
    }
	
//----------------------------------------------------------------------
	/*
	* Insert User Record
	* @param array $data
	* return True
	*/
	function insert_user_detail($data)
	{
		$this->db->insert($this->_table_users,$data);
		
		return TRUE;
	}
	
	function deleteTempDelete()
	{
		//Login Query
		$userid = $this->session->userdata('userid');
		$this->db->where('userid',$userid);
		$query = $this->db->get('applicant_temp_document');		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $temp_data)
			{
				$path = APPPATH.'../upload_files/'.$userid.'/'.$temp_data->documentname;
				if(file_exists($path))
				{
					unlink($path); //Delete temporary uploaded files
				}
				$this->db->where("documentid",$temp_data->documentid);
				$this->db->delete('applicant_temp_document');
			}
		}
	}
//----------------------------------------------------------------------

	/**
	* Insert Form 2
	*
	*/
	function submit_form_two($data)
	{
		if($data['applicant_id']!='')
		{
			$this->db->where('applicant_id',$data['applicant_id']);
			$this->db->update('applicant_project', $data);
			$id = $data['applicant_id'];
		}
		else
		{
			$this->db->insert('applicant_project',$data);
			$id = $this->db->insert_id();
		}
		
		$numbers = get_applicant_number($data['applicant_id']);		
		send_sms_steps(2,$numbers);
		stepsLogs(array('aid'=>$data['applicant_id'],'sid'=>2));
		return $id;
	}
//----------------------------------------------------------------------

	/**
	* Insert Form 3
	*
	*/
	function submit_form_three($data)
	{
		if($data['applicant_id']!='' && $data['iscomplete']!='0')
		{
			unset($data['iscomplete']);
			$this->db->where('applicant_id',$data['applicant_id']);
			$this->db->update('applicant_loans', $data);
			$id = $data['applicant_id'];	
		}
		else
		{
			unset($data['iscomplete']);
			$this->db->insert('applicant_loans',$data);
			$id = $this->db->insert_id();
		}
		
			$numbers = get_applicant_number($data['applicant_id']);		
			send_sms_steps(3,$numbers);
			stepsLogs(array('aid'=>$data['applicant_id'],'sid'=>3));
			return $id;
	}
	//----------------------------------------------------------------------

	/**
	* Insert Form 3
	*
	*/
	function submit_form_four($data)
	{
		$this->db->insert('study_analysis_demand',$data);
		
		return $this->db->insert_id();
	}
	
	function save_temp_document($tempfilename)
	{
		// Save Data .....
	}

//----------------------------------------------------------------------
	/*
	* Insert User Record
	* @param array $data
	* return True
	*/
	function insert_donation_product($data)
	{
		$this->db->insert($this->_table_donate,$data);
		
		return TRUE;
	}
//----------------------------------------------------------------------
    /*
    * insert user_profile method
    */
    function insert_user_profile($data)
    {
        $this->db->insert($this->_table_user_profile,$data);

        return TRUE;
    }
//----------------------------------------------------------------------
	/*
	* User login
	* @param string $user_email
	* @param string $password
	* return Login User Data
	*/
	function login_user($user_email,$password)
	{
		//Login Query
		$this->db->where('email',$user_email);
		$this->db->where('password',md5($password));
		$query = $this->db->get($this->_table_users);
		
		//Check if Result is Greater Than Zero
		
		if($query->num_rows() > 0)
		{
			$this->session->set_userdata('user_id',$query->row()->user_id);
			return $query->row();
		}
	}
//----------------------------------------------------------------------
	/*
	* User login
	* @param string $user_email
	* @param string $password
	* return Login User Data
	*/
	function get_single_user($userid)
	{
		//Login Query
		$this->db->where('id',$userid);
		$query = $this->db->get('admin_users');
		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
//------------------------------------------------------------------------

    /**
     * 
     * Insert User Data for Registration
     * @param array $data
     * return integer
     */
	function update_user($userid,$data)
	{
		$update['firstname'] = $data['firstname'];
		$update['lastname'] = $data['lastname'];
		if($data['confirm_password']!='')
		{	$update['password'] = md5($data['confirm_password']);	}
		$update['email'] = $data['email'];
		$update['mobile_number'] = $data['number'];
		$update['number'] = $data['number'];
		$update['about_user'] = $data['about_user'];
		$update['branch_id'] = $data['branch_id'];
		$update['user_role_id'] = $data['user_role_id'];
		$update['user_parent_role'] = $data['user_role_id'];
		$this->db->where('id',$userid);
		$this->db->update('admin_users', $update);		
		return TRUE;
	}
		
	public function getLastDetail($tempid='',$format='array')
	{
		$this->session->unset_userdata('inq_id');		
		$this->db->select('*');
		$this->db->from('main');		
		$this->db->where('tempid',$tempid);
		$this->db->order_by("applicantdate", "DESC"); 
		$this->db->limit(1);
		$tempMain = $this->db->get();
		if($tempMain->num_rows() > 0)
		{
			foreach($tempMain->result() as $data)
			{				
				$arr['main'] = $data;
				$tempid = $data->tempid;							
				$tempMain->free_result(); //Clean Result Set
				//Getting Applicant Data
				$this->db->select('*');
				$this->db->from('main_applicant');		
				$this->db->where('tempid',$tempid);
				$this->db->order_by("applicantid", "ASC");
				$tempApplicant = $this->db->get();
				if($tempApplicant->num_rows() > 0)
				{
					foreach($tempApplicant->result() as $app)
					{
						$arr['main']->applicant[] = $app;
						//Getting Phone Data
						$this->db->select('*');
						$this->db->from('main_phone');		
						$this->db->where('tempid',$tempid);
						$this->db->where('applicantid',$app->applicantid);
						$this->db->order_by("phoneid", "ASC");
						$tempPhone = $this->db->get();
						if($tempPhone->num_rows() > 0)
						{
							foreach($tempPhone->result() as $phones)
							{
								$arr['main']->phones[$app->applicantid][] = $phones;						
							}
							$tempPhone->free_result(); //Clean Result Set
						}					
					}
					$tempApplicant->free_result(); //Clean Result Set
				}				
				//Getting Inquiry Type Data
				$this->db->select('*');
				$this->db->from('main_inquirytype');		
				$this->db->where('tempid',$data->tempid);
				$this->db->order_by("inqid", "ASC");
				$tempIType = $this->db->get();
				if($tempIType->num_rows() > 0)
				{
					foreach($tempIType->result() as $itype)
					{
						$arr['main']->inquery[] = $itype;
					}
					$tempIType->free_result(); //Clean Result Set
				}				
				//Getting Notes Data
				$this->db->select('*');
				$this->db->from('main_notes');		
				$this->db->where('tempid',$data->tempid);
				$this->db->order_by("notesid", "ASC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					foreach($tempNotes->result() as $notes)
					{
						$arr['main']->notes[] = $notes;
						//$arr['notes'][] = $notes;
					}
					$tempNotes->free_result(); //Clean Result Set
				}				
								
			}
		}
		if($format=='json')
		{
			echo json_encode($arr);
		}
		else
		{
		return $arr;
		}
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_data_for_store($limit,$start){
		//Login Query
		$this->db->where('permission','1');
		$this->db->limit($limit,$start);	
		$query = $this->db->get($this->_table_donate);
		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	function getsave_document(){
		//Login Query
		$userid = $this->session->userdata('userid');
		$query = $this->db->query("SELECT * FROM applicant_temp_document WHERE userid='".$userid."'");		
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $ddx)
			{
				$ar[] = $ddx;
			}
			return $ar;
		}
	}	

//----------------------------------------------------------------------
	/*
	* Get All Records From Giving Table
	*/
	public function get_rows($table_name)
	{
		$count_all = $this->db->get($table_name);
		if($count_all->num_rows() > 0)
		{
			return $count_all->num_rows();
		}
	}
//----------------------------------------------------------------------
	/*
	* Insert Applied Product Record into Database
	* Return True 
	*/
	public function applied_donation($data)
	{
		$this->db->insert($this->_table_applied_donation,$data);
		return TRUE;
	}
//----------------------------------------------------------------------
	/*
	* Insert Applied Product Record into Database
	* Return True 
	*/
	public function add_user_registration($data)
	{
		$this->db->insert('admin_users',$data);
		return TRUE;
	}

//----------------------------------------------------------------------
	/*
	* Get Applied Product Record into Database
	* Return True 
	*/
	public function get_applied_detail($user_id,$donate_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('donation_id',$donate_id);

		$query = $this->db->get($this->_table_applied_donation);
		
		if ($query->num_rows() > 0)
		{
			return $query->row()->donation_id;
		}
	}
//----------------------------------------------------------------------
	/*
	* Search Applied Products if 
	* Return True 
	*/
	public function donation_id_exists()
	{
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->select('donation_id');
		$query = $this->db->get($this->_table_applied_donation);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	public function update_db($table,$data,$condition){
		return $this->db->update($table,$data,$condition);
	}

	public function updateStep($applicant_id,$step)
	{
		$data = array('form_step' => $step);
		$this->db->where('applicant_id', $applicant_id);
		$this->db->update('applicants', $data); 
	}
	
	public function udpate_request_change_phase_five_valus($step)
	{

		//$data = array('form_step' => $step);
		$applicant_id = $step['applicant_id'];
		unset($step['tempid']);
		$this->db->where('applicant_id',$applicant_id);
		$this->db->update('comitte_decision', $step); 
		return true;
	}
/*
	* Search Applied Products if 
	* Return True 
	*/
	public function getInquiriesSms($type)
	{
		$this->db->where('sms_module','inquiry');
		$this->db->where('type',$type);
		$this->db->select('*');
		$query = $this->db->get($this->_table_sms);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	public function getSms($id,$type)
	{
		$this->db->where('sms_module_id',$id);
		$this->db->where('type',$type);
		if($id  == 1){
			$this->db->join('register_auditors',"auditor_id=sms_receiver_id");
		}
		$this->db->order_by("sms_id", "DESC"); 
		$this->db->select('*');
		$query = $this->db->get('sms_history');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	/*
	* get info of applicant comitte_decision
	* @param int $applicant_id
	* Created by M.Ahmed
	*/
	function getInquiresOfRequestChangePhaseFive($applicant_id)
	{
		// select info
		$this->db->where('applicant_id',$applicant_id);
		$query = $this->db->get('comitte_decision');
		
		//Check if Result is Greater Than Zero
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
//----------------------------------------------------------------------
	
	
	public function new_inquery()
	{	
		$inqid = $this->session->userdata('inq_id');
		if($inqid=='')
		{
			$userid = $this->session->userdata('userid');
			$this->db->select('userid');
			$this->db->from('temp_main');		
			$this->db->where('userid',$userid);
			$checkOut = $this->db->get(); 
			if($checkOut->num_rows() <= 0)
			{
				$this->db->trans_start();
				$this->db->insert('temp_main',array('userid'=>$userid));			
					$tempid = $this->db->insert_id();
					$this->session->set_userdata('inq_id',$tempid);	
					$this->db->insert('temp_main_applicant',array('tempid'=>$tempid,'applicanttype'=>'ذكر'));
						$applicantid = $this->db->insert_id();
						$this->db->insert('temp_main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));
					$this->db->insert('temp_main_inquirytype',array('tempid'=>$tempid));
					$this->db->insert('temp_main_notes',array('tempid'=>$tempid));					
					$this->db->trans_complete();
			}
		}
		return $this->getLastInquery();
	}
	
	function delete_rule($listid)
	{
		$this->db->where("list_id",$listid);
		$this->db->delete('list_management');
		
		return true; 
	}
	
	public function add_data_into_main($tempid	=	'5')
	{
		$userid = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('temp_main');		
		$this->db->where('tempid',$tempid);
		$checkOut = $this->db->get(); 
		$checkOut->num_rows();
		
		$temp_main_data	=	(array)$checkOut->row();
		$this->db->insert('main',$temp_main_data);			
		$tempid = $this->db->insert_id();
		
		
		$applicantQuery = $this->db->query("SELECT * FROM temp_main_applicant WHERE tempid='".$tempid."'");
		foreach($applicantQuery->result() as $applicant)
		{
			$temp_main_applicant = array('tempid'=>$applicant->tempid,
			'first_name'=>$applicant->first_name,
			'middle_name'=>$applicant->middle_name,
			'last_name'=>$applicant->last_name,
			'family_name'=>$applicant->family_name,
			'applicanttype'=>$applicant->applicanttype,
			'idcard'=>$applicant->idcard);
			$this->db->insert('main_applicant',$temp_main_applicant);
			$applicantid = $this->db->insert_id();
						$phoneQuery = $this->db->query("SELECT * FROM temp_main_phone WHERE tempid='".$tempid."' AND applicantid='".$applicant->applicantid."'");
						foreach($phoneQuery->result() as $phoneres)
						{
							$temp_main_phone = array('tempid'=>$tempid,'applicantid'=>$applicantid,'phonenumber'=>$phoneres->phonenumber);
							$this->db->insert('main_phone',$temp_main_phone);
						}
						/*$this->db->select('*');
						$this->db->from('temp_main_phone');		
						$this->db->where('tempid',$tempid);
						$temp_main_phone = $this->db->get();
						$temp_main_phone	=	(array)$temp_main_phone->row();
						$temp_main_phone['applicantid']	=	$id;*/
						
						
		}
		
/*		$this->db->select('*');
		$this->db->from('temp_main_applicant');		
		$this->db->where('tempid',$tempid);
		$temp_main_applicant = $this->db->get();
		$temp_main_applicant	=	(array)$temp_main_applicant->row();

		$this->db->insert('main_applicant',$temp_main_applicant);			
		$id = $this->db->insert_id();*/
		
		$this->db->select('*');
		$this->db->from('temp_main_inquirytype');		
		$this->db->where('tempid',$tempid);
		$temp_main_inquirytype = $this->db->get();
		$temp_main_inquirytype	=	(array)$temp_main_inquirytype->row();
		
		$this->db->insert('main_inquirytype',$temp_main_inquirytype);			
		
		//$tempid = $this->db->insert_id();
		$this->db->delete('temp_main_notes', array('tempid' =>$tempid,'userid'=>'0'));
		///
		$this->db->select('*');
		$this->db->from('temp_main_notes');		
		$this->db->where('tempid',$tempid);
		$temp_main_notes = $this->db->get();
		$temp_main_notes	=	(array)$temp_main_notes->row();
		
		$this->db->insert('main_notes',$temp_main_notes);			
		//$tempid = $this->db->insert_id();
		
		
		$this->session->unset_userdata('inq_id');
		$this->db->delete('temp_main', array('userid' => $userid));
			$mobileNumbers = get_mobilenumbers($tempid);
			
			$this->db->where('tempid',$tempid);
			$this->db->update('main',array('tempid_value'=>applicant_number($tempid)));
		
			send_sms(1,$mobileNumbers,$userid,'00000'.$tempid);
	}
	
	public function reset_inquery()
	{
		$this->session->unset_userdata('inq_id');
		$userid = $this->session->userdata('userid');
		$this->db->trans_start();
				$this->db->delete('temp_main', array('userid' => $userid)); 		
		
				$this->db->insert('temp_main',array('userid'=>$userid));			
					$tempid = $this->db->insert_id();
					$this->session->set_userdata('inq_id',$tempid);	
					$this->db->insert('temp_main_applicant',array('tempid'=>$tempid,'applicanttype'=>'ذكر'));
						$applicantid = $this->db->insert_id();
						$this->db->insert('temp_main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));
					$this->db->insert('temp_main_inquirytype',array('tempid'=>$tempid));
					$this->db->insert('temp_main_notes',array('tempid'=>$tempid));
					
					
										
					$this->db->trans_complete();
		redirect(base_url().'inquiries/newinquery');			
	}
	
	
	function getInquiries(){
		$this->db->select('*');
		$this->db->from('register_auditors');
		//$this->db->join('register_auditors',"auditor_id=sms_receiver_id");
		$this->db->order_by("auditor_id", "DESC");
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} 
	}
	function getmaindata()
		{
		$this->db->select('*');
		$this->db->from('main');
		$this->db->order_by("tempid", "DESC");
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} 
	}
	
	public function getLastInquery($tempid='')
	{
		$userid = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('temp_main');		
		$this->db->where('userid',$userid);
		$this->db->order_by("applicantdate", "DESC"); 
		$this->db->limit(1);
		$tempMain = $this->db->get();
		if($tempMain->num_rows() > 0)
		{
			foreach($tempMain->result() as $data)
			{				
				$arr['main'] = $data;
				$tempid = $data->tempid;							
				$tempMain->free_result(); //Clean Result Set
				//Getting Applicant Data
				$this->db->select('*');
				$this->db->from('temp_main_applicant');		
				$this->db->where('tempid',$tempid);
				$this->db->order_by("applicantid", "ASC");
				$tempApplicant = $this->db->get();
				if($tempApplicant->num_rows() > 0)
				{
					foreach($tempApplicant->result() as $app)
					{
						$arr['main']->applicant[] = $app;
						//Getting Phone Data
						$this->db->select('*');
						$this->db->from('temp_main_phone');		
						$this->db->where('tempid',$tempid);
						$this->db->where('applicantid',$app->applicantid);
						$this->db->order_by("phoneid", "ASC");
						$tempPhone = $this->db->get();
						if($tempPhone->num_rows() > 0)
						{
							foreach($tempPhone->result() as $phones)
							{
								$arr['main']->phones[$app->applicantid][] = $phones;						
							}
							$tempPhone->free_result(); //Clean Result Set
						}					
					}
					$tempApplicant->free_result(); //Clean Result Set
				}				
				//Getting Inquiry Type Data
				$this->db->select('*');
				$this->db->from('temp_main_inquirytype');		
				$this->db->where('tempid',$data->tempid);
				$this->db->order_by("inqid", "ASC");
				$tempIType = $this->db->get();
				if($tempIType->num_rows() > 0)
				{
					foreach($tempIType->result() as $itype)
					{
						$arr['main']->inquery[] = $itype;
					}
					$tempIType->free_result(); //Clean Result Set
				}				
				//Getting Notes Data
				$this->db->select('*');
				$this->db->from('temp_main_notes');		
				$this->db->where('tempid',$data->tempid);
				$this->db->order_by("notesid", "ASC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					foreach($tempNotes->result() as $notes)
					{
						$arr['main']->notes[] = $notes;
						//$arr['notes'][] = $notes;
					}
					$tempNotes->free_result(); //Clean Result Set
				}				
								
			}
		}
		return $arr;
	}
	
	
	public function getRequestInfo($applicant_id='')
	{
		$this->db->select('*');
		$this->db->from('applicants');			
		$this->db->where('applicant_id',$applicant_id);
		$tempMain = $this->db->get();
		if($tempMain->num_rows() > 0)
		{
			foreach($tempMain->result() as $data)
			{
				$arr['applicants'] = $data;
				//Getting Applicant Qualification
				$this->db->where("applicant_id",$applicant_id);
				$applicant_qualification = $this->db->get('applicant_qualification');
				if($applicant_qualification->num_rows() > 0)
				{
					$arr['applicant_qualification'] = $applicant_qualification->result();
				}
				//Getting Applicant Project
				$this->db->where("applicant_id",$applicant_id);
				$applicant_project = $this->db->get('applicant_project');
				if($applicant_project->num_rows() > 0)
				{
					$arr['applicant_project'] = $applicant_project->result();
				}
				//Getting Applicant Professional Experience
				$this->db->where("applicant_id",$applicant_id);
				$applicant_professional_experience = $this->db->get('applicant_professional_experience');
				if($applicant_professional_experience->num_rows() > 0)
				{
					$arr['applicant_professional_experience'] = $applicant_professional_experience->result();
				}
				//Getting Applicant Phone
				$this->db->where("applicant_id",$applicant_id);
				$applicant_phones = $this->db->get('applicant_phones');
				if($applicant_phones->num_rows() > 0)
				{
					$arr['applicant_phones'] = $applicant_phones->result();
				}
				//Getting Applicant Partners
				$this->db->where("applicant_id",$applicant_id);
				$applicant_partners = $this->db->get('applicant_partners');
				if($applicant_partners->num_rows() > 0)
				{
					$arr['applicant_partners'] = $applicant_partners->result();
				}
				//Getting Applicant Numbers
				$this->db->where("applicant_id",$applicant_id);
				$applicant_numbers = $this->db->get('applicant_numbers');
				if($applicant_numbers->num_rows() > 0)
				{
					$arr['applicant_numbers'] = $applicant_numbers->result();
				}
				//Getting Applicant Loan
				$this->db->where("applicant_id",$applicant_id);
				$applicant_loans = $this->db->get('applicant_loans');
				if($applicant_loans->num_rows() > 0)
				{
					$arr['applicant_loans'] = $applicant_loans->result();
				}
				
				//Getting Applicant Documents
				$this->db->where("applicant_id",$applicant_id);
				$applicant_document = $this->db->get('applicant_document');
				if($applicant_document->num_rows() > 0)
				{
					$arr['applicant_document'] = $applicant_document->result();
				}
				//Getting Project Documents
				$this->db->where("applicant_id",$applicant_id);
				$applicant_project = $this->db->get('applicant_project');
				if($applicant_project->num_rows() > 0)
				{
					$arr['applicant_project'] = $applicant_project->result();
				}
				//Getting Applicant Business Record
				$this->db->where("applicant_id",$applicant_id);
				$applicant_businessrecord = $this->db->get('applicant_businessrecord');
				if($applicant_businessrecord->num_rows() > 0)
				{
					$arr['applicant_businessrecord'] = $applicant_businessrecord->result();
				}
				//Getting Project Evolution
				$this->db->where("applicant_id",$applicant_id);
				$project_evolution = $this->db->get('project_evolution');
				if($project_evolution->num_rows() > 0)
				{
					$arr['project_evolution'] = $project_evolution->result();
				}
				//Getting Comitte Decission 
				$this->db->where("applicant_id",$applicant_id);
				$comitte_decision = $this->db->get('comitte_decision');
				if($comitte_decision->num_rows() > 0)
				{
					$arr['comitte_decision'] = $comitte_decision->result();
				}
			}
		}
		return $arr;
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_all_applicatnts()
	{
		//Login Query	
		$query = $this->db->get('applicants');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	function getFourthStepData(){
				$this->db->select('*');
				$this->db->from('applicants');		
				$this->db->where('form_step',4);
				$this->db->order_by("applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}

	}
	
	function getAprovalStepData(){
				$this->db->select('*');
				$this->db->from('applicants AS a');
				$this->db->join('comitte_decision AS cd',"a.applicant_id=cd.applicant_id");		
				$this->db->where('form_step',5);
				$this->db->where('committee_decision_is_aproved','approved');
				$this->db->order_by("applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}

	}
	
	function getSmsHistory($id){
			
				$this->db->select('sh.*');
				$this->db->from('sms_history as sh');
				$this->db->join('admin_users AS au',"au.id=sh.id");
				$this->db->where('sh.sms_receiver_id',$id);
				$this->db->order_by("sh.sms_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}

	}
	function getFifthStepData(){
				$this->db->select('*');
				$this->db->from('applicants');		
				$this->db->where('form_step',5);
				$this->db->order_by("applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}

	}
	
	function getComitteTypeData($type){
				$this->db->select('applicants.*');
				$this->db->from('applicants');
				$this->db->join('comitte_decision AS cd',"cd.applicant_id=applicants.applicant_id");
				$this->db->where('cd.commitee_decision_type',$type);
				$this->db->order_by("applicants.applicant_id", "DESC");
				$this->db->order_by("applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}
	}
//----------------------------------------------------------------------

	/*
	* GET DATA FOR MASHROOTA
	* return Object
	*/	
	public function getMashroota()
	{
		$this->db->select('applicants.*');
		$this->db->from('applicants');
		$this->db->join('comitte_decision AS cd',"cd.applicant_id=applicants.applicant_id");
		$this->db->where('cd.committee_decision_is_aproved','queries');
		$this->db->order_by("applicants.applicant_id", "DESC");	

		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------

	/*
	* GET DATA FOR ALTALBAT
	* return Object
	*/	
	public function getIsComplete()
	{
		$this->db->select('applicants.*');
		$this->db->from('applicants');
		$this->db->join('study_analysis_demand AS snd',"snd.applicant_id=applicants.applicant_id");
		$this->db->where('snd.is_complete','1');
		$this->db->order_by("applicants.applicant_id", "DESC");	

		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}	
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_single_applicatnt($id)
	{
		//Login Query
		$this->db->where("applicant_id",$id);
		$query = $this->db->get('applicants');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_single_auditor($id)
	{
		//Login Query
		$this->db->where("auditor_id",$id);
		$query = $this->db->get('register_auditors');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_main_info($id)
	{
		//Login Query
		$this->db->where("tempid",$id);
		$query = $this->db->get('main');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
		//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_phone_number($id)
	{
		//Login Query
		$this->db->where("tempid",$id);
		$query = $this->db->get('main_phone');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------
	/*
	* 
	*/
	function applicant_phone_number($id)
	{
		//Login Query
		$this->db->where("applicant_id",$id);
		$query = $this->db->get('applicant_phones');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
			//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_notes($id)
	{
		//Login Query
		$this->db->where("tempid",$id);
		$query = $this->db->get('main_notes');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_last_note($id)
	{
		//Login Query
		$this->db->where("tempid",$id);
		$this->db->order_by("notesdate","DESC");
		$this->db->limit("1");
		$query = $this->db->get('main_notes');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_type_name($typeid)
	{
		//Login Query
		$this->db->where("list_id",$typeid);

		$query = $this->db->get('list_management');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row()->list_name;
		}
	}
	//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_gender($typeid)
	{
		//Login Query
		$this->db->where("tempid",$typeid);

		$query = $this->db->get('main_applicant');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row()->applicanttype;
		}
	}
//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_user_name_of_added($id)
	{
		//Login Query
		$this->db->select("firstname,lastname");
		
		$this->db->where("id",$id);

		$query = $this->db->get('admin_users');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
		//----------------------------------------------------------------------
	/*
	* 
	*/
	function get_user_name($id)
	{
		//Login Query
		$this->db->where("tempid",$id);

		$query = $this->db->get('main_applicant');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
//----------------------------------------------------------------------
	/*
	* Delete Applicant Data from Database
	*/
	function delete_applicant($applicant_id)
	{
		$this->db->where("applicant_id",$applicant_id);
		$this->db->delete('applicants');
		
		return true; 
	}
//----------------------------------------------------------------------
	/*
	* Delete Applicant Data from Database
	*/
	function delete_auditor($auditort_id)
	{
		$this->db->where("tempid",$auditort_id);
		$this->db->delete('main');
		
		return true; 
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_province_name($provinceid)
	{
		$this->db->where('ID',$provinceid);

		$query = $this->db->get('election_reigons');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row()->REIGONNAME;
		}
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_wilayats_name($wilayatsid)
	{
		$this->db->where('WILAYATID',$wilayatsid);

		$query = $this->db->get('election_wilayats');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row()->WILAYATNAME;
		}
	}
//----------------------------------------------------------------------

	function get_tab_data($table_name,$app_id)
	{
		$this->db->where("applicant_id",$app_id); 
		$query = $this->db->get($table_name);
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}	
//----------------------------------------------------------------------

}

?>