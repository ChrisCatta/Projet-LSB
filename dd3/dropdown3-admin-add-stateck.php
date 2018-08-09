<?Php
require "config.php"; // connection details
//require "../../include/z_db1_demo.php"; // Database Connection 


error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$country_code=$_POST['country_code']; /// Country code
$state=$_POST['state'];
//$country_code='IND';
//$state='test state';
///////////// Validate the inputs ////////////
// Checking country variable ///

/////////// end of input validation //////

if(strlen($country_code) > 0 and strlen($state)>0){
$sql=$dbo->prepare("insert into plus2_state (state,country_code) values(:state,:country_code)");
$sql->bindParam(':state',$state,PDO::PARAM_STR,25);
$sql->bindParam(':country_code',$country_code,PDO::PARAM_STR,4);
if($sql->execute()){
$state_id=$dbo->lastInsertId(); 
$msg= " State   Added : $state : State_id = $state_id";
}
else{
$msg = " Database Problem  Not able to add data please contact Admin ";
}

}else{
$msg=" Select   Country and enter state name";
}
echo $msg;
////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>