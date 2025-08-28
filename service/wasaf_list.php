<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 10) == false){

$error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";

}elseif(is_numeric(value) && allowedin3_other("arab-forums" , value , 1) == false){

$error = "للأسف لا يمكنك عرض الأوصاف في هذا المنتدى لأنك لا تملك التصريح المناسب";

}else{

$error = "";

}

if($error == ""){

$allyu  = text_other("arab-forums" , post_other("arab-forums" , "allyu") , false , false , false , false , false);

$wait  = text_other("arab-forums" , post_other("arab-forums" , "wait") , false , false , false , false , false);

$bad  = text_other("arab-forums" , post_other("arab-forums" , "bad") , false , false , false , false , false);

$delete  = text_other("arab-forums" , post_other("arab-forums" , "delete") , false , false , false , false , false);

$import = @implode("," , $allyu);

if(isset($wait)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد وصف وآحد على الأقل ليتم الموافقة عليه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "wasaf" , "wasaf_lock = \"0\" where wasaf_id in({$import})");

$arraymsg = array(

"msg" => "تم الموافقة على الأوصاف المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($bad)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد وصف وآحد على الأقل ليتم رفضه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "wasaf" , "wasaf_lock = \"2\" where wasaf_id in({$import})");

$arraymsg = array(

"msg" => "تم رفض الأوصاف المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($delete)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد وصف وآحد على الأقل ليتم حذفه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "wasaf" , "wasaf_lock = \"3\" where wasaf_id in({$import})");

$arraymsg = array(

"msg" => "تم حذف الأوصاف المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

if(type == "wait"){

$sqlo = "w.wasaf_lock in(1)";

$sqly = "wasaf_lock in(1)";

$texto = "تعرض الأوصاف التي تنتظر الموافقة";

$urlo = "&type=wait";

}elseif(type == "bad"){

$sqlo = "w.wasaf_lock in(2)";

$sqly = "wasaf_lock in(2)";

$texto = "تعرض الأوصاف المرفوضة";

$urlo = "&type=bad";

}elseif(type == "delete"){

$sqlo = "w.wasaf_lock in(3)";

$sqly = "wasaf_lock in(3)";

$texto = "تعرض الأوصاف المحذوفة";

$urlo = "&type=delete";

}else{

$sqlo = "w.wasaf_lock in(0)";

$sqly = "wasaf_lock in(0)";

$texto = "تعرض الأوصاف السارية حالية";

$urlo = "";

}

if(is_numeric(value)){

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name" , "where forum_id in(".value.") limit 1");

$forum_object = object_mysql("arab-forums" , $forum_sql);

$textu = "عرض الأوصاف في : {$forum_object->forum_name}";

$urlp = "&value={$forum_object->forum_id}";

$sqlp = "&& w.wasaf_forumid in({$forum_object->forum_id})";

$sqlu = "&& wasaf_forumid in({$forum_object->forum_id})";

}else{

$textu = "عرض جميع الأوصاف في المنتديات التي أشرف عليها";

$urlp = "";

$sqlp = "&& (w.wasaf_forumid in(0) || w.wasaf_forumid in(".allowedin1_other("arab-forums")."))";

$sqlu = "&& (wasaf_forumid in(0) || wasaf_forumid in(".allowedin1_other("arab-forums")."))";

}

$count_page = tother_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}<br><br>{$texto}</span></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض الأوصاف</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list{$urlp}\" ".(type == "" ? "selected" : "").">السارية حاليا</option>";

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list{$urlp}&type=wait\" ".(type == "wait" ? "selected" : "").">التي تنتظر الموافقة</option>";

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list{$urlp}&type=bad\" ".(type == "bad" ? "selected" : "").">المرفوضة</option>";

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list{$urlp}&type=delete\" ".(type == "delete" ? "selected" : "").">المحذوفة</option>";

echo "</select></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض أوصاف</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list{$urlo}\" ".(value == "" ? "selected" : "").">عرض الأوصاف التابعة للمنتديات التي أشرف عليها</option>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"service.php?gert=wasaf&go=wasaf_list&value={$forum_object->forum_id}{$urlo}\" ".(value == "{$forum_object->forum_id}" ? "selected" : "").">عرض أوصاف {$forum_object->forum_name}</option>";

}}

echo "</select></div></td>";

echo page_pager("arab-forums" , "wasaf" , "wasaf_id , wasaf_forumid , wasaf_lock" , "where {$sqly} {$sqlu}" , $count_page , $get_page , "service.php?gert=wasaf&go=wasaf_list{$urlp}{$urlo}&");

echo "</tr></table>";

if(group_user > 2){

echo "<form action=\"".self."\" method=\"post\">";

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

if(type == "wait" || type == "delete" || type == "bad"){

echo "<td><nobr><input class=\"button\" value=\"الموافقة على الأوصاف المحددة\" type=\"submit\" name=\"wait\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على الأوصاف المحددة ؟")."></nobr></td>";

}

if(type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"رفض الأوصاف المحددة\" type=\"submit\" name=\"bad\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد رفض الأوصاف المحددة ؟")."></nobr></td>";

}

