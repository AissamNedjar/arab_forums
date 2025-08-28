<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../../../error.php"));}

function msg_template($copi , $array){

if($copi == "arab-forums"){

$template  = "";

$template .= bodytop_template("arab-forums" , "رسالة إدارية");

$arrayheader = array(

"login" => $array["login"] ,

);

$template .= header_template("arab-forums" , $arrayheader);

$template .= "<center><div class=\"{$array["color"]}\"><br><br>{$array["msg"]}<br>";

if($array["old"] == true){

$array["text"] = (!empty($array["text"]) ? $array["text"] : 'الذهاب إلى الصفحة الأصلية');

$array["url"] = (!empty($array["url"]) ? $array["url"] : referer);

$template .= "<ul>";

$template .= "<li>".a_other("arab-forums" , "{$array["url"]}" , "{$array["text"]}" , "{$array["text"]}" , "")."</li>";

if($array["auto"] == true){

$template .= "<meta http-equiv=\"refresh\" content=\"3; url={$array["url"]}\">";

}}

if(is_array($array["array"])){

if($array["old"] == false){

$template .= "<ul>";

}

for($x = 0; $x < count($array["array"]); $x+=2){
 
$template .= "<li>".a_other("arab-forums" , "{$array["array"][$x+1]}" , "{$array["array"][$x]}" , "{$array["array"][$x]}" , "")."</li>";

}

$template .= "</ul>";

}

if($array["old"] == true && !is_array($array["array"])){

$template .= "</ul>";

}

$template .= "<br><br></div></center>";

$template .= footer_template("arab-forums");

$template .= bodybottom_template("arab-forums");

return $template;

}}

function msgadmin_template($copi , $array){

if($copi == "arab-forums"){

$template  = "";

$template .= "<br><br><center><div class=\"{$array["color"]}\"><br><br>{$array["msg"]}<br>";

$array["url"] = (!empty($array["url"]) ? $array["url"] : referer);

$template .= "<ul>";

$template .= "<li>".a_other("arab-forums" , "{$array["url"]}" , "الذهاب إلى الصفحة الأصلية" , "الذهاب إلى الصفحة الأصلية" , "")."</li>";

$template .= "</ul>";

$template .= "<br><br></div></center><br><br>";

return $template;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>