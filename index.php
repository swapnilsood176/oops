<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["sts"])&& $_REQUEST["sts"]=='lo')
{
    unset($_SESSION["lcod"]);
}
if(isset($_POST["btnsub"]))
{
    $obj=new clsusr();
    $obj->usreml=$_POST["txteml"];
    $obj->usrpwd=$_POST["txtpwd"];
    $obj->usrregdat=date('y-m-d');
    $a=$obj->save_usr();
    if($a==TRUE)
        $msg="Registration Successful.";
    else
        $msg="Email ID already exists.";
}
if(isset($_POST["btnlog"]))
{
   if($_POST["txteml1"]=="adminmytrk@gmail.com"&& $_POST["txtpwd1"]=="admin123#")
   {
        header("location:admin/frmcat.php");
   }
    $obj=new clsusr();
    $a=$obj->logincheck($_POST["txteml1"],$_POST["txtpwd1"]);
    
    if($a==-1)
        $msg1="Email Password incorrect.";
    else
    {
        $_SESSION["lcod"]=$a;
        header("location:frmplylst.php");
    }
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
<script>
function validate_register()
{
    //alert('hiiii man');
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    //return re.test(email);
    var txteml = document.getElementById('txteml').value;
    var txtpwd = document.getElementById('txtpwd').value;
   if(txteml=='')
    {
        document.getElementById('txteml').focus();
        alert("Please enter email address");
        return false;
    }
    else if (!re.test(txteml))
    {
        document.getElementById('txteml').focus();
        alert("Please enter valid email address");
        return false;
    }
    //alert(txtpwd);
   if(txtpwd=='')
    {
        document.getElementById('txtpwd1').focus();
        alert("Please enter password");
        return false;
    }  
    
   }
   function log_val()
{
    //alert('hey you');
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    //return re.test(email);
    var txteml = document.getElementById('txteml1').value;
    var txtpwd = document.getElementById('txtpwd1').value;
   if(txteml=='')
    {
        document.getElementById('txteml1').focus();
        alert("Please enter email address");
        return false;
    }
    else if (!re.test(txteml))
    {
        document.getElementById('txteml1').focus();
        alert("Please enter valid email address");
        return false;
    }
    //alert(txtpwd);
   if(txtpwd=='')
    {
        document.getElementById('txtpwd1').focus();
        alert("Please enter password");
        return false;
    }  
    
   }
</script>
</head>
<body>
   

<div class="modal fade" id="myModal-signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          
        <h4 class="modal-title" id="myModalLabel">Client Signup</h4>
        <form name="index" method="post" action="index.php" onsubmit="return validate_register();">
        <p>If you are not an existing My Tracks user, please fill in the details below.</p>        
       <!--<form class="form col-md-12 center-block">-->
            <div class="form-group">
              <input class="form-control input-lg" placeholder="Email" type="text" name="txteml" id="txteml">
            </div>
            <div class="form-group">
              <input class="form-control input-lg" placeholder="Password" type="password" name="txtpwd" id="txtpwd" >
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" name="btnsub">Sign Up</button>
              </div>
            <?php
      if(isset($msg))
           echo "<div class=form-group >".$msg."</div>";
            ?>
          </form>
          
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <h4 class="modal-title" id="myModalLabel">Client Login</h4>
        <p>If you are an existing My Tracks user, please enter your login email address and your password below.</p>
          
          <form class="form col-md-12 center-block" method="post" action="index.php" onsubmit="return log_val();">
            <div class="form-group">
              <input class="form-control input-lg" placeholder="Email" type="text" name="txteml1" id="txteml1"/>
            </div>
            <div class="form-group">
              <input class="form-control input-lg" placeholder="Password" type="password" name="txtpwd1" id="txtpwd1"/>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" name="btnlog">Login</button>
              </div>
             <?php
      if(isset($msg1))
           echo "<div class=form-group >".$msg1."</div>";
            ?> 
          </form>
          
          
          
          
          
 
      </div>
    </div>
  </div>
</div>







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
      
        <form  action="#" method="get" class="header-nav">
       <button type="button" class="mt-btn " data-toggle="modal" data-target="#myModal-signup">Signup</button>
        <button type="button" class="mt-btn" data-toggle="modal" data-target="#myModal-login">Login</button>
      </form>
      
      <ul>
     
         <li><a href="frmdspplylst.php">Display Playlists</a></li>
        </ul>
            </div>
    </div>  
   </div>
  </div>
 </header>
 <section id="site-content">
  <section class="banner-img">
   <div class="container">
    <div class="row">
     <div class="col-sm-12">
      <div class="banner">  
          <?php
       if(isset($_REQUEST["logfrst"])&& $_REQUEST["logfrst"]=='lf')
       {
           echo'<font color="white" size=8><b>you have to login first</b></font>';
       }
       ?>
       <h1>Create a playlist on My Track</h1>
       <h2>Its free, its fun,and it could make you famous.</h2>
       
       <a href="frmplylst.php">CREATE A PLAYLIST NOW</a>
      </div>
     </div>
    </div>
   </div>
  </section>
 
  <section class="Latest-songs">
  
  
  
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
    <script src="js/min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
    </form>
</body>
</html>