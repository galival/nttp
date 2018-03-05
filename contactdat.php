<?php
/*contact data form

	to do:
		send error messages on form.
		additional data validation

*/


//define form variables and error variables

$name = $email = $website = $message = "";
$name_err = $email_err = $website_err = $message_err = "";

//output variables
$to = "email@gmail.com";
$subject = "message from ";
$line1 = $line2 = $line3 = $line4 = $header = $content = "";

//check each form element


if (empty($_POST["message"])) {
	$message_err = $message_err;
	$message = "no message";
} else {
	$message = test_input($_POST["message"]);
}



if (empty($_POST["name"])) {
    $name_err = $name_err;
    $name = "no name";
  } else {
    $name = test_input($_POST["name"]);
  }



if (empty($_POST["email"])) {
	$email_err = "email is required";
} else {
	$email = test_input($_POST["email"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "invalid email"; 
	}
}


if (empty($_POST["website"])) {
	$website_err = $website_err;
	$website = "no website";
} else {
	$website = test_input($_POST["website"]);
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) 
	{
      $website_err = "Invalid URL"; 
      $message_err = "enter a message...";
	}
}


//prepare message
$header = "From: ".$email."\r\n";

$line1 = "From: ".$name."\n";
$line2 = "Email: ".$email."\n";
$line3 = "Website: ".$website."\n";
$line4 = "Message: ".$message."\n";

$content = $line1.$line2.$line3.$line4;

$content = str_replace("\n.", "\n..", $content);

//send email
mail($to,$subject,$content,$header);


//send email back to sender

/*prep vars here*/


//functions

//sanitize data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

include 'header.php';
echo '<h2>your message has been sent</h2>';
include 'footer.php';

?>