<?php
require("authenticate.php");

$client=new user();

        //new user 
if(isset($_POST["newUser"])) $client->createUser($_POST["newUser"],$_POST["newPassword"]);
      //login
if(isset($_POST["password"])) $client->LoginUser($_POST["name"],$_POST["password"]);

?>
<html>
    <head>
        <title>www.login.com</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script src="js/jquery.js"></script>
         <!--script_to_check_device_dimensions-->
         <link id="design" rel="stylesheet" href="styles/loginStyles.css" />
         <script>
            let state=false;

                window.onload=()=>{
                    $("#form_2").css("display","none");
                    //basing    on  pc  absolute 
                    if($(window).innerWidth()<950 && navigator.platform!="Win32") 
                    {
                         state=true;
                      $("#design").attr({"href":"styles/loginStyles2.css"});
                      $("#P1").css("height",24);
                      $("#N1").css("height",24);
                   
                    }
                   else $("#design").attr({"href":"styles/loginStyles.css"});
                }          

                function userPartition(){
                    if(state){
                        document.getElementById("middle_man").setAttribute("style","display:none");
                        $("#sub").val("create").css("background-color","green");
                        $("#N1").attr("name","newUser");
                        $("#P1").attr("name","newPassword");
                        return;
                    }
                    document.getElementById("middle_man").setAttribute("style","display:none");
                   return document.getElementById("form_2").setAttribute("style","display:block");
                }
            </script>
    </head>

    <body style="background-image:url('img/log.jpg')">
        <div id="form_1">
            <form   action="login.php"   method="POST"   enctype="multipart/form-data">
                <h2><center>Welcome</center></h2>
            <p>Enter    user    credentials below   to  gain    access  to  the fileSystem</p>
                <div id="userName">
                    <label>username:</label>
                    <input id="N1"  name="name"   type="text"/>
        </div>
                <label>password:</label>
                <input id="P1"  name="password"   type="password"/><br/>
                <input id="sub" type="submit"   value="LOGIN"/>
            </form>

            <div  id="middle_man">
                <label>OR</label><br/>
                <input id="create_query" onclick="userPartition()" type="button"   value="CREATE USER"/>
        </div>

            
            <div id="form_2">
                <form  action="login.php"   method="POST"   enctype="multipart/form-data">
                  <p>Input new database info(only works for new DB's):</p>
                  <div id="NewUserName">
                    <label>username:</label>
                    <input name="newUser"   type="text"/>
        </div>

        <div id="Newpassword">
                    <label>password:</label>
                    <input  id="pass2" name="newPassword"   type="password"/>
        </div>

        <input id="create" type="submit"   value="CREATE"/>
                  </form>
        </div>
        </div>
    </body>
</html>