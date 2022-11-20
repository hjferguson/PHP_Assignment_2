<h1>Upload page</h1><br>
<form action="uploadMethod.php" method="post" enctype="multipart/form-data">
    <a>Upload a file: </a><input type="file" name="fileUpload" id="fileUpload">
    <br><input type="submit" value="Upload" id="submit">
</form>
<p>Must be .txt file in CSV format. Format: id,course_name,assessment_name,date,time,status [Completed / Current]</p>

<?php 


displayFiles($allFolder);
if(isset($_POST['submit'])){
    makeDefaultFile($currFolder, $allFolder);  
    echo "<p>$defaultFile</p>";  
}

//echo show_source(__FILE__);
?>