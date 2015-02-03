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
		$this->_data['user_info']	=	userinfo();
		$this->load->model('ajax_model', 'ajax');

	}
	
	

	public function user_history()
	{

		$userid = $this->input->post('userid');
		$first_date = $this->input->post('first_date');
		$second_date = $this->input->post('second_date');
		$query = "SELECT admin_users.`firstname`, admin_users.`lastname`, application_activity.* FROM application_activity, admin_users WHERE application_activity.userid = admin_users.id AND ";
		$query .= " application_activity.`datatable` NOT IN ('temp_document','temp_main_applicant','temp_main_inquirytype','temp_main_notes','temp_main_phone') AND ";
		if($userid!='')
		{	$query .= "application_activity.userid='".$userid."' AND ";	}
		
		if($first_date!='' && $second_date!='')
		{
			$query .= "(DATE(application_activity.`activitytime`) >= '".$first_date."' AND DATE(application_activity.`activitytime`) <= '".$second_date."') AND ";
		}
		else if($first_date!='')
		{
			$query .= "DATE(application_activity.`activitytime`) = '".$first_date."' AND ";
		}
		else if($second_date!='')
		{
			$query .= "DATE(application_activity.`activitytime`) = '".$second_date."' AND ";
		}
		else
		{
			//$query .= "DATE(application_activity.`activitytime`) = '".date('Y-m-d')."' AND ";
		}
			$query .= " application_activity.activityid > 0 ORDER BY application_activity.`activitytime` DESC";
			
		$res = $this->db->query($query);
		$this->load->view('userhistory',array('dd'=>$res->result()));
	}
	
	///-------------------30/12/2014
	public function getIplocation($ip)
	{
		//$ip = $this->input->post('ip');
		if($ip=='Testing')
		{
			echo 'Testing Server';
		}
		else
		{
			$ipdata = file_get_contents('http://api.db-ip.com/addrinfo?addr='.$ip.'&api_key=77fd931df0fadd8577f9548612430df7d63c0be6');
			$iparray = json_decode($ipdata,TRUE);
			echo $iparray['city'].', '.$iparray['stateprov'].', '.$iparray['country'];
		}
	}
	
	public function getlogdetail($logid)
	{
		$this->db->select('dataid');
		$this->db->from('application_activity');
		$this->db->where('activityid',$logid); 
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{			
			foreach($query->result() as $data)
			{
				$logjson = explode(',',$data->dataid);
				$this->load->view('logdata',array('noor'=>$logjson));	
			}
			
		}
		else
		{
			echo('<center>البيانات لم يتم العثور</center>');
		}
	}
	
	
	
	function add_bank_response(){
				$p = $this->input->post();
				//echo "<pre>";
				//print_r($p);
			$list_id = $p['list_id'];
			
			if(isset($p['list_reason']) && $p['list_reason']!=""){
			$data['reject_reason'] = $p['list_reason'];
			 $data['is_reject'] =1;
			}
			else{
				$data['reject_reason'] = '';
				$data['is_reject'] =0;
				
				$data['loan_id'] = $p['list_accept'];
			}
			
			if(isset($p['list_id']))
			$data['applicant_id'] = $p['list_id'];
			else
			$data['applicant_id'] = '';
			
			
			$this->db->select('*');
		$this->db->from('bank_response');
		$this->db->where('applicant_id',$list_id); 
		$query = $this->db->get();
		if($query->num_rows() > 0){
			
			$this->db->where('applicant_id',$data['applicant_id']);
			echo $this->db->update('bank_response',$data);

		}
		else{
			
			echo $this->db->insert('bank_response',$data);
		}
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
	
	function loadChild(){
		$p = $this->input->post();
		///echo "<pre>";
		//print_r($p);
		$id = $this->input->post('parentId');
		$loadChild = $this->input->post('child_id');
		
		echo loan_sub_category('loan_limit',$id,$loadChild);
	}
	
	function loadHiddenData(){
		$id = $this->input->post('id');
		$response ='';
		$loan_calculate = $this->ajax->get_loan($id);
		echo json_encode($loan_calculate);
		
		//echo "<pre>";
		//print_r($loan_calculate);
		//exit;
		/*if(!empty($loan_calculate)){
			foreach($loan_calculate as $calculate){
			$response.='<input type="hidden" value="'.$calculate->loan_start_amount.'" id="loan_start'.$calculate->loan_caculate_id.'" />';
               $response.='<input type="hidden" value="'.$calculate->loan_end_amount.'" id="loan_end'.$calculate->loan_caculate_id.'" />';
               $response.='<input type="hidden" value="'.$calculate->loan_starting_day.'" id="loan_starting_day'.$calculate->loan_caculate_id.'" />';
               $response.='<input type="hidden" value="'.$calculate->loan_percentage.'" id="loan_percentage'.$calculate->loan_caculate_id.'" />';
               $response.='<input type="hidden" value="'.$calculate->loan_aplicant_percentage.'" id="loan_aplicant_percentage'.$calculate->loan_caculate_id.' />';
               $response.='<input type="hidden" value="'.$calculate->loan_expire_day.'" id="loan_expire_day'.$calculate->loan_caculate_id.'" />';
               $response.='<input type="hidden" value="'.$calculate->loan_expire_timeperiod.'" id="loan_expire_time'.$calculate->loan_caculate_id.'" />'; 
    
			}
		}*/
		//echo  $response;
	}


	function checkValue(){
		$id = $this->input->post('id');
		$cr = $this->input->post('cr');
		$number = $this->input->post('number');
		
		if(isset($id) && $id!=""){
			echo $this->ajax->check_applicant('id_number',$id);
		}
		elseif(isset($cr) && $cr!=""){
			//echo $cr;
			echo $this->ajax->check_applicant('cr_number',$cr);
		}
		elseif(isset($number) && $number!=""){
			echo $this->ajax->check_applicant('phone',$number);
		}
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

    /////////14-01-2015////////////////////////////////START
    public function getpermission()
    {
        $uid = $this->input->post('uid');
        $this->db->select('permission');
        $this->db->from('system_permission');
        $this->db->where('userid',$uid);
        $uquery = $this->db->get();
        foreach($uquery->result() as $ures)
        {
            echo $ures->permission;
        }
    }
    public function roleandusers()
    {
        $user_parent_role = $this->input->post('user_parent_role');
        $user_role_id = $this->input->post('user_role_id');
        if($user_parent_role!='' && $user_role_id=='')
        {
            $this->db->select('role_id,role_name');
            $this->db->from('user_roles');
            $this->db->where('role_parent_id',$user_parent_role);
            $this->db->order_by("role_name", "ASC");
            $query = $this->db->get();
            $dropdown = '<option value="">اختر الوظيفة</option>';
            foreach($query->result() as $row)
            {	$dropdown .= '<option value="'.$row->role_id.'" >'.$row->role_name.'</option>';	}
            $arr['role'] = $dropdown;
        }

        $this->db->select('id,user_name,firstname,lastname,user_role_id');
        $this->db->from('admin_users');
        $this->db->where('status',1);
        if($user_parent_role!='')
        {	$this->db->where('user_parent_role',$user_parent_role);	}

        if($user_role_id!='')
        {	$this->db->where('user_role_id',$user_role_id);	}

        $this->db->order_by("firstname", "ASC");
        $uquery = $this->db->get();
        $arr['uc'] = '('.arabic_date($uquery->num_rows()).')';
        $html = '';
        foreach($uquery->result() as $ures)
        {
            $html .= '<div id="win_'.$ures->id.'" class="mcontent u_count"><input id="chk_'.$ures->id.'" type="checkbox" class="ucount" name="user[]" value="'.$ures->id.'" />'.$ures->firstname.' '.$ures->lastname.' ('.$ures->user_name.') ';
            if($this->checkPer($ures->id)>0)
            {	$html .= '<img onclick="editpermission(\''.$ures->id.'\');" src="../images/listicon/001_41.png" class="editperm">'; }
            $html .= '</div>';
        }
        $arr['user'] = $html;
        echo json_encode($arr);
    }

    public function justuser()
    {
        $this->db->select('id,user_name,firstname,lastname,user_role_id');
        $this->db->from('admin_users');
        $this->db->where('status',1);
        $this->db->order_by("firstname", "ASC");
        $uquery = $this->db->get();
        $arr['role'] = '';
        $arr['uc'] = '('.arabic_date($uquery->num_rows()).')';
        $html = '';
        foreach($uquery->result() as $ures)
        {
            $html .= '<div id="win_'.$ures->id.'" class="mcontent u_count"><input id="chk_'.$ures->id.'" type="checkbox" class="ucount" name="user[]" value="'.$ures->id.'" />'.$ures->firstname.' '.$ures->lastname.' ('.$ures->user_name.') ';
            if($this->checkPer($ures->id)>0)
            {	$html .= '<img onclick="editpermission(\''.$ures->id.'\');" src="../images/listicon/001_41.png" class="editperm">'; }
            $html .= '</div>';
        }
        $arr['user'] = $html;
        echo json_encode($arr);
    }

    public function checkPer($uid)
    {
        $nQuery = $this->db->query("SELECT permid FROM system_permission WHERE userid='".$uid."'");
        return $nQuery->num_rows();
    }
    /////////14-01-2015////////////////////////////////END

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

	
	public function saveTempInfo()
	{
		$reviews = $this->input->post('reviews');
		$value = $this->input->post('value');
		$tempid = $this->input->post('tempid');
		$applicantid = $this->input->post('applicantid');
		$type = $this->input->post('type');
		$column = $this->input->post('column');
		$phoneid = $this->input->post('phoneid');
		$txt = $this->input->post('txt');
		if($reviews=='')
		{	$tmp = 'temp_';	}

		switch($type)
		{
			case 'Applicant';

				$exp = explode('_',$column);
				if($exp[0]=='datepicker')
				{
					$data = array($exp[0] => $value);
				}
				else
				{				
					$data = array($column => $value);					
				}
				if($applicantid!='' && $applicantid!='0')
				{
					$this->db->where('applicantid', $applicantid);
					$this->db->update($tmp.'main_applicant', $data); 
				}
			break;
			case 'Phone';
				$data = array('phonenumber' => $value);
				$this->db->where('phoneid', $phoneid);
				$this->db->update($tmp.'main_phone', $data);
			break;
			case 'Main';
				if($tempid!='' && $tempid!='0')
				{
					$data = array($column => $value);		
					$this->db->where('tempid', $tempid);
					$this->db->update($tmp.'main', $data);
				}
			break;
			case 'Inquiry';
				if($tempid!='' && $tempid!='0')
				{
					$this->db->insert($tmp.'main_inquirytype',array('tempid'=>$tempid,$column=>$value));
				}
			break;
			case 'Notes';	
				
					if($tempid!='' && $tempid!='0')
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

	

	

	

	public function addNewPartner()

	{
		for($a=1;$a<=4;$a++){
	
		$tempid = $this->input->post('tempid');

		$this->db->insert('temp_main_applicant',array('tempid'=>$tempid,'applicanttype'=>'ذكر'));

		$applicantids[] = $this->db->insert_id();

						$this->db->insert('temp_main_phone',array('tempid'=>$tempid,'applicantid'=>$applicantid));

		}

		return json_encode($applicantids);
		//$this->load->view('new_partner',array('a'=>$applicantid,'t'=>$tempid));

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
		$counter = $this->input->post('counter');

		$musanifIndex++;

		$this->load->view('new_musanif',array('a'=>$musanifIndex,'b'=>$counter));

	}

	

	public function removePhone()

	{

		$phoneid = $this->input->post('phoneid');

		$this->db->delete('temp_main_phone', array('phoneid' => $phoneid));		

	}		

}





?>