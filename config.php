<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("failed" . $conn->connect_error);
} else {
}