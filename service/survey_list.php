<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(is_numeric(value) && allowedin3_other("arab-forums" , value , 1) == false){

$error = "للأسف لا يمكنك عرض الإستفتاءات في هذا المنتدى لأنك لا تملك التصريح المناسب";

}else{

$error = "";

}

if($error == ""){

$allyu  = text_other("arab-forums" , post_other("arab-forums" , "allyu") , false , false , false , false , false);

$wait  = text_other("arab-forums" , post_other("arab-forums" , "wait") , false , false , false , false , false);

$lock  = text_other("arab-forums" , post_other("arab-forums" , "lock") , false , false , false , false , false);

$import = @implode("," , $allyu);

if(isset($wait)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد إستفتاء وآحد على الأقل ليتم الموافقة عليه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "survey" , "survey_lock = \"0\" where survey_id in({$import})");

$arraymsg = array(

"msg" => "تم الموافقة على الإستفتاءات المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($lock)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد إستفتاء وآحد على الأقل ليتم غلقه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "survey" , "survey_lock = \"2\" where survey_id in({$import})");

$arraymsg = array(

"msg" => "تم غلق الإستفتاءات المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($delete)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد إستفتاء وآحد على الأقل ليتم حذفه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "survey" , "survey_lock = \"3\" where survey_id in({$import})");

$arraymsg = array(

"msg" => "تم حذف الإستفتاءات المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

if(type == "wait"){

$sqlo = "w.survey_lock in(1)";

$sqly = "survey_lock in(1)";

$texto = "تعرض الإستفتاءات التي تنتظر الموافقة";

$urlo = "&type=wait";

}elseif(type == "bad"){

$sqlo = "w.survey_lock in(2)";

$sqly = "survey_lock in(2)";

$texto = "تعرض الإستفتاءات المرفوضة";

$urlo = "&type=bad";

}elseif(type == "delete"){

$sqlo = "w.survey_lock in(3)";

$sqly = "survey_lock in(3)";

$texto = "تعرض الإستفتاءات المحذوفة";

$urlo = "&type=delete";

}else{

$sqlo = "w.survey_lock in(0)";

$sqly = "survey_lock in(0)";

$texto = "تعرض الإستفتاءات السارية حالية";

$urlo = "";

}

if(is_numeric(value)){

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name" , "where forum_id in(".value.") limit 1");

$forum_object = object_mysql("arab-forums" , $forum_sql);

$textu = "عرض الإستفتاءات في : {$forum_object->forum_name}";

$urlp = "&value={$forum_object->forum_id}";

$sqlp = "&& w.survey_forumid in({$forum_object->forum_id})";

$sqlu = "&& survey_forumid in({$forum_object->forum_id})";

}else{

$textu = "عرض جميع الإستفتاءات في المنتديات التي أشرف عليها";

$urlp = "";

$sqlp = "&& (w.survey_forumid in(0) || w.survey_forumid in(".allowedin1_other("arab-forums")."))";

$sqlu = "&& (survey_forumid in(0) || survey_forumid in(".allowedin1_other("arab-forums")."))";

}

$count_page = tother_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}<br><br>{$texto}</span></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض الإستفتاءات</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=survey&go=survey_list{$urlp}\" ".(type == "" ? "selected" : "").">السارية حاليا</option>";

echo "<option value=\"service.php?gert=survey&go=survey_list{$urlp}&type=wait\" ".(type == "wait" ? "selected" : "").">التي تنتظر الموافقة</option>";

echo "<option value=\"service.php?gert=survey&go=survey_list{$urlp}&type=bad\" ".(type == "bad" ? "selected" : "").">المرفوضة</option>";

echo "<option value=\"service.php?gert=survey&go=survey_list{$urlp}&type=delete\" ".(type == "delete" ? "selected" : "").">المحذوفة</option>";

echo "</select></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض أوصاف</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=survey&go=survey_list{$urlo}\" ".(value == "" ? "selected" : "").">عرض الإستفتاءات التابعة للمنتديات التي أشرف عليها</option>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"service.php?gert=survey&go=survey_list&value={$forum_object->forum_id}{$urlo}\" ".(value == "{$forum_object->forum_id}" ? "selected" : "").">عرض أوصاف {$forum_object->forum_name}</option>";

}}

echo "</select></div></td>";

echo page_pager("arab-forums" , "survey" , "survey_id , survey_forumid , survey_lock" , "where {$sqly} {$sqlu}" , $count_page , $get_page , "service.php?gert=survey&go=survey_list{$urlp}{$urlo}&");

echo "</tr></table>";

if(group_user > 2){

echo "<form action=\"".self."\" method=\"post\">";

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

if(type == "wait" || type == "delete" || type == "bad"){

echo "<td><nobr><input class=\"button\" value=\"الموافقة على الإستفتاءات المحددة\" type=\"submit\" name=\"wait\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على الإستفتاءات المحددة ؟")."></nobr></td>";

}

if(type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"رفض الإستفتاءات المحددة\" type=\"submit\" name=\"bad\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد رفض الإستفتاءات المحددة ؟")."></nobr></td>";

}

