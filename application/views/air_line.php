<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
<div class="row" style="margin-top:30px">
<form class="example" action="">
<select name="origin" id="origin">
  <option value="">Select Origin</option>
  <option value="delhi">Delhi</option>
  <option value="mumbai">Mumbai</option>
  <option value="goa">Goa</option>
  <option value="chennai">Chennai</option>
</select>

<select name="destination" id="destination">
  <option value="">Select Destination</option>
  <option value="delhi">Delhi</option>
  <option value="mumbai">Mumbai</option>
  <option value="goa">Goa</option>
  <option value="chennai">Chennai</option>
</select>

  <input type="date" placeholder="Departure Date" name="departure_date">
  
<select name="adult" id="adult">
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

<select name="child" id="child">
  <option value="">Select Child</option>
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

<select name="infant" id="infant">
  <option value="">Select Infant</option>
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
  
<select name="class" id="class">
  <option value="">Select Class</option>
  <option value="all">All</option>
  <option value="economy">Economy</option>
  <option value="premium economy">Premium Economy</option>
  <option value="business">Business</option>
</select>
  
  <button type="submit">Search</button>
</form>
</div>
</div>

</body>
</html>
