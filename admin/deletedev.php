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
include "header.php";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    require_once "../config/config.php";

    $sql = "DELETE FROM devices WHERE devid = ?";

    if($stmt = $db->prepare($sql)){
        $stmt->bind_param("i", $param_devid);

        $param_devid = trim($_POST["id"]);

        if($stmt->execute()){
            header("location: biometrics_view.php");
            exit();
        }
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    $stmt->close();
    $db->close();
}
else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Record</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                <h2>Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger" role="alert">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <h4 class="alert-heading">Are you sure you want to delete this record?</h4><br>
                        </div>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="biometrics_view.php" class="btn btn-warning">No</a>
                            </p>
                    </form>
            </div>
        </div>        
    </div>
</body>
</html>