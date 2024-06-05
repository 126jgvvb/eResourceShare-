$(document).ready(function(){
               /*showing one panel at a time*/
$("header   div input").click(function(){
$target=$(this).attr("href");
$($target).removeClass("hide").addClass("view");

$($target).siblings("div").removeClass("view").addClass("hide");
$mem=$(this).siblings();
})
             /*a file to upload is present?*/
$(":file").bind("change",function(){
    $(":submit").removeAttr("disabled").css("background","steelblue");
})

let $protect=false;
            /*creating checkboxes to delete files*/
$("#dell").click(()=>{
    if($protect==true) return;
                $protect=true;
    $("#mainview").children("div").each((i,val)=>{
            let $input=document.createElement("input");
            $input.setAttribute("type","checkbox");

        $(val).append($input);
        });

        $("#mainview").append("<form  action='uploader.php'   enctype='multipart/form-data' method='POST'><input type='button' onclick='Delete()' value='done'/><input type='text' name='data' value='' id='carry'/><input type='submit' name='delete' id='del_btn' value='delete' disabled/></form>");
            /*incase the user presses the home btn before deleting*/
$("#home").click(function(){
$protect=false;
$("#mainview").children("div").each((i,val)=>{
($(val).children("input").remove())});
$("#mainview").children("form").remove();
})

    });


                /*getting and displaying files*/
                let temp;
    fetch("store/files.json").then(data=>data.json())
    .then(info=>recievedFiles=JSON.stringify(info))
    .then(()=>{
       temp= JSON.parse(recievedFiles);
      createList(temp);
      change=false;
    });

    let $strArray=[];

    function createList(temp){
        for(i=0;    i<temp.length;  ++i){
                $strArray.push(temp);

                let div=document.createElement("div");
                    div.setAttribute("class","files");

                    //image_icon
                    let icon=document.createElement("img");
                        icon.setAttribute("src","img/icon.jpg");
                        icon.setAttribute("style","width:20px");

                    //label
                    let label=document.createElement("label");
                        label.setAttribute("style","margin-left:15%;width:70%");

                    //anchor_element
                    let elem=document.createElement("a");
                        elem.setAttribute("href","store/"+(temp[i].path));
                        elem.setAttribute("style","margin-left:10%");
                        elem.setAttribute("download","");
                       elem.setAttribute("multiple","false");
                       elem.addEventListener("click",(e,data)=>{e.preventDefault();alert(data)});

                    let anch_txt=document.createTextNode("download");

                    //view
                    let view=document.createElement("a");
                        view.setAttribute("href","store/"+temp[i].path);
                        view.setAttribute("style","margin-left:10%");

                    let v_txt=document.createTextNode("view/./download");
                        view.appendChild(v_txt);
                        elem.appendChild(anch_txt);

                    let txt=document.createTextNode(temp[i].name);
                    label.appendChild(txt);

                    div.appendChild(icon);
                    div.appendChild(label);
                    div.appendChild(view);
                  //  div.appendChild(elem);

                  document.getElementById("mainview").appendChild(div);

                  delFiles=temp;
                  console.log(recievedFiles);
            }
    }

        
});


                /*identifying the selected files*/
function Delete(){
    let selected=[],sub=[],count=0;
    $("#mainview").children("div").each((i,val)=>{
          if($(val).children("input").is(":checked")){selected.push($(val).children("a:first").attr("href"))}
    })
    count=selected.length;

    for(i=0; i<delFiles.length; ++i){
        for(j=0; j<selected.length; ++j){
            if(count==0) break; //preventing repeating data
          else  if("store/"+delFiles[i].path==selected[j]){
               let obj={name:delFiles[i].name,path:selected[j]};
               sub.push(JSON.stringify(obj)+"|");
               --count;
            } 
        }
    }
    if(sub.length<1) alert("plaese select an item...");
    else if(sub.length>1) alert("please select one item at a time...");
    else $("#del_btn").css("background-color","rgb(151, 20, 20)").removeAttr("disabled");
    
    $("#carry").attr("value",sub);
    return true;
}




            /*downloading*/
function load(ev,obj){
      $name=$(obj).siblings("label").html();
         fetch("/uploaded_files/"+$(obj).attr("href")).then(obj=>obj.blob()).then(data=>saveAs(data,$name));
   }