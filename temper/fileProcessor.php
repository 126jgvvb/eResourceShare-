<?php
session_start();
if(!isset($_SESSION["password_set"])    &&  !session_id(1))    header("Location:/temper/login.php");
session_abort();
session_id("1");

if(isset($_FILES["myfile"]["name"])){
    $totalNumber=count($_FILES["myfile"]["name"]); //considering an array of files
    $savedFiles=$totalNumber; //tracking successfully transferred files

while($totalNumber>0){
$filename=$_FILES["myfile"]["name"][$totalNumber-1];
$filetype=$_FILES["myfile"]["type"][$totalNumber-1];
$filesize=$_FILES["myfile"]["size"][$totalNumber-1];
$tempfile=$_FILES["myfile"]["tmp_name"][$totalNumber-1];
$filenameWithDirectory="store/uploaded_files/".$filename;

$str="uploaded_files/".$filename;

                              /*storing_all_data_here*/
$temp=file_get_contents("store/files.json");

$counter=0;
$array=explode(" ",$temp);  //string_to_array_to_remove_"]"_using_index

for($j=0;   $j<=count($array);  ++$j)    $counter=$j; //getting_max_len

if($counter==1){   //first_content only found
  if($filename=="") return;
  else   $temp='[{"name":"'.$filename.'","path":"'.$str.'"} ]'; //careful   with    the space   btn }--]

  $jsonfile=fopen("store/files.json","w");
  fwrite($jsonfile,$temp);
  fclose($jsonfile);
}
else{
                                    /*reducing_filename_length*/
if(strlen($filename)>18) $filename=substr($filename,0,15)."...";
                         /*saved_content_found...adding_more*/
 $array[$counter-1]="";
$temp=implode(" ",$array);  //array to String
if($filename=="") return;
 else $temp.=',{"name":"'.$filename.'","path":"'.$str.'"} ]'; //this is very important

  $jsonfile=fopen("store/files.json","w");
  fwrite($jsonfile,$temp);
  fclose($jsonfile);
}
//storing file
if(move_uploaded_file($tempfile,$filenameWithDirectory)){}
else{
    echo    "<cript>alert('file    upload   unsuccessful');</script>";
    --$savedFiles;
}
--$totalNumber;
}

echo    "<script> function sh(){ alert('".($savedFiles)." files have been successfully saved');} sh()</script>";

}




                  /*deleting files*/
if(isset($_POST["data"])){
    $package=$_POST["data"];
 $package=explode("|",$package); //to an array

for($m=1; $m<count($package); ++$m) $package[$m][0]=substr($package[$m],0,0)." ";

$temp=file_get_contents("store/files.json");  //accessing the json file
$array=explode(" ",$temp);  //converting the json data to an array for easy iteration thru the files
$counter=count($package)-1;
$str=""; 
$stop=false;
for($m=0; $m<count($array); ++$m) $array[$m][0]=substr($array[$m],0,0)." "; //removing [ and ,
$ctrl=count($array)-2;

if($counter==0) return;

$done=false;

for($j=0;   $j<=count($array)-2;  ++$j){
    for($m=0; $m<count($package)-1; ++$m){
     if($ctrl<0) break;
     if(!(json_decode($array[$j]))){break; } //handling reading an item at a wrong index incase 
        else  if((json_decode($array[$j]))->name==(json_decode($package[$m]))->name){ //if the required file is found
   try{
         unlink(json_decode($package[$m])->path); //deleting the actual file
         echo "<script>function sh(){alert('deleting complete')} sh()</script>";
        $done=true;
        } 
    catch(e){
        echo "<script>function sh(){alert('Error occured while deleting...')} sh()</script>";
    }
  
    --$ctrl;
        }
        else{  //no match
            $arra=$array[$j];

            if($array[$j][0]!="{"){
            $arra=substr($array[$j],1);
            }

            if($ctrl==$counter && $j>$ctrl || $ctrl==0){
                if($stop==true) $str.=" ,".$array[$j]." ";
                else{
                 $str.=$arra." "; //last object??...0 means one object remaining
                    $stop=true;
                }
            }
            else $str.=$arra." ,";
            --$ctrl;
        }
}
}

                        /*saving the mdified the array in the json file*/
       $str=substr($str,1); //removing leading space e.g [--{
       $num=strlen($str);
       if(substr_count($str,",")%2==0) $str=substr($str,0,$num-1); //removing excess ","
       if(substr_count($str,",",0)<2) $str=""; //no object,only ","
        else $str="[{".$str."]";
       
  $jsonfile=fopen("store/files.json","w");
  fwrite($jsonfile,$str);
  fclose($jsonfile);
}






?>