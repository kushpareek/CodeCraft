<?php
include('./dbConnection.php');
$key = '56ee5c6d-03cf-459f-9b8c-50dfe7b74eb1'; // KEY
$key_index = 1; // KEY_INDEX

$response = $_POST; // FETCH DATA FROM DEFINE METHOD, IN THIS EXAMPLE I AM DEFINING POST WHILE I AM SENDING REQUEST

$final_x_header = hash("sha256", "/pg/v1/status/" . $response['merchantId'] . "/" . $response['transactionId'] . $key) . "###" . $key_index;

$url = "https://api.phonepe.com/apis/hermes/pg/v1/status/".$response['merchantId']."/".$response['transactionId']; // <TESTING URL>

$headers = array(
    "Content-Type: application/json",
    "accept: application/json",
    "X-VERIFY: " . $final_x_header,
    "X-MERCHANT-ID:". $response['merchantId']
);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);

curl_close($curl);

$responsePayment = json_decode($resp, true);
$orderId = $responsePayment['data']['merchantTransactionId'];
$successs = $responsePayment['success'];
if($successs){
$sql = "UPDATE `courseorder` SET `status` = 'success' WHERE `courseorder`.`order_id` = '$orderId';";
}
if ($conn->query($sql)) {

    $sql = "SELECT co.order_id, co.amount, co.stu_email, co.course_id, c.course_name, c.course_desc, c.course_price FROM courseorder co INNER JOIN course c ON co.course_id = c.course_id WHERE co.order_id = '$orderId'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dateTime = date("Y-m-d H:i:s");

    // Output the bill information in a vertical table format
    echo '<h2 style="text-align: center;">Invoice</h2>';
    echo '<table style="width: 50%; margin: 0 auto; border-collapse: collapse; margin-bottom: 20px;">';
    echo '<tr style="background-color: #f2f2f2;"><th style="padding: 10px; border: 1px solid #ddd;">Details</th><th style="padding: 10px; border: 1px solid #ddd;">Information</th></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Order ID</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['order_id'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">User Email</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['stu_email'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Course Name</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['course_name'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Course Description</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['course_desc'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Course Price</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['course_price'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Amount Paid</td><td style="padding: 10px; border: 1px solid #ddd;">' . $row['amount'] . '</td></tr>';
    echo '<tr><td style="padding: 10px; border: 1px solid #ddd;">Date & Time</td><td style="padding: 10px; border: 1px solid #ddd;">' . $dateTime . '</td></tr>';
    echo '</table>';

    // Add a download invoice button
    echo '<div style="text-align: center; margin-bottom: 20px;">
            <form method="post" action="download_invoice.php">
                <input type="hidden" name="orderId" value="' . $row['order_id'] . '">
                <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Download Invoice</button>
            </form>
            <a href= "./Student/myCourse.php"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Go to my courses</button></a>
        </div>';
} else {
    echo '<p style="text-align: center; color: red; font-size: 18px;">No data found for the provided Order ID and Course ID.</p>';
}

// echo '<pre>';
// print_r($responsePayment);
// echo '</pre>';
}