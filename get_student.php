<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

// include $_SERVER['DOCUMENT ROOT'].'init.php';
include_once('logon.php');

if($conn){
    // echo "Connected excellently \n\n";
}

if($_SERVER['REQUEST_METHOD'] == "GET"){

    // Get data from the REST client
    $index_no = $_GET['index_no'];


    // Insert data into database
    $sql = "SELECT AdmissionNo,
                    FirstName,
                    SurName,
                    OtherNames,
                    Programme,
                    DepartmentName,
					CountryofOrigin,
                    School
            FROM students 
            WHERE AdmissionNo='$index_no'";

    $result = mysqli_query($conn,$sql);


    // test transaction
    //$post_data_query = mysql_query($sql, $conn);
    $data = array();

    if($result){
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
                echo json_encode($data);
            }
        }else{
                $json = array("status" => 1, "Empty" => "No records found!");
                echo json_encode($json);
            }
        }
    else{
        $json = array("status" => 2, "Error" => "Error retrieving payments! Please try again!");
        echo json_encode($json);
    }
}
else{
    $json = array("status" => 0, "Info" => "Start transaction process!");
}

// Set Content-type to JSON
header('Content-type: application/json');
return json_encode($json);


@mysql_close($conn);