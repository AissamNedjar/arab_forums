<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$order = text_other("arab-forums" , post_other("arab-forums" , "order") , true , true , true , false , true);

$link = text_other("arab-forums" , post_other("arab-forums" , "link") , true , true , true , false , true);

$images = text_other("arab-forums" , post_other("arab-forums" , "images") , true , true , true , false , true);

if($name == "" || $order == "" || $link == "" || $images == ""){

$error = "الرجاء ملأ جميع الحقول ليتم إدخال الموضوع الجديد في السلايد";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب الموضوع في السلايد صحيحة";

}else{

$error = "";

}

if($error != ""){

$arraymsg = array(

"msg" => $error ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

insert_mysql("arab-forums" , "slide" , "slide_id , slide_order , slide_name , slide_link , slide_images" , "null , \"{$order}\" , \"{$name}\" , \"{$link}\" , \"{$images}\"");

$arraymsg = array(

"msg" => "تم إدخال الموضوع الجديد في السلايد بنجاح تام" ,

"color" => "good" ,

"url" => "plugin.php?gert=slide&go=slide_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"plugin.php?gert=slide&go=slide_add&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">عنوان الموضوع في السلايد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الموضوع في السلايد</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رقم الموضوع للسلايد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:100px\" class=\"input\" name=\"link\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رقم الموضوع الذي يأدي إليه السلايد</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">صورة الموضوه في السلايد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الموضوع في السلايد التي تظهر في الهايدر</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب الموضوع في السلايد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"1\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالموضوع في السلايد و إن كنت لا تريده مرتب أتركه 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الموضوع الجديد في السلايد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الموضوع الجديد في السلايد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>