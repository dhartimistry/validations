<?php
 
require_once 'db.php';


$target_dir = "images/";

$uploadOk = 1;
        #$filename = $_POST['filename'];


if(isset($_POST["submit"])||!empty($_FILES["filename"]["name"])) 

// Check if image file is a actual image or fake image

{
    $check = getimagesize($_FILES["filename"]["tmp_name"]);
        if($check !== false) 
                
            {
                $check["mime"];
                        
                $uploadOk = 1;
                $target_file =$target_dir.basename($_FILES["filename"]["name"]);
                   
                if (file_exists($target_file))   // Check if file already exists
                    {
                        echo "File already exists.";
                                $uploadOk = 0;
                    }
                    
                if ($_FILES["filename"]["size"] > 500000)  // Check file size
                    {
                        echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                    }


            } 
                   
            else
             
                {
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")  // Allow certain file formats
                    {
                        echo "Only JPG, JPEG & PNG files are allowed.";
                        $uploadOk = 0;
                    }
                    $uploadOk = 0;
                }
    
    
                
                if ($uploadOk == 0)  // Check if $uploadOk is set to 0 by an error
                {
                    echo "Sorry, your file was not uploaded.";
                    
                } 
                else 
                {
                    $filename= $_FILES['filename']['name'];
        
                    $imagetext = mysqli_real_escape_string($conn, $_POST['imagetext']);
                    $new_name= sha1($filename.$random); 
                    $random = rand(0,99999999);
        

                        echo $new_name;
                   
                    $stud_query= "INSERT INTO filename(filename,imagetext) VALUES ('$filename', '$new_name' '$imagetext')";
                    mysqli_query($conn,$stud_query);

                    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) 
                    {
                        echo "The file ". htmlspecialchars(basename( $_FILES["filename"]["name"])). " has been uploaded.";
                    } 
                    
                }

                    
                   

                
                
                
}
     $result = mysqli_query($conn , "SELECT * FROM filename ");               


?>
