<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listing_managment extends CI_Controller 
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
		$this->_data['module'] = get_module();
		
		$this->load->model('listing_managment_model', 'listing');
		
		
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
	public function add($listid	= NULL)
	{
		if($listid)
		{
			$this->_data['single_list']	=	$this->listing->get_single_record($listid);	
		}
		if($this->input->post())
		{
			
			$data		=	$this->input->post();
			
			// UNSET ARRAY key
			unset($data['submit']);
			
			if($this->input->post('list_id'))
			{
				$this->listing->update_list($this->input->post('list_id'),$data);
				
				$this->session->set_flashdata('success', 'تم تحديث تسجيلك بنجاح');
				redirect(base_url()."listing_managment/listing");
				exit();
				
			}
			else
			{
				$this->listing->add_list($data);
				
				$this->session->set_flashdata('success', 'تم إضافة تسجيلك بنجاح');
				redirect(base_url()."listing_managment/listing");
				exit();
			}
		}
		else
		{
			if($listid)
			{
				$this->_data['list_id']	=	$listid;
			}
			else
			{
				$this->_data['list_id']	=	'';
			}
			
			$this->load->view('add', $this->_data);
		}
		
	}	
//-------------------------------------------------------------------------------

	/*
	*
	* Listing Page
	*/
	public function listing($type	=	NULL)
	{
		if($type)
		{
			if($type	==	'marital')
			{
				$this->_data['type_name']	=	'الحالة الزوجية';
			}
			else if($type	==	'situation')
			{
				$this->_data['type_name']	=	'الوضع الحالي';
			}
			else
			{
				$this->_data['type_name']	=	'الاستفسار عن قرض';
			}
			
			// Get List Name By Type
			$this->_data['listing']	=	$this->listing->by_type($type);
			
			$this->load->view('type-listing', $this->_data);
		}
		else
		{ 
			$this->_data['marital_count']	=	$this->listing->total_count('maritalstatus');
			$this->_data['situation_count']	=	$this->listing->total_count('current_situation');
			$this->_data['inquiry_type']	=	$this->listing->total_count('inquiry_type');
			
			$this->load->view('listing', $this->_data);
		}
		
		
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Child Listing
	*/
	public function child_listing($listid	=	NULL)
	{
		$this->_data['parent_id']	=	$listid;
		$this->_data['listing']	=	$this->listing->get_child_listing($listid);

		
		$this->load->view('child-type-listing', $this->_data);
	}
//-------------------------------------------------------------------------------

	/*
	*
	* Subchild Listing Page
	*/
	public function sub_child_listing($listid	=	NULL)
	{
		$this->_data['listing']	=	$this->listing->get_child_listing($listid);

		
		$this->load->view('subchilds-type-listing', $this->_data);
	}	
	
//-------------------------------------------------------------------------------	
	function add_new()
	{
		$parent_id	=	$this->input->post("parent_id");
		$add_sub	=	$this->input->post("add_sub");
		
		$data	=	array("list_parent_id"=>$parent_id,"list_child_name"=>$add_sub);
		
		$this->listing->add_list_child($data);	
	}
	
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete($listid,$type)
	{
		$this->listing->delete($listid);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'listing_managment/listing/'.$type);
		exit();

	}
//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function delete_child($childlistid)
	{
		$this->listing->delete_child($childlistid);
		
		$this->session->set_flashdata('success', 'لقد تم حذف السجلات');
		redirect(base_url().'listing_managment/listing/');
		exit();

	}

//-------------------------------------------------------------------------------

	/*
	* Delete List
	*
	*/
	
	public function other()
	{
		$list_id	=	$this->input->post("id");
		$entry		=	$this->input->post("entry");
		
		$data		=	array('other' => $entry);

		$this->listing->update_record($list_id, $data);
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