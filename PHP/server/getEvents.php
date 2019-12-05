<?php
	include('config.php');

        $session = $_SESSION['email'];
       
        $sql = "SELECT * FROM eventos WHERE fk_usuarios = '".$session."'";
        $result = mysqli_query($db,$sql);
      
        $i = 0;

  
  while($row = $result->fetch_assoc()){
    $response['eventos'][$i]['id']=$row['id'];
    $response['eventos'][$i]['title']=$row['titulo'];
    if ($row['allday'] == 0){ 
      $allDay = false;
       
      $response['eventos'][$i]['start']=$row['fecha_inicio'].'T'.$row['hora_inicio'];
     
      $response['eventos'][$i]['end']=$row['fecha_fin'].'T'.$row['hora_fin'];
    }else{
      $allDay= true;
       
      $response['eventos'][$i]['start']=$row['fecha_inicio'];
       
      $response['eventos'][$i]['end']="";
    }

    $response['eventos'][$i]['allDay']=$allDay;
    
    $i++;
  }
  
 $response['msg'] = 'OK';


echo json_encode($response);
   
 ?>