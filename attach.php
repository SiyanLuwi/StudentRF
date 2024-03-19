<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("pdf/code128.php");
require("config.php");
$studnum = $_GET['emailid'];
try {
  $studnum = $_GET['emailid'];
  $sql = "SELECT * FROM tblstudents WHERE student_number = :studnum";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':studnum', $studnum);
  $stmt->execute();
  $res = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($res) {
      $email = $res["email"];
      echo "Email found: " . $email;
  } else {
      echo "Email not found.";
  }
} catch (\Throwable $th) {
  echo "An error occurred: " . $th->getMessage();
}
//include ("pdf/fpdf.php");
class email {
public function sendEmail($name, $email, $subject){
  global $studnum;
// Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sean.bearbone@gmail.com';              // SMTP username
    $mail->Password   = 'uues eouq hdtv tzzf';                  // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('sean.bearbone@gmail.com', 'Application Form');
    $mail->addAddress($email, $name);                           // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = file_get_contents("email.html");

    //GENERATE PDF ATTACHMENT

     $pdf= new PDF_Code128('P','mm', 'Legal');
     $pdf->AddPage();
     
     //set the Left Margin to 25
     $pdf->SetTopMargin(20);
     //set the Left Margin to 25
     $pdf->SetLeftMargin(20);
     //set the Right Margin to 25
     $pdf->SetRightMargin(20);
     
     $code=$studnum;    
     $pdf->Code128(150,10,$code,45,15);
     
     $pdf->SetFont('Arial','B',11);
     $pdf->SetY(20);
     $pdf->Cell(0, 6, 'UNIVERSITY OF CALOOCAN CITY',0,0,'C');
     $pdf->Ln();

     $pdf->Image('LOGO.png',55,17,-300);

     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 6, 'FRESHMEN ADMISSION FORM',0,0,'C');
     $pdf->Ln();
     $pdf->Ln();
     //Text for Appointment Details
     $pdf->SetFont('Arial','UB',10);
     $pdf->Cell(0, 6, 'APPOINTMENT DETAILS:',0,0,'L');
     $pdf->Ln();

     $pdf -> Line(20, 45, 195, 45);
     $pdf->Ln();
     $pdf -> Line(20, 45.5, 195, 45.5);
     $pdf->Ln();

