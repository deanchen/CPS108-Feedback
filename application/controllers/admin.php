<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('forms_model');
	}

	function index()
	{
		$data = array();
		$data['templates'] = $this->forms_model->get_templates();
		$this->load->view('assign', $data);
	}
	
	function setNetid($netid) {
		$this->session->set_userdata('netid', $netid);
		echo "Net ID has been set to: " . $this->session->userdata('netid');
	}
	
	function assign() {
		$tempssign($name, $target, $template, $due_date);
	}
}