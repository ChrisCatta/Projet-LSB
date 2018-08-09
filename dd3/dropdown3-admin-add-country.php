<?Php
session_start();
$tracking_page_name="JQ_Dropdown_three_add_state_demo";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of Adding Country to database table in three dropdown list script</title>
<META NAME=\"DESCRIPTION\" CONTENT=\"Demo of jquery to Add country to plus2_country table  of three dropdown script \">
<META NAME=\"KEYWORDS\" CONTENT=\"Demo of JQuery script, Selection of country list, adding state name to table , record adding\">

";
require "head.php";

echo "</head><body>";
require "config.php"; // Database Connection 
$top_links="<a href=../dropdown-list-three.php>Three Dropdown list </a>";

 
 
echo "<div id=msg class='msg'></div> <div id='body_content' itemscope itemtype=\"http://schema.org/TechArticle\" class='row'>
<div class='col-md-11 col-md-offset-1'>
<h1 itemprop=\"headline\">Add a Country to plus2_country table </h1>";
require "dropdown3-link.php";
echo "<form method=post id=f1 action=dropdown3-admin-add-countryck.php>
<table class='table'><tr><td>Country Code <input type=text name=country_code id=country_code></td>
<td>Country <input type=text name=country id=country></td>
<td><input type=button name=b1 id=b1 value='Add Country'></div></form></td></tr>
</table>

<div class='row'><div class='col-md-6'>";
$sql="select * from plus2_country";
echo "<table class='table table-striped'> <tr class='info'> <th>Country Code </th><th> Country Name</th></tr>";

foreach ($dbo->query($sql) as $row) {
echo "<tr><td>$row[country_code]</td><td>$row[country]</td></tr>";
}
echo "</table></div>




";



echo "</div></div>";
?>
<script>
$(document).ready(function() {

///////////////////////////
////////////////////////////////////
///////////////////////////
$("#b1").click(function(){
$("#msg").html('Just Wait ...'); 
$("#msg").show();

$.post( "dropdown3-admin-add-countryck.php", {"country_code":$('#country_code').val(),"country":$('#country').val()},function(return_data,status){
$("#msg").html(return_data.msg); 
setTimeout(function() { $("#msg").hide(); }, 2000);
if(return_data.db_status=='OK'){
 window.location = "dropdown3-admin-add-country.php";
}
},'json');
});
////////////////////////////
})
</script>


<?Php
require "footer.php";

?>
</body>
</html>
