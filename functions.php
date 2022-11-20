<?php 
//header menu
function getMenu(){ //use get method to work with switch case. page is the case
    echo("<nav> 
        <a href='controller.php?page=current'>Current</a> 
        <a>|</a>
        <a href='controller.php?page=completed'>Completed</a>
        <a>|</a>
        <a href='controller.php?page=upload'>Upload</a>
        <hr>
        </nav>");
}

function getPWD(){
    $currFoldArray = scandir('currentDB');
    
    foreach($currFoldArray as $file){
        
        if($file !== "." && $file !== ".."){
            
            return "currentDB" . DIRECTORY_SEPARATOR . $file;
        }
    }
}



function changeToComp(){
    for($x = 1; $x < 15; $x++){ 
        if ($_POST[$x] == $x){ 
            $file_handle = fopen(getPWD(),"r");
            $lines_read = file(getPWD()); //array where each index is a line in .txt file
            $new_line = "";
            $all_new_lines = "";
            foreach($lines_read as $line){ //for each individual line in .txt
                $colomns = explode(",",$line); //colomns is now an array of the line, should have 5 indexes
                $primary_key = $colomns[0]; //set primary key to ID
                $secondary_key = $colomns[5];
                if($primary_key == $x){
                    if($secondary_key == "Current\n" || $secondary_key == "Current"){
                        $colomns[5] = "Completed\n"; 
                        $new_line = implode(",",$colomns);
                        $all_new_lines .= $new_line ; 
                    }
                }
                else{
                    //no need to implode if using $line
                    $all_new_lines .= $line ; 
                }
            }
            fclose($file_handle);
            $file_handle_w = fopen(getPWD(),"w");
            fwrite($file_handle_w, $all_new_lines);
            fclose($file_handle_w);
        }
    }
}

function changeToCurr(){
    for($x = 1; $x < 15; $x++){ 
        if ($_POST[$x] == $x){ 
            $file_handle = fopen(getPWD(),"r");
            $lines_read = file(getPWD()); //array where each index is a line in .txt file
            $new_line = "";
            $all_new_lines = "";
            foreach($lines_read as $line){ //for each individual line in .txt
                $colomns = explode(",",$line); //colomns is now an array of the line, should have 5 indexes
                $primary_key = $colomns[0]; //set primary key to ID
                $secondary_key = $colomns[5];
                
                if($primary_key == $x){
                    if($secondary_key == "Completed\n" || $secondary_key == "Completed"){
                        $colomns[5] = "Current\n"; 
                        $new_line = implode(",",$colomns);
                        $all_new_lines .= $new_line ; 

                    }
                }
                else{
                    //no need to implode if using $line
                    $all_new_lines .= $line ; 
                }
            }
            fclose($file_handle);
            $file_handle_w = fopen(getPWD(),"w");
            fwrite($file_handle_w, $all_new_lines);
            fclose($file_handle_w);
        }
    }
}

function displayCurrItems(){
    $file_handle = fopen(getPWD(),"r");
    $lines_read = file(getPWD()); //array where each index is a line in .txt file
    echo"<form method ='post'>";
    
    foreach($lines_read as $line){ //for each individual line in .txt
        $colomns = explode(",",$line); //colomns is now an array of the line, should have 5 indexes
        $primary_key = $colomns[0];
        $secondary_key = $colomns[5];
        if($secondary_key == "Current\n" || $secondary_key == "Current") //set to line ID
        echo("<label for='$primary_key'>$line</label>
        <input type='checkbox' id='$primary_key' name='$primary_key' value='$primary_key'><br>");
    }
    
    echo "<input type='submit' value='Update!' name='submit'> 
    </form>";
    fclose($file_handle);    
}

function displayCompItems(){
    $file_handle = fopen(getPWD(),"r");
    $lines_read = file(getPWD()); //array where each index is a line in .txt file
    echo"<form method ='post'>";
    
    foreach($lines_read as $line){ //for each individual line in .txt
        $colomns = explode(",",$line); //colomns is now an array of the line, should have 5 indexes
        $primary_key = $colomns[0];
        $secondary_key = $colomns[5];
        if($secondary_key == "Completed\n" || $secondary_key == "Completed") //set to line ID
        echo("<label for='$primary_key'>$line</label>
        <input type='checkbox' id='$primary_key' name='$primary_key' value='$primary_key'><br>");
    }
    
    echo "<input type='submit' value='Update!' name='submit'>
    </form>";
    fclose($file_handle);    
}

function displayFiles($folder){
    echo"<form method='post'>";
    if(file_exists($folder) && is_dir($folder)){ //checks path
        $contents = scandir($folder); //file name each array index
        
        foreach($contents as $file){
            if($file !== '.' && $file !== '..'){ //scandir grabs .. and . but we don't want to display that
                echo "<label for='fileName'>$file</label>
                <input type='radio' name='radio' value='$file'><br>";
            }   
        }
    }
    else{
        echo "Please use a valid folder path";
    }
    echo "<br><input type='submit' value='Select Current Working Database File' name='submit'>
    </form>";
}


function makeDefaultFile($currFolder, $allFolder){
    $selectedFile = $_POST['radio'];
    $currFoldArray = scandir($currFolder);
    
    if(count($currFoldArray) >= 3){
        foreach($currFoldArray as $file){
            
            if($file !== "." && $file !== ".."){
                
                rename($currFolder.DIRECTORY_SEPARATOR.$file,$allFolder.DIRECTORY_SEPARATOR.$file);
            }
        }
    }
    rename($allFolder.DIRECTORY_SEPARATOR.$selectedFile,$currFolder.DIRECTORY_SEPARATOR.$selectedFile);
    return $currFolder.DIRECTORY_SEPARATOR.$selectedFile;
}

    //echo show_source(__FILE__);

?>