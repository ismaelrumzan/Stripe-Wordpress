<?php
require_once('stripe-php-6.6.0/init.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
//Replace with your stripe API key here - start with the test developer key and then replace with production
\Stripe\Stripe::setApiKey("");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
try
{
	$token = $_POST['stripeToken'];
	$amount = $_POST['stripeAmount'];
	$email = $_POST['stripeEmail'];
	$description = $_POST['stripeDescription']." from ".$email;
	
	
	$newCustomer = \Stripe\Customer::create(array(
	  "description" => $description,
	  "email" => $email,
	  "source" => $token // obtained with Stripe.js,
	));	
	
	$subscription = \Stripe\Subscription::create(array(
	  "customer" => $newCustomer->id,
	  "items" => array(
		array(
		  "plan" => "", //replace with your subscription plan ID - find in stripe dashboard - I created a monthly plan for $.01/month - by multiplying with the quantity below - the plan is charged for any custom amount
		  "quantity" => $amount,
		),
	  )
	));
	//echo("charging monthly");
	header("Location: ");//Add your url location - redirect to your payment success page
	die();
	exit;
}
catch (Exception $e)
{
	//echo("charging monthly error");
	header("Location: ");//Add your url location - redirect to your payment error page
	die();
}

?>

