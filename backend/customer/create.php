<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if($request->name === '' || $request->phone_no === '' || $request->email === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $name = mysqli_real_escape_string($con, $request->name);
  $phone_no = mysqli_real_escape_string($con, (int)$request->phone_no);
  $email = mysqli_real_escape_string($con, $request->email);

  // Create.
  $sql = "INSERT INTO `customer`(`id`,`name`,`phone_no`, `email`) VALUES (null,'{$name}','{$phone_no}', '{$email}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $customer = [
      'name' => $name,
      'phone_no' => $phone_no,
      'email' => $email,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($customer);
  }
  else
  {
    http_response_code(422);
  }
}