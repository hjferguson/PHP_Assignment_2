<?php
    //Harlan Ferguson 101133838
    //show source breaks some of the output so I ended up just commenting it out. 
    
    require_once "functions.php";
    $allFolder = "allDB";
    $currFolder = "currentDB"; //require once, issues with multiple requires of same file
    $page = $_GET['page'] ?? "upload"; //get page or default to upload
    getMenu();
    switch($page){
        case "completed":
            require "completed.php";
            break;
        
        case "current":
            require "current.php";
            
            break;
        
        case "upload":
            require "upload.php";
            break;
    }

    //echo show_source(__FILE__);
?>