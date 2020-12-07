<?php
session_start();
if (isset($_GET['id']) && $_GET['id'] != '') { //when id is not empty
  require_once 'db.php'; //database connection 

  $stud_id = $_GET['id'];
  $stud_query = "SELECT * FROM `students` WHERE id='" . $stud_id . "'";
  $stu_res = mysqli_query($conn, $stud_query);
  $results = mysqli_fetch_row($stu_res);
  $first_name = $results[1];
  $last_name = $results[2];
  $gender = $results[3];
  $email = $results[4];
  $branch = $results[5];
} else {
  $first_name = "";
  $last_name = "";
  $gender = "";
  $email = "";
  $branch = "";
  $stud_id = "";
}

?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD OPERATIONS</title>
    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
  <style>
    .formdiv {
      margin: 0 auto;
      width: 40%
    }

    .info {
      height: 20px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">CLASSROOM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">List<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add.php">Add new</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <?php
    if (isset($_SESSION['errorsArray'])) {
      $errorsArray = $_SESSION['errorsArray'];
      foreach ($errorsArray as $errorId => $error) {
        echo '<div class="alert alert-danger">' . $error . '<br /></div>';
      }
      unset($_SESSION['errorsArray']);
    }
    ?>
    <div class="formdiv">
      <div class="info"> </div>
      <form method="POST" action="edit.php">
        <div class="form-group row">
          <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
          <div class="col-sm-10">
            <input type="text" required name="first_name" class="form-control" id="first_name" value=" <?php echo  $first_name; ?> ">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
          <div class="col-sm-10">
            <input type="text" required name="last_name" class="form-control" id="last_name" value="<?php echo  $last_name; ?> ">
          </div>
        </div>

        <div class="form-group row">
          <label for="gender" class="col-sm-3 col-form-label">Gender</label>
          <div class="col-sm-10">
            <input type="text"  required name="gender" class="form-control" id="gender" value="<?php echo  $gender; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" required name="email" class="form-control" id="email" value="<?php echo  $email; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="branch" class="col-sm-3 col-form-label">Branch</label>
          <div class="col-sm-10">
            <input type="text" required  name="branch" class="form-control" id="branch" value="<?php echo  $branch; ?>">
          </div>
        </div>

        <div class="form_group row">
          <div class="col-sm-7">
            <input type="hidden" name="student_id" value="<?php echo $stud_id; ?>">
            <input type="submit" name="submit" class="btn btn-success" value="SUBMIT" />
          </div>
        </div>





    </div>
  </div>
  </form>