     $pdf->SetFont('Arial','B',10);
     $pdf->SetY(46);
     $pdf->Cell(0, 5, 'FRESHMEN APPOINTMENT CODE ',0,0,'L');
     $pdf->SetX(100);
     $pdf->Cell(0, 5, ': ',0,0,'L');
     $pdf->SetX(105);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0, 5, $studnum ,0,0,'L');
     $pdf->Ln();
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 5, 'CAMPUS ',0,0,'L');
     $pdf->SetX(100);
     $pdf->Cell(0, 5, ': ',0,0,'L');
     $pdf->SetX(105);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0, 5, ' SOUTH ',0,0,'L');
     $pdf->Ln();
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 5, 'DATE ',0,0,'L');
     $pdf->SetX(100);
     $pdf->Cell(0, 5, ': ',0,0,'L');
     $pdf->SetX(105);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0, 5, ' Wednesday, March 1, 2023 ',0,0,'L');
     $pdf->Ln();
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 5, 'TIME ',0,0,'L');
     $pdf->SetX(100);
     $pdf->Cell(0, 5, ': ',0,0,'L');
     $pdf->SetX(105);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0, 5, ' 09:00 - 12:00 ',0,0,'L');
     $pdf->Ln();

     $pdf -> Line(20, 67, 195, 67);
     $pdf->Ln();
     $pdf -> Line(20, 67.5, 195, 67.5);
     $pdf->Ln();

     
     //$i=70;
     //Text for Personal Information
     $pdf->SetFont('Arial','UB',10);
     $pdf->SetY(70);
     $pdf->Cell(0, 5, 'PERSONAL INFORMATION:',0,0,'L');
     $pdf->Ln();

     //===============START OF PERSONAL INFORMATION====================//

     $pdf->SetFont('Arial','',9);
     $pdf->SetXY(20, 75);
     $pdf->Cell(0, 4,'NAME:',0,0,'L');
     $pdf -> Line(32, 79, 135, 79);

     $pdf->SetXY(135, 75);
     $pdf->Cell(0, 4,'AGE:',0,0,'L');
     $pdf -> Line(145, 79, 163, 79);

     $pdf->SetXY(162, 75);
     $pdf->Cell(0, 4,'SEX:',0,0,'L');
     $pdf -> Line(172, 79, 195, 79);

     $pdf->SetFont('Arial','',8);
     $pdf->SetXY(45, 79);
     $pdf->Cell(0, 4,'LAST NAME           FIRST NAME          MIDDLE NAME',0,0,'L');
     //$pdf->Ln();
     

     /*********3rd row************/
     $pdf->SetFont('Arial','',9);
     $pdf->SetXY(20, 83);
     $pdf->Cell(0, 4,'ADDRESS:',0,0,'L');
     $pdf -> Line(39, 87, 195, 87);

     /*********4th row************/
     $pdf->SetXY(20, 87);
     $pdf->Cell(0, 4,'BARANGAY NUMBER: ',0,0,'L');
     $pdf -> Line(55, 91, 110, 91);

     $pdf->SetXY(110, 87);
     $pdf->Cell(0, 4,'ZONE: ',0,0,'L');
     $pdf -> Line(121, 91, 147, 91);

     $pdf->SetXY(147, 87);
     $pdf->Cell(0, 4,'DISTRICT:',0,0,'L');
     $pdf -> Line(164, 91, 195, 91);

     /*********5th row************/
     $pdf->SetXY(20, 91);
     $pdf->Cell(0, 4,'DATE OF BIRTH:',0,0,'L');
     $pdf -> Line(47, 95, 110, 95);

     $pdf->SetXY(110, 91);
     $pdf->Cell(0, 4,'PLACE OF BIRTH:',0,0,'L');
     $pdf -> Line(139, 95, 195, 95);

     /*********6th row************/
     $pdf->SetXY(20, 95);
     $pdf->Cell(0, 4,'CIVIL STATUS:',0,0,'L');
     $pdf -> Line(46, 99, 90, 99);

     $pdf->SetXY(90, 95);
     $pdf->Cell(0, 4,'CITIZENSHIP:',0,0,'L');
     $pdf -> Line(115, 99, 140, 99);

     $pdf->SetXY(140, 95);
     $pdf->Cell(0, 4,'RELIGION:',0,0,'L');
     $pdf -> Line(159, 99, 195, 99);

     /*********7th row************/
     $pdf->SetXY(20, 99);
     $pdf->Cell(0, 4,"MOTHER'S NAME:",0,0,'L');
     $pdf -> Line(51, 103, 120, 103);


     $pdf->SetXY(120, 99);
     $pdf->Cell(0, 4,'OCCUPATION:',0,0,'L');
     $pdf -> Line(145, 103, 195, 103);

     /*********8th row************/

     $pdf->SetXY(20, 103);
     $pdf->Cell(0, 4,"FATHER'S NAME:",0,0,'L');
     $pdf -> Line(51, 107, 120, 107);

