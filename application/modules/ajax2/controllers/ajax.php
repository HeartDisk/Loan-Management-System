<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller 
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
		$this->load->model('ajax_model', 'ajax');
	}
	
	public function pick($tempid)
	{
		$nnn = get_mobilenumbers($tempid);	
		send_sms(1,$nnn,1,'شيبشسب شيبش شيبشيسب شيبشيب');
	}
	
	public function timeline($id,$step)
	{
		$data['id'] = $id;
		$data['step'] = $step;
		$this->load->view('timeline',$data);
	}
	
	public function save_request_data()
	{
		$this->ajax->saveStep_One();	
	}
	
	public function getWilayats()
	{	
		$province = $this->input->post('province');
		
		$this->db->select('WILAYATNAME,ID');
		$this->db->from('election_wilayats');
		$this->db->where('REIGONID',$province); 		
		$this->db->order_by("WILAYATNAME", "ASC");
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$html = '<option value="">اختر الولاية</option>';
			foreach($query->result() as $data)
			{
				$html .='<option value="'.$data->ID.'">'.$data->WILAYATNAME.'</option>';
			}
			echo $html;
		}
	}
	
	public function getParentsRoles()
	{
		$name='user_role_id';
		$value='';
		$req='req';
		$parent_role_id = $this->input->post('parent_role_id');
		
		$this->db->select('role_id,role_name,role_parent_id');
		$this->db->from('user_roles');
		$this->db->where('role_parent_id',$parent_role_id); 		
		$this->db->order_by("role_name", "ASC");
		$query = $this->db->get();
		
		$dropdown = '<select  name="'.$name.'" id="'.$name.'" placeholder="اختر الوظيفة" >';
		$dropdown .= '<option value="">اختر الوظيفة</option>';

		foreach($query->result() as $row)
		{
			$dropdown .= '<option value="'.$row->role_id.'" ';
			if($value==$row->role_id)
			{
				$dropdown .= 'selected="selected"';
			}
			$dropdown .= '>'.$row->role_name.'</option>';
		}
		$dropdown .= '</select>';
		echo($dropdown);
	}
	
	function getChildData(){
		$name='loan_category_child_id';
		$value='';
		$req='req';
		$parent_role_id = $this->input->post('parent_role_id');
		
		//$this->db->select('role_id,role_name,role_parent_id');
		//$this->db->from('user_roles');
		//$this->db->where('role_parent_id',$parent_role_id); 		
		//$this->db->order_by("role_name", "ASC");
		$this->db->select('*');
		$this->db->from('loan_category');
		$this->db->where('parent_id',$parent_role_id); 
		$query = $this->db->get();
		
		$dropdown = '<select  name="'.$name.'" id="'.$name.'" placeholder="اختر " >';
		$dropdown .= '<option value="">اختر </option>';

		foreach($query->result() as $row)
		{
			$dropdown .= '<option value="'.$row->loan_category_id.'" ';
			if($value==$row->loan_category_id)
			{
				$dropdown .= 'selected="selected"';
			}
			$dropdown .= '>'.$row->loan_category_name.'</option>';
		}
		$dropdown .= '</select>';
		echo($dropdown);
	}
	
	public function checkLoginID()
	{	
		$loginid = $this->input->post('loginid');		
		$this->db->select('id');
		$this->db->from('admin_users');
		$this->db->where('user_name',$loginid);
		$query = $this->db->get();		
		if($query->num_rows() > 0)
		{
			$ar['result'] = 'error';
		}
		else
		{
			$ar['result'] = 'success';
		}
		$query->free_result();
		echo json_encode($ar);
	}	
	
	public function getChilds()
	{	
		$role_id = trim($this->input->post('role_id'));
		
		$this->db->select('role_id,role_name');
		$this->db->from('user_roles');
		$this->db->where_in('role_parent_id',$role_id); 		
		$this->db->order_by("role_name", "ASC");
		$query = $this->db->query("SELECT role_id, role_name FROM user_roles WHERE role_parent_id IN ($role_id) ORDER BY role_name ASC");
		// $query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		
		if($query->num_rows() > 0)
		{
			$html = '<option value="">اختر الولاية</option>';
			foreach($query->result() as $data)
			{
				$html .='<option value="'.$data->role_id.'">'.$data->role_name.'</option>';
			}
			echo $html;
		}
	}
	
	public function getLoanAmount()
	{	
		$loan_limit = $this->input->post('loan_limit');
		$loan_amount = $this->input->post('loan_amount');	
		//Get Loan Query
		$qx = $this->db->query("SELECT loan_start_amount,loan_end_amount FROM loan_calculate WHERE loan_category_id='".$loan_limit."' LIMIT 0,1");
		foreach($qx->result() as $loan)
		{
			$msg_xx = arabic_date($loan->loan_start_amount).' ~ '.arabic_date($loan->loan_end_amount);
		}
		
		////////////////
		$this->db->select('*');
		$this->db->from('loan_calculate');
		$this->db->where('loan_category_id',$loan_limit); 		
		$this->db->where('loan_start_amount <=', $loan_amount);
		$this->db->where('loan_end_amount >=', $loan_amount);
		$this->db->limit(1);		
		$query = $this->db->get();
			
				
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $d)
			{			
				$startingdate = date('d/m/Y', strtotime('+1 years'));
				$data['percentage'] = arabic_date($d->loan_percentage).'&nbsp;&nbsp;%';
				$data['current_year'] = date('d/m/Y');
				$data['starting_year'] = $startingdate;
				$data['total_year'] = $d->loan_expire_day.' '.$d->loan_expire_timeperiod.'s';
				$data['loan_age'] = date("d/m/Y", strtotime(date("d/m/Y", strtotime($startingdate)) . " + ".$d->loan_expire_day." ".$d->loan_expire_timeperiod.""));
				$data['amount'] = $loan_amount;
				$data['er'] = '';
				for($i=1; $i<$d->loan_expire_day; $i++)
				{
					$catData = date("d/m/Y", strtotime(date("d/m/Y", strtotime($startingdate)) . " + ".$i." ".$d->loan_expire_timeperiod.""));
					$data['cat'][] = $catData;
					
					if($d->loan_expire_timeperiod=='year')
					{	$data['loan_amount'][] = calcPay($loan_amount, $d->loan_expire_day, 0, $d->loan_percentage,2, 12,0)+rand(0.1,0.99);	
						$data['percent_amount'] = calcPay($loan_amount, $d->loan_expire_day, 0, $d->loan_percentage,2, 12,0,'A');	
					}
					//$data['loan_amount'][] = rand(0.1,0.99);	}	
					else if($d->loan_expire_timeperiod=='month')
					{	$data['loan_amount'][] = calcPay($loan_amount,0 , $d->loan_expire_day, $d->loan_percentage,2, 12,0);
						$data['percent_amount'] = calcPay($loan_amount,0, $d->loan_expire_day, $d->loan_percentage,2, 12,0,'A');	
					}
				}
				//$data['calculation'][] = 	
				echo json_encode($data);
			}
		}
		else
		{
			$data['er'] = 'عذرا لا يمكو كتابة هذا المبلغ في هذا البرنامج لابد ان يكةن اقل من '.$msg_xx;
			echo json_encode($data);
		}
	}
	
	public function history($tempid='')
	{
		$this->_data['history'] = $this->ajax->getHistory($tempid);
		$this->load->view('history',$this->_data);
	}
	
	public function getfulldetail($idcard='1231231321')
	{
		$this->ajax->getDetail($idcard);
		
	}
	
	public function getIDCardNumber()
	{
		$term = $this->input->get('term');
		$query = $this->db->query("SELECT tempid, CONCAT(first_name,' ',middle_name,' ',last_name,' ',family_name) as applicant_name FROM main_applicant WHERE idcard LIKE '%".$term."%' Order by first_name ASC");
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				//{"id":"Upupa epops","label":"Eurasian Hoopoe","value":"Eurasian Hoopoe"}
				$arr[] = array('id'=>$data->tempid,'label'=>$data->applicant_name,'value'=>$data->tempid);
			}
			echo json_encode($arr);
		}
	}
	
	public function getApplicantPhone()
	{
		$term = $this->input->get('term');
		$query = $this->db->query("SELECT a.tempid,CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name,' ',b.family_name) AS applicant_name FROM `main_phone` AS a,`main_applicant` AS b WHERE b.`tempid`=a.`tempid` AND a.phonenumber LIKE '%".$term."%' Order by b.first_name ASC;");
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				//{"id":"Upupa epops","label":"Eurasian Hoopoe","value":"Eurasian Hoopoe"}
				$arr[] = array('id'=>$data->tempid,'label'=>$data->applicant_name,'value'=>$data->tempid);
			}
			echo json_encode($arr);
		}
	}	
	
	public function getListofApplicant()
	{
		$term = $this->input->get('term');
		$checkingNumber = substr($term,0,1);
		$checkingid = substr($term,0,2);
		if($checkingNumber==9)
		{
			$query = $this->db->query("SELECT a.phonenumber,a.tempid,CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name,' ',b.family_name) AS applicant_name FROM `main_phone` AS a,`main_applicant` AS b WHERE b.`tempid`=a.`tempid` AND a.phonenumber LIKE '%".$term."%' Order by b.first_name ASC;");
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $data)
				{
					$arr[] = array('id'=>$data->tempid,'label'=>$data->applicant_name,'value'=>$data->tempid);
				}
				echo json_encode($arr);
			}
		}
		else if($checkingid=='00')
		{
			
			$query = $this->db->query("SELECT a.tempid, CONCAT(b.first_name,' ',b.middle_name,' ',b.last_name,' ',b.family_name) AS applicant_name FROM `main` AS a,`main_applicant` AS b WHERE b.`tempid`=a.`tempid` AND a.`tempid_value` LIKE '%".$term."%' GROUP BY a.tempid Order by b.first_name ASC;");
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $data)
				{
					$arr[] = array('id'=>$data->tempid,'label'=>$data->applicant_name,'value'=>$data->tempid);
				}
				echo json_encode($arr);
			}
		}
		else
		{
			$query = "SELECT tempid, CONCAT(first_name,' ',middle_name,' ',last_name,' ',family_name) as applicant_name FROM main_applicant WHERE ";
			if (is_numeric($term))
			{
				$query .= " idcard LIKE '%".$term."%' ";
			}
			else
			{
				$term_explode = explode(' ',$term);
				if($term_explode[0]!='')
				{
					$query .= " first_name LIKE '%".$term_explode[0]."%' AND ";
				}
				if($term_explode[1]!='')
				{
					$query .= " middle_name LIKE '%".$term_explode[1]."%' AND ";
				}
				if($term_explode[2]!='')
				{
					$query .= " last_name LIKE '%".$term_explode[2]."%' AND ";
				}
				if($term_explode[3]!='')
				{
					$query .= " family_name LIKE '%".$term_explode[3]."%' AND ";
				}
					$query .= " idcard!='' ";								
			}
			$query .= " Order by first_name ASC ";
			
			$query = $this->db->query($query);
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $data)
				{
					//{"id":"Upupa epops","label":"Eurasian Hoopoe","value":"Eurasian Hoopoe"}
					$arr[] = array('id'=>$data->tempid,'label'=>$data->applicant_name,'value'=>$data->tempid);
				}
				echo json_encode($arr);
			}
		}		
	}
	
	public function saveTempInfo()
	{
		
		//echo "<pre>";
		//print_r($saveTempInfo);
		//exit;
		/*		value:Noor
		tempid:4
		applicantid:3
		type:Applicant
		column:first_name*/
		$reviews = $this->input->post('reviews');
		$value = $this->input->post('value');
		$tempid = $this->input->post('tempid');
		$applicantid = $this->input->post('applicantid');
		$type = $this->input->post('type');
		$column = $this->input->post('column');
		$phoneid = $this->input->post('phoneid');
		$txt = $this->input->post('txt');
		if($reviews=='')
		{
			$tmp = 'temp_';
		}
		switch($type)
		{
			case 'Applicant';
				$data = array($column => $value);				
				$this->db->where('applicantid', $applicantid);
				$this->db->update($tmp.'main_applicant', $data); 
			break;
			
			case 'Phone';
				$data = array('phonenumber' => $value);				
				$this->db->where('phoneid', $phoneid);
				$this->db->update($tmp.'main_phone', $data);
			break;
			
			case 'Main';
				$data = array($column => $value);				
				$this->db->where('tempid', $tempid);
				$this->db->update($tmp.'main', $data);
			break;
			
			case 'Inquiry';								
				$this->db->insert($tmp.'main_inquirytype',array('tempid'=>$tempid,$column=>$value));			
			break;
			
			case 'Notes';	
				if($value!='')
				{
					$this->db->insert($tmp.'main_notes',array('tempid'=>$tempid,$column=>$value,'userid'=>$this->session->userdata('userid'),'notesip'=>$_SERVER['REMOTE_ADDR'],'inquerytype'=>$txt));
					echo 1;
				}
				else
				{
					echo 0;
				}
			break;
		}

	}
	
	public function addNewPartner()
	{
		$tempid = $this->input->post('tempid');
		$this->db->insert('temp_main_applicant',array('tempid'=>$tempid,'applicanttype'=>'ذكر'));
		$applicantid = $this->db->insert_id();
						$this->db->insert('temp_main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));
						
		$this->load->view('new_partner',array('a'=>$applicantid,'t'=>$tempid));
	}
	
	public function removePartner()
	{
		$applicant = $this->input->post('applicant');
		$this->db->delete('temp_main_applicant', array('applicantid' => $applicant));		
	}
		
	public function new_phone()
	{
		$tempid = $this->input->post('tempid');
		$applicantid = $this->input->post('applicantid');
		$reviews = $this->input->post('reviews');
		if($reviews==1)
		{
			$temp = '';
		}
		else
		{
			$temp = 'temp_';
		}
		$this->db->insert($temp.'main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));
		$phoneid = $this->db->insert_id();
		
		$this->load->view('new_phone',array('a'=>$applicantid,'t'=>$tempid,'p'=>$phoneid));						
	}
	
	function new_musanif(){
		//musanifIndex
		$musanifIndex = $this->input->post('musanifIndex');
		$musanifIndex++;
		$this->load->view('new_musanif',array('a'=>$musanifIndex));
	}
	
	public function removePhone()
	{
		$phoneid = $this->input->post('phoneid');
		$this->db->delete('temp_main_phone', array('phoneid' => $phoneid));		
	}		
}


?>