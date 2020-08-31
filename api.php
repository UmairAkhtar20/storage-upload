<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<?php

    if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
    {
        $action=$_REQUEST['action'];
        if($action=='folder')
        {
           
            $name=$_REQUEST['name'];
            $createdBy=$_SESSION['name'];
            $createdOn=date('Y-m-d H:i:s');
            $createid=$_SESSION['adminid'];
            $id=$_REQUEST['fid'];
        
            $sql="INSERT INTO folders2 (NAME,createdBy,createdOn,userid,parentfolder,folderorNot) VALUES('$name',' $createdBy','$createdOn','$createid','$id',1)";
            // echo $sql;
            // exit;
            if(mysqli_query($conn,$sql)===TRUE){
                $msg="folder is created";
            }
            else{
                $msg="unable to create";
            }

            echo json_encode($msg);
        



        }
        if($action=='showall'){
             $createid=$_SESSION['adminid'];
             $fid = $_REQUEST["fid"];
        //    echo "<table>";
          //  echo "<tr>";
          //  echo "<th>ID</th>";
          //  echo "<th>FOLDER NAME</th>";
          //  echo "<th>CREATED BY</th>";
          //  echo "<th>USER ID<th>";
          //  echo "<th>PARENTFOLDER ID <th>";
           // echo "</tr>";
            $sql="SELECT ID,NAME,createdBy,userid,parentfolder FROM folders2 where parentfolder='$fid' and userid='$createid'";
             $result=mysqli_query($conn,$sql);
            $recordsFound=mysqli_num_rows($result);
          //  echo $recordsFound;
            $data=array();
           // if($recordsFound>0){

                    while($row=mysqli_fetch_assoc($result)){
                        $data[]=$row;
                        

    
                    }
                    
             //   }
               $output['data']=$data;
                echo json_encode($output);

                  
                

                
                    
                    


                     
        

        }
        if($action=="save"){
            if(isset($_FILES['file'])==true)

            {
                $fid=$_REQUEST['fid'];
                $file=$_FILES['file'];
                $src_path=$file['tmp_name'];
                $name=$file['name'];
                $picurl=SaveFile($src_path,$name);
                
            $sql="INSERT INTO folders2 (picUrl,folderorNot) VALUES('$picurl',0) where ID ='$fid'";
            // echo $sql;
            // exit;
            if(mysqli_query($conn,$sql)===TRUE){
                $msg="pic uploaded";
            }
            else{
                $msg="pic cant";
            }

            

            }
            echo json_encode($msg);
        }








    }







?>