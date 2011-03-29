<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if ($this->session->userdata('netid')) {
			$this->netid = $this->session->userdata('netid');
		} else {
			if (isset($_SERVER['Shib-Session-ID'])) {
				$email = explode('@', $_SERVER['eppn']);
				$this->netid = $email[0];	
			}		
		}
		$this->load->model('forms_model');
	}

	function index()
	{
		$data = array_merge(
			$this->forms_model->get_forms($this->netid),
			$this->forms_model->get_feedbacks($this->netid)
		); 
		
		$data['netid'] = $this->netid;
		$this->load->view('overview', $data);
	}
	
	function fill_form($id) {
		if ($this->forms_model->completed($id)) {
			echo "You have already submitted this form";
			return;
		}
		$data = array(
			'id' => $id,	
			'netid' => $this->netid,
			'form' => unserialize($this->forms_model->get_form($id)),		
		);
		$this->load->view('fill_form',$data);
	}
	
	function submit_form($id)
	{
		$this->load->library('user_agent');
		if (!$this->agent->is_referral())
		{
			$template_form = unserialize($this->forms_model->get_form($id));

			foreach ($template_form as $key => $element) {
				print $key . " " . $this->input->post($key);
				print "<br />";	
				print_r($element);
				print "<br />";	
				print "<br />";	
				$template_form[$key]['value'] = $this->input->post($key, true); 
			} 
			
			$form_data = array();
			$form_data['data'] = serialize($template_form);
			
			$this->db->where('id', $id);
			$this->db->update('assignments', $form_data);
			print "Your feedback has been recorded";
		}
	}
	
	function read_form($id)
	{
		$data = array(
			'id' => $id,	
			'netid' => $this->netid,
			'form' => unserialize($this->forms_model->read_form($id)),		
		);
		$this->load->view('read_form',$data);
	}
	
	function test_form($id)
	{
		$form = array();
		
		$form['did_well'] = array(
			'label' => 'What did I do well last week that I should continue doing next week?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['did_poorly'] = array(
			'label' => 'What did I do poorly last week that I should stop doing next week?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['did_learn'] = array(
			'label' => 'What did I learn this week that I should start doing next week?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['pro_con'] = array(
			'label' => 'What are the pros and cons of the the most difficult design decision you made this week?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['team_review'] = array(
			'label' => 'How did working in a team help or hinder completing the project?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['team_member'] = array(
			'label' => 'What can I do start doing next week to be a better team member?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['questions'] = array(
			'label' => 'What can I do start doing next week to be a better team member?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$sql_data = array(
			'name' => 'Test TA Form',
			'type' => 'ta',
			'data' => serialize($form),
			'date' => '2011-02-28',
			'due_date' => '2011-02-28',
		);
		//$this->db->insert('form', $sql_data);
		
		$data = array(
			'id' => $id,	
			'netid' => $this->netid,
			'form' => $form,		
		);
		$this->load->view('form',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */