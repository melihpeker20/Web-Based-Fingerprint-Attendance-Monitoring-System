<?php  

if(isset($_POST['getatt']))
{
    getatt();
    header("location: report_view.php");
}

function getatt()
{

    require "../zklib/zklib.php";
	
	$db = mysqli_connect("localhost", "root", "", "clsucampusbio") or die("Connection error");
    
    $sql = mysqli_query($db, "SELECT ipadd FROM devices");
    $devices = array();
	
    while($row = mysqli_fetch_assoc($sql))
    {
        array_push($devices, $row['ipadd']);
    }

    foreach($devices as $ip){
        $zk = new ZKLib($ip, 4370);
        $ret = $zk->connect();
       
        //get attendance logs
        $attendance = array();
        $attendance = $zk->getAttendance();
        $ret = $zk->disableDevice();

        foreach($attendance as $data){

                $idx = $data[0];
                $userid = $data[1];
                $date = $data[3];

                if($data[2] == 1 )
                    $status = 'Check Out';
                elseif($data[2] == 0)
                    $status = 'Check In';
                elseif($data[2] == 5)
                    $status = 'Overtime Out';
                else
                    $status = 'Overtime In'; 
                  
            // prepared here
            
            $sql1 = "INSERT INTO attendancelog (userid, status, date) 
                    SELECT * FROM (SELECT '".$userid."', '".$status."', '".date('Y-m-d H:i:s', strtotime($date))."') AS tmp 
                    WHERE NOT EXISTS 
                    (SELECT * FROM attendancelog WHERE userid='".$userid."' AND date='".date('Y-m-d H:i:s', strtotime($date))."') 
                    LIMIT 1; ";  

                if(mysqli_query($db, $sql1))
                {
					echo $sql1. "<br>";
                    //header("location: report_view.php");
           
                } 
                else
                {
					echo "Error on SQL: " . $db;
                    
                }
                 
        }            
        $ret = $zk->enableDevice();
        //$ret = $zk->clearAttendance();
        $ret = $zk->disconnect();
        
    }      
}
?>