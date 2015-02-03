<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Followup_model extends CI_Model {

	

	/*

	* Properties

	*/

	private $_table_branches;

//----------------------------------------------------------------------

    

	/*

	* Constructor

	*/

	

	function __construct()

    {

        parent::__construct();

		

		//Load Table Names from Config

		$this->_table_branches 			=  $this->config->item('table_branches');
		$this->bank = $this->load->database('bank',TRUE);

    }

	

//----------------------------------------------------------------------

	/*

	* Insert User Record

	* @param array $data

	* return True

	*/

	function add_branche($data)

	{

		$this->db->insert($this->_table_branches,$data);

		

		return TRUE;

	}
	
	function get_applicant_partners($applicant_id){
				
		$this->db->where("applicant_id",$applicant_id);
		$applicant_partners = $this->db->get('applicant_partners');
		if($applicant_partners->num_rows() > 0){
			$arr =  $applicant_partners->result();
		}
		return $arr;
	}

//----------------------------------------------------------------------

	/*

	* Get Data for Listing for Store

	*/
	
	function checkData($table,$id){
		//			$this->db->insert('temp_main',array('userid'=>$userid));

		$this->db->where('applicant_id',$id);

		$query = $this->db->get($table);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return true;

		}
		else{
			return false;
		}
	}
	
	function getdataBytable($table,$id){
			$this->db->select('*,'.$table.'.created as visit');
			$this->db->where('applicant_id',$id);
			$this->db->join('admin_users',"id=user_id");
			$query = $this->db->get($table);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->result();

		}
		else{
			return false;
		}
	}
	//SELECT COUNT(*)  AS total FROM `about_proejct_details`
	function getAllBankData(){
		$sql = "SELECT * FROM `bank_loan_list`";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					return $result = $q->result();
					//echo "<pre>";
				  //print_r($result);
				}
				else
				{
				  return FALSE;
				}
	}
	
	function getBankAdmin($id){
		$sql = "SELECT au.`bank_branch_id` FROM `admin_users` AS au WHERE au.`id` = '".$id."'";
		$q = $this->db->query($sql);
				if($q->num_rows()>0){
					 $result = $q->row();
					 $bId = $result->bank_branch_id;
		$sql = "SELECT GROUP_CONCAT(wilaya_id) AS wilaya FROM `bank_branches_wilaya` AS bbw WHERE  bbw.`branch_id` = '".$bId."'";	 	
		$q = $this->db->query($sql);
				if($q->num_rows()>0){
					 $result = $q->row();
				}
				else{
					return false;
				}
					//echo "<pre>";
				  //print_r($result);
				}
				else
				{
				  return FALSE;
				}
	}
	
	function getdataBypk($table,$pk,$id){
			$this->db->select('*,'.$table.'.created as visit');
			$this->db->where($pk,$id);
			$this->db->join('admin_users',"id=user_id");
			$query = $this->db->get($table);

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->result();

		}
		else{
			return false;
		}
	}
	
	function getrejectList($id){
		$this->db->select('loan_id');
		$this->db->where('applicant_id',$id);
		$query = $this->db->get('bank_response');
		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->row();

		}
		else{
			return false;
		}
	}
	function getdataBypkOrder($table,$pk,$id,$date){
			
		$sql = "select *,".$table.". created as visit from ".$table." where applicant_id =".$id." and Date(created) ='".$date."' limit 1  ";
		$qx = $this->db->query($sql);
			//$qx->row_array();	
		
		// Check if Result is Greater Than Zero

		if($qx->num_rows() > 0){
			return $qx->result();
		}
		else{
			return false;
		}
	}
	function getdataBypkTypeOrder($table,$pk,$id,$typekey,$typeid,$date){
			
		 $sql = "select *,".$table.". created as visit from ".$table." where applicant_id =".$id." and Date(created) ='".$date."' and ".$typekey." = '".$typeid."' limit 1  ";
		$qx = $this->db->query($sql);
			//$qx->row_array();	
		
		// Check if Result is Greater Than Zero

		if($qx->num_rows() > 0){
			return $qx->result();
		}
		else{
			return false;
		}
	}
	function getdataByType($table,$type_name,$type,$pk,$id){
			$this->db->select('*,'.$table.'.created as visit');
			$this->db->where($pk,$id);
			$this->db->where($type_name,$type);
			$this->db->join('admin_users',"id=user_id");
			$query = $this->db->get($table);
		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->result();

		}
		else{
			return false;
		}
	}
	
	function getdataBytable2($table,$id,$type_column,$type){
		
				$this->db->select('*,'.$table.'.created as visit');
			$this->db->where('applicant_id',$id);
			$this->db->where($type_column,$type);
			$this->db->join('admin_users',"id=user_id");
		$query = $this->db->get($table);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->result();

		}
		else{
			return false;
		}
	}
	
	function getdataByTypeTable($table,$id,$type){
		$this->db->where('applicant_id',$id);
		$this->db->where('anoted_type',$type);
		$query = $this->db->get($table);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0){
			return $query->result();

		}
		else{
			return false;
		}
	}
	function delete_recordById($table,$id)
	{
		$this->db->where("applicant_id",$id);
		$this->db->delete($table);
		return true; 
	}

	function get_single_branche($branch_id)

	{

		$this->db->where('branch_id',$branch_id);



		$query = $this->db->get($this->_table_branches);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0)

		{

			return $query->row();

		}

	}

