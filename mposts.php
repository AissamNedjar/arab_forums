<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums" , true);

@include("includes.php");

define("pageupdate" , true);

@include("includes/e.noopen.php");

define("pagebody" , "mposts");

$get_id = (id == "" || !is_numeric(id) ? id_user : id);

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex" , "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if(group_user == 0){

$error = "للأسف خاصية المفضلة متوفرة للأعضاء المسجلين فقط";

}else{

if(num_mysql("arab-forums" , $user_sql) == false){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

if(value != "" && allowedin3_other("arab-forums" , value , 3) == false){

$error = "للأسف لا يمكنك مشاهدة مشاركاتك أو مشاركات عضو آخر في هذا المنتدى";

}else{

$error = "";

}}}

if($error != ""){

online_other("arab-forums" , "mposts" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => $error ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

online_other("arab-forums" , "mposts" , "0" , "0" , "0" , $user_object->user_id);

if($user_object->user_id == id_user){

$usertitle = "مشاركاتك بالمنتديات";

$usertitleerror = "لا توجد أي مشاركات لك بالمنتديات حاليا";

$urtl = "mposts.php";

$urtu = "mposts.php?";

}else{

$usertitle = "مشاركات ".($user_object->user_sex == 1 ? "العضو" : "العضوة")." ".$user_object->user_nameuser." بالمنتديات";

$usertitleerror = "لا توجد أي مشاركات ".($user_object->user_sex == 1 ? "للعضو" : "للعضوة")." ".$user_object->user_nameuser." بالمنتديات حاليا";

$urtl = "mposts.php?id={$user_object->user_id}";

$urtu = "mposts.php?id={$user_object->user_id}&";

}

if(value != ""){

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name" , "where forum_id in(".value.") limit 1");

$forum_object = object_mysql("arab-forums" , $forum_sql);

$textother = "عرض المشاركات في : {$forum_object->forum_name}";

}else{

$textother = "عرض المشاركات في جميع المنتديات";

}

echo bodytop_template("arab-forums" , $usertitle);

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/mposts.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\">".a_other("arab-forums" , "mposts.php?id={$user_object->user_id}" , "{$usertitle}" , "{$usertitle}" , "")."<div class=\"pad\"><span style=\"color:red;font-size:12px;\">{$textother}</span></div></td>";

echo one_forumcatlist("arab-forums" , value , $urtu , $urtl);

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" width=\"35%\" colspan=\"2\"><div class=\"pad\">الموضوع</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">الكاتب</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">آخر مشاركة</div></td>";

echo "<td class=\"tcat\" width=\"9%\"><div class=\"pad\">الردود</div></td>";

echo "<td class=\"tcat\" width=\"9%\"><div class=\"pad\">المشاهدات</div></td>";

echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">المنتدى</div></td>";

echo "</tr>";

if(value != ""){

$pops = " && f.forum_id in(".value.")";

}else{

$pops = "";

}

$topic_sql = select_mysql("arab-forums" , "reply" , "i.iconstopic_id , i.iconstopic_name , i.iconstopic_images , i.iconstopic_forumid , x.texttopic_id , x.texttopic_name , x.texttopic_forumid , r.reply_id , r.reply_topicid , r.reply_user , r.reply_date , r.reply_wait , r.reply_hid , r.reply_delete , c.cat_id , c.cat_lock , c.cat_hid , c.cat_name , c.cat_monitor1 , c.cat_monitor2 , c.cat_group".group_user." , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_logo , f.forum_moderattext , f.forum_totaltopic , f.forum_sex , f.forum_group".group_user." , f.forum_mode , u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , t.topic_id , t.topic_forumid , t.topic_lock , t.topic_name , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_stiky , t.topic_top , t.topic_survey , t.topic_icons , t.topic_text , t.topic_reply , t.topic_visit , t.topic_date , t.topic_user , t.topic_lastdate , t.topic_lastuser" , "as r left join topic".prefix_connect." as t on(t.topic_id = r.reply_topicid) left join iconstopic".prefix_connect." as i on(i.iconstopic_id = t.topic_icons) left join texttopic".prefix_connect." as x on(x.texttopic_id = t.topic_text) left join forum".prefix_connect." as f on(f.forum_id = t.topic_forumid) left join cat".prefix_connect." as c on(c.cat_id = f.forum_catid) left join user".prefix_connect." as u1 on(u1.user_id = t.topic_user) left join user".prefix_connect." as u2 on(u2.user_id = t.topic_lastuser) where r.reply_user in({$user_object->user_id}) && t.topic_delete in(0) && c.cat_group".group_user." in(1) && f.forum_group".group_user." in(1) && r.reply_wait in(0) && r.reply_hid in(0) && r.reply_delete in(0) {$pops} group by t.topic_id order by r.reply_date desc limit 50");

if(num_mysql("arab-forums" , $topic_sql) != false){

while($topic_object = object_mysql("arab-forums" , $topic_sql)){

if($topic_object->forum_hid1 == false || ($topic_object->forum_hid1 == true && forumhide1_other("arab-forums" , $topic_object->forum_id , $topic_object->cat_monitor1 , $topic_object->cat_monitor2 , $topic_object->forum_mode) == true)){

if($topic_object->forum_hid2 == false || ($topic_object->forum_hid2 == true && forumhide2_other("arab-forums" , $topic_object->cat_id , $topic_object->cat_monitor1 , $topic_object->cat_monitor2 , $topic_object->forum_mode) == true)){

if((($topic_object->topic_wait == 0) || ($topic_object->topic_wait == 1 && ($moderatget1 == true || $topic_object->topic_user == id_user))) && (($topic_object->topic_hid == 0) || ($topic_object->topic_hid == 1 && ($moderatget1 == true || $topic_object->topic_user == id_user || num_mysql("arab-forums" , select_mysql("arab-forums" , "hidtopic" , "hidtopic_userid , hidtopic_topicid" , "where hidtopic_userid in(".id_user.") && hidtopic_topicid in({$topic_object->topic_id}) limit 1")) != false)))){

$moderatget1 = moderatget1_other("arab-forums" , $topic_object->forum_id , $topic_object->cat_monitor1 , $topic_object->cat_monitor2 , $topic_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $topic_object->cat_monitor1 , $topic_object->cat_monitor2);

if($topic_object->topic_delete == 1){

$classtopic = "topicd";

}elseif($topic_object->topic_wait == 1){

$classtopic = "topicw";

}elseif($topic_object->topic_hid == 1){

$classtopic = "topich";

}elseif($topic_object->topic_stiky == 1){

$classtopic = "topics";

}else{

$classtopic = "topicn";

}

if($topic_object->topic_text != 0 && ($topic_object->texttopic_forumid == 0 || $topic_object->texttopic_forumid == $topic_object->forum_id)){

$text1topic = "<span style=\"color:red;\">{$topic_object->texttopic_name} : </span>";

$text2topic = "{$topic_object->texttopic_name} : ";

}else{

$text1topic = "";

$text2topic = "";

}

if($topic_object->topic_icons != 0 && ($topic_object->iconstopic_forumid == 0 || $topic_object->iconstopic_forumid == $topic_object->forum_id)){

$iconstopic = img_other("arab-forums" , $topic_object->iconstopic_images , $topic_object->iconstopic_name , "" , "" , "0" , "class=\"title\"" , "images/iconsno.png");

}else{

if($topic_object->topic_delete == 1){

$iconstopic = img_other("arab-forums" , "images/folder/delete.png" , "هذا الموضوع محذوف" , "" , "" , "0" , "class=\"title\"" , "");

}elseif($topic_object->topic_wait == 1){

$iconstopic = img_other("arab-forums" , "images/folder/wait.png" , "هذا الموضوع ينتظر الموافقة" , "" , "" , "0" , "class=\"title\"" , "");

}elseif($topic_object->topic_lock == 1){

$iconstopic = img_other("arab-forums" , "images/folder/lock.png" , "هذا الموضوع مغلوق" , "" , "" , "0" , "class=\"title\"" , "");

}elseif($topic_object->topic_lock == 0 && $topic_object->topic_reply >= 10){

$iconstopic = img_other("arab-forums" , "images/folder/hote.png" , "هذا الموضوع نشيط" , "" , "" , "0" , "class=\"title\"" , "");

}else{

$iconstopic = img_other("arab-forums" , "images/folder/new.png" , "هذا الموضوع مفتوح" , "" , "" , "0" , "class=\"title\"" , "");

}}

echo "<tr align=\"center\" class=\"topice {$classtopic}\">";

echo "<td class=\"topic\" width=\"1%\">{$iconstopic}</td>";

echo "<td class=\"topic\" align=\"right\"><table cellpadding=\"3\" cellspacing=\"1\"><tr>";

echo "<td>".a_other("arab-forums" , "topic.php?id={$topic_object->topic_id}" , "" , img_other("arab-forums" , "images/plus.gif" , "" , "" , "" , "0" , "" , "") , "target=\"_blank\"")."</td>";

if($topic_object->topic_survey > 0){

echo "<td>".img_other("arab-forums" , "images/survey.png" , "هذا الموضوع يحتوي على إستفتاء" , "" , "" , "0" , "class=\"title\"" , "")."</td>";

}

if($topic_object->topic_top == 1){

echo "<td>".img_other("arab-forums" , "images/top1.png" , "هذا الموضوع متميز في هذا المنتدى" , "" , "" , "0" , "class=\"title\"" , "")."</td>";

}elseif($topic_object->topic_top == 2){

echo "<td>".img_other("arab-forums" , "images/top2.png" , "هذا الموضوع متميز في جميع المنتديات" , "" , "" , "0" , "class=\"title\"" , "")."</td>";

}

echo "<td width=\"100%\">".a_other("arab-forums" , "topic.php?id={$topic_object->topic_id}" , "{$text2topic}{$topic_object->topic_name}" , "{$text1topic}{$topic_object->topic_name}" , "")."".reply_pager("arab-forums" , forum_replytopic , $topic_object->topic_id , $topic_object->topic_reply)."</td>";

if(group_user > 0){

if(($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0 && $topic_object->topic_user == id_user)){

echo "<td>".a_other("arab-forums" , "topic.php?id={$topic_object->topic_id}&go=edittopic" , "تعديل الموضوع" , img_other("arab-forums" , "images/edit.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

}

if(($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0) || ($topic_object->topic_wait == 0 && num_mysql("arab-forums" , select_mysql("arab-forums" , "locktopic" , "locktopic_userid , locktopic_topicid" , "where locktopic_userid in(".id_user.") && locktopic_topicid in(".$topic_object->topic_id.") limit 1")) != false)){

echo "<td>".a_other("arab-forums" , "topic.php?id={$topic_object->topic_id}&go=newreply" , "الرد على الموضوع" , img_other("arab-forums" , "images/add.png" , "" , "" , "" , "0" , "" , "") , "")."</td>";

}}

echo "</tr></table></td>";

echo "<td class=\"topic\">".($topic_object->topic_date != "" && $topic_object->topic_user != "" ? "<span style=\"font-size:13px;\">".user_other("arab-forums" , array($topic_object->u1user_id , $topic_object->u1user_group , $topic_object->u1user_name , $topic_object->u1user_lock , $topic_object->u1user_color , false))."</span><br><nobr>".times_date("arab-forums" , "" , $topic_object->topic_date)."</nobr>" : "")."</td>";

echo "<td class=\"topic\">".($topic_object->topic_lastdate != "" && $topic_object->topic_lastuser != "" ? "<span style=\"font-size:13px;\">".user_other("arab-forums" , array($topic_object->u2user_id , $topic_object->u2user_group , $topic_object->u2user_name , $topic_object->u2user_lock , $topic_object->u2user_color , false))."</span><br><nobr>".times_date("arab-forums" , "" , $topic_object->topic_lastdate)."</nobr>" : "")."</td>";

echo "<td class=\"topic\">".num_other("arab-forums" , $topic_object->topic_reply)."</td>";

echo "<td class=\"topic\">".num_other("arab-forums" , $topic_object->topic_visit)."</td>";

echo "<td class=\"topic\">".a_other("arab-forums" , "forum.php?id={$topic_object->forum_id}" , "{$topic_object->forum_name}" , "<span style=\"color:red;font-size:12px;\">{$topic_object->forum_name}</span>" , "")."</td>";

echo "</tr>";

}}}}}else{

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"7\"><br><br>{$usertitleerror}<br><br><br></td></tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>