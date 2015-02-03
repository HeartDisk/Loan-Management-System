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
			$this->db->where('applicant_id',$id);

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
				
				$sql = "SELECT GROUP_CONCAT(b.`user_id_number`) AS  uids  FROM `bank_loan_list` AS b";
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
	
	function getCompleteFollowData($ids){
		 $sql = "SELECT * FROM `applicants` AS a WHERE  a.`appliant_id_number` IN (".$ids.")";
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