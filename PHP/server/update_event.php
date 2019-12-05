<?php
	include('config.php');

    $id = '"'.$_POST['id'].'"';
    $fecha_inicio = '"'.$_POST['start_date'].'"';
    $hora_inicio = '"'.$_POST['start_hour'].'"';
    $fecha_fin = '"'.$_POST['end_date'].'"';
    $hora_fin = '"'.$_POST['end_hour'].'"';
       
    $sql = "UPDATE eventos SET fecha_inicio = '".$fecha_inicio.", fecha_fin = '".$fecha_fin.", hora_inicio = '".$hora_inicio.", hora_fin = '".$hora_fin." WHERE id = ".$id; 
       
    if($id != 'undefined'){
        $db->query($sql);
        $response['msg'] = 'OK';
    }else{
        $response['msg'] = "Ha ocurrido un error al actualizar el evento";
    }

  
    echo json_encode($response);
    
 ?>
