<?php include("connec.php");?>

<?php 

$msg="";
if(isset($_REQUEST['btnsubmit']))
{
    
    $login=$_REQUEST['txtlogin'];
    $pass=$_REQUEST['txtpassword'];

    $sql="INSERT INTO users(login,password) VALUES('$login','$pass')";
    if(mysqli_query($conn,$sql)===TRUE)
    {
        $msg="Account is created";
    }
    else{
       // $msg="unable to create account";
        $msg="ERRor:".$sql."".mysqli_error($conn);
    }

}


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>  
</head>
<body>
<h2>SIGNUP PAGE</h2><br>
<div class="login">
    <form action="" method="POST">
    
        <label><b> ENTER Login:   
        </b>    
       </label>    
        <input type="text " id="txtlogin" name="txtlogin" value=""/>
        <br><br>
       <label><b> ENTER Password:  
        </b>    
       </label>
        <input type="password" id="txtpassword" name="txtpassword" />
        <br><br>
        <input type="submit" name="btnsubmit" id="btnsubmit" value="SIGNUP" />
        <br><br>
        <a href="loginpage.php">LOGIN</a>
        <br><br>
        <span style="color:red"><?php echo $msg ?> </span>
    </form>
</div>



</body>
</html>