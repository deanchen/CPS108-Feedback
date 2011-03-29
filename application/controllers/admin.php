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
		$name = $this->input->post('name');
		$target = $this->input->post('target');
		$template = $this->input->post('template');
		$due_date = $this->input->post('due_date');
		$this->forms_model->assign($name, $target, $template, $due_date);
	}
	
	function students_assign() {
		$this->load->view('students_assign');	
	}
	
	function map_students_to_ta() {
		if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
			$row = 0;
			$this->db->truncate('relationship');
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				// skip first row
				if ($row == 0) {
					$row++; 
					continue;
				}
				if ($data[0] !='' && $data[1] !='') {
					$data = array(
					'student' => $data[0],
					'ta' => $data[1]
					);
					
					$this->db->insert('relationship', $data); 
				}
				$row++;
			}
		} 
	}
}