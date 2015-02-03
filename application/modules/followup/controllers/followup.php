<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Followup extends CI_Controller 

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

		$this->load->model('followup_model', 'follow');

		

		$this->_data['module'] = get_module();
        check_permission($this->_data['module'],'v');


		$this->_data['user_info']	=	userinfo();
		

		

	}

	

//-------------------------------------------------------------------------------



	/*

	*

	* Main Page

	*/

	public function index()

	{
	
		$bank_data	= $this->follow->get_bank_data();
		//$uids = $bank_data->uids;
		//print_r($bank_data);
		 $regno = $bank_data->regno;
		$civilno = $bank_data->civilno;
		
		if($regno !="" || $civilno!="")
		$this->_data['all_applicatns']  = $this->follow->getCompleteFollowData($regno,$civilno);
		else
		$this->_data['all_applicatns']  = "";
		//exit;
		//print_r($this->_data['all_applicatns']);
		//exit;
		//$this->load->model('inquiries/inquiries_model', 'inq');
		//$this->_data['all_applicatns']	=	$this->inq->getAprovalStepData();
		$this->load->view('followup_list', $this->_data);
	

	}
	
	function banklist(){
			$this->_data['all_applicatns']  = $this->follow->getAllBankData();
			$this->load->view('bank_list', $this->_data);
	}
	function uploadeFile(){
		
		//print_r($this->_data['all_applicatns']);
		//exit;
		//$this->load->model('inquiries/inquiries_model', 'inq');
		//$this->_data['all_applicatns']	=	$this->inq->getAprovalStepData();
		$this->load->view('bank_upload_file', $this->_data);
	}
	function add_excel(){
		
		//echo "<pre>";
		//print_r($_FILES);
		//exit;
		$name = $_FILES['file']['name'];
		$name_var = explode('.',$name);
		$name_var[1];
		$ff = rand();
		$new_name = $ff.'.'.$name_var[1];
		//exit;
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size']	= '0';
		$config['file_name'] = $new_name;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			//echo "error";
			$error = array('error' => $this->upload->display_errors());
			//echo "<pre>";
			//print_r($error);
			echo json_encode(array('status' =>$this->upload->display_errors()));
		}
		else
		{
			
			//echo "success";	
			$data = array('upload_data' => $this->upload->data());
			
			$this->readuploadedfile($new_name);
			//echo "<pre>";
			//print_r($data);

		}	
		
		
	}
	
	function readuploadedfile($new_name){
	
			
		$file = './uploads/'.$new_name;
//load the excel library
$this->load->library('excel');
//read file from path
$objPHPExcel = PHPExcel_IOFactory::load($file);

//get only the Cell Collection
for($a=1;$a<=5;$a++){
$objPHPExcel->setActiveSheetIndex($a);
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
//echo "<pre>";
//print_r($cell_collection);
//extract to a PHP readable array format
foreach ($cell_collection as $cell) {
//	print_r($cell);
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    //print_r($column);
	$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    //print_r($row);
	//if($column == 'I'){
		
	//	echo $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getFormattedValue();
	//}
	//else{
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		
	//}
	
	//if(PHPExcel_Shared_Date::isDateTime($cell)) {
  //echo    $InvDate = date($format, PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
	//}
	//print_r($data_value);
	//echo "<br>";
	//header will/should be in row 1 only. of course this can be modified to suit your need.
    if ($row == 1) {
        $header[$row][$column] = $data_value;
    } else {
		
        $arr_data[$row][$column] = $data_value;
    }
}
//send the data in an array format
	 $data['header'] = $header;
	 $data['values'] = $arr_data;
	//print_r($data['header']); 
	//print_r($data['values']); 
	$check_header = $data['header'][1];
	//print_r($check_header);
	if($a == 1){
	if(in_array('CIVIL_ID',$check_header)){
		if(!empty($data['values'])){
		$ind = 2;
		foreach($data['values'] as $value){
			
			//echo "<pre>";
		//	print_r($value);
			
			$sequenceId = $value['D'];
			$regno = $value['H'];
			$return  = $this->follow->check_data($sequenceId,$regno);					
			
			$importData['REC_TYPE'] = $value['A'];
			$importData['BRCH_CODE'] = $value['B'];
			$importData['BRCH_S_DESC'] = $value['C'];
			$importData['ILOM_SEQUENCE'] = $value['D'];
			$importData['LOAN_STATUS'] = $value['E'];
			$importData['CUST_S_NAME'] = $value['F'];
			$importData['CIVIL_ID'] = $value['G'];
			$importData['COMM_REG_NO'] = $value['H'];
			
			//$str = trim($value['I']);
			$cell2 = 'I'.$ind;
			$cell3 = 'M'.$ind;
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell2)->getFormattedValue();
			$data_value3 = $objPHPExcel->getActiveSheet()->getCell($cell3)->getFormattedValue();
			$importData['ILOM_VAL_TRS_DATE'] = $data_value;
			//echo $date = date('Y-m-d',strtotime($str));
			$importData['COMM_REG_NO'] = $value['H'];
			$importData['ILOM_AMOUNT'] = $value['J'];
			$importData['ILOM_WITHDRAWN_AMOUNT'] = $value['K'];
			$importData['REMAIN_DISB'] = $value['L'];
			$importData['ILOM_DRAWDOWN_LMT_DATE'] = $data_value3;
			//print_r($importData);		
			if($return){
				//echo "if";
				//print_r($importData);
				$this->follow->updateRecord($importData,'bank_loan_list','list_id',$return);
			
			}else{
				//echo "else";
				//$this->follow->updateRecord($importData,'bank_loan_list','list_id',$return);
				$this->follow->insertRecord($importData,'bank_loan_list');
			}
			$ind++;
		}
			//exit;	
	}
		}
	}
	if($a == 2){
		//echo "<pre>";
		$check_header = $data['header'][1];
		//print_r($check_header);
		//print_r($data['values']);
		if(in_array('LG_AMT',$check_header)){
			if(!empty($data['values'])){
				$ind =2;
				foreach($data['values'] as $value){
					
					$importData = array();
					$importData['REC_TYPE'] = $value['A'];
					$importData['ILOM_SEQUENCE'] = $value['B'];
					$importData['LG_NUMBER'] = $value['C'];
					$importData['LG_AMT'] = $value['D'];
					$importData['SUPPLIER_NAME'] = $value['E'];
					
					$cell2 = 'F'.$ind;
					$cell3 = 'G'.$ind;
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell2)->getFormattedValue();
					$data_value3 = $objPHPExcel->getActiveSheet()->getCell($cell3)->getFormattedValue();
			
					$importData['LG_DATE_FROM'] = $data_value;
					$importData['LG_DATE_TO'] = $data_value3;
					
					$return  = $this->follow->check_sequance($importData['ILOM_SEQUENCE'],'bank_gurantee');	
					if($return){
						$this->follow->updateRecord($importData,'bank_gurantee','id',$return);
					}else{
						$this->follow->insertRecord($importData,'bank_gurantee');	
					}
					
					$ind++;	
				}
			}
	
		}
		
	}
	if($a == 3){
		//echo "<pre>";
		$check_header = $data['header'][1];
		//print_r($check_header);
		//print_r($data['values']);
		if(in_array('DISB_AMT',$check_header)){
			if(!empty($data['values'])){
				$ind =2;
				foreach($data['values'] as $value){
					
					$importData = array();
					$importData['REC_TYPE'] = $value['A'];
					$importData['ILOM_SEQUENCE'] = $value['B'];
					$importData['DISB_AMT'] = $value['D'];
					
					$cell2 = 'C'.$ind;
					//$cell3 = 'G'.$ind;
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell2)->getFormattedValue();
					//$data_value3 = $objPHPExcel->getActiveSheet()->getCell($cell3)->getFormattedValue();
			
					$importData['DISB_DATE'] = $data_value;
					//$return  = $this->follow->check_sequance($importData['ILOM_SEQUENCE'],'payments_distribution');
					$where = 'ILOM_SEQUENCE = "'.$importData['ILOM_SEQUENCE'].'" AND DISB_DATE = "'.$data_value.'" AND DISB_AMT = "'.$importData['DISB_AMT'].'"';
					$return = $this->follow->check_record('payments_distribution',$where);	
					if(!$return){
						$this->follow->insertRecord($importData,'payments_distribution');	
					}					
					$ind++;	
				}
			}
		}
		

	
	
}

		if($a == 4){
		//echo "<pre>";
		$check_header = $data['header'][1];
		//print_r($check_header);
		//print_r($data['values']);
		//exit;
		if(in_array('GRACE_MONTHS',$check_header)){
			if(!empty($data['values'])){
				$ind =2;
				foreach($data['values'] as $value){
					
					$importData = array();
					$importData['REC_TYPE'] = $value['A'];
					$importData['ILOM_SEQUENCE'] = $value['B'];
					$importData['ILOM_GRACE_PERD_PERIOD'] = $value['C'];
					$importData['GRACE_MONTHS'] = $value['D'];
					$importData['ILOM_NB_INSTALL'] = $value['E'];
					$importData['PAYMENT_YEARS'] = $value['F'];
					$importData['TOT_PAID'] = $value['G'];
					$importData['TOT_OUTSTD'] = $value['H'];
					$importData['TOT_PD'] = $value['I'];
					//$cell2 = 'C'.$ind;
					//$cell3 = 'G'.$ind;
					//$data_value = $objPHPExcel->getActiveSheet()->getCell($cell2)->getFormattedValue();
					//$data_value3 = $objPHPExcel->getActiveSheet()->getCell($cell3)->getFormattedValue();
					//echo "<pre>";
					//print_r($importData);
					//$importData['DISB_DATE'] = $data_value;
					//$return  = $this->follow->check_sequance($importData['ILOM_SEQUENCE'],'repayment_schduale');
					
					/*
						SELECT 
							  * 
							FROM
							  repayment_schduale AS rs 
							WHERE rs.`REC_TYPE` = 'N' 
							  AND rs.`ILOM_SEQUENCE` = '35914' 
							  AND rs.`ILOM_GRACE_PERD_PERIOD` = '2'  
							  AND rs.`GRACE_MONTHS` = '6' 
							  AND rs.`ILOM_NB_INSTALL` = '24' 
							  AND rs.`PAYMENT_YEARS` = '6' 
							  AND rs.`TOT_PAID` = '0' 
							  AND rs.`TOT_OUTSTD` = '0'
							  AND rs.`TOT_PD`='0'
							  
							  
					*/	
					$where = 'REC_TYPE = "'.$importData['REC_TYPE'].'" AND ILOM_SEQUENCE = "'.$importData['ILOM_SEQUENCE'].'" AND ILOM_GRACE_PERD_PERIOD = "'.$importData['ILOM_GRACE_PERD_PERIOD'].'" AND GRACE_MONTHS = "'.$importData['GRACE_MONTHS'].'" AND ILOM_NB_INSTALL = "'.$importData['ILOM_NB_INSTALL'].'" AND PAYMENT_YEARS = "'.$importData['PAYMENT_YEARS'].'" AND TOT_PAID = "'.$importData['TOT_PAID'].'" AND TOT_PAID = "'.$importData['TOT_PAID'].'" AND TOT_OUTSTD = "'.$importData['TOT_OUTSTD'].'" AND TOT_PD = "'.$importData['TOT_PD'].'" ';
					$return = $this->follow->check_record('repayment_schduale',$where);	
					
					if(!$return){
						$this->follow->insertRecord($importData,'repayment_schduale');
						//$this->follow->updateRecord($importData,'repayment_schduale','id',$return);
					}
					
					$ind++;	
				}
			}
	
		}

		
	}
		if($a == 5){
		//echo "<pre>";
		$check_header = $data['header'][1];
		//print_r($check_header);
		//print_r($data['values']);
		//exit;
		if(in_array('ILOD_BILL_SEQ',$check_header)){
			if(!empty($data['values'])){
				$ind =2;
				foreach($data['values'] as $value){
					
					$importData = array();
					$importData['REC_TYPE'] = $value['A'];
					$importData['ILOM_SEQUENCE'] = $value['B'];
					$importData['ILOD_BILL_SEQ'] = $value['C'];
					$importData['ILOD_CPT_AMNT'] = $value['D'];
					$importData['ILOD_BILL_MTR'] = $value['E'];
					$importData['ILOD_BILL_MNT'] = $value['F'];
					$importData['ILOD_BILL_INT'] = $value['G'];
					$importData['ILOD_PAID_MNT'] = $value['H'];
					$importData['ILOD_STATUS'] = $value['I'];
					//ILOD_BILL_MNT
					//$return  = $this->follow->check_sequance($importData['ILOM_SEQUENCE'],'banks_payment_exchange');	
					$where = 'REC_TYPE = "'.$importData['REC_TYPE'].'" AND ILOM_SEQUENCE = "'.$importData['ILOM_SEQUENCE'].'" AND ILOD_BILL_SEQ = "'.$importData['ILOD_BILL_SEQ'].'" AND ILOD_CPT_AMNT = "'.$importData['ILOD_CPT_AMNT'].'" AND ILOD_BILL_MTR = "'.$importData['ILOD_BILL_MTR'].'"  AND ILOD_BILL_MNT = "'.$importData['ILOD_BILL_MNT'].'" AND ILOD_BILL_INT = "'.$importData['ILOD_BILL_INT'].'" AND ILOD_PAID_MNT = "'.$importData['ILOD_PAID_MNT'].'" AND ILOD_STATUS = "'.$importData['ILOD_STATUS'].'" ';
					$return = $this->follow->check_record('banks_payment_exchange',$where);	
					
					if(!$return){
						$this->follow->insertRecord($importData,'banks_payment_exchange');
						//$this->follow->updateRecord($importData,'banks_payment_exchange','exchange_id',$return);
					}
					
					$ind++;	
				}
			}
	
		}
		//$this->session->set_flashdata('msg', '1');
		echo json_encode(array('status' => 'ok'));
		//redirect(base_url()."followup/uploadeFile/");
		////print_r($check_header);
		//print_r($data['values']);
		
		exit;
		
	}	
		
	}
}
	function viewfollowuplist($id){
			$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicatn_info']	=	$this->inq->get_single_applicatnt($id);
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
		
		$this->_data['financial'] = $this->follow->getdataBytable('financial_returns',$id);
		//echo "<pre>";
		//print_r($this->_data['financial']);
		//$this->_data['support'] = $this->follow->getdataBytable('support_parties',$id);
		//$this->_data['evaluate'] = $this->follow->getdataBytable('evaluate_project',$id);
		//$this->_data['annoted1'] = $this->follow->getdataBytable2('annoted_details',$id,'anoted_type',1);
		//$this->_data['annoted2'] = $this->follow->getdataBytable2('annoted_details',$id,'anoted_type',2);
		//$this->_data['proposal'] = $this->follow->getdataBytable2('about_proejct_details',$id,'project_type','proposal');
		//$this->_data['observer'] = $this->follow->getdataBytable2('about_proejct_details',$id,'project_type','observer');
		//$this->_data['monthly_financial'] = $this->follow->getdataBytable('monthly_financial',$id);
		$this->load->view('followup_data_list', $this->_data);
	}
	
	
	function editVisit($id,$type){
		
		$type = date('Y-m-d',$type);
		//if($type == 'return' || $type =='all'){
			$this->_data['financial'] = $this->follow->getdataBypkOrder('financial_returns','returns_id',$id,$type);
			//echo "<pre>";
			//print_r($this->_data['financial']);
					
		//}
		//elseif($type == 'month' || $type =='all'){
				$this->_data['monthly_financial'] = $this->follow->getdataBypkOrder('monthly_financial','month_financial',$id,$type);	
		//}
		//elseif($type == 'evaluate' || $type =='all'){
			$this->_data['evaluate_data'] = $this->follow->getdataBypkOrder('evaluate_project','evaluate_id',$id,$type);
		//}
		//elseif($type == 'support' || $type =='all'){
			$this->_data['support'] = $this->follow->getdataBypkOrder('support_parties','support_id',$id,$type);
		//}
		//elseif($type == 'proposal' || $type =='all'){
			$this->_data['proposalDetails'] = $this->follow->getdataBypkTypeOrder('about_proejct_details','project_detail_id',$id,'project_type','proposal',$type);	
			//print_r($this->_data['proposalDetails']);
	
			//print_r($this->_data['prop']);
			
		//}
		//elseif($type == 'observer' || $type =='all'){
			$this->_data['observer'] = $this->follow->getdataBypkTypeOrder('about_proejct_details','project_detail_id',$id,'project_type','observer',$type);
		//}
		//elseif($type == '2' || $type =='all'){
			$this->_data['annoted2'] = $this->follow->getdataBypkTypeOrder('annoted_details','anoted_id',$id,'anoted_type','2',$type);
			//print_r($this->_data['annoted2']);

		//}
		//elseif($type == '1' || $type =='all'){
			$this->_data['annoted1'] = $this->follow->getdataBypkTypeOrder('annoted_details','anoted_id',$id,'anoted_type','1',$type);
			
			$this->_data['id'] = $id;
			//print_r($this->_data['support']);

			$this->load->view('requestfollow_edit', $this->_data);
	}
	
	public function update_follow_up()

	{
		$data = $this->input->post();
		//echo "<pre>";
		//print_r($data);
	
	
	
    $details['project_details'] = $data['project_propsel'];
	$details['project_type'] = 'proposal';
    $details['applicant_id'] = $data['applicant_id'];
	$details['user_id'] 	= $this->session->userdata('userid');
	$keyval = $data['project_detail_id'];
	//print_r($details);
	//observe_view
	//$this->db->insert('about_proejct_details',$details);
	$this->follow->updateRecordDb($details,'about_proejct_details','project_detail_id',$keyval);
	
    $details['project_details'] = $data['observe_view'];
	$details['project_type'] = 'observer';
    $details['applicant_id'] = $data['applicant_id'];
	$details['user_id'] 	= $this->session->userdata('userid');
	$keyval = $data['observer_id'];
	
	$this->follow->updateRecordDb($details,'about_proejct_details','project_detail_id',$keyval);
	//exit;	
		
	//$support['support_training'] = '';
	$financial['present_value_project'] = $_POST['present_value_project'];
	$financial['average_monthly_revenue'] = $_POST['average_monthly_revenue'];
	$financial['average_anual_revenue'] = $_POST['average_anual_revenue'];
   	$financial['net_average_monthly_revenue'] = $_POST['net_average_monthly_revenue'];
	$financial['net_average_anual_revenue'] = $_POST['net_average_anual_revenue'];
	//$support['training_owner_facility'] = $_POST['training_owner_facility'];
	
	
	
	
	$support['support_training'] = $_POST['support_training'];
	$support['training_owner_facility'] = $_POST['training_owner_facility'];
	$support['training'] = $_POST['training'];
	$support['duration'] = $_POST['duration'];
	$support['before_incoporation'] = $_POST['before_incoporation'];
	$support['after_incoporation'] = $_POST['after_incoporation'];
	$support['funding_support'] = $_POST['funding_support'];
	$support['amount_support'] = $_POST['amount_support'];
	$support['support_point'] = $_POST['support_point'];
	$support['loan'] = $_POST['loan'];
	$support['donation'] = $_POST['donation'];
	$support['mention_others'] = $_POST['mention_others'];
	$support['face_others_support'] = $_POST['face_others_support'];
	$support['face_others_support_text'] = $_POST['face_others_support_text'];

	$financial['present_value_project'] = $_POST['present_value_project'];
	$financial['average_monthly_revenue'] = $_POST['average_monthly_revenue'];
	$financial['average_anual_revenue'] = $_POST['average_anual_revenue'];
   	$financial['net_average_monthly_revenue'] = $_POST['net_average_monthly_revenue'];
	$financial['net_average_anual_revenue'] = $_POST['net_average_anual_revenue'];
	

	//echo "<pre>";

	$return = $this->follow->checkData('support_parties',$_POST['applicant_id']);
	
	if(!empty($support['support_training'])){
				//print_r($support);
					
					if($support['support_training'] !="")
					$supArr['support_training'] = $support['support_training'];
					
					if($support['training_owner_facility']!="")
					$supArr['training_owner_facility'] = $support['training_owner_facility'];
					
					if($support['training'] !="")
					$supArr['training'] =  $support['training'];
					
					if($support['duration']!="")
					$supArr['duration'] = $support['duration'];
					
					if($support['before_incoporation'] !="")
					$supArr['before_incoporation'] = $support['before_incoporation'];
					
					if($support['after_incoporation'] !="")
					$supArr['after_incoporation'] = $support['after_incoporation'];
					
					if($support['funding_support'] !="")
					$supArr['funding_support'] = $support['funding_support'];
					
					
					if($support['support_point']!="")
					$supArr['support_point'] = $support['support_point'];
					
					if($support['support_type'] !="")
					$supArr['support_type'] = $support['support_type'];
					
					if($support['amount_support'] !="")
					$supArr['amount_support'] = $support['amount_support'];
					
						if($support['durationtype'] !="")
					$supArr['durationtype'] = $support['durationtype'];
					
					
					
					if($support['donation'] !="")
					$supArr['donation'] = $support['donation'];
					
					if($support['mention_others'][$i] !="")
					$supArr['mention_others'] = $support['mention_others'];
					
					if($support['face_others_support'] !="")
					$supArr['face_others_support'] = $support['face_others_support'];
					
					if($support['face_others_support_text'] !="")
					$supArr['face_others_support_text'] = $support['face_others_support_text'];
					
					$supArr['applicant_id'] = $_POST['applicant_id'];
					$supArr['user_id'] 	= $this->session->userdata('userid');
				//	$newArr['training_owner_facility'] = $support['training_owner_facility'][$i];
					//training_owner_facility
					//$this->db->insert('support_parties',$supArr);
					$keyval = $data['support_id'];
					$this->follow->updateRecordDb($supArr,'support_parties','support_id',$keyval);
				
	}
	

	if(!empty($financial['present_value_project'])){
					for($i=0;$i<count($financial['present_value_project']);$i++){
						
						if($financial['present_value_project'][$i] !="")
						$newArr['present_value_project'] = $financial['present_value_project'][$i];
						
						if($financial['average_monthly_revenue'][$i] !="")
						$newArr['average_monthly_revenue'] = $financial['average_monthly_revenue'][$i];
						
						if($financial['average_anual_revenue'][$i] !="")
						$newArr['average_anual_revenue'] =  $financial['average_anual_revenue'][$i];
						
						if($financial['net_average_monthly_revenue'][$i] !="")
						$newArr['net_average_monthly_revenue'] = $financial['net_average_monthly_revenue'][$i];
						
						if($financial['net_average_anual_revenue'][$i] !="")
						$newArr['net_average_anual_revenue'] = $financial['net_average_anual_revenue'][$i];
						
						$newArr['applicant_id'] = $_POST['applicant_id'];
						$newArr['user_id'] 	= $this->session->userdata('userid');
					//	$newArr['training_owner_facility'] = $support['training_owner_facility'][$i];
						//training_owner_facility
						//$this->db->insert('financial_returns',$newArr);
						$keyval = $data['returns_id'];
						$this->follow->updateRecordDb($newArr,'financial_returns','returns_id',$keyval);
					}

	
	}
	////add suppoort data 
	

	//delete_recordById($table,$id)
	//echo "<pre>";
	//print_r($_POST);
	//exit;
	$rating['evaluate_project_card'] = $_POST ['evaluate_project_card'];
    $rating['project_card_text'] = $_POST['project_card_text'];
    $rating['evaluate_paint_signs'] = $_POST['evaluate_paint_signs'];
    $rating['paint_signs_text'] = $_POST['paint_signs_text'];
    $rating['evaluate_interface_headquarter'] = $_POST['evaluate_interface_headquarter'];
    $rating['interface_headquarter_text'] = $_POST['interface_headquarter_text'];
    $rating['evaluate_convence_project'] = $_POST['evaluate_convence_project'];
    $rating['convence_project_text'] = $_POST['convence_project_text'];
    $rating['evaluate_shop_cleanliness'] = $_POST['evaluate_shop_cleanliness'];
    $rating['shop_cleanliness_text'] = $_POST['shop_cleanliness_text'];
    $rating['evaluate_organize_shop'] = $_POST['evaluate_organize_shop'];
    $rating['organize_shop_text'] = $_POST['organize_shop_text'];
    $rating['evaluate_storage_products'] = $_POST['evaluate_storage_products'];
    $rating['storage_products_text'] = $_POST['storage_products_text'];
    $rating['evaluate_sales_stages'] = $_POST['evaluate_sales_stages'];
    $rating['sales_stages_text'] = $_POST['sales_stages_text'];
    $rating['evaluate_advertise_method'] = $_POST['evaluate_advertise_method'];
    $rating['advertise_method_text'] = $_POST['advertise_method_text'];
    $rating['evaluate_receive_deal'] = $_POST['evaluate_receive_deal'];
    $rating['evaluate_quality_service'] = $_POST['evaluate_quality_service'];
    $rating['quality_service_text'] = $_POST['quality_service_text'];
    $rating['evaluate_support_price'] = $_POST['evaluate_support_price'];
    $rating['support_price_text'] = $_POST['support_price_text'];
    $rating['evaluate_method_promotion'] = $_POST['evaluate_method_promotion'];
    $rating['method_promotion_text'] = $_POST['method_promotion_text'];
    $rating['evaluate_method_sale'] = $_POST['evaluate_method_sale'];
    $rating['method_sale'] = $_POST['method_sale'];
    $rating['evaluate_cope_competition'] = $_POST['evaluate_cope_competition'];
    $rating['cope_competition_text'] = $_POST['cope_competition_text'];
    $rating['evaluate_quality_equipment'] = $_POST['evaluate_quality_equipment'];
    $rating['evaluate_appearance'] = $_POST['evaluate_appearance'];
    $rating['appearance_text'] = $_POST['appearance_text'];
    $rating['evaluate_time'] = $_POST['evaluate_time'];
    $rating['time_text'] = $_POST['time_text'];
    $rating['evaluate_conduct_product'] = $_POST['evaluate_conduct_product'];
    $rating['conduct_product_text'] = $_POST['conduct_product_text'];
    $rating['evaluate_keep_financial'] = $_POST['evaluate_keep_financial'];
    $rating['keep_financial_text'] = $_POST['keep_financial_text'];
	$rating['receive_deal_text'] = $_POST['receive_deal_text'];
	$rating['method_sale'] = $_POST['method_sale'];
	$rating['quality_equipment_text'] = $_POST['quality_equipment_text'];
	$rating['manpower_project_text'] = $_POST['manpower_project_text'];
    $rating['evaluate_enables_project_activity'] = $_POST['evaluate_enables_project_activity'];
    $rating['project_activity_text'] = $_POST['project_activity_text']; 
    $rating['evaluate_supplier_cash_regularity'] = $_POST['evaluate_supplier_cash_regularity_'];
    $rating['supplier_cash_regularity_text'] = $_POST['supplier_cash_regularity_text'];
    $rating['evaluate_knowledge_market'] = $_POST['evaluate_knowledge_market'];
    $rating['knowledge_market_text'] = $_POST['knowledge_market_text'];
    $rating['evaluate_ocean_realtionship'] = $_POST['evaluate_ocean_realtionship'];
    $rating['ocean_realtionship_text'] = $_POST['ocean_realtionship_text'];
    $rating['evaluate_network_upload'] = $_POST['evaluate_network_upload'];
    $rating['network_upload_text'] = $_POST['network_upload_text'];
    $rating['evaluate_manpower_project'] = $_POST['evaluate_manpower_project'];
    $rating['evaluate_social_security'] = $_POST['evaluate_social_security'];
    $rating['social_security_text'] = $_POST['social_security_text'];
    $rating['evaluate_shop_equipment_insurance'] = $_POST['evaluate_shop_equipment_insurance'];
    $rating['shop_equipment_insurance'] = $_POST['shop_equipment_insurance'];
    $rating['evaluate_respect_occupation'] = $_POST['evaluate_respect_occupation'];
    $rating['respect_occupation_text'] = $_POST['respect_occupation_text'] ; 
    $rating['evaluate_prospects_development'] = $_POST['evaluate_prospects_development'];
    $rating['prospects_development_development_text'] = $_POST['prospects_development_development_text'];
    $rating['totalrating'] = $_POST['totalrating']; 
	$rating['applicant_id'] = $_POST['applicant_id']; 
	$rating['user_id'] 	= $this->session->userdata('userid');
	$ratingId = $_POST['applicant_id'];
	

	//$return = $this->follow->checkData('evaluate_project',$_POST['applicant_id']);
		
	
	//$this->db->insert('evaluate_project',$rating);
	
	$keyval = $data['evaluate_id'];
	$this->follow->updateRecordDb($rating,'evaluate_project','evaluate_id',$keyval);
	
	
	
	$monthly['month'] = $_POST['month'];
    $monthly['purchase'] = $_POST['purchase'];
    $monthly['manpower_project'] = $_POST['manpower_project'];
    $monthly['rent'] = $_POST['rent'];
    $monthly['expence'] = $_POST['expence'];
	$monthly['water_expence'] = $_POST['water_expence'];
	$monthly['wire_expence'] = $_POST['wire_expence'];
	$monthly['number_expence'] = $_POST['number_expence'];
	$monthly['fax_expence'] = $_POST['fax_expence'];
    $monthly['diffrent_services'] = $_POST['diffrent_services'];
    $monthly['other_expence'] = $_POST['other_expence'];
    $monthly['manpower_project'] = $_POST['manpower_project'] ; 
    $monthly['total_expence'] = $_POST['total_expence'];
    $monthly['total_income'] = $_POST['total_income'];
    $monthly['applicant_id'] = $_POST['applicant_id'];
	$monthly['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	//$this->db->insert('monthly_financial',$monthly);
	$keyval = $data['month_financial'];
	$this->follow->updateRecordDb($monthly,'monthly_financial','month_financial',$keyval);
	
	
		
	
	$anoted['anoted_type'] = $_POST['parwa_open'];
	$anoted['anoted_value'] = $_POST['activty_type'];
    $anoted['anoted_details'] = $_POST['difficulties'];
    $anoted['applicant_id'] = $_POST['applicant_id'];
	$anoted['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	//echo "<pre>";
	//print_r($anoted);
	//$this->db->insert('annoted_details',$anoted);
	$keyval = $data['anot_id1'];
	$this->follow->updateRecordDb($anoted,'annoted_details','anoted_id',$keyval);
	
	

	$anoted['anoted_type'] = $_POST['close_project'];
	$anoted['anoted_value'] = $_POST['project_status'];
    $anoted['anoted_details'] = $_POST['reason_text'];
    $anoted['applicant_id'] = $_POST['applicant_id'];
	$anoted['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	//$this->db->insert('annoted_details',$anoted);
	$keyval = $data['anot_id2'];
	$this->follow->updateRecordDb($anoted,'annoted_details','anoted_id',$keyval);
	exit;
	//activty_type	
		$this->session->set_flashdata('msg', '1');
		redirect(base_url()."viewfollowuplist/".$anoted['applicant_id']);
					exit();
	}
	public function add_follow_up()

	{
		$data = $this->input->post();
		//echo "<pre>";
		//print_r($data);
	
    $details['project_details'] = $data['project_propsel'];
	$details['project_type'] = 'proposal';
    $details['applicant_id'] = $data['applicant_id'];
	$details['user_id'] 	= $this->session->userdata('userid');
	//print_r($details);
	//observe_view
	$this->db->insert('about_proejct_details',$details);
	
	
    $details['project_details'] = $data['observe_view'];
	$details['project_type'] = 'observer';
    $details['applicant_id'] = $data['applicant_id'];
	$details['user_id'] 	= $this->session->userdata('userid');
	//print_r($details);
	//observe_view
	$this->db->insert('about_proejct_details',$details);	
	//exit;	
		
	//$support['support_training'] = '';
	$financial['present_value_project'] = $_POST['present_value_project'];
	$financial['average_monthly_revenue'] = $_POST['average_monthly_revenue'];
	$financial['average_anual_revenue'] = $_POST['average_anual_revenue'];
   	$financial['net_average_monthly_revenue'] = $_POST['net_average_monthly_revenue'];
	$financial['net_average_anual_revenue'] = $_POST['net_average_anual_revenue'];
	//$support['training_owner_facility'] = $_POST['training_owner_facility'];
	
	
	
	
	$support['support_training'] = $_POST['support_training'];
	$support['training_owner_facility'] = $_POST['training_owner_facility'];
	$support['training'] = $_POST['training'];
	$support['duration'] = $_POST['duration'];
	$support['before_incoporation'] = $_POST['before_incoporation'];
	$support['after_incoporation'] = $_POST['after_incoporation'];
	$support['funding_support'] = $_POST['funding_support'];
	$support['amount_support'] = $_POST['amount_support'];
	$support['support_point'] = $_POST['support_point'];
	$support['loan'] = $_POST['loan'];
	$support['donation'] = $_POST['donation'];
	$support['mention_others'] = $_POST['mention_others'];
	$support['face_others_support'] = $_POST['face_others_support'];
	$support['face_others_support_text'] = $_POST['face_others_support_text'];

	$financial['present_value_project'] = $_POST['present_value_project'];
	$financial['average_monthly_revenue'] = $_POST['average_monthly_revenue'];
	$financial['average_anual_revenue'] = $_POST['average_anual_revenue'];
   	$financial['net_average_monthly_revenue'] = $_POST['net_average_monthly_revenue'];
	$financial['net_average_anual_revenue'] = $_POST['net_average_anual_revenue'];
	

	//echo "<pre>";

	$return = $this->follow->checkData('support_parties',$_POST['applicant_id']);
	if($return){
			//$this->follow->delete_recordById('support_parties',$_POST['applicant_id']);
	}
	if(!empty($support['support_training'])){
				//print_r($support);
				for($i=0;$i<count($support['support_training']);$i++){
					
					if($support['support_training'][$i] !="")
					$supArr['support_training'] = $support['support_training'][$i];
					
					if($support['training_owner_facility'][$i] !="")
					$supArr['training_owner_facility'] = $support['training_owner_facility'][$i];
					
					if($support['training'][$i] !="")
					$supArr['training'] =  $support['training'][$i];
					
					if($support['duration'][$i] !="")
					$supArr['duration'] = $support['duration'][$i];
					
					if($support['before_incoporation'][$i] !="")
					$supArr['before_incoporation'] = $support['before_incoporation'][$i];
					
					if($support['after_incoporation'][$i] !="")
					$supArr['after_incoporation'] = $support['after_incoporation'][$i];
					
					if($support['funding_support'][$i] !="")
					$supArr['funding_support'] = $support['funding_support'][$i];
					
					
					if($support['support_point'][$i] !="")
					$supArr['support_point'] = $support['support_point'][$i];
					
					if($support['support_type'][$i] !="")
					$supArr['support_type'] = $support['support_type'][$i];
					
					if($support['amount_support'][$i] !="")
					$supArr['amount_support'] = $support['amount_support'][$i];
					
						if($support['durationtype'][$i] !="")
					$supArr['durationtype'] = $support['durationtype'][$i];
					
					
					/*
					if($support['loan'][$i] !="")
					$supArr['loan'] = $support['loan'][$i];
					
					*/
					
					if($support['donation'][$i] !="")
					$supArr['donation'] = $support['donation'][$i];
					
					if($support['mention_others'][$i] !="")
					$supArr['mention_others'] = $support['mention_others'][$i];
					
					if($support['face_others_support'][$i] !="")
					$supArr['face_others_support'] = $support['face_others_support'][$i];
					
					if($support['face_others_support_text'][$i] !="")
					$supArr['face_others_support_text'] = $support['face_others_support_text'][$i];
					
					$supArr['applicant_id'] = $_POST['applicant_id'];
					$supArr['user_id'] 	= $this->session->userdata('userid');
				//	$newArr['training_owner_facility'] = $support['training_owner_facility'][$i];
					//training_owner_facility
					$this->db->insert('support_parties',$supArr);
						
						
				}
			
	}
	$return = $this->follow->checkData('financial_returns',$_POST['applicant_id']);
	if($return){
			//$this->follow->delete_recordById('financial_returns',$_POST['applicant_id']);
	}

	if(!empty($financial['present_value_project'])){
					for($i=0;$i<count($financial['present_value_project']);$i++){
						
						if($financial['present_value_project'][$i] !="")
						$newArr['present_value_project'] = $financial['present_value_project'][$i];
						
						if($financial['average_monthly_revenue'][$i] !="")
						$newArr['average_monthly_revenue'] = $financial['average_monthly_revenue'][$i];
						
						if($financial['average_anual_revenue'][$i] !="")
						$newArr['average_anual_revenue'] =  $financial['average_anual_revenue'][$i];
						
						if($financial['net_average_monthly_revenue'][$i] !="")
						$newArr['net_average_monthly_revenue'] = $financial['net_average_monthly_revenue'][$i];
						
						if($financial['net_average_anual_revenue'][$i] !="")
						$newArr['net_average_anual_revenue'] = $financial['net_average_anual_revenue'][$i];
						
						$newArr['applicant_id'] = $_POST['applicant_id'];
						$newArr['user_id'] 	= $this->session->userdata('userid');
					//	$newArr['training_owner_facility'] = $support['training_owner_facility'][$i];
						//training_owner_facility
						$this->db->insert('financial_returns',$newArr);
						
					}

	
	}
	////add suppoort data 
	

	//delete_recordById($table,$id)
	//echo "<pre>";
	//print_r($_POST);
	//exit;
	$rating['evaluate_project_card'] = $_POST ['evaluate_project_card'];
    $rating['project_card_text'] = $_POST['project_card_text'];
    $rating['evaluate_paint_signs'] = $_POST['evaluate_paint_signs'];
    $rating['paint_signs_text'] = $_POST['paint_signs_text'];
    $rating['evaluate_interface_headquarter'] = $_POST['evaluate_interface_headquarter'];
    $rating['interface_headquarter_text'] = $_POST['interface_headquarter_text'];
    $rating['evaluate_convence_project'] = $_POST['evaluate_convence_project'];
    $rating['convence_project_text'] = $_POST['convence_project_text'];
    $rating['evaluate_shop_cleanliness'] = $_POST['evaluate_shop_cleanliness'];
    $rating['shop_cleanliness_text'] = $_POST['shop_cleanliness_text'];
    $rating['evaluate_organize_shop'] = $_POST['evaluate_organize_shop'];
    $rating['organize_shop_text'] = $_POST['organize_shop_text'];
    $rating['evaluate_storage_products'] = $_POST['evaluate_storage_products'];
    $rating['storage_products_text'] = $_POST['storage_products_text'];
    $rating['evaluate_sales_stages'] = $_POST['evaluate_sales_stages'];
    $rating['sales_stages_text'] = $_POST['sales_stages_text'];
    $rating['evaluate_advertise_method'] = $_POST['evaluate_advertise_method'];
    $rating['advertise_method_text'] = $_POST['advertise_method_text'];
    $rating['evaluate_receive_deal'] = $_POST['evaluate_receive_deal'];
    $rating['evaluate_quality_service'] = $_POST['evaluate_quality_service'];
    $rating['quality_service_text'] = $_POST['quality_service_text'];
    $rating['evaluate_support_price'] = $_POST['evaluate_support_price'];
    $rating['support_price_text'] = $_POST['support_price_text'];
    $rating['evaluate_method_promotion'] = $_POST['evaluate_method_promotion'];
    $rating['method_promotion_text'] = $_POST['method_promotion_text'];
    $rating['evaluate_method_sale'] = $_POST['evaluate_method_sale'];
    $rating['method_sale'] = $_POST['method_sale'];
    $rating['evaluate_cope_competition'] = $_POST['evaluate_cope_competition'];
    $rating['cope_competition_text'] = $_POST['cope_competition_text'];
    $rating['evaluate_quality_equipment'] = $_POST['evaluate_quality_equipment'];
    $rating['evaluate_appearance'] = $_POST['evaluate_appearance'];
    $rating['appearance_text'] = $_POST['appearance_text'];
    $rating['evaluate_time'] = $_POST['evaluate_time'];
    $rating['time_text'] = $_POST['time_text'];
    $rating['evaluate_conduct_product'] = $_POST['evaluate_conduct_product'];
    $rating['conduct_product_text'] = $_POST['conduct_product_text'];
    $rating['evaluate_keep_financial'] = $_POST['evaluate_keep_financial'];
    $rating['keep_financial_text'] = $_POST['keep_financial_text'];
	$rating['receive_deal_text'] = $_POST['receive_deal_text'];
	$rating['method_sale'] = $_POST['method_sale'];
	$rating['quality_equipment_text'] = $_POST['quality_equipment_text'];
	$rating['manpower_project_text'] = $_POST['manpower_project_text'];
    $rating['evaluate_enables_project_activity'] = $_POST['evaluate_enables_project_activity'];
    $rating['project_activity_text'] = $_POST['project_activity_text']; 
    $rating['evaluate_supplier_cash_regularity'] = $_POST['evaluate_supplier_cash_regularity_'];
    $rating['supplier_cash_regularity_text'] = $_POST['supplier_cash_regularity_text'];
    $rating['evaluate_knowledge_market'] = $_POST['evaluate_knowledge_market'];
    $rating['knowledge_market_text'] = $_POST['knowledge_market_text'];
    $rating['evaluate_ocean_realtionship'] = $_POST['evaluate_ocean_realtionship'];
    $rating['ocean_realtionship_text'] = $_POST['ocean_realtionship_text'];
    $rating['evaluate_network_upload'] = $_POST['evaluate_network_upload'];
    $rating['network_upload_text'] = $_POST['network_upload_text'];
    $rating['evaluate_manpower_project'] = $_POST['evaluate_manpower_project'];
    $rating['evaluate_social_security'] = $_POST['evaluate_social_security'];
    $rating['social_security_text'] = $_POST['social_security_text'];
    $rating['evaluate_shop_equipment_insurance'] = $_POST['evaluate_shop_equipment_insurance'];
    $rating['shop_equipment_insurance'] = $_POST['shop_equipment_insurance'];
    $rating['evaluate_respect_occupation'] = $_POST['evaluate_respect_occupation'];
    $rating['respect_occupation_text'] = $_POST['respect_occupation_text'] ; 
    $rating['evaluate_prospects_development'] = $_POST['evaluate_prospects_development'];
    $rating['prospects_development_development_text'] = $_POST['prospects_development_development_text'];
    $rating['totalrating'] = $_POST['totalrating']; 
	$rating['applicant_id'] = $_POST['applicant_id']; 
	$rating['user_id'] 	= $this->session->userdata('userid');
	$ratingId = $_POST['applicant_id'];
	

	//$return = $this->follow->checkData('evaluate_project',$_POST['applicant_id']);
		
	
	$this->db->insert('evaluate_project',$rating);
	
	
	
	$monthly['month'] = $_POST['month'];
    $monthly['purchase'] = $_POST['purchase'];
    $monthly['manpower_project'] = $_POST['manpower_project'];
    $monthly['rent'] = $_POST['rent'];
    $monthly['expence'] = $_POST['expence'];
	$monthly['water_expence'] = $_POST['water_expence'];
	$monthly['wire_expence'] = $_POST['wire_expence'];
	$monthly['number_expence'] = $_POST['number_expence'];
	$monthly['fax_expence'] = $_POST['fax_expence'];
    $monthly['diffrent_services'] = $_POST['diffrent_services'];
    $monthly['other_expence'] = $_POST['other_expence'];
    $monthly['manpower_project'] = $_POST['manpower_project'] ; 
    $monthly['total_expence'] = $_POST['total_expence'];
    $monthly['total_income'] = $_POST['total_income'];
    $monthly['applicant_id'] = $_POST['applicant_id'];
	$monthly['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	$this->db->insert('monthly_financial',$monthly);
		
	
		
	
	$anoted['anoted_type'] = $_POST['parwa_open'];
	$anoted['anoted_value'] = $_POST['activty_type'];
    $anoted['anoted_details'] = $_POST['difficulties'];
    $anoted['applicant_id'] = $_POST['applicant_id'];
	$anoted['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	//echo "<pre>";
	//print_r($anoted);
	$this->db->insert('annoted_details',$anoted);
	

	$anoted['anoted_type'] = $_POST['close_project'];
	$anoted['anoted_value'] = $_POST['project_status'];
    $anoted['anoted_details'] = $_POST['reason_text'];
    $anoted['applicant_id'] = $_POST['applicant_id'];
	$anoted['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	$this->db->insert('annoted_details',$anoted);
	
	//activty_type	
		$this->session->set_flashdata('msg', '1');
		redirect(base_url()."followup/requestfollowup/".$ratingId);
					exit();
	}
	


//-------------------------------------------------------------------------------



	/*

	*

	* Add List Detail

	*/

	public function add($branchid	= NULL)

	{

		if($branchid)

		{

			$this->_data['single_branche']	=	$this->branches->get_single_branche($branchid);	



		}

		if($this->input->post())

		{

			

			$data		=	$this->input->post();



			// UNSET ARRAY key

			unset($data['save_data_form']);

			

			if($this->input->post('branch_id'))

			{



				$this->branches->update_branch($this->input->post('branch_id'),$data);

				

				$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');

				redirect(base_url()."branches/listing");

				exit();

				

			}

			else

			{



				$this->branches->add_branche($data);

				

				$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');

				redirect(base_url()."branches/listing");

				exit();

			}

		}

		else

		{

			if($branchid)

			{

				$this->_data['branch_id']	=	$branchid;

			}

			else

			{

				$this->_data['branch_id']	=	'';

			}

			

			$this->load->view('add', $this->_data);

		}

		

	}	
	
	function getfollowupHistory($id){
			$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicatn_info']	=	$this->inq->get_single_applicatnt($id);
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
		
		$this->_data['financial'] = $this->follow->getdataBytable('financial_returns',$id);
		$this->_data['support'] = $this->follow->getdataBytable('support_parties',$id);
		$this->_data['evaluate'] = $this->follow->getdataBytable('evaluate_project',$id);
		//$this->_data['activity'] = $this->follow->getdataByTypeTable('annoted_details',$id,1);
		//$this->_data['difficulties'] = $this->follow->getdataByTypeTable('annoted_details',$id,2);
		//echo "<pre>";
	//	print_r($this->_data['evaluate']);
		//exit;
				$this->load->view('followup_history', $this->_data);
	}
	function requestfollowup($id){
		
		$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicatn_info']	=	$this->inq->get_single_applicatnt($id);
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
		
		$this->_data['financial'] = $this->follow->getdataBytable('financial_returns',$id);
		$this->_data['support'] = $this->follow->getdataBytable('support_parties',$id);
		$this->_data['evaluate'] = $this->follow->getdataBytable('evaluate_project',$id);
		//echo "<pre>";
	//	print_r($this->_data['evaluate']);
		//exit;
				$this->load->view('requestfollow_up', $this->_data);

	}
	
	function requestfollowupdetails($id){
		
		$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicatn_info']	=	$this->inq->get_single_applicatnt($id);
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
		
		$this->_data['financial'] = $this->follow->getdataBytable('financial_returns',$id);
		$this->_data['support'] = $this->follow->getdataBytable('support_parties',$id);
		$this->_data['evaluate'] = $this->follow->getdataBytable('evaluate_project',$id);
		$this->_data['annoted1'] = $this->follow->getdataBytable2('annoted_details',$id,1);
		$this->_data['annoted2'] = $this->follow->getdataBytable2('annoted_details',$id,2);
		$this->_data['monthly_financial'] = $this->follow->getdataBytable('monthly_financial',$id);
		
		//echo "<pre>";
	//	print_r($this->_data['evaluate']);
		//exit;
			$this->load->view('requestfollow_up_history', $this->_data);

	}
	
	function requestfollowupdata($id,$type){
		
		$type = date('Y-m-d',$type);
/*		if($type == 'return' || $type =='all'){
			$this->_data['financial'] = $this->follow->getdataBypk('financial_returns','returns_id',$id);
					
		}
		elseif($type == 'month' || $type =='all'){
				$this->_data['monthly_financial'] = $this->follow->getdataBypk('monthly_financial','month_financial',$id);	
		}
		elseif($type == 'evaluate' || $type =='all'){
			$this->_data['evaluate_data'] = $this->follow->getdataBypk('evaluate_project','evaluate_id',$id);
		}
		elseif($type == 'support' || $type =='all'){
			$this->_data['support'] = $this->follow->getdataBypk('support_parties','support_id',$id);
		}
		elseif($type == 'proposal' || $type =='all'){
			$this->_data['prop'] = $this->follow->getdataBypk('about_proejct_details','project_detail_id',$id);	
		}
		elseif($type == 'observer' || $type =='all'){
			$this->_data['observer'] = $this->follow->getdataBypk('about_proejct_details','project_detail_id',$id);
		}
		elseif($type == '2' || $type =='all'){
			$this->_data['annoted2'] = $this->follow->getdataBypk('annoted_details','anoted_id',$id);
		}
		elseif($type == '1' || $type =='all'){
			$this->_data['annoted1'] = $this->follow->getdataBypk('annoted_details','anoted_id',$id);
			
		}*/
		
		//if($type == 'return' || $type =='all'){
			$this->_data['financial'] = $this->follow->getdataBypkOrder('financial_returns','returns_id',$id,$type);
			//echo "<pre>";
			//print_r($this->_data['financial']);
					
		//}
		//elseif($type == 'month' || $type =='all'){
				$this->_data['monthly_financial'] = $this->follow->getdataBypkOrder('monthly_financial','month_financial',$id,$type);	
		//}
		//elseif($type == 'evaluate' || $type =='all'){
			$this->_data['evaluate_data'] = $this->follow->getdataBypkOrder('evaluate_project','evaluate_id',$id,$type);
		//}
		//elseif($type == 'support' || $type =='all'){
			$this->_data['support'] = $this->follow->getdataBypkOrder('support_parties','support_id',$id,$type);
		//}
		//elseif($type == 'proposal' || $type =='all'){
			$this->_data['prop'] = $this->follow->getdataBypkOrder('about_proejct_details','project_detail_id',$id,$type);	
		//}
		//elseif($type == 'observer' || $type =='all'){
			$this->_data['observer'] = $this->follow->getdataBypkOrder('about_proejct_details','project_detail_id',$id,$type);
		//}
		//elseif($type == '2' || $type =='all'){
			$this->_data['annoted2'] = $this->follow->getdataBypkOrder('annoted_details','anoted_id',$id,$type);
		//}
		//elseif($type == '1' || $type =='all'){
			$this->_data['annoted1'] = $this->follow->getdataBypkOrder('annoted_details','anoted_id',$id,$type);
			
		//}

		$this->_data['type'] = 'all';
		$this->_data['id'] = $id;
		
		//echo "<pre>";
//print_r($this->_data['info']);
//		exit;
			$this->load->view('requestfollow_single_history', $this->_data);

	}
		function bankfollowup($id){
		
		$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		
		$this->_data['loan_list'] = $this->follow->getrejectList($id);
		//echo "<pre>";
		//print_r($this->_data['loan_list']);
		$loan_id ='';
		if(!empty($this->_data['loan_list'])){
			$loanSequance = $this->_data['loan_list']->loan_id;
		}

		//echo $loanNumber;
		//exit;
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
		
		$cr_number =  $this->_data['applicant_data']['applicants']->applicant_cr_number;
		$appliant_id_number =  $this->_data['applicant_data']['applicants']->appliant_id_number;
		//echo "<pre>";
		//print_r($this->_data['applicant_data']);
		 
		 $loanAppData = $this->follow->getLoanIdNumber($appliant_id_number,'CIVIL_ID');
		 
		 if(!empty($loanAppData)){
			 //	echo "if1";	
		 		 $loanNumber = $loanAppData->ILOM_SEQUENCE;
				 $loanData   = $loanAppData;
		 }
		 else{
			 	//echo "else1";
		 		$loancrData = $this->follow->getLoanIdNumber($cr_number,'COMM_REG_NO');
				$loanNumber = $loancrData->ILOM_SEQUENCE;
				$loanData = $loancrData;
				
		 }
		 
		 if(!isset($loanNumber)){
			 	  //echo "if2";
		 		   $loanData = $this->follow->getLoanIdNumber($loanSequance,'ILOM_SEQUENCE');
					$loanNumber = $loancrData->ILOM_SEQUENCE;
		 }
		 
		
		//print_r($loanData);
		//echo $loanData->ILOM_SEQUENCE;
		//exit;
		
		$this->_data['loan_data'] = $loanData;
		$this->_data['bank_gurantee'] =	$this->follow->getBankDataByLoanId('bank_gurantee',$loanData->ILOM_SEQUENCE);
		$this->_data['bank_dist'] =	$this->follow->getBankDataByLoanId('payments_distribution',$loanData->ILOM_SEQUENCE);
		//print_r($this->_data['bank_gurantee']);
		$this->_data['repayment_schduale'] =	$this->follow->getBankDataByLoanId('repayment_schduale',$loanData->ILOM_SEQUENCE);
		$this->_data['banks_payment_exchange'] =	$this->follow->getBankDataByLoanId('banks_payment_exchange',$loanData->ILOM_SEQUENCE);
		//exit;
	//	echo "<pre>";
		//print_r($this->_data['applicant_partner']);
				$this->load->view('bank_view', $this->_data);

	}
	
	

//-------------------------------------------------------------------------------



	/*

	*

	* Listing Page

	*/

	public function listing()

	{

		$this->_data['all_branches']	=	$this->branches->get_all_branches();



		$this->load->view('branches-listing', $this->_data);

	}

//-------------------------------------------------------------------------------



	/*

	* Delete List

	*

	*/

	

	public function delete($branch_id)

	{

		$this->branches->delete($branch_id);

		

		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');

		redirect(base_url().'branches/listing');

		exit();



	}
}





?>