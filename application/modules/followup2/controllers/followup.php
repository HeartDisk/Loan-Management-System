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
		$uids = $bank_data->uids;
		//print_r($bank_data);
		//exit;
		if($uids !="")
		$this->_data['all_applicatns']  = $this->follow->getCompleteFollowData($uids);
		else
		$this->_data['all_applicatns']  = "";
		
		//print_r($this->_data['all_applicatns']);
		//exit;
		//$this->load->model('inquiries/inquiries_model', 'inq');
		//$this->_data['all_applicatns']	=	$this->inq->getAprovalStepData();
		$this->load->view('followup_list', $this->_data);
	

	}
	
	public function add_follow_up()

	{
		$data = $this->input->post();
		//echo "<pre>";
		//print_r($data);
		
		
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
		
	
	$details['observe_view'] = $_POST['observe_view'];
    $details['project_propsel'] = $_POST['project_propsel'];
    $details['applicant_id'] = $_POST['applicant_id'];
	$details['user_id'] 	= $this->session->userdata('userid');
	//observe_view
	$this->db->insert('about_proejct_details',$details);	
		
	
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
		function bankfollowup($id){
		
		$this->load->model('inquiries/inquiries_model', 'inq');
		$this->_data['applicant_id'] = $id;
		$this->_data['applicant_data'] = $this->inq->getRequestInfo($id);
		
		$this->_data['applicant_partner'] = $this->follow->get_applicant_partners($id);
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