



<?php
$servername = "sql313.infinityfree.com";
$username = "if0_40660377";
$password = "DG1DnpXbDNJD";
$dbname = "if0_40660377_hervoicerw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>