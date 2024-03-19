<?php
require "conn.php";
require "fpdf.php";

if (isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM tblstudents WHERE student_number=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0){
        echo "<script>alert('Successfully deleted');</script>";
        echo "<script>window.location.href = 'student.php';</script>";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
