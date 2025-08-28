<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$title = text_other("arab-forums" , post_other("arab-forums" , "title") , true , true , true , false , true);

$adress = text_other("arab-forums" , post_other("arab-forums" , "adress") , true , true , true , false , true);

$showurl = text_other("arab-forums" , post_other("arab-forums" , "showurl") , true , true , true , false , true);

$email = text_other("arab-forums" , post_other("arab-forums" , "email") , true , true , true , false , true);

$ico = text_other("arab-forums" , post_other("arab-forums" , "ico") , true , true , true , false , true);

$description = text_other("arab-forums" , post_other("arab-forums" , "description") , true , true , true , false , true);

$keywords = text_other("arab-forums" , post_other("arab-forums" , "keywords") , true , true , true , false , true);

if($title == "" || $adress == "" || $showurl == "" || $email == "" || $ico == "" || $description == "" || $keywords == ""){

$error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";

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

update_mysql("arab-forums" , "option" , "option_value = \"{$title}\" where option_name = \"title\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$adress}\" where option_name = \"adress\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$showurl}\" where option_name = \"showurl\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$email}\" where option_name = \"emailbiot\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$ico}\" where option_name = \"ico\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$description}\" where option_name = \"description\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$keywords}\" where option_name = \"keywords\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=option&go=option_option" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=option&go=option_option&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">إسم المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"title\" value=\"".title_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم المنتدى الخاص بك</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رابط المنتدى للحقوق</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"adress\" value=\"".adress_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الرابط الخاص بمنتداك ليتم حفظ الحقوق أسفل المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رابط المنتدى للبريد الإلكتروني</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"showurl\" value=\"".showurl_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الرابط الخاص بمنتداك كاملا ليتم إرساله في رسائل البريد الإلكتروني بدون أخطاء</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إيميل المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"email\" value=\"".emailbiot_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إيميل المنتدى ليتم وضعه في عدة أماكن للتواصل مع الإدارة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">favicon ico</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"ico\" value=\"".ico_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الصورة الخاصة برابط المنتدى التي تأتي أعلا المتصفح</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">وصف المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:600px\" class=\"input\" name=\"description\" value=\"".description_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الوصف الخاص بمنتداك و لا يجب أن يكون طويل</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">الكلمات المفتاحية</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:600px\" class=\"input\" name=\"keywords\" value=\"".keywords_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الكلمات المفتاحية الخاصة بمنتداك و أفصل بين كلمة و أخرى ب ,</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>