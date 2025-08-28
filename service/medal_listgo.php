<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 9) == false){

$error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";

}elseif(is_numeric(value) && allowedin3_other("arab-forums" , value , 1) == false){

$error = "للأسف لا يمكنك عرض الأوسمة الموزعة في هذا المنتدى لأنك لا تملك التصريح المناسب";

}elseif(is_numeric(id) && medalallo_other("arab-forums" , id , 1 , "show" , false) == false){

$error = "للأسف لا يمكنك عرض من يستعمل هذا الوسام لأنك لا تملك التصريح المناسب";

}elseif(is_numeric(user) && userallo_other("arab-forums" , "id" , user) == false){

$error = "للأسف لا يمكنك عرض الأوسمة الموزعة على هاته العضوية لأنك لا تملك التصريح المناسب";

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

"msg" => "الرجاء تحديد وسام موزع وآحد على الأقل ليتم الموافقة عليه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$get_sql = select_mysql("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_userid , g.getmedal_medalid , w.medal_id , w.medal_point" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) where g.getmedal_id in({$import})");

if(num_mysql("arab-forums" , $get_sql) != false){

while($get_object = object_mysql("arab-forums" , $get_sql)){

update_mysql("arab-forums" , "user" , "user_point = user_point+{$get_object->medal_point} where user_id in({$get_object->getmedal_userid})");

update_mysql("arab-forums" , "getmedal" , "getmedal_lock = \"0\" where getmedal_id in({$get_object->getmedal_id})");

}}

$arraymsg = array(

"msg" => "تم الموافقة على الأوسمة الموزعة المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($bad)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد وسام موزع وآحد على الأقل ليتم رفضه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$get_sql = select_mysql("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_userid , g.getmedal_medalid , g.getmedal_lock , w.medal_id , w.medal_point" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) where g.getmedal_id in({$import})");

if(num_mysql("arab-forums" , $get_sql) != false){

while($get_object = object_mysql("arab-forums" , $get_sql)){

if($get_object->getmedal_lock == 0){

update_mysql("arab-forums" , "user" , "user_point = user_point-{$get_object->medal_point} where user_id in({$get_object->getmedal_userid})");

}

update_mysql("arab-forums" , "getmedal" , "getmedal_lock = \"2\" where getmedal_id in({$get_object->getmedal_id})");

}}

$arraymsg = array(

"msg" => "تم رفض الأوسمة الموزعة المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}elseif(isset($delete)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد وسام موزع وآحد على الأقل ليتم حذفه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$get_sql = select_mysql("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_userid , g.getmedal_medalid , g.getmedal_lock , w.medal_id , w.medal_point" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) where g.getmedal_id in({$import})");

if(num_mysql("arab-forums" , $get_sql) != false){

while($get_object = object_mysql("arab-forums" , $get_sql)){

if($get_object->getmedal_lock == 0){

update_mysql("arab-forums" , "user" , "user_point = user_point-{$get_object->medal_point} where user_id in({$get_object->getmedal_userid})");

}

update_mysql("arab-forums" , "getmedal" , "getmedal_lock = \"3\" where getmedal_id in({$get_object->getmedal_id})");

}}

