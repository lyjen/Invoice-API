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

class Vendors extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->lang->load('common', $this->get('mis_current_lang'));
	}
	
	public function get_get(){
		////For Searching
		$search_text = $this->get('search_text');

		$result = $this->vendor->get_vendor_search($search_text);
		$this->response($result, 200);
		//Product list to show columns, 1) vendor and 2) project category
	}
	
	public function get_vendor_details_get(){
		$vendor_id = $this->get('vendor_id');
		
		$result = $this->vendor->search(array('vendor_id' => $vendor_id));
		if (count($result)){
			$result = $result[0];
			$result->brand = $this->brand->get_brand_name($result->brand_id);
			$result->vendor_name = $result->name;
			$result->vendor_full_name = $result->fullname;
			$result->currency = $this->currency->get_currency_code($result->currency_id);
			$result->salesforce_ref = $result->salesforce_id;
			
			$last_po = $this->vendor->get_vendor_last_po($vendor_id);
			if ($last_po){
				$result->last_po_date = $last_po->update_time;
			} else {
				$result->last_po_date = '';
			}
			$result->last_po = $last_po;
		}
		$this->response($result, 200);
	}
}