if(type == "" || type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"حذف الأوصاف المحددة\" type=\"submit\" name=\"delete\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الأوصاف المحددة ؟")."></nobr></td>";

}

echo "<td width=\"100%\"></td>";

echo "</tr></table>";

}
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

$inputtext = array(

1 => "تحديد جميع الأوصاف" ,

2 => "إلغاء تحديد جميع الأوصاف" ,

3 => "لا توجد أوصاف بالصفحة حاليا" ,

4 => "عدد الأوصاف الذي إخترت هو :" ,

5 => "الوصف" ,

);

echo "<tr>";

if(group_user > 2){

echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

}

echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\">الوصف</td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تمت الإضافة بواسطة</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تاريخ الإضافة</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">المنتدى</td>";

echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\"><nobr>خيارات</nobr></td>";

echo "</tr>";

$wasaf_sql = select_mysql("arab-forums" , "wasaf" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , f.forum_id , f.forum_name , w.wasaf_id , w.wasaf_forumid , w.wasaf_forumall , w.wasaf_lock , w.wasaf_add , w.wasaf_date , w.wasaf_name" , "as w left join user".prefix_connect." as u on(u.user_id = w.wasaf_add) left join forum".prefix_connect." as f on(f.forum_id = w.wasaf_forumid) where {$sqlo} {$sqlp} order by w.wasaf_date desc limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $wasaf_sql) != false){

while($wasaf_object = object_mysql("arab-forums" , $wasaf_sql)){

echo "<tr class=\"alttext1\" id=\"tr_{$wasaf_object->wasaf_id}\" align=\"center\">";

if(group_user > 2){

if(($wasaf_object->wasaf_forumid > 0) || ($wasaf_object->wasaf_forumid == 0 && group_user == 6)){

echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$wasaf_object->wasaf_id}' , 'alttext1' , 'الوصف' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الوصف\" value=\"{$wasaf_object->wasaf_id}\"><input type=\"hidden\" name=\"bg_{$wasaf_object->wasaf_id}\" id=\"bg_{$wasaf_object->wasaf_id}\" value=\"alttext1\"></div></td>";

}}

echo "<td><div class=\"pad\" align=\"right\">{$wasaf_object->wasaf_name}<br><br><span style=\"color:red;font-size:10px;\">".($wasaf_object->wasaf_forumall == 1 ? "يظهر في جميع المنتديات" : "يظهر في المنتدى التابع له فقط")."</span><br><br><span style=\"color:green;font-size:10px;\">رقم الوصف للتوزيع : {$wasaf_object->wasaf_id}</span></div></td>";

echo "<td align=\"center\"><div class=\"pad\">".user_other("arab-forums" , array($wasaf_object->user_id , $wasaf_object->user_group , $wasaf_object->user_nameuser , $wasaf_object->user_lock1 , $wasaf_object->user_coloruser , false))."</div></td>";

echo "<td align=\"center\"><div class=\"pad\">".times_date("arab-forums" , "" , $wasaf_object->wasaf_date)."</div></td>";

echo "<td><div class=\"pad\"><span style=\"color:orange;font-size:12px;\">".($wasaf_object->wasaf_forumid != 0 ? a_other("arab-forums" , "forum.php?id={$wasaf_object->forum_id}" , "{$wasaf_object->forum_name}" , "{$wasaf_object->forum_name}" , "") : "في جميع المنتديات")."</span></div></td>";

echo "<td align=\"center\"><table><tr>";

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_listgo&id={$wasaf_object->wasaf_id}" , "مشاهدة على من وزع الوصف" , img_other("arab-forums" , "images/goshow.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

if(($wasaf_object->wasaf_forumid == 0 && group_user == 6) || ($wasaf_object->wasaf_forumid > 0)){

if($wasaf_object->wasaf_lock == 0){

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_option&fort=edit&id={$wasaf_object->wasaf_id}" , "تعديل الوصف" , img_other("arab-forums" , "images/edit.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_goall&plase={$wasaf_object->wasaf_id}" , "توزيع جماعي للوصف" , img_other("arab-forums" , "images/replytop.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_goone&plase={$wasaf_object->wasaf_id}" , "توزيع فردي للوصف" , img_other("arab-forums" , "images/replynotop.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

}

if(group_user > 2){

if($wasaf_object->wasaf_lock == 0 || $wasaf_object->wasaf_lock == 1){

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_option&fort=delete&id={$wasaf_object->wasaf_id}" , "حذف الوصف" , img_other("arab-forums" , "images/delete.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الوصف ؟"))."</td>";

}

if($wasaf_object->wasaf_lock == 1){

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_option&fort=bad&id={$wasaf_object->wasaf_id}" , "رفض الوصف" , img_other("arab-forums" , "images/getdo.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد رفض الوصف ؟"))."</td>";

}

if($wasaf_object->wasaf_lock != 0){

echo "<td>".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_option&fort=wait&id={$wasaf_object->wasaf_id}" , "الموافقة على الوصف" , img_other("arab-forums" , "images/wait.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على الوصف ؟"))."</td>";

}}}

echo "</tr></table></td>";

echo "</tr>";

}}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"6\"><br><div class=\"pad\">لآ يوجد أي وصف حاليا</div><br></td>";

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