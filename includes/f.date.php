<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function times_date($copi , $get , $time1){

if($copi == "arab-forums"){

$days = array(

"Sun" => "الأحد" , 

"Mon" => "الإثنين" , 

"Tue" => "الثلاثاء" , 

"Wed" => "الأربعاء" , 

"Thu" => "الخميس" , 

"Fri" => "الجمعة" , 

"Sat" => "السبت");

$months = array(

"01" => "جانفي" , 

"02" => "فيفري" , 

"03" => "مارس" , 

"04" => "أفريل" , 

"05" => "ماي" , 

"06" => "جوان" , 

"07" => "جويلية" , 

"08" => "أوت" , 

"09" => "سبتمبر" , 

"10" => "أكتوبر" , 

"11" => "نوفمبر" , 

"12" => "ديسمبر");

$time1 = ($time1+(60 * 60 * forum_time));

$time = (time()+(60 * 60 * forum_time));

$y = gmdate("Y" , $time1);

$m = gmdate("m" , $time1);

$d = gmdate("d" , $time1);

$h = gmdate("H" , $time1);

$i = gmdate("i" , $time1);

$s = gmdate("s" , $time1);

$ny = gmdate("Y" , $time);

$nm = gmdate("m" , $time);

$nd = gmdate("d" , $time);

$nh = gmdate("H" , $time);

$ni = gmdate("i" , $time);

$ns = gmdate("s" , $time);

$history = "";

if($get == "time"){

$history .= "<span style=\"color:#490f71;\">{$h}:{$i}</span>";

}elseif($get == "date"){

$history .= "<span style=\"color:#531818;\">{$days[gmdate("D" , $time1)]}</span> <span style=\"color:#005d78;\">{$d}</span> <span style=\"color:#531818;\">{$months[$m]}</span> <span style=\"color:#005d78;\">{$y}</span>";

}elseif($get == "datetime"){

$history .= "<span style=\"color:#531818;\">{$days[gmdate("D" , $time1)]}</span> <span style=\"color:#005d78;\">{$d}</span> <span style=\"color:#531818;\">{$months[$m]}</span> <span style=\"color:#005d78;\">{$y}</span> - <span style=\"color:#490f71;\">{$h}:{$i}</span>";

}else{

$ye = ($y == $ny ? "" : "{$y}/");

if($d == $nd && $m == $nm && $y == $ny){

$history .= "<span style=\"color:#531818;\">اليوم - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}elseif($d == ($nd-1) && $m == $nm && $y == $ny){

$history .= "<span style=\"color:#531818;\">يوم أمس - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}else{

$history .= "<span style=\"color:#531818;\">{$ye}{$m}/{$d} - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}}

return $history;

}}

function timesrss_date($copi , $time1){

if($copi == "arab-forums"){

$time1 = ($time1+(60 * 60 * forum_time));

$time = (time()+(60 * 60 * forum_time));

$y = gmdate("Y" , $time1);

$m = gmdate("m" , $time1);

$d = gmdate("d" , $time1);

$h = gmdate("H" , $time1);

$i = gmdate("i" , $time1);

$s = gmdate("s" , $time1);

$ny = gmdate("Y" , $time);

$nm = gmdate("m" , $time);

$nd = gmdate("d" , $time);

$nh = gmdate("H" , $time);

$ni = gmdate("i" , $time);

$ns = gmdate("s" , $time);

$history = "";

$ye = ($y == $ny ? "" : "{$y}/");

if($d == $nd && $m == $nm && $y == $ny){

$history .= "اليوم - {$h}:{$i}";

}elseif($d == ($nd-1) && $m == $nm && $y == $ny){

$history .= "يوم أمس - {$h}:{$i}";

}else{

$history .= "{$ye}{$m}/{$d} - {$h}:{$i}";

}

return $history;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>