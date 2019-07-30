<?php

    if(isset($_POST["municipio_id"]) && !empty($_POST["municipio_id"])){
        //Get all city data
        $query = $db->query("SELECT * FROM municipios WHERE municipio_id = ".$_POST['municipio_id']." AND status = 1 ORDER BY municipio_name ASC");
        
        //Count total number of rows
        $rowCount = $query->num_rows;
        
        //Display cities list
        if($rowCount > 0){
            echo '<option value="">Seleccione una opción</option>';
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['municipio_id'].'">'.$row['municipio_name'].'</option>';
            }
        }else{
            echo '<option value="">Municipios no disponibles</option>';
        }
    }

?>