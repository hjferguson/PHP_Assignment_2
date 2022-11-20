<?php //Code that collects upload file using POST and stores it in a folder called 'uploadedAssessmentFile' on the server
    //This sets the final path of where the file will be
    $target_folder = "allDB". DIRECTORY_SEPARATOR . basename($_FILES["fileUpload"]["name"]); 
    $fileType = strtolower(pathinfo($target_folder,PATHINFO_EXTENSION)); //going to use in if statement to ensure only .txt files

    if($fileType == 'txt'){
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_folder)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
            echo"<meta http-equiv='refresh' content='0;URL=controller.php?page=upload' />";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
    }
    else {
        echo "Sorry, there was an error uploading your file.";
      }
    
      //echo show_source(__FILE__);
?>