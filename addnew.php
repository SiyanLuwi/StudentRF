<?php require "includes/header.php"; ?>
<?php 
require "config.php"; 
require "fpdf.php"?>
<?php

if (isset($_POST['submit'])) {
    if (
        $_POST['studnum'] == '' ||
        $_POST['lastname'] == '' ||
        $_POST['firstname'] == '' ||
        $_POST['middlename'] == '' ||
        $_POST['course'] == '' ||
        $_POST['year'] == '' ||
        $_POST['section'] == ''
    ) {
        echo '<script>alert("Some inputs are empty. Please fill in all fields.")</script>';
    } else {
        $studnum = $_POST['studnum'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $section = $_POST['section'];

        $sql = "INSERT INTO tblstudents (student_number, lastname, firstname, middlename, course, year, section) 
             VALUES (:studnum, :lastname, :firstname, :middlename, :course, :year, :section)";
        $insert = $dbh->prepare($sql);
        $insert->bindParam(':studnum', $studnum, PDO::PARAM_STR);
        $insert->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $insert->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $insert->bindParam(':middlename', $middlename, PDO::PARAM_STR);
        $insert->bindParam(':course', $course, PDO::PARAM_STR);
        $insert->bindParam(':year', $year, PDO::PARAM_STR);
        $insert->bindParam(':section', $section, PDO::PARAM_STR);
        $insert->execute();
        echo '<script>alert("Data inserted successfully.")</script>';
        echo "<script>window.location.href = 'student.php';</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Add </title>
</head>

<body>
    <h2 class="d-flex justify-content-center my-4">Add New Student</h2>
    <form action="" method="post" class="post">
        <div class="container top border border-dark">
            <div class="d-flex justify-content-between my-3">
                <h5>Add New Students</h5>
                <div class="d-flex">
                    <a href="student.php" class="btn btn-success"><i class="fa-solid fa-list mx-1"></i>List of Students</a>
                    <a href="mainpage.php" class="btn btn-success mx-1"><i class="fa fa-arrow-left mx-1"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="container main border border-dark">
        <div class="form-element my-4">
                <input type="text" class="form-control" name="studnum" placeholder="Student Number">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="firstname" placeholder="First Name">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="middlename" placeholder="Middle Name">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="course" placeholder="Course">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="year" placeholder="Year">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="section" placeholder="Section">
            </div>
            <div class="form-element my-4">
                <input type="submit" class="btn btn-success" name="submit" value="Add New">
            </div>
        </div>
    </form>
</body>

</html>

<?php require "includes/footer.php"; ?>