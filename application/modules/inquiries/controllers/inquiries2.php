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
	
		public function requestphasethree($appid	=	NULL)
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
		
	public function add_data_into_main($tempid)
	{
		$this->inq->add_data_into_main($tempid);
		
		//$this->load->view('home', $this->_data);
	}	
	
	
	function sendSms(){
		
		//$message = $_POST['message'];
		//echo "<pre>";
		//print_r($_POST);
		$dateTime =  $this->input->post('dateTime');
		//	echo strtotime($dateTime);
		//exit;
			$id = $this->input->post('id');
			$message = $this->input->post('message');
			$sms_time = $this->input->post('sms_time');
			$dateTime = $this->input->post('dateTime');
			$message = $this->input->post('message');
			$numbers = get_mobilenumbers($id);
		
		if($sms_time){	
			//echo "if";	
			$message = $this->input->post('message');
			$return = send_custom_sms($message,$numbers);
			$dateTime = strtotime(date('Y-m-d h:m:s'));
			if(strstr($return,'1')){
			
			}
			$sms_time_type = 'Now';
		}
		else{
			//echo "else";
			$dateTime =  $this->input->post('dateTime');
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
					$myData['sms_module_id'] = 1;
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
	
	function comittie_decision(){
		//	echo "<pre>";
		//print_r($_POST);
		//print_r($this->input->post());
		$data = $this->input->post();
		//print_r($data);
		$return = $this->db->insert('comitte_decision',$data);
		//exit;
		
		if($return){
			$this->session->set_flashdata('msg', 'S');	
		}
		redirect('inquiries/requestphasefive');
	}
	
	function add_evolution_data(){
			//$data['age'] = $_POST['datepicker'];
			//unset($_POST['datepicker']);
			$data = $_POST;
			echo "<pre>";
			print_r($data);
			exit;
			$return = $this->db->insert('project_evolution',$data);
			if($return){
				$this->session->set_flashdata('msg', 'S');	
			}
			redirect('inquiries/loanEvolution');

		
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
		$this->inq->deleteTempDelete();
		$this->load->view('newrequest', $this->_data);
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
	
	public function requestphasefive($tempid='')
	{
		$this->_data['applicant_id'] = $tempid;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($tempid);
		$this->load->view('requestphasefive', $this->_data);
	}
	
	function requestPhase(){
		//echo "sdfsdf";
		$this->load->view('requestphasefive');
	}
	
	function listingcomitees(){
		
		$this->_data['all_applicatns']	=	$this->inq->getFourthStepData();
		$this->load->view('listingcometti_view', $this->_data);
	}
	
	function listingmashrooa(){
		
		$this->_data['all_applicatns']	=	$this->inq->getFourthStepData();
		$this->load->view('listingcometti_view', $this->_data);
	}
	function listingmashroota(){
		$this->_data['all_applicatns']	=$this->inq->getMashroota();
		$this->load->view('listingmashroo_view', $this->_data);
	}
	//
	public function requestphasefour($appid	=	NULL)
	{
		if($appid)
		{
			$this->_data['app_id']	=	$appid;
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
				$data['musanif_notes'] = json_encode($data['musanif_notes']);
				//print_r($data);
				//exit;
				
				$this->inq->updateStep($appid,$data['form_step']);
				
				unset($data['submit']);
				unset($data['form_step']);
				unset($data['iscomplete']);
				
				$id	=	$this->inq->submit_form_four($data);
				echo $appid;
			}
			else
			{
				$this->load->view('requestphasefour', $this->_data);
			}
		
	}	
	
	function requestchagephasefive(){
		$this->load->view('requeschangetphasefive', $this->_data);
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
		$inqSms = $this->inq->getInquiriesSms($type);
		//echo "<pre>";
		//print_r($inqSms);
		if($this->input->post('submit'))
		{
			//echo "if";
			unset($data['submit']);
			
			$data		=	$this->input->post();
			$firstData['sms_remider'] = $data['sms_reminder_type'];
			$firstData['sms_reminder_counter'] = $data['reminder_count'];
			$firstData['sms_value'] = $data['expiry_msg'];
			$condition = array('sms_id'=>$data['expiry_id']);
 			$this->inq->update_db('sms_management',$firstData,$condition);
			
			
			//echo "<pre>";
			//print_r($_POST);
			//exit;
			$firstData['sms_register_count'] = $data['register_count'];
			$firstData['sms_register'] = $data['sms_register'];
			$firstData['sms_value'] = $data['thank_msg'];
			$condition = array('sms_id'=>$data['thanks_id']);
 			$return = $this->inq->update_db('sms_management',$firstData,$condition);
			
			if($return){
				$this->session->set_flashdata('msg', 'S');	
			}
			else{
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
				
				$data['password']	=	md5($this->input->post('password'));				
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
	*
	*/
	public function transactions()
	{
		$this->_data['all_applicatns']	=	$this->inq->get_all_applicatnts();
		
		$this->load->view('transactions-listing', $this->_data);
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