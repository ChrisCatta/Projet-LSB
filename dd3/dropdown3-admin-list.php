<?Php
session_start();
$tracking_page_name="JQ_Dropdown_three_demo";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of listing of Country, State and City by joining three tables with delete option</title>
<META NAME=\"DESCRIPTION\" CONTENT=\"Listing of linked records from three database tables with delete options ( Country, state , city )\">
<META NAME=\"KEYWORDS\" CONTENT=\"Demo listing of Country state city, listing of three linked tables, deleting of records, multiple table delete record\">

";
require "head.php";

echo "</head><body>";
require "config.php"; // Database Connection 
$top_links="<a href=../dropdown-list-three.php>Three Dropdown list </a>";

  
$todo=$_GET['todo'];
switch ($todo)
{
case "delete_country":
$country_code=$_GET['country_code'];
$count=$dbo->prepare("DELETE  FROM plus2_country,plus2_state,plus2_city USING plus2_state INNER JOIN plus2_city INNER JOIN plus2_country WHERE plus2_country.country_code=plus2_state.country_code AND plus2_state.state_id=plus2_city.state_id AND  plus2_country.country_code=:country_code");
$count->bindParam(":country_code",$country_code,PDO::PARAM_STR,4);
$count->execute();
break;

case "delete_state":
$state_id=$_GET['state_id'];
$count=$dbo->prepare("delete from plus2_state,plus2_city using plus2_state inner join plus2_city where plus2_state.state_id=plus2_city.state_id and plus2_state.state_id=:state_id");
$count->bindParam(":state_id",$state_id,PDO::PARAM_INT);
$count->execute();
break;


case "delete_city":
$city_id=$_GET['city_id'];
$count=$dbo->prepare("DELETE FROM plus2_city  WHERE city_id=:city_id");
$count->bindParam(":city_id",$city_id,PDO::PARAM_INT);
$count->execute();
break;

}

echo "<div id='body_content' itemscope itemtype=\"http://schema.org/TechArticle\" class='row'>

<div class='col-md-11 col-md-offset-1'>
<h1 itemprop=\"headline\">List of records by joining three tables( Country , State, City )</h1>";
require "dropdown3-link.php";
echo "<div class='row'><div class='col-md-12'>";
$sql="select plus2_country.country_code,country,plus2_state.state_id,plus2_state.state,city_id,city from plus2_city,plus2_state,plus2_country where plus2_city.state_id=plus2_state.state_id and plus2_state.country_code=plus2_country.country_code";

echo "<table class='table table-striped'>
 <tr class='info'><th>CODE</th><th>COUNTRY</th><th>Del</th><th>STATE _ID</th><th>STATE</th><th>Del</th><th>CITY_ID</th><th>CITY</th><th>Del</th></tr>";
foreach ($dbo->query($sql) as $row) {
echo "<tr><td>$row[country_code]</td><td>$row[country]</td><td> <a href=dropdown3-admin-list.php?todo=delete_country&country_code=$row[country_code]> X </a> </td><td>$row[state_id]</td><td>$row[state]</td>
<td><a href=dropdown3-admin-list.php?todo=delete_state&state_id=$row[state_id]> X </a> </td>
<td>$row[city_id]</td><td>$row[city]</td>
<td> <a href=dropdown3-admin-list.php?todo=delete_city&city_id=$row[city_id]> X </a> </td>
</tr>";
}
echo "</table>";
echo "</div></div>";
?>


<?Php
require "footer.php";
?>
</body>
</html>
