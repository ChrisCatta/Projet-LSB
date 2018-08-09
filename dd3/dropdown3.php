<?Php
session_start();
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of  three linked dropdown list showing country, state  jquery color animation by changing background color effects</title>
<META NAME=\"DESCRIPTION\" CONTENT=\"\">
<META NAME=\"KEYWORDS\" CONTENT=\"\">";
require "head.php";

echo "</head><body>";

require "config.php"; // Database Connection 
$top_links="<a href=../dropdown-list-three.php>Three Dropdown list </a>";

  
echo "<div id='body_content' itemscope itemtype=\"http://schema.org/TechArticle\" class='row'>
<div class='col-md-11 col-md-offset-1'><div id=msg class='msg'></div>
<h1 itemprop=\"headline\">Demo of three linked dropdown listbox Country > State > City JQuery</h1>";
require "dropdown3-link.php";
echo "<br><br><br><br><table><tr><form method=post id=f1 action=dropdown3-ck.php>
<td>";
$sql="select * from plus2_country";

echo "<select class='form-control' id=country_code name=country_code><option value=''>Select Country</option>";
foreach ($dbo->query($sql) as $row) {
echo "<option value=$row[country_code] >$row[country]</option>";
}
echo "</select></td> 


<td><select class='form-control' id=state_id name=state_id><option value=''>Select State</option></select>
</td>
<td><select class='form-control' id=city_id name=city_id><option value=''>Select City</option></select>
</td><td><input type=submit value=Submit id=b1></div></form></td></tr></table>";
?>

<script>
$(document).ready(function() {
$("#b1").prop('disabled',true);
////////////////Country list box on Change////////////////////
$("#country_code").change(function(){ // change function of listbox
$("#state_id,#city_id").empty();// Remove the existing options 
$("#b1").prop('disabled',true); // Disable submit button
$("#msg").html('Just Wait ...'); // Message 
$("#msg").show(); // Display Message

$.post( "dropdown3ck.php", {"country_code":$('#country_code').val()},function(return_data,status){
$("#state_id").append("<option value=''>Select State</option>");

$.each(return_data.state, function(key,value){
$("#state_id").append("<option value=" + value.state_id +">"+value.state_id + ':' + value.state+"</option>");
});

},"json");
setTimeout(function() { $("#msg").hide(); }, 2000);
});
///////////////////////////
////////////// State list box on change //////////////////////
$("#state_id").change(function(){ // change function of listbox
$("#city_id").empty(); 	// Removes all options
$("#b1").prop('disabled',true);   // submit button is disabled
$("#msg").html('Just Wait ...'); // Message 
$("#msg").show();   // Display message 

$.post( "dropdown3ck.php", {"state_id":$('#state_id').val()},function(return_data,status){

$("#city_id").append("<option value=''>Select City</option>");
$.each(return_data.city, function(key,value){
$("#city_id").append("<option value=" + value.city_id +">"+value.city+"</option>");
});

},"json");
setTimeout(function() { $("#msg").hide(); }, 2000);
});
//////////City box on Change/////////////////
$("#city_id").change(function(){ // change function of listbox
if($('#city_id').val()>1){
$("#b1").prop('disabled',false);
}
});
//////////////////////////
})
</script>

<?Php
require "footer.php";
?>
</body>
</html>
