<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<?php include("fpdf/fpdf.php");?>
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
             $sql="INSERT INTO folders2 (NAME,createdBy,createdOn,userid,NotFolder,parentfolder)
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

        if($action=='save'){
            if(isset($_FILES['file'])==true)
            

            {
                  
                $fid=$_REQUEST['fid'];
                $file=$_FILES['file'];
                $createdby=$_SESSION['name'];
                $createdon=date('Y-m-d H:i:s');
                $userid=$_SESSION['adminid'];
                echo "console.log($file)";                
                $src_path=$file['tmp_name'];
                $name=$file['name'];
                $picurl=SaveFile($src_path,$name);
                
            $sql="INSERT INTO folders2 (NAME,createdBy,createdOn,userid,NotFolder,picUrl,parentfolder) VALUES('$name','$createdby',' $createdon',' $userid',1,'$picurl','$fid')";
             
            // exit;
            if(mysqli_query($conn,$sql)===TRUE){
                $msg="pic uploaded";
            }
            else{
                $msg="Error:";
            }
            echo json_encode($msg);

            

            }
            
        }
        if($action=="pdf"){
            $userid=$_SESSION['adminid'];
            $fid=$_REQUEST['fid'];
            $pdf=new FPDF('p','mm','A4');
            $pdf->AddPage();
            $pdf->SetFont('arial','b','14');
            $pdf->cell('40','10','ID','1','0','C');
            $pdf->cell('40','10','NAME','1','0','C');
            $pdf->cell('40','10','CreatedBy','1','0','C');
            $pdf->cell('40','10','CreatedON','1','0','C');
            $pdf->cell('40','10','Userid','1','0','C');
            $pdf->cell('40','10','PicUrl','1','0','C');

          //  $sql="SELECT * FROM folders2 where userid='$userid'and parentfolder='$fid'and NotFolder=1";
        //    $result=mysqli_query($conn,$sql);
         //   $data=array();
           /// $resultfound=mysqli_num_rows($result);
           // if($resultfound>0){
           //     while($row=mysqli_fetch_assoc($result)){
           //         $data[]=$row;
           //     }
          //  }
            $output['data']=$pdf->output();
            echo json_encode($output);
            
        
        
        }





    }


?>