<?php
require 'config.php';
require "fpdf.php";

// Initialize variables
$studnum = $_GET['emailid']; // Assuming 'viewid' is the student number

try {
    $sql = "SELECT * FROM tblstudents WHERE student_number = :studnum";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['studnum' => $studnum]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        $email = $res['email'];
    } else {
        echo "Email not found.";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Sending Email</title>
</head>

<body>
    <?php require "includes/header.php"; ?>

    <h2 class="d-flex justify-content-center my-4">Sending Email to Student</h2>
    <form action="" method="post" class="post">
        <div class="container top border border-dark">
            <div class="d-flex justify-content-between my-3">
                <h5>Sending Email Application</h5>
                <div class="d-flex">
                    <a href="student.php" class="btn btn-success">
                        <i class="fa-solid fa-list mx-1"></i>List of Students
                    </a>
                    <a href="student.php" class="btn btn-success mx-1">
                        <i class="fa fa-arrow-left mx-1"></i>Back
                    </a>
                </div>
            </div>
        </div>
        <div class="container main border border-dark">
            <div class="form-c my-4">
                <input type="text" class="form-control" name="email" placeholder="Recipient's Email" autocomplete="off" value="<?php echo $email ?>">
            </div>
            <div class="d-flex justify-content-center form-element p-3">
                <a href="student.php" style="text-decoration: none; color: white" class="btn btn-danger">
                    <i class="fa fa-arrow-left mx-1"></i>Back
                </a>
                <div class="mx-2"></div>
                <a href="attach.php?emailid=<?= $studnum ?>" class="btn btn-success">
                    <i class="fas fa-envelope"></i> Send Email
                </a>
            </div>
        </div>
    </form>
    <?php require "includes/footer.php"; ?>
</body>

</html>