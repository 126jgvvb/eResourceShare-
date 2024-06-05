<?php
require("fileProcessor.php");
?>

<html>
    <head>
        <title>www.uploader.com</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script src="js/FileSaver.min.js"></script>
        <script src="js/jquery.js"></script>
        <link  id="design" rel="stylesheet" href="styles/uploaderStyles.css"/>
        <script src="js/main.js"></script>
     <script>
        function start(){
            if(window.innerWidth<1000){
        $("#design").attr({"href":"styles/uploaderStyles2.css"});
            //rearrangng heading and section buttons for mobile view
        $heading=$("header").children("div:last");
        $("header").children("div:last").remove().end().prepend($heading);

        $("header").css({"position":"relative","background-color":"darkgrey","height":"18em"});
        $("#mainview").css({"margin-top":"1em","margin-left":-2,"height":"12em"});
        $("footer").css("display","none");
        $("header div input").css({"margin":3,"font-size":15,"height":30});
        $("#mainview div.files").css({"height":"40px","font-size":12});
        $("#mainSend").css({"margin-top":"3em","background-color":"grey"});
        $("#mainSend p,form input:submit,input:file").css({"position":"relative","font-size":"18px"})
        $("#mainSend form label,select").remove();
        $("body").css("background-color","rgb(4, 22, 22)")
        }
        else   $("#design").attr({"href":"styles/uploaderStyles.css"});
        }

        setTimeout(()=>start(), 100);
     </script>
    </head>

    <body>
        <header>
            <div>
                <input id="home"  type="button"   value="home"    href="#mainview"/>
                <input  type="button" id="dell2"  value="upload   files"  href="#mainSend"/>
                <input  type="button" id="dell"  value="delete files" href="#mainview"/>
            </div>
            <div>
                <img id="logo"   src="img/book.jpg"  alt="logo_here"/>
                <h1 style="padding-top: 50px;font-size-adjust: initial;font-size: 45px;color:orangered;font-weight: 100;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><center>chargedMatrix virtual  library</center></h1><!--st.john`s sec.school   virtual  library-->
                <input  type="search"   style="position: absolute;margin-left: 70%;margin-top:-14px;width: 300px;"   placeholder="search"/>
            </div>
        </header>


<div    id="mainview"    class="view">
    <img    src="img/filedir.jpg" style="width:30px;margin-left:40%;position:fixed;top:32%;z-index:1"  alt="files"/>
<h3 style="background-color:darkcyan;font-weight: 300;font-size:larger;color:lawngreen;width:40%;margin-left:30%;position:fixed;top:28%"><center>Available files</center></h3>
</div>



<div   id="mainSend"   class="hide" style="font-size: 21px;">
    <p>please   select  file (s)   from    your    file    system</p>
    
    <form  action=""   enctype="multipart/form-data" method="POST">
        <label>file(s)  chosen:</label><input  type="file" name="myfile[]" multiple="true"  accept=".pdf,.doc,.ppt,.txt"/><br/>
        <label  style="margin-top:30%;">work category(important):</label>
        <select>
            <option name="physics"  selected>physics</option>
            <option name="mathematics">mathematics</option>
            <option name="chemistry">chemistry</option>
            <option name="biology">biology</option>
            <option name="history">history</option>
            <option name="divinity">divinity</option>
            <option name="geography">geography</option>
            <option name="economics">economics</option>
            <option name="ict">ict</option>
            <option name="sub_math">sub_math</option></select><br/>
        <br/>
        <input  type="submit" value="submit"  class="intense"  disabled/>
                </form>
</div>
        <footer><table  style="background-color: black;color: white ;">
            <tr>
            <td>
                <label>For inquiries,contact  us on</label>
                <div><img src="img/phone.jpg"   style="width:20px;position:absolute;margin-left:-20px"/><span    style="color:lightgreen">+256741882818</span></div><br/>
                <div><img src="img/tsap.jpg"   style="width:25px;position:absolute;margin-left:-20px"/><span    style="color:lightgreen">_+256779187132</span></div><br/><br/>
            </td>
            </tr>

            <tr>
            <td>
                <label>Need a   design?</label><br/>
                <a  href="www.chargedMatrix.com">  www.chargedMatrix.com</a><br/>
            </td>
            </tr>
            <tr><td>wadikakevin@gmail.com</td></tr>
            <tr><td>DrilloxWorks@gmail.com</td></tr>
            <tr><td>DelosWare@gmail.com</td></tr>
            </table>
        </footer>


    </body>

 