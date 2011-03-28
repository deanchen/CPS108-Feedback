<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('forms_model');
	}

	function index()
	{
		$this->load->view('welcome_message');
	}
	
	function create_student_template() {
		$this->forms_model->default_student();	
	}
	
	function create_ta_template() {
		$this->forms_model->default_ta();	
	}
	
}