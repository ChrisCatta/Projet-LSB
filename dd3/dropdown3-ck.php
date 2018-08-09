<?Php
session_start();
$tracking_page_name="JQ_Dropdown_three_demo-ck";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of  three interlinked drop down listbox using jquery </title>
<META NAME=\"DESCRIPTION\" CONTENT=\"\">
<META NAME=\"KEYWORDS\" CONTENT=\"\">

";
require "head.php";

echo "</head><body>";
require "config.php"; // Database Connection 
$top_links="<a href=../effects.php>Effects</a>";

  
echo "<div id='body_content' itemscope itemtype=\"http://schema.org/TechArticle\" class='row'>
<div class='col-md-11 col-md-offset-1'>
<h1 itemprop=\"headline\">Demo of  animation to change Background color using JQuery</h1>
<div class='row'>
<div class='col-md-3'>";
echo "</div></div>";
$country_code=$_POST['country_code'];
$state_id=$_POST['state_id'];
$city_id=$_POST['city_id'];
echo "country_code : $country_code <br>
state_id : $state_id <br>
city_id: $city_id ";
?>

<nav>
  <ul class='pager'>
						<li><a href='dropdown3.php'><span aria-hidden='true'>&larr;</span>Three Dropdown Demo</a></li>
  </ul>
</nav>
<?Php


?>
</body>
</html>
