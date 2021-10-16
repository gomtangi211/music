<html>
<head>
        <meta charset="utf-8">
        <script src='js/jquery.min.js'></script>
        
        <style>
        body{
           font-family: "Malgun Gothic";font-size:13px; 
           margin:0;
           padding:0;
        }
        video{
            display: none;
        }        
        .change   { /*추가*/
          font-size: 16px; 
          border: none;
          outline: none;
          color: white;
          padding: 14px 16px;
          /* background-color: #4CAF50; */
          background-color: dimgrey;
          font: inherit; /* Important for vertical align on mobile phones */
          margin: 0; /* Important for vertical align on mobile phones */ 
        }    
        .togglebtn {
        font-size: 16px; 
        border: none;
        outline: none;
        /* color: white; */
        padding: 14px 16px;
       /* background-color: dimgrey; */
         font: inherit; /* Important for vertical align on mobile phones */
        margin: 0; /* Important for vertical align on mobile phones */
        }        
       .show {display:block;} 
       .hide {display:none;}     
        
       </style>
<script>
        function togglefunc(e)
        {
        var id = e.id;
        if(id == 'tog_title')
        {
            $('.vid_title').toggleClass('hide');
                       
        }
        else
        {
            $('.vid_singer').toggleClass('hide');
        }
        e.classList.toggle("change");
        }    
</script>
        <script>
            var selectID = -1;
            var cur_time = new Array();
            function showVideo(id, visual)
            {
                if(visual ==true)
                {
                $('#'+id).hide();
                $('#video'+id).show();
                }
                else
                {
                $('#'+id).show();
                $('#video'+id).hide();
                }
            }
            
            function OnImageClick(e){
                var id = e.getAttribute('id');
                
                
                if(selectID != -1)
                {
                    var videoElement = document.getElementById('video'+selectID);


                    videoElement.pause();
                    
                    cur_time[selectID] = videoElement.currentTime ;
                    /*
                    videoElement.addEventListener('loadedmetadata', function() {
                        if(cur_time[id] > 0)
                        {  
                         this.currentTime = cur_time[id];
                        }
                    }, false);
                    */                
                    var sources = videoElement.getElementsByTagName('source');
                    var src= sources[0].getAttribute('src');
                    sources[0].removeAttribute('src');

                     
                    videoElement.load();
                    /*
                    if(cur_time[id] > 0)
                    {
                       videoElement.currentTime =cur_time[id];
                       alert(videoElement.currentTime);
                    }  
                    */
                    sources[0].setAttribute('src',src );
                    

                    showVideo(selectID, false);
                }
                

                $('#dashboard').text(id + '선택'+ selectID +'예전');
                showVideo(id, true);
                document.getElementById('video'+id).play();
                selectID =id;

            }
        </script>
          
         <script>
         
   var ar_video=[];
   //var server_video = 'http://gomtangi.iptime.org/';
   var server_video = 'http://twocaps.iptime.org/';
   
         
   $(document).ready(function(){
   
      //load_video();           
  });
 
 
 function load_video()
{
//포토앨범3
// url="https://spreadsheets.google.com/feeds/list/1khF2rAKDuOz9jbs3VLvIoOKVgyVCfzT7OaXPqUPeUg0/1/public/values?alt=json";
//Av 앨범3
var url = 'https://spreadsheets.google.com/feeds/list/1S4_H5FKQch7QeUCG8PavrOl-0x_BySrQRPeUBQjmTuQ/1/public/values?alt=json';

    $.getJSON(url, function(data){
    var entry= data.feed.entry;

    ar_video=[];
    
    for(var i in entry) {

    var ar=[];
    /*
    ar['title'] = entry[i].gsx$title.$t;
    ar['code'] = entry[i].gsx$code.$t;
    ar['tag']= entry[i].gsx$tag.$t;
    ar['qul']= entry[i].gsx$qul.$t;
    ar['kind']= entry[i].gsx$kind.$t;
    ar['comment'] = entry[i].gsx$comment.$t;
    */
    ar['release'] = entry[i].gsx$release.$t; 
    ar['title'] = entry[i].gsx$title.$t;     
    ar['img'] = entry[i].gsx$img.$t;
    ar['file'] = entry[i].gsx$file.$t;
    ar['name'] = entry[i].gsx$name.$t;
    ar['avno'] = entry[i].gsx$avno.$t;
    ar['avname'] = entry[i].gsx$avname.$t;
    ar['hardlink'] = entry[i].gsx$hardlink.$t;    
    ar['del'] = entry[i].gsx$del.$t;
    
    ar_video[i] = ar;
      }

   var width =  512/2;
   var height = 288/2;

   var url ="";   
   var img = "";
      
   for(var i=0; i<  ar_video.length; i++)
   {

   if(ar_video[i].del == 1)
   	continue;
   	
   var hardlink = ar_video[i].hardlink;
   
   if(hardlink == 1)
   {
   url = server_video + `jav/` + ar_video[i].file;
   }
   else
   {
   url = server_video + `jav${hardlink}/` + ar_video[i].file;
   }
   
   img = server_video + 'torrent/pic/' + ar_video[i].img;
   
   $('#id_video').append(`
     <div  style='float:left'>
     <p class='vid_title hide'>${ar_video[i].title}</p>
     <img id=${i} width=${width} height=${height} src="${img}"  onclick='OnImageClick(this)' >
             <video id= 'video${i}'  width=${width} height=${height} controls preload='none' controlsList='nodownload' oncontextmenu='return false;'>
                    <source src= "${url}" type='video/mp4'  >
            </video>    
     <p class='vid_singer hide'>${ar_video[i].avno} - ${ar_video[i].avname}</p>
     </div>
     `);
   }       
     });    
}
</script>
</head>

