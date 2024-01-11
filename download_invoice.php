<?php
if (isset($_POST['orderId'])) {
    require('./fpdf/fpdf.php'); // Include the FPDF library
    include('./dbConnection.php'); // Include your database connection

    // Retrieve data from the database based on the order ID
    $orderId = $_POST['orderId'];

    // Fetch data from the database
    $sql = "SELECT co.order_id, co.amount, co.stu_email, co.course_id, c.course_name, c.course_desc, c.course_price FROM courseorder co INNER JOIN course c ON co.course_id = c.course_id WHERE co.order_id = '$orderId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dateTime = date("Y-m-d H:i:s");

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();

        // Add a professional background color
        $pdf->SetFillColor(230, 230, 230); // Light gray
        $pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F');

        // Add the company logo at the top center
        $pdf->Image('image/LOGO1.png', 50, 10, 100, 0); // Replace 'path/to/company_logo.png' with the actual path to your company logo image

        // Add a header
        $pdf->SetFont("Arial", "B", 18);
$pdf->SetTextColor(0, 0, 0); // Set text color to black
$pdf->Cell(0, 20, "", 0, 1); // Add an empty cell with a height of 10 to create a top margin
$pdf->Cell(0, 40, "Invoice", 0, 1, "C");

        // Create a table structure for the invoice
        $pdf->SetTextColor(0, 0, 0); // Set text color to black
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(80, 20, "Details", 1, 0, 'C');
        $pdf->Cell(110, 20, "Information", 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 20, "Order ID", 1, 0, 'L');
        $pdf->Cell(110, 20, $row['order_id'], 1, 1, 'L');

        $pdf->Cell(80, 20, "User Email", 1, 0, 'L');
        $pdf->Cell(110, 20, $row['stu_email'], 1, 1, 'L');

        $pdf->Cell(80, 20, "Course Name", 1, 0, 'L');
        $pdf->Cell(110, 20, $row['course_name'], 1, 1, 'L');

        // $pdf->Cell(80, 20, "Course Description", 1, 0, 'L');
        // $pdf->MultiCell(110, 5, $row['course_desc'], 1, 'L'); // Use MultiCell for Course Description

        $pdf->Cell(80, 20, "Course Price", 1, 0, 'L');
        $pdf->Cell(110, 20, $row['course_price'], 1, 1, 'L');

        $pdf->Cell(80, 20, "Amount Paid", 1, 0, 'L');
        $pdf->Cell(110, 20, $row['amount'], 1, 1, 'L');

        $pdf->Cell(80, 20, "Date & Time", 1, 0, 'L');
        $pdf->Cell(110, 20, $dateTime, 1, 1, 'L');
        $pdf->Cell(0, 20, "Note: This is a computer-generated invoice. Please keep this for your records.", 0, 1, "C");

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->MultiCell(0, 10, "Refund Policy: A refund will be issued only if the course is not added to your profile or if the course classes are cancelled by CodeCraft. All refunds will be sent to the original payment source.", 0, 1, "C");
        $pdf->Cell(0, 10, "Terms & Conditions: Please note that all courses are non-transferable and must be used by the account holder.", 0, 1, "C");
        
        // Output the PDF as a file for download
        $pdf->Output('D', 'Invoice_' . $orderId . '.pdf');
    } else {
        echo "No data found for the provided Order ID.";
    }
} else {
    echo "Invalid request.";
}
?>
