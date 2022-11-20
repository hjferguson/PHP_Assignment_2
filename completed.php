<?php 
    echo "<h1>Completed Assessments</h1><br>";
    displayCompItems();
    if(isset($_POST['submit'])){
        changeToCurr();
    }

    //echo show_source(__FILE__);
?>