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
	
	public function saveStep_One()
	{
		$stepData = $this->input->post();		
		///Applicants
		$addedby = $this->session->userdata('userid');
		$applicant_id = $stepData['applicant_id'];
		if($applicant_id!='')
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
				$this->db->delete('applicant_phones', array('applicant_id' => $applicant_id)); 
				$this->db->delete('applicant_partners', array('applicant_id' => $applicant_id)); 
				$this->db->delete('applicant_qualification', array('applicant_id' => $applicant_id)); 
				$this->db->delete('applicant_professional_experience', array('applicant_id' => $applicant_id)); 
				$this->db->delete('applicant_businessrecord', array('applicant_id' => $applicant_id));						
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
			for($p=0; $p<=3; $p++)
			{
				$partner_first_name = $stepData['partner_first_name'][$p];
				$partner_middle_name = $stepData['partner_middle_name'][$p];
				$partner_last_name = $stepData['partner_last_name'][$p];
				$partner_sur_name = $stepData['partner_sur_name'][$p];
				$partner_id_number = $stepData['partner_id_number'][$p];
				$partner_gender = $stepData['partner_gender'][$p];
				$partner_phone = $stepData['partner_phone_numbers'][$p];
				if($partner_first_name!='')
				{
					$partner = array('applicant_id'=>$applicant_id,'partner_first_name'=>$partner_first_name,'partner_gender'=>$partner_gender,'partner_middle_name'=>$partner_middle_name,'partner_last_name'=>$partner_last_name,
					'partner_sur_name'=>$partner_sur_name,'partner_id_number'=>$partner_id_number,'partner_phone'=>$partner_phone_numbers);
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
		else
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
				$partner_sur_name = $stepData['partner_sur_name'][$p];
				$partner_id_number = $stepData['partner_id_number'][$p];
				$partner_gender = $stepData['partner_gender'][$p];
				$partner_phone = $stepData['partner_phone_numbers'][$p];
				if($partner_first_name!='')
				{
					$partner = array('applicant_id'=>$applicant_id,'partner_first_name'=>$partner_first_name,'partner_gender'=>$partner_gender,'partner_middle_name'=>$partner_middle_name,'partner_last_name'=>$partner_last_name,
					'partner_sur_name'=>$partner_sur_name,'partner_id_number'=>$partner_id_number,'partner_phone'=>$partner_phone_numbers);
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
		echo $applicant_id;		
	}
	
	public function pick()
	{
		send_sms_steps(2,'92463374,93338241');
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