<?php

    if(isset($_POST["parroquia_id"]) && !empty($_POST["parroquia_id"])){
        //Get all city data
        $query = $db->query("SELECT * FROM parroquias WHERE parroquia_id = ".$_POST['parroquia_id']." AND status = 1 ORDER BY parroquia_name ASC");
        
        //Count total number of rows
        $rowCount = $query->num_rows;
        
        //Display cities list
        if($rowCount > 0){
            echo '<option value="">Seleccione una opción</option>';
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['parroquia_id'].'">'.$row['parroquia_name'].'</option>';
            }
        }else{
            echo '<option value="">Parroquias no disponibles</option>';
        }
    }

?>