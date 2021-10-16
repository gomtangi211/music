<?php

   $db = new PDO('mysql:host=localhost;dbname=photodb','root','');
   
   $put_avname = $_POST["id"];
 //  $put_avname= "잇시키 모모코";
   
   $sql = "select * from jav where avname =   '".$put_avname."' and del=0"; 
    
   $st = $db->prepare($sql);
   $ret = $st->execute();
   $st->setFetchMode(PDO::FETCH_BOTH);
      
   $memberArray = array();
      
   while($row = $st->fetch())
   {
       
       $memberInfo =  array(
       
       "release" => $row["release"],
       "title"  => $row["title"],
       "name"   => $row["name"],
       "avname" => $row["avname"],
       "avno"   => $row["avno"],
       "img"    => $row["img"],
       "file"   => $row["file"],
       "hardlink" => $row["hardlink"]             
       );
       
       array_push($memberArray, $memberInfo);
       
       
   }
   echo(urldecode(json_encode($memberArray)));
?>
 
