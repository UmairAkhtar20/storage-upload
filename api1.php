<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<?php

    if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){

        
        $action=$_REQUEST['action'];
        //start of  create ajax
        if($action=="create"){
            $fname=$_REQUEST['fname'];
            $fid=$_REQUEST['fid'];
            $createdby=$_SESSION['name'];
            $createdon=date('Y-m-d H:i:s');
            $userid=$_SESSION['adminid'];
             $sql="INSERT INTO folders2 (NAME,createdBy,createdOn,userid,folderorNot,parentfolder)
              VALUES('$fname','$createdby','$createdon','$userid',0,'$fid')";
              $result=mysqli_query($conn,$sql);
              if($result==True){
                  $msg="folder has been creatde";
              }
              else{
                  $msg='some error';
              }
              echo json_encode($msg);
        }
        //end of  create ajax
        //start of  show ajax
        if($action=="show"){
            $userid=$_SESSION['adminid'];
            $fid=$_REQUEST['fid'];
            $sql="SELECT * FROM folders2 where userid='$userid'and parentfolder='$fid'";
            $result=mysqli_query($conn,$sql);
            $data=array();
            $resultfound=mysqli_num_rows($result);
            if($resultfound>0){
                while($row=mysqli_fetch_assoc($result)){
                    $data[]=$row;
                }
            }
            $output['data']=$data;
            echo json_encode($output);
           
        }





    }


?>