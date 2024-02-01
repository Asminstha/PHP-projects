<!-- to connect database -->

<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "crud_application");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);  /*CREATE CONNECTION TO THE DB*/

if (!$connection) {
    die("Connection Failed");

} else {
    // echo"yes";
}

?>