<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link rel="icon" href="../css/favicon.ico" type="image/x-icon">
</head>
<body>

  <nav class="navbar navbar-expand-sm bg-success navbar-dark">
  <a class="navbar-brand" href="home.php">CLSU BIOMET</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="homelink" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="employeelink" href="employees_view.php">Employee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="biometriclink" href="biometrics_view.php">Device</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="userlink" href="users_view.php">User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="reportlink" href="report_view.php">Report</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
    <li>
      <div class="profile_info">
        <div><span class='fa fa-user'>
          <?php  if (isset($_SESSION['user'])) : ?>
            <strong style="color: #ffffff;"><?php echo $_SESSION['user']['username']; ?></strong>

            <strong>
              <strong  style="color: #ffffff;">(<?php echo ucfirst($_SESSION['user']['usertype']); ?>)</strong> 
              <br>
              <a class="btn btn-danger btn-sm float-right my-1" href="home.php?logout='1'">Logout</a>
            </strong>
          <?php endif ?>
        </div>
      </div>
    </li>
    </ul>
  </nav>

  <script type="text/javascript">
          $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();   
          });
  </script>

