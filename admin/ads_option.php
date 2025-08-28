<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$ads_sql = select_mysql("arab-forums" , "ads" , "ads_id , ads_lock , ads_order , ads_open , ads_br , ads_name , ads_link , ads_images" , "where ads_id in(".id.")");

if(num_mysql("arab-forums" , $ads_sql) != false){

$ads_object = object_mysql("arab-forums" , $ads_sql);

if(fort == "edit"){

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$order = text_other("arab-forums" , post_other("arab-forums" , "order") , true , true , true , false , true);

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

$open = text_other("arab-forums" , post_other("arab-forums" , "open") , true , true , true , false , true);

$br = text_other("arab-forums" , post_other("arab-forums" , "br") , true , true , true , false , true);

$link = text_other("arab-forums" , post_other("arab-forums" , "link") , true , true , true , false , true);

$images = text_other("arab-forums" , post_other("arab-forums" , "images") , true , true , true , false , true);

if($name == "" || $order == "" || $lock == "" || $open == "" || $br == "" || $link == "" || $images == ""){

$error = "الرجاء ملأ جميع الحقول ليتم التعديل على الإعلان";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب الإعلان صحيحة";

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

update_mysql("arab-forums" , "ads" , "ads_lock = \"{$lock}\" , ads_order = \"{$order}\" , ads_open = \"{$open}\" , ads_br = \"{$br}\" , ads_name = \"{$name}\" , ads_link = \"{$link}\" , ads_images = \"{$images}\" where ads_id in({$ads_object->ads_id})");

$arraymsg = array(

"msg" => "تم تعديل الإعلان بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=ads&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=ads&go=ads_option&fort=edit&id={$ads_object->ads_id}&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">عنوان الإعلان</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$ads_object->ads_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الإعلان</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رابط الإعلان</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"link\" value=\"{$ads_object->ads_link}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الرابط الذي تأدي إليه الإعلان و يجب أن يكون مسبوق ب http://www</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">صورة الإعلان</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"{$ads_object->ads_images}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الإعلان التي تظهر في الهايدر</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب الإعلان</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"{$ads_object->ads_order}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالإعلان و إن كنت لا تريده مرتب أتركه 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">تعطيل الإعلان</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"lock\">";

echo "<option value=\"0\" ".($ads_object->ads_lock == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($ads_object->ads_lock == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الإعلان معطل ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">فتح الإعلان في صفحة مستقلة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"open\">";

echo "<option value=\"0\" ".($ads_object->ads_open == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($ads_object->ads_open == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل رابط الإعلان يفتح في صفحة مستقلة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور الإعلان في سطر جديد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"br\">";

echo "<option value=\"0\" ".($ads_object->ads_br == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($ads_object->ads_br == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الإعلان يوضع في سطر جديد أي تحت الإعلانات السابقة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}}elseif(fort == "delete"){

delete_mysql("arab-forums" , "ads" , "ads_id in({$ads_object->ads_id})");

$arraymsg = array(

"msg" => "تم حذف الإعلان بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=ads&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "lock"){

if($ads_object->ads_lock == 1){$error = false;$text = "الإعلان معطل من قبل";$class = "error";}else{$error = true;$text = "تم تعطيل الإعلان بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "ads" , "ads_lock = \"1\" where ads_id = \"{$ads_object->ads_id}\"");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=ads&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "nolock"){

if($ads_object->ads_lock == 0){$error = false;$text = "الإعلان مفعل من قبل";$class = "error";}else{$error = true;$text = "تم تفعيل الإعلان بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "ads" , "ads_lock = \"0\" where ads_id = \"{$ads_object->ads_id}\"");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=ads&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا" ,

"color" => "error" ,

"url" => "admin.php?gert=catforum&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"msg" => "الإعلان المختار غير موجود ضمن قائمة الإعلانات" ,

"color" => "error" ,

"url" => "admin.php?gert=catforum&go=ads_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>