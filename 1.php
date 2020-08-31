<?php include("connec.php"); ?>
<?php session_start();?>
<?php include("utility.php");?>
<html>
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
.box {
 padding:5px;
 border: solid 1px red;
 wdith:200px;
 float:left;
 margin: 5px;
}
body  
{  
    margin: 0;  
    padding: 0;  
    background-color:#6abadeba;  
    font-family: 'Arial';  
}
 
</style>
<script src="jquery.js"></script>
<script type="text/javascript">

            var current_folder_id= 0;
            var current_folder_name="";

            $(document).ready(function(){

                $("#btnsubmit").click(function(){
                    //var fid=$("#fid").val();
                    var fname=$("#folder").val();
                    var data={"action":"folder","name":fname,"fid":current_folder_id};
                    var settings={
                        Type:"POST",
                        url:"api.php",
                        data:data,
                        dataType:"json",
                        success:function(response){
                            alert(response);
                        },
                        error:function(response){
                            console.log(response);
                            alert("error");
                        }
                    };
                    $.ajax(settings);
                    console.log("revst send");



                });
                

                $("#btnsubmit1").click(function(){
                   // alert("error");
                   current_folder_id =0; 
                   LoadFolders(0);

                    return false;

                  /*  var page=5;
                    var paras=$(".box #da");
                    var pages=Math.ceil(paras.lenght/page);
                    var startIndex=0;
                    for (var i=1;i<=page;i++){
                        var selitem=paras.slice(startIndex,i*page)
                        selitem.wrapAll("<div class='page'/>");
                        startIndex=i*page;
                        var lnk=$("<a href='#'>").text(i);
                        $(".box").append(lnk);

                    } */ //pagination tried!!!!






                });
               // $(".container").dblclick(function(){
                //    var div=$(".div");
                //    var div=$(this).closest().hide();
                //});

            });

            function LoadFolders(fid){

                 var data={"action":"showall","fid":fid};
                    
                    var settings={
                        Type:"POST",
                        url:"api.php",
                        data:data,
                        dataType:"json",
                        success:function(response){
                            console.log(response);
                            $("#da").empty();
                            for(var ind=0;ind<response.data.length;ind++)
                            {
                                var row = response.data[ind];
                                //$("<input type='hidden' id='fid' name='fid' value="+row['ID']+"/>");
                                
                                var $div = $("<div class='box'>");
                                $div.append("ID:"+row.ID+" <br>");
                                $div.append("Name:"+row['NAME']+"<br>");
                                $div.append("createdBy:"+row['createdBy']+"<br>");
                                $div.append("userid:"+row['userid']);
                                $div.append("<br>");
                               // $div.append("<input type='file' id='file'/>");
                               // $div.append("<input type='button' id='btnupload' value='upload'/>");
                                $div.append("</div>");
                                
                                $div.attr('fid',row.ID);
                                
                                $div.attr('fname',row.NAME);
                                $("#da").append($div);
                                console.log(row);


                          
                          
                            
                            
                            }
                            $("#page").on('click',function(){
                                   current_folder_id = $(this).attr('fid');
                                   $(this).next().remove();
                                   LoadFolders(current_folder_id);
                                  


                               });
                        


                            


                            //event binding
                            $('#da .box').on('dblclick',function(){
                               // debugger;
                                current_folder_id = $(this).attr('fid');
                                LoadFolders(current_folder_id);
                                current_folder_name=$(this).attr("fname");
                                

                                var $anc = $("<a href='#' class='breadlink' id='page'fid='"+current_folder_id+"'>/"+current_folder_name+"</a>");
                                $("#span").append($anc);
                            //    $("#page").on('click',function(){
                             //       current_folder_id = $(this).attr('fid');
                             //       LoadFolders(current_folder_id);
                             //       $(this).next().remove();


                            //    });
                                $("#p").on('click',function(){
                                    var cur=$(this).attr('fid');
                                   
                                    LoadFolders(cur);
                                    $(this).next().remove();
                                    


                                });
                             /*   $("#btnupload").on('click',function(){
                               debugger;
                               var current_folder_id = $(this).attr('fid');
                                    var data=new FormData();
                                    var files=$("#file").get(0).files;
                                    if(files.lenght>0){
                                        data.append("file",files[0]);
                                    }
                                    data.append("fid",current_folder_id);
                                    data.append("Action","save");
                                    console.log("rvst send");

                                    var settings={
                                        Type:"POST",
                                        url:"api.php",
                                        contentType:false,
                                        processType:false,
                                        data:data,
                                        sucess:function(r){
                                            
                                            
                                            alert(r);
                                        },
                                    
                                        error:function(){
                                            alert("error hass occuers");
                                        }
                                    };
                                    console.log("rvst send");
                                    $.ajax(settings);
                                    console.log("rvst send");
                                    return false;




                                }); */
                            });
                            
                        /*    $("#btnupload").on('click',function(){
                                
                              var  current_folder_id = $(this).attr('fid');
                                    var data=new FormData();
                                    var files=$("#file").get(0).files;
                                    if(files.lenght>0){
                                        data.append("file",files[0]);
                                    }
                                    data.append("fid",'current_folder_id');
                                    data.append("Action","save");

                                    var settings={
                                        Type:"POST",
                                        url:"api.php",
                                        contentType:false,
                                        processType:false,
                                        data:data,
                                        sucess:function(r){
                                            alert(r);
                                        },
                                        error:function(){
                                            alert("error hass occuers");
                                        }
                                    };
                                    $.ajax(settings);
                                    return false;




                                }); */

                        },
                        error:function(response){
                            alert("error");
                        }

                    };
                    $.ajax(settings);
                    console.log("rvst send");
                
            }
        //    function goback(){
         //       window.history.back();
		//		console.log('We are in previous page');
         //   }
         //   function goforward(){
         //       window.history.back();
		//		console.log('We are in next page');
          ///  }

</script>


</head>
<body>
<h1>Storage Home </h1>

   <div class="container">
   
    <div> 
      Enter your Folder Name:<input type="text" name="foldername" id="folder"/>
        <input type="submit" style="font-size:14px"  name="btnsubmit" id="btnsubmit" value="Create Folder" /> <i class="material-icons">create_new_folder</i></input>
        <input type="file" name="file" id="file"/>
        <input type='button' id='btnupload'  value='upload'/>

        
       
        

    </div>
    
  <div class='span' id='span'>
    <a href='#' id='p' fid=0>Root </a>
  </div>
   
   
   
   <div class="div">
   <input type="submit" name="btnsubmit1" id="btnsubmit1" value="CLICK HERE TO GET INFO FROM TABLE"/>
  
        
         </div>
         
   </div>
   <div class="box" id="da">
            
   </div>
    

</body>
</html>