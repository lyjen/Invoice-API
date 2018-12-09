<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Vendor_login extends REST_Controller{

	function login_post(){
		if ($this->post('username') && $this->post('password')){
			$result = $this->vendor_user->login($this->post('username'), $this->post('password'));
			$this->response($result, 200);
		} else {
			$this->response(array(), 404);
		}
	}

	function login_get(){
		//if ($this->post('username') && $this->post('password')){
			$result = $this->vendor_user->login('vendor_101', 'P@ssw0rd');
			$this->response($result, 200);
	//	} else {
		//	$this->response(array(), 404);
		//}
	}

}