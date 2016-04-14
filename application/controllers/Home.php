<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
	public function index(){
		$this->load->model('user_model');
		if($this->user_model->get()){
			$data['users']=$this->user_model->get();
			$this->load->view('templates/header');
			$this->load->view('home',$data);
			$this->load->view('templates/footer');
		}
		
	}
		
}