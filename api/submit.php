<?php
include "../config/config.php";

$dbHost = mysqlInfo('host', $candyConfig);
$dbUser = mysqlInfo('user', $candyConfig);
$dbPasswd = mysqlInfo('pass', $candyConfig);
$dbName = mysqlInfo('name', $candyConfig);
$dbPort = mysqlInfo('port', $candyConfig);
$dbPrefix = mysqlInfo('prefix', $candyConfig);

$con = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$content = isset($_POST["content"]) ? $_POST["content"] : 'EMPTY';

$date = time();

$dbCandy = $dbPrefix.'candies';

$sqlquery = "INSERT INTO  ".$dbCandy." (`content`) VALUES ('".base64_encode($content)."');";

$result = mysqli_query($con, $sqlquery);

$lowerid = mysqli_insert_id($con);

mysqli_close($con);



$result = array('code'=>0 ,"candy_id" => $lowerid);

echo json_encode($result);

?>