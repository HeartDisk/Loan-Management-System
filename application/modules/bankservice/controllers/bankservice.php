<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Bankservice extends CI_Controller 

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

		$this->load->model('bankservice_model', 'service');

		

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
	
	}
	
	function addUserdata($data){
	
		$decrypted_data = $this->decrypt($data, "PASSWORD");
		echo $obj = json_decode($decrypted_data, true);
 	}
	
	function postData(){
		// A very simple PHP example that sends a HTTP POST to a remote site
		//

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"http://www.mysite.com/tester.phtml");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					"postvar1=value1&postvar2=value2&postvar3=value3");

		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS, 
		//          http_build_query(array('postvar1' => 'value1')));

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		// further processing ....
		if ($server_output == "OK") { ... } else { ... }
	}
	
	function addUserdata($data){
	
		$decrypted_data = $this->decrypt($data, "PASSWORD");
		echo $obj = json_decode($decrypted_data, true);
 	}
	
	function addencryptData($params){
	
			$additionPartJson = json_encode($params);
		echo  $this->encrypt($additionPartJson, "PASSWORD");
						
	}

//-------------------------------------------------------------------------------



	/*

	*

	* Add List Detail

	*/

	function encrypt($string,$key){
    $returnString = "";
    $charsArray = str_split("e7NjchMCEGgTpsx3mKXbVPiAqn8DLzWo_6.tvwJQ-R0OUrSak954fd2FYyuH~1lIBZ");
    $charsLength = count($charsArray);
	$stringArray = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
    $keyArray = str_split(hash('sha256',$key));
    $randomKeyArray = array();
	$stringAsNumeric = '';
    while(count($randomKeyArray) < $charsLength){
        $randomKeyArray[] = $charsArray[rand(0, $charsLength-1)];
    }
    for ($a = 0; $a < count($stringArray); $a++){
		$stringCharValue = $this->utf8Ord($stringArray[$a]);
		$stringAsNumeric .= $stringCharValue;
        $numeric = $stringCharValue + $this->utf8Ord($randomKeyArray[$a%$charsLength]);
        $returnString .= $charsArray[floor($numeric/$charsLength)];
        $returnString .= $charsArray[$numeric%$charsLength];
    }
    $randomKeyEnc = '';
    for ($a = 0; $a < $charsLength; $a++){
        $numeric = $this->utf8Ord($randomKeyArray[$a]) + $this->utf8Ord($keyArray[$a%count($keyArray)]);
        $randomKeyEnc .= $charsArray[floor($numeric/$charsLength)];
        $randomKeyEnc .= $charsArray[$numeric%$charsLength];
    }
    return $randomKeyEnc.hash('sha256',$stringAsNumeric).$returnString;
	}


	function decrypt($string,$key){
$returnString = "";
$charsArray = str_split("e7NjchMCEGgTpsx3mKXbVPiAqn8DLzWo_6.tvwJQ-R0OUrSak954fd2FYyuH~1lIBZ");
$charsLength = count($charsArray);
$keyArray = str_split(hash('sha256',$key));
$stringArray = str_split(substr($string,($charsLength*2)+64));
$sha256 = substr($string,($charsLength*2),64);
$randomKeyArray = str_split(substr($string,0,$charsLength*2));
$randomKeyDec = array();
$stringAsNumeric = '';
if(count($randomKeyArray) < $charsLength*2) return false;
for ($a = 0; $a < $charsLength*2; $a+=2){
	$numeric = array_search($randomKeyArray[$a],$charsArray) * $charsLength;
	$numeric += array_search($randomKeyArray[$a+1],$charsArray);
	$numeric -= $this->utf8Ord($keyArray[floor($a/2)%count($keyArray)]);
	$randomKeyDec[] = chr($numeric);
}
for ($a = 0; $a < count($stringArray); $a+=2){
	$numeric = array_search($stringArray[$a],$charsArray) * $charsLength;
	$numeric += array_search($stringArray[$a+1],$charsArray);
	$numeric -= $this->utf8Ord($randomKeyDec[floor($a/2)%$charsLength]);
	$stringAsNumeric .= $numeric;
	$returnString .= chr($numeric);
}
if(hash('sha256',$stringAsNumeric) != $sha256){
	return false;
}else{
	return $returnString;
}
	}

	function utf8Ord($c){
		list(, $ord) = unpack('N', mb_convert_encoding($c, 'UCS-4BE', 'UTF-8'));
		return $ord;
	}
	
	
}





?>