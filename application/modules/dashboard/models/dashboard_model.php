<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	

	/*

	* Properties

	*/

	private $_table_users;	

//----------------------------------------------------------------------

    

	/*

	* Constructor

	*/

	

	function __construct()

    {

        parent::__construct();

		

		//Load Table Names from Config

		$this->_table_users 			=  $this->config->item('table_users');



    }

//----------------------------------------------------------------------

	/*

	* Get all Admin users

	* return Object

	*/

	function get_all_admin_users(){

	

		$query = $this->db->get('admin_users');

		

		//Check if Result is Greater Than Zero

		if($query->num_rows() > 0)

		{

			return $query->num_rows();

		}

		else

		{

			return '0';

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
//----------------------------------------------------------------------
	/*
	* count of all applicants
	*/

	public function jamee_ul_maamlaat()
	{
		return $this->db->count_all_results('applicants');
	}
//----------------------------------------------------------------------
	/*
	*
	*/

public function mamlaat_types_count_and_sum()
{
	$q = $this->db->query('SELECT a.loan_category_name,
	COUNT(c.`applicant_id`) AS lcount,
	SUM(c.`loan_amount`) AS lamount
	FROM loan_category AS a
	JOIN loan_calculate AS b ON a.`loan_category_id`=b.`loan_category_id`
	JOIN applicant_loans AS c ON b.`loan_category_id`=c.`loan_limit`
	GROUP BY a.`loan_category_id`');
	
	return $q->result_array();

}
//----------------------------------------------------------------------
	/*
	*
	*/

	public function day_month_year()
	{
		$date = date('Y-m-d');
		$qx = $this->db->query("SELECT 
		(SELECT COUNT(applicant_id) FROM applicants WHERE DAY(`applicant_regitered_date`)=DAY('".$date."')) AS count_day,
		(SELECT COUNT(applicant_id) FROM applicants WHERE MONTH(`applicant_regitered_date`)=MONTH('".$date."')) AS count_month,
		(SELECT COUNT(applicant_id) FROM applicants WHERE YEAR(`applicant_regitered_date`)=YEAR('".$date."')) AS count_year 
		FROM applicants LIMIT 0,1;");
		return $qx->row();	

	}
//----------------------------------------------------------------------
	/*
	*
	*/

	public function mamlaat_gair()
	{
		$this->db->select('applicants.*');
		$this->db->from('applicants');
		$this->db->join('zyarat_awalia AS snd',"snd.applicant_id=applicants.applicant_id");
		$this->db->where('snd.is_complete','1');


		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
	}
//----------------------------------------------------------------------
	/*
	*
	*/

	public function qarar_ul_janna()
	{
		$qx = $this->db->query("SELECT comitte_id FROM comitte_decision WHERE commitee_decision_type='approved';");
		return $qx->num_rows();
	}
	
	public function zayarat_awaliya1()
	{
		$qp = $this->db->query("SELECT 
		 COUNT(a.zyarat_id) AS ck,
		 SUM(b.loan_amount) AS lamo
		FROM
		 zyarat_awalia AS a,
		 applicant_loans AS b 
		WHERE a.`applicant_id`=b.`applicant_id` AND a.is_complete = '1';");
		
		return $qp->row(); 
	}
	
	public function zayarat()
	{
		$qp = $this->db->query("SELECT COUNT(a.comitte_id) AS ck, SUM(b.loan_amount) AS lamo 
		FROM comitte_decision AS a, applicant_loans AS b 
		WHERE a.`applicant_id`=b.`applicant_id` AND a.committee_decision_is_aproved = 'queries';");
		
		return $qp->row(); 
	}
	
	public function ziker()
	{
		$query = $this->db->query("SELECT COUNT(a.zyarat_id) AS ck FROM zyarat_awalia AS a, applicants AS b WHERE a.`applicant_id`=b.`applicant_id` AND a.is_complete = '1' AND b.`applicant_gender` = 'ذكر';");
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return '0';
		}
	}
	public function unsaa()
	{
		$query = $this->db->query("SELECT COUNT(a.zyarat_id) AS ck FROM zyarat_awalia AS a, applicants AS b WHERE a.`applicant_id`=b.`applicant_id` AND a.is_complete = '1' AND b.`applicant_gender` = 'أنثى';");
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return '0';
		}
	}
	public function mushtarik()
	{
		$query = $this->db->query("SELECT COUNT(a.zyarat_id) AS ck FROM zyarat_awalia AS a, applicants AS b WHERE a.`applicant_id`=b.`applicant_id` AND a.is_complete = '1' AND b.`applicant_type` = 'مشترك';");
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return '0';
		}
	}
	
	public function marajeen_male_femail_count()
	{
		$query = $this->db->query("SELECT (SELECT COUNT(`applicantid`) FROM main_applicant WHERE `applicanttype`='ذكر') AS zakar, (SELECT COUNT(applicantid) FROM main_applicant WHERE `applicanttype`='أنثى') AS unsa FROM applicants LIMIT 0,1;");
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return '0';
		}
	}
	public function marajeen_ferd_mushtariq_count()
	{
		$query = $this->db->query("SELECT (SELECT COUNT(`tempid`) FROM main WHERE `user_type`='فردي') AS ferd, (SELECT COUNT(`tempid`) FROM main WHERE `user_type`='مشترك') AS mushtariq FROM main LIMIT 0,1;");
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return '0';
		}
	}
	
	public function al_mubaligh()
	{
		$qp = $this->db->query("SELECT SUM(b.loan_amount) AS lamo 
		FROM comitte_decision AS a, applicant_loans AS b 
		WHERE a.`applicant_id`=b.`applicant_id` AND a.commitee_decision_type = '';");
		
		return $qp->row(); 
	}
	public function al_muafqaat()
	{
		$qp = $this->db->query("SELECT SUM(b.loan_amount) AS lamo 
		FROM comitte_decision AS a, applicant_loans AS b 
		WHERE a.`applicant_id`=b.`applicant_id`;");
		
		return $qp->row(); 
	}
	
//------------------------------------------------------

	/*
	*
	* Get count of mamlaat created by admin users
	*/
	public function al_muzafeen_count()
	{
		$query = $this->db->query("
		SELECT
		`admin_users`.`firstname`
		, `admin_users`.`lastname`
		, COUNT(`applicants`.`applicant_id`) AS total
		FROM
		`2015raffd`.`admin_users`
		INNER JOIN `2015raffd`.`applicant_process_log` 
			ON (`admin_users`.`id` = `applicant_process_log`.`userid`)
		INNER JOIN `2015raffd`.`applicants` 
			ON (`applicant_process_log`.`applicantid` = `applicants`.`applicant_id`)
			WHERE applicant_process_log.stepsid = '1' GROUP BY `admin_users`.`id` ORDER BY total DESC;");
		
		return $query->result();
	}
}

?>