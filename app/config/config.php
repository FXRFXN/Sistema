<?php
$conexion = mysqli_connect("viaduct.proxy.rlwy.net", "root", "5-B3gaCgCAeHach15gcFF5CAEcD3ddFg", "railway");
 
 
?>
 
<?php
/**
 * Created by PhpStorm.
 * User: DELL-SYSTEM
 * Date: 01/07/2020
 * Time: 16:41
 */
 
define('SERVIDOR','viaduct.proxy.rlwy.net');
define('USUARIO','root');
define('PASSWOD','5-B3gaCgCAeHach15gcFF5CAEcD3ddFg');
define('BD','railway');
 
$URL = 'https://sistema-production-938c.up.railway.app/';
 
$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;
 
try{
    $pdo = new PDO($servidor,USUARIO,PASSWOD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    // echo "<script>alert('La conexiÃ³n a la base de datos fue exitosa.')</script>";
}catch (PDOException $e){
    echo "<script>alert('Error a la conexiÃ³n con la base de datos')</script>";
}
?>
 
<?php
$server = "viaduct.proxy.rlwy.net";
$user = "root";
$pass = "5-B3gaCgCAeHach15gcFF5CAEcD3ddFg";
$bd = "railway";
 
$conect = new mysqli($server,$user,$pass,$bd);
?>
<?php
    $database="railway";
    $user='root';
    $password='5-B3gaCgCAeHach15gcFF5CAEcD3ddF';
 
 
try {
   
    $con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);
 
} catch (PDOException $e) {
    echo "Error".$e->getMessage();
}
 
?>
<?php
try
{
    $bdd = new PDO('mysql:host=viaduct.proxy.rlwy.net;dbname=railway;charset=utf8', 'root', '5-B3gaCgCAeHach15gcFF5CAEcD3ddF');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
