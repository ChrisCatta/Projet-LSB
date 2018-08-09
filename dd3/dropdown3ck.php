<?Php
require "config.php"; // connection details
//require "../../include/z_db1_demo.php"; // Database Connection 


error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$country_code=$_POST['country_code'];// 
$state_id=$_POST['state_id']; /// State Id 
//$country_code='CAN'; // To check you can use this
//$state_id=5;
///////////// Validate the inputs ////////////
// Checking country variable ///
if((strlen($country_code)) > 0 and (!ctype_alpha($country_code))){ 
echo "Data Error";
exit;
}
// Checking state variable (with space ) ///

if ((strlen($state_id)) > 0 and is_numeric($state_id) === false) {
echo "Data Error";
exit;
}

/////////// end of input validation //////

if(strlen($country_code) > 0){
$q_country="select state,state_id from plus2_state where country_code = :country_code";
}

//echo $q_country;
$sth = $dbo->prepare($q_country);
$sth->bindParam(':country_code',$country_code,PDO::PARAM_STR, 15);
$sth->execute();
$state = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r($state);
$q_state="select city_id,city from plus2_city where ";
if(strlen($state_id) > 0){
$q_state= $q_state . " state_id = :state_id ";
}
$sth = $dbo->prepare($q_state);
$sth->bindParam(':state_id',$state_id,PDO::PARAM_STR, 25);

$sth->execute();
$city = $sth->fetchAll(PDO::FETCH_ASSOC);

$main = array('state'=>$state,'city'=>$city,'value'=>array("state1"=>"$state1","city1"=>"$city1"));


echo json_encode($main); 

////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>