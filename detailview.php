<?php 
require('includes/header.php'); ?>
<?php 
require('config.php'); 
require "fpdf.php"?>

<?php
$studnum = $_GET['viewid']; // Assuming 'viewid' is the student number

try {
    $sql = "SELECT * FROM tblstudents WHERE student_number = :studnum";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['studnum' => $studnum]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        $lastname = $res['lastname'];
        $firstname = $res['firstname'];
        $middlename = $res['middlename'];
        $email = $res['email'];
        $course = $res['course'];
        $year = $res['year'];
        $section = $res['section'];
    } else {
        echo "Student not found.";
    }
} catch (\Throwable $th) {
    echo "An error occurred: " . $th->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container main border border-dark w-50 m-auto mt-5 p-3">
        <form action="" method="post" class="post">
            <div class="form-element p-3">
                <label for="studnum">Student Number</label>
                <input type="text" id="studnum" class="form-control" name="studnum" disabled value="<?= $studnum; ?>">
            </div>
            <div class="form-element p-3">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" class="form-control" name="lastname" disabled value="<?= $lastname; ?>">
            </div>
            <div class="form-element p-3">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" class="form-control" name="firstname" disabled value="<?= $firstname; ?>">
            </div>
            <div class="form-element p-3">
                <label for="middlename">Middle Name</label>
                <input type="text" id="middlename" class="form-control" name="middlename" disabled value="<?= $middlename; ?>">
            </div>
            <div class="form-element p-3">
                <label for="middlename">Email</label>
                <input type="text" id="middlename" class="form-control" name="email" disabled value="<?= $email; ?>">
            </div>
            <div class="form-element p-3">
                <label for="course">Course</label>
                <input type="text" id="course" class="form-control" name="course" disabled value="<?= $course; ?>">
            </div>
            <div class="form-element p-3">
                <label for="year">Year</label>
                <input type="text" id="year" class="form-control" name="year" disabled value="<?= $year; ?>">
            </div>
            <div class="form-element p-3">
                <label for="section">Section</label>
                <input type="text" id="section" class="form-control" disabled value="<?= $section; ?>">
            </div>
            <div class="d-flex justify-content-center form-element p-3">
                <a href="student.php" style="text-decoration: none; color: whote" class="btn btn-danger"><i class="fa fa-arrow-left mx-1"></i>Back</a>
                <div class="mx-2"></div>
                <a href="erf.php?viewid=<?= $studnum ?>" class="btn btn-success">
                <i class="fas fa-print"></i> Print Copy</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php require('includes/footer.php'); ?>
