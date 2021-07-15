<?php
 include '../php/Conexion.php';

 $correo= $_POST['correo'];
 $contrasenia= $_POST['contrasenia'];



 $valida_ingreso = mysqli_query($conexion,"SELECT * FROM personas where Correo_Electronico='$correo'
 and $contrasenia= '$contrasenia' ");



if(empty($correo)){

    echo ' 
    <script>
        alert("El correo no puede estar vacio");
        window.location = "..//login prueba/index_login.php"
    </script>

';
exit;
}




if(empty($contrasenia)){

    echo ' 
    <script>
        alert("La contrasenia no puede estar vacia");
        window.location = "..//login prueba/index_login.php"
    </script>

';

}
if(mysqli_num_rows ($valida_ingreso)> 0 ){

header("location: ../php/paginaprueba.php");
exit;

}else{

echo ' 
     <script>
         alert("Usuario inesxistente, por favor verifique los datos ingresados");
         window.location = "..//login prueba/index_login.php"
     </script>

';
exit;

}




?>