<?php  

if(isset($_POST['pingDev']))
{
    pingDev();
    header("location: report_view.php");
}


function pingDev()
{
	
	$db = mysqli_connect("localhost", "root", "", "clsucampusbio") or die("Connection error");
    
    $sql = mysqli_query($db, "SELECT ipadd FROM devices");
    $devices = array();
	
    while($row = mysqli_fetch_assoc($sql))
    {
        array_push($devices, $row['ipadd']);
    }

    foreach($devices as $ip){

        exec("ping -n 4 $ip", $output, $status); 

        echo "<pre>";
        print_r($output);
        echo "</pre>";

        if ($status == 0){

            $pingstat = "Ping successful!";}

        else{

            $pingstat = "Ping unsuccessful!";}
    }      

}
?>