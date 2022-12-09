<?php
$flag = $this->session->userdata('flag');
$TokenId = $this->session->userdata('TokenId');
$username = $this->session->userdata('username');
$search_data = $this->session->userdata('search_data');

if($flag != 1){
	redirect('login');
}


?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Air Line</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">

	</style>
</head>
<body>

<div class="container">
 <?php $error_search = $this->session->flashdata('error_search'); ?> 
  <h3 style="color: red;"><?php if(isset($error_search)){
	  echo $error_search;
  } ?></h3> 
<div class="row" style="margin-top:30px">
<form class="example" action="<?php echo base_url(); ?>/search_flight" method="post">
<select name="origin" id="origin" required>
  <option value="">Select Origin</option>
  <option value="DEL">Delhi</option>
  <option value="BOM">Bombay</option>
  <option value="HYD">Hedrabad</option>
  <option value="GOI">Goa</option>
  <option value="LKO">Lucknow</option>
</select>

<select name="destination" id="destination" required>
  <option value="">Select Destination</option>
  <option value="DEL">Delhi</option>
  <option value="BOM">Bombay</option>
  <option value="HYD">Hedrabad</option>
  <option value="GOI">Goa</option>
  <option value="LKO">Lucknow</option>
</select>

  <input  type="text" placeholder="Enter Departure Date"
        onfocus="(this.type='date')"
        onblur="(this.type='text')" name="departure_date" required>
  
<select name="adult" id="adult" required>
  <option value="">Select Adult</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
</select>

<select name="child" id="child" required>
  <option value="">Select Child</option>
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
</select>

<select name="infant" id="infant" required>
  <option value="">Select Infant</option>
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
</select>
  
<select name="class" id="class" required>
  <option value="">Select Class</option>
  <option value="all">All</option>
  <option value="economy">Economy</option>
  <option value="premium economy">Premium Economy</option>
  <option value="business">Business</option>
</select>
  <input type="hidden" name="username" value="<?php echo $username; ?>">
  <button type="submit">Search</button>
</form>
</div>
  <a href="user_logout"><button style="margin-left: 1100px;color:red">Log Out</button></a>
<br><br>
<?php if(isset($search_data) && $search_data != ''){ // echo count($search_data['Response']['Results']['0']['0']);

$search_data_arr = $search_data['Response']['Results']['0'];
foreach($search_data_arr as $search_data_arr){
?>
<div class="container" style="margin-left: 40px;">
<p>Flight Name : <?php echo $search_data_arr['Segments']['0']['0']['Airline']['AirlineName']; ?> </p>
<p>Origin : <?php echo $search_data['Response']['Origin']; ?> </p>
<p>Destination : <?php echo $search_data['Response']['Destination']; ?></p>
<p>Duration : <?php echo $search_data_arr['Segments']['0']['0']['Duration']; ?></p>
<p>Departure : <?php echo $search_data_arr['Segments']['0']['0']['StopPointDepartureTime']; ?> </p>
<p>Arrival : <?php echo $search_data_arr['Segments']['0']['0']['StopPointArrivalTime']; ?></p>
<p>PublishedFare : <?php echo $search_data_arr['Fare']['PublishedFare']; ?> </p>
<p>OfferedFare : <?php echo $search_data_arr['Fare']['OfferedFare']; ?></p>
<p>Discount : <?php echo $search_data_arr['Fare']['Discount']; ?></p>
<p>AirPort : <?php echo $search_data_arr['Segments']['0']['0']['Origin']['Airport']['AirportName']; ?> </p>
</div>
<br><br>
<?php }} //echo'<pre>';print_r($search_data);  ?>

</div>

</body>
</html>
