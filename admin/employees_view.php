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
    <title>Employee - Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="../css/font-awesome/font-awesome.min.css">  
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
        <div class="row mt-5">
            <div class="col-md-12">
                <h2><span class="fa fa-users"></span>&nbsp;Employee Directory</h2>
            </div>
            <div class="col-md-12">   
                <a href="addemp.php" class="btn btn-success pull-right">Add New Employee</a>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        require_once "../config/config.php"; 
                        $sql = "SELECT * FROM employee";
                        if($result = $db->query($sql)){
                            if($result->num_rows > 0){
                                echo "<table class='table table-bordered table-striped table-hover'>";
                                    echo "<tr>";
                                        echo "<thead>";
                                            echo "<th>UserID</th>";
                                            echo "<th>CompanyID</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Firstname</th>";
                                            echo "<th>MI</th>";
                                            echo "<th>Position</th>"; 
                                            echo "<th>Department</th>";
                                            echo "<th>College/Unit</th>";
                                            echo "<th>Actions</th>";
                                        echo "</thead>";
                                    echo "</tr>";
                                    echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['userid'] . "</td>";
                                        echo "<td>" . $row['companyid'] . "</td>";
                                        echo "<td>" . $row['lastname'] .", &nbsp" .$row['firstname'] . "&nbsp". $row['middlename'] ."</td>";
                                        
                                        echo "<td>" . $row['middlename'] . "</td>";
                                        echo "<td>" . $row['position'] . "</td>"; 
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['collegeunit'] . "</td>";

                                        echo "<td>";
                                            //echo "<a href='reademp.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye'></span></a>";
                                            echo "<a href='updateemp.php?id=". $row['userid'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span>&nbsp;</a>";
                                            echo "<a href='deleteemp.php?id=". $row['userid'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span>&nbsp;</a>";
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
    </div>
        <script type="text/javascript">
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>   
</body>
</html>
