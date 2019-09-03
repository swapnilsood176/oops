<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["trkcod"]))
{
    $obj1=new clsplylsttrk();
    $obj1->plylsttrkcod=$_REQUEST["trkcod"];
    $obj1->delete_plylsttrk();
}
if(isset($_REQUEST["tcod"]))
{
    $obj=new clsplylsttrk();
    $obj->plylstplylstcod=$_SESSION["plcod"];
    $obj->plylsttrktrkcod=$_REQUEST["tcod"];
    $arr=$obj->disp_plylsttrk($_SESSION["plcod"]);
    $obj->plylsttrkord=count($arr)+1;
    $obj->save_plylsttrk();
}
if(!isset($_SESSION["lcod"]))
{
    header("location:index.php?logfrst=lf");
}
if(isset($_POST["btnsav"]))
{
    $obj=new clsplylst();
    $obj->plylstcatcod=$_POST["drpcat"];
    $obj->plylstdat=date('y-m-d');
    $obj->plylstdsc=$_POST["txtdsc"];
    $obj->plylstlik=0;
    $obj->plylsttit=$_POST["txtplylsttit"];
    $obj->plylstusrcod=$_SESSION["lcod"];
    $a=$obj->save_plylst();
    $_SESSION["plcod"]=$a;
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
<script language="javascript">
    function abc(a)
    {
        window.location="frmplylst.php?ccod="+a;
    }
</script>
<script>
    function val_data()
    {
        
        var dsc=document.getElementById('mix_edit_description').value;
       //var dsc=document.getElementsByName('txtdsc').value;
        var tit=document.getElementById('mix_edit_name').value;
        var s=true;
        if(tit=='')
        {
          alert('please enter title');
          s= false;
        }
        if(dsc=='')
        {
            alert('Please discribe your playlist');
            s= false;
        }
        return s;
//        if(tit=='')
//        {
//            alert('Please Enter Title');
//            return false;
//        }
        
    }
</script>
</head>
<body>
    <form name="frmplylst" method="Post" action="frmplylst.php" onsubmit="return val_data();">
        
 
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
         <li><a href="index.php?sts=lo">logout</a></li>
        </ul>
            </div>
    </div>
    
    
    
    
    
    
    

    
   </div>
  </div>
 </header>
 <section id="site-content">
 		<section class="upload-header">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-6">
                    	<div class="upload-main-heading">
                            <?php
                                if(!isset($_SESSION["plcod"]))
                                {
                            ?>
                        	<h2>Create New Playlist</h2>
                        
                            <!--<p>Then enter a title, description and 2 or more tags</p>-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                    	<div id="publish_buttons">
                          <button class="unedit gray_bt" id="unedit_button" name="btnsav">Save    </button>
                         
    				</div>
                    </div>
                    <?php
                                }
                                else
                                {
                  $obj=new clsplylst();
                  $obj->plylstcod=$_SESSION["plcod"];
                  $obj->find_plylst();
                  echo "<h2>".$obj->plylsttit."</h2>";
                                }
                    ?>
                </div>
            </div>
        </section>
 
  <section class="upload-section">
   <div class="container">
   		<div class="row">
        	<div class="col-sm-8">
            	<div class="left-bar">
                    <?php
                    if(!isset($_SESSION["plcod"]))
                    {
                    ?>
                	<div id="mix_wrapper">
                <div id="mix_edit">
                <div id="mix_metadata_edit" class="editmode">
                            
                          <div class="step">
                            <span class="step_number">1</span>
                            <input type="text" class="mixedit roundText invalid"  placeholder="Title" name="txtplylsttit" id="mix_edit_name" >
                          </div>
                    
                
                            <div class="step">
                              <span class="step_number">2</span>
                              <select name="drpcat" placeholder="Select Category">
                             <?php
                        $obj=new clscat();
                        $arr=$obj->disp_cat();
                        for($i=0;$i<count($arr);$i++)
                        {
                           echo "<option value=".$arr[$i][0]." />".$arr[$i][1];
                        }
                             ?>
                              </select>
                            </div>
                          
                        

                    <div class="step">
                          <span class="step_number">3</span>
                 <textarea id="mix_edit_description" class="mixedit roundText" placeholder="Describe your playlist" name="txtdsc" ></textarea>
                        </div>

  </div>
</div>
  
	<div id="playlists">
  	
  <div class="selectedTracksView"><div id="edit_tracks">
  <div class="editmode" style="display: block;">
    <div class="step" id="trackdrop">
<!--      <span class="step_number">4</span>
      <div style="" id="trackdrop_instructions">
        <a draggable="false" class="orange_button color_button" id="trackdrop_link" href="#">Add Tracks</a>
      	 
      </div>-->
      
      
    </div>
  </div>

  
    
</div>
</div></div>
</div>
                    <?php
                    }
                    ?>
<?php
    if(isset($_SESSION["plcod"]))
    {
?>
<div id="playlist_editor" class="playlist editmode" style="display: block;">
           <h3>Search Tracks</h3>
           <table width="100%">
               <tr><td colspan="2">&nbsp</td></tr>
               <tr>
                   <td>Select Category</td>
                   <td>
                       <select name="drpcat1" onchange="abc(this.value);">
                    <?php
                    $obj=new clscat();
                    $arr=$obj->disp_cat();
                    for($i=0;$i<count($arr);$i++)
                    {
     if(isset($_REQUEST["ccod"])&& $_REQUEST["ccod"]==$arr[$i][0])
        echo "<option value=".$arr[$i][0]." selected />".$arr[$i][1];
     else
         echo "<option value=".$arr[$i][0]." />".$arr[$i][1];
                    }
                    ?>
                       </select>  
                    
                   </td>
               </tr>
           </table>  
           <hr>
           <?php
           $obj=new clstrk();
           if(isset($_REQUEST["ccod"]))
               $a=$_REQUEST["ccod"];
           else
               $a=1;
           $arr=$obj->dspforplylst($a,$_SESSION["plcod"]);
           if(count($arr)>0)
           {
               echo "<table width=100% >";
               echo "<tr><th>Track Title</th><th>Uploaded Date</th></tr>";
           }
           for($i=0;$i<count($arr);$i++)
           {
               echo "<tr><td>".$arr[$i][2]."</td>";
               $dt=date("Y-m-d",  strtotime($arr[$i][6]));
               echo "<td>".$dt."</td>";
               echo "<td><a href=frmplylst.php?tcod=".$arr[$i][0];
               echo " >Add To Playlist</a></td>";
               echo "</tr>";
               
           }
           echo "</table>";
           ?>
    <?php
       $obj1=new clsplylsttrk();
       $arr1=$obj1->disp_plylsttrk($_SESSION["plcod"]);
       if(count($arr1)>0)
       {
           echo "<h3>Added Tracks</h3>";
           echo "<ul class=big_tracks id=selected_tracks >";
       }            
       for($i=0;$i<count($arr1);$i++)
       {
           echo "<li class=track_placeholder even >";
           echo "<span class=number >".$arr1[$i][3]."</span>";
           echo "<div class=track_info >";
           $obj2=new clstrk();
           $obj2->trkcod=$arr1[$i][2];
           $obj2->find_trk();
           echo "<span class=t >".$obj2->trklyr ."</span><br>";
           echo "<span class=a >".$obj2->trkdsc."</span><br>";
           echo "<a href=frmplylst.php?trkcod=".$arr1[$i][0]." >Remove Track</a>";
           echo "</div>";
          echo "</li>";
       }
            echo "</ul>";   
         ?>       
                
  </div>
<?php
    }
?>

			
                
                
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
        	<p>Copyright 2019 My Tracks.</p>
        </div>
     
    </div>
   </div>
  </div>
 </footer>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
   </form>
</body>
</html>