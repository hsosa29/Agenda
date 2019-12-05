<?php
	include('config.php');

    $id = '"'.$_POST['id'].'"';
           
    $sql = "DELETE FROM eventos WHERE id = ".$id; 
       
    if ($db->query($sql) === TRUE) {
        $response['msg'] = 'OK';
    } else {
        $response['msg'] = 'Error al eliminar evento';
    }   
  
    echo json_encode($response);
    
 ?>
