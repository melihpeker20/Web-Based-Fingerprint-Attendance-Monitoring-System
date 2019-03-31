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
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="../css/table.css">  
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
    .active, #userlink{
        background-color: #ffffff;
        color: #000000;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h2><span class="fa fa-users"></span>&nbsp;User Directory</h2>
            </div>
            <div class="col-md-6">   
                <a href="adduser.php" class="btn btn-success pull-right">Add New User</a>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php 
                        require_once "../config/config.php"; 
                        $sql = "SELECT * FROM users";
                        if($result = $db->query($sql)){
                            if($result->num_rows > 0){
                                echo "<table class='table table-bordered table-striped table-hover'>";
                                    echo "<tr>";
                                        echo "<thead>";
                                            
                                            echo "<th style='min-width: 400px;'>Username</th>";
                                            echo "<th style='min-width: 400px;'>Usertype</th>";
                                            echo "<th style='min-width: 325px;'>Actions</th>";
                                        echo "</thead>";
                                    echo "</tr>";
                                    echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['usertype'] . "</td>";

                                        echo "<td>";
                                            //echo "<a href='reademp.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye'></span></a>";
                                            //echo "<a href='updateuser.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span>&nbsp;</a>";
                                            echo "<a href='deleteuser.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span>&nbsp;</a>";
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
            <script type="text/javascript">
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>  
        </div>
    </div>
</body>
</html>

