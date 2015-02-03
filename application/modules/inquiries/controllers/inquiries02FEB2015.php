<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiries extends CI_Controller 
{
//-------------------------------------------------------------------------------	
	/*
	* Properties
	*/
	private $_data = array();
	private $_user_info	=	array();
//-------------------------------------------------------------------------------

	/*
	* Costructor
	*/
	
	public function __construct()
	{
		parent::__construct();
		
		// Load Models
		$this->_data['module'] = get_module();
		$this->_data['user_info']	=	userinfo();
		$this->load->model('inquiries_model', 'inq');
		//Deleteing whole temporay uploaded document
		$this->load->model('listing_managment/listing_managment_model', 'listing');
		
	}
	
	
		//29/12/2014-------------------------------------START
	public function userhistory()
	{
		$this->load->view('userhistory', $this->_data);
	}
	//29/12/2014-------------------------------------END
//10/01/2015-------------------------------------START
    public function userpermission()
    {
        if($this->input->post())
        {
            foreach($this->input->post('user') as $ux)
            {
                $userid = $ux;
                $this->db->query("DELETE FROM `system_permission` WHERE `userid`='".$userid."'");
                foreach($this->input->post('module') as $mx)
                {
                    if($this->input->post('v_'.$mx))
                    {	$m[$mx]['v'] = 1;	}
                    else
                    {	$m[$mx]['v'] = 0;	}

                    if($this->input->post('a_'.$mx))
                    {	$m[$mx]['a'] = 1;	}
                    else
                    {	$m[$mx]['a'] = 0;	}

                    if($this->input->post('u_'.$mx))
                    {	$m[$mx]['u'] = 1;	}
                    else
                    {	$m[$mx]['u'] = 0;	}

                    if($this->input->post('d_'.$mx))
                    {	$m[$mx]['d'] = 1;	}
                    else
                    {	$m[$mx]['d'] = 0;	}
                }
                $permission = json_encode($m);
                $data = array('userid'=>$userid,'permission'=>$permission);
                $this->db->insert('system_permission',$data);
            }
            redirect(base_url().'inquiries/userpermission');
        }
        else
        {

            $this->_data['u_list'] = $this->inq->user_perm_list();
            $this->_data['m_list'] = $this->inq->parent_module();
            $this->load->view('userpermission', $this->_data);
        }
    }
    //10/01/2015-------------------------------------END
	function applicantsList(){
		$this->_data['all_applicatns']	=	$this->inq->getAprovalStepData();
		//print_r($this->_data['all_applicatns']);
		//exit;
		$this->load->view('banklist', $this->_data);
	
	}
	public function upload_file()
	{
		$ponka_id_for_users = $this->session->userdata('userid');
		$path = APPPATH.'../upload_files/'.$ponka_id_for_users.'/';	
		$attachment	= upload_file('frmdocument',$path,true,50,50);
		$document_id = $this->input->post('document_id');
		$this->db->query("INSERT INTO `applicant_temp_document` SET `userid`='".$ponka_id_for_users."', `document_id`='".$document_id."', `documentname`='".$attachment."'");		
	}
	
	
	public function getsavedocument()
	{
		//echo json_encode($this->session->userdata('doc'));
		echo json_encode($this->inq->getsave_document());
	}
	
	function get_child_data(){
		
		//echo "<pre>";
		//print_r($_POST);
		$postData = $this->input->post();
		//print_r($postData);
		$parentId = $postData['parent_id'];
		$child = $this->inq->getChild($parentId);
		//echo "<pre>";
		//print_r($child);
		if(!empty($child)){
			echo "<select id='loan_limit' name='loan_limit'>";
			foreach($child as $ch){
				
				echo "<option value='$ch->loan_caculate_id'>$ch->loan_caculate_id</option>";
			}
			echo "</select>";
		}
	}
	public function get_sms_history($module_id,$userid)
	{
		$this->_data['module_id']	=	$module_id;
		
		$this->_data['sms_history']	=	$this->inq->get_sms_history($module_id,$userid);
		
		//echo '<pre>'; print_r($this->_data['sms_history']);
		//exit();
		
		$this->load->view('history-listing', $this->_data);

	}
//-------------------------------------------------------------------------------
	public function getInqueryData($tempid)
	{
		$this->inq->getLastDetail($tempid,'json');
	}
	/*
	*
	* Main Page
	*/
	public function index()
	{
		//$this->_data['user_info']	=	getInquiries()
		//$this->_data['inquiries'] = $this->inq->getInquiries();
		$this->_data['inquiries'] = $this->inq->getmaindata();
			
		$this->load->view('inquiries_list', $this->_data);
	}
	
	public function mukhatirList()
	{
		//$this->_data['user_info']	=	getInquiries()
		//$this->_data['inquiries'] = $this->inq->getInquiries();
		$this->_data['all_applicatns']	=	$this->inq->get_mukhair();			
		$this->load->view('mukhatir_list', $this->_data);
	}
	
		public function requestphasethree($appid	=	NULL)
		{
						
			$this->load->model('lease_programe/lease_programe_model', 'loan');
			$this->_data['loan_calculate'] = $this->loan->get_all_loan_calculate();
			
			if($appid)
			{
				$this->_data['app_id']	=	$appid;
				$this->_data['m'] = $this->inq->getRequestInfo($appid);
				$loan_limit_id =  $this->_data['m']['applicant_loans'][0]->loan_limit;
				$this->_data['lnData'] = $this->inq->loan_data($loan_limit_id);
				//print_r($this->_data['lnData']);
				//echo $parentId = $lnData->parent_id;
				$this->_data['parentId'] = $this->_data['lnData']->parent_id;
				$this->_data['lnParentData'] = $this->inq->loan_data($parentId);
				//$this->_data['lnParentData']->loan_caculate_id;
				$this->_data['lnChildData'] = $this->inq->get_childLoan_data($parentId);
				//$lnParentData

			}
			else
			{
				$this->_data['app_id']	=	'';
			}
			
			if($this->input->post())
			{
				$data	=	$this->input->post();
				//echo "<pre>";
				//print_r($data);
				//exit;
				$this->inq->updateStep($appid,$data['form_step']);
				unset($data['submit']);
				unset($data['form_step']);
				
				
				$this->inq->submit_form_three($data);
				echo $appid; 
			}
			else
			{
				$this->load->view('requestphasethree', $this->_data);
			}
		}
	public function requestphaseOne($tempid	=	NULL,$step	=	NULL)
	{
		$this->_data['a_id']	= $tempid;	
		$this->_data['a_step']	= $step;			
		$this->_data['m'] = $this->inq->getRequestInfo($tempid);
		//print_r($this->_data['m']);
		if(empty($this->_data['m'])){
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			//print_r($this->_data['m']);
			$this->_data['type'] = 'inquiry';
		}
		else{
			$this->_data['type'] = 'register';
		}
		$this->load->view('requesphaseone', $this->_data);
	}	
	public function add_data_into_main($tempid)
	{
				$postData = $this->input->post();
				//echo "<pre>";
				//print_r($postData);
				//exit;
			$this->inq->add_data_into_main($tempid);
	}
	
	function updateMurajeen(){
			$postData = $this->input->post();
			//echo "<pre>";
			//print_r($postData);
			//exit;
			$appId = $postData['applicantid'][0];
			
			$total = count($postData['applicantid']);
			//exit;
			if(isset($postData['user_type'])){
			//	$data['user_type'] = $postData['user_type'];
			}
			else{
			//	$data['user_type'] = '';
			}
			$data['first_name'] = $postData['first_name_'.$appId];
			$data['middle_name'] = $postData['middle_name_'.$appId];
			$data['last_name'] = $postData['last_name_'.$appId];
			$data['family_name'] = $postData['sur_name_'.$appId];
			//$data['phone_numbers'] = $postData['phone_numbers'];
			$data['idcard'] = $postData['idcard_'.$appId.''];
			$data['cr_number'] = $postData['cr_number_'.$appId.''];
			$data['datepicker'] = $postData['datepicker_'.$appId.''];
			$data['marital_status'] = $postData['marital_status_'.$appId.''];
			
			
			if(isset($postData['cr_number_'.$appId.''])){
				$data['cr_number'] = $postData['cr_number_'.$appId.''];
			}
			else{
					$data['cr_number'] = $postData['cr_number'];
			}
			
			
			if(isset($postData['datepicker_'.$appId.''])){
				$data['datepicker'] = $postData['datepicker_'.$appId.''];
			}
			else{
					$data['datepicker'] = $postData['datepicker'];
			}
			
			
			if(isset($postData['marital_status_'.$appId.''])){
				$data['marital_status'] = $postData['marital_status_'.$appId.''];
			}
			else{
					$data['marital_status'] = $postData['marital_status'];
			}
			
			
			if(isset($postData['job_status_'.$appId.''])){
				$data['job_status'] = $postData['job_status_'.$appId.''];
			}
			else{
					$data['job_status'] = $postData['job_status'];
			}
			
			if(isset($postData['province_'.$appId.''])){
				$data['province'] = $postData['province_'.$appId.''];
			}
			else{
					$data['province'] = $postData['province'];
			}
			
			if(isset($postData['walaya_'.$appId.''])){
				$data['walaya'] = $postData['walaya_'.$appId.''];
			}
			else{
					$data['walaya'] = $postData['walaya'];
			}
			
			if(isset($postData['mr_number_'.$appId.''])){
				$data['mr_number'] = $postData['mr_number_'.$appId.''];
			}
			else{
					$data['mr_number'] = $postData['mr_number'];
			}
			
			if(isset($postData['is_insurance_'.$appId.''])){
				$data['is_insurance'] = $postData['is_insurance_'.$appId.''];
			}

			
			if(isset($postData['insurance_number_'.$appId.''])){
				$data['insurance_number'] = $postData['insurance_number_'.$appId.''];
			}
			else{
					$data['insurance_number'] = $postData['insurance_number'];
			}
			
			if(isset($postData['confirm_'.$appId.''])){
				$data['confirmation'] = $postData['confirm_'.$appId.''];
			}
			else{
					$data['confirmation'] = $postData['confirm'];
			}
			
			if(isset($postData['project_name_'.$appId.''])){
				$data['project_name'] = $postData['project_name_'.$appId.''];
			}
			else{
					$data['project_name'] = $postData['project_name'];
			}
			
			if(isset($postData['project_location_'.$appId.''])){
				$data['project_location'] = $postData['project_location_'.$appId.''];
			}
			else{
					$data['project_location'] = $postData['project_location'];
			}
			
			if(isset($postData['project_activities_'.$appId.''])){
				$data['project_activities'] = $postData['project_activities_'.$appId.''];
			}
			else{
					$data['project_activities'] = $postData['project_activities'];
			}
			
			
			if(isset($postData['project_cr_name_'.$appId.''])){
				$data['project_cr_name'] = $postData['project_cr_name_'.$appId.''];
			}
			else{
					$data['project_cr_name'] = $postData['project_cr_name'];
			}
			
			
			if(isset($postData['is_loan_'.$appId.''])){
				$data['is_loan'] = $postData['is_loan_'.$appId.''];
			}
			else{
					$data['is_loan'] = $postData['is_loan'];
			}
			
			
			
			
			if(isset($postData['is_bank_loan_'.$appId.''])){
				$data['is_bank_loan'] = $postData['is_bank_loan_'.$appId.''];
			}
			else{
					$data['is_bank_loan'] = $postData['is_bank_loan'];
			}
			
			if(isset($postData['is_rafd_loan_'.$appId.''])){
				$data['is_rafd_loan'] = $postData['is_rafd_loan_'.$appId.''];
			}
			
			
			if(isset($postData['is_commercial_loan_'.$appId.''])){
				$data['is_commercial_loan'] = $postData['is_commercial_loan_'.$appId.''];
			}
			else{
					$data['is_commercial_loan'] = $postData['is_commercial_loan'];
			}
			
			
			if(isset($postData['is_loan_'.$appId.''])){
				$data['is_other_loan'] = $postData['is_loan_'.$appId.''];
			}
			else{
					$data['is_other_loan'] = $postData['is_loan'];
			}
			
			if(isset($postData['other_value_'.$appId.''])){
				$data['other_loan_value'] = $postData['other_value_'.$appId.''];
			}
			else{
					$data['other_loan_value'] = $postData['other_value'];
			}
			
			//echo "<pre>";
			//print_r($data);
			//exit;
			/*
			$tempid = $postData['tempid'];
			$this->db->where('tempid',$tempid);
			$this->db->update('main',$data);			
			*/
			
			$this->db->where('idcard',$data['idcard']);
			$this->db->update('main_applicant',$data);
						
			$data = array();
			
			//echo "<pre>";
			//print_r($postData);
			//exit;	
			if($postData['user_type'] == 'مشترك'){
			for($a=1;$a<=4;$a++){
				//echo "<pre>";
				//print_r($postData);
				$appId = $postData['applicantid'][$a];
					if($postData['first_name'][$a] !=""){
					$data['first_name'] = $postData['first_name'][$a];
					$data['middle_name'] = $postData['middle_name'][$a];
					$data['last_name'] = $postData['last_name'][$a];
					$data['family_name'] = $postData['sur_name'][$a];
					$data['applicanttype'] = $postData['applicanttype'][$a];
					$data['idcard'] = $postData['idcard'][$a];
					$data['cr_number'] = $postData['cr_number'][$a];
					$data['datepicker'] = $postData['datepicker'][$a];
					$data['marital_status'] = $postData['marital_status'][$a];
					$data['job_status'] = $postData['job_status'][$a];
					$data['province'] = $postData['province'][$a];
					$data['walaya'] = $postData['walaya'][$a];
					$data['mr_number'] = $postData['mr_number'][$a];
					$data['is_insurance'] = $postData['is_insurance'][$a];
					$data['insurance_number'] = $postData['insurance_number'][$a];
					$data['confirmation'] = $postData['confirm'][$a];
					$data['project_name'] = $postData['project_name'][$a];
					$data['project_location'] = $postData['project_location'][$a];
					$data['project_activities'] = $postData['project_activities'][$a];
					$data['project_cr_name'] = $postData['project_cr_name'][$a];
					$data['is_loan'] = $postData['is_loan'][$a];
					$data['is_bank_loan'] = $postData['is_bank_loan'][$a];
					$data['is_rafd_loan'] = $postData['is_rafd_loan'][$a];
					$data['is_commercial_loan'] = $postData['is_commercial_loan'][$a];
					$data['is_other_loan'] = $postData['is_other_loan'][$a];
					$data['other_loan_value'] = $postData['other_value'][$a];
					if(isset($postData['tempid']))
					$data['tempid'] = $postData['tempid'];
				//	echo "<pre>";
				//	print_r($data);
				//	echo $appId;
					//exit;
					
					$this->db->select('*');
					$this->db->from('main_applicant');		
					$this->db->where('idcard',$data['idcard']);
					$checkOut2 = $this->db->get(); 
					$rows = $checkOut2->num_rows();
		
					
					if($rows>0){

						$this->db->where('idcard',$data['idcard']);
						$this->db->update('main_applicant',$data);

						//$this->db->where('applicantid',$appId);
						//$this->db->update('temp_main_applicant',$data);
					}
					else{
						
						$this->db->insert('main_applicant',$data);	
					}
					
				
				}
					else{
							$this->db->delete('main_applicant',array('applicantid' =>$appId));
					}
				
				
					
				}
			}
//
			exit;
	}	
//-------------------------------------------------------------------------------------

	/*
	* All Users Listing Pages
	*
	*/
	public function all_users()
	{
		$this->_data['all_users']	=	$this->inq->get_all_users();
		
		// Load Users Listing Page
		$this->load->view('users-listing', $this->_data);
		
	}
	
	/*
	* All bank Listing Pages
	*
	*/
	public function bank_users()
	{
		$this->_data['all_users']	=	$this->inq->get_all_banks();
		
		// Load Users Listing Page
		$this->load->view('bank-listing', $this->_data);
		
	}
	
	
	public function get_calc_data($applicantid	=	NULL)
	{
		$postData = $this->input->post();
		//echo "<pre>";
		//print_r($postData);
		$this->_data['post_data']	= $postData;
		echo $HTML	=	$this->load->view('ajax-calc-html', $this->_data,TRUE);
	}
//-------------------------------------------------------------------------------------	
	
	function sendSms(){
	
		$phone_numbers = $this->input->post('phone_numbers');
		
		if(!empty($phone_numbers))
		{
			$all_numbers	=	array();
			foreach($phone_numbers as $key	=> $value)
			{
				 array_push($all_numbers, trim($value));
			}
		}
		
		$all_phone_numbers	=	 implode(',', $all_numbers);
		
		//$message = $_POST['message'];
		//echo "<pre>";
		//print_r($_POST);
		$dateTime =  $this->input->post('date_time');
		//	echo strtotime($dateTime);
		
			$id = $this->input->post('tempid');
			if($id ==""){
				$id = $this->input->post('xid');
			}
			
			$message = $this->input->post('expiry_msg');
			$sms_time = $this->input->post('sms_time');
			$dateTime = $this->input->post('date_time');
			
			if(isset($_GET['type']) && $_GET['type']!= ""){
					$numbers = get_mobilenumbers($id);
					$sms_module_id = 1;
			}
			else{
				$numbers = get_applicant_number($id);
				$sms_module_id = 2;
			}
			 
			//echo $numbers;
			//exit;
		if($sms_time){	
			//echo "if";	
			$message = $this->input->post('expiry_msg');
			
			$return = send_general_sms($message,$numbers);
			
			$dateTime = strtotime(date('Y-m-d h:m:s'));
			if(strstr($return,'1')){
			
			}
			$sms_time_type = 'Now';
		}
		else{
			//echo "else";
			$dateTime =  $this->input->post('date_time');
			//strtotime($dateTime);
			$dateTime = strtotime($dateTime);
			//date('Y-m-d h:m:s',strtotime($dateTime));
			$return = true;
			$sms_time_type = 'Later';
		}
		
		$numbers_arr = explode(',',$numbers);
		if(!empty($numbers_arr)){
				foreach($numbers_arr as $new){
					//$myData[] = 
					
					$myData['sms_receiver_id'] = $id;
					$myData['sms_sender_id'] = $this->session->userdata('userid');
					$myData['sms_receiver_number'] = $new;
					$myData['sms_module_id'] = $sms_module_id;
					$myData['sms_sent_date'] = $dateTime;
					$myData['sms_message'] = $message;
					$myData['sms_sent_type_time'] = $sms_time_type;
					$myData['type'] = 'sms';
					$myData['sms_list'] = 'inquiries';
					$newData[] = $myData;
				}
		}
		
		//print_r($newData);
		//exit;
		$this->db->insert_batch('sms_history',$newData);
		
		if($return){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function sendxxx()
	{
			$mobileNumbers = get_mobilenumbers(5);
			//send_sms(1,$mobileNumbers,2,'000005');
			echo send_sms_steps(1,'92463374');
			//send_sms_message($msg,$numbers)
	}
	
	
	function add_analyze_data(){
			//echo "<pre>";
			//print_r($_POST);
			//$data = $_POST;
			$data['age'] = $_POST['datepicker'];
			unset($_POST['datepicker']);
			$data = $_POST;
			$return = $this->db->insert('project_analysis',$data);
			if($return){
				$this->session->set_flashdata('msg', 'S');	
			}
			redirect('inquiries/requestProjectIlust');
	}
	
	function comittie_decision()
	{
		$data = $this->input->post();
		//echo "<pre>";
		//print_r($data);
		
		$formSteps = $data['form_step'];
		unset($data['form_step']);
		$q = $this->db->query("SELECT applicant_id FROM comitte_decision WHERE applicant_id='".$data['applicant_id']."'");
		if($q->num_rows() > 0)
		{
			$this->db->where('applicant_id',$data['applicant_id']);
			$this->db->update('comitte_decision',$data);
		}
		else
		{
			$this->db->insert('comitte_decision',$data);
		}
		
			$numbers = get_applicant_number($data['applicant_id']);		
			send_sms_steps($formSteps,$numbers);
			stepsLogs(array('aid'=>$data['applicant_id'],'sid'=>$formSteps));
			$this->inq->updateStep($data['applicant_id'],$formSteps);	
	}
	
	function add_zyarat()
	{
		$data = $this->input->post();
		//echo "<pre>";
		//print_r($data);
		//exit;
		$data['zyarat_id'];
		$data['monthly_rent'];
		$data['monthly_other_rent'];
		$data['is_electricity'];
		$data['is_water'];
		$data['is_suitable'];
		$data['fine_headquarter'];
		$data['which_covered'];
		$data['visit_notes'];
		$data['technical_notes'];
		$data['notes'];
		$data['attachment'];
		if(isset($data['is_surf'])){
					$newData['is_surf'] 	 = $data['is_surf'];
					$newData['surf_attachment'] 	 = $data['attachment'][1];
				}
				

		$total = count($data['monthly_rent']);
		for($a=0;$a<$total;$a++){
				
				$newData['monthly_rent'] 		= $data['monthly_rent'][$a];
				$newData['monthly_other_rent'] = $data['monthly_other_rent'][$a];
				$newData['is_electricity'] 	= $data['is_electricity'][$a];
				$newData['is_water'] 		  = $data['is_water'][$a];
				$newData['is_suitable'] 		= $data['is_suitable'][$a];
				$newData['fine_headquarter'] 	= $data['fine_headquarter'][$a];
				$newData['which_covered'] 		= $data['which_covered'][$a];	
				$newData['visit_notes'] 		= $data['visit_notes'][$a];
				$newData['technical_notes'] 	= $data['technical_notes'][$a];
				$newData['notes'] 				= $data['notes'][$a];
				$newData['attachment'] 		= $data['attachment'][$a];
				
				
				
				
				$newData['applicant_id'] 		= $data['applicant_id'];
				$newData['is_complete']  		= $data['is_complete'];
				$newData['user_id']  		=  $this->session->userdata('userid');	
				
				//print_r($newData);
				//exit;
				if(isset($data['zyarat_id'][$a]) && $data['zyarat_id'][$a] !="" ){
			//		echo "if";
			//		exit;
			
			
			
					$newData['zyarat_id'] = $data['zyarat_id'][$a];
					$this->db->where('zyarat_id',$newData['zyarat_id']);
					echo $this->db->update('zyarat_awalia',$newData);
				}
				else{
			//		echo "else";
					echo $this->db->insert('zyarat_awalia',$newData);
				}
		}
		exit;
		/*$formSteps = $data['form_step'];
		unset($data['form_step']);
		$q = $this->db->query("SELECT applicant_id FROM comitte_decision WHERE applicant_id='".$data['applicant_id']."'");
		if($q->num_rows() > 0)
		{
			$this->db->where('applicant_id',$data['applicant_id']);
			$this->db->update('comitte_decision',$data);
		}
		else
		{
			$this->db->insert('comitte_decision',$data);
		}*/
		
		
		
		
			$numbers = get_applicant_number($data['applicant_id']);		
			send_sms_steps($formSteps,$numbers);
			stepsLogs(array('aid'=>$data['applicant_id'],'sid'=>$formSteps));
			$this->inq->updateStep($data['applicant_id'],$formSteps);	
	}
	function add_evolution_data()
	{
			$data = $this->input->post();			
			$applicant_id = $data['applicant_id'];
			foreach(people() as $pd => $px) 
			{
				$ar[$pd]['sign'] = $data['sign'][$pd];
				$ar[$pd]['notes'] = $data['notes'][$pd];
			}
			$managersigns = json_encode($ar);			
			$updateData = array(
				'applicant_id'=>$data['applicant_id'],
				'evolution_pre_expenses'=>$data['evolution_pre_expenses'],
				'vehicles'=>$data['vehicles'],
				'seller_amount'=>$data['seller_amount'],
				'is_working_capital'=>$data['is_working_capital'],
				'is_furndloan'=>$data['is_furndloan'],
				'is_contiribute'=>$data['is_contiribute'],
				'is_total'=>$data['is_total'],
				'furniture_fixture'=>$data['furniture_fixture'],
				'machinery_equipment'=>$data['machinery_equipment'],
				'hardware_software'=>$data['hardware_software'],
				'power_games'=>$data['power_games'],
				'working_capital'=>$data['working_capital'],
				'contribute'=>$data['contribute'],
				'total_cost'=>$data['total_cost'],
				'evolution_notes'=>$data['evolution_notes'],
				'commitee_decision'=>$data['commitee_decision'],
				'managersigns'=>$managersigns);
			unset($data['save_data_form_loan']);
			$q = $this->db->query("SELECT applicant_id FROM project_evolution WHERE applicant_id='".$applicant_id."'");
			if($q->num_rows() > 0)
			{
				$this->db->where('applicant_id',$applicant_id);
				$this->db->update('project_evolution',$updateData);
			}
			else
			{
				$this->db->insert('project_evolution',$updateData);
			}
		
	}
	
	function getEvolutionAmount(){
		
			$data = $this->input->post();
			
			//echo "<pre>";
			//print_r($data);
			$applicant_id = $data['applicant_id'];
			$appData = $this->inq->get_applicant_evolution($applicant_id);
			
			//print_r($appData);
			echo $appData->total_cost;
				
	}
	function insertSecondForm(){
		
	}
//-------------------------------------------------------------------------------

	/*
	* Logout
	* Destroy All Sessions
	*/
	
	public function newinquery($tempid='')
	{
		//$this->_data['user_info'] = userinfo();
		//echo "asdad";
		if($tempid!='')
		{
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			$this->_data['t'] = 'review';
			//echo "<pre>";
			//print_r($this->_data['m']);
		}
		else
		{
			$this->_data['m'] = $this->inq->new_inquery();
		}
		$this->_data['page'] = 'addinq';
		
		$this->load->model('lease_programe/lease_programe_model', 'loan');
		$this->_data['loan_calculate'] = $this->loan->get_all_loan_calculate();
		$this->_data['loan_types'] = $this->loan->get_all_loan_types();
		
		$this->load->view('addnewinquery', $this->_data);
	}
	
	
	public function addnewinquery($tempid='')
	{
		//$this->_data['user_info'] = userinfo();
		if($tempid!='')
		{
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			$this->_data['t'] = 'review';
			//echo "<pre>";
			//print_r($this->_data['m']);
		}
		else
		{
			$this->_data['m'] = $this->inq->new_inquery();
		}
		$this->_data['page'] = 'addinq';
		
		$this->load->model('lease_programe/lease_programe_model', 'loan');
		$this->_data['loan_calculate'] = $this->loan->get_all_loan_calculate();
		$this->_data['loan_types'] = $this->loan->get_all_loan_types();
		
		$this->load->view('newinquery', $this->_data);
	}
	
	public function newcompany($tempid='')
	{
		$this->_data['user_info'] = userinfo();
		if($tempid!='')
		{
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			$this->_data['t'] = 'review';
		}
		else
		{
			$this->_data['m'] = $this->inq->new_inquery();
		}
		$this->_data['page'] = 'addinq';
		
		$this->load->view('newinquery', $this->_data);
	}
	
	public function newrequest($tempid	=	NULL,$step	=	NULL)
	{
		$this->_data['a_id']	= $tempid;	
		$this->_data['a_step']	= $step;			
		$this->_data['m'] = $this->inq->getRequestInfo($tempid);
		//print_r($this->_data['m']);
		if(empty($this->_data['m'])){
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			//print_r($this->_data['m']);
			$this->_data['type'] = 'inquiry';
		}
		else{
			$this->_data['type'] = 'register';
		}
		//echo "<pre>";
		//print_r($this->_data['m']);
		//echo $this->_data['type'];
		//exit;
		$this->inq->deleteTempDelete();
		$this->load->view('newrequest', $this->_data);
	}
	
	public function addnewrequest($tempid	=	NULL,$step	=	NULL)
	{
		$this->_data['a_id']	= $tempid;	
		$this->_data['a_step']	= $step;			
		$this->_data['m'] = $this->inq->getRequestInfo($tempid);
		//print_r($this->_data['m']);
		if(empty($this->_data['m'])){
			$this->_data['m'] = $this->inq->getLastDetail($tempid);
			//print_r($this->_data['m']);
			$this->_data['type'] = 'inquiry';
		}
		else{
			$this->_data['type'] = 'register';
		}
		//echo "<pre>";
		//print_r($this->_data['m']);
		//echo $this->_data['type'];
		//exit;
		$this->inq->deleteTempDelete();
		$this->load->view('newrequestinquery', $this->_data);
	}
	public function requestphasetwo($appid='')
	{
		
		if($appid)
		{
			$this->_data['app_id']	=	$appid;
			$this->_data['m'] = $this->inq->getRequestInfo($appid);
		}
		else
		{
			$this->_data['app_id']	=	'';
		}
		
		if($this->input->post())
		{
			$data = $this->input->post();
			$this->inq->updateStep($appid,$data['form_step']);
			unset($data['submit']);
			unset($data['form_step']);
			unset($data['iscomplete']);
			unset($data['review']);
			$id	= $this->inq->submit_form_two($data);
			
			echo $appid;
		}
		else
		{
			$this->load->view('requestphasetwo', $this->_data);
		}
	}
	
	function requestProjectIlust(){
		$this->load->view('requestprojectIllus_view', $this->_data);
	}
	
	function loanEvolution(){
		$this->load->view('request_loan_view', $this->_data);
	}
	public function user_applicants($user_id)
	{
	$data = $this->inq->get_app_ids($user_id);
	 
	$ids = explode(',',$data->applicants);
	 
	$this->_data['all_applicatns'] = $this->inq->get_all_applicatnts_data($ids);
	 
	$this->load->view('applicant-listing', $this->_data);
	}
	public function requestphasefive($tempid='')
	{
		$this->_data['applicant_id'] = $tempid;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($tempid);
		//echo "<pre>";
		//print_r($this->_data['applicant_data']);
		//exit;
		$appId = $this->_data['applicant_data']['applicant_loans']['0']->loan_limit;
		$this->_data['loan_data'] = $this->inq->getAmountLimit($appId);
		//echo "<pre>";
		//print_r($this->_data['loan_data']);
		
		//exit;
		$this->load->view('requestphasefive', $this->_data);
	}
	
		public function updatezyarat($tempid,$zyarat_id='')
	{
		$this->_data['applicant_id'] = $tempid;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($tempid);
		if($zyarat_id !=""){
			$this->_data['zyarat_data'] = $this->inq->getZyaratDetails($zyarat_id,'zyarat');
		    $this->_data['zyarat_count'] = count($this->_data['zyarat_data']);
		}
		else{
			$this->_data['zyarat_data'] = '';
			$zyarat_data = $this->inq->getZyaratDetails($tempid,'');
			//print_r($zyarat_data);
			$zyarat_count = count($zyarat_data);
			$this->_data['zyarat_count'] = $zyarat_count++;
		}
		
		$this->load->view('zyarat_form', $this->_data);
	}
	
	function downloadFile($name){
			$this->load->helper('download');
			$path= $_SERVER['DOCUMENT_ROOT'].'/2015/lm7DEC2014/upload_files/documents/';
			$filepath= $_SERVER['DOCUMENT_ROOT'].'/2015/lm7DEC2014/upload_files/documents/'.$name;
			if(file_exists($filepath)){
				$data = file_get_contents($filepath); // Read the file's contents
				//$name = 'myphoto.jpg';
				force_download($name, $data);
				
			}
			//$data = file_get_contents("/path/to/photo.jpg"); // Read the file's contents
			//$name = 'myphoto.jpg';
			//force_download($name, $data);
		
	}
	public function requestphaseSeven($tempid='')
	{
		$this->_data['applicant_id'] = '';
		//$this->_data['applicant_data'] = $this->inq->getRequestInfo($tempid);
		$this->load->view('requestphaseseven', $this->_data);
	}
	
	function requestPhase(){
		//echo "sdfsdf";
		$this->load->view('requestphasefive');
	}
	
	function listingcomitees(){
		
		$this->_data['all_applicatns']	=	$this->inq->getFourthStepData();
		$this->load->view('listingcometti_view', $this->_data);
	}
	
	
	function listingaproval(){
		
		$this->_data['all_applicatns']	=	$this->inq->getComitteTypeData('approved');//$this->inq->getAprovalStepData();
		//print_r($this->_data['all_applicatns']);
		//exit;
		$this->load->view('listingaprovali_view', $this->_data);
	}
	
	function requestmuwafiqawalia($id){
		$this->_data['applicant_id'] = $id;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
			//print_r($this->_data['applicant_data']->gurantee_val);

		$this->_data['guarantee_data'] = $this->inq->getGuarantee_data($id);
		//echo "<pre>";
		//print_r($this->_data['guarantee_data']);
		$this->load->view('requestmuwafiqawalia', $this->_data);

	}
	function add_request(){
		$data = $this->input->post();
			//echo "<pre>";
			//print_r($data);
			//exit;
			$newData['gurantee_val']= json_encode($data['gurantee_val']);
			$newData['instalment_points']= json_encode($data['instalment_points']);
			$newData['applicant_id'] = $data['applicant_id'];
			$newData['conditions'] = $data['conditions'];
			$newData['attachment'] = $data['attachment'];
			$newData['user_id']  		=  $this->session->userdata('userid');	
			unset($data['form_step']);
			//exit;
			$applicant_id = $data['applicant_id'];	
			$result = $this->inq->check_record('guanttee_required',$applicant_id);
			//print_r($newData);
			//print_r($result);
			//exit;
			if(!empty($result)){
				$this->db->where('applicant_id',$data['applicant_id']);
				return $this->db->update('guanttee_required',$newData);
			}
			else{
				return $this->db->insert('guanttee_required',$newData);
			}
			
	}
	function update_muwafiq(){
		
	}
	
	function get_check_list($id){
		$this->_data['checkList'] = $this->inq->getcheckList($id);
		$this->_data['appId'] = $id;
		$this->load->view('checklist_view', $this->_data);
	}
	
	function updatecheckList(){
			$data = $this->input->post();
			//echo "<pre>";
			//print_r($data);
			//echo $data['appId'];
			$chkListArr = $this->inq->getcheckList($data['appId']);
			//print_r($chkListArr);
		
			//echo $data['val'];
			if(!empty($chkListArr)){
				
				$updateData = array(
				$data['id']=>$data['val']
				);
				$this->db->where('applicant_id',$data['appId']);
				return $this->db->update('check_list',$updateData);
			}
			else{
				$insertData[$data['id']] = $data['val'];
				$insertData['applicant_id'] = $data['appId'];
				return $this->db->insert('check_list',$insertData);
			}
	}
	

	function updatefinacialList(){
			$data = $this->input->post();
			$insertData[$data['id']] = $data['val'];
			$insertData['applicant_id'] = $data['appId'];
			//echo  $this->inq->addUpdate('finance_project',$insertData);
			echo $this->inq->checkData('finance_project','applicant_id','applicant_id',$data['appId']);
		
	}
	
	function listingpayments(){
		
		$this->_data['all_applicatns']	=	$this->inq->getFifthStepData();
		//print_r($this->_data['all_applicatns']);
		//exit;
		$this->load->view('listingpayment_view', $this->_data);
	}
	
	
	function listingrejected(){
		
		$this->_data['all_applicatns']	=	$this->inq->getComitteTypeData('rejected');
		$this->_data['applicant_type']	='rejected';
		//echo "<pre>";
		//print_r($this->_data['all_applicatns']);
		
		$this->load->view('listingcometti_rejectedview', $this->_data);
	}
	function listingpostponed(){
		
		$this->_data['all_applicatns']	=	$this->inq->getComitteTypeData('postponed');
		$this->_data['applicant_type']	='postponed';
		$this->load->view('listingcometti_rejectedview', $this->_data);
	}
	
	function listingzyarat(){
		
		$this->_data['all_applicatns']	=	$this->inq->getZyaratawalia();
		$this->load->view('listingzyarat', $this->_data);
	}
	
	function viewzyaratlist($id){
		$this->_data['app_id']	= $id;
		$this->_data['all_applicatns']	=	$this->inq->getZyaratlist($id);
		$this->load->view('viewingzyarat', $this->_data);
	}
	
	
	function getmuwafiq(){
		$data	=	$this->input->post();
		$this->_data['counter'] = $data['counter'];
		$this->_data['zyara_counter'] = $data['zyara_counter'];
		$this->_data['i'] = $data['ind'];
		$this->load->view('ajaxzyrart', $this->_data);
	}
	
	function remove_zyara(){
		$data	=	$this->input->post();
		//echo "<pre>";
		//print_r($data);
		$data['zyarat_id'];
		$this->db->where("zyarat_id",$data['zyarat_id']);
		echo $this->db->delete('zyarat_awalia');
	}
	
	function listingmashrooa(){
		
		$this->_data['all_applicatns']	=	$this->inq->getFourthStepData();
		$this->load->view('listingcometti_view', $this->_data);
	}
	function listingmashroota(){
		$this->_data['all_applicatns']	=$this->inq->getMashroota();
		//echo '<pre>'; print_r($this->_data['all_applicatns']);
		$this->load->view('listingmashroo_view', $this->_data);
	}
	function is_complete()
	{
		$this->_data['all_applicatns']	=$this->inq->getIsComplete();
		//echo '<pre>'; print_r($this->_data['all_applicatns']);
		$this->load->view('listingcomplete_view', $this->_data);
	}
	function update_complete($tempid,$zyarat='')
	{
		$this->_data['applicant_id'] = $tempid;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($tempid);
		if($zyarat_id !=""){
			$this->_data['zyarat_data'] = $this->inq->getZyaratDetails($zyarat_id,'zyarat');
		    $this->_data['zyarat_count'] = count($this->_data['zyarat_data']);
		}
		else{
			$this->_data['zyarat_data'] = '';
			//echo "<pre>";
			$this->_data['zyarat_data']  = $this->inq->getZyaratDetails($tempid,'');
			//print_r($this->_data['zyarat_data']);
			$zyarat_count = count($this->_data['zyarat_data']);
			$this->_data['zyarat_count'] = $zyarat_count++;
			$zyarat_count = $zyarat_count-1;
			//$this->_data['zyarat_data'][$zyarat_count];
			
			//print_r($this->_data['zyarat_data'][$zyarat_count]);
		}
		
		$this->load->view('zyarat_decision_form', $this->_data);
		
	}

	public function requestphasefour($appid	=	NULL)
	{
		if($appid)
		{
			$this->_data['app_id']	=	$appid;
			$this->_data['m'] = $this->inq->getRequestInfo($appid);
		}
		else
		{
			$this->_data['app_id']	=	'';
		}
			
			if($this->input->post())
			{
				$data	=	$this->input->post();
				
				//echo "<pre>";
				//echo print_r($_POST);
				//exit;
				$data['monthly_installment'] = json_encode($data['monthly_installment']);
				$data['residual'] = json_encode($data['residual']);
				$data['amount_paid'] = json_encode($data['amount_paid']);
				$data['loan_amount'] = json_encode($data['loan_amount']);
				$data['financing'] = json_encode($data['financing']);
				$data['amount_problem'] = json_encode($data['amount_problem']);
				$data['musanif_notes'] = json_encode($data['musanif_notes']);
				$data['document_file'] = json_encode($data['document_file']);
				
				$this->inq->updateStep($appid,$data['form_step']);
				
				unset($data['submit']);
				unset($data['form_step']);
				unset($data['iscomplete']);
				
				$id	=	$this->inq->submit_form_four($data);
				//print_r($data);
				exit;
				
				echo $appid;
			}
			else
			{
				$this->load->view('requestphasefour', $this->_data);
			}
		
	}	
	
	
	function updateFileSession(){
		
		$postData = $this->input->post();
		//echo "<pre>";
		//print_r($postData);
		//$postData['fileId'];
		 $this->session->set_userdata('fileSesionName',$postData['fileId']);
	}
	function uploadDocument(){
		$postData = $this->input->post();
		 $fileSesionName = $this->session->userdata('fileSesionName');
		//echo "<pre>";
		 $fileSesionName;
		//print_r($_GET);
		//print_r($_POST);
		//print_r($_FILES);
		/*if($fileSesionName  == 'document_id_1'){
			$f = 1;
		}
		elseif($fileSesionName  == 'document_id_2'){
			$f = 2;
		}
		elseif($fileSesionName  == 'document_id_3'){
			$f = 3;
		}
		elseif($fileSesionName  == 'document_id_4'){
			$f = 4;
		}
		elseif($fileSesionName  == 'document_id_5'){
			$f = 5;
		}
		elseif($fileSesionName  == 'document_id_6'){
			$f = 6;
		}
		elseif($fileSesionName  == 'document_id_7'){
			$f = 7;
		}
		elseif($fileSesionName  == 'document_id_8'){
			$f = 8;
		}*/
		
		//
		//echo "<pre>";
		$session = explode('_',$fileSesionName);
		//print_r($session);
		//exit;
		
		$f= $session[2];
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$name = generateCode();
		$newname  =  $name.'.'.$ext;
		$targetPath = "./upload_files/documents/".$newname;
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)){
			//echo $newname;
			echo json_encode(array('status' => 'ok','name' => $newname,'type' => $f));
		}
		else{
			echo json_encode(array('status' => 'error'));
		}
		
		
		
		//print_r($postData);
		//	echo json_encode(array('status' => 'ok'));
	}
	
	function attachment($id){
		 $this->_data['mustarik']	=	$id;
		$this->load->view('view_attachment', $this->_data);
	}
	function requestchagephasefive($applicant_id=NULL){
		if($applicant_id)
		{
			$this->_data['applicant_id']	=	$applicant_id;
			$this->_data['get_result'] = $this->inq->getInquiresOfRequestChangePhaseFive($applicant_id);
		}
		else
		{
			$this->_data['get_result']	=	'';
		}
		$this->load->view('requeschangetphasefive', $this->_data);
	}
	
	/*
	* update info of applicant comitte_decision
	* @param int $applicant_id
	* Created by M.Ahmed
	*/
	function udpate_request_change_phase_five(){
		if($this->input->post())
		{
			$data = $this->input->post();
			$this->inq->udpate_request_change_phase_five_valus($data);
			//unset($data['submit']);
			//unset($data['form_step']);
			//unset($data['iscomplete']);
			//unset($data['review']);
			//$id	= $this->inq->submit_form_two($data);
			//echo $appid;
		}
	}
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function findExtension($filename)
{
   $filename = strtolower($filename) ;
   $exts = explode(".", $filename) ;
   $n = count($exts)-1;
   $exts = $exts[$n];
   return $exts;
}
	function uploadFile(){
		
		//echo "<pre>";
		//$post = $this->input->post();
		//print_r($post);
		$file = $_FILES['file']['name'];
		$name = $this->generateRandomString(5);
		$ext = $this->findExtension($file);
		 $filename = $name.".".$ext;
		//exit;
		if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload_files/documents/'.$filename)){
			echo json_encode(array('status' => 'ok','filename'=>$filename));
		}
		else{
			echo json_encode(array('status' => 'error'));
		}
		
	}
	function requestphasesix(){
		$this->load->view('requesphasesix', $this->_data);
	}
	
	function listingprelimanryAproval(){
		$this->load->view('listingaproval_view', $this->_data);
	}
	
	
	public function resetinq()
	{	$this->inq->reset_inquery();	}

	function getInquirysms($type = 'sms'){
		
					//exit();
		$inqSms = $this->inq->getInquiriesSms($type);
		//echo "<pre>";
		//print_r($inqSms);
		//exit();
		if($this->input->post('submit'))
		{
		//-----------------------------------------------------------------
			$form_data		=	$this->input->post();
			unset($form_data['submit']);
			
			$firstData	=	array();
			$count		=	count($this->inq->getInquiriesSms('sms'));
			
			for($i=1;$i<=$count;$i++)
			{
				$sms_reminder	=	'sms_reminder_type_'.$i;
				$reminder_count	=	'reminder_count_'.$i;
				$sms_value		=	'sms_value_'.$i;
				$sms_id			=	'sms_id_'.$i;

				$firstData['sms_remider'] 			= $form_data[$sms_reminder];
				$firstData['sms_reminder_counter'] 	= $form_data[$reminder_count];
				$firstData['sms_value'] 			= $form_data[$sms_value];
				
				$condition = array('sms_id'=>$form_data[$sms_id]);
				$return	=	$this->inq->update_db('sms_management',$firstData,$condition);


			}
		
		//-----------------------------------------------------------------


			//echo "if";
			/*unset($data['submit']);
			
			$data		=	$this->input->post();
			echo '<pre>'; print_r($data);exit();
			$firstData['sms_remider'] = $data['sms_reminder_type'];
			$firstData['sms_reminder_counter'] = $data['reminder_count'];
			$firstData['sms_value'] = $data['expiry_msg'];
			$condition = array('sms_id'=>$data['expiry_id']);
 			$this->inq->update_db('sms_management',$firstData,$condition);

			$firstData['sms_register_count'] = $data['register_count'];
			$firstData['sms_register'] = $data['sms_register'];
			$firstData['sms_value'] = $data['thank_msg'];
			$condition = array('sms_id'=>$data['thanks_id']);
 			$return = $this->inq->update_db('sms_management',$firstData,$condition);*/
			
			/******************************************************************/
			
			/*$firstData['sms_remider'] = $data['sms_reminder_type'];
			$firstData['sms_reminder_counter'] = $data['reminder_count'];*/
			/*$firstData['sms_value'] = $data['step_1_msg'];
			$condition = array('sms_id'=>$data['step_1']);
 			$this->inq->update_db('sms_management',$firstData,$condition);*/
			
			if($return)
			{
				$this->session->set_flashdata('msg', 'S');	
			}
			else
			{
			//echo "else";
			//$this->session->set_session('msg', 'E');
			$this->session->set_flashdata('msg', 'E');	
			}
			//$this->session->set_session('msg', 'S');
			
			// UNSET ARRAY key
			$this->_data['page'] = 'addinqsms';
			redirect('inquiries/getInquirysms');
				//exit;
		}
		
		$this->_data['inq_info_sms']	=	$inqSms;		
		$this->load->view('inqType', $this->_data);
	
	}
	
	
	function sendms(){
		$numbers = array('96898824404','96893338241');
		echo send_sms('1',$numbers,'mesage');
		//echo send_sms(1,$numbers,1,'');
		//echo send_sms_code(1,'96893338241');
	}
	
	
	

	//-------------------------------------------------------------------------------

	/*
	*
	* Add List Detail
	*/
	public function add($listid	= NULL)
	{
		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		
		if($this->input->post())
		{
			
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
					redirect(base_url()."inquiries/listing");
					exit();
				}
				
			}
			else
			{

				$this->listing->add_list($data);
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
					redirect(base_url()."inquiries/listing");
					exit();
				}

			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('inquiries/add', $this->_data);
		}
		
	}
	//-------------------------------------------------------------------------------

	/*
	*
	* Add List Detail
	*/
	public function addrules1($listid	= NULL)
	{
		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		
		if($this->input->post())
		{
			
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				
				$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				redirect(base_url()."inquiries/listing");
				exit();
				
			}
			else
			{
				$this->listing->add_list($data);
				
				$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				redirect(base_url()."inquiries/listing");
				exit();
			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('inquiries/rules-listing', $this->_data);
		}
		
	}

