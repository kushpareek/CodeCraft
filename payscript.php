<?php
include('./dbConnection.php');
session_start();

// Logging Function
function logError($message) {
    // Log the error message to a file or database for debugging purposes
    $logFilePath = 'error.log';
    $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
}

if (!isset($_SESSION['stuLogEmail'])) {
    // Redirect to login page if the user is not logged in
    header("Location: loginorsignup.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission and create payment order here
    $appId = "TEST4318958584ed0ac5fa267bc647598134";
    $orderId = $_POST['orderId'];
    $courseID = $_POST['courseID'];
    $version = "2022-01-01";
    $orderAmount = $_POST['orderAmount'];
    $orderCurrency = $_POST['orderCurrency'];
    $customerPhone = $_POST['customerPhone'];
    $customerEmail = $_POST['customerEmail'];
    $returnUrl = "http://localhost/ivision/paymentdone.php";

    // Implement any additional validations or checks here

    // Create the payment order in the database
    $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, status, respmsg, amount, order_date) 
        VALUES ('$orderId', '$customerEmail', '$courseID', 'pending', 'pending', '$orderAmount', current_timestamp())";

    if ($conn->query($sql)) {
        // Payment order created successfully, proceed to the payment gateway
        $mode = "Test"; // Change to TEST for test server, PROD for production
        $secretKey = "TESTd2131524a05e20347f83b4fa49f9270c82dbdae9";
        $postData = array(
            "version"=>$version,
            "appId" => $appId,
            "orderId" => $orderId,
            "courseID" => $courseID,
            "orderAmount" => $orderAmount,
            "orderCurrency" => $orderCurrency,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => $returnUrl,
        );

        ksort($postData);
        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }

        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);

        if ($mode == "PROD") {
            $url = "https://www.cashfree.com/checkout/post/submit";
        } else {
            $url = "https://test.cashfree.com/pgappsdemos/v3success.php?myorder={'$orderId'}";
        }
    } else {
        // Error occurred while creating the payment order
        logError("Error creating payment order: " . $conn->error);
        echo "Error processing payment. Please try again later.";
        exit();
    }
} else {
    // Invalid request method
    logError("Invalid request method: " . $_SERVER["REQUEST_METHOD"]);
    echo "Invalid request. Please try again later.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cashfree - Signature Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="document.frm1.submit()">

<form action="<?php echo $url; ?>" name="frm1" method="post">
    <p>Please wait.......</p>
    <input type="text" name="signature" value='<?php echo $signature; ?>'/>
    <input type="text" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
    <input type="text" name="courseID" value='<?php echo $courseID; ?>'/>
    <input type="text" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
    <input type="text" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
    <input type="text" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
    <input type="text" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
    <input type="text" name="appId" value='<?php echo $appId; ?>'/>
    <input type="text" name="orderId" value='<?php echo $orderId; ?>'/>
</form>

</body>
</html>