<body>
    <p id='dashboard'> </p>
    <button id='tog_title' class='togglebtn' onclick="togglefunc(this)">Title</button>
    <button id='tog_singer' class='togglebtn' onclick='togglefunc(this)'>Name</button>
     
 <div id='id_video'>
<?php 
  
   //$db = new PDO('mysql:host=localhost;dbname=photodb','root',''); //twocaps.iptime.org 큰 공유기
   $db = new PDO('mysql:host=127.0.0.1;dbname=photodb','root',''); //twocaps.iptime.org 큰 공유기
   
   //$db = new PDO('mysql:host=127.0.0.1;dbname=photodb','root','root'); //kjclub.iptime.org 작은공유기
   
   
    $sql = "create TEMPORARY TABLE  IF NOT EXISTS  rownum_jav1 ";
    $sql = $sql."SELECT  Floor( Rand() * 1000 ) as rownum, a.* from jav a  where a.del = 0 order by rownum asc"; 
    
   $st = $db->prepare($sql);
   $ret = $st->execute();   
    
   $sql = "create TEMPORARY TABLE  IF NOT EXISTS rownum_jav2 ";
   $sql = $sql."  select * from rownum_jav1";
 
   $st = $db->prepare($sql);
   $ret = $st->execute();   

   
   $sql = "select DISTINCT * from rownum_jav1 a ";
   $sql = $sql."     right join ( select max(rownum) as rownum from rownum_jav2 group by avname) b ";
   $sql = $sql."     on a.rownum = b.rownum";   
   $st = $db->prepare($sql);
   
   
   /* //twocaps.iptime.org
   
         $sql = "with rownum_jav as ( "; 
        $sql = $sql."select ROW_NUMBER() over (order by rand()) as rownum ,a.*  from jav  a  where del = 0";
        $sql = $sql.")"; 
        $sql = $sql."select * from rownum_jav a ";
        $sql = $sql."right join ( select max(rownum) as rownum from rownum_jav group by avname) b ";
        $sql = $sql."on a.rownum = b.rownum";
       
   $st = $db->prepare($sql);
   */
   $ret = $st->execute();   

   // Fetch 모드를 설정
   //$st->setFetchMode(PDO::FETCH_BOTH); // PDO::FETCH_ASSOC, PDO::FETCH_NUM , PDO::FETCH_BOTH
   
   $width =  256;// 512/2;
   $height = 172;//288/2;
   $i =0;
   //$server_video = "http://gomtangi.iptime.org/";  검정 공유기
   $server_video = "http://twocaps.iptime.org/";    //큰 공유기
   //$server_video = "http://kjclub.iptime.org/";   // 작은 공유기
   //$server_video = "http://192.168.0.2/";   
   
   $url = "";
   // 1 row 씩 가져오기
   while($row= $st->fetch(PDO::FETCH_BOTH)) {
       // echo  $row["title"];
       $filename  =  explode(".", $row['img']);
       
       $img = $server_video.'torrent/thumb/'.$filename[0]."_thumb.".$filename[1];
       //$img = '/torrent/pic/'.$row['img'];
       
       $hardlink = $row['hardlink'];
   
       if($hardlink == 1)
       {
       $url = $server_video."jav/".$row['file'];
       }
       else
       {
       $url = $server_video."jav".$hardlink."/".$row['file'];
       }       
       
       ?>
       <div  style='float:left'>
     <p class='vid_title hide'><?=$row["title"]?></p>
     <img id=<?=$i?> width=<?=$width?> height=<?=$height?> src="<?=$img?>"  onclick='OnImageClick(this)' >
             <video id= 'video<?=$i?>'  width=<?=$width?> height=<?=$height?> controls preload='none' controlsList='nodownload' oncontextmenu='return false;'>
                    <source src= "<?=$url?>" type='video/mp4'  >
            </video>    
     <p class='vid_singer hide'><?=$row['avno']?> - <?=$row['avname']?></p>
      
       </div>
       <? 
       $i++;	 
   }    
    
   //gomtangi.iptime.org 
   $sql = "DROP TEMPORARY TABLE   rownum_jav1";
   $st = $db->prepare($sql);
   $ret = $st->execute();
      
   $sql = "DROP TEMPORARY TABLE   rownum_jav2";
   $st = $db->prepare($sql);
   $ret = $st->execute();   
    
?>
 </div>
       

</html>
