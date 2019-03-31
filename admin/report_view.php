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
    <title>Report</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidenav.css">
    <style>
    .active, #reportlink{
        background-color: #ffffff;
        color: #000000;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="sidenav">
                <form action="getatt.php"  method="post">
                <input type="submit" id="getatt" class="btn btn-default" name="getatt" value="GET ATTENDANCE" >
                </form>
                <form action="ping.php"  method="post">
                <input type="submit" id="pingdev" class="btn btn-default" name="pingDev" value="PING DEVICE" >
                </form>
            </div>
        </div>
    
        <div class="row mt-5">
            <div class="col-md-6">
                <h2><span class="fa fa-database"></span>&nbsp;Report Directory</h2>
            </div>
            <div class="col-md-6">   
                <a href="addemp.php" class="btn btn-success pull-right">Add New Employee</a>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        require_once "../config/config.php"; 
                        $sql = "SELECT * FROM attendancelog";
                        if($result = $db->query($sql)){
                            if($result->num_rows > 0){
                                echo "<table class='table table-bordered table-striped table-hover'>";
                                    echo "<tr>";
                                        echo "<thead>";
                                            echo "<th>UserID</th>";
                                            echo "<th>Status</th>";
                                            echo "<th>Date</th>";
                                        echo "</thead>";
                                    echo "</tr>";
                                    echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['userid'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        

                                    /*    echo "<td>";
                                            //echo "<a href='reademp.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip'><span class='fa fa-eye'></span></a>";
                                            echo "<a href='updateemp.php?id=". $row['userid'] ."' title='Update Record' data-toggle='tooltip'><span class='fa fa-pencil'></span>&nbsp;</a>";
                                            echo "<a href='deleteemp.php?id=". $row['userid'] ."' title='Delete Record' data-toggle='tooltip'><span class='fa fa-trash'></span>&nbsp;</a>";
                                        echo "</td>"; */
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