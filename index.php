<?php
  //mysql connection 
  //read records
  require_once 'db.php';
  $query = "SELECT * FROM students";

  $results = mysqli_query($conn , $query);
  $records = mysqli_num_rows($results);
  $msg="";
  if(!empty($_GET['msg'])){
    $msg=$_GET['msg'];
    $alert_msg= ($msg=="add") ? "new record has been added successfully!": "record has been updated successfully:";


  }else{
    $alert_msg="";
  }

  

?>

<html lang="en">
    <head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"/>
    <style>
    .formdiv { margin:0 auto; width:40%} 
    .info{height:20px;}   
    </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">CLASSROOM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link active" href="index.php">List<span class="sr-only">(current)</span></a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="add.php">Add new</a>
          </li>
          </ul>
        </div>
    </nav>

    <div class = "container">
    <?php if (!empty($alert_msg)){?>
    <div class ="alert alert-success"><?php echo $alert_msg;?></div>
    <?php }?>



    


    <div class="container">
    <div class="info"> </div> 
    <table class ="table">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Email</th>
      <th scope="col">Branch</th>
      <th scope="col">Action</th>
    </tr>
    </thead> 
    <tbody>

      <?php

        if (!empty ($records)) //if the records are not empty pointer wil jump here
        {
          while ($row = mysqli_fetch_assoc($results)){
              ?>
                <tr>
                      <th scope="row"><?php echo $row['id']; ?></th>
                      <td><?php echo $row['first_name']. ' '.$row['last_name']; ?></td>
                      <td><?php echo $row['gender'] ?></td>
                      <td><?php echo $row['email'] ?></td>
                      <td><?php echo $row['branch'] ?></td>
                      <td>
                        <a href="add.php?id=<?php echo $row['id']; ?> " class="btn btn-primary">EDIT</a>

                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="javascript:return confirm('Are you sure you want to delete');" >DELETE</a> 
                      </td> 
                </tr>   

        <?php

          }
     
        }
        ?>
        </tbody>
      
    
    
</div>
</body>
</html>
