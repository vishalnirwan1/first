<?php

function image_resize($target,$newcopy,$w,$h,$ext)
{
     
   list($worig, $horig) = getimagesize($target); 
   if($worig<200||$horig<200)
   {
        header("location:myprofile.php?type=4");
   }
   $ratio = $worig / $horig;
   if (($w / $h) > $ratio) {
           $w = $h * $ratio;
    } else {
           $h = $w / $ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "png"){ 
      $img = imagecreatefrompng($target);
    }
    else if($ext == "jpeg")
        { 
       //echo 'ffff';
      $img = imagecreatefromjpeg($target);
    }
    else if($ext == "jpg")
    {
       // echo 'dddd';
        $img = imagecreatefromjpg($target);
    }  
  //print_r($newcopy);die;
    $boundary = imagecreatetruecolor($w, $h);
    
    imagecopyresampled($boundary, $img, 0, 0, 0, 0, $w, $h, $worig, $horig);
    imagejpeg($boundary, $newcopy, 80);
}
?>
