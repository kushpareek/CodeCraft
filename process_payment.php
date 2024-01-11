<?php
include('./dbConnection.php');
session_start();
require 'stripe_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useremail = $_POST['customerEmail'];
    $amount = $_POST['orderAmount'] * 100; // Convert amount to cents (Stripe uses cents)
    $orderid = $_POST['orderId'];
    $courseID = $_POST['courseID'];
    $tbAmount = $amount/100;
    $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, status, respmsg, amount, order_date) 
        VALUES ('$orderid', '$useremail', '$courseID', 'pending', 'pending', '$tbAmount', current_timestamp())";
    $conn->query($sql);
    try {
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'INR',
                    'product_data' => [
                        'name' => 'Course Payment',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost/ivision/paymentdone.php?orderid='.$orderid.'&unit_amount='.$amount.'&useremail='.urlencode($useremail).'&courseid='.$courseID,
            'cancel_url' => 'https://yourdomain.com/index.php',
        ]);
 
        header('Location: ' . $session->url);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
