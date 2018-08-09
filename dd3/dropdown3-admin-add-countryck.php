<?Php
//require "config.php"; // connection details
require "config.php"; // Database Connection 


error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$country_code=$_POST['country_code']; /// Country code
$country=$_POST['country'];
//$country_code='IND';
//$state='test state';
///////////// Validate the inputs ////////////
// Checking country variable ///

/////////// end of input validation //////
$db_status='OK';

if(strlen($country_code) > 0 and strlen($country)>0){
$sql=$dbo->prepare("insert into plus2_country (country,country_code) values(:country,:country_code)");
$sql->bindParam(':country',$country,PDO::PARAM_STR,25);
$sql->bindParam(':country_code',$country_code,PDO::PARAM_STR,4);
if($sql->execute()){

$state_id=$dbo->lastInsertId(); 
$msg= " Country  Added : $country : code = $country_code ";
}
else{
$msg = " Database Problem  Not able to add data please contact Admin ";
$db_status='NOTOK';
}

}else{
$msg=" Enter  Country and Country Code";
$db_status='NOTOK';
}

$main = array('db_status'=>$db_status,'msg'=>$msg);


echo json_encode($main); 


//echo $msg;
////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>