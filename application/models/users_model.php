<?php
class Users_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	function getPerson($netid) {
		$this->db->where('net_id', $netid);
		$query = $this->db->get('people');
		
		$person = $query->row();
		return $person;
	}
	
	function isStudent($person) {
		if ($person->type === 'student') return true;
		else return false;
	}
	
	function isTa($person) {
		if ($person->type === 'ta') return true;
		else return false;
	}
	
}