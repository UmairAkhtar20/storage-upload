<?php include("connec.php"); ?>
<?php session_start();?>
<?php 

$msg="";
if(isset($_REQUEST['btnsubmit']))
{
    $name=$_REQUEST['foldername'];
    $createdBy=$_SESSION['name'];
    $createdOn=date('Y-m-d H:i:s');
    $createid=$_SESSION['adminid'];
    $id=$_REQUEST['fid'];

    $sql="INSERT INTO folders2 (NAME,createdBy,createdOn,userid,parentfolder) VALUES('$name',' $createdBy','$createdOn','$createid','$id')";
    
    if(mysqli_query($conn,$sql)===TRUE){
        $msg="folder is created";
    }
    else{
        $msg="unable to create";
    }


}

if(isset($_REQUEST['btnsubmit1'])){

         /*   $createid=$_SESSION['adminid'];

            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>FOLDER NAME</th>";
            echo "<th>CREATED BY</th>";
            echo "<th>USER ID<th>";
            echo "<th>PARENTFOLDER ID <th>";
            echo "</tr>";

            $sql="SELECT ID,NAME,createdBy,userid,folderparentID FROM folders where userid='$createid'";
            $result=mysqli_query($conn,$sql);
            $recordsFound=mysqli_num_rows($result);
            if($recordsFound>0){
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row["ID"]."</td><td>".$row["NAME"]."</td><td>".$row["createdBy"]."</td><td>".$row["userid"]."</td><td>".$row["folderparentID"]."</td></tr>";

                }
                echo "</table>";
            }*/
              

}



?>

<html>
<head>
<title> HOME PAGE</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
/*.table {
border-collapse: collapse;
width: 30px;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2} */
</style>
</head>
<body>
    <h1>Storage Home </h1>
    <form action="" method="post">
    <div> 
      Enter your Folder Name:<input type="text" name="foldername" id="folder"/>
        <input type="submit" style="font-size:14px"  name="btnsubmit" id="btnsubmit" value="Create Folder" /> <i class="material-icons">create_new_folder</i></input>
        <span style="color:red"> <?php echo $msg ?></span>
        <br><br>
        

    </div>

    <form action="" method="post">
    
        <div class="table">
        <input type="submit" name="btnsubmit1" id="btnsubmit1" value="CLICK HERE TO GET INFO FROM TABLE"/>
       <?php 
        $createid=$_SESSION['adminid'];
       $sql="SELECT ID,NAME,createdBy,userid,parentfolder FROM folders2 where userid='$createid'";
            $result=mysqli_query($conn,$sql);
            $recordsFound=mysqli_num_rows($result);
            while($row=mysqli_fetch_assoc($result))

            {
            $id=$row['ID'];
            echo "<input type='hidden' id='fid' name='fid' value=".$id." /> ";    
            echo "NAME :".$row['NAME'];
            echo "<br><br>";
            echo "CREATED BY :".$row['createdBy'];
            echo "<br><br>";
            echo "USERID :".$row['userid'];
            echo "<br><br>";


            }
            
            
            
            ?>
                
        </div>
    
    </form>
     
        <br><br><a href="signout.php" style="color:red">Click Here To Logout</a>

    
    
    </form>
    
</body>
</html>