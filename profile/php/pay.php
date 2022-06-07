<?php
	session_start();
	$username = $_SESSION['username'];
	$fullname = $_SESSION['buyer_name'];
	require("../../src/Instamojo.php");

	$amount = $_GET['amount'];


	
    $api = new Instamojo\Instamojo('test_f28e93829abb0ef9ef6c106acff','test_d97f9a35885a4f1289d59ba5de0',
	 'https://test.instamojo.com/api/1.1/');


	 
	try {
    	$response = $api->paymentRequestCreate(array(
        "purpose" => "PICDRIVE PLANS",
        "amount" => $amount,
        "send_email" => true,
        "buyer_name" => $fullname,
        "email" => $username,
        "phone" => "9934940000",
        "redirect_url" => "http://wapinstitute.com"
	        ));
	   
	   $payment_url = $response['longurl'];
	   header("Location:$payment_url");
	}
	catch (Exception $e) {
	    print('Error: ' . $e->getMessage());
	}


?>