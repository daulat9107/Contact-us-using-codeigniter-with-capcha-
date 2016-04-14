<?php
class Captcha_model extends CI_Model{
	public function expiry(){
		return time() - 900;
	}
	public function add($cap){
		$data = array(
        'captcha_time'  => $cap['time'],
        'ip_address'    => $this->input->ip_address(),
        'word'          => $cap['word']
        );
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
	}
	public function check(){
		$expiration=$this->expiry();
		$this->db->where('captcha_time < ', $expiration)
        ->delete('captcha');
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array(
        	set_value('captcha'), 
        	$this->input->ip_address(), 
        	$expiration
        	);

        $query = $this->db->query($sql, $binds);
        $row = $query->row();
        if ($row->count == 0){
        	return false;
    	}
    	return true;
	}
}