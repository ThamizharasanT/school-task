<?php

include_once "config.php";
$sql = "SELECT `City_id`, `City_Name`, `State`, `Country` FROM `City`";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo  $row["City_id"];
        echo  $row["City_Name"];
        echo  $row["State"] . "<br>";
        echo  $row["Country"] . "<br>";
        echo "<br>";
    }
}