$arraymsg = array(

"msg" => "تم حذف الأوسمة الموزعة المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

if(type == "wait"){

$sqlo = "g.getmedal_lock in(1)";

$texto = "تعرض الأوسمة الموزعة التي تنتظر الموافقة";

$urlo = "&type=wait";

}elseif(type == "bad"){

$sqlo = "g.getmedal_lock in(2)";

$texto = "تعرض الأوسمة الموزعة المرفوضة";

$urlo = "&type=bad";

}elseif(type == "delete"){

$sqlo = "g.getmedal_lock in(3)";

$texto = "تعرض الأوسمة الموزعة المحذوفة";

$urlo = "&type=delete";

}else{

$sqlo = "g.getmedal_lock in(0)";

$texto = "تعرض الأوسمة الموزعة السارية حالية";

$urlo = "";

}

if(is_numeric(id)){

$getmedal_sql = select_mysql("arab-forums" , "medal" , "medal_id , medal_name" , "where medal_id in(".id.") limit 1");

$getmedal_object = object_mysql("arab-forums" , $getmedal_sql);

$textu = "عرض على من وزع الوسام رقم : ".id." ({$getmedal_object->medal_name})";

$urlp = "&id={$getmedal_object->medal_id}";

$sqlp = "&& w.medal_id in({$getmedal_object->medal_id}) && (w.medal_forumid in(0) || w.medal_forumid in(".allowedin1_other("arab-forums")."))";

}elseif(is_numeric(value)){

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name" , "where forum_id in(".value.") limit 1");

$forum_object = object_mysql("arab-forums" , $forum_sql);

$textu = "عرض الأوسمة الموزعة في : {$forum_object->forum_name}";

$urlp = "&value={$forum_object->forum_id}";

$sqlp = "&& w.medal_forumid in({$forum_object->forum_id})";

}elseif(is_numeric(user)){

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_nameuser" , "where user_id in(".user.") limit 1");

$user_object = object_mysql("arab-forums" , $user_sql);

$textu = "عرض الأوسمة الموزعة على : {$user_object->user_nameuser}";

$urlp = "&user={$user_object->user_id}";

$sqlp = "&& g.getmedal_userid in({$user_object->user_id}) && (w.medal_forumid in(0) || w.medal_forumid in(".allowedin1_other("arab-forums")."))";

}else{

$textu = "عرض جميع الأوسمة الموزعة الموزعة في المنتديات التي أشرف عليها";

$urlp = "";

$sqlp = "&& (w.medal_forumid in(0) || w.medal_forumid in(".allowedin1_other("arab-forums")."))";

}

$count_page = tother_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}<br><br>{$texto}</span></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض الأوسمة الموزعة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=medal&go=medal_listgo{$urlp}\" ".(type == "" ? "selected" : "").">السارية حاليا</option>";

echo "<option value=\"service.php?gert=medal&go=medal_listgo{$urlp}&type=wait\" ".(type == "wait" ? "selected" : "").">التي تنتظر الموافقة</option>";

echo "<option value=\"service.php?gert=medal&go=medal_listgo{$urlp}&type=bad\" ".(type == "bad" ? "selected" : "").">المرفوضة</option>";

echo "<option value=\"service.php?gert=medal&go=medal_listgo{$urlp}&type=delete\" ".(type == "delete" ? "selected" : "").">المحذوفة</option>";

echo "</select></div></td>";

if(!is_numeric(id) && !is_numeric(user)){

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض أوسمة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=medal&go=medal_listgo{$urlo}\" ".(value == "" ? "selected" : "").">عرض الأوسمة الموزعة التابعة للمنتديات التي أشرف عليها</option>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"service.php?gert=medal&go=medal_listgo&value={$forum_object->forum_id}{$urlo}\" ".(value == "{$forum_object->forum_id}" ? "selected" : "").">عرض أوسمة {$forum_object->forum_name}</option>";

}}

echo "</select></div></td>";

}

echo page_pager("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_medalid , g.getmedal_userid , g.getmedal_lock , w.medal_id , w.medal_forumid , w.medal_lock" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) where w.medal_lock in(0) && {$sqlo} {$sqlp}" , $count_page , $get_page , "service.php?gert=medal&go=medal_listgo{$urlp}{$urlo}&");

echo "</tr></table>";

echo "<form action=\"".self."\" method=\"post\">";

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

if(group_user > 2){

if(type == "wait" || type == "delete" || type == "bad"){

echo "<td><nobr><input class=\"button\" value=\"الموافقة على الأوسمة الموزعة المحددة\" type=\"submit\" name=\"wait\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على الأوسمة الموزعة المحددة ؟")."></nobr></td>";

}

if(type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"رفض الأوسمة الموزعة المحددة\" type=\"submit\" name=\"bad\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد رفض الأوسمة الموزعة المحددة ؟")."></nobr></td>";

}}

