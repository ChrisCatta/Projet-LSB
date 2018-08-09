

<?php

function panel($type,$titre,$contenu)
{
echo ' <div class="panel '.$type.'">
  <div class="panel-heading"><h4 class="text-center"><strong>'.$titre.'</strong></h4></div>
  <div class="panel-body ">
  '.$contenu.'

      
  </div>
</div>';
}

function panel_tab($type,$title)
{
	echo
	'
	<div class="panel '.$type.'">
     <!-- Default panel contents -->
    <div class="panel-heading"><h2 class="text-center"><strong>'.$title.'</strong></h2></div>

	';
}

function panel_tab_defaut($type,$title)
{
  echo
  '
  <div class="panel '.$type.'">
     <!-- Default panel contents -->
    <div class="panel-heading"><strong>'.$title.'</strong></div>

  ';
}
?>