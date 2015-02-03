<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_model extends CI_Model {
	
	/*
	* Properties
	*/
	private $_table_users;	
	private $_table_donate;	
	private $_table_applied_donation;
//----------------------------------------------------------------------

	function __construct()
    {
        parent::__construct();
    }
	
	public function getDetail($idcard)
	{
		$q = $this->db->query("SELECT b.`tempid` FROM `main_applicant` AS a, `main_notes` AS b WHERE a.`tempid`=b.`tempid` AND a.idcard='".$idcard."';");		
		foreach($q->result() as $data)
		{
			echo json_encode($this->getLastDetail($data->tempid));
			
		}
	}
	function check_applicant($type,$val){
		switch($type)
		{
			case 'id_number';
				$sql = "SELECT * FROM `applicants` AS a,`applicant_partners` AS ap
WHERE a.`appliant_id_number` = '".$val."' OR  ap.`partner_id_number` = '".$val."' LIMIT 1";
			break;
			
			case 'cr_number';
			$sql = "SELECT * FROM `applicants` AS a,`applicant_partners` AS ap
WHERE a.`applicant_cr_number` = '".$val."' OR  ap.`partner_cr_number` = '".$val."' LIMIT 1";
			break;
			case 'phone';
				$sql = "SELECT * FROM `applicant_phones` AS ap,`applicant_partners_number` apn
WHERE ap.`applicant_phone` = '".$val."' OR apn.`parnter_number` = '".$val."'; ";
					
			break;
		}	
		//echo $sql;
		$q = $this->db->query($sql);
		
		//print_r($q->result());
		if($q->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	function check_record($key,$id,$table){
		$this->db->select('*');
		$this->db->from($table);		
		$this->db->where($key,$id);
		$tempMain = $this->db->get();
		if($tempMain->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
		
		
				$sql = "SELECT * FROM `applicants` AS a,`applicant_partners` AS ap
WHERE a.`appliant_id_number` = '".$val."' OR  ap.`partner_id_number` = '".$val."' LIMIT 1";
		$q = $this->db->query($sql);
		
		//print_r($q->result());
		if($q->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	public function addQualification($applicantid,$data)
	{
		$qualification = array('applicant_id'=>$applicantid,'applicant_qualification'=>$data['applicant_qualification'],'applicant_qualification_text'=>$data['applicant_qualification_text'],
			'applicant_specialization'=>$data['applicant_specialization'],'applicant_institute'=>$data['applicant_institute'],
			'applicant_institute_text'=>$data['applicant_institute_text'],'application_institute_year'=>$data['application_institute_year'],
			'applicant_trainningcenter'=>$data['applicant_trainningcenter'],'applicant_specializations'=>$data['applicant_specializations'],'applicant_training_month'=>$data['applicant_training_month'],
			'applicant_vtco'=>$data['applicant_vtco'],'applicant_ytotc'=>$data['applicant_ytotc'],'applicant_other_trainning'=>$data['applicant_other_trainning'],'applicant_other_specializations'=>$data['applicant_other_specializations']);
			$this->db->insert('applicant_qualification',$qualification);
	}
	
		public function DeleteApplicantData($applicant_id)
	{
		$this->db->delete('applicant_phones', array('applicant_id' => $applicant_id)); 
		$this->db->delete('applicant_partners', array('applicant_id' => $applicant_id)); 
		$this->db->delete('applicant_qualification', array('applicant_id' => $applicant_id)); 
		$this->db->delete('applicant_professional_experience', array('applicant_id' => $applicant_id)); 
		$this->db->delete('applicant_businessrecord', array('applicant_id' => $applicant_id));
	}
		public function addPartner($applicant_id,$stepData)
	{
		//echo "<pre>";
		//print_r($stepData);
		//exit;
		for($part=1; $part<=4; $part++)
		{
				$ppx = '_'.$part;
				$partner_sequence = $part;
				$partner_first_name = $stepData['partner_first_name'.$ppx];
				if($partner_first_name!='')
				{
					$partner = array(
						'applicant_id'=>$applicant_id,
						'partner_sequence'=>$partner_sequence,
						'partner_first_name'=>$stepData['partner_first_name'.$ppx],
						'partner_middle_name'=>$stepData['partner_middle_name'.$ppx],
						'partner_last_name'=>$stepData['partner_last_name'.$ppx],
						'partner_sur_name'=>$stepData['partner_sur_name'.$ppx],
						'partner_gender'=>$stepData['partner_gender'.$ppx],
						'partner_id_number'=>$stepData['partner_id_number'.$ppx],
						'partner_cr_number'=>$stepData['partner_cr_number'.$ppx],
						'partner_date_birth'=>$stepData['partner_date_birth'.$ppx],
						'partner_marital_status'=>$stepData['partner_marital_status'.$ppx],
						'partner_job_staus'=>$stepData['partner_job_staus'.$ppx],
						'partner_job_status_text'=>$stepData['partner_job_status_text'.$ppx],
						'option1'=>$stepData['option1'.$ppx],
						'option_txt'=>$stepData['option_txt'.$ppx],
						'option2'=>$stepData['option2'.$ppx],
						'disable_type'=>$stepData['disable_type'.$ppx],
						'partner_disable_type_text'=>$stepData['partner_disable_type_text'.$ppx],
						'province'=>$stepData['province'.$ppx],
						'walaya'=>$stepData['walaya'.$ppx],
						'village'=>$stepData['village'.$ppx],
						'way'=>$stepData['way'.$ppx],
						'home'=>$stepData['home'.$ppx],
						'documents'=>$stepData['doc'.$ppx],
						'deparment'=>$stepData['deparment'.$ppx],
						'zipcode'=>$stepData['zipcode'.$ppx],
						'postalcode'=>$stepData['postalcode'.$ppx],
						'mobile_number'=>$stepData['mobile_number'.$ppx],
						'linephone'=>$stepData['linephone'.$ppx],
						'fax'=>$stepData['fax'.$ppx],
						'email'=>$stepData['email'.$ppx],
						'refrence_number'=>$stepData['refrence_number'.$ppx],
						'partner_qualification'=>$stepData['partner_qualification'.$ppx],
						'partner_qualification_text'=>$stepData['partner_qualification_text'.$ppx],
						'partner_specialization'=>$stepData['partner_specialization'.$ppx],
						'partner_institute'=>$stepData['partner_institute'.$ppx],
						'partner_institute_text'=>$stepData['partner_institute_text'.$ppx],
						'partner_institute_year'=>$stepData['partner_institute_year'.$ppx],
						'partner_trainningcenter'=>$stepData['partner_trainningcenter'.$ppx],
						'partner_specializations'=>$stepData['partner_specializations'.$ppx],
						'partner_training_month'=>$stepData['partner_training_month'.$ppx],
						'partner_vtco'=>$stepData['partner_vtco'.$ppx],
						'partner_ytotc'=>$stepData['partner_ytotc'.$ppx],
						'partner_other_trainning'=>$stepData['partner_other_trainning'.$ppx],
						'partner_other_specializations'=>$stepData['partner_other_specializations'.$ppx],
						'partner_activity'=>json_encode($stepData['partner_activity'.$ppx]),
						'partner_card_number'=>$stepData['partner_card_number'.$ppx],
						'partner_phone'=>$stepData['partner_phone'.$ppx],
						'document_name_1'=>$stepData['document_name_'.$ppx.'1'],
						'document_name_2'=>$stepData['document_name_'.$ppx.'2'],
						'document_name_3'=>$stepData['document_name_'.$ppx.'3'],
						'document_name_5'=>$stepData['document_name_'.$ppx.'5'],
						'document_name_6'=>$stepData['document_name_'.$ppx.'6'],
						'document_name_7'=>$stepData['document_name_'.$ppx.'7'],
						'document_name_8'=>$stepData['document_name_'.$ppx.'7'],
									
					);
					
					$partner_id = $stepData['partner_id'.$ppx];
					if($partner_id !=""){
						$this->db->where('applicant_id', $applicant_id);
						$this->db->update('applicant_partners', $partner); 
					}
					else{
						$this->db->insert('applicant_partners',$partner);
						$partner_id = $this->db->insert_id();
					}
					foreach($stepData['phone_numbers'.$ppx] as $pkeyx => $pvaluex)
					{
						if($pvaluex!='')
						{
							$phonex = array('partner_id'=>$partner_id,'phonenumber'=>$pvaluex);
							$this->db->insert('applicant_partner_phones',$phonex);
						}
					}	
					//////////////////////////////////////////////
					//////////////////////////////////////////////
					//////////////////////////////////////////////
					//echo "<pre>";
					//print_r($stepData['option_one'.$ppx]);
					for($x=0; $x<=2; $x++)
					{
						$applicant_partner_experience = array(
						'applicant_id'=>$applicant_id,
						'partnerid'=>$partner_id,
						'option_one'=>$stepData['option_one'.$ppx][$x],
						'option_two'=>$stepData['option_two'.$ppx][$x],
						'option_three'=>$stepData['option_three'.$ppx][$x],
						'option_four'=>$stepData['option_four'.$ppx][$x],
						'option_five'=>$stepData['option_five'.$ppx][$x],
						'activities_one'=>$stepData['activities_one'.$ppx][$x],
						'activities_two'=>$stepData['activities_two'.$ppx][$x],
						'activities_three'=>$stepData['activities_three'.$ppx][$x],
						'activities_four'=>$stepData['activities_four'.$ppx][$x],
						'activities_five'=>$stepData['activities_five'.$ppx][$x]);
						
						//print_r($applicant_partner_experience);
						//$partner_id
						$experienceid = $stepData['experienceid'.$ppx][$x];
						if($experienceid !=""){
							
								$this->db->where('experienceid', $experienceid);
								$this->db->update('applicant_partner_experience', $applicant_partner_experience); 
		
						}
						else{
							//$this->check_record('partnerid',$partner_id,'applicant_partner_experience');
							$this->db->insert('applicant_partner_experience',$applicant_partner_experience);
						
						}
						//print_r($applicant_partner_experience);
					}
					
					//echo "<pre>";
					//print_r($stepData);
					//print_r($stepData['partner_activity'.$ppx]);
					//echo 'partner_activity'.$ppx;
					//exit;
					//applicant_businessrecord Applicant Business Record
					for($y=0; $y<=3; $y++)
					{
						$applicant_partner_businessrecord = array('applicant_id'=>$applicant_id,
						'partner_id'=>$partner_id,
						'applicant_activity'=>$stepData['partner_activity'.$ppx][$y],
						'activity_name'=>$stepData['activity_name'.$ppx][$y],
						'activity_registration_no'=>$stepData['activity_registration_no'.$ppx][$y],
						'activity_nationalmanpower'=>$stepData['activity_nationalmanpower'.$ppx][$y],
						'activity_laborforce'=>$stepData['activity_laborforce'.$ppx][$y]);
						
						
						//echo "<pre>";
						//print_r($stepData);
						//exit;
						
						if($stepData['bid'.$ppx][$y] !=""){
							$bid = $stepData['bid'.$ppx][$y];
								$this->db->where('bid',$bid);
								$this->db->update('applicant_partner_businessrecord',$applicant_partner_businessrecord); 

						}
						else{
						$this->db->insert('applicant_partner_businessrecord',$applicant_partner_businessrecord);
					
						}
					}
					//////////////////////////////////////////////
					//////////////////////////////////////////////
					//////////////////////////////////////////////
				}
			}
	}
	
	function get_loan($id)
	{
		//$this->db->where("parent_id",$id);
		//$query = $this->db->get($this->_table_loan_calculate);
		  $sql = "SELECT * FROM `loan_calculate` AS lc WHERE lc.`loan_caculate_id` = '".$id."'";
		 $q = $this->db->query($sql);		
	
		// Check if Result is Greater Than Zero
		if($q->num_rows() > 0)
		{
			
			return  $q->row();
			
		}
	}
	public function addProfessionalExperience($applicantid,$dataarray) //Adding Professional Experience
	{
		for($j=0; $j<=3; $j++)
		{
			$option_one = $dataarray['option_one'][$j];
			$option_two = $dataarray['option_two'][$j];
			$option_three = $dataarray['option_three'][$j];
			$option_four = $dataarray['option_four'][$j];
			$option_five = $dataarray['option_five'][$j];
			$activities_one = $dataarray['activities_one'][$j];
			$activities_two = $dataarray['activities_two'][$j];
			$activities_three = $dataarray['activities_three'][$j];
			$activities_four = $dataarray['activities_four'][$j];
			$activities_five = $dataarray['activities_five'][$j];
			$applicant_professional_experience = array('applicant_id'=>$applicantid,'option_one'=>$option_one,'option_two'=>$option_two,
				'option_three'=>$option_three,'option_four'=>$option_four,'option_five'=>$option_five,'activities_one'=>$activities_one,
				'activities_two'=>$activities_two,'activities_three'=>$activities_three,'activities_four'=>$activities_four,
				'activities_five'=>$activities_five);
				$this->db->insert('applicant_professional_experience',$applicant_professional_experience);
		}
	}
	public function addBusinessRecord($applicantid,$data)
	{
		$applicant_activity = json_encode($data['applicant_activity']);
		for($k=0; $k<=3; $k++)
		{
			$activity_name = $data['activity_name'][$k];
			$activity_registration_no = $data['activity_registration_no'][$k];
			$activity_nationalmanpower = $data['activity_nationalmanpower'][$k];
			$activity_laborforce = $data['activity_laborforce'][$k];
			$applicant_businessrecord = array('applicant_id'=>$applicantid,'applicant_activity'=>$applicant_activity,'activity_name'=>$activity_name,
				'activity_registration_no'=>$activity_registration_no,'activity_nationalmanpower'=>$activity_nationalmanpower,'activity_laborforce'=>$activity_laborforce);
				if($activity_name!='') { 				
				$this->db->insert('applicant_businessrecord',$applicant_businessrecord);			
				}
		}
	}
	
		public function addDocument($applicantid,$addedby)
	{
		$DocumentQuery = $this->db->query("SELECT * FROM applicant_temp_document WHERE userid='".$addedby."'");
		foreach($DocumentQuery->result() as $dq)
		{
			$document = array('addedby'=>$addedby,'applicant_id'=>$applicantid,'document_id'=>$dq->document_id,'documentname'=>$dq->documentname);
			$this->db->insert('applicant_document',$document);
		}
	}
	
		public function addPhoneNumber($applicantid,$phonearray)
	{
		foreach($phonearray as $pkey => $pvalue)
		{
			if($pvalue!='')
			{
				$phone = array('applicant_id'=>$applicantid,'applicant_phone'=>$pvalue);
				$this->db->insert('applicant_phones',$phone);
			}
		}
	}
	public function saveStep_One()
	{
		$stepData = $this->input->post();		
		///Applicants
		//echo "<pre>";
		//print_r($stepData);
	//	exit;
		$addedby = $this->session->userdata('userid');
		$applicant_id = $stepData['applicant_id'];		
		if($applicant_id!='' && $addedby !='')
		{
			$this->applicants($stepData,$applicant_id,$addedby);			
			//Delete Records 
			$this->DeleteApplicantData($applicant_id);			
			//Phone Numbers 
			$this->addPhoneNumber($applicant_id,$stepData['phone_numbers']);	
			//Partners
			//Sending Sms
			$numbers = implode(',',$stepData['phone_numbers']);
			//send_sms_steps(1,$numbers);
			//send_sms_steps('step-1',$numbers);
			send_step_sms('',$numbers,'step-1');
			stepsLogs(array('aid'=>$applicant_id,'sid'=>$stepData['form_step']));
			$this->addPartner($applicant_id,$stepData);		
			//applicant_qualification => Adding Qualification			
			$this->addQualification($applicant_id,$stepData);
			$this->addProfessionalExperience($applicant_id,$stepData);
			$this->addBusinessRecord($applicant_id,$stepData);
			$this->addDocument($applicant_id,$addedby);		
		}
		else if($addedby !='')
		{		
			$applicant_id = $this->applicants($stepData,0,$addedby);
			//Phone Numbers 
			$this->addPhoneNumber($applicant_id,$stepData['phone_numbers']);
			//Partners
			//Sending Sms
			$numbers = implode(',',$stepData['phone_numbers']);
			send_sms_steps(1,$numbers);
			stepsLogs(array('aid'=>$applicant_id,'sid'=>$stepData['form_step']));
			$this->addPartner($applicant_id,$stepData);
			$this->addQualification($applicant_id,$stepData);
			$this->addProfessionalExperience($applicant_id,$stepData);
			$this->addBusinessRecord($applicant_id,$stepData);
			$this->addDocument($applicant_id,$addedby);	
		}
		echo $applicant_id;		
	}
	
	public function saveStep_One2()
	{
		$stepData = $this->input->post();		
		///Applicants
		$addedby = $this->session->userdata('userid');
		$applicant_id = $stepData['applicant_id'];
		if($applicant_id!='' && $addedby !='')
		{
			$applicants = array(
				
				'applicant_type'=>$stepData['applicant_type'],
				'applicant_first_name'=>$stepData['applicant_first_name'],
				'applicant_middle_name'=>$stepData['applicant_middle_name'],
				'applicant_last_name'=>$stepData['applicant_last_name'],
				'applicant_sur_name'=>$stepData['applicant_sur_name'],
				'applicant_gender'=>$stepData['applicant_gender'],
				'appliant_id_number'=>$stepData['appliant_id_number'],
				'applicant_cr_number'=>$stepData['applicant_cr_number'],
				'applicant_date_birth'=>$stepData['applicant_date_birth'],
				'applicant_marital_status'=>$stepData['applicant_marital_status'],
				'applicant_marital_status_text'=>$stepData['applicant_marital_status_text'],
				'applicant_job_staus'=>$stepData['applicant_job_staus'],
				'applicant_job_status_text'=>$stepData['applicant_job_status_text'],
				'option1'=>$stepData['option1'],
				'option2'=>$stepData['option2'],
				'applicant_main_powrnumber'=>$stepData['applicant_main_powrnumber'],
				'applicant_picture'=>$stepData['applicant_picture'],
				'applicant_mobile_number'=>$stepData['applicant_mobile_number'],
				'applicant_regisration_number'=>$stepData['applicant_regisration_number'],
				'applicant_social_category'=>$stepData['applicant_social_category'],
				'applicant_qualification'=>$stepData['applicant_qualification'],
				'applicant_qualification_text'=>$stepData['applicant_qualification_text'],
				'applicant_confirm'=>$stepData['applicant_confirm'],
				'applicant_project_name'=>$stepData['applicant_project_name'],
				'applicant_project_location'=>$stepData['applicant_project_location'],
				'province'=>$stepData['province'],
				'walaya'=>$stepData['walaya'],
				'village'=>$stepData['village'],
				'way'=>$stepData['way'],
				'home'=>$stepData['home'],
				'department'=>$stepData['department'],
				'zipcode'=>$stepData['zipcode'],
				'postalcode'=>$stepData['postalcode'],
				'mobile_number'=>$stepData['mobile_number'],
				'linephone'=>$stepData['linephone'],
				'fax'=>$stepData['fax'],
				'email'=>$stepData['email'],
				'refrence_number'=>$stepData['refrence_number'],
				'specialization'=>$stepData['specialization'],
				'form_step'=>$stepData['form_step'],
				'applicant_specialization'=>$stepData['applicant_specialization'],
				'applicant_institute'=>$stepData['applicant_institute'],
				'application_institute_year'=>$stepData['application_institute_year']);
			$this->db->where('applicant_id', $applicant_id);
			$this->db->update('applicants', $applicants); 
			//Delete Records 
				//$this->db->delete('applicant_phones', array('applicant_id' => $applicant_id)); 
				//$this->db->delete('applicant_partners', array('applicant_id' => $applicant_id)); 
				//$this->db->delete('applicant_qualification', array('applicant_id' => $applicant_id)); 
				//$this->db->delete('applicant_professional_experience', array('applicant_id' => $applicant_id)); 
				//$this->db->delete('applicant_businessrecord', array('applicant_id' => $applicant_id));						
			//Phone Numbers 
			foreach($stepData['phone_numbers'] as $pkey => $pvalue)
			{
				if($pvalue!='')
				{
					$phone = array('applicant_id'=>$applicant_id,'applicant_phone'=>$pvalue);
					$this->db->insert('applicant_phones',$phone);
				}
			}	
			//Partners
			//Sending Sms
			$numbers = implode(',',$stepData['phone_numbers']);
			send_sms_steps(1,$numbers);
			stepsLogs(array('aid'=>$applicant_id,'sid'=>$stepData['form_step']));
			/////////////
			//echo "<pre>";
			//print_r($stepData);
			//exit;
			for($p=0; $p<=3; $p++)
			{
				$partner_first_name = $stepData['partner_first_name'][$p];
				$partner_middle_name = $stepData['partner_middle_name'][$p];
				$partner_last_name = $stepData['partner_last_name'][$p];
				$partner_sur_name = $stepData['partner_sur_name'][$p];
				$partner_id_number = $stepData['partner_id_number'][$p];
				$partner_gender = $stepData['partner_gender'][$p];
				$partner_phone = $stepData['partner_phone_numbers'][$p];
				$partner_cr_number = $stepData['partner_cr_number'][$p];
				$partner_date_birth = $stepData['partner_date_birth'][$p];
				$partner_marital_status = $stepData['partner_marital_status'][$p];
				$partner_job_staus = $stepData['partner_job_staus'][$p];
				$partner_id = $stepData['partner_id'][$p];
				
				if($partner_id !=""){
					$this->db->where('partner_id', $partner_id);
					$this->db->update('applicant_partners', $applicants); 
			
				}
				elseif($partner_first_name!='')
				{
					$partner = array('applicant_id'=>$applicant_id,'partner_first_name'=>$partner_first_name,'partner_gender'=>$partner_gender,'partner_middle_name'=>$partner_middle_name,'partner_last_name'=>$partner_last_name,
					'partner_sur_name'=>$partner_sur_name,'partner_job_staus'=>$partner_job_staus,'partner_marital_status'=>$partner_marital_status,'partner_date_birth'=>$partner_date_birth,'partner_cr_number'=>$partner_cr_number,'partner_id_number'=>$partner_id_number,'partner_phone'=>$partner_phone_numbers);
					$this->db->insert('applicant_partners',$partner);
				}
			}
			
			//applicant_qualification => Adding Qualification
			$qualification = array('applicant_id'=>$applicant_id,'applicant_qualification'=>$stepData['applicant_qualification'],'applicant_qualification_text'=>$stepData['applicant_qualification_text'],
			'applicant_specialization'=>$stepData['applicant_specialization'],'applicant_institute'=>$stepData['applicant_institute'],
			'applicant_institute_text'=>$stepData['applicant_institute_text'],'application_institute_year'=>$stepData['application_institute_year'],
			'applicant_trainningcenter'=>$stepData['applicant_trainningcenter'],'applicant_specializations'=>$stepData['applicant_specializations'],'applicant_training_month'=>$stepData['applicant_training_month'],
			'applicant_vtco'=>$stepData['applicant_vtco'],'applicant_ytotc'=>$stepData['applicant_ytotc'],'applicant_other_trainning'=>$stepData['applicant_other_trainning']);
			$this->db->insert('applicant_qualification',$qualification);
			
			for($j=0; $j<=3; $j++)
			{
				$option_one = $stepData['option_one'][$j];
				$option_two = $stepData['option_two'][$j];
				$option_three = $stepData['option_three'][$j];
				$option_four = $stepData['option_four'][$j];
				$option_five = $stepData['option_five'][$j];
				$activities_one = $stepData['activities_one'][$j];
				$activities_two = $stepData['activities_two'][$j];
				$activities_three = $stepData['activities_three'][$j];
				$activities_four = $stepData['activities_four'][$j];
				$activities_five = $stepData['activities_five'][$j];
				$applicant_professional_experience = array('applicant_id'=>$applicant_id,'option_one'=>$option_one,'option_two'=>$option_two,
					'option_three'=>$option_three,'option_four'=>$option_four,'option_five'=>$option_five,'activities_one'=>$activities_one,
					'activities_two'=>$activities_two,'activities_three'=>$activities_three,'activities_four'=>$activities_four,
					'activities_five'=>$activities_five);
					$this->db->insert('applicant_professional_experience',$applicant_professional_experience);
			}
			
			//applicant_businessrecord Applicant Business Record
			$applicant_activity = json_encode($stepData['applicant_activity']);
			for($k=0; $k<=3; $k++)
			{
				$activity_name = $stepData['activity_name'][$k];
				$activity_registration_no = $stepData['activity_registration_no'][$k];
				$activity_nationalmanpower = $stepData['activity_nationalmanpower'][$k];
				$activity_laborforce = $stepData['activity_laborforce'][$k];
				$applicant_businessrecord = array('applicant_id'=>$applicant_id,'applicant_activity'=>$applicant_activity,'activity_name'=>$activity_name,
					'activity_registration_no'=>$activity_registration_no,'activity_nationalmanpower'=>$activity_nationalmanpower,'activity_laborforce'=>$activity_laborforce);
					if($activity_name!='') { 				
					$this->db->insert('applicant_businessrecord',$applicant_businessrecord);			
					}
			}
			
			//Transfaring Document
			$DocumentQuery = $this->db->query("SELECT * FROM applicant_temp_document WHERE userid='".$addedby."'");
			foreach($DocumentQuery->result() as $dq)
			{
				$document = array('addedby'=>$addedby,'applicant_id'=>$applicant_id,'document_id'=>$dq->document_id,'documentname'=>$dq->documentname);
				$this->db->insert('applicant_document',$document);
			}
		}
		else if($addedby !='')
		{		
			$applicants = array(
				'addedby'=>$addedby,
				'applicant_type'=>$stepData['applicant_type'],
				'applicant_first_name'=>$stepData['applicant_first_name'],
				'applicant_middle_name'=>$stepData['applicant_middle_name'],
				'applicant_last_name'=>$stepData['applicant_last_name'],
				'applicant_sur_name'=>$stepData['applicant_sur_name'],
				'applicant_gender'=>$stepData['applicant_gender'],
				'appliant_id_number'=>$stepData['appliant_id_number'],
				'applicant_cr_number'=>$stepData['applicant_cr_number'],
				'applicant_date_birth'=>$stepData['applicant_date_birth'],
				'applicant_marital_status'=>$stepData['applicant_marital_status'],
				'applicant_marital_status_text'=>$stepData['applicant_marital_status_text'],
				'applicant_job_staus'=>$stepData['applicant_job_staus'],
				'applicant_job_status_text'=>$stepData['applicant_job_status_text'],
				'option1'=>$stepData['option1'],
				'option2'=>$stepData['option2'],
				'applicant_main_powrnumber'=>$stepData['applicant_main_powrnumber'],
				'applicant_picture'=>$stepData['applicant_picture'],
				'applicant_mobile_number'=>$stepData['applicant_mobile_number'],
				'applicant_regisration_number'=>$stepData['applicant_regisration_number'],
				'applicant_social_category'=>$stepData['applicant_social_category'],
				'applicant_qualification'=>$stepData['applicant_qualification'],
				'applicant_qualification_text'=>$stepData['applicant_qualification_text'],
				'applicant_confirm'=>$stepData['applicant_confirm'],
				'applicant_project_name'=>$stepData['applicant_project_name'],
				'applicant_project_location'=>$stepData['applicant_project_location'],
				'province'=>$stepData['province'],
				'walaya'=>$stepData['walaya'],
				'village'=>$stepData['village'],
				'way'=>$stepData['way'],
				'home'=>$stepData['home'],
				'department'=>$stepData['department'],
				'zipcode'=>$stepData['zipcode'],
				'postalcode'=>$stepData['postalcode'],
				'mobile_number'=>$stepData['mobile_number'],
				'linephone'=>$stepData['linephone'],
				'fax'=>$stepData['fax'],
				'email'=>$stepData['email'],
				'refrence_number'=>$stepData['refrence_number'],
				'specialization'=>$stepData['specialization'],
				'form_step'=>$stepData['form_step'],
				'applicant_specialization'=>$stepData['applicant_specialization'],
				'applicant_institute'=>$stepData['applicant_institute'],
				'application_institute_year'=>$stepData['application_institute_year']);
			$this->db->insert('applicants',$applicants);
				$applicant_id = $this->db->insert_id();
			//Saving Log
				
			//Phone Numbers 
			foreach($stepData['phone_numbers'] as $pkey => $pvalue)
			{
				if($pvalue!='')
				{
					$phone = array('applicant_id'=>$applicant_id,'applicant_phone'=>$pvalue);
					$this->db->insert('applicant_phones',$phone);
				}
			}	
			//Partners
			//Sending Sms
			$numbers = implode(',',$stepData['phone_numbers']);
			send_sms_steps(1,$numbers);
			stepsLogs(array('aid'=>$applicant_id,'sid'=>$stepData['form_step']));
			/////////////
			for($p=0; $p<=4; $p++)
			{
				$partner_first_name = $stepData['partner_first_name'][$p];
				$partner_middle_name = $stepData['partner_middle_name'][$p];
				$partner_last_name = $stepData['partner_last_name'][$p];
				$partner_last_name = $stepData['partner_last_name'][$p];
				$partner_last_name = $stepData['partner_last_name'][$p];
				$partner_sur_name = $stepData['partner_sur_name'][$p];
				$partner_id_number = $stepData['partner_id_number'][$p];
				$partner_card_number = $stepData['partner_card_number'][$p];
				$partner_cr_number = $stepData['partner_cr_number'][$p];
				$partner_date_birth = $stepData['partner_date_birth'][$p];
				$partner_marital_status = $stepData['partner_marital_status'][$p];
				$partner_job_staus = $stepData['partner_job_staus'][$p];
				//partner_cr_number
				$partner_phone = $stepData['partner_phone_numbers'][$p][0];
				if($partner_first_name!='')
				{
					$partner = array('applicant_id'=>$applicant_id,'partner_first_name'=>$partner_first_name,'partner_gender'=>$partner_gender,'partner_middle_name'=>$partner_middle_name,'partner_last_name'=>$partner_last_name,
					'partner_sur_name'=>$partner_sur_name,'partner_id_number'=>$partner_id_number,'partner_phone'=>$partner_phone_numbers,'partner_card_number'=>$partner_card_number,'partner_cr_number'=>$partner_cr_number,'partner_date_birth'=>$partner_date_birth,'partner_marital_status'=>$partner_marital_status,'partner_job_staus'=>$partner_job_staus);
					$this->db->insert('applicant_partners',$partner);
					//$partner_id = $this->db->insert_id();
				}
				
				if(count($stepData['partner_phone_numbers'][$p])>1){
						$partnerStartIndex =1;
						foreach($stepData['partner_phone_numbers'] as $partnersphoneNumber){
							$partner_numbers= $stepData['partner_phone_numbers'][$p][$partnerStartIndex];
						$partnersphone = array('applicant_id'=>$applicant_id,'parnter_id'=>$partner_id,'parnter_number'=>$partner_numbers);
					$this->db->insert('applicant_partners_number',$partnersphone);
							
						}	
				}
				
			}
			
			
			//applicant_qualification => Adding Qualification
			$qualification = array('applicant_id'=>$applicant_id,'applicant_qualification'=>$stepData['applicant_qualification'],'applicant_qualification_text'=>$stepData['applicant_qualification_text'],
			'applicant_specialization'=>$stepData['applicant_specialization'],'applicant_institute'=>$stepData['applicant_institute'],
			'applicant_institute_text'=>$stepData['applicant_institute_text'],'application_institute_year'=>$stepData['application_institute_year'],
			'applicant_trainningcenter'=>$stepData['applicant_trainningcenter'],'applicant_specializations'=>$stepData['applicant_specializations'],'applicant_training_month'=>$stepData['applicant_training_month'],
			'applicant_vtco'=>$stepData['applicant_vtco'],'applicant_ytotc'=>$stepData['applicant_ytotc'],'applicant_other_trainning'=>$stepData['applicant_other_trainning']);
			$this->db->insert('applicant_qualification',$qualification);
			
			for($j=0; $j<=3; $j++)
			{
				$option_one = $stepData['option_one'][$j];
				$option_two = $stepData['option_two'][$j];
				$option_three = $stepData['option_three'][$j];
				$option_four = $stepData['option_four'][$j];
				$option_five = $stepData['option_five'][$j];
				$activities_one = $stepData['activities_one'][$j];
				$activities_two = $stepData['activities_two'][$j];
				$activities_three = $stepData['activities_three'][$j];
				$activities_four = $stepData['activities_four'][$j];
				$activities_five = $stepData['activities_five'][$j];
				$applicant_professional_experience = array('applicant_id'=>$applicant_id,'option_one'=>$option_one,'option_two'=>$option_two,
					'option_three'=>$option_three,'option_four'=>$option_four,'option_five'=>$option_five,'activities_one'=>$activities_one,
					'activities_two'=>$activities_two,'activities_three'=>$activities_three,'activities_four'=>$activities_four,
					'activities_five'=>$activities_five);
					$this->db->insert('applicant_professional_experience',$applicant_professional_experience);
			}
			
			//applicant_businessrecord Applicant Business Record
			$applicant_activity = json_encode($stepData['applicant_activity']);
			for($k=0; $k<=3; $k++)
			{
				$activity_name = $stepData['activity_name'][$k];
				$activity_registration_no = $stepData['activity_registration_no'][$k];
				$activity_nationalmanpower = $stepData['activity_nationalmanpower'][$k];
				$activity_laborforce = $stepData['activity_laborforce'][$k];
				$applicant_businessrecord = array('applicant_id'=>$applicant_id,'applicant_activity'=>$applicant_activity,'activity_name'=>$activity_name,
					'activity_registration_no'=>$activity_registration_no,'activity_nationalmanpower'=>$activity_nationalmanpower,'activity_laborforce'=>$activity_laborforce);
					if($activity_name!='') { 				
					$this->db->insert('applicant_businessrecord',$applicant_businessrecord);			
					}
			}
			
			//Transfaring Document
			$DocumentQuery = $this->db->query("SELECT * FROM applicant_temp_document WHERE userid='".$addedby."'");
			foreach($DocumentQuery->result() as $dq)
			{
				$document = array('addedby'=>$addedby,'applicant_id'=>$applicant_id,'document_id'=>$dq->document_id,'documentname'=>$dq->documentname);
				$this->db->insert('applicant_document',$document);
			}
		}
		echo $applicant_id;		
	}
	
	public function pick()
	{
		send_sms_steps(2,'92463374,93338241');
	}
	
	public function applicants($stepData,$applicantid='',$addedby='0')
	{
		$applicants = array(				
				'applicant_type'=>$stepData['applicant_type'],
				'addedby'=>$addedby,
				'applicant_first_name'=>$stepData['applicant_first_name'],
				'applicant_middle_name'=>$stepData['applicant_middle_name'],
				'applicant_last_name'=>$stepData['applicant_last_name'],
				'applicant_sur_name'=>$stepData['applicant_sur_name'],
				'applicant_gender'=>$stepData['applicant_gender'],
				'appliant_id_number'=>$stepData['appliant_id_number'],
				'applicant_cr_number'=>$stepData['applicant_cr_number'],
				'applicant_date_birth'=>$stepData['applicant_date_birth'],
				'applicant_marital_status'=>$stepData['applicant_marital_status'],
				'applicant_marital_status_text'=>$stepData['applicant_marital_status_text'],
				'applicant_job_staus'=>$stepData['applicant_job_staus'],
				'applicant_job_status_text'=>$stepData['applicant_job_status_text'],
				'option1'=>$stepData['option1'],
				'option_txt'=>$stepData['option_txt'],
				'option2'=>$stepData['option2'],
				'disable_type'=>$stepData['disable_type'],
				'applicant_disable_type_text'=>$stepData['applicant_disable_type_text'],
				'applicant_main_powrnumber'=>$stepData['applicant_main_powrnumber'],
				'applicant_picture'=>$stepData['applicant_picture'],
				'applicant_mobile_number'=>$stepData['applicant_mobile_number'],
				'applicant_regisration_number'=>$stepData['applicant_regisration_number'],
				'applicant_social_category'=>$stepData['applicant_social_category'],
				'applicant_qualification'=>$stepData['applicant_qualification'],
				'applicant_qualification_text'=>$stepData['applicant_qualification_text'],
				'applicant_confirm'=>$stepData['applicant_confirm'],
				'applicant_project_name'=>$stepData['applicant_project_name'],
				'applicant_project_location'=>$stepData['applicant_project_location'],
				'province'=>$stepData['province'],
				'walaya'=>$stepData['walaya'],
				'village'=>$stepData['village'],
				'way'=>$stepData['way'],
				'home'=>$stepData['home'],
				'department'=>$stepData['department'],
				'zipcode'=>$stepData['zipcode'],
				'postalcode'=>$stepData['postalcode'],
				'mobile_number'=>$stepData['mobile_number'],
				'linephone'=>$stepData['linephone'],
				'fax'=>$stepData['fax'],
				'email'=>$stepData['email'],
				'refrence_number'=>$stepData['refrence_number'],
				'specialization'=>$stepData['specialization'],
				'form_step'=>$stepData['form_step'],
				'applicant_specialization'=>$stepData['applicant_specialization'],
				'document_name_1'=>$stepData['document_name_1'],
				'document_name_2'=>$stepData['document_name_2'],
				'document_name_3'=>$stepData['document_name_3'],
				'document_name_5'=>$stepData['document_name_5'],
				'document_name_7'=>$stepData['document_name_7'],
				'document_name_8'=>$stepData['document_name_8'],
				'application_institute_year'=>$stepData['application_institute_year']);
		if($applicantid!='')
		{
			$this->db->where('applicant_id', $applicantid);
			$this->db->update('applicants', $applicants);
		}
		else
		{
			$this->db->insert('applicants',$applicants);
			$applicantid = $this->db->insert_id();
		}
		return $applicantid;
	}
	public function getLastDetail($tempid='')
	{		
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
		return $arr;
	}
	
	public function getHistory($tempid)
	{
		$q = $this->db->query("SELECT a.`idcard`,b.`notesdate`,b.`tempid`,b.`notestext`,c.`user_name`,c.`firstname`,c.`lastname`,b.inquerytype FROM `main_applicant` AS a, `main_notes` AS b, admin_users AS c WHERE a.`tempid`=b.`tempid` AND b.`userid`=c.`id` AND b.tempid='".$tempid."' ORDER BY b.`notesdate` DESC;");
		$int  = 0;
		foreach($q->result() as $data)
		{
			
			$tempid = $data->tempid;
			$ar[$int]['id_card'] = $data->idcard;
			$ar[$int]['system_id'] = $data->tempid;
			$ar[$int]['admin_name'] = $data->firstname.' '.$data->lastame;
			$ar[$int]['system_time'] = arabic_date(date('h:i:s',strtotime($data->notesdate)));
			$ar[$int]['system_date'] = arabic_date(date('d/m/Y',strtotime($data->notesdate)));
			$ar[$int]['notes'] = $data->notestext;
			$inqtype = explode(',',$data->inquerytype);
			foreach($inqtype as $data)
			{
				$dataexp = explode('_',$data);
				$qx = $this->db->query("SELECT `list_name` FROM list_management WHERE `list_id`='".$dataexp[0]."' ORDER BY `list_name` ASC;");
				$cx = 0;
				foreach($qx->result_array() as $dx)
				{
					$ar[$int]['inq'][] = array('name'=>$dx['list_name'],'date'=>arabic_date($dataexp[1]));
					$cx++;
				}
			}
			$int++;
		}
		
		return $ar; 
	}
}

?>