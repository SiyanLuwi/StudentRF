<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Student Form</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Student Registration Form</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">


        <ul class="navbar-nav ms-auto">
          <?php if (!isset($_SESSION['username'])) : ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="mainpage.php">Home</a>
        
              </ul>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>
  <div class="container marketing">
</head>
<body>
  
</body>
</html>