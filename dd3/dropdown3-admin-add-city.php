<?Php
session_start();
$tracking_page_name="JQ_Dropdown_three_demo";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of adding a city record after selection of Country and state dropdown list using JQuery, PHP & MySQL</title>
<META NAME=\"DESCRIPTION\" CONTENT=\"Demo of JQuery based script to add name of city after selection of country and state from MySQL table\">
<META NAME=\"KEYWORDS\" CONTENT=\"Demo adding city record, demo of selection of country and state, demo of state\">

";
require "head.php";

echo "</head><body>";
require "config.php"; // Database Connection 

 
echo "<div id=msg class='msg'></div> <div id='body_content' itemscope itemtype=\"http://schema.org/TechArticle\" class='row'>
<div class='col-md-11 col-md-offset-1'>
<h1 itemprop=\"headline\">Add a City to plus2_city table after selection of Country & State </h1>";
require "dropdown3-link.php";
echo "<form method=post id=f1 action=dropdown3-admin-add-cityck.php>";
$sql="select * from plus2_country";
echo "<table><tr>
<td>";
echo "<select class='form-control' id=country_code name=country_code><option value=''>Select One</option>";
foreach ($dbo->query($sql) as $row) {
echo "<option value='$row[country_code]' >$row[country]</option>";
}
echo "</select></td>
<td><select class='form-control' id=state_id name=state_id><option value=''>Select One</option></select>
</td>


<td><input type=text name=city id=t1></td><td><input type=button name=b1 id=b1 value='Add City'></td></form>

";



echo "</tr></table>";
?>
<script>
$(document).ready(function() {
$("#b1").prop('disabled',true);
$("#t1").prop("disabled", true);
////////////////////////////////////
$("#country_code").change(function(){ // change function of listbox
$("#state_id,#city_id").empty();
$("#b1").prop('disabled',true);
$.post( "dropdown3ck.php", {"country_code":$('#country_code').val()},function(return_data,status){
$("#state_id").append("<option value=''>Select One</option>");

$.each(return_data.state, function(key,value){
$("#state_id").append("<option value=" + value.state_id +">"+value.state_id + ':' + value.state+"</option>");
});

},"json");

});
///////////////////////////
////////////////////////////////////
$("#state_id").change(function(){ // change function of listbox
if ($( "#country_code" ).val().length >0 && $( "#state_id" ).val().length >0 ){
$("#b1").prop('disabled',false);
$("#t1").prop("disabled", false);
}
});
///////////////////////////
$("#b1").click(function(){
$("#msg").html('Just Wait ...'); 
$("#msg").show();

$.post( "dropdown3-admin-add-cityck.php", {"state_id":$('#state_id').val(),"city":$('#t1').val()},function(return_data,status){
$("#msg").html(return_data); 
setTimeout(function() { $("#msg").hide(); }, 2000);
$("#f1")[0].reset();
$("#t1").attr('value','');
});
});
////////////////////////////
})
</script>


<?Php
require "footer.php";
?>
</body>
</html>
