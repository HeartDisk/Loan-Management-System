<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{
//-------------------------------------------------------------------------------

	/*
	* Costructor
	*/
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
//-------------------------------------------------------------------------------

	/*
	*
	* Main Page
	*/
	public function index()
	{
		if(empty($this->session->userdata('userid')))
		{
			$this->load->view('admin');
		}
		else
		{
			redirect(base_url().'dashboard/dashboard');
			exit();
		}
	}
	

//-------------------------------------------------------------------------------

	/*
	*
	* Check User Exist OR Not
	*/
	function login()
	{
		$username = $_POST['username'];
		$userpassword = $_POST['userpassword'];
		
		if(isset($username) && $username !="" && isset($username) && $userpassword !="")
		{
				$userData = $this->admin_model->login_user($username,$userpassword);
				if(!empty($userData))
				{
					 $this->session->set_userdata('userid', $userData->id);
                     $this->session->set_userdata('userinfo', $userData);
					 $this->admin_model->update_login_data($userData->id);
					 redirect(base_url().'dashboard');
                     exit;	
				}
				else
				{
					$this->session->set_flashdata('msg', 'قمت بإدخال اسم المستخدم كلمة المرور خاطئة');
					redirect(base_url());
                    exit();
				}
		}
		else
		{
			$this->session->set_flashdata('msg', 'من فضلك ادخل اسم المستخدم كلمة المرور');
			redirect(base_url());
            exit;
		}

	}
//-------------------------------------------------------------------------------	
	function checkLogin()
	{

        if (!is_numeric($this->session->userdata('userid')) or $this->session->userdata('userid') == '' ) 
		{
            redirect(site_url('admin'));
            exit;
		} 
		else 
		{
           redirect(site_url('dashboard'));
           exit;
        }
	}
	
	
	function support(){
		$this->load->view('support');	
	}
//-------------------------------------------------------------------------------	
	protected function _CheckForLogin() 
	{
		echo  $this->session->userdata('userid');
		exit;
        if (!isset($this->userId) or !is_numeric($this->userId) or $this->userId == '' or $this->userId == 0) {
            if ($redirect) {
                redirect(($url == '') ? site_url('admin/') : $url);
                exit;
            } else {
                redirect(site_url('dashboard'));
            	exit;
			}
        }
        return TRUE;
    }
	
//-------------------------------------------------------------------------------
}


?>