//----------------------------------------------------------------------

	/*

	* Get Data for Listing for Store

	*/

	function get_all_branches()

	{

		$query = $this->db->get($this->_table_branches);

		

		// Check if Result is Greater Than Zero

		if($query->num_rows() > 0)

		{

			return $query->result();

		}

	}
	
	

	

//----------------------------------------------------------------------



	/*

	* Delete

	*/

	function delete($branch_id)

	{

		$this->db->where("branch_id",$branch_id);

		$this->db->delete($this->_table_branches);

		

		return true; 

	}

//------------------------------------------------------------------------



    /**

     * 

     * Insert User Data for Registration

     * @param array $data

     * return integer

     */

	function update_branch($branch_id,$data)

	{



		$this->db->where('branch_id', $branch_id);

		$this->db->update($this->_table_branches, $data);

		

		//print_r($this->db->last_query());

		

		return TRUE;

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
	
	function get_bank_data(){
				
				
				//$this->another->select('somecol');
			//	$q = $this->another->get('sometable');
				
				$sql = "SELECT GROUP_CONCAT(bll.`CIVIL_ID`) AS civilno,GROUP_CONCAT(bll.`COMM_REG_NO`) AS regno FROM `bank_loan_list` AS bll   
WHERE bll.`REMAIN_DISB` = '0'";
				$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					return $result = $q->row();
					//echo "<pre>";
				  //print_r($result);
				}
				else
				{
				  return FALSE;
				}
				
				
				
	
	}
	function check_record($table,$where){
		/*pd.`ILOM_SEQUENCE` = '31469' 
  AND pd.`DISB_DATE` = '12-16-14' 
  AND pd.`DISB_AMT` = '4800.000' 
  AND pd.DISB_DATE = '12-16-14' */
		$sql = "SELECT * FROM ".$table." Where ".$where."";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					return $row = $q->row();
					//return $row->list_id;
			}
			else{
				  return FALSE;
			}
	}
	
	function check_data($lm,$reg){
		  $sql = "SELECT * FROM `bank_loan_list` AS bl WHERE bl.`ILOM_SEQUENCE` = '".$lm."'";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					$row = $q->row();
					return $row->list_id;
			}
				else
				{
				  return FALSE;
				}

	}
	
	function check_sequance($lm,$table){
		  $sql = "SELECT * FROM ".$table."  AS bq WHERE bq.`ILOM_SEQUENCE` = '".$lm."' ";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					$row = $q->row();
					return $row->id;
			}
				else
				{
				  return FALSE;
				}

	}
	
	function payment_schduale(){
		
	}
	
	
	function updateRecord($data,$table,$key,$record_id){			
		$this->bank->where($key, $record_id);
		return $this->bank->update($table, $data);
	}
	
	function updateRecordDb($data,$table,$key,$record_id){			
		$this->db->where($key, $record_id);
		return $this->db->update($table, $data);
	}
	
	function insertRecord($data,$table){			
		$this->bank->insert($table,$data);
	}
	
	function getLoanIdNumber($val,$column){
		  $sql = "SELECT * FROM bank_loan_list  AS bq WHERE ".$column." = '".$val."' ";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					return $row = $q->row();
					//return $row->ILOM_SEQUENCE;
			}
				else
				{
				  return FALSE;
				}
	}
	function getBankDataByLoanId($table,$id){
		$sql = "SELECT * FROM ".$table."  AS bq WHERE bq.`ILOM_SEQUENCE` = '".$id."' ";
		$q = $this->bank->query($sql);
				if($q->num_rows()>0){
					return $row = $q->result();
					//return $row->ILOM_SEQUENCE;
			}
				else
				{
				  return FALSE;
				}
		
	}
	
	function getCompleteFollowData($reg,$civil){
		// $sql = "SELECT * FROM `applicants` AS a WHERE  a.`appliant_id_number` IN (".$ids.")";
		  $sql = "SELECT 
				  a.*,
				  COUNT(ep.`applicant_id`) AS total 
				FROM
				  `applicants` AS a 
				  LEFT JOIN `evaluate_project` AS ep 
					ON ep.`applicant_id` = a.`applicant_id` 
				WHERE a.`applicant_cr_number` IN (".$reg.") || a.appliant_id_number IN('".$civil."')  
				GROUP BY a.`applicant_id` ";
		$q = $this->db->query($sql);
				if($q->num_rows()>0){
					return $result = $q->result();
					//echo "<pre>";
				  //print_r($result);
				}
				else
				{
				  return FALSE;
				}
	}

//----------------------------------------------------------------------

}



?>