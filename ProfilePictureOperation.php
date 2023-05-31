<?php
    
    
    if(isset($_REQUEST['profile_picture_save']) && isset($_FILES['image'])){

      

        $fileName = $_FILES['image']['name'];
        $ext = substr(strrchr($fileName, '.'), 1);
    
    
        $imageName="my_profile_picture"."."."jpg";
        $tmpName=$_FILES['image']['tmp_name'];
    
        
        $uploc='assets/img/'.$imageName;
     
        move_uploaded_file($tmpName,$uploc);
        header("Refresh:0");
            
      
    
       
        
    
    }








?>