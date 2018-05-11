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
	$description = $_POST['stripeDescription'];

	$charge = \Stripe\Charge::create([
		'amount' => $amount,
		'currency' => 'cad',
		'description' => $description,
		'receipt_email' => $email,
		'source' => $token,
	]);
	//echo("charging once");
	header("Location: ");//Add your url location - redirect to your payment success page
	die();
	exit;
}
catch (Exception $e)
{
	//echo("charging once error");
	header("Location: ");//Add your url location - redirect to your payment error page
	die();
}

?>

