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

$devid = $ipadd = $subnet = $gateway = $location = $description = $active = "";
$deviderr = $ipadderr = $subneterr = $gatewayerr = $locationerr = $descriptionerr = $activeerr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //devid
    $input_devid = trim($_POST["devid"]); 
    if(empty($input_devid)){
        $deviderr = "Please enter a device ID.";
    } else{
        $devid = $input_devid;
    }
     //ipaddress
     $input_ipadd = trim($_POST["ipadd"]); 
     if(empty($input_ipadd)){
         $ipadderr = "Please enter an IP Address.";
     }
    else{
         $ipadd = $input_ipadd;
     }
      //subnetmask
    $input_subnet = trim($_POST["subnet"]); 
    if(empty($input_subnet)){
        $subneterr = "Please enter a Subnet Mask.";
     }
     else{
        $subnet = $input_subnet;
    }
     //gatewayaddress
     $input_gateway = trim($_POST["gateway"]); 
     if(empty($input_gateway)){
         $gatewayerr = "Please enter a Gateway Address.";
     }
     else{
         $gateway = $input_gateway;
     }
      //location
    $input_location = trim($_POST["location"]); 
    if(empty($input_location)){
        $locationerr = "Please enter a Location.";
    } else{
        $location = $input_location;
    }
     //description
     $input_description = trim($_POST["description"]); 
     if(empty($input_description)){
         $descriptionerr = "Please enter a Description.";
     } else{
         $description = $input_description;
     }
      //status
    $input_active = trim($_POST["active"]); 
    if(empty($input_active)){
        $activeerr = "Please choose active.";
    } else{
        $active = $input_active;
    }


    if(empty($deviderr) && empty($ipadderr) && empty($subneterr) && empty($gatewayerr) && empty($locationerr) 
        && empty($descriptionerr) && empty($statuserr)){
        $sql = "INSERT INTO devices (devid, ipadd, subnet, gateway, location, description, active) 
        VALUES (?,?,?,?,?,?,?)";

        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("issssss", $param_devid, $param_ipadd, $param_subnet, $param_gateway, $param_location
            , $param_description, $param_active);

                $param_devid = $devid;
                $param_ipadd = $ipadd;
                $param_subnet = $subnet;
                $param_gateway = $gateway;
                $param_location = $location;
                $param_description = $description;
                $param_active = $active;

                if($stmt->execute()){
                    // Records created successfully. Redirect to landing page
                    header("location: biometrics_view.php");
                    exit();
                } else{
                    echo "Duplicated ID. Something went wrong. Please try again later.";
                }
            }
            $stmt->close();
            
}
$db->close();       
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Device Record</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .active, #biometriclink{
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
                <h2>Device Record</h2>
                <p>Please fill this form and submit to add device record.</p>
            </div>
            <div class="col-md-12"> 
                <h3>DEVICE INFO</h3>
                <hr class="mb-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row"> 
                            <div class="col-sm-2">
                                <div class="form-group <?php echo (!empty($deviderr)) ? 'has-error' : ''; ?>">
                                    <label>Device ID</label>
                                    <input maxlength="5" type="text" name="devid" class="form-control" value="<?php echo $devid; ?>">
                                    <span class="help-block"><?php echo $deviderr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group <?php echo (!empty($ipadderr)) ? 'has-error' : ''; ?>">
                                    <label>IP Addres</label>
                                    <input maxlength="15" type="text" name="ipadd" class="form-control" value="<?php echo $ipadd; ?>">
                                    <span class="help-block"><?php echo $ipadderr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group <?php echo (!empty($subneterr)) ? 'has-error' : ''; ?>">
                                    <label>Subnet Mask</label>
                                    <input maxlength="15" type="text" name="subnet" class="form-control" value="<?php echo $subnet; ?>">
                                    <span class="help-block"><?php echo $subneterr;?></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group <?php echo (!empty($gatewayerr)) ? 'has-error' : ''; ?>">
                                    <label>Gateway IP Address</label>
                                    <input maxlength="15" type="text" name="gateway" class="form-control" value="<?php echo $gateway; ?>">
                                    <span class="help-block"><?php echo $gatewayerr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group <?php echo (!empty($locationerr)) ? 'has-error' : ''; ?>">
                                <label>Location</label>
                                <input maxlength="30" type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                                <span class="help-block"><?php echo $locationerr;?></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group <?php echo (!empty($descriptionerr)) ? 'has-error' : ''; ?>">
                                <label>Description</label>
                                <input maxlength="30" type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                                <span class="help-block"><?php echo $descriptionerr;?></span>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group <?php echo (!empty($activeerr)) ? 'has-error' : ''; ?>">
                                <label for="active">Active</label>
                                <select id="active" name="active" class="form-control" value="<?php echo $active; ?>">
                                    <option>Choose</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <span class="help-block"><?php echo $activeerr;?></span>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <input type="submit" class="btn btn-warning"  name="btnsubmit" value="Submit">
                        <a href="biometrics_view.php" class="btn btn-danger">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>