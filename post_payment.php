<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

// include $_SERVER['DOCUMENT ROOT'].'init.php';
include_once('logon.php');

if($conn){
    // echo "Connected excellently \n\n";
}

$index_no = "Not Available";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    // Get data from the REST client
    $index_no = $_REQUEST['index_no'];
    $full_name = $_REQUEST['full_name'];
    $payment_date = $_REQUEST['payment_date'];
    $fee_type_code = $_REQUEST['fee_type_code'];
    $amount_paid = $_REQUEST['amount_paid'];
    $trans_ref = $_REQUEST['trans_ref'];
    $bank = $_REQUEST['bank'];

//    echo "$index_no \n";
//    echo "$full_name \n";
//    echo "$payment_date \n";
//    echo "$fee_type_code \n";
//    echo "$amount_paid \n";
//    echo "$trans_ref \n";

//    $sql_student = "SELECT AdmissionNo FROM students WHERE AdmissionNo='$index_no'";
//    $result_student = mysqli_query($conn, $sql_student);


    // Insert data into database
    if ($full_name == NULL or $payment_date == "0000-00-00"
        or $payment_date == NULL or $fee_type_code == NULL
        or $amount_paid == NULL or $trans_ref == NULL or $bank == NULL) {

        http_response_code(400);
        $error = 'One or more required values may be missing!';
        echo json_encode($error);
    }else {


        $sql = "INSERT INTO bankpaytest_OLD (AdmissionNo,
                                        StudentName,
                                        PostDate,
                                        PaymentType,
                                        AmtReceived,
                                        ReceiptNo,
                                        Bank)
                            VALUES ('$index_no', 
                                    '$full_name',
                                    '$payment_date', 
                                    '$fee_type_code',
                                    '$amount_paid',
                                    '$trans_ref',
                                    '$bank')";



        // test transaction
        $post_data_query = mysqli_query($conn, $sql);
        
        if ($post_data_query) {
            $json = array("status" => 1, "Success" => "Payments have been added successfully!");
        } else {
            $json = array("status" => 2, "Error" => "Error adding payment! Please try again!");
        }
    }
}
else{
    $json = array("status" => 0, "Info" => "Start transaction process!");
}




@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);

