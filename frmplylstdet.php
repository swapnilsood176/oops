<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["pcod"]))
{
    $_SESSION["pcod"]=$_REQUEST["pcod"];
}
if(isset($_POST["btnsav"]))
{
    $obj=new clsplylst();
    $obj->plylstcod=$_SESSION["pcod"];
    $obj->update_plylst();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<title>My Tracks</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--<link href="css/font-awesome.min.css" rel="stylesheet">-->
<link href="css/font-awesome.css" rel="stylesheet">

</head>
<body>
    <form name="frmplylstdet" method="Post" action="frmplylstdet.php">
        
 
<main>
 <header class="main-header">
  <div class="container">
   <div class="row">
    <div class="col-sm-4">
     <div class="logo"> <a href="#"><img src="images/Logo.png" alt="logo"></a> </div>
    </div>
    
    <div class="col-sm-4">
    	
    </div>
    <div class="col-sm-4">
      <div class="navigation">
      
      <ul>
         <li><a href="frmdspplylst.php">Display Playlists</a></li>
        </ul>
            </div>
    </div>
    
    
    
    
    
    
    

    
   </div>
  </div>
 </header>
 <section id="site-content" class="output-section">
 		<section class="upload-header">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-6">
                    	<div class="upload-main-heading">
                    <?php
                  $obj=new clsplylst();
                  $obj->plylstcod=$_SESSION["pcod"];
                  $obj->find_plylst();
                  echo "<h2>".$obj->plylsttit."</h2>"; 
                  echo "<p>$obj->plylstdsc</p>";
               
                    ?>
                <div class="col-sm-6">
                    	<div id="publish_buttons">
                          <button class="unedit gray_bt" id="unedit_button" name="btnsav">Like    </button>
                         
    				</div>
                    </div>
                </div>
            </div>
        </section>
 
  <section class="upload-section">
  
                 
<div id="playlist_editor" class="playlist editmode" style="display: block;">
    <div class="container add-play">     
    <?php
       $obj1=new clsplylsttrk();
       $arr1=$obj1->disp_plylsttrk($_SESSION["pcod"]);
       if(count($arr1)>0)
       {
           echo "<h3>Tracks</h3>";
           
        //    echo "<pre>"; print_r($arr1); echo "</pre>";
  
         // echo "<pre>"; print_r($firstTrack); echo "</pre>";

		echo '<ul  class="big_tracks" id="playlist">' ;
		//$s="<embed src=trkfil/".$obj2->trkcod.$obj2->trkfil." "; 
		for($i=0;$i<count($arr1);$i++)
		{
			$active = ($i==0)?'active':'';
			echo '<li class="track_placeholder even '.$active.'">';
			echo "<span class=number >".$arr1[$i][3]."</span>";
			echo "<div class=track_info >";
			$obj2=new clstrk();
			$obj2->trkcod=$arr1[$i][2];
			$obj2->find_trk();
			echo '<span class=t ><a href="trkfil/'.$obj2->trkcod.$obj2->trkfil.'">'.$obj2->trklyr.'</a></span><br>';
			echo "<span class=a >".$obj2->trkdsc."</span><br>";
			
			//~ if($i>0)
			//~ {
				//~ echo "QTNEXT".$i."=<".$obj2->trkcod.$obj2->trkfil.">T<myself> ";   
			//~ }
        
         
			echo "</div>";
			echo "</li>";
		}
		echo '</ul>';
		 }
		$obj2=new clstrk();
        $obj2->trkcod=$arr1[0][3];
        $firstTrack =  $obj2->find_trk();
		echo '     <audio id="audio" preload="auto" tabindex="0" controls="" >
			<source src=trkfil/'.$obj2->trkcod.$obj2->trkfil.'">
			Your Fallback goes here
		</audio>';
    
            
      
         ?>       
          </div>      
  </div>

			
                
                
                </div>
            	
            </div>
      
        </div>
   </div>
  </section>

 
 </section>
 <footer class="footer-bg">
  <div class="container">
   <div class="row">
    <div class="col-sm-6">
     <div class="footer-nav"> 
     	<ul>
<!--        	<li><a href="#">Sign Up</a></li>
            <li><a href="#">Log In</a></li>
            <li><a href="#">Create playlist</a></li>-->
        </ul>
     </div>
    </div>
    <div class="col-sm-6">
     	<div class="copyright">
        	<p>Copyright 2015 My Tracks.</p>
        </div>
     
    </div>
   </div>
  </div>
 </footer>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

<script>
	var audio;

var playlist;

var tracks;

var current;

 

init();

function init(){

    current = 0;

    audio = $('#audio');

    playlist = $('#playlist');

    tracks = playlist.find('li a');

    len = tracks.length - 1;
//alert("F Crunt="+current);
//alert("F Length="+len);
    audio[0].volume = .10;

    audio[0].play();

    playlist.find('a').click(function(e){

        e.preventDefault();

        link = $(this);

        current = link.parent().index();
		//alert(current);
        run(link, audio[0]);

    });

    audio[0].addEventListener('ended',function(e){
		
		
        current++;
        var  tracks = playlist.find('li a');

		var len1 = tracks.length ;
      //  alert("Second Crunt="+current);
		//alert("Second Length="+len1);
        if(current == len1){
            current = 0;
            link = playlist.find('li a')[current];
        }else{
		//	alert("Else Crunt="+current);
            link = playlist.find('li a')[current];   
        }
        run($(link),audio[0],current);
    });

}

function run(link, player,current){

       
		//alert(current);
      

        
		if(current==0) {
			
			link = playlist.find('li a')[0];
		//	alert(link);
			player.src = $(link).attr('href');
		//	alert(player.src);
			par = $(link).parent();
			par.addClass('active').siblings().removeClass('active');
			 audio[0].load(); audio[0].play(); 
			// audio[0].preload(); audio[0].play(); 
		}
		else 
		{
			player.src = link.attr('href');
			par = link.parent();
			par.addClass('active').siblings().removeClass('active');
			 audio[0].load(); audio[0].play(); 
		}

        

}

</script>
   
   
<style>


</style>
   </form>
</body>
</html>
