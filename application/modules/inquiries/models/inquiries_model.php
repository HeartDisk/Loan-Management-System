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
    //29/12/2014-------------------------------------START
    public function users_role()
    {
        $this->db->select('id,user_name,firstname,lastname,user_role_id');
        $this->db->from('admin_users');
        $this->db->where('status',1);
        $this->db->order_by("id", "ASC");
        $query = $this->db->get();

        $dropdown = '<select name="userid" id="userid" style="padding: 3px !important; background-color: #F7F7F7 !important;">';
        $dropdown .= '<option value="">حدد المستخدم</option>';

        foreach($query->result() as $row)
        {
            $dropdown .= '<option value="'.$row->id.'" ';
            if($value==$row->id)
            {
                $dropdown .= 'selected="selected"';
            }
            $dropdown .= '>'.$row->firstname.' '.$row->lastname.' ('.$row->user_name.')</option>';
        }
        $dropdown .= '</select>';
        echo($dropdown);
    }
    //29/12/2014-------------------------------------END
    //10/01/2015-------------------------------------START
    function user_perm_list()
    {
        $this->db->select('id,user_name,firstname,lastname,user_role_id');
        $this->db->from('admin_users');
        $this->db->where('status',1);
        $this->db->order_by("firstname", "ASC");
        $query = $this->db->get();
        return $query->result();
    }

    function parent_module()
    {
        $this->db->select('moduleid,module_name,module_icon');
        $this->db->from('mh_modules');
        $this->db->where('module_parent',0);
        $this->db->where('module_status','A');
        $this->db->order_by("module_order", "ASC");
        $query = $this->db->get();
        return $query->result();
    }

    function childe_module($parentid)
    {
        $this->db->select('moduleid,module_name,module_icon');
        $this->db->from('mh_modules');
        $this->db->where('module_parent',$parentid);
        //$this->db->where('module_status','A');
        $this->db->order_by("module_order", "ASC");
        $query = $this->db->get();
        return $query->result();
    }
    //10/01/2015-------------------------------------END
	function getAprovalList($applicant_id){
		$sql = "SELECT 
  SUM(
    sealed_company + commercial_papers + municipal_contractrent + membership_certificate +company_general_authority+open_account+check_book+registration_zip
  ) AS total 
FROM
  `check_list` AS cl 
WHERE cl.`applicant_id` = '".$applicant_id."' ";
		$q = $this->db->query($sql);
		return $r =  $q->result();	
	}
	
	function getcheckList($id){
		$this->db->select('*');
		$this->db->from('check_list');			
		$this->db->where('applicant_id',$id);
		$tempMain = $this->db->get();	
		if($tempMain->num_rows() > 0)
		{
			return $tempMain->result();
		}
		else{
			return false;
		}
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
	
	
	function checkApplicaitonProject($id){
		$this->db->where('applicant_id',$id);
		$query = $this->db->get('applicant_project');
		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return true;
		}
		else{
			return false;
		}
	}
	function getZyaratDetails($id,$type){
		if($type == 'zyarat')
			$this->db->where('zyarat_id',$id);
		else
		$this->db->where('applicant_id',$id);
		
		$query = $this->db->get('zyarat_awalia');
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return false;
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
			$return =$this->checkApplicaitonProject($data['applicant_id']);
			if($return){
				$this->db->where('applicant_id',$data['applicant_id']);
				$this->db->update('applicant_project', $data);
				$id = $data['applicant_id'];
			}
			else{
				$this->db->insert('applicant_project',$data);
				$id = $this->db->insert_id();	
			}
		}
		else{
			$this->db->insert('applicant_project',$data);
			$id = $this->db->insert_id();
		}
		/*if($data['applicant_id']!='')
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
		*/
		$numbers = get_applicant_number($data['applicant_id']);		
		send_sms_steps('step-2',$numbers);
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
			send_sms_steps('step-3',$numbers);
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
		
		$ptype = $data['type_p'];		
		$p_type = json_encode($ptype);
		
		unset($data['type_p'],$data['document_id']);
		$data['type_p'] = $p_type;
		
		$numbers = get_applicant_number($data['applicant_id']);		
		send_sms_steps('step-4',$numbers);
		stepsLogs(array('aid'=>$data['applicant_id'],'sid'=>4));
		
		$q = $this->db->query("SELECT id FROM study_analysis_demand WHERE applicant_id='".$data['applicant_id']."'");
		if($q->num_rows() > 0)
		{
			$this->db->where('applicant_id',$data['applicant_id']);
			$this->db->update('study_analysis_demand',$data);
		}
		else
		{
			$this->db->insert('study_analysis_demand',$data);
			return $this->db->insert_id();
		}
		
		
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
	
	function loan_data($id)
	{
		//Login Query
		$this->db->where('loan_caculate_id',$id);
		$query = $this->db->get('loan_calculate');
		
		//Check if Result is Greater Than Zero
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
	function get_childLoan_data($id)
	{
		//Login Query
		$this->db->where('parent_id',$id);
		$query = $this->db->get('loan_calculate');
		
		//Check if Result is Greater Than Zero
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
	function get_app_ids($user_id)
	{
		$query = $this->db->query(
		"SELECT
		GROUP_CONCAT(applicantid) AS applicants
		FROM applicant_process_log WHERE userid='$user_id' AND stepsid = '1'");
		if($query->num_rows() > 0)
		{
		return $query->row();
		}
	}
	function get_all_applicatnts_data($data)
	{
		//Login Query
		$this->db->where_in('applicant_id',$data);
		$query = $this->db->get('applicants');
		 
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
	}
	
		public function getPartnerInfo($applicant_id='', $partner_sequence='0')
	{
		$this->db->select('*');
		$this->db->from('applicant_partners');			
		$this->db->where('applicant_id',$applicant_id);
		$this->db->where('partner_sequence',$partner_sequence);
		$tempMain = $this->db->get();
		if($tempMain->num_rows() > 0)
		{
			foreach($tempMain->result() as $data)
			{
				//echo "<pre>";
				//print_r($data);
				$arr['partners'] = $data;
				//Getting Applicant Qualification
				$this->db->where("partnerid",$data->parnter_id);				
				$applicant_partner_experience = $this->db->get('applicant_partner_experience');
				if($applicant_partner_experience->num_rows() > 0)
				{
					$arr['ape'] = $applicant_partner_experience->result();
				}
				//Getting Applicant Project
				$this->db->where("partner_id",$data->parnter_id);
				$applicant_partner_businessrecord = $this->db->get('applicant_partner_businessrecord');
				if($applicant_partner_businessrecord->num_rows() > 0)
				{
					$arr['apb'] = $applicant_partner_businessrecord->result();
				}				
			}
		}
		return $arr;
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
	
	function getChild($parentId){
			
			$this->db->where('parent_id',$parentId);
		$query = $this->db->get('loan_calculate');
		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
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
		$update['password'] = ($data['password']);	
		$update['email'] = $data['email'];
		$update['mobile_number'] = $data['number'];
		$update['number'] = $data['number'];
		$update['about_user'] = $data['about_user'];
		$update['branch_id'] = $data['branch_id'];
		$update['user_role_id'] = $data['user_role_id'];
		$update['user_parent_role'] = $data['user_parent_role'];
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
	
		//29/12/2014-------------------------------------START

	//29/12/2014-------------------------------------END

/*
	* Search Applied Products if 
	* Return True 
	*/
	public function getInquiriesSms($type)
	{
		$this->db->where('sms_module','inquiry');
		$this->db->where('type','sms');
		$this->db->select('*');
		$query = $this->db->get($this->_table_sms);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	public function getSms($module_id,$type)
	{
		$this->db->where('sms_module_id',$module_id);
		$this->db->where('type',$type);
		
		if($module_id  == 1)
		{
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
	function get_sms_history($module_id,$userid)
	{
		if($module_id	==	'1')
		{
			$this->db->select('sms_history.*,admin_users.firstname,admin_users.lastname,main_applicant.first_name,main_applicant.middle_name,main_applicant.last_name,main_applicant.family_name');
		}
		else
		{
			$this->db->select('sms_history.*,admin_users.firstname,admin_users.lastname,applicants.applicant_first_name,applicants.applicant_middle_name,applicants.applicant_last_name,applicants.applicant_sur_name');
		}
		
		$this->db->from('sms_history');
		
		if($module_id	==	'1')
		{
			$this->db->join('main_applicant',"main_applicant.tempid=sms_history.sms_receiver_id");
		}
		else
		{
			$this->db->join('applicants',"applicants.applicant_id=sms_history.sms_receiver_id");
		}
		
		$this->db->join('admin_users',"admin_users.id=sms_history.sms_sender_id");
		$this->db->where('sms_module_id',$module_id);
		$this->db->where('sms_receiver_id',$userid);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
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
	function delete_user($userid)
	{
		$this->db->where("id",$userid);
		$this->db->delete('admin_users');
		
		return true; 
	}
	
	function checkData($table,$returnKey,$whereKey,$value){
		$this->db->select('*');
		$this->db->from($table);		
		$this->db->where($whereKey,$value);
		$checkOut = $this->db->get(); 
		$row = $checkOut->num_rows();
		$temp_main_data	=	(array)$checkOut->row();
		if($row>0){
		
			return 	$temp_main_data[''.$returnKey.''];	;
		}
		else{
			false;
		}
	}
	function addUpdate($table,$data){
		//echo $C->db->on_duplicate('finance_project',$insertData);
		echo $table;
		echo "<pre>";
		print_r($data);
		//return $this->db->on_duplicate($table,$data);	
	}
	function get_all_users()
	{
		$query = $this->db->query(
		"SELECT
		admin_users.id
		,admin_users.user_name
		,admin_users.firstname
		,admin_users.lastname
		,admin_users.email
		,admin_users.number
		,branches.branch_name,
		COUNT(ap.`applicantid`) AS total
		FROM admin_users
		INNER JOIN branches
		ON (admin_users.branch_id = branches.branch_id)
		LEFT JOIN `applicant_process_log` AS ap 
		ON ap.`userid` = admin_users.`id` AND ap.`stepsid` = '1'
		Where admin_users.`branch_id` !=''
		GROUP BY admin_users.`id`
		ORDER BY total DESC");
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
	}
	
	function get_all_banks()
	{
		$query = $this->db->query(
		"SELECT 
		  admin_users.id,
		  admin_users.user_name,
		  admin_users.firstname,
		  admin_users.lastname,
		  admin_users.email,
		  admin_users.number,
		  bb.branch_name   
		FROM
		  `admin_users` 
		  INNER JOIN `bank_branches` AS bb 
			ON bb.`branch_id` = admin_users.`bank_branch_id` ");
		if($query->num_rows() > 0)
		{
		return $query->result();
		}
	}
	public function add_data_into_main($tempid	=	'')
	{
		$userid = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('temp_main');		
		$this->db->where('tempid',$tempid);
		$checkOut = $this->db->get(); 
		$checkOut->num_rows();
		
		
		$this->db->select('*');
		$this->db->from('main');		
		$this->db->where('tempid',$tempid);
		$checkOut2 = $this->db->get(); 
		$checkOut2->num_rows();
		
		if($tempid)
		$temp_main_data	=	(array)$checkOut->row();
		$this->db->insert('main',$temp_main_data);			
		$tempid = $this->db->insert_id();
		
		
		$applicantQuery = $this->db->query("SELECT * FROM temp_main_applicant WHERE tempid='".$tempid."'");
		
		
		foreach($applicantQuery->result() as $applicant)
		{
			if($applicant->first_name !="" && $applicant->idcard !=""){
			$temp_main_applicant = array('tempid'=>$applicant->tempid,
			'first_name'=>$applicant->first_name,
			'middle_name'=>$applicant->middle_name,
			'last_name'=>$applicant->last_name,
			'family_name'=>$applicant->family_name,
			'applicanttype'=>$applicant->applicanttype,
			'idcard'=>$applicant->idcard);
			$this->db->insert('main_applicant',$temp_main_applicant);
			$applicantid = $this->db->insert_id();
			}
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
			$userNumber = applicant_number($tempid);
			send_sms(1,$mobileNumbers,$userid,$userNumber);
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
					
					for($a== 0;$a<4;$a++){
					$this->db->insert('temp_main_applicant',array('tempid'=>$tempid,'applicanttype'=>'ذكر'));
						$applicantid = $this->db->insert_id();
						$this->db->insert('temp_main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));
					}
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
	
	function getGuarantee_data($applicant_id)
	{
		$this->db->select('*');
		$this->db->from('guanttee_required');
		$this->db->where('applicant_id',$applicant_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} 
	}
	
	function check_record($table,$id){
		$this->db->select('*');
		$this->db->from($table);			
		$this->db->where('applicant_id',$id);
		$tempMain = $this->db->get();	
		if($tempMain->num_rows() > 0)
		{
			return $tempMain->result();
		}
		else{
			return false;
		}	
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
				//Getting Comitte Decission 
				$this->db->where("applicant_id",$applicant_id);
				$study_analysis_demand = $this->db->get('study_analysis_demand');
				if($study_analysis_demand->num_rows() > 0)
				{
					$arr['study_analysis_demand'] = $study_analysis_demand->result();
				}
			}
		}
		return $arr;
	}
	
	function getAmountLimit($id){
		$sql = "SELECT * FROM `loan_calculate` AS lc WHERE lc.`loan_caculate_id` = '".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
		return $query->row();
		}
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	
	
	function get_all_applicatnts()
	{
		$sql = "SELECT 
				  a.*,
				  cd.`commitee_decision_type`,
				  br.`is_reject`,br.`loan_id`
				FROM
				  `applicants` AS a 
				  LEFT JOIN `comitte_decision` AS cd 
					ON cd.`applicant_id` = a.`applicant_id` 
				   LEFT JOIN `bank_response` AS br
				   ON br.`applicant_id` = a.`applicant_id` ";
							
		$query = $this->db->query($sql);					
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		//Login Query	
		/*$query = $this->db->get('applicants');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}*/
	}
	
	
	function get_all_reject_bank()
	{
		$sql = "SELECT*
				FROM
			  `applicants` AS a
			  INNER JOIN `bank_response` ON `bank_response`.`applicant_id` = a.`applicant_id`
			  WHERE `bank_response`.`is_reject` = '1'";
							
		$query = $this->db->query($sql);					
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		//Login Query	
		/*$query = $this->db->get('applicants');
			
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}*/
	}
	
		function get_mukhair()
	{
		$sql = "SELECT * FROM applicants  AS a
			INNER JOIN `study_analysis_demand` AS sa ON sa.`applicant_id`= a.`applicant_id`
			WHERE sa.`credit_risk` = 'نعم'";
					$q = $this->db->query($sql);
					return $r =  $q->result();

	}
	
	function getFourthStepData(){
	
				/*$sql = "SELECT a.*
					FROM
					  (`applicants` AS a) 
					  JOIN `comitte_decision` AS cd 
						ON `a`.`applicant_id` != `cd`.`applicant_id` 
					WHERE `form_step` = 4 AND cd.`applicant_id`!=a.`applicant_id`
					GROUP BY a.`applicant_id`
					ORDER BY `a`.`applicant_id` DESC ";*/
				$sql = "SELECT 
						  `applicants`.* 
						FROM
						  (`applicants`) 
						  JOIN `zyarat_awalia` AS snd 
							ON `snd`.`applicant_id` = `applicants`.`applicant_id` 
						WHERE `snd`.`is_complete` = '1' 
						GROUP BY `applicant_id` 
						ORDER BY `applicants`.`applicant_id` DESC ";
					$q = $this->db->query($sql);
					return $r =  $q->result();
					
				
	}
	
	function getAgreedList(){
		
	}
	function getAprovalStepData(){
				/*$this->db->select('*');
				$this->db->from('applicants AS a');
				$this->db->join('comitte_decision AS cd',"a.applicant_id=cd.applicant_id");		
				$this->db->where('form_step',5);
				$this->db->where('committee_decision_is_aproved','approval');
				$this->db->order_by("a.applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}*/
						$sql= "SELECT 
		  * 
		FROM
		  `applicants` AS a 
		  INNER JOIN `check_list` AS cl 
			ON cl.`applicant_id` = a.`applicant_id` 
		WHERE cl.`sealed_company` = '1' 
		  AND cl.`registration_zip` = '1' 
		  AND cl.`municipal_contractrent` = '1'  
		  AND cl.`open_account` = '1' 
		  AND cl.`membership_certificate` = '1'
		  AND cl.`company_general_authority` = '1'
		  AND cl.`commercial_papers` = '1'
		  AND cl.`check_book` = '1'";
		  $q = $this->db->query($sql);
		return $r =  $q->result();

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
	
	function getZyaratlist($id){
		$sql = "SELECT za.*,au.`firstname` FROM `zyarat_awalia` AS za
				INNER JOIN `admin_users` AS au ON au.`id` = za.`user_id`
				WHERE za.`applicant_id` = ".$id."
				ORDER BY za.`zyarat_id`  DESC ";		  
		$q = $this->db->query($sql);
		return $r =  $q->result();
					
	}
	function getZyaratawalia(){

				/*$this->db->select('applicants.*');
				$this->db->from('applicants');
				$this->db->join('study_analysis_demand AS sd',"sd.applicant_id=applicants.applicant_id");
				//$this->db->where('sd.credit_risk','لا');
				//$this->db->where('sd.credit_risk','لا');
				$val = 'لا';
				$where = "sd.credit_risk='$val OR sd.is_musanif='classified'";
				$this->db->where($where);
				$this->db->order_by("applicants.applicant_id", "DESC");
				$this->db->order_by("applicant_id", "DESC");
				$tempNotes = $this->db->get();
				if($tempNotes->num_rows() > 0)
				{
					return $tempNotes->result();
				}
				*/
				
				
				/*$sql = "SELECT 
						  `applicants`.* 
						FROM
						  (`applicants`) 
						  JOIN `study_analysis_demand` AS sd 
							ON `sd`.`applicant_id` = `applicants`.`applicant_id` 
						WHERE `sd`.credit_risk='لا' 
						  OR sd.is_musanif = 'classified' 
						ORDER BY `applicants`.`applicant_id` DESC,
						  `applicant_id` DESC";*/
				$sql = "SELECT 
				  `applicants`.* ,
				  COUNT(za.`applicant_id`) AS total
				FROM
				  (`applicants`) 
				  JOIN `study_analysis_demand` AS sd 
					ON `sd`.`applicant_id` = `applicants`.`applicant_id` 
					LEFT JOIN `zyarat_awalia` AS za 
					ON za.`applicant_id` = sd.`applicant_id`
				WHERE `sd`.credit_risk = 'لا' 
				  OR sd.is_musanif = 'classified'
				 GROUP BY applicants.`applicant_id` 
				ORDER BY `applicants`.`applicant_id` DESC,
				  `applicant_id` DESC ";		  
						  
					$q = $this->db->query($sql);
					return $r =  $q->result();
				
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
		$this->db->join('zyarat_awalia AS snd',"snd.applicant_id=applicants.applicant_id");
		$this->db->where('snd.is_complete','0');
		$this->db->order_by("applicants.applicant_id", "DESC");
		$this->db->group_by('applicant_id');	

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
	
	///
	function get_applicant_evolution($id)
	{
		//Login Query
		$this->db->where("applicant_id",$id);
		$query = $this->db->get('project_evolution');		
		//Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
	///getEvolutionAmount
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

	function get_branch_name($branchid)
	{
		$this->db->where("branch_id",$branchid); 
		$query = $this->db->get('branches');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row()->branch_name;
		}
	}
	//----------------------------------------------------------------------

	function marajeen_phones()
	{
		$query = $this->db->get('main_phone');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	function tasjeel_phones()
	{
		$query = $this->db->get('applicant_phones');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------

}

?>