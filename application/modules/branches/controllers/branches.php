<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branches extends CI_Controller 
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
		
		// Load Models
		$this->load->model('branches_model', 'branches');
		
		$this->_data['module'] = get_module();

		$this->_data['user_info']	=	userinfo();
		
		
	}
	
//-------------------------------------------------------------------------------

	/*
	*
	* Main Page
	*/
	public function index()
	{
		//$this->_data['user_info']	=	userinfo();
		
		//$this->load->view('home', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Add List Detail
	*/
	public function add($branchid	= NULL)
	{
		if($branchid)
		{
			$this->_data['single_branche']	=	$this->branches->get_single_branche($branchid);	

		}
		if($this->input->post())
		{
			
			$data		=	$this->input->post();

			// UNSET ARRAY key
			unset($data['save_data_form']);
			
			if($this->input->post('branch_id'))
			{

				$this->branches->update_branch($this->input->post('branch_id'),$data);
				
				$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				redirect(base_url()."branches/listing");
				exit();
				
			}
			else
			{

				$this->branches->add_branche($data);
				
				$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				redirect(base_url()."branches/listing");
				exit();
			}
		}
		else
		{
			if($branchid)
			{
				$this->_data['branch_id']	=	$branchid;
			}
			else
			{
				$this->_data['branch_id']	=	'';
			}
			
			$this->load->view('add', $this->_data);
		}
		
	}	
//-------------------------------------------------------------------------------

	/*
	*
	* Listing Page
	*/
	public function listing()
	{
		$this->_data['all_branches']	=	$this->branches->get_all_branches();

		$this->load->view('branches-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete($branch_id)
	{
		$this->branches->delete($branch_id);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'branches/listing');
		exit();

	}
//-------------------------------------------------------------------------------

	/*
	* Logout
	* Destroy All Sessions
	*/
	
	public function logout()
	{
		// Destroy all sessions
		$this->session->sess_destroy();
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('userinfo');
		redirect(base_url());
		exit();

	}
//-------------------------------------------------------------------------------
}


?>