//-------------------------------------------------------------------------------

	/*
	*
	* Listing Page
	*/
	public function listing($type	=	NULL)
	{
		if($type)
		{
			// Get List Name By Type
			$this->_data['listing']	=	$this->listing->by_type($type);
			
			$this->_data['list_type_name']	=	$type;
			
			$this->load->view('type-listing', $this->_data);
		}
		else
		{ 
			$this->_data['marital_count']	=	$this->listing->total_count('maritalstatus');
			$this->_data['situation_count']	=	$this->listing->total_count('current_situation');
			$this->_data['inquiry_type']	=	$this->listing->total_count('inquiry_type');
			
			$this->load->view('listing', $this->_data);
		}
		
		
	}
	//-------------------------------------------------------------------------------

	/*
	*
	* Listing Page
	*/
	public function types_listing($type	=	NULL)
	{
		if($type)
		{
			// Get List Name By Type
			$this->_data['listing']	=	$this->listing->by_type($type);
			
			$this->_data['list_type_name']	=	$type;
			
			$this->load->view('types-listing', $this->_data);
		}
		else
		{
			$this->load->view('typeslisting', $this->_data);
		}
		
		
	}
	
	/*
	*
	* Listing Page
	*/
	public function getList($type = 'sms')
	{
		$this->_data['sms']	= $this->inq->getSms(1,$type);
		//echo "<pre>";
		///print_r($sms);
		$this->load->view('listingsms', $this->_data);
		
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Child Listing
	*/
	public function child_listing($listid	=	NULL)
	{
		$this->_data['parent_id']	=	$listid;
		
		$this->_data['listing']	=	$this->listing->get_child_listing($listid);

		
		$this->load->view('child-type-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Child Listing
	*/
	public function types_child_listing($listid	=	NULL)
	{
		
		$this->_data['listing']	=	$this->listing->get_child_listing($listid);

		
		$this->load->view('types-child-type-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Subchild Listing Page
	*/
	public function sub_child_listing($listid	=	NULL)
	{
		$this->_data['listing']	=	$this->listing->get_subchild_listing($listid);

		
		$this->load->view('subchilds-type-listing', $this->_data);
	}
	//-------------------------------------------------------------------------------

	/*
	*
	* Subchild Listing Page
	*/
	public function types_sub_child_listing($listid	=	NULL)
	{
		$this->_data['listing']	=	$this->listing->get_subchild_listing($listid);

		
		$this->load->view('subchilds-type-listing', $this->_data);
	}
//-------------------------------------------------------------------------------	
	function add_new()
	{
		$parent_id	=	$this->input->post("parent_id");
		$add_sub	=	$this->input->post("add_sub");
		
		$data	=	array("list_parent_id"=>$parent_id,"list_name"=>$add_sub);
		
		$this->listing->add_list_child($data);		
	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function other()
	{
		$list_id	=	$this->input->post("id");
		$entry		=	$this->input->post("entry");
		
		$data		=	array('other' => $entry);

		$this->listing->update_record($list_id, $data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function addrules($listid	=	NULL)
	{

		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		
		if($this->input->post())
		{
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				
				$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				redirect(base_url()."inquiries/rules");
				exit();
			}
			else
			{
				$this->listing->add_list($data);
				
				$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				redirect(base_url()."inquiries/rules");
				exit();
			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('inquiries/add-rule', $this->_data);
		}
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function rules()
	{
		$this->_data['listing']	=	$this->listing->get_rules();
		
		$this->load->view('rules-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function add_qualification($listid	=	NULL)
	{

		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		
		if($this->input->post())
		{
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
					redirect(base_url()."inquiries/qualification_listing");
					exit();
				}
			}
			else
			{
				$this->listing->add_list($data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
					redirect(base_url()."inquiries/qualification_listing");
					exit();
				}
			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('inquiries/add-qualification', $this->_data);
		}
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function qualification_listing()
	{
		$this->_data['listing']	=	$this->listing->get_qualification();
		
		$this->load->view('qualification-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function add_rules_qualification($listid	=	NULL)
	{

		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		
		if($this->input->post())
		{
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
					redirect(base_url()."inquiries/rule_qualification_listing");
					exit();
				}
				

			}
			else
			{
				$this->listing->add_list($data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
					redirect(base_url()."inquiries/rule_qualification_listing");
					exit();
				}
			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('inquiries/add-rules-qualification', $this->_data);
		}
	}	
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function rule_qualification_listing($type	=	NULL)
	{

		if($type)
		{	
			// Get List Name By Type
			$this->_data['listing']	=	$this->listing->rules_qualification_by_type($type);
			$this->_data['list_type_name']	=	$type;

			$this->load->view('rule-qualification-type-listing', $this->_data);
		}
		else
		{
			$this->_data['listing']	=	$this->listing->get_rule_qualification();
			
			$this->load->view('rule-qualification-listing', $this->_data);
		}
		
		
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add Rule Form
	*/
	public function add_user_registeration($userid	=	NULL)
	{
		if($userid)
		{
			$this->_data['single_user']	=	$this->inq->get_single_user($userid);
			//print_r($this->_data['single_user']);	
		}
		
		if($this->input->post())
		{
			$data		=	$this->input->post();
			
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('id'))
			{
				unset($data['confirm_password']);
				//unset($data['password']);
				if($this->input->post('password')){
					$data['password']	=	md5($this->input->post('password'));				
				}
				$this->inq->update_user($this->input->post('id'),$data);				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
					redirect(base_url()."inquiries/add_user_registeration");
					exit();
				}
				

			}
			else
			{
				unset($data['confirm_password']);
				
				$data['password']	=	md5($this->input->post('password'));
				$this->inq->add_user_registration($data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
					redirect(base_url()."inquiries/add_user_registeration");
					exit();
				}
			}
		}
		else
		{
			$this->load->view('user-registration', $this->_data);
		}
	}
	
	/*
	*
	* Add Rule Form
	*/
	public function add_bank_registeration($userid	=	NULL)
	{
		if($userid)
		{
			$this->_data['single_user']	=	$this->inq->get_single_user($userid);
			//print_r($this->_data['single_user']);	
		}
		
		if($this->input->post())
		{
			$data		=	$this->input->post();
			
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('id'))
			{
				unset($data['confirm_password']);
				//unset($data['password']);
				if($this->input->post('password')){
					$data['password']	=	md5($this->input->post('password'));				
				}
				$this->inq->update_user($this->input->post('id'),$data);				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
					redirect(base_url()."inquiries/add_bank_registeration");
					exit();
				}
				

			}
			else
			{
				unset($data['confirm_password']);
				
				$data['password']	=	md5($this->input->post('password'));
				$this->inq->add_user_registration($data);
				
				if ($this->is_ajax())
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				}
				else
				{
					$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
					redirect(base_url()."inquiries/add_bank_registeration");
					exit();
				}
			}
		}
		else
		{
			$this->load->view('bank-registration', $this->_data);
		}
	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_child($childlistid)
	{
		$this->listing->delete_child($childlistid);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'listing_managment/listing/');
		exit();

	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete($listid,$type)
	{
		$this->listing->delete($listid);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'inquiries/listing/'.$type);
		exit();

	}
//-------------------------------------------------------------------------------	
	public function get_list_data()
	{
		$list_id	=	$this->input->post('id');
		
		$data	=	$this->listing->get_list_data($list_id);
		

		echo  $data	=	json_encode(array('list_id'	=>	$data->list_id,'list_name'	=>	$data->list_name,'list_type'	=>	$data->list_type,'list_status'	=>	$data->list_status));
		
	}		
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_rule($listid)
	{
		$this->inq->delete_rule($listid);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'inquiries/rules/');
		exit();

	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_applicant($applicant_id)
	{
		$this->inq->delete_applicant($applicant_id);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'inquiries/transactions');
		exit();

	}
	
	public function transactionsprint()
	{
		$this->_data['all_applicatns']	=	$this->inq->get_all_applicatnts();
		
		$this->load->view('transactions-printlisting', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_auditor($auditor_id)
	{
		$this->inq->delete_auditor($auditor_id);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'inquiries/transactions');
		exit();

	}
	//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_user($user_id)
	{
		$this->inq->delete_user($user_id);
	}

//-------------------------------------------------------------------------------
	/*
	*
	*/
	public function transactions()
	{
		$this->_data['all_applicatns']	=	$this->inq->get_all_applicatnts();
		
		//echo "<pre>";
		//print_r($this->_data['all_applicatns']);
		
		$this->load->view('transactions-listing', $this->_data);
	}
	
	public function rejected_applicants()
	{
		$this->_data['all_applicatns']	=	$this->inq->get_all_reject_bank();
		
		//echo "<pre>";
		//print_r($this->_data['all_applicatns']);
		
		$this->load->view('rejected-listing', $this->_data);
	}
	
	
	public function comitte_descions()
	{
		$this->_data['all_descisions']	=	$this->inq->get_all_decisions();
		
		$this->load->view('transactions-listing', $this->_data);
	}		
//-------------------------------------------------------------------------------
	/*
	*
	*/
	public function get_applicant_data($applicantid	=	NULL)
	{
		$this->_data['applicatn_info']	=	$this->inq->get_single_applicatnt($applicantid);
		
		echo $HTML	=	$this->load->view('ajax-response-html', $this->_data,TRUE);
	}
	
	function getHistory($applicantid	=	NULL){
				
		$this->load->model('ajax/ajax_model', 'ajax');		
	    $this->_data['history'] =	$this->ajax->getHistory($applicantid);
		echo $HTML	=	$this->load->view('ajax-history-response-html', $this->_data,TRUE);
	}
//-------------------------------------------------------------------------------
	/*
	*
	*/
	public function get_auditor_data($auditorid	=	NULL)
	{
		//echo $auditorid;
		//exit;
		$this->_data['auditor_info']	=	$this->inq->get_single_auditor($auditorid);
		$this->_data['main_info']	=	$this->inq->get_main_info($auditorid);
		
		echo $HTML	=	$this->load->view('ajax-inquiries-response-html', $this->_data,TRUE);
	}	
	
//-------------------------------------------------------------------------------
function is_ajax() 
{
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

	public function history()
	{
		$data			=	$this->inq->get_last_note('107');
		
		if($data->inquerytype)
		{
			$type_string	=	rtrim($data->inquerytype,',');
			$types_array 	=	explode(",", $type_string);
			$array_size		=	sizeof($types_array);
			
			if($array_size > 0)
			{
				$last_arry_key	=	end(array_keys($types_array));
				
				$last_array		=	$types_array[$last_arry_key] ;
				
				$type_id		=	explode("_", $last_array);
				
				$type_name	=	$this->inq->get_type_name($type_id['0']);
			}
			
		}
	}
}


?>