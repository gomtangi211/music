
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<script src='js/jquery.min.js'></script>
<script src="js/detectmobilebrowser.js"></script>

<script>
function imageClick(obj)
{
        //alert(obj.id);
        var  width = 512/2;
        var  height = 288/2;
        var preload = null;
        var preload_auto = "auto";
        var preload_none = "none";    
        var server_video = "http://192.168.0.2";
        server_video = "http://kjclub.iptime.org";  //작은 공유기
        server_video = "http://twocaps.iptime.org"; //큰 공유기
                
        $.ajax({
            type:"post",
            url:"ajax_video.php",
            dataType:'json',
            data : {
                id: obj.id
            },
            success:function (result) {
                //alert(result.length);
                
                $('#id_result').empty();
                $('#id_video').empty();
    
                for(var i=0; i< result.length; i++)
                {
                    var title = result[i].title;
                    var name = result[i].name;
                    var avno = result[i].avno;
                    var avname = result[i].avname;
                    var file = result[i].file;
                    var hardlink = result[i].hardlink;
                   //alert(avname);
                   //alert(file);
                   //alert(hardlink);
                   var  li =  `<li> ` + avno+ ` - ` + name + ` </li>` ;        
                   
                   var url = "";
                   if(hardlink == "1" )
                   {
                       url = server_video + "/jav/" + file;
                   }
                   else 
                   {
                       url = server_video + `/jav${hardlink}/` + file;
                   }
     
                   if(i==0) preload="auto";
                   else  preload = "none";
    
                   var video_tag=`
                   <div style='float:left'>
                   <p id='id_title${i}'></p>
                   <video id='1'  width=512 height=288 controls preload='${preload}' controlsList='nodownload' oncontextmenu='return false;'>
                        <source src= '${url}' type='video/mp4'  >
                  </video>
                  <p id='id_desc${i}'> </p>
                  </div>    
                  `;
                  //alert(video_tag);
                    
                    $('#id_video').append(video_tag);    
                    //var p = `<p>  ${avname} : ${file} : ${hardlink}  </p>`;
                    //alert(li);
                    $('#id_title'+i).append(title);
                    $('#id_desc'+ i  ).append(li);
                }
                 
                
            }
    
        });
}
</script>

<body style="padding:0px; margin:0px; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">

    <script>
         var be_mobile = true;
 
        be_mobile = jQuery.browser.mobile;
        console.log(be_mobile);
        
    </script>
    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Composer -->
    <!-- Source: https://www.jssor.com/demos/carousel-slider.slider/=edit -->
    <script src="js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $AutoPlaySteps: 5,
              $SlideDuration: 360,
              $SlideWidth: 256,
              $SlideSpacing: 3,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 5
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 16,
                $SpacingY: 16
              }
            };

            if(be_mobile == true)
            { 
            jssor_1_options.$AutoPlaySteps =3;  
            jssor_1_options.$ArrowNavigatorOptions.$Steps =3;
            jssor_1_options.$SlideDuration = 560;
            }

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980; //200*5 1000  -980 20 /4  5
            MAX_WIDTH = 1800; //pc에선 너무 작아서 늘림

            
          
            function ScaleSlider() {
      
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                     
                    //pc
                    if(be_mobile == false)
                    {
                    if(containerWidth < 1300) containerWidth = 1300;
                    expectedWidth = containerWidth;
                    }
                    else
                    {
                        var windowHeight = $(window).height();
                        var originalWidth = jssor_slider1.$OriginalWidth();
                        var originalHeight = jssor_slider1.$OriginalHeight();

                        var scaleWidth = windowWidth;
                        if (originalWidth / windowWidth > originalHeight / windowHeight) {
                            scaleWidth = Math.ceil(windowHeight / originalHeight * originalWidth);
                        }
                        expectedWidth = scaleWidth;

                    }
                    //alert(expectedWidth);
                    //console.log(expectedWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }               
                      
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /*jssor slider bullet skin 057 css*/
        .jssorb057 .i {position:absolute;cursor:pointer;}
        .jssorb057 .i .b {fill:none;stroke:#fff;stroke-width:2000;stroke-miterlimit:10;stroke-opacity:0.4;}
        .jssorb057 .i:hover .b {stroke-opacity:.7;}
        .jssorb057 .iav .b {stroke-opacity: 1;}
        .jssorb057 .i.idn {opacity:.3;}

        /*jssor slider arrow skin 073 css*/
        .jssora073 {display:block;position:absolute;cursor:pointer;}
        .jssora073 .a {fill:#ddd;fill-opacity:.7;stroke:#000;stroke-width:160;stroke-miterlimit:10;stroke-opacity:.7;}
        .jssora073:hover {opacity:.8;}
        .jssora073.jssora073dn {opacity:.4;}
        .jssora073.jssora073ds {opacity:.3;pointer-events:none;}
    </style>
    
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:150px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:150px;overflow:hidden;">
         
         <?php
         //$db = new PDO('mysql:host=127.0.0.1;dbname=photodb','root','root'); //kjclub.iptime.org 작은공유기
         $db = new PDO('mysql:host=localhost;dbname=photodb','root',''); //twocaps.iptime.org 큰 공유기

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
    
   $ret = $st->execute();   

   // Fetch 모드를 설정
   //$st->setFetchMode(PDO::FETCH_BOTH); // PDO::FETCH_ASSOC, PDO::FETCH_NUM , PDO::FETCH_BOTH
   
   $width =  256;// 512/2;
   $height = 172;//288/2;
   $i =0;
   //$server_video = "http://gomtangi.iptime.org/";  검정 공유기
   $server_video = "http://twocaps.iptime.org/";    //큰 공유기
   //$server_video = "http://kjclub.iptime.org/";   // 작은 공유기
         
   $url = "";
   // 1 row 씩 가져오기
   while($row= $st->fetch(PDO::FETCH_BOTH)) {

        //$filename  =  explode(".", $row['img']);
       
       $img = $server_video.'torrent/pic/'.$row['img'];
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
          
         <div>
              <img id='<?=$row['avname']?>' data-u="image" src="<?=$img?>" onclick="imageClick(this)" />
         </div>        
         
      <?
      }   
      
   //twocaps.iptime.org 
   $sql = "DROP TEMPORARY TABLE   rownum_jav1";
   $st = $db->prepare($sql);
   $ret = $st->execute();
      
   $sql = "DROP TEMPORARY TABLE   rownum_jav2";
   $st = $db->prepare($sql);
   $ret = $st->execute();        
         ?>                              
                                       
                            </div><a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">web animation composer</a>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb057" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:14px;height:14px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5000"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>
    <!-- #endregion Jssor Slider End -->
    <div id= 'id_video'>

    </div>
    <div id='id_result'>
    
    </div>    
</body>

</html>