;
     $pdf->SetXY(120, 103);
     $pdf->Cell(0, 4,'OCCUPATION:',0,0,'L');
     $pdf -> Line(145, 107, 195, 107);

     /*********9th row************/

     $pdf->SetXY(20, 107);
     $pdf->Cell(0, 4,'RESIDENCE TELEPHONE NO.:',0,0,'L');
     $pdf -> Line(72, 111, 120, 111);


     $pdf->SetXY(120, 107);
     $pdf->Cell(0, 4,'CELLPHONE NO.:',0,0,'L');
     $pdf -> Line(151, 111, 195, 111);

    /*********10th row************/

     $pdf->SetXY(20, 111);
     $pdf->Cell(0, 4,'GUARDIAN:',0,0,'L');
     $pdf -> Line(41, 115, 120, 115);

     $pdf->SetXY(120, 111);
     $pdf->Cell(0, 4,'RELATION:',0,0,'L');
     $pdf -> Line(140, 115, 195, 115);

     /*********11th row************/

     $pdf->SetXY(20, 115);
     $pdf->Cell(0, 4,'ADDRESS:',0,0,'L');
     $pdf -> Line(39, 119, 195, 119);

     //=================END OF PERSONAL INFORMATION==========================================//

     //Text for Academic Information
     $pdf->SetFont('Arial','UB',10);
     $pdf->SetXY(20, 120);
     $pdf->Cell(0, 4, 'EDUCATIONAL BACKGROUND:',0,0,'L');
     //$pdf->Ln();

     /***********1ST ROW******************/
     $pdf->SetFont('Arial','',9);
     $pdf->SetXY(20, 124);
     $pdf->Cell(0, 4,'ELEMENTARY:',0,0,'L');
     $pdf -> Line(46, 128, 125, 128);

     $pdf->SetXY(125,124);
     $pdf->Cell(0, 4, 'YEAR GRADUATED:',0,0,'L');
     $pdf -> Line(160, 128, 195, 128);
     

     /***********2ND ROW******************/
     $pdf->SetXY(20, 128);
     $pdf->Cell(0, 4,'HIGH SCHOOL:',0,0,'L');
     $pdf -> Line(47, 132, 125, 132);

     $pdf->SetXY(125,128);
     $pdf->Cell(0, 4, 'YEAR GRADUATED:',0,0,'L');
     $pdf -> Line(160, 132, 195, 132);

     /***********3RD ROW******************/
     $pdf->SetXY(20, 132);
     $pdf->Cell(0, 4,'SENIOR HIGH SCHOOL:',0,0,'L');
     $pdf -> Line(62, 136, 125, 136);

     $pdf->SetXY(125,132);
     $pdf->Cell(0, 4, 'YEAR GRADUATED:',0,0,'L');
     $pdf -> Line(160, 136, 195, 136);

     /***********4TH ROW******************/
     $pdf->SetXY(35, 136);
     $pdf->Cell(0, 4,'(PLEASE SPECIFY THE STRAND)',0,0,'L');
     $pdf -> Line(92, 140, 195, 140);

     /***********5TH ROW******************/
     $pdf->SetXY(20, 140);
     $pdf->Cell(0, 4, 'COLLEGE (IF TRANSFEREE):',0,0,'L');
     $pdf -> Line(75, 144, 195, 144);

     /***********6TH ROW******************/
     $pdf->SetXY(35, 144);
     $pdf->Cell(0, 4, 'COURSE FROM PREVIOUS SCHOOL:',0,0,'L');
     $pdf -> Line(107, 148, 195, 148);

     
     /***********7TH ROW******************/
     $pdf->SetXY(40, 170);


     $pdf->SetY(154);
     $pdf->MultiCell(0,4,'         I, solemnly swear that the information provided in this application are true and correct, the supporting documents are authentic, and that making false statements, furnishing falsified or forged documents in support thereof are punishable by law.',0,'J',0);

    
     $pdf->SetFont('Arial','B',9);

     $pdf -> Line(118, 172, 195, 172);
     $pdf->SetXY(129, 172);
     $pdf->Cell(0, 4, 'SIGNATURE OVER PRINTED NAME',0,0,'L');

     

     $pdf->SetFont('Arial','',10);
     $pdf->SetY(180);
     $pdf->Cell(0, 4, '=====================================================================================',0,0,'L');
   

     $pdf->SetFont('Times','',10);
     $pdf->SetXY(22, 185);
     $pdf->Cell(0, 4, 'Documents Submitted:',0,0,'L');
     
     $pdf->SetXY(130, 185);
     $pdf->Cell(0, 4, 'Average :',0,0,'L');

     $pdf->SetX(163, 185);
     $pdf->Cell(0, 4, 'Registrar :',0,0,'L');


     //**********DOCUMENT SUBMITTED BOX*************//
     $pdf->SetXY(27, 190);
     $pdf->Cell(0, 4, 'Form 138',0,0,'L');
     $pdf->Rect(24, 190, 3, 3, 'D' );

     $pdf->SetXY(57, 190);
     $pdf->Cell(0, 4, 'Good Moral',0,0,'L');
     $pdf->Rect(54, 190, 3, 3, 'D' );

     $pdf->SetXY(82, 190);
     $pdf->Cell(0, 4, 'Voter ID',0,0,'L');
     $pdf->Rect(79, 190, 3, 3, 'D' );

     $pdf->SetXY(105, 190);
     $pdf->Cell(0, 4, 'Diploma (HS)',0,0,'L');
     $pdf->Rect(102, 190, 3, 3, 'D' );
     
     $pdf->SetXY(27, 195);
     $pdf->Cell(0, 4, 'Birth Certificate',0,0,'L');
     $pdf->Rect(24, 195, 3, 3, 'D' );
     
     $pdf->SetXY(57, 195);
     $pdf->Cell(0, 4, '2x2 Picture',0,0,'L');
     $pdf->Rect(54, 195, 3, 3, 'D' );

     $pdf->SetXY(82, 195);
     $pdf->Cell(0, 4, 'Voter Cert.',0,0,'L');
     $pdf->Rect(79, 195, 3, 3, 'D' );

     $pdf->SetXY(105, 195);
     $pdf->Cell(0, 4, 'Diploma (Elem)',0,0,'L');
     $pdf->Rect(102, 195, 3, 3, 'D' );
     
     //*******************************************//

     $pdf->SetXY(22, 200);
     $pdf->Cell(0, 4, 'Date of Examination:',0,0,'L');
     
     $pdf->SetXY(78, 200);
     $pdf->Cell(0, 4, 'Room No.:',0,0,'L');

     $pdf->SetXY(130, 200);
     $pdf->Cell(0, 4, 'Seat:',0,0,'L');
     
     $pdf->SetXY(163, 200);
     $pdf->Cell(0, 4, 'MIS :',0,0,'L');





     //Document submitted
     $pdf->SetXY(22,185);
     $pdf->MultiCell(108, 15,'', 1);
     
     //Average
     $pdf->SetXY(130, 185);
     $pdf->MultiCell(33, 15,'', 1);       
     

     //Registrar
     $pdf->SetXY(163, 185);
     $pdf->MultiCell(33, 15,'', 1);
     

        
     //Date of Examination
     $pdf->SetXY(22, 200);
     $pdf->MultiCell(56, 11,'', 1);

     //Room No
     $pdf->SetXY(78, 200);
     $pdf->MultiCell(52, 11,'', 1);

     //Seat
     $pdf->SetXY(130, 200);
     $pdf->MultiCell(33, 11,'', 1);

     //Mis
     $pdf->SetXY(163, 200);
     $pdf->MultiCell(33, 11,'', 1);

     $pdf->SetFont('Arial','',10);
     $pdf->SetY(212);
     $pdf->Cell(0, 5, '=====================================================================================',0,0,'L');

     $posY = 225;
     $pdf->SetFont('Arial','B',10);
     $pdf->SetY($posY);
     $pdf->Cell(0, 5, 'UNIVERSITY OF CALOOCAN CITY',0,0,'C');
     $pdf->Ln();

     $pdf->Image('LOGO.png',55,222,-320);
     //$pdf->Image('caloocan_city.png',140,222,-800);
     
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(0, 5, 'Accounting Office',0,0,'C');
     $pdf->Ln();
     $pdf->Cell(0, 5, 'ORDER OF PAYMENT',0,0,'C');
     $pdf->Ln();
     $pdf->Ln();

     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0, 5, 'DATE: ______________',0,0,'R');
     $pdf->Ln();

     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 5, 'THE CITY TREASURER:',0,0,'L');
     $pdf->Ln();
     $pdf->Ln();
     $pdf->SetFont('Arial','',10);
     $pdf->SetXY(20, 261);
     $pdf->Cell(0, 4, 'Please accept the payment of  ',0,0,'L');
     $pdf -> Line(70, 265, 140, 265);
     $pdf->Ln();
         
     
     $pdf->SetXY(20, 267);
     $pdf->Cell(0, 4, 'For payment of ENTRANCE EXAM of P100.00', 0,0,'L'); 
     $pdf->Ln();
     
     $posY=$posY+50;
     $pdf->SetFont('Times','',10);
     
     $pdf->SetXY(21, $posY);
     $pdf->MultiCell(62, 11,'', 1);
     $pdf->SetXY(21, $posY);
     $pdf->Cell(0, 5, 'GCASH Number',0,0,'L');

     $pdf->SetXY(83, $posY);
     $pdf->MultiCell(65, 11,'', 1);
     $pdf->SetXY(83, $posY);
     $pdf->Cell(0, 5, 'Transaction Number:',0,0,'L');

     $pdf->SetXY(148, $posY);
     $pdf->MultiCell(47, 11,'', 1);
     $pdf->SetXY(148, $posY);
     $pdf->Cell(0, 5, 'OR Number:',0,0,'L');

     $pdf->Ln();
     $pdf->Ln();
     $pdf->Ln();
     $pdf->Ln();
     $pdf->Ln();

     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(0, 5, 'RYAN N. ALEJO, CPA, DPA ', 0,0,'C'); 
     $pdf->Ln();
     $pdf->Cell(0, 5, 'University Accountant ', 0,0,'C'); 
     $pdf->Ln();


            //I: send the file inline to the browser. The PDF viewer is used if available.
            //D: send to the browser and force a file download with the name given by name.
            //F: save to a local file with the name given by name (may include a path).
            //S: return the document as a string.

      //OUTPUT PDF FILE

      $pdf->Output($studnum . "_Appointment.pdf","F");
      $path = $studnum . "_Appointment.pdf";
      $mail->AddAttachment($path, '', $encoding = 'base64', $type = 'application/pdf');


    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
    //echo $e;
}
     

   }

}

$s = new email();
if ($res) {
  $email = $res["email"]; // Retrieve the email from the database result
  $s = new email();
  if ($s->sendEmail("Application Form", $email, "Application Form")) {
      echo '<script>alert("Email sent successfully!");</script>';
      //echo '<script>window.history.back();</script>';
  } else {
      echo '<script>alert("Email not sent!");</script>';
      //echo '<script>window.history.back();</script>';
  }
} else {
  echo "Email not found.";
}

?>