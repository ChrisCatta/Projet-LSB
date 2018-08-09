<?Php
require "config.php"; // connection details


error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$state_id=$_POST['state_id']; /// State Id 
$city=$_POST['city'];
//$state_id=5;
//$city='test city';
///////////// Validate the inputs ////////////
// Checking country variable ///

if(!is_numeric($state_id)){
echo "Data Error";
exit;
}
/////////// end of input validation //////

if(strlen($state_id) > 0 and strlen($city) > 1){
$sql=$dbo->prepare("insert into plus2_city (city,state_id) values(:city,:state_id)");
$sql->bindParam(':city',$city,PDO::PARAM_STR,25);
$sql->bindParam(':state_id',$state_id,PDO::PARAM_INT,4);
if($sql->execute()){
$city_id=$dbo->lastInsertId(); 
$msg= " City Added : $city : id = $city_id ";
}
else{
$msg = " Database Problem  Not able to add data please contact Admin ";
}
}else{
$msg=" Enter all details ";
}
echo $msg;

////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>