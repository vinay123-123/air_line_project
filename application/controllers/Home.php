<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('air_line');
	}
	
	public function login()
	{
		$this->load->view('login');
	}

	public function user_login()
	{
		$userData = $this->input->post();
	    $db = $this->load->database('default',true);
	     $result = $db->select('*')->from('tbl_admin')->where(array('username'=>$userData['uname'],'password'=>$userData['password']));
	$result_arr = $result->get();
	
	if($result_arr->num_rows() > 0)
	{
	redirect('home');
	}else{
		$this->session->set_flashdata('error_msg','Plaese enter correct username and password');
		   redirect('login'); 
	}
	
		//$this->load->view('login');
	}
}
