<?php require "includes/header.php"; ?>

<?php
require 'conn.php';
require "fpdf.php";

// Initialize variables
$studnum = $lastname = $firstname = $middlename = $email = $course = $year = $section = '';

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    $sql = "SELECT * FROM tblstudents WHERE student_number=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Retrieve data from the fetched row
        $studnum = $row['student_number'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $email = $row['email'];
        $course = $row['course'];
        $year = $row['year'];
        $section = $row['section'];
    } else {
        echo "No records found";
    }
}

if (isset($_POST['submit'])) {
    // Get data from the form submission
    $studnum = $_POST['studnum']; // Assuming student number is non-editable
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email= $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    $sql = "UPDATE tblstudents SET lastname=?, firstname=?, middlename=?, email=?, course=?, year=?, section=? WHERE student_number=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssss", $lastname, $firstname, $middlename, $email, $course, $year, $section, $studnum ); 
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Data has been Updated Successfully")</script>';
        echo "<script>window.location.href = 'student.php';</script>";
    } else {
        echo "Update failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Add </title>
</head>

<body>
    <h2 class="d-flex justify-content-center my-4">Edit Student</h2>
    <form action="" method="post" class="post">
        <div class="container top border border-dark">
            <div class="d-flex justify-content-between my-3">
                <h5>Edit the Information of Students</h5>
                <div class="d-flex">
                    <a href="student.php" class="btn btn-success"><i class="fa-solid fa-list mx-1"></i>List of Students</a>
                    <a href="mainpage.php" class="btn btn-success mx-1"><i class="fa fa-arrow-left mx-1"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="container main border border-dark">
            <div class="form-c my-4">
                <input type="text" class="form-control" name="studnum" placeholder="Student Number" autocomplete="off" value=<?php echo $studnum; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" autocomplete="off" value=<?php echo $lastname; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="firstname" placeholder="First Name" autocomplete="off" value=<?php echo $firstname; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="middlename" placeholder="Middle Name" autocomplete="off" value=<?php echo $middlename; ?>>
            </div>
            <div class="form-c my-4">
                <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off" value=<?php echo $email; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="course" placeholder="Course" autocomplete="off" value=<?php echo $course; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="year" placeholder="Year" autocomplete="off" value=<?php echo $year; ?>>
            </div>
             <div class="form-c my-4">
                <input type="text" class="form-control" name="section" placeholder="Section" autocomplete="off" value=<?php echo $section; ?>>
            </div>
            <div class="form-element my-4">
                <input type="submit" class="btn btn-success" name="submit" value="Update">
            </div>
        </form>
    </div>
</body>

</html>
<?php require "includes/footer.php"; ?>