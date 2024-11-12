
<?php

class Payer{

  // define properties
  public $name;
  public $email;
  public $password;
  
  public $index_no;
  public $full_name;
  public $payment_date;
  public $fee_type_code;
  public $amount_paid;
  public $trans_ref;
  public $bank;

  private $conn;
  private $users_tbl;
  private $payments_tbl;
  private $students_tbl;


  // constructor
  public function __construct($db){
    $this->conn = $db;
    $this->users_tbl = "tbl_users";
    $this->payments_tbl = "bankpaytest";
    $this->students_tbl = "students";
 }


  // to create projects
  public function pay(){

    // insert a single publisher
    $sql = "INSERT INTO $this->payments_tbl (AdmissionNo,
                                        StudentName,
                                        PostDate,
                                        PaymentType,
                                        AmtReceived,
                                        ReceiptNo,
                                        Bank)
                            VALUES ('$this->index_no', 
                                    '$this->full_name',
                                    '$this->payment_date', 
                                    '$this->fee_type_code',
                                    '$this->amount_paid',
                                    '$this->trans_ref',
                                    '$this->bank')";

    $statement = $this->conn->prepare($sql);

    if($statement->execute()){
      return true;
    }

    return false;

    }



// function to retrieve student
    public function get_student(){

    $project_query = "SELECT AdmissionNo,
                        FirstName,
                        SurName,
                        OtherNames,
                        Programme,
                        DepartmentName,
                        CountryofOrigin,
                        School 
        from $this->students_tbl WHERE AdmissionNo = '$this->index_no'";

    $project_obj = $this->conn->prepare($project_query);

    $project_obj->execute();

    return $project_obj->get_result();

  }
  
  
// function to retrieve payment
    public function get_payment(){

    $project_query = "SELECT AdmissionNo,
                        StudentName,
                        PostDate,
                        PaymentType,
                        AmtReceived,
                        ReceiptNo,
                        Bank
        from $this->payments_tbl WHERE AdmissionNo = '$this->index_no'AND ReceiptNo = '$this->trans_ref'";

    $project_obj = $this->conn->prepare($project_query);

    $project_obj->execute();

    return $project_obj->get_result();

  }
  

}