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
			
		$sesion= $this->session->userdata('userid');
		if(!($sesion))

		{

			$this->load->view('admin');

		}

		else

		{


			redirect(base_url().'inquiries/newinquery');

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
						
					ini_set('session.gc_maxlifetime', 7200);
 
					
					 redirect(base_url().'inquiries/newinquery');

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

	function company_logout(){

			$this->session->sess_destroy();

		$this->session->unset_userdata('userid');

		$this->session->unset_userdata('userinfo');

		redirect(base_url('admin/login_company'));

		exit();

	}
	
	function showFile(){
		$this->load->view('inquiries/files.php');
	}
	function doUpload(){	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//for security reason, we force to remove all uploaded file
			@unlink($_FILES['fileToUpload']);		
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
}
	

	function bank_logout(){

			$this->session->sess_destroy();

		$this->session->unset_userdata('userid');

		$this->session->unset_userdata('userinfo');

		redirect(base_url('admin/login_bank'));

		exit();

	}

	function search(){

		$this->load->view('inquiries/newcompany');

	}

	function search_bank(){
		$id = $this->session->userdata('userid');	
		 $bankid = $this->admin_model->getBankAdmin($id);
		$bank_data = $this->admin_model->getWilayas($bankid);
			
		$wilaya = $bank_data->wilaya;
		
		$this->_data['all_applicatns']	= $this->admin_model->getBankApplicants($wilaya);
		$this->load->view('inquiries/bank_applicants',$this->_data);

	}

	

	function login_company(){

		

		$this->load->view('admin_company_login');

	}

	function login_bank(){

		

		$this->load->view('admin_bank_login');

	}

	

	function login_bank_attempt()

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

					 redirect(base_url().'admin/search_bank');

                     //exit;	

				}

				else

				{

					$this->session->set_flashdata('msg', 'قمت بإدخال اسم المستخدم كلمة المرور خاطئة');

					redirect(base_url('admin/login_bank'));

                    exit();

				}

		}

		else

		{

			$this->session->set_flashdata('msg', 'من فضلك ادخل اسم المستخدم كلمة المرور');

			redirect(base_url('admin/login_bank'));

            exit;

		}



	}

	function login_company_attempt()

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

					 redirect(base_url().'admin/search');

                     //exit;	

				}

				else

				{

					$this->session->set_flashdata('msg', 'قمت بإدخال اسم المستخدم كلمة المرور خاطئة');

					redirect(base_url('admin/login_company'));

                    exit();

				}

		}

		else

		{

			$this->session->set_flashdata('msg', 'من فضلك ادخل اسم المستخدم كلمة المرور');

			redirect(base_url('admin/login_company'));

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

		//$this->load->view('support');	

	}

	

	function submitData(){

			echo "<pre>";

			print_r($_POST);

			

			exit;

			send_email($recipient, $subject = 'Test email', $message = 'Hello World');

			

			$msg = "<br>".$_POST['name']."الإسم بالكامل";

			$msg .= "<br>".$_POST['email']."البريد الإلكتروني";

			$msg .= "<br>".$_POST['title']."عنوان الرسالة";

			$msg .= "<br>".$_POST['messsage']."الرسالة";

			send_sms_message($msg,'93338241');

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

                redirect(site_url('inquiries/newinquery'));

            	exit;

			}

        }

        return TRUE;

    }

	

//-------------------------------------------------------------------------------

}





?>