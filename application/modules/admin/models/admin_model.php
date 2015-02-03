<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	

	/*

	* Properties

	*/

	private $_table_users;	

	private $_table_donate;	

	private $_table_applied_donation;

//----------------------------------------------------------------------

    

	/*

	* Constructor

	*/

	

	function __construct()

    {

        parent::__construct();

		

		//Load Table Names from Config

		$this->_table_users 			=  $this->config->item('table_users');

		$this->_table_donate 			=  $this->config->item('table_donate');

        $this->_table_user_profile 			=  $this->config->item('table_user_profile');

		$this->_table_applied_donation 	=  $this->config->item('table_applied_donation');

    }

	

//----------------------------------------------------------------------

	/*

	* Insert User Record

	* @param array $data

	* return True

	*/

	function insert_user_detail($data)

	{

		$this->db->insert($this->_table_users,$data);

		

		return TRUE;

	}



//----------------------------------------------------------------------

	/*

	* Insert User Record

	* @param array $data

	* return True

	*/

	function insert_donation_product($data)

	{

		$this->db->insert($this->_table_donate,$data);

		

		return TRUE;

	}

//----------------------------------------------------------------------

    /*

    * insert user_profile method

    */

    function insert_user_profile($data)

    {

        $this->db->insert($this->_table_user_profile,$data);



        return TRUE;

    }

//----------------------------------------------------------------------

	/*

	* User login

	* @param string $user_email

	* @param string $password

	* return Login User Data

	*/

	function login_user($username,$password)

	{

		//Login Query

		$this->db->where('user_name',$username);

		$this->db->where('password',md5($password));

		$query = $this->db->get('admin_users');

		

		//Check if Result is Greater Than Zero

		

		if($query->num_rows() > 0)

		{

			$this->session->set_userdata('id',$query->row()->user_id);

			return $query->row();

		}

	}
	
	
	function getBankApplicants($ids){
		  $sql = "SELECT * FROM `applicants` AS a
INNER JOIN `applicant_project` AS ap ON ap.`applicant_id` = a.`applicant_id`
WHERE ap.`walaya` IN('".$ids."')";
			$q = $this->db->query($sql);
				if($q->num_rows()>0){
					 return $result = $q->result();
				}
				else{
					return false;
				}

	}
	
	function getBankAdmin($id){
		 $sql = "SELECT au.`bank_branch_id` FROM `admin_users` AS au WHERE au.`id` = '".$id."'";
		$q = $this->db->query($sql);
				if($q->num_rows()>0){
					 $result = $q->row();
					return  $bId = $result->bank_branch_id;
						//echo "<pre>";
				  //print_r($result);
				}
				else
				{
				  return FALSE;
				}
	}
	function getWilayas($bId){
		 $sql = "SELECT GROUP_CONCAT(wilaya_id) AS wilaya FROM `bank_branches_wilaya` AS bbw WHERE  bbw.`branch_id` = '".$bId."'";	 	
		$q = $this->db->query($sql);
				if($q->num_rows()>0){
				return 	 $result = $q->row();
				}
				else{
					return false;
				}
		
	}
	function login_bank($username,$password)

	{

		//Login Query
/*
		$this->db->where('user_name',$username);

		$this->db->where('password',md5($password));

		$query = $this->db->get('admin_users');

		*/
		
		$sql = "SELECT  *  FROM `admin_users` au WHERE au.`user_name` = '".$username."' AND au.`password` =  '".md5($password)."' AND au.bank_branch_id !='' ";
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

		//Check if Result is Greater Than Zero

		

		if($query->num_rows() > 0)

		{

			$this->session->set_userdata('id',$query->row()->user_id);

			return $query->row();

		}

	}



//----------------------------------------------------------------------

	/*

	* Get Data for Listing for Store

	*/

	function get_data_for_store($limit,$start){

		//Login Query

		$this->db->where('permission','1');

		$this->db->limit($limit,$start);	

		$query = $this->db->get($this->_table_donate);

		

		//Check if Result is Greater Than Zero

		if($query->num_rows() > 0)

		{

			return $query->result();

		}

	}



//----------------------------------------------------------------------

	/*

	* Get All Records From Giving Table

	*/

	public function get_rows($table_name)

	{

		$count_all = $this->db->get($table_name);

		if($count_all->num_rows() > 0)

		{

			return $count_all->num_rows();

		}

	}

//----------------------------------------------------------------------

	/*

	* Insert Applied Product Record into Database

	* Return True 

	*/

	public function applied_donation($data)

	{

		$this->db->insert($this->_table_applied_donation,$data);

		return TRUE;

	}

	

	

	public function update_login_data($id)

	{

		$this->db->query("UPDATE `admin_users` SET `last_login`='".date('Y-m-d h:i:s')."' WHERE `id`='".$id."'");

	}





//----------------------------------------------------------------------

	/*

	* Get Applied Product Record into Database

	* Return True 

	*/

	public function get_applied_detail($user_id,$donate_id)

	{

		$this->db->where('user_id',$user_id);

		$this->db->where('donation_id',$donate_id);



		$query = $this->db->get($this->_table_applied_donation);

		

		if ($query->num_rows() > 0)

		{

			return $query->row()->donation_id;

		}

	}

//----------------------------------------------------------------------

	/*

	* Search Applied Products if 

	* Return True 

	*/

	public function donation_id_exists()

	{

		$this->db->where('user_id',$this->session->userdata('user_id'));

		$this->db->select('donation_id');

		$query = $this->db->get($this->_table_applied_donation);

		

		if ($query->num_rows() > 0)

		{

			return $query->result();

		}

	}

	

}



?>