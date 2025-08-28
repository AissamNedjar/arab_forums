<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 12) == true){

$texttopic_sql = select_mysql("arab-forums" , "texttopic" , "a.texttopic_id , a.texttopic_name , a.texttopic_forumid , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_name , f.forum_mode" , "as a left join forum".prefix_connect." as f on(a.texttopic_forumid = f.forum_id) left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where texttopic_id in(".id.")");

if(num_mysql("arab-forums" , $texttopic_sql) == false){

$errorp = "الإختصار المختار غير موجودة ضمن قائمة الإختصارات";

}else{

$texttopic_object = object_mysql("arab-forums" , $texttopic_sql);

$moderatget1 = moderatget1_other("arab-forums" , $texttopic_object->forum_id , $texttopic_object->cat_monitor1 , $texttopic_object->cat_monitor2 , $texttopic_object->forum_mode);

if(($texttopic_object->texttopic_forumid == 0 && group_user != 6) || ($texttopic_object->texttopic_forumid > 0 && $moderatget1 == false)){

$errorp = "للأسف لا تملك التصريح المناسب لتعديل أو حذف هذا الإختصار";

}else{

$errorp = "";

}}

if($errorp == ""){

if(fort == "edit"){

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$forumid = text_other("arab-forums" , post_other("arab-forums" , "forumid") , true , true , true , false , true);

if($name == "" || $forumid == ""){

$error = "الرجاء ملأ جميع الحقول ليتم التعديل على الإختصار";

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

update_mysql("arab-forums" , "texttopic" , "texttopic_name = \"{$name}\" , texttopic_forumid = \"{$forumid}\" where texttopic_id in({$texttopic_object->texttopic_id})");

$arraymsg = array(

"msg" => "تم تعديل الإختصار بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=texttopic&go=texttopic_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"service.php?gert=texttopic&go=texttopic_option&fort=edit&id={$texttopic_object->texttopic_id}&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">الإختصار تابع لمنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

echo "<select class=\"inputselect\" name=\"forumid\">";

if(group_user == 6){

echo "<option value=\"0\" ".($texttopic_object->texttopic_forumid == 0 ? "selected" : "").">إضافة الإختصار في جميع المنتديات</option>";

}

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"{$forum_object->forum_id}\" ".($texttopic_object->texttopic_forumid == $forum_object->forum_id ? "selected" : "").">{$forum_object->forum_name}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الإختصار له</span>";

}

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إسم الإختصار</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$texttopic_object->texttopic_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم الإختصار</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}}elseif(fort == "delete"){

update_mysql("arab-forums" , "topic" , "topic_text = \"0\" where topic_text in({$texttopic_object->texttopic_id})");

delete_mysql("arab-forums" , "texttopic" , "texttopic_id in({$texttopic_object->texttopic_id})");

$arraymsg = array(

"msg" => "تم حذف الإختصار بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=texttopic&go=texttopic_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا" ,

"color" => "error" ,

"url" => "service.php?gert=catforum&go=texttopic_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"msg" => $errorp ,

"color" => "error" ,

"url" => "service.php?gert=catforum&go=texttopic_list" ,

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

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>