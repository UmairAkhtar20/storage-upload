<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link rel="stylesheet" href="bootstrap.css">
<style>
.box {
 background-image: url("Folder-icon.png");
 
 padding:1px;

 width:72px;
 height:72px;
 float:left;
 margin: 5px;
}

img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}



</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORAGE HOME</title>
    <script src="jquery.js"></script>
    <script>
     // ready function!!!
     var cur_fname="";
     var cur_fid=0;
        $(document).ready(function () {
            Folders(0);

            // start of btncreate event
            $("#btncreate").on('click',function () 
            {
                FolderCreate();

                
            });
            $("#btnupload").on('click',function(){
                    var cur=cur_fid;
                    Save(cur); 

            });
            $("#btnshowfile").on('click',function(){
                showfile(cur_fid);


            });
       /*     $("#btnpdf").on('click',function(){
                alert("ddd");
                createpdf(cur_fid);
            }); */
            // end of btncreate event
            //start of btnshow event

            function FolderCreate() {
                var fname=$("#fname").val();
                var data={'action':'create','fname':fname,'fid':cur_fid};
                var settings={
                    Type:"post",
                    url:"api1.php",
                    data:data,
                    dataType:"json",
                    success:function(r){
                        alert(r);
                    },
                    error:function(r){
                        alert(r);
                    }
                };
                $.ajax(settings);

                
            }


            
               
                
                
            
            
            //end of the btnshow event
            //createion of folder function
            function Folders(fid)
             {

                var data={'action':'show','fid':fid};
                var settings={
                    Type:"post",
                    url:"api1.php",
                    data:data,
                    dataType:"json",
                    success:function(response){
                       $("#da").empty();
                        for(var i=0;i<response.data.length;i++){
                            var data=response.data[i];
                            if(data.NotFolder==0)
                            {
                                var div=$("<div class='box'>");
                                div.append("<br>");
                                div.append(""+data.NAME+"<br>");
                                div.append("</div>");
                                div.attr('fname',data.NAME);
                                div.attr('fid',data.ID);
                                $(".bos").append(div);
                                
                            }
                            else if(data.NotFolder==1)
                            {
                              //  var div=$("<div class='box'>");
                              ////  div.append("<br>");
                              //  div.append(""+data.NAME+"<br>");
                              //  div.append("</div>");
                              //  div.attr('fname',data.NAME);
                              //  div.attr('fid',data.ID);
                              //  $(".bos").append(div);
                            
                                
                                var div1=$("<div >");
                               // div1.append("ID:"+data.ID+"<br>");
                                div1.append("NAME:"+data.NAME+"<br>");
                               // div1.append("created by:"+data.createdBy+"<br>");
                               // div1.append("userid :"+data.userid+"<br>");
                                div1.append("<img src='img/"+data.picUrl+"'/>");
                                $(".bos").append(div1);


                            }
                            

                                                            
                        }
                        
                        $("#page").on('click',function () {
                            $(".file").empty();
                            cur_fid=$(this).attr("fid");
                            $(this).nextAll().remove();
                            Folders(cur_fid); 

                            
                        });
                        $(".box").on('dblclick',function () {
                            
                            cur_fid=$(this).attr('fid');
                           // debugger;
                            Folders(cur_fid);
                            cur_fname=$(this).attr('fname');
                            var p=$("<a href='#' id='page' fid='"+cur_fid+"'>/"+cur_fname+" </a>");
                            $("#span").append(p);

                    
                         });

                        
                       
                    },
                    error:function () {
                        alert("error !!!");
                        
                    }

                };
                $.ajax(settings);

               



            }
            
            //ending of folderfunction
            $("#span1").on('click',function () {
                $(".file").empty();
               cur_fid=$(this).attr("fid");
               $(this).nextAll().remove();
               Folders(cur_fid); 
            });
            

           

                    function Save(fid){
                        alert(cur_fid);
                        var data=new FormData();
                        var files=$("#file").get(0).files;
                      //  console.log(files);
                        if(files.length > 0){
                            data.append("file",files[0]);
                           // console.log(data);
                        }
                        data.append("fid",cur_fid);
                        data.append("action","save");
                        console.log("rvst send");

                        var settings={
                            type:"POST",
                            url:"api1.php",
                            contentType:false,
                            processData:false,
                            data:data,
                            success:function(r){
                                
                                
                                alert(r);
                            },
                        
                            error:function(){
                                alert("error hass occuers");
                                    }
                            };
                            console.log(settings);

                    console.log("rvst send");
                    $.ajax(settings);
                    console.log("rvst send");
                    //+  return false;




                    }
             /*  function createpdf(cur_fid)
               {
                alert("dddd");
                    var data={"action":"pdf","fid":cur_fid};
                    var settings={
                        Type:"POST",
                        url:"api1.php",
                        dataType:"json",
                        data:data,
                        success:function(r){
                            
                            alert(r);
                            
                        },
                        error:function(){
                            alert("error!!!");
                        }
                    };
                    $.ajax(settings);
               } */





            
       
       
       
        });
        // end of ready
    
    
    
    
    </script>







</head>
<body>
<div class='container'>     
    
    <div>
    ENTER Folder Name:  <input type="text" id='fname' name='fname'>
      <input type="button" value="CREATE" id='btncreate' name='btncreate'>
      <br>
    </div>
    <div>
    <input type="file" name="file" id="file"/>
      <input type="submit" value="upload" name='btnupload' id='btnupload'/>
    </div>
    
      
        <div>
        <form action="pdf_gen.php" method="post">
        <button type="submit" name="btnpdf" class="btn btn-success">CreatePdf</button>
        </form>
       
            
                         
        </div>
        <div id=span>
        <a  href='#'id=span1 fid=0>Root </a></div>

        <div class="bos" id='da'>
         </div>
         <br><br>
         
         





</div>
    
</body>
</html>