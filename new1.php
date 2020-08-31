<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<style>
.box {
 padding:5px;
 border: solid 1px red;
 wdith:200px;
 float:left;
 margin: 5px;
}</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORAGE HOME</title>
    <script src="jquery.js"></script>
    <script>
     // ready function!!!
     var cur_fname="";
     var cur_fid=0;
        $(document).ready(function () {

            // start of btncreate event
            $("#btncreate").on('click',function () 
            {
                FolderCreate();

                
            });
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


            $("#btnshow").on('click',function () {
                Folders(0);
                return false;
                
            });
            
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
                            var div=$("<div class='box'>");
                            div.append("ID:"+data.ID+"<br>");
                            div.append("NAME:"+data.NAME+"<br>");
                            div.append("created by:"+data.createdBy+"<br>");
                            div.append("userid :"+data.userid+"<br>");
                            div.append("</div>");
                            div.attr('fname',data.NAME);
                            div.attr('fid',data.ID);
                            $(".bos").append(div);

                                                            
                        }
                        $("#page").on('click',function () {
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
               cur_fid=$(this).attr("fid");
               $(this).nextAll().remove();
               Folders(cur_fid); 
            });





            
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
      <input type="file" name="file" id="file"/>
      <input type="submit" value="upload" name='btnupload' id='btnupload'/>
     

    </div>
    
      
        <div>
         Click Here To show your folder:<input type="button" value="show" id='btnshow'>
                         
        </div>
        <div id=span>
        <a  href='#'id=span1 fid=0>Root </a></div>

        <div class="bos" id='da'>

        
        </div>



</div>
    
</body>
</html>