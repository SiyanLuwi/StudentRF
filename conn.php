<?php

$con = new mysqli('localhost:3307', 'root', '', 'studentForm');

if (!$con) {
    die(mysqli_error($con));
}

?>