if(type == "" || type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"حذف الإستفتاءات المحددة\" type=\"submit\" name=\"delete\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الإستفتاءات المحددة ؟")."></nobr></td>";

}

echo "<td width=\"100%\"></td>";

echo "</tr></table>";

}
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

$inputtext = array(

1 => "تحديد جميع الإستفتاءات" ,

2 => "إلغاء تحديد جميع الإستفتاءات" ,

3 => "لا توجد أوصاف بالصفحة حاليا" ,

4 => "عدد الإستفتاءات الذي إخترت هو :" ,

5 => "الإستفتاء" ,

);

echo "<tr>";

if(group_user > 2){

echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

}

echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\">الإستفتاء</td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تمت الإضافة بواسطة</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تاريخ الإضافة</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">المنتدى</td>";

echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\"><nobr>خيارات</nobr></td>";

echo "</tr>";

$survey_sql = select_mysql("arab-forums" , "survey" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , f.forum_id , f.forum_name , w.survey_id , w.survey_forumid , w.survey_forumall , w.survey_lock , w.survey_add , w.survey_date , w.survey_name" , "as w left join user".prefix_connect." as u on(u.user_id = w.survey_add) left join forum".prefix_connect." as f on(f.forum_id = w.survey_forumid) where {$sqlo} {$sqlp} order by w.survey_date desc limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $survey_sql) != false){

while($survey_object = object_mysql("arab-forums" , $survey_sql)){

echo "<tr class=\"alttext1\" id=\"tr_{$survey_object->survey_id}\" align=\"center\">";

if(group_user > 2){

if(($survey_object->survey_forumid > 0) || ($survey_object->survey_forumid == 0 && group_user == 6)){

echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$survey_object->survey_id}' , 'alttext1' , 'الإستفتاء' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الإستفتاء\" value=\"{$survey_object->survey_id}\"><input type=\"hidden\" name=\"bg_{$survey_object->survey_id}\" id=\"bg_{$survey_object->survey_id}\" value=\"alttext1\"></div></td>";

}}

echo "<td><div class=\"pad\" align=\"right\">{$survey_object->survey_name}<br><br><span style=\"color:red;font-size:10px;\">".($survey_object->survey_forumall == 1 ? "يظهر في جميع المنتديات" : "يظهر في المنتدى التابع له فقط")."</span><br><br><span style=\"color:green;font-size:10px;\">رقم الإستفتاء للتوزيع : {$survey_object->survey_id}</span></div></td>";

echo "<td align=\"center\"><div class=\"pad\">".user_other("arab-forums" , array($survey_object->user_id , $survey_object->user_group , $survey_object->user_nameuser , $survey_object->user_lock1 , $survey_object->user_coloruser , false))."</div></td>";

echo "<td align=\"center\"><div class=\"pad\">".times_date("arab-forums" , "" , $survey_object->survey_date)."</div></td>";

echo "<td><div class=\"pad\"><span style=\"color:orange;font-size:12px;\">".($survey_object->survey_forumid != 0 ? a_other("arab-forums" , "forum.php?id={$survey_object->forum_id}" , "{$survey_object->forum_name}" , "{$survey_object->forum_name}" , "") : "في جميع المنتديات")."</span></div></td>";

echo "<td align=\"center\"><table><tr>";

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_listgo&id={$survey_object->survey_id}" , "مشاهدة على من وزع الإستفتاء" , img_other("arab-forums" , "images/goshow.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

if(($survey_object->survey_forumid == 0 && group_user == 6) || ($survey_object->survey_forumid > 0)){

if($survey_object->survey_lock == 0){

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_option&fort=edit&id={$survey_object->survey_id}" , "تعديل الإستفتاء" , img_other("arab-forums" , "images/edit.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_goall&plase={$survey_object->survey_id}" , "توزيع جماعي للإستفتاء" , img_other("arab-forums" , "images/replytop.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_goone&plase={$survey_object->survey_id}" , "توزيع فردي للإستفتاء" , img_other("arab-forums" , "images/replynotop.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

}

if(group_user > 2){

if($survey_object->survey_lock == 0 || $survey_object->survey_lock == 1){

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_option&fort=delete&id={$survey_object->survey_id}" , "حذف الإستفتاء" , img_other("arab-forums" , "images/delete.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الإستفتاء ؟"))."</td>";

}

if($survey_object->survey_lock == 1){

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_option&fort=bad&id={$survey_object->survey_id}" , "رفض الإستفتاء" , img_other("arab-forums" , "images/getdo.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد رفض الإستفتاء ؟"))."</td>";

}

if($survey_object->survey_lock != 0){

echo "<td>".a_other("arab-forums" , "service.php?gert=survey&go=survey_option&fort=wait&id={$survey_object->survey_id}" , "الموافقة على الإستفتاء" , img_other("arab-forums" , "images/wait.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على الإستفتاء ؟"))."</td>";

}}}

echo "</tr></table></td>";

echo "</tr>";

}}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"6\"><br><div class=\"pad\">لآ يوجد أي إستفتاء حاليا</div><br></td>";

echo "</tr>";

}

echo "</table>";

echo "</form>";

}}else{

$arraymsg = array(

"msg" => $error ,

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