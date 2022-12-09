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
		$this->session->set_userdata('flag',1);
	   $this->session->set_userdata('username',$userData['uname']);
	
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
			  CURLOPT_POSTFIELDS =>'{
			"ClientId":"ApiIntegrationNew",
			"UserName":"Inditab",
			"Password":"Inditab@12",
			"EndUserIp":"'.$ip.'"
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			
        $result_api = json_decode($response,true);
	if(isset($result_api['TokenId']) && $result_api['TokenId'] != ''){	
	$this->session->set_userdata('TokenId',$result_api['TokenId']);
	$this->session->set_userdata('MemberId',$result_api['Member']['MemberId']);
	$this->session->set_userdata('AgencyId',$result_api['Member']['AgencyId']);
	
	$user_detail_arr = array(
	'FirstName'=>$result_api['Member']['FirstName'],
	'LastName'=>$result_api['Member']['LastName'],
	'Email'=>$result_api['Member']['Email'],
	'username'=>$userData['uname'],
	'password'=>$userData['password'],
    'request'=>$request,
	'response'=>$response, 
	'MemberId'=>$result_api['Member']['MemberId'],
	'AgencyId'=>$result_api['Member']['AgencyId'],
	'LoginName'=>$result_api['Member']['LoginName'],
	'LoginDetails'=>$result_api['Member']['LoginDetails'],
	'TokenId'=>$result_api['TokenId'],
	'ip_address'=>$ip,
	'isPrimaryAgent'=>$result_api['Member']['isPrimaryAgent'],
	'status'=>$result_api['Status'],
	'ErrorCode'=>$result_api['Error']['ErrorCode'],
	'ErrorMessage'=>$result_api['Error']['ErrorMessage'],
	);
	
	$result = $db->insert('tbl_user_login_details',$user_detail_arr);
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
    	$ip = $_SERVER['REMOTE_ADDR'];
	    $db = $this->load->database('default',true);
		$request = '{
			 "EndUserIp": "'.$ip.'",
			 "TokenId": "'.$userData['TokenId'].'",
			 "AdultCount": "'.$userData['adult'].'",
			 "ChildCount": "'.$userData['child'].'",
			 "InfantCount": "'.$userData['infant'].'",
			 "DirectFlight": "true",
			 "OneStopFlight": "false",
			 "JourneyType": "1",
			 "PreferredAirlines": null,
			 "Segments": [
			 {
			 "Origin": "'.$userData['origin'].'",
			 "Destination": "'.$userData['destination'].'",
			 "FlightCabinClass": "1",
			 "PreferredDepartureTime": "'.$userData['departure_date'].'T00: 00: 00",
			 "PreferredArrivalTime": "2022-12-20T00: 00: 00"
			 }
			 ],
			 "Sources": [
			 "SG"
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
			  CURLOPT_POSTFIELDS =>'{
			 "EndUserIp": "'.$ip.'",
			 "TokenId": "'.$userData['TokenId'].'",
			 "AdultCount": "'.$userData['adult'].'",
			 "ChildCount": "'.$userData['child'].'",
			 "InfantCount": "'.$userData['infant'].'",
			 "DirectFlight": "true",
			 "OneStopFlight": "false",
			 "JourneyType": "1",
			 "PreferredAirlines": null,
			 "Segments": [
			 {
			 "Origin": "'.$userData['origin'].'",
			 "Destination": "'.$userData['destination'].'",
			 "FlightCabinClass": "1",
			 "PreferredDepartureTime": "'.$userData['departure_date'].'T00: 00: 00",
			 "PreferredArrivalTime": "2022-12-20T00: 00: 00"
			 }
			 ],
			 "Sources": [
			 "SG"
			 ]
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Accept: application/json'
			  ),
			));
			$response = curl_exec($curl);
	    	$search_data = json_decode($response,true);
			curl_close($curl);	
	if(isset($search_data['Response']['Error']['ErrorMessage']) && $search_data['Response']['Error']['ErrorMessage'] != ''){		
	
	$this->session->set_flashdata('error_search',$search_data['Response']['Error']['ErrorMessage']);
		redirect('home');
	  
	   }else{
    	 $user_search_detail_arr = array(
			'username'=>$userData['username'],
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
		
	   redirect('home');
	 }
	
	}
	public function user_logout()
	{
	$TokenId = $this->session->userdata('TokenId');
	$MemberId =	$this->session->userdata('MemberId');
	$AgencyId =	$this->session->userdata('AgencyId');	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Logout',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	"ClientId": "ApiIntegrationNew",
	"EndUserIp": "'.$ip.'",
	"TokenAgencyId": '.$AgencyId.',
	"TokenMemberId": '.$MemberId.',
	"TokenId": "'.$TokenId.'"
	}',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	
		$this->session->unset_userdata('flag');
		$this->session->unset_userdata('search_data');
		$this->session->unset_userdata('TokenId');
	      redirect('login');
  }
  
}
