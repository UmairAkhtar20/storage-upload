<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<?php include("fpdf/fpdf.php");?>
<?php

if(isset($_REQUEST['btnpdf'])){
    $pdf=new FPDF('p','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('arial','b','14');
    $pdf->cell('40','10','ID','1','0','C');
    $pdf->cell('40','10','NAME','1','0','C');
    $pdf->cell('40','10','CreatedBy','1','0','C');
    $pdf->cell('40','10','CreatedON','1','0','C');
    $pdf->cell('40','10','Userid','1','0','C');
    $pdf->cell('40','10','PicUrl','1','1','C');
    
    $userid=$_SESSION['adminid'];
    $sql="SELECT * FROM folders2 where userid='$userid'";
    $result=mysqli_query($conn,$sql);
    $resultfound=mysqli_num_rows($result);
    if($resultfound>0){
        while($row=mysqli_fetch_assoc($result)){
            $pdf->cell('40','10',$row['ID'],'1','0','C');
            $pdf->cell('40','10',$row['NAME'],'1','0','C');
            $pdf->cell('40','10',$row['createdBy'],'1','0','C');
            $pdf->cell('40','10',$row['createdOn'],'1','0','C');
            $pdf->cell('40','10',$row['userid'],'1','0','C');
            $pdf->cell('40','10',$row['picUrl'],'1','1','C');

        }
    }
    $pdf->output();




}





?>