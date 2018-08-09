<?php
if(isset($_POST['state_id']))
$state_id=implode(',',$_POST['state_id']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){

$('#select_all_state').click(function() {
    $('#state_id option').prop('selected', true);
});


$('#unselect_all_state').click(function() {
    $('#state_id option').prop('selected', false);
});


});
</script>

</head>
<body>

<!-- 
**********************************************************************

For Online Tutorial Please visit www.discussdesk.com 

**********************************************************************
-->

<div class="floatL cont_lft_side">
<?if(isset($state_id)){?>
<div style="padding:10px;">Your Selected value: <? echo $state_id;?></div>
<?}?>
<form method="post" action="">
<select id="state_id" name="state_id[]" multiple="multiple" size="10" class="form-control" style="width:300px">
<option value="1">Andaman And Nicobar</option>
<option value="2">Andhra Pradesh</option>
<option value="3">Arunachal Pradesh</option>
<option value="4">Assam</option>
<option value="5">Bihar</option>
<option value="6">Chandigarh</option>
<option value="7">Chhattisgarh</option>
<option value="8">Dadra And Nagar</option>
<option value="9">Daman And Diu</option>
<option value="10">Delhi</option>
<option value="11">Goa</option>
<option value="12">Gujarat</option>
<option value="13">Haryana</option>
<option value="14">Himachal Pradesh</option>
<option value="15">Jammu And Kashmir</option>
<option value="16">Jharkhand</option>
<option value="17">Karnataka</option>
<option value="18">Kerala</option>
</select>

<input type="button" id="select_all_state" class="btn btn-bricky" name="select_all_state" value="Select All State">
<input type="button" id="unselect_all_state" class="btn btn-bricky" name="unselect_all_state" value="Unselect All State">

<input type="submit"  class="btn btn-primary" value="Submit">

</form>


</div>



</body>
</html>

<style>
.btn {
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
	}
.btn-bricky {
    background-color: #c83a2a;
    border-color: #b33426;
    color: #ffffff;
	margin: 15px 0 0 5px;
}
.btn-primary {
    background-color: #428bca;
    border-color: #357ebd;
    color: #fff;
	margin: 15px 0 0 5px;
}

select.form-control {
    background-color: #ffffff;
    border: 1px solid #d5d5d5;
    border-radius: 0;
    color: #858585;
}

.form-control {
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #555;
    display: block;
    font-size: 14px;
    line-height: 1.42857;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;

}


.cont_lft_side {
    width: 450px;
}
.cont_lft_side h3 { border-bottom: 1px solid #ccc; color: #666;font: 17px arial;padding-bottom: 7px;}

</style>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>