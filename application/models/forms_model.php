<?php
class Forms_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
		$this->load->model('users_model');
    }
	
	function get_forms($netid) {
		/*
		$person = $this->users_model->getPerson($netid);
		if ($this->users_model->isStudent($person)) {
			*/
			// get all assignments
			$this->db->where('origin', $netid);
			$query = $this->db->get('assignments');
			$assignments = $query->result();
			
			$results = array();
			$results['assignments'] = $assignments;
			return $results;
		/* 
		} else if ($this->users_model->isTa($person)) {
			
		}*/	
	}
	
	function get_feedbacks($netid) {
		/*
		$person = $this->users_model->getPerson($netid);
		if ($this->users_model->isStudent($person)) {
			*/
			$this->db->where('target', $netid);
			$query = $this->db->get('assignments');
			$feedback = $query->result();
			
			$results = array();
			$results['feedbacks'] = $feedback;
			
			return $results;
		/* 
		} else if ($this->users_model->isTa($person)) {
			
		}*/	
	}
	
	function get_form($form_id) {
		$this->db->where('id', $form_id);
		$query = $this->db->get('assignments');
		$assignment = $query->row();
		
		$this->db->where('name', $assignment->template);
		$query = $this->db->get('form_templates');
		return $query->row()->data;
	}
	
	function get_templates() {
		$query = $this->db->get('form_templates');
		$data = array();
		foreach ($query->result() as $result) {
			$data[$result->name] = $result;
		}
	
		return $data;

	}
	
	function assign($name, $target, $template, $due_date) {
		$this->db->where('type', $target);
		$query = $this->db->get('people');
		
		foreach ($query->result() as $result) {
			$netid = $result->net_id;
			
			$assignment = array(
				'name' => $name,
				'data' => '',
				'origin' => $netid,
				'template' => $template,
				'date_assigned' => '2011-03-28',
				'date_due' => $due_date
			);
			
			$this->db->insert('assignments', $assignment);
			print('assign successful');
		}
	}
	
	function read_form($form_id) {
		$this->db->where('id', $form_id);
		$query = $this->db->get('assignments');
		$assignment = $query->row();

		return $query->row()->data;
	}
	
	function default_student()
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
			'name' => 'Default Student Template',
			'type' => 'student',
			'data' => serialize($form),
			'date_created' => '2011-02-28',
		);
		$this->db->insert('form_templates', $sql_data);
	}

	function default_ta()
	{
		$form = array();
		
		$form['rating'] = array(
			'label' => "How would rate the student's progress this week (1-5 scale)",
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['rating_justification'] = array(
			'label' => 'Provide a brief justification for your rating',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['did_well'] = array(
			'label' => 'What is the student doing well that should be continued?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['did_poorly'] = array(
			'label' => 'What is the student doing poorly that should be stopped?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);
		
		$form['improve'] = array(
			'label' => 'What should the student start trying to do to really improve their design skills?',
			'type' => 'form_textarea',
			'attributes' => array(),
		);

		$sql_data = array(
			'name' => 'Default TA Template',
			'type' => 'ta',
			'data' => serialize($form),
			'date_created' => '2011-02-28',
		);
		$this->db->insert('form_templates', $sql_data);
	}
}
