<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branches_model extends CI_Model {
	
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
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
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
//----------------------------------------------------------------------
}

?>