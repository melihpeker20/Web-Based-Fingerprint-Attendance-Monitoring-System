<?php  

if(isset($_POST['sync']))
{
    synctime();
}

function synctime()
{
    require "zklib/zklib.php";

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
        $zk->disableDevice();
        
        date_default_timezone_set("Asia/Brunei");

            
        //    $info = $zk->getTime(); //date("Y-m-d H:i:s");
        //    print_r($info);
        /*    
            $day = $info['mday'];
            $month = $info['mon'];
            $year = $info['year'];
            $hour = $info['hours'];
            $minute = $info['minutes'];
            $second = $info['seconds'];
        */
        //$d = ( ($t->year % 100) * 12 * 31 + (($t->month - 1) * 31) + $t->day - 1) *
        //     (24 * 60 * 60) + ($t->hour * 60 + $t->minute) * 60 + $t->second;
       
       $currdate = date("Y-m-d H:i:s");

        $zk->setTime($currdate);
        //echo $currdate;

        $ret = $zk->enableDevice();
        $ret = $zk->disconnect();
    }
}
?>
