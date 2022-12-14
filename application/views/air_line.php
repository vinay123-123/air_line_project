<?php
$flag = $this->session->userdata('flag');
$path = 'token_folder/token_id.txt';
$token_id_json = file_get_contents($path);
$token_id_arr = json_decode($token_id_json,true);
$TokenId = $token_id_arr['token_id'];

$search_data = $this->session->userdata('search_data');
$input_data = $this->session->userdata('input_data');
$user_id = $this->session->userdata('user_id');

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
  <b>User Id : </b><?php echo $user_id; ?>
<div class="row" style="margin-top:30px">
<form class="example" action="<?php echo base_url(); ?>/search_flight" method="post">
<select name="origin" id="origin" required>
  <option value="">Select Origin</option>
  <option value="DEL" <?php if(isset($input_data['origin'])){echo $input_data['origin']=='DEL'?'selected':'';}; ?>>Delhi</option>
  <option value="BOM" <?php if(isset($input_data['origin'])){echo $input_data['origin']=='BOM'?'selected':'';}; ?>>Bombay</option>
  <option value="HYD" <?php if(isset($input_data['origin'])){echo $input_data['origin']=='HYD'?'selected':'';}; ?>>Hedrabad</option>
  <option value="GOI" <?php if(isset($input_data['origin'])){echo $input_data['origin']=='GOI'?'selected':'';}; ?>>Goa</option>
  <option value="LKO" <?php if(isset($input_data['origin'])){echo $input_data['origin']=='LKO'?'selected':'';}; ?>>Lucknow</option>
</select>

<select name="destination" id="destination" required>
  <option value="">Select Destination</option>
  <option value="DEL" <?php if(isset($input_data['destination'])){echo $input_data['destination']=='DEL'?'selected':'';}; ?>>Delhi</option>
  <option value="BOM" <?php if(isset($input_data['destination'])){echo $input_data['destination']=='BOM'?'selected':'';}; ?>>Bombay</option>
  <option value="HYD" <?php if(isset($input_data['destination'])){echo $input_data['destination']=='HYD'?'selected':'';}; ?>>Hedrabad</option>
  <option value="GOI" <?php if(isset($input_data['destination'])){echo $input_data['destination']=='GOI'?'selected':'';}; ?>>Goa</option>
  <option value="LKO" <?php if(isset($input_data['destination'])){echo $input_data['destination']=='LKO'?'selected':'';}; ?>>Lucknow</option>
</select>

  <input  type="text" placeholder="Enter Departure Date"
        onfocus="(this.type='date')"
        onblur="(this.type='text')" min="<?php echo date('Y-m-d'); ?>" name="departure_date" value="<?php if(isset($input_data['departure_date'])){echo $input_data['departure_date'];}; ?>" required>
  
<select name="adult" id="adult" required>
  <option value="">Select Adult</option>
  <option value="1" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='1'?'selected':'';}; ?>>1</option>
  <option value="2" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='2'?'selected':'';}; ?>>2</option>
  <option value="3" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='3'?'selected':'';}; ?>>3</option>
  <option value="4" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='4'?'selected':'';}; ?>>4</option>
  <option value="5" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='5'?'selected':'';}; ?>>5</option>
  <option value="6" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='6'?'selected':'';}; ?>>6</option>
  <option value="7" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='7'?'selected':'';}; ?>>7</option>
  <option value="8" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='8'?'selected':'';}; ?>>8</option>
  <option value="9" <?php if(isset($input_data['adult'])){echo $input_data['adult']=='9'?'selected':'';}; ?>>9</option>
</select>

<select name="child" id="child" required>
  <option value="">Select Child</option>
  <option value="0" <?php if(isset($input_data['child'])){echo $input_data['child']=='0'?'selected':'';}; ?>>0</option>
  <option value="1" <?php if(isset($input_data['child'])){echo $input_data['child']=='1'?'selected':'';}; ?>>1</option>
  <option value="2" <?php if(isset($input_data['child'])){echo $input_data['child']=='2'?'selected':'';}; ?>>2</option>
  <option value="3" <?php if(isset($input_data['child'])){echo $input_data['child']=='3'?'selected':'';}; ?>>3</option>
  <option value="4" <?php if(isset($input_data['child'])){echo $input_data['child']=='4'?'selected':'';}; ?>>4</option>
  <option value="5" <?php if(isset($input_data['child'])){echo $input_data['child']=='5'?'selected':'';}; ?>>5</option>
  <option value="6" <?php if(isset($input_data['child'])){echo $input_data['child']=='6'?'selected':'';}; ?>>6</option>
  <option value="7" <?php if(isset($input_data['child'])){echo $input_data['child']=='7'?'selected':'';}; ?>>7</option>
  <option value="8" <?php if(isset($input_data['child'])){echo $input_data['child']=='8'?'selected':'';}; ?>>8</option>
  <option value="9" <?php if(isset($input_data['child'])){echo $input_data['child']=='9'?'selected':'';}; ?>>9</option>
