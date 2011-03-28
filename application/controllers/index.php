<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('forms_model');
	}

	function index()
	{
		$this->load->view('overview', ($this->forms_model->get_forms('zc17')));
	}
	//function 
}
