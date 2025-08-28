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

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

$open = text_other("arab-forums" , post_other("arab-forums" , "open") , true , true , true , false , true);

$link = text_other("arab-forums" , post_other("arab-forums" , "link") , true , true , true , false , true);

$images = text_other("arab-forums" , post_other("arab-forums" , "images") , true , true , true , false , true);

$group0 = text_other("arab-forums" , post_other("arab-forums" , "group0") , true , true , true , false , true);

$group1 = text_other("arab-forums" , post_other("arab-forums" , "group1") , true , true , true , false , true);

$group2 = text_other("arab-forums" , post_other("arab-forums" , "group2") , true , true , true , false , true);

$group3 = text_other("arab-forums" , post_other("arab-forums" , "group3") , true , true , true , false , true);

$group4 = text_other("arab-forums" , post_other("arab-forums" , "group4") , true , true , true , false , true);

$group5 = text_other("arab-forums" , post_other("arab-forums" , "group5") , true , true , true , false , true);

if($name == "" || $order == "" || $lock == "" || $open == "" || $link == "" || $images == "" || $group0 == "" || $group1 == "" || $group2 == "" || $group3 == "" || $group4 == "" || $group5 == ""){

$error = "الرجاء ملأ جميع الحقول ليتم إدخال الأيقونة الجديدة";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب الأيقونة صحيحة";

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

insert_mysql("arab-forums" , "iconsheader" , "iconsheader_id , iconsheader_lock , iconsheader_order , iconsheader_open , iconsheader_name , iconsheader_link , iconsheader_images , iconsheader_group0 , iconsheader_group1 , iconsheader_group2 , iconsheader_group3 , iconsheader_group4 , iconsheader_group5" , "null , \"{$lock}\" , \"{$order}\" , \"{$open}\" , \"{$name}\" , \"{$link}\" , \"{$images}\" , \"{$group0}\" , \"{$group1}\" , \"{$group2}\" , \"{$group3}\" , \"{$group4}\" , \"{$group5}\"");

$arraymsg = array(

"msg" => "تم إدخال الأيقونة الجديدة بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=iconsheader&go=iconsheader_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=iconsheader&go=iconsheader_add&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">عنوان الأيقونة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الأيقونة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رابط الأيقونة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"link\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الرابط الذي تأدي إليه الأيقونة و يجب أن يكون مسبوق ب http://www</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">صورة الأيقونة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الأيقونة التي تظهر في الهايدر</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب الأيقونة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"1\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالأيقونة و إن كنت لا تريدها مرتبة أتركها 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">تعطيل الأيقونة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"lock\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الأيقونة معطلة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">فتح الأيقونة في صفحة مستقلة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"open\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل رابط الأيقونة يفتح في صفحة مستقلة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور الأيقونة للمجموعات</td></tr>";

for($x = 0; $x <= 5; $x++){

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"group{$x}\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الأيقونة تظهر لمجموعة {$group_list[$x]} ؟</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الأيقونة الجديدة\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الأيقونة الجديدة ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>