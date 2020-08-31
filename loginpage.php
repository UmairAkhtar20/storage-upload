<?php include("connec.php");?>
<?php session_start();?>
<?php
$msg="";
$msg="";
  $login="";
  if(isset($_REQUEST['btnsubmit'])){
      $login=$_REQUEST['txtlogin'];
      $pass=$_REQUEST['txtpassword'];

      $sql="SELECT * FROM users where login='$login'and password='$pass'";
      $result=mysqli_query($conn,$sql);
      
      $resultf=mysqli_num_rows($result);
     
      if($resultf==1){
          $row=mysqli_fetch_assoc($result);
          $_SESSION['adminid']=$row["ID"];
          $_SESSION['name']=$row['login'];
          header("Location:new1.php");
      }
      else{
          $msg="invlid user ";
      }
  }
?>
<!DOCTYPE html>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />  
</head>
<body>
<h2>Login Page</h2><br>
    <div class="login"> 
     <form action="" method="POST" id='login'>

       <label><b>Login:   
        </b>    
       </label>    
        <input type="text " id="txtlogin" name="txtlogin" value=""/>
        <br><br>
       <label><b>Password:  
        </b>    
       </label>
        <input type="password" id="txtpassword" name="txtpassword" />
        <br><br>
        <input type="submit" name="btnsubmit" id="btnsubmit" value="Login" />
        <br><br>
        <a href="signup.php">SignUp</a>
        <br><br>
        <span style="color:red"><?php echo $msg ?> </span>

      </form>

    </div>


    
</body>
</html>

    
