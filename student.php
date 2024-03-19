<?php 
require "includes/header.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Student List</title>
</head>

<body>
    <h3 class="d-flex justify-content-center my-4">Student List</h3>

    <div class="container top border border-dark">
        <form action="" method="post" class="post">
            <div class="d-flex justify-content-between my-3">
                <h5>List of Students</h5>
                <div class="d-flex">
                    <a href="add.php" class="btn btn-success"><i class="fa fa-plus mx-1"></i>Add New Students</a>
                    <a href="mainpage.php" class="btn btn-success mx-1"><i class="fa fa-arrow-left mx-1"></i>Back</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container main border border-dark">
        <table class="table table-bordered" id="tbl-list-employee">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Action</th> <!-- Added a column for actions -->
                </tr>
            </thead>
            <tbody>

                <?php
                include("config.php");
                $sql = "SELECT * FROM tblstudents";
                $view = $dbh->prepare($sql);
                if ($view->execute()) {
                    while ($row = $view->fetch(PDO::FETCH_ASSOC)) {
                        $studnum = $row['student_number'];
                        $lastname = $row['lastname'];
                        $firstname = $row['firstname'];
                        $middlename = $row['middlename'];
                        $course = $row['course'];
                        $year = $row['year'];
                        $section = $row['section'];

                        echo '<tr>
                            <td>' . $studnum . '</td>
                            <td>' . $lastname . '</td>
                            <td>' . $firstname . '</td>
                            <td>' . $middlename . '</td>
                            <td>' . $course . '</td>
                            <td>' . $year . '</td>
                            <td>' . $section . '</td>
                            <td>
                            <a href="detailview.php?viewid=' . $studnum . '" class="btn btn-info"><i class="fa fa-eye mx-1"></i> View</a>
                            <a href="update.php?updateid=' . $studnum . '" class="btn btn-warning mx-1"><i class="fa fa-edit mx-1"></i> Update</a>
                            <a href="sentemail.php?emailid=' . $studnum . '" class="btn btn-primary mx-1"><i class="fa fa-envelope mx-1"></i> Email</a>
                            <a href="delete.php?deleteid=' . $studnum . '" class="btn btn-danger mx-1"><i class="fa fa-trash mx-1"></i> Delete</a>
                        </a>
                        </td>
                        </tr>';
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#tbl-list-employee").DataTable();
        });
    </script>

</body>

</html>
<?php require "includes/footer.php"; ?>
