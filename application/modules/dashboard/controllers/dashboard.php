<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends CI_Controller 

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

		$this->load->model('dashboard_model', 'dashboard');

		

		

	}

	

	

	

//-------------------------------------------------------------------------------



	/*

	*

	* Main Page

	*/

	public function index()

	{

		$this->_data['user_info']	=	userinfo();

		

		$this->_data['total']	=	$this->dashboard->get_all_admin_users();
		
		$this->_data['jamee_ul_mamlaat']	=	$this->dashboard->jamee_ul_maamlaat();
		$this->_data['count_sum']			=	$this->dashboard->mamlaat_types_count_and_sum();
		
		//echo '<pre>'; print_r($this->_data['count_sum']);
		$this->_data['day_month_year']		=	$this->dashboard->day_month_year();
		$this->_data['mamlaat_gair']		=	$this->dashboard->mamlaat_gair();
		$this->_data['qarar_ul_lajjana']	=	$this->dashboard->qarar_ul_janna();
		$this->_data['zayarat_awaliya']		=	$this->dashboard->zayarat_awaliya1();
		$this->_data['zayarat']				=	$this->dashboard->zayarat();
		
		
		$this->_data['ziker']		=	$this->dashboard->ziker();
		$this->_data['unsaa']		=	$this->dashboard->unsaa();
		$this->_data['mushtarik']	=	$this->dashboard->mushtarik();
		
		$this->_data['m_f_count']		=	$this->dashboard->marajeen_male_femail_count();
		$this->_data['ferd_mushtariq']	=	$this->dashboard->marajeen_ferd_mushtariq_count();
		$this->_data['al_mubaligh']		=	$this->dashboard->al_mubaligh();
		$this->_data['al_muafqaat']		=	$this->dashboard->al_muafqaat();
		
		// get count of mamlaat created by admin users
		$this->_data['al_muzafeen']		=	$this->dashboard->al_muzafeen_count();

		$this->load->view('home', $this->_data);

		



	}

	function support(){

			$this->load->view('support_view');	

	}

	function login(){

		echo "<pre>";

		print_r($_POST);

		$_POST[''];

		$_POST[''];

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

		redirect(base_url('admin/login_bank'));

		exit();



	}

}





?>