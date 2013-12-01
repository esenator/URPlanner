<?php
// Create connection
$con=mysqli_connect("http://ec2-54-201-36-124.us-west-2.compute.amazonaws.com","root","EDS","URPlanner");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?> 

<html>

</html>
