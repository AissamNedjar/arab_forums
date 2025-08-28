<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_name , cat_order , cat_lock , cat_hid , cat_group0 , cat_group1 , cat_group2 , cat_group3 , cat_group4 , cat_group5 , cat_post1 , cat_post2 , cat_post3 , cat_post4 , cat_post5 , cat_monitor1 , cat_monitor1text , cat_monitor2 , cat_monitor2text , cat_home" , "where cat_id in(".id.")");

if(num_mysql("arab-forums" , $cat_sql) != false){

$cat_object = object_mysql("arab-forums" , $cat_sql);

if(fort == "edit"){

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$order = text_other("arab-forums" , post_other("arab-forums" , "order") , true , true , true , false , true);

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

$hid = text_other("arab-forums" , post_other("arab-forums" , "hid") , true , true , true , false , true);

$group0 = text_other("arab-forums" , post_other("arab-forums" , "group0") , true , true , true , false , true);

$group1 = text_other("arab-forums" , post_other("arab-forums" , "group1") , true , true , true , false , true);

$group2 = text_other("arab-forums" , post_other("arab-forums" , "group2") , true , true , true , false , true);

$group3 = text_other("arab-forums" , post_other("arab-forums" , "group3") , true , true , true , false , true);

$group4 = text_other("arab-forums" , post_other("arab-forums" , "group4") , true , true , true , false , true);

$group5 = text_other("arab-forums" , post_other("arab-forums" , "group5") , true , true , true , false , true);

$post1 = text_other("arab-forums" , post_other("arab-forums" , "post1") , true , true , true , false , true);

$post2 = text_other("arab-forums" , post_other("arab-forums" , "post2") , true , true , true , false , true);

$post3 = text_other("arab-forums" , post_other("arab-forums" , "post3") , true , true , true , false , true);

$post4 = text_other("arab-forums" , post_other("arab-forums" , "post4") , true , true , true , false , true);

$post5 = text_other("arab-forums" , post_other("arab-forums" , "post5") , true , true , true , false , true);

$monitor1 = text_other("arab-forums" , post_other("arab-forums" , "monitor1") , true , true , true , false , true);

$monitor1text = text_other("arab-forums" , post_other("arab-forums" , "monitor1text") , true , true , true , false , true);

$monitor2 = text_other("arab-forums" , post_other("arab-forums" , "monitor2") , true , true , true , false , true);

$monitor2text = text_other("arab-forums" , post_other("arab-forums" , "monitor2text") , true , true , true , false , true);

$home = text_other("arab-forums" , post_other("arab-forums" , "home") , true , true , true , false , true);

if($name == "" || $order == "" || $lock == "" || $hid == "" || $group0 == "" || $group1 == "" || $group2 == "" || $group3 == "" || $group4 == "" || $group5 == "" || $post1 == "" || $post2 == "" || $post3 == "" || $post4 == "" || $post5 == "" || $monitor1 == "" || $monitor1text == "" || $monitor2 == "" || $monitor2text == "" || $home == ""){

$error = "الرجاء ملأ جميع الحقول ليتم التعديل على الفئة";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب الفئة صحيحة";

}elseif(!is_numeric($monitor1)){

$error = "يجب أن تكون قيمة مراقب الفئة صحيحة";

}elseif(!is_numeric($monitor2)){

$error = "يجب أن تكون قيمة نائب مراقب الفئة صحيحة";

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

update_mysql("arab-forums" , "cat" , "cat_name = \"{$name}\" , cat_order= \"{$order}\" , cat_lock = \"{$lock}\" , cat_hid = \"{$hid}\" , cat_group0 = \"{$group0}\" , cat_group1 = \"{$group1}\" , cat_group2 = \"{$group2}\" , cat_group3 = \"{$group3}\" , cat_group4 = \"{$group4}\" , cat_group5 = \"{$group5}\" , cat_post1 = \"{$post1}\" , cat_post2 = \"{$post2}\" , cat_post3 = \"{$post3}\" , cat_post4 = \"{$post4}\" , cat_post5 = \"{$post5}\" , cat_monitor1 = \"{$monitor1}\" , cat_monitor1text = \"{$monitor1text}\" , cat_monitor2 = \"{$monitor2}\" , cat_monitor2text = \"{$monitor2text}\" , cat_home = \"{$home}\" where cat_id in({$cat_object->cat_id})");

$arraymsg = array(

"msg" => "تم تعديل الفئة بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=catforum&go=catforum_optioncat&fort=edit&id={$cat_object->cat_id}&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">عنوان الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$cat_object->cat_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الفئة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"{$cat_object->cat_order}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالفئة و إن كنت لا تريدها مرتبة أتركها 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">غلق الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"lock\">";

echo "<option value=\"0\" ".($cat_object->cat_lock == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($cat_object->cat_lock == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الفئة مغلوقة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إخفاء الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"hid\">";

echo "<option value=\"0\" ".($cat_object->cat_hid == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($cat_object->cat_hid == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الفئة مخفية ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إخفاء الفئة و منتدياتها من الرئيسية</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"home\">";

echo "<option value=\"0\" ".($cat_object->cat_home == 0 ? "selected" : "").">لآ</option>";

echo "<option value=\"1\" ".($cat_object->cat_home == 1 ? "selected" : "").">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الفئة و منتدياتها لآ تظهر في الرئيسية ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور الفئة للمجموعات</td></tr>";

$groupup = array($cat_object->cat_group0 , $cat_object->cat_group1 , $cat_object->cat_group2 , $cat_object->cat_group3 , $cat_object->cat_group4 , $cat_object->cat_group5);

for($x = 0; $x <= 5; $x++){

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"group{$x}\">";

echo "<option value=\"1\" ".($groupup[$x] == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".($groupup[$x] == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الفئة تظهر لمجموعة {$group_list[$x]} ؟</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"tcotadmin\">السمآح للمجموعات بكتابة مواضيع و مشاركات في الفئة</td></tr>";

$groupup = array("" , $cat_object->cat_post1 , $cat_object->cat_post2 , $cat_object->cat_post3 , $cat_object->cat_post4 , $cat_object->cat_post5);

for($x = 1; $x <= 5; $x++){

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"post{$x}\">";

echo "<option value=\"1\" ".($groupup[$x] == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".($groupup[$x] == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تستطيع مجموعة {$group_list[$x]} كتابة مواضيع و مشاركات في الفئة ؟</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"tcotadmin\">مراقب الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"monitor1\" value=\"{$cat_object->cat_monitor1}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">ضع رقم العضو الذي تريد تعيينه كمراقب على الفئة و إن كنت تريدها بدون مراقب أكتب 0</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"monitor1text\">";

echo "<option value=\"1\" ".($cat_object->cat_monitor1text == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".($cat_object->cat_monitor1text == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">ظهور مراقب الفئة في الرئيسية و داخل معلومات المنتديات و داخل بيانات المراقب ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">نائب مراقب الفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"monitor2\" value=\"{$cat_object->cat_monitor2}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">ضع رقم العضو الذي تريد تعيينه كنائب مراقب على الفئة و إن كنت تريدها بدون نائب مراقب أكتب 0</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"monitor2text\">";

echo "<option value=\"1\" ".($cat_object->cat_monitor2text == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".($cat_object->cat_monitor2text == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">ظهور نائب مراقب الفئة في الرئيسية و داخل معلومات المنتديات و داخل بيانات نائب المراقب ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}}elseif(fort == "delete"){

delete_mysql("arab-forums" , "cat" , "cat_id in({$cat_object->cat_id})");

$arraymsg = array(

"msg" => "تم حذف الفئة بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "lock"){

if($cat_object->cat_lock == 1){$error = false;$text = "الفئة مغلوقة من قبل";$class = "error";}else{$error = true;$text = "تم غلق الفئة بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "cat" , "cat_lock = \"1\" where cat_id in({$cat_object->cat_id})");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "nolock"){

if($cat_object->cat_lock == 0){$error = false;$text = "الفئة مفتوحة من قبل";$class = "error";}else{$error = true;$text = "تم فتح الفئة بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "cat" , "cat_lock = \"0\" where cat_id in({$cat_object->cat_id})");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "hid"){

if($cat_object->cat_hid == 1){$error = false;$text = "الفئة مخفية من قبل";$class = "error";}else{$error = true;$text = "تم إخفاء الفئة بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "cat" , "cat_hid = \"1\" where cat_id in({$cat_object->cat_id})");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}elseif(fort == "nohid"){

if($cat_object->cat_hid == 0){$error = false;$text = "الفئة ظاهرة من قبل";$class = "error";}else{$error = true;$text = "تم إظهار الفئة بنجاح تام";$class = "good";}

if($error == true){update_mysql("arab-forums" , "cat" , "cat_hid = \"0\" where cat_id in({$cat_object->cat_id})");}

$arraymsg = array(

"msg" => $text ,

"color" => $class ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا" ,

"color" => "error" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"msg" => "الفئة المختارة غير موجودة ضمن قائمة الفئات" ,

"color" => "error" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

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