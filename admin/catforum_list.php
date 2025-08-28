<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$error = "";

$cat_get1 = text_other("arab-forums" , post_other("arab-forums" , "catorder") , false , false , false , false , true);

$cat_get2 = text_other("arab-forums" , post_other("arab-forums" , "catorder_id") , false , false , false , false , true);

$forum_get1 = text_other("arab-forums" , post_other("arab-forums" , "forumorder") , false , false , false , false , false);

$forum_get2 = text_other("arab-forums" , post_other("arab-forums" , "forumorder_id") , false , false , false , false , false);

$i = 0;

$j = 0;

while($i < count($cat_get1)){

if($cat_get1[$j] == "" || !is_numeric($cat_get1[$j])){

$error .= "1";

}

$j++;

$i++;

}

$i = 0;

$j = 0;

while($i < count($forum_get1)){

if($forum_get1[$j] == "" || !is_numeric($forum_get1[$j])){

$error .= "1";

}

$j++;

$i++;

}

if($error != ""){

$arraymsg = array(

"msg" => "الرجاء ملأ جميع الحقول ليتم إدخال الترتيب الجديد" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$i = 0;$j = 0;

while($i < count($cat_get1)){

$catoft1 = text_other("arab-forums" , $cat_get1[$j] , true , true , true , false , true);

$catoft2 = text_other("arab-forums" , $cat_get2[$i] , true , true , true , false , true);

update_mysql("arab-forums" , "cat" , "cat_order = \"{$catoft1}\" where cat_id = \"{$catoft2}\"");

$j++;$i++;

}

$i = 0;$j = 0;

while($i < count($forum_get1)){

$forumoft1 = text_other("arab-forums" , $forum_get1[$j] , true , true , true , false , true);

$forumoft2 = text_other("arab-forums" , $forum_get2[$i] , true , true , true , false , true);

update_mysql("arab-forums" , "forum" , "forum_order = \"{$forumoft1}\" where forum_id = \"{$forumoft2}\"");

$j++;$i++;

}

$arraymsg = array(

"msg" => "تم حفظ الترتيب الجديد بنجآح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=catforum&go=catforum_list&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr>";

echo "<td class=\"tcotadmin\" colspan=\"2\">إسم الفئة</td>";

echo "<td class=\"tcotadmin\" align=\"center\">الترتيب</td>";

echo "<td class=\"tcotadmin\" align=\"center\">خيارات</td>";

echo "</tr>";

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_lock , cat_hid , cat_name , cat_order" , "order by cat_order asc");

if(num_mysql("arab-forums" , $cat_sql) != false){

while($cat_object = object_mysql("arab-forums" , $cat_sql)){

echo "<tr><td class=\"tcatadmin\" width=\"100%\" colspan=\"2\">{$cat_object->cat_name}</td>";

echo "<td class=\"tcatadmin\"><input class=\"input\" type=\"text\" name=\"catorder[]\" size=\"1\" value=\"{$cat_object->cat_order}\"><input type=\"hidden\" name=\"catorder_id[]\" value=\"{$cat_object->cat_id}\"></td>";

echo "<td class=\"tcatadmin\"><table><tr>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_addforum&id={$cat_object->cat_id}" , "إضافة منتدى جديد لهذه الفئة" , img_other("arab-forums" , "images/add.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=edit&id={$cat_object->cat_id}" , "تعديل الفئة" , img_other("arab-forums" , "images/edit.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=delete&id={$cat_object->cat_id}" , "حذف الفئة" , img_other("arab-forums" , "images/delete.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الفئة ؟"))."</td>";

if($cat_object->cat_lock == 0){

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=lock&id={$cat_object->cat_id}" , "إغلاق الفئة" , img_other("arab-forums" , "images/lock.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إغلاق الفئة ؟"))."</td>";

}else{

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=nolock&id={$cat_object->cat_id}" , "فتح الفئة" , img_other("arab-forums" , "images/nolock.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد فتح الفئة ؟"))."</td>";

}

if($cat_object->cat_hid == 0){

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=hid&id={$cat_object->cat_id}" , "إخفاء الفئة" , img_other("arab-forums" , "images/hid.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إخفاء الفئة ؟"))."</td>";

}else{

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optioncat&fort=nohid&id={$cat_object->cat_id}" , "إظهار الفئة" , img_other("arab-forums" , "images/nohid.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إظهار الفئة ؟"))."</td>";

}

echo "</tr></table></td>";

echo "</tr>";

echo "<tr>";

echo "<td class=\"tcotadmin\" colspan=\"2\">إسم المنتدى</td>";

echo "<td class=\"tcotadmin\" align=\"center\">الترتيب</td>";

echo "<td class=\"tcotadmin\" align=\"center\">خيارات</td>";

echo "</tr>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_catid , forum_name , forum_wasaf , forum_order , forum_logo , forum_lock , forum_hid1" , "where forum_catid = \"{$cat_object->cat_id}\" order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" width=\"1%\">".img_other("arab-forums" , "{$forum_object->forum_logo}" , "" , "50" , "50" , "0" , "" , "")."</td>";

echo "<td class=\"alttext1\" align=\"right\"><div class=\"pad\">".a_other("arab-forums" , "forum.php?id={$forum_object->forum_id}" , "{$forum_object->forum_name}" , $forum_object->forum_name , "")."<div class=\"desc\">{$forum_object->forum_wasaf}</div></div></td>";

echo "<td class=\"alttext1\"><input class=\"input\" type=\"text\" name=\"forumorder[]\" size=\"1\" value=\"{$forum_object->forum_order}\"><input type=\"hidden\" name=\"forumorder_id[]\" value=\"{$forum_object->forum_id}\"></td>";

echo "<td class=\"alttext1\"><table><tr>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=edit&id={$forum_object->forum_id}" , "تعديل المنتدى" , img_other("arab-forums" , "images/edit.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=goshow&id={$forum_object->forum_id}" , "الأعضاء المسموح لهم بمشاهدة المنتدى" , img_other("arab-forums" , "images/goshow.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=delete&id={$forum_object->forum_id}" , "حذف المنتدى" , img_other("arab-forums" , "images/delete.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف المنتدى ؟"))."</td>";

if($forum_object->forum_lock == 0){

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=lock&id={$forum_object->forum_id}" , "إغلاق المنتدى" , img_other("arab-forums" , "images/lock.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إغلاق المنتدى ؟"))."</td>";

}else{

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=nolock&id={$forum_object->forum_id}" , "فتح المنتدى" , img_other("arab-forums" , "images/nolock.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد فتح المنتدى ؟"))."</td>";

}

if($forum_object->forum_hid1 == 0){

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=hid&id={$forum_object->forum_id}" , "إخفاء المنتدى" , img_other("arab-forums" , "images/hid.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إخفاء المنتدى ؟"))."</td>";

}else{

echo "<td>".a_other("arab-forums" , "admin.php?gert=catforum&go=catforum_optionforum&fort=nohid&id={$forum_object->forum_id}" , "إظهار المنتدى" , img_other("arab-forums" , "images/nohid.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إظهار المنتدى ؟"))."</td>";

}

echo "</tr></table></td>";

echo "</tr>";

}}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"5\"><br><div class=\"pad\">لا يوجد أي منتدى تابع للفئة حاليا</div><br></td>";

echo "</tr>";

}}

echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"4\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"4\"><br><div class=\"pad\">لا توجد أي فئة حاليا</div><br></td>";

echo "</tr>";

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>