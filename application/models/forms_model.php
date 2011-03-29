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
	
	function completed($form_id) {
		if ($this->get_form($form_id)!='') {
			return true;
		} else {
			return false;
		}	
	}
	
	function get_templates() {
		$query = $this->db->get('form_templates');
		$data = array();
		foreach ($query->result() as $result) {
			$data[$result->name] = $result;
		}
	
		return $data;

	}
	
	function assign($name, $type, $template, $due_date) {
		$this->db->where('type', $type);
		$query = $this->db->get('people');
		$people = $query->result();
		
		foreach ($people as $person) {
			$netid = $person->net_id;
			$targets = $this->getTargets($netid, $type);
			
			foreach ($targets as $target) {
				$assignment = array(
					'id' => $this->randomString(),
					'name' => $name,
					'data' => '',
					'origin' => $netid,
					'target' => $target,
					'template' => $template,
					'date_assigned' => date('Y-m-d'),
					'date_due' => $due_date
				);
			
				$this->db->insert('assignments', $assignment);
				print("Assigned to $netid feedback for $target<br />");
			}
			
		}
	}
	
	function getTargets($netid, $type) {
		$this->db->where($type, $netid);
		$query = $this->db->get('relationship');
		$results = $query->result();
		
		$targets = array();
		foreach ($results as $result) {
			if ($type == 'student') {
				$targets[] = ($result->ta);	
			} elseif ($type == 'ta') {
				$targets[] = ($result->student);	
			}
		}
		return $targets;
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
	
	function randomString($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
	    $chars_length = (strlen($chars) - 1);
	    $string = $chars{rand(0, $chars_length)};

	    for ($i = 1; $i < $length; $i = strlen($string)) {
	        $r = $chars{rand(0, $chars_length)};
	        if ($r != $string{$i - 1}) $string .=  $r;
	    }
	    return $string;
	}
}
