<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if($request->name === '' || $request->phone_no === "" || $request->email === "")
  {
    return http_response_code(400);
  }

  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $name = mysqli_real_escape_string($con, $request->name);
  $phone_no = mysqli_real_escape_string($con, (int)$request->phone_no);
  $email = mysqli_real_escape_string($con, $request->email);

  // Update.
  $sql = "UPDATE `customer` SET `name`='$name',`phone_no`='$phone_no', `email`='$email' WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}