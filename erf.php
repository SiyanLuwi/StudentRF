<?php
// session_start();
include("config.php");
include("fpdf.php");

$school = "UNIVERSITY OF CALOOCAN CITY";
$address = "Biglang Awa St. 12th Avenue East Caloocan City";
$title = "Registration Form";
$stud_name = "NAME : ";
$stud_num = "STUDENT NUMBER : ";
$date = "DATE :";
$campus = "CAMPUS: MAIN";
$ncourse = "COURSE/YEAR/SECTION :";
$sem = "SEMESTER";
$scheme = "SCHEME";
$date = "7/28/2023";
$sy = "SCHOOL YEAR :";
$syear = "2023-2024";
$subject =  ["1  CCS-116            5       ADVANCED WEB SYSTEMS",
         "2  CS-106             3         SOFTWARE ENGINEERING",
         "3  CS-110             3        NETWORKS AND COMMUNICATIONS",
         "4  CSE-102          3        GRAPHICS AND VISUAL COMPUTING",
         "5  GEC-008          3        ETHICS", 
         "6  RES-001         3         METHODS OF RESEARCH",
         "7  GEC-007         3        SCIENCE, TECHNOLOGY AND SOCIETY"];
$payment = ["TF OR: ",
            "MF OR:",
            "TOTAL PAYMENT:",
            "OR DATE:",
            "AMOOUNT DUE:",
            "BALANCE:",
            "PENALTY:"];

$studnum = $_GET['viewid'];

try {
    $sql = "SELECT * FROM tblstudents WHERE student_number = :studnum";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['studnum' => $studnum]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        $lastname = $res['lastname'];
        $firstname = $res['firstname'];
        $middlename = $res['middlename'];
        $course = $res['course'];
        $year = $res['year'];
        $section = $res['section'];
    } else {
        echo "Student not found.";
    }
} catch (\Throwable $th) {
    echo "An error occurred: " . $th->getMessage();
}

$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->SetTopMargin(25);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->AddPage();
$pdf->SetLineWidth(.8);
$pdf->Rect(6, 15, 203, 150);
$pdf->SetLineWidth(0.8);
$pdf->Line(6, 45, 209, 45);
$pdf->Line(6, 80, 209, 80);

$pdf->Image('LOGO.png', 9, 17, -150);
$pdf->SetLineWidth(1);
$pdf->Rect(6, 15, 29, 30);
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetY(25);
$pdf->Cell(138, -5, $school, 0, 0, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetLineWidth(0.7);
$pdf->Cell(35, -5, "STUDENT'S COPY", 0, 0, 'C');
$pdf->Rect(155, 17, 50, 10);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(105, 20, $address, 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(84, -3, $title, 0, 0, 'C');


$pdf->SetFont('Arial', 'B', 14);
$pdf->SetLineWidth(0.7);
$pdf->SetX(75); 
$pdf->Cell(205, -3, $campus, 0, 0, 'C'); 
$pdf->Rect(155, 33, 50, 10); 
$pdf->Ln();


$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(53);
$pdf->SetX(10);
$pdf->Cell(70, 0, $stud_name, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(120);
$pdf->Cell(70, 0, $stud_num, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(170);
$pdf->Cell(0, 0, $date, 0, 0, 'L');
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$pdf->SetX(10);
$pdf->Cell(0, 15, $lastname . ", " . $firstname . " " . $middlename, 0, 0, 'L');

$pdf->SetFont('Arial', '', 12);
$pdf->SetX(125);
$pdf->Cell(0, 15, $studnum, 0, 0, 'L');

$pdf->SetFont('Arial', '', 12);
$pdf->SetX(170);
$pdf->Cell(0, 15, $date, 0, 0, 'L');
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->Cell(0, -2, $ncourse, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(75);
$pdf->Cell(0, -2, $sem, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(123);
$pdf->Cell(0, -2, $sy, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(170);
$pdf->Cell(0, -2, $scheme, 0, 0, 'L');
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$pdf->SetX(10);
$pdf->Cell(0, 15, $course . " " . $year . "-" . $section, 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(80);
$pdf->Cell(0, 15, "1st", 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(126);
$pdf->Cell(0, 15, $syear, 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 12);
$pdf->SetX(178);
$pdf->Cell(0, 15, "1", 0, 0, 'L');
$pdf->Ln();

$pdf->Rect(10, 85, 125, 75);
$pdf->Line(10, 95, 135, 95);

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(15);
$pdf->Cell(0, 15, "SUBJECTS", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(40);
$pdf->Cell(0, 15, "UNITS", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(58);
$pdf->Cell(0, 15, "TIME", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(73);
$pdf->Cell(0, 15, "DAY", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(86);
$pdf->Cell(0, 15, "ROOM", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(105);
$pdf->Cell(0, 15, "PROFESSOR", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(96);

$lineHeight = 5; 
foreach ($subject as $item) {
    $pdf->SetX(13);
    $pdf->Cell(0, $lineHeight, $item, 0, 1, 'L');
}

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(130);
$pdf->SetX(20);
$pdf->Cell(0, 15, "TOTAL:    23", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(138);
$pdf->SetX(20);
$pdf->Cell(0, 15, "RECOMMENDED APPROVAL:________________________", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(145);
$pdf->SetX(83);
$pdf->Cell(0, 15, "TOTAL:    23", 0, 0, 'L');

$pdf->Rect(140, 85, 64, 48);
$pdf->Line(204, 95, 140, 95);

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(83);
$pdf->SetX(153);
$pdf->Cell(0, 15, "REMARKS/PAYMENT", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(96);

$lineHeight = 5;
foreach ($payment as $item) {
    $pdf->SetX(145);
    $pdf->Cell(0, $lineHeight, $item, 0, 1, 'L');
}

$pdf->Rect(140, 135, 64, 25);

$pdf->SetFont('Arial', 'UB', 10);
$pdf->SetY(140);
$pdf->SetX(153);
$pdf->Cell(0, 15, "Dr. Melchor S. Julianes", 0, 0, 'L');

$pdf->SetFont('Arial', 'b', 10);
$pdf->SetY(146);
$pdf->SetX(160);
$pdf->Cell(0, 15, "REGISTRAR", 0, 0, 'L');

$date = date('Y-m-d');
//I D F S
$content = $pdf->Output($date . '.pdf', 'I');
?>
