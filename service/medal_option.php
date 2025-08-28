<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |


|  site : www.prince-algeriw.com  || www.arab-forums-sc.com             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 9) == true){

$medal_sql = select_mysql("arab-forums" , "medal" , "w.medal_id , w.medal_name , w.medal_url , w.medal_forumid , w.medal_lock , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_name , f.forum_mode" , "as w left join forum".prefix_connect." as f on(w.medal_forumid = f.forum_id) left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where medal_id in(".id.")");

if(num_mysql("arab-forums" , $medal_sql) == false){

$errorp = "الوسام المختار غير موجود ضمن قائمة الأوسمة";

}else{

$medal_object = object_mysql("arab-forums" , $medal_sql);

$moderatget1 = moderatget1_other("arab-forums" , $medal_object->forum_id , $medal_object->cat_monitor1 , $medal_object->cat_monitor2 , $medal_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $medal_object->cat_monitor1 , $medal_object->cat_monitor2);

if(($medal_object->medal_forumid == 0 && group_user != 6) || ($medal_object->medal_forumid > 0 && $moderatget1 == false)){

$errorp = "للأسف لا تملك التصريح المناسب للتحكم في خصائص هذا الوسام";

}else{

$errorp = "";

}}

if($errorp == ""){

if(fort == "edit"){

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$url = text_other("arab-forums" , post_other("arab-forums" , "url") , true , true , true , false , true);

$forumid = text_other("arab-forums" , post_other("arab-forums" , "forumid") , true , true , true , false , true);

if($name == "" || $forumid == "" || $url == ""){

$error = "الرجاء ملأ جميع الحقول ليتم التعديل على الوسام";

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

update_mysql("arab-forums" , "medal" , "medal_name = \"{$name}\" , medal_forumid = \"{$forumid}\" , medal_url = \"{$url}\" where medal_id in({$medal_object->medal_id})");

$arraymsg = array(

"msg" => "تم تعديل الوسام بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"service.php?gert=medal&go=medal_option&fort=edit&id={$medal_object->medal_id}&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">الوسام تابع للمنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

echo "<select class=\"inputselect\" name=\"forumid\">";

if(group_user == 6){

echo "<option value=\"0\" ".($medal_object->medal_forumid == 0 ? "selected" : "").">إضافة الوسام في جميع المنتديات</option>";

}

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"{$forum_object->forum_id}\" ".($medal_object->medal_forumid == $forum_object->forum_id ? "selected" : "").">{$forum_object->forum_name}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الوسام له</span>";

}

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عنوان الوسام</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$medal_object->medal_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الوسام</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">رابط صورة الوسام</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"url\" value=\"{$medal_object->medal_url}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الوسام</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الوسام الجديد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الوسام الجديد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}}elseif(fort == "wait" && $moderatget2 == true){

if($medal_object->medal_lock == 0){

$arraymsg = array(

"msg" => "الوسام موافق عليه من قبل" ,

"color" => "error" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "medal" , "medal_lock = \"0\" where medal_id in({$medal_object->medal_id})");

$arraymsg = array(

"msg" => "تم الموافقة على الوسام بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

}elseif(fort == "bad" && $moderatget2 == true){

if($medal_object->medal_lock == 2){

$arraymsg = array(

"msg" => "الوسام مرفوض من قبل" ,

"color" => "error" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "medal" , "medal_lock = \"2\" where medal_id in({$medal_object->medal_id})");

$arraymsg = array(

"msg" => "تم رفض الوسام بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

}elseif(fort == "delete" && $moderatget2 == true){

if($medal_object->medal_lock == 3){

$arraymsg = array(

"msg" => "الوسام محذوف من قبل" ,

"color" => "error" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "medal" , "medal_lock = \"3\" where medal_id in({$medal_object->medal_id})");

$arraymsg = array(

"msg" => "تم حذف الوسام بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=medal&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

}else{

$arraymsg = array(

"msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا" ,

"color" => "error" ,

"url" => "service.php?gert=catforum&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"msg" => $errorp ,

"color" => "error" ,

"url" => "service.php?gert=catforum&go=medal_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"msg" => "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |


|  site : www.prince-algeriw.com  || www.arab-forums-sc.com             |

|*#####################################################################*/
?>