if(type == "" || type == "wait"){

echo "<td><nobr><input class=\"button\" value=\"حذف الأوسمة الموزعة المحددة\" type=\"submit\" name=\"delete\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف الأوسمة الموزعة المحددة ؟")."></nobr></td>";

}

echo "<td width=\"100%\"></td>";

echo "</tr></table>";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

$inputtext = array(

1 => "تحديد جميع الأوسمة الموزعة" ,

2 => "إلغاء تحديد جميع الأوسمة الموزعة" ,

3 => "لا توجد أوسمة بالصفحة حاليا" ,

4 => "عدد الأوسمة الموزعة الذي إخترت هو :" ,

5 => "الوسام" ,

);

echo "<tr>";

echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\" colspan=\"2\">الوسام</td>";

echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">النقاط</td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>وزع على</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>بواسطة</nobr></td>";

echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">المنتدى</td>";

echo "</tr>";

$getmedal_sql = select_mysql("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_medalid , g.getmedal_userid , g.getmedal_lock , g.getmedal_add , g.getmedal_date , u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , f.forum_id , f.forum_name , w.medal_id , w.medal_forumid , w.medal_lock , w.medal_name , w.medal_point , w.medal_url" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) left join user".prefix_connect." as u1 on(u1.user_id = g.getmedal_add) left join user".prefix_connect." as u2 on(u2.user_id = g.getmedal_userid) left join forum".prefix_connect." as f on(f.forum_id = w.medal_forumid) where w.medal_lock in(0) && {$sqlo} {$sqlp} order by g.getmedal_date desc limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $getmedal_sql) != false){

while($getmedal_object = object_mysql("arab-forums" , $getmedal_sql)){

echo "<tr class=\"alttext1\" id=\"tr_{$getmedal_object->getmedal_id}\" align=\"center\">";

if((($getmedal_object->medal_forumid > 0) || ($getmedal_object->medal_forumid == 0 && group_user == 6)) && (($getmedal_object->getmedal_lock == 0) || ($getmedal_object->getmedal_lock != 0 && group_user > 2))){

echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$getmedal_object->getmedal_id}' , 'alttext1' , 'الوسام الموزع' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الوسام الموزع\" value=\"{$getmedal_object->getmedal_id}\"><input type=\"hidden\" name=\"bg_{$getmedal_object->getmedal_id}\" id=\"bg_{$getmedal_object->getmedal_id}\" value=\"alttext1\"></div></td>";

}else{

echo "<td><div class=\"pad\">--</div></td>";

}


echo "<td class=\"alttext1\" align=\"center\" width=\"1%\">".img_other("arab-forums" , "{$getmedal_object->medal_url}" , "" , "100" , "100" , "0" , "" , "images/nophoto.gif")."</td>";

echo "<td><div class=\"pad\" align=\"right\">{$getmedal_object->medal_name}</div></td>";

echo "<td><div class=\"pad\">{$getmedal_object->medal_point}</div></td>";

echo "<td align=\"center\"><div class=\"pad\">".user_other("arab-forums" , array($getmedal_object->u2user_id , $getmedal_object->u2user_group , $getmedal_object->u2user_name , $getmedal_object->u2user_lock , $getmedal_object->u2user_color , false))."</div></td>";

echo "<td align=\"center\"><div class=\"pad\"><span style=\"font-size:13px;\">".user_other("arab-forums" , array($getmedal_object->u1user_id , $getmedal_object->u1user_group , $getmedal_object->u1user_name , $getmedal_object->u1user_lock , $getmedal_object->u1user_color , false))."</span><br><nobr>".times_date("arab-forums" , "" , $getmedal_object->getmedal_date)."</nobr></div></td>";

echo "<td><div class=\"pad\"><span style=\"color:orange;font-size:12px;\">".($getmedal_object->medal_forumid != 0 ? a_other("arab-forums" , "forum.php?id={$getmedal_object->forum_id}" , "{$getmedal_object->forum_name}" , "{$getmedal_object->forum_name}" , "") : "في جميع المنتديات")."</span></div></td>";

echo "</tr>";

}}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"7\"><br><div class=\"pad\">لآ يوجد أي وسام موزع حاليا</div><br></td>";

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