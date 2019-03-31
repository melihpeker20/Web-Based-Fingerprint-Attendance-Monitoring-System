<?php
include "../functions.php";
include "header.php";
include "footer.php";

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Device</title>
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
        <div class="row mt-5">
            <div class="col">
                <h2><span class="fa fa-desktop"></span>&nbsp;Device Directory</h2>
            </div>
            <div class="col">
                <a href="adddev.php" class="btn btn-success pull-right">Add New Device</a>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <?php  
                    require_once "../config/config.php"; 
                    $sql = "SELECT * FROM devices";
                    if($result = $db->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped table-hover'>";
                                echo "<tr>";
                                    echo "<thead>";
                                        echo "<th class='col-xs-1'>Device ID</th>";
                                        echo "<th>IP Address</th>";
                                        echo "<th>Location</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Active</th>";
                                        echo "<th>Actions</th>";
                                    echo "</thead>";
                                echo "</tr>";
                                echo "<tbody>";
                            while($row = $result->fetch_array()){
                                echo "<tr>";
                                    echo "<td class='col-xs-1'>" . $row['devid'] . "</td>";
                                    echo "<td>" . $row['ipadd'] . "</td>";
                                    echo "<td>" . $row['location'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>" . $row['active'] . "</td>";

                                    echo "<td>";
                                        echo "<a href='updatedev.php?id=". $row['devid'] ."' title='Update Device' data-toggle='tooltip'><span class='fa fa-gears'></span>&nbsp;</a>";
                                        echo "<a href='deletedev.php?id=". $row['devid'] ."' title='Delete Device' data-toggle='tooltip'><span class='fa fa-trash'></span>&nbsp;</a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                            echo "</table>";
                            
                            // Free result set
                            $result->free();
                        } else{
                            echo "No records matching your query were found.";
                            }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $db->error;
                        }
                    
                    // Close connection
                    $db->close();
                    ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
         $(document).ready(function(){
             $('[data-toggle="tooltip"]').tooltip();   
         });
    </script>
</body>

</html>
