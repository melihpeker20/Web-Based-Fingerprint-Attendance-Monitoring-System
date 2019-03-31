<?php

include('../functions.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

require_once "../config/config.php"; 
include "header.php";


$userid = $companyid = $lastname = $firstname = $middlename =
$sex = $civilstatus = $birthday = $birthplace = $address = $mobilenumber =
$emergencycontactperson =$emergencycontactnumber = $position =
$department = $collegeunit = "";

$useriderr = $companyiderr = $lastnameerr = $firstnameerr = $middlenameerr =
$sexerr = $civilstatuserr = $birthdayerr = $birthplaceerr = $addresserr = $mobilenumbererr =
$emergencycontactpersonerr =$emergencycontactnumbererr = $positionerr =
$departmenterr = $collegeuniterr = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    //userid
    $input_userid = trim($_POST["userid"]); 
    if(empty($input_userid)){
        $useriderr = "Please enter a userid.";
    } else{
        $userid = $input_userid;
    }
    //companyid
    $input_companyid = trim($_POST["companyid"]); 
    if(empty($input_companyid)){
        $companyiderr = "Please enter a companyid.";
    } else{
        $companyid = $input_companyid;
    }
    //lastname
    $input_lastname = trim($_POST["lastname"]);
    if(empty($input_lastname)){
        $lastnameerr = "Please enter a lastname.";
    } elseif(!filter_var($input_lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $lastnameerr = "Please enter a valid lastname.";
    } else{
        $lastname = $input_lastname;
    }
    //firstname
    $input_firstname = trim( $_POST["firstname"]);
    if(empty($input_firstname)){
        $firstnameerr = "Please enter a firstname.";
    } elseif(!filter_var($input_firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $firstnameerr = "Please enter a valid firstname.";
    } else{
        $firstname = $input_firstname;
    }
    //middlename
    $input_middlename = trim( $_POST["middlename"]);
    if(empty($input_lastname)){
        $middlenameerr = "Please enter a middlename.";
    } elseif(!filter_var($input_middlename, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $middlenameerr = "Please enter a valid middlename.";
    } else{
        $middlename = $input_middlename;
    }
    //sex
    $input_sex = trim($_POST["sex"]); 
    if(empty($input_sex)){
       $sexerr = "Please select an input.";
    } else{
        $sex = $input_sex;
    }
    //civil status
    $input_civilstatus= trim($_POST["civilstatus"]); 
    if(empty($input_civilstatus)){
        $civilstatuserr = "Please select an input.";
    } else{
        $civilstatus = $input_civilstatus;
    }
    //birthday
    $input_birthday = trim($_POST["birthday"]); 
    if(empty($input_birthday)){
        $birthdayerr = "Please enter a birthday.";
    } else{
        $birthday = $input_birthday;
    }
    //birthplace
    $input_birthplace = trim($_POST["birthplace"]); 
    if(empty($input_birthplace)){
        $birthplaceerr = "Please enter a birthplace.";
    } else{
        $birthplace = $input_birthplace;
    };
    //address
    $input_address = trim($_POST["address"]); 
    if(empty($input_address)){
        $addresserr = "Please enter a address.";
    } else{
        $address = $input_address;
    }
    //mobilenumber
    $input_mobilenumber = trim($_POST["mobilenumber"]); 
    if(empty($input_mobilenumber)){
        $mobilenumbererr = "Please enter a mobile number.";
    } else{
        $mobilenumber = $input_mobilenumber;
    }
    //emergencycontactperson
    $input_emergencycontactperson = trim($_POST["emergencycontactperson"]); 
    if(empty($input_emergencycontactperson)){
        $emergencycontactpersonerr = "Please enter a emergency contact person.";
    } else{
        $emergencycontactperson = $input_emergencycontactperson;
    }
    //emergencycontactnumber
    $input_emergencycontactnumber = trim($_POST["emergencycontactnumber"]); 
    if(empty($input_emergencycontactnumber)){
        $emergencycontactnumbererr = "Please enter a emergency contact number.";
    } else{
        $emergencycontactnumber = $input_emergencycontactnumber;
    }
    //position
    $input_position = trim($_POST["position"]); 
    if(empty($input_position)){
        $positionerr = "Please enter a position.";
    } else{
        $position = $input_position;
    }
    //department
    $input_department = trim($_POST["department"]); 
    if(empty($input_department)){
        $departmenterr = "Please select a department.";
    } else{
        $department = $input_department;
    }
    //college
    $input_collegeunit = trim($_POST["collegeunit"]); 
    if(empty($input_collegeunit)){
        $collegeuniterr = "Please select a college/unit.";
    } else{
        $collegeunit = $input_collegeunit;
    }

    if(empty($useriderr) && empty($companyiderr) && empty($lastnameerr) && empty($firstnameerr) && empty($middlenameerr)
    && empty($sexerr) && empty($civilstatuserr) && empty($birthdayerr) && empty($birthplaceerr) && empty($addresserr)
    && empty($mobilenumbererr) && empty($emergencycontactpersonerr) && empty($emergencycontactnumbererr) && empty($positionerr) 
    && empty($departmenterr) && empty($collegeuniterr)){
        $sql = "UPDATE employee SET userid=?, companyid=?, lastname=?, firstname=?, middlename=?, 
        sex=?, civilstatus=?, birthday=?, birthplace=?, address=?, mobilenumber=?, 
        emergencycontactperson=?, emergencycontactnumber=?, position=?,
        department=?, collegeunit=? WHERE userid=?";
    if($stmt = $db->prepare($sql)){
        $stmt->bind_param("isssssssssssssssi",$param_userid,$param_companyid,$param_lastname,$param_firstname,$param_middlename,
                                $param_sex,$param_civilstatus,$param_birthday,
                                $param_birthplace,$param_address,$param_mobilenumber,$param_emergencycontactperson,
                                $param_emergencycontactnumber,$param_position,$param_department,$param_collegeunit, $param_id);

                                $param_lastname = $lastname;
                                $param_firstname = $firstname;
                                $param_middlename = $middlename;
                                $param_sex = $sex;
                                $param_civilstatus = $civilstatus;
                                $param_birthday = $birthday;
                                $param_birthplace = $birthplace;
                                $param_address = $address;
                                $param_mobilenumber = $mobilenumber;
                                $param_emergencycontactperson = $emergencycontactperson;
                                $param_emergencycontactnumber = $emergencycontactnumber; 
                                $param_userid = $userid;
                                $param_companyid = $companyid;
                                $param_position = $position;
                                $param_department = $department;
                                $param_collegeunit = $collegeunit; 
                                $param_id = $id;  
                                  
                                
                                if($stmt->execute()){
                                    // Records created successfully. Redirect to landing page
                                    header("location: employees_view.php");
                                    exit();
                                } else{
                                    echo "Something went wrong. Please try again later.";
                                }
                            }
                            $stmt->close(); 
    }
   $db->close(); 
} 
else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM employee WHERE userid = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i",$param_id);
            $param_id = $id;

            if($stmt->execute()){
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                $userid = $row["userid"];
                $companyid = $row["companyid"];
                $lastname = $row["lastname"];
                $firstname = $row["firstname"];
                $middlename = $row["middlename"];
                $sex = $row["sex"];
                $civilstatus = $row["civilstatus"];
                $birthday = $row["birthday"];
                $birthplace = $row["birthplace"];
                $address = $row["address"];
                $mobilenumber = $row["mobilenumber"];
                $emergencycontactperson = $row["emergencycontactperson"];
                $emergencycontactnumber = $row["emergencycontactnumber"];
                $position = $row["position"];
                $department = $row["department"];
                $collegeunit = $row["collegeunit"];
                }
                else{
                    header("location: error.php");
                    exit();   
                    }
            }
            else{ 
                echo "Oops! Something went wrong. Please try again later.";
                }
        }
        $stmt->close();
        $db->close();
    }
    else{
        header("location: error.php");
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .active, #employeelink{
        background-color: #ffffff;
        color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <img class="mb-4" src="../css/CLSU.png" alt="CLSU Logo" width="100" height="100">
                <h2>Update Record</h2>
                <p>Please edit the input values and submit to update the record.</p>    
            </div>        
            <div class="col-md-8"> 
                <h3>PERSONAL INFO</h3>
                <hr class="mb-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group <?php echo (!empty($lastnameerr)) ? 'has-error' : ''; ?>">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                                    <span class="help-block"><?php echo $lastnameerr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group <?php echo (!empty($firstnameerr)) ? 'has-error' : ''; ?>">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                                    <span class="help-block"><?php echo $firstnameerr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group <?php echo (!empty($middlenameerr)) ? 'has-error' : ''; ?>">
                                    <label>MI</label>
                                    <input type="text" name="middlename" class="form-control" value="<?php echo $middlename; ?>">
                                    <span class="help-block"><?php echo $middlenameerr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group <?php echo (!empty($sexerr)) ? 'has-error' : ''; ?>">
                                    <label for="sex">Sex</label>
                                    <select id="sex" name="sex" class="form-control" value="<?php echo $sex; ?>">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="help-block"><?php echo $sexerr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group <?php echo (!empty(civilstatuserr)) ? 'has-error' : ''; ?>">
                                    <label for="civilstatus">Civil Status</label>
                                    <select id="civilstatus" name="civilstatus" class="form-control" value="<?php echo $civilstatus; ?>">
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                    <span class="help-block"><?php echo $civilstatuserr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group <?php echo (!empty($birthdayerr)) ? 'has-error' : ''; ?>">
                                    <label>Birthday</label>
                                    <input type="date" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
                                    <span class="help-block"><?php echo $birthdayerr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group <?php echo (!empty($birthplaceerr)) ? 'has-error' : ''; ?>">
                                    <label>Birthplace</label>
                                    <input type="text" name="birthplace" class="form-control" value="<?php echo $birthplace; ?>">
                                    <span class="help-block"><?php echo $birthplaceerr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group <?php echo (!empty($addresserr)) ? 'has-error' : ''; ?>">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                                    <span class="help-block"><?php echo $addresserr;?></span>
                                </div>
                            </div>
                        
                            <div class="col-sm-4">
                                <div class="form-group <?php echo (!empty($mobilenumbererr)) ? 'has-error' : ''; ?>">
                                    <label>Mobile Number</label>
                                    <input type="tel" name="mobilenumber" class="form-control" value="<?php echo $mobilenumber; ?>" maxlength="11">
                                    <span class="help-block"><?php echo $mobilenumbererr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group <?php echo (!empty($emergencycontactpersonerr)) ? 'has-error' : ''; ?>">
                                    <label>Emergency Contact Person</label>
                                    <input type="text" name="emergencycontactperson" class="form-control" value="<?php echo $emergencycontactperson; ?>">
                                    <span class="help-block"><?php echo $emergencycontactpersonerr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group <?php echo (!empty($emergencycontactnumbererr)) ? 'has-error' : ''; ?>">
                                    <label>Emergency Contact Number</label>
                                    <input type="tel" name="emergencycontactnumber" class="form-control" value="<?php echo $emergencycontactnumber; ?>" maxlength="11" min="0">
                                    <span class="help-block"><?php echo $emergencycontactnumbererr;?></span>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-warning"  name="btnsubmit" value="Submit">
                        <a href="employees_view.php" class="btn btn-danger">Cancel</a>
                </div>
                <div class="col-md-4"> 
                    <h3>EMPLOYMENT INFO</h3>
                    <hr class="mb-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group <?php echo (!empty($useriderr)) ? 'has-error' : ''; ?>">
                                    <label>User ID</label>
                                    <input type="text" name="userid" class="form-control" value="<?php echo $userid; ?>">
                                    <span class="help-block"><?php echo $useriderr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group <?php echo (!empty($companyiderr)) ? 'has-error' : ''; ?>">
                                    <label>Company ID</label>
                                    <input type="text" name="companyid" class="form-control" value="<?php echo $companyid; ?>">
                                    <span class="help-block"><?php echo $companyiderr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group <?php echo (!empty($positionerr)) ? 'has-error' : ''; ?>">
                                <label>Position</label>
                                <input type="text" name="position" class="form-control" value="<?php echo $position; ?>">
                                <span class="help-block"><?php echo $positionerr;?></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group <?php echo (!empty($departmenterr)) ? 'has-error' : ''; ?>">
                                <label>Department</label>
                                <input type="text" name="department" class="form-control" value="<?php echo $department; ?>">
                                <span class="help-block"><?php echo $departmenterr;?></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group <?php echo (!empty($collegeuniterr)) ? 'has-error' : ''; ?>">
                                <label>College/Unit</label>
                                <input type="text" name="collegeunit" class="form-control" value="<?php echo $collegeunit; ?>">
                                <span class="help-block"><?php echo $collegeuniterr;?></span>
                            </div>
                        </div>
                        <hr class="mb-4">
                    </form>
                </div>
                </div>
        </div>
    </div>   
</body>
</html>
