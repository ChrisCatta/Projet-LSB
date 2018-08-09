<?Php
session_start();
$tracking_page_name="JQ_Dropdown_three_add_state_demo";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">
<html>
<head>
<title>Demo of  jquery scritp to add name of state to MySQL table after selection of country from database table</title>
<META NAME=\"DESCRIPTION\" CONTENT=\"Demo of jquery PHP MySQL script to add record of state based on selection of  country from dropdown list \">
<META NAME=\"KEYWORDS\" CONTENT=\"Demo of JQuery script, Selection of country list, adding state name to table , record adding\">

";
require "head.php";

echo "</head><body>";
require "config.php"; // Database Connection 
$top_links="<a href=../dropdown-list-three.php>Three Dropdown list </a>";

 
 
echo "<div id=msg class='msg'></div> 
<h1 itemprop=\"headline\">Add a State to plus2_state table after selection of Country </h1>";
require "dropdown3-link.php";
echo "<form method=post id=f1 action=dropdown3-admin-add-cityck.php>";
$sql="select * from plus2_country";
echo "<table><tr>
<td><select class='form-control' id=country_code name=country_code><option value=''>Select One</option>";
foreach ($dbo->query($sql) as $row) {
echo "<option value='$row[country_code]' >$row[country]</option>";
}
echo "</select></td>


<td><input type=text name=city id=t1></td><td><input type=button name=b1 id=b1 value='Add City'></form></td>

";



echo "</tr></table>";
?>
<script>
$(document).ready(function() {
$("#b1").prop('disabled',true);
$("#t1").prop("disabled", true);
////////////////////////////////////
$("#country_code").change(function(){ // change function of listbox
$("#b1").prop('disabled',false);
$("#t1").prop("disabled",false);

});
///////////////////////////
////////////////////////////////////
///////////////////////////
$("#b1").click(function(){
$("#msg").html('Just Wait ...'); 
$("#msg").show();

$.post( "dropdown3-admin-add-stateck.php", {"country_code":$('#country_code').val(),"state":$('#t1').val()},function(return_data,status){
$("#f1")[0].reset();

$("#msg").html(return_data); 
setTimeout(function() { $("#msg").hide(); }, 2000);

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
