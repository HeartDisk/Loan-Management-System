<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing_managment_model extends CI_Model {
	
	/*
	* Properties
	*/
	private $_table_list_management;
//----------------------------------------------------------------------
    
	/*
	* Constructor
	*/
	
	function __construct()
    {
        parent::__construct();
		
		//Load Table Names from Config
		$this->_table_list_management 			=  $this->config->item('table_list_management');
    }
	
//----------------------------------------------------------------------
	/*
	* Insert User Record
	* @param array $data
	* return True
	*/
	function add_list($data)
	{
		$this->db->insert($this->_table_list_management,$data);
		
		return TRUE;
	}
//----------------------------------------------------------------------
	/*
	* Insert  Record
	* @param array $data
	* return True
	*/
	function add_list_child($data)
	{
		$this->db->insert('list_managment_child',$data);
		
		return TRUE;
	}
//----------------------------------------------------------------------
	/*
	* Insert  Record
	* @param array $data
	* return True
	*/
	function get_list_child_count($listid)
	{
		$this->db->where('list_parent_id',$listid);
		$query = $this->db->get('list_managment_child');
		
		return $query->num_rows();
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_child_listing($listid)
	{	
		$this->db->where('list_parent_id',$listid);
		$query = $this->db->get('list_managment_child');
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function by_type($type)
	{
		if($type	==	'marital')
		{
			$this->db->where('list_type','maritalstatus');
		}
		else if($type	==	'situation')
		{
			$this->db->where('list_type','current_situation');
		}
		else
		{
			$this->db->where('list_type','inquiry_type');
		}
		
		
		$query = $this->db->get($this->_table_list_management);
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function inquire_by_type($type)
	{

		$this->db->where('list_type',$type);
		
		$query = $this->db->get($this->_table_list_management);
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
//----------------------------------------------------------------------
	/*
	* Get Data for Listing for Store
	*/
	function get_single_record($listid)
	{
		$this->db->where('list_id',$listid);

		$query = $this->db->get($this->_table_list_management);
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
	public function total_count($type)
	{
		$this->db->where('list_type',$type);
		$query = $this->db->get($this->_table_list_management);
		
		return $query->num_rows();
	}
//----------------------------------------------------------------------

	/*
	* Delete
	*/
	function delete($listid)
	{
		$this->db->where("list_id",$listid);
		$this->db->delete($this->_table_list_management);
		
		return true; 
	}
//----------------------------------------------------------------------

	/*
	* Delete
	*/
	function delete_child($childlistid)
	{
		$this->db->where("list_child_id",$childlistid);
		$this->db->delete('list_managment_child');
		
		return true; 
	}

//------------------------------------------------------------------------

    /**
     * 
     * Insert User Data for Registration
     * @param array $data
     * return integer
     */
	function update_list($list_id,$data)
	{
		$this->db->where('list_id', $list_id);
		$this->db->update($this->_table_list_management, $data);
		
		return TRUE;
	}
	
	function update_record($list_id, $data)
	{
		$this->db->where('list_id', $list_id);
		$this->db->update($this->_table_list_management, $data);
		
		return TRUE;
	}
//----------------------------------------------------------------------
	function get_list_type()
	{
		$this->db->select("list_type"); 
		$this->db->group_by("list_type"); 

		$query = $this->db->get($this->_table_list_management);
		
		// Check if Result is Greater Than Zero
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
//----------------------------------------------------------------------
}

?>