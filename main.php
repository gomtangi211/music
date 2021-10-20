<html>

<h1>Welcome.. gomtangi homepage</h1>
</P>
<h2>Service</h2>
<h3><a href='?music'>m u s i c - b o x</a></h3> 
<h3><a href='?music2'>m u s i c 2 - b o x</a></h3>
<h3><a href='?music3'>m u s i c 3 - b o x</a></h3>
 
<?php
//echo phpinfo();
?>

<?php 
 //$db = new PDO('mysql:host=localhost;dbname=photodb','photouser','photouser');
  $db = new PDO('mysql:host=localhost;dbname=photodb','root','');
  
?>
 
<?php
 
 //echo $_SERVER['QUERY_STRING'];

  $query =  $_SERVER['QUERY_STRING'];

  $service  = ['music', 'video', 'movie', 'music2', 'music3'];

  $no = 0;

echo $query;
   

 $date = date("Y-m-d H:i:s\n") ;
 $ip = $_SERVER['REMOTE_ADDR']; // 아이피 주소받음


$details = json_decode(file_get_contents("http://ipinfo.io/"));// 받음받음
$country =  $details->country; // 어느나라니
$city = $details->city; // 어느도시니​

$region = $details->region; 
//echo $details->region;

  for($i =0; $i < count($service); $i++) 
    {
     if($query == $service[$i])
       {

  $kind = $i;
  $sql = "INSERT INTO ip_service_country (date, ip, kind, country, city,region) values (?,?,?,?,?,?) ";
 $st = $db->prepare($sql);
 $ret =  $st->execute( array($date, $ip, $kind, $country, $city, $region ));
 


       //    echo  "Location:  {$query}.html";
         header( "Location:  {$query}.html" );
          break;
        }
     } 
  
?>  
</html>
