<?php
$conexion = mysqli_connect("by7mu16zhz1zguk9nqso-mysql.services.clever-cloud.com", "uquyebwfnkfaejgs", "C0H6Hq1YtpqhkUdy9lKf", "by7mu16zhz1zguk9nqso");


?>

<?php
/**
 * Created by PhpStorm.
 * User: DELL-SYSTEM
 * Date: 01/07/2020
 * Time: 16:41
 */

define('SERVIDOR','by7mu16zhz1zguk9nqso-mysql.services.clever-cloud.com');
define('USUARIO','uquyebwfnkfaejgs');
define('PASSWOD','C0H6Hq1YtpqhkUdy9lKf');
define('BD','by7mu16zhz1zguk9nqso');

$URL = 'mysql://uquyebwfnkfaejgs:C0H6Hq1YtpqhkUdy9lKf@by7mu16zhz1zguk9nqso-mysql.services.clever-cloud.com:3306/by7mu16zhz1zguk9nqso';

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWOD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    // echo "<script>alert('La conexiÃ³n a la base de datos fue exitosa.')</script>";
}catch (PDOException $e){
    echo "<script>alert('Error a la conexiÃ³n con la base de datos')</script>";
}
?>

<?php
$server = "by7mu16zhz1zguk9nqso-mysql.services.clever-cloud.com";
$user = "uquyebwfnkfaejgs";
$pass = "C0H6Hq1YtpqhkUdy9lKf";
$bd = "by7mu16zhz1zguk9nqso";

$conect = new mysqli($server,$user,$pass,$bd);
?>
<?php
	$database="by7mu16zhz1zguk9nqso";
	$user='uquyebwfnkfaejgs';
	$password='C0H6Hq1YtpqhkUdy9lKf';


try {
	
	$con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}

?>
<?php
try
{
	$bdd = new PDO('mysql:host=by7mu16zhz1zguk9nqso-mysql.services.clever-cloud.com;dbname=by7mu16zhz1zguk9nqso;charset=utf8', 'uquyebwfnkfaejgs', 'C0H6Hq1YtpqhkUdy9lKf');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
