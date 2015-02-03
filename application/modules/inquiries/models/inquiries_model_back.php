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
		$this->db->insert('applicant_project',$data);
		
		return $this->db->insert_id();
	}
//----------------------------------------------------------------------

	/**
	* Insert Form 3
	*
	*/
	function submit_form_three($data)
	{
		$this->db->insert('applicant_loans',$data);
		
		return $this->db->insert_id();
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
		$this->db->where('tempid',$tempid);
		$query = $this->db->get('temp_main');
		foreach ($query->result() as $main) 
		{
		}
		
		
		
		$this->db->select('*');
		$this->db->from('temp_main');		
		$this->db->where('tempid',$tempid);
		$checkOut = $this->db->get(); 
		$checkOut->num_rows();
		
		$temp_main_data	=	(array)$checkOut->row();
		$this->db->insert('main',$temp_main_data);			
		$tempid = $this->db->insert_id();
		
		//Moving Applicant Data
		$this->db->where('tempid',$tempid);
		$query = $this->db->get('temp_main_applicant');
		foreach ($query->result() as $row) {
			  $this->db->insert('temp_main_applicant',$row);
			  $applicantid = $this->db->insert_id();
			  ////////////////////////////////////////
				$this->db->where('tempid',$tempid);
				$this->db->where('applicantid',$row->applicantid);
				$this->db->from('temp_main_phone');
				$temp_main_phone = $this->db->get();
				foreach ($query->result() as $row) {
					$temp_main_phone_array = array(
						'tempid'=>$tempid,
						'applicantid'=>$row->applicantid,
						'phonenumber'=>$row->phonenumber
					);
					$this->db->insert('main_phone',$temp_main_phone_array);
				}
				
		}
		
		
		/*$this->db->select('*');
		$this->db->from('temp_main_applicant');		
		$this->db->where('tempid',$tempid);
		$temp_main_applicant = $this->db->get();
		foreach($temp_main_applicant->result() as $applicant)
		{
			$applicant_Array = array('tempid'=>$applicant->tempid,
			'first_name'=>$applicant->first_name,
			'middle_name'=>$applicant->middle_name,
			'last_name'=>$applicant->last_name,
			'family_name'=>$applicant->family_name,
			'applicanttype'=>$applicant->applicanttype,
			'idcard'=>$applicant->idcard);
			$this->db->insert('main_applicant',$applicant_Array);			
			$applicantid = $this->db->insert_id();
			////////////////////////////////////////
			$this->db->select('*');
			$this->db->from('temp_main_phone');		
			$this->db->where('tempid',$tempid);
			$this->db->where('applicantid',$applicantid->applicantid);
			$temp_main_phone = $this->db->get();
			foreach($temp_main_phone->result() as $mainphone)
			{
				$temp_main_phone_array = array(
					'tempid'=>$tempid,
					'applicantid'=>$mainphone->applicantid,
					'phonenumber'=>$mainphone->phonenumber
				);
				$this->db->insert('main_phone',$temp_main_phone_array);
			}
		}*/
		////////////////////////////////////////////////////////////
		
		
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
		
		
		$this->db->delete('temp_main', array('userid' => $userid));
			$mobileNumbers = get_mobilenumbers($tempid);
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
	
	
	function getMashroota(){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->where('form_step',4);
		$this->db->join('comitte_decision AS cd',"cd.applicant_id=applicants.applicant_id");
		$this->db->order_by("applicants.applicant_id", "DESC");		
		//$this->db->join('register_auditors',"auditor_id=sms_receiver_id");
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
	* 
	*/
	function get_last_note($id)
	{
		//Login Query
		$this->db->where("tempid",$id);
		$this->db->order_by("notesid","DESC");
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
}

?>