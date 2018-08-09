<?Php
$host_name = "localhost";
$database = "sql_tutorial"; // Change your database nae
$username = "root";          // Your database user id 
$password = "test";          // Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>