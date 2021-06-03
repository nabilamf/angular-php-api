<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$customer = [];
$sql = "SELECT id, name, phone_no, email FROM customer";

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $customer[$i]['id']    = $row['id'];
    $customer[$i]['name'] = $row['name'];
    $customer[$i]['phone_no'] = $row['phone_no'];
    $customer[$i]['email'] = $row['email'];
    $i++;
  }

  echo json_encode($customer);
}
else
{
  http_response_code(404);
}