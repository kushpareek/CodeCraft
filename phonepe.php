<?php

include('./dbConnection.php');
session_start();
if (!isset($_SESSION['stuLogEmail'])) {
    // Redirect to login page if the user is not logged in
    header("Location: loginorsignup.php");
    exit();
}

// Your JSON data

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderId = $_POST['ORDER_ID'];
    print_r($orderId);
    $courseID = $_POST['COURSE_ID'];
    $orderAmount = $_POST['TXN_AMOUNT'];
    $orderCurrency = $_POST['ORDER_CURRENCY'];
    
    $customerEmail = $_POST['CUST_ID'];
    $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, status, respmsg, amount, order_date) 
        VALUES ('$orderId', '$customerEmail', '$courseID', 'pending', 'pending', '$orderAmount', current_timestamp())";
        if ($conn->query($sql)) {
$data = [
    "merchantId" => "CODECRAFTONLINE",
    "merchantTransactionId" => $orderId,
    "merchantUserId" => "MUID123",
    "amount" => $orderAmount*100,
    "redirectUrl" => "https://localhost/ivision/redirect_url.php",
    "redirectMode" => "POST",
    "callbackUrl" => "https://localhost/phonepe/callback_url.php",
    "mobileNumber" => "1234567890",
    "paymentInstrument" => [
        "type" => "PAY_PAGE"
    ]
];

// Base64 encode the JSON payload
$base64Payload = base64_encode(json_encode($data));

// Define salt key and index
$saltKey = '56ee5c6d-03cf-459f-9b8c-50dfe7b74eb1';
$saltIndex = 1;

// Calculate X-VERIFY header
$verificationString = $base64Payload . '/pg/v1/pay' . $saltKey;
$checksum = hash('sha256', $verificationString) . '###' . $saltIndex;

// Define the request headers
$headers = [
    'Content-Type: application/json',
    "accept: application/json",
    'X-VERIFY: ' . $checksum,
];

// Define the API endpoint
$apiEndpoint = 'https://api.phonepe.com/apis/hermes/pg/v1/pay';

// Create the cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['request' => $base64Payload]));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL request
$response = curl_exec($ch);
$final = json_decode($response,true);
print_r($final);
// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);
header('Location:'. $final['data']['instrumentResponse']['redirectInfo']['url']);   
exit;
        }
}
// Output the response
echo '<pre>';
print_r($final);
echo '</pre>';
?>
