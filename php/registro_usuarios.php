<?php

include '../php/Conexion.php';

$nombre_completo= $_POST['nombre_completo'];
$correo= $_POST['correo'];
$usuario= $_POST['usuario'];
$contrasenia= $_POST['contrasenia'];

$contrasenia= hash('sha512', $contrasenia);


$query = "INSERT INTO personas (Nombre_Completo,Correo_Electronico,	Usuario,Contrasenia)
 values('$nombre_completo','$correo','$usuario','$contrasenia')";

$verifica_email= mysqli_query($conexion,"SELECT * FROM personas where Correo_Electronico='$correo' ");

function comprobar_email($correo){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($correo) >= 6) && (substr_count($correo,"@") == 1) && (substr($correo,0,1) != "@") && (substr($correo,strlen($correo)-1,1) != "@")){
       if ((!strstr($correo,"'")) && (!strstr($correo,"\"")) && (!strstr($correo,"\\")) && (!strstr($correo,"\$")) && (!strstr($correo," "))) {
          //miro si tiene caracter .
          if (substr_count($correo,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($correo, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($correo,0,strlen($correo) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto){
       return 1;
    }
    else{
    echo '
    <script>
    alert("El email no es valido de ninguna manera ");
    window.location = "..//login prueba/index_login.php"
      
    </script>

';
}
}


















if (empty($nombre_completo)){

    echo '
       <script>
       alert("El nombre no puede estar vacio ");
       window.location = "..//login prueba/index_login.php"
         
       </script>
 
 ';

 
} 
if(empty ($correo)) {
    echo '
    <script>
    alert(" el email no puede estar vacio ");
    window.location = "..//login prueba/index_login.php"
      
    </script>

';
} 


if(empty ($usuario)) {
    echo '
    <script>
    alert(" el usuario no puede estar vacio ");
    window.location = "..//login prueba/index_login.php"
      
    </script>

';
} 



if(empty ($contrasenia)) {
    echo '
    <script>
    alert(" El password no puede estar vacio ");
    window.location = "..//login prueba/index_login.php"
      
    </script>

';
} 
    









if(mysqli_num_rows($verifica_email)> 0){

echo '
      <script>
      alert("Este correo ya esta en el sistema, intenta mas tarde");
      window.location = "..//login prueba/index_login.php"
       
      </script>

';

exit();

}


$verifica_usuario= mysqli_query($conexion,"SELECT * FROM personas where Usuario='$usuario' ");



if(mysqli_num_rows($verifica_usuario)> 0){

echo '
      <script>
      alert("Este usuario ya esta en el sistema, intenta mas tarde");
      window.location = "..//login prueba/index_login.php"
       
      </script>

';

exit();

}


$ejecutar= mysqli_query($conexion,$query);


if($ejecutar){

echo '
<script>
alert("Usuario registrado exitosamente");
window.location= "..//login prueba/index_login.php"
</script>

';
}else{

   echo ' <script>
    alert("intente nuevamente");
    window.location= "..//login prueba/index_login.php"
    </script>   
    ' ;
}

mysqli_close($conexion);



?>