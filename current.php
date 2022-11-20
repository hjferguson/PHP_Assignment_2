<?php
    echo "<h1>Current Assessments</h1><br>";
    displayCurrItems();
    if(isset($_POST['submit'])){
        changeToComp();     
    }

    //echo show_source(__FILE__);
?>