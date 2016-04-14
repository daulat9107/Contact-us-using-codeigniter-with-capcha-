<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class contactus extends CI_Controller{
	private $successFile,$errorsFile;
	public function index($errors=null){
		$this->load->helper('string');
		$this->load->model('captcha_model');
		$this->load->helper('captcha');
				$vals = array(
        'word'          =>generateRandomString('6'),
        'img_path'      => './captcha/',
        'img_url'       => base_url().'captcha/',
        'font_path'     => './fonts/OpenSans-Bold.ttf',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 900,
        'word_length'   => 8,
        'font_size'     => 15,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'colors'        => array(
                'background' => array(255, 0, 0),
                'border' => array(255, 255, 255),
                'text' => array(255, 255, 255),
                'grid' => array(0,0,0)
        )
);
		$cap = create_captcha($vals);
		$data['captcha']=$cap['image'];
		$data['errors']=$errors;
        $this->captcha_model->add($cap);
		$this->load->view('templates/header');
		$this->load->view('contactus',$data);
		$this->load->view('templates/footer');
	}
	public function postContactus(){

		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');
		$config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
        ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
        ),
        array(
                'field' => 'mobile',
                'label' => 'Mobile',
                'rules' => 'required|min_length[10]|max_length[10]'
        ),
         array(
                'field' => 'captcha',
                'label' => 'Captcha',
                'rules' => 'required|callback_captcha_check'
        )
	);
			
$this->form_validation->set_rules($config);
	if ($this->form_validation->run() == FALSE){
	        $this->index();
        }else{
        	
				if ($this->userfile()) {

					$message="The text of your email that
						gets wrapped normally.
						{unwrap}http://example.com/a_long_link_that_should_not_be_wrapped.html{/unwrap}
						More text that will be
						wrapped normally.".set_value('mobile');
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from(set_value('email'),set_value('name'));
				$this->email->to('example@gmail.com');
				$this->email->cc('example1@gmail.com');
				$this->email->bcc('example2@gmail.com');
				$this->email->subject(set_value('name'));
				$this->email->attach(base_url().'uploads/'.$this->successFile['file_name'],'inline');
				$this->email->message($message);
				if($this->email->send()){
					$this->load->model('contactus_model');
					
					if($this->contactus_model->addContact($this->successFile)){
						$this->session->set_flashdata('success', 'Thank you for submitting the form.');
						redirect(base_url().'contactus');
					}
				}
				}else{
					$this->index($this->errorsFile);
				}
				
        	
        }


		
	}
 public function captcha_check(){
 	$this->load->model('captcha_model');
 	if($this->captcha_model->check()===false){
 		$this->form_validation->set_message('captcha_check', 'You must submit the {field} that appears in the image.');
 		return false;
 	}
 	return true;

 }
 public function userfile(){

 	$this->load->library('upload');
	if (!$this->upload->do_upload('userfile')){
		$this->errorsFile=$this->upload->display_errors();
		return false;
	}
		
		$this->successFile=$this->upload->data();
		return true;
 }

}