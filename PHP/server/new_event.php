<?php
	include('config.php');

    $titulo = '"'.$_POST['titulo'].'"';
    $fecha_inicio = '"'.$_POST['start_date'].'"';
    $hora_inicio = '"'.$_POST['start_hour'].':00"';
    $fecha_fin = '"'.$_POST['end_date'].'"';
    $hora_fin = '"'.$_POST['end_hour'].':00"'; 
    $allday = $_POST['allDay'];
    $fk_usuarios = '"'.$_SESSION['email'].'"';
       
    $sql = "INSERT INTO eventos (titulo, fecha_inicio, fecha_fin, hora_inicio, hora_fin, allday, fk_usuarios) VALUES ('".$titulo."', '".$fecha_inicio."', '".$fecha_fin."', '".$hora_inicio."', '".$hora_fin."', $allday, '".$fk_usuarios."')";
       
    if ($db->query($sql) === TRUE) {
        $response['msg'] = 'OK';
    } else {
        $response['msg'] = 'Error al insertar evento';
    }   

    echo json_encode($response);
    
 ?>
