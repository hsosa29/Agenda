<?php
	include('config.php');

    if(isset($_SESSION['email'])){
		$response['msg'] = 'OK';
	}else{
        $email = $_POST['username'];
        $password = $_POST['password'];
       
        $sql = "SELECT * FROM usuarios WHERE email = '".$email."'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              
        $count = mysqli_num_rows($result);
        if($count == 1) {
            if(password_verify($password, $row['password'])){
                $response['msg'] = 'OK';   
                $_SESSION['email'] = $row['email']; 
            }else{
                $response['msg'] = 'Contraseña incorrecta';   
            }
        }else{
            $response['msg'] = 'Usuario no existe';    
        }
        echo json_encode($response);
    } 
 ?>