</select>

<select name="infant" id="infant" required>
  <option value="">Select Infant</option>
  <option value="0" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='0'?'selected':'';}; ?>>0</option>
  <option value="1" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='1'?'selected':'';}; ?>>1</option>
  <option value="2" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='2'?'selected':'';}; ?>>2</option>
  <option value="3" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='3'?'selected':'';}; ?>>3</option>
  <option value="4" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='4'?'selected':'';}; ?>>4</option>
  <option value="5" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='5'?'selected':'';}; ?>>5</option>
  <option value="6" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='6'?'selected':'';}; ?>>6</option>
  <option value="7" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='7'?'selected':'';}; ?>>7</option>
  <option value="8" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='8'?'selected':'';}; ?>>8</option>
  <option value="9" <?php if(isset($input_data['infant'])){echo $input_data['infant']=='9'?'selected':'';}; ?>>9</option>
</select>
  
<select name="class" id="class" required>
  <option value="">Select Class</option>
  <option value="1" <?php if(isset($input_data['class'])){echo $input_data['class']=='1'?'selected':'';}; ?>>All</option>
  <option value="2" <?php if(isset($input_data['class'])){echo $input_data['class']=='2'?'selected':'';}; ?>>Economy</option>
  <option value="3" <?php if(isset($input_data['class'])){echo $input_data['class']=='3'?'selected':'';}; ?>>Premium Economy</option>
  <option value="4" <?php if(isset($input_data['class'])){echo $input_data['class']=='4'?'selected':'';}; ?>>Business</option>
  <option value="5" <?php if(isset($input_data['class'])){echo $input_data['class']=='5'?'selected':'';}; ?>>Premium Business</option>
  <option value="6" <?php if(isset($input_data['class'])){echo $input_data['class']=='6'?'selected':'';}; ?>>First</option>
</select>
  <input type="hidden" name="TokenId" value="<?php echo $TokenId; ?>">
  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  <button type="submit">Search</button>
</form>
</div>
  <a href="user_logout"><button style="margin-left: 1100px;color:red">Log Out</button></a>
<br><br>
<?php if(isset($search_data) && $search_data != ''){ //print_r($search_data); echo count($search_data['Response']['Results']['0']['0']);
 if(isset($search_data['Response']['Results']) && $search_data['Response']['Results'] != ''){
	 
$search_data_arr = $search_data['Response']['Results']['0'];
foreach($search_data_arr as $search_data_arr){
?>
<div class="container" style="margin-left: 40px;">
<p>Flight Name : <?php echo $search_data_arr['Segments']['0']['0']['Airline']['AirlineName']; ?> </p>
<p>Origin : <?php echo $search_data['Response']['Origin']; ?> </p>
<p>Destination : <?php echo $search_data['Response']['Destination']; ?></p>
<p>Duration : <?php echo $search_data_arr['Segments']['0']['0']['Duration'].' min'; ?></p>
<p>Departure : <?php echo $search_data_arr['Segments']['0']['0']['Origin']['DepTime']; ?> </p>
<p>Arrival : <?php echo $search_data_arr['Segments']['0']['0']['Destination']['ArrTime']; ?></p>
<p>CabinClass : <?php $CabinClass = $search_data_arr['Segments']['0']['0']['CabinClass']; 
if($CabinClass == 1){
	echo'All';
}elseif($CabinClass == 2){
	echo'Economy';
}elseif($CabinClass == 3){
	echo'Premium Economy';
}elseif($CabinClass == 4){
	echo'Business';
}elseif($CabinClass == 5){
	echo'Premium Business';
}elseif($CabinClass == 6){
	echo'First';
}  ?></p>
<p>PublishedFare : <?php echo $search_data_arr['Fare']['PublishedFare']; ?> </p>
<p>OfferedFare : <?php echo $search_data_arr['Fare']['OfferedFare']; ?></p>
<p>Discount : <?php echo $search_data_arr['Fare']['PublishedFare']-$search_data_arr['Fare']['OfferedFare']; ?></p>
<p>AirPort : <?php echo $search_data_arr['Segments']['0']['0']['Origin']['Airport']['AirportName']; ?> </p>
</div>
<br><br>
<?php }}} //echo'<pre>';print_r($search_data);  ?>

</div>

</body>
</html>
