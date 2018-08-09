
<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
// write content
require_once 'pdf1.php' ;
$content = ob_get_contents();
ob_end_clean();
file_put_contents("test.htm",$content);
echo $content;
?><script>
$(document).ready(function(){

pdfToHTML();
});
</script>