<?php require "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h3 class="d-flex justify-content-center my-4">Student Registration</h3>
    <div class="container">
        <div class="main border border-dark">
            <div class="d-flex m-5">
                <a href="addnew.php" class="btn btn-success mx-4"><i class="fa-solid fa-plus mx-1"></i>Add Student</a>
                <a href="student.php" class="btn btn-success mx-4"><i class="fa-solid fa-list"></i> List of Students</a>
            </div>
        </div>
    </div>
</body>

</html>

<?php require "includes/footer.php"; ?>
