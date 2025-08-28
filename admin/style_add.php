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

$fils = text_other("arab-forums" , post_other("arab-forums" , "fils") , true , true , true , false , true);

$order = text_other("arab-forums" , post_other("arab-forums" , "order") , true , true , true , false , true);

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

if($name == "" || $order == "" || $lock == "" || $fils == ""){

$error = "الرجاء ملأ جميع الحقول ليتم إدخال الستايل الجديد";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب الستايل صحيحة";

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

insert_mysql("arab-forums" , "style" , "style_id , style_name , style_lock , style_order , style_fils , style_default" , "null , \"{$name}\" , \"{$lock}\" , \"{$order}\" , \"{$fils}\" , \"0\"");

$arraymsg = array(

"msg" => "تم إدخال الستايل الجديد بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=style&go=style_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=style&go=style_add&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">عنوان الستايل</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الستايل</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">مجلد الستايل</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"fils\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم مجلد الستايل</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب الستايل</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"1\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالستايل و إن كنت لا تريده مرتب أتركه 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">تعطيل الستايل</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"lock\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الستايل معطل ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الستايل الجديد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الستايل الجديد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>