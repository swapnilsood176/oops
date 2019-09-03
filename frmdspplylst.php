<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["ccod"]))
{
    $_SESSION["ccod"]=$_REQUEST["ccod"];
}
if(isset($_REQUEST["plcod"]))
{
    $_SESSION["plcod"]=$_REQUEST["plcod"];
    header("location:frmplylst.php");
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
       window.location="frmdspplylst.php?ccod="+a;
    }
</script>
</head>
<body>
    <form name="frmdspplylst" method="Post" action="frmdspplylst.php">
        
 
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
          <li><a href="index.php">Home</a></li>
         <li><a href="frmplylst.php">Create Playlists</a></li>
        </ul>
            </div>
    </div>
    
    
    
    
    
    
    

    
   </div>
  </div>
 </header>
 <section id="site-content">
 	
 
  <section class="upload-section">
   <div class="container">
       <h3>Search Playlists</h3><br>
       <table width="100%">
           <tr>
               <td>
                   Select Category
               </td>
               <td>
                   <select name="drpcat" onchange="abc(this.value);">
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
       if(isset($_SESSION["ccod"]))
           $a=$_SESSION["ccod"];
       else
           $a=1;
       $obj=new clsplylst();
       $arr=$obj->dspplylstbycat($a);
       if(count($arr)>0)
       echo "<table><tr><th>Playlists</th></tr>";
       for($i=0;$i<count($arr);$i++)
       {
           echo "<tr><td>";
           echo "<h4><a href=frmplylstdet.php?pcod=".$arr[$i][0]." >".$arr[$i][1]."</a></h4>";
           echo "<p>".$arr[$i][3]."</p>";
           echo "Created By :".$arr[$i][2];
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo $arr[$i][4]." likes";
           if(isset($_SESSION["lcod"]) && $_SESSION["lcod"]==$arr[$i][6])
           {
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href=frmdspplylst.php?plcod=".$arr[$i][0]." >Edit Playlist</a>";
           }
           echo "</td></tr>";
       }
       echo "</table>";
       ?>
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