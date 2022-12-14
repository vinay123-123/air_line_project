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
	     $result = $db->select('*')->from('tbl_user')->where(array('username'=>$userData['uname'],'password'=>md5($userData['password'])));
	  $result_arr = $result->get();
	
	if($result_arr->num_rows() > 0)
	{
		$user_details = $result_arr->row_array();
		
		$this->session->set_userdata('flag',1);
	   $this->session->set_userdata('user_id',$user_details['user_id']);
	   $this->session->set_userdata('user_name',$user_details['username']);
	   
	    date_default_timezone_set("Asia/Calcutta");	
		
	$path = 'token_folder/token_id.txt';
	$token_id_json = file_get_contents($path);
	$token_id_arr = json_decode($token_id_json,true);
	$token_id_datetime = $token_id_arr['datetime'];
	$current_datetime = date('Y-m-d h:i:s');
	$hourdiff = round((strtotime($current_datetime) - strtotime($token_id_datetime))/3600, 1);
	
	if($hourdiff > 24){
		
   	 $ip = $_SERVER['REMOTE_ADDR'];
     $request = '{
			"ClientId":"ApiIntegrationNew",
			"UserName":"Inditab",
			"Password":"Inditab@12",
			"EndUserIp":"'.$ip.'"
			}';
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$request,
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));
			$response = curl_exec($curl);
			curl_close($curl);
        $result_api = json_decode($response,true);
	 
	   $TokenId = $result_api['TokenId'];	
	   
	   $token_id_update_json = '{"token_id":"'.$TokenId.'","datetime":"'.date('Y-m-d h:i:s').'"}';
	
       $path =  'token_folder/token_id.txt';		
		  file_put_contents($path, $token_id_update_json);
	}
	    redirect('home');	
	}else{
	$this->session->set_flashdata('error_msg','Plaese enter correct username and password');
		   redirect('login');		
	}
}

 public function search_flight()
	{
		$userData = $this->input->post();
		$arrT = date('Y-m-d', strtotime($userData['departure_date'] . ' +4 day'));
		
    	$ip = $_SERVER['REMOTE_ADDR'];
	    $db = $this->load->database('default',true);
		$request = '{
			 "EndUserIp": "'.$ip.'",
			 "TokenId": "'.$userData['TokenId'].'",
			 "AdultCount": "'.$userData['adult'].'",
			 "ChildCount": "'.$userData['child'].'",
			 "InfantCount": "'.$userData['infant'].'",
			 "DirectFlight": "false",
			 "OneStopFlight": "false",
			 "JourneyType": "1",
			 "PreferredAirlines": null,
			 "Segments": [
			 {
			 "Origin": "'.$userData['origin'].'",
			 "Destination": "'.$userData['destination'].'",
			 "FlightCabinClass": "'.$userData['class'].'",
			 "PreferredDepartureTime": "'.$userData['departure_date'].'T00: 00: 00",
			 "PreferredArrivalTime": "'.$arrT.'T00: 00: 00"
			 }
			 ],
			 "Sources": [
			 "GDS"
			 ]
			}';
		
	    $curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$request,
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Accept: application/json'
			  ),
			));
			$response = curl_exec($curl);
			
			//echo $response;die;
	    	$search_data = json_decode($response,true);
			curl_close($curl);	
	if(isset($search_data['Response']['Error']['ErrorMessage']) && $search_data['Response']['Error']['ErrorMessage'] != ''){		
	
	$this->session->unset_userdata('search_data');
	$this->session->set_userdata('input_data',$userData);
	$this->session->set_flashdata('error_search',$search_data['Response']['Error']['ErrorMessage']);
		redirect('home');
	  
	   }else{
    	 $user_search_detail_arr = array(
			'user_id'=>$userData['user_id'],
			'origin'=>$userData['origin'],
			'destination'=>$userData['destination'],
			'departure_date'=>$userData['departure_date'],
			'request'=>$request,
			'response'=>$response,
			'adult'=>$userData['adult'],
			'child'=>$userData['child'],
			'infant'=>$userData['infant'],
			'class'=>$userData['class'],
			'ip_address'=>$ip
			);
	
	$result = $db->insert('tbl_user_search_details',$user_search_detail_arr);	
		$search_data = json_decode($response,true);
		$this->session->set_userdata('search_data',$search_data);
		$this->session->set_userdata('input_data',$userData);
		
	   redirect('home');
	 }
}
	
	public function user_logout()
	{
		$this->session->unset_userdata('flag');
		$this->session->unset_userdata('search_data');
	    $this->session->unset_userdata('user_id');	
	    $this->session->unset_userdata('input_data');	
		$this->session->unset_userdata('user_name');
	      redirect('login');
  }
  
}
