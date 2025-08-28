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

define("pagebody" , "optionreply");

$option_sql = select_mysql("arab-forums" , "reply" , "r.reply_id , r.reply_topicid , r.reply_user , r.reply_wait , r.reply_delete , r.reply_hid , r.reply_top , r.reply_message , r.reply_img , r.reply_url , t.topic_id , t.topic_forumid , c.cat_id , c.cat_lock , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_lock , f.forum_mode" , "as r left join topic".prefix_connect." as t on(r.reply_topicid = t.topic_id) left join forum".prefix_connect." as f on(t.topic_forumid = f.forum_id) left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where r.reply_id in(".id.") limit 1");

if(num_mysql("arab-forums" , $option_sql) == false){

$errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";

}else{

$option_object = object_mysql("arab-forums" , $option_sql);

$moderatget1 = moderatget1_other("arab-forums" , $option_object->forum_id , $option_object->cat_monitor1 , $option_object->cat_monitor2 , $option_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $option_object->cat_monitor1 , $option_object->cat_monitor2);

if($moderatget1 == false && go != "delete" && go != "hid"){

$errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";

}else{

$errorop = "";

}}

if($errorop == ""){

online_other("arab-forums" , "optionreply" , $option_object->cat_id , $option_object->forum_id , $option_object->reply_id , "0");

if(go == "wait"){

if($option_object->reply_wait == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك الموافقة على الرد لأنه موافق عليه من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_wait = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"wait\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم الموافقة على الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "img"){

if($option_object->reply_img == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إخفاء صور الرد لأنها مخفية من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_img = \"1\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"img\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إخفاء صور الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "noimg"){

if($option_object->reply_img == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إظهار صور الرد لأنها ظاهرة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_img = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"noimg\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إظهار صور الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "url"){

if($option_object->reply_url == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إخفاء روابط الرد لأنها مخفية من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_url = \"1\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"url\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إخفاء روابط الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "nourl"){

if($option_object->reply_url == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إظهار روابط الرد لأنها ظاهرة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_url = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"nourl\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إظهار روابط الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "hid" && ($moderatget1 == true || per_other("arab-forums" , 4) == true)){

if($option_object->reply_hid == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إخفاء الرد لأنه مخفي من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_hid = \"1\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"hid\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إخفاء الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "nohid"){

if($option_object->reply_hid == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إظهار الرد لأنه ظاهر من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_hid = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"nohid\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إظهار الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "top"){

if($option_object->reply_top == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك تمييز الرد لأنه مثبث من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_top = \"1\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"top\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم تمييز الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "notop"){

if($option_object->reply_top == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إزالة تمييز الرد لأنه غير مثبث من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_top = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"notop\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إزالة تمييز الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "delete" && (($moderatget1 == true && per_other("arab-forums" , 3) == true) || ($option_object->reply_user == id_user))){

if($option_object->reply_delete == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك حذف الرد لأنه محذوف من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_delete = \"1\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"delete\"");

update_mysql("arab-forums" , "forum" , "forum_reply = forum_reply-1 where forum_id = \"{$option_object->forum_id}\"");

update_mysql("arab-forums" , "user" , "user_post = user_post-1 , user_posts = user_posts-1 where user_id = \"{$option_object->reply_user}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم حذف الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "nodelete"){

if($option_object->reply_delete == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك إرجاع الرد لأنه غير محذوف من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "reply" , "reply_delete = \"0\" where reply_id in({$option_object->reply_id}) limit 1");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"nodelete\"");

update_mysql("arab-forums" , "forum" , "forum_reply = forum_reply+1 where forum_id = \"{$option_object->forum_id}\"");

update_mysql("arab-forums" , "user" , "user_post = user_post+1 , user_posts = user_posts+1 where user_id = \"{$option_object->reply_user}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إرجاع الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "goedit"){

echo bodytop_template("arab-forums" , "التعديلات المقامة على رد");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

echo "<td width=\"100%\"></td>";

$count_page = tother_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo page_pager("arab-forums" , "editreply" , "editreply_id , editreply_replyid" , "where editreply_replyid in({$option_object->reply_id})" , $count_page , $get_page , "optionreply.php?id={$option_object->reply_id}&go=goedit&");

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"70%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">التعديلات على الرد رقم : {$option_object->reply_id}</div></td></tr>";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\"><div class=\"pad\">رقم التعديل</div></td>";

echo "<td class=\"tcat\"><div class=\"pad\">تم التعديل بواسطة</div></td>";

echo "<td class=\"tcat\"><div class=\"pad\">تاريخ التعديل</div></td>";

echo "</tr>";

$editreply_sql = select_mysql("arab-forums" , "editreply" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , e.editreply_id , e.editreply_user , e.editreply_date , e.editreply_replyid" , "as e left join user".prefix_connect." as u on(u.user_id = e.editreply_user) where e.editreply_replyid in({$option_object->reply_id}) order by e.editreply_date desc limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $editreply_sql) != false){

while($editreply_object = object_mysql("arab-forums" , $editreply_sql)){

echo "<tr align=\"center\" class=\"alttext1\">";

echo "<td class=\"reply\">التعديل رقم {$editreply_object->editreply_id} ".a_other("arab-forums" , "optionreply.php?id={$option_object->reply_id}&go=showedit&value={$editreply_object->editreply_id}" , "مشاهدة التعديل رقم : {$editreply_object->editreply_id}" , "<span style=\"color:red;font-size:11px;\">(لرؤية هذا التعديل إضغط هنا)</span>" , "")."</td>";

echo "<td class=\"reply\"><span style=\"font-size:13px;\">".user_other("arab-forums" , array($editreply_object->user_id , $editreply_object->user_group , $editreply_object->user_nameuser , $editreply_object->user_lock1 , $editreply_object->user_coloruser , false))."</span></td>";

echo "<td class=\"reply\"><span style=\"font-size:13px;\">".times_date("arab-forums" , "" , $editreply_object->editreply_date)."</span></td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><br><br>لا توجد تعديلات<br><br><br></td></tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}elseif(go == "showedit"){

$editreply_sql = select_mysql("arab-forums" , "editreply" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , e.editreply_id , e.editreply_user , e.editreply_date , e.editreply_replyid , e.editreply_message" , "as e left join user".prefix_connect." as u on(u.user_id = e.editreply_user) where editreply_id in(".value.") && editreply_replyid in({$option_object->reply_id})");

if(num_mysql("arab-forums" , $editreply_sql) == false){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف لا يمكنك مشاهدة هذا التعديل لعدة أسباب" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$editreply_object = object_mysql("arab-forums" , $editreply_sql);

if(type == "insert"){

$editor_edit = text_other("arab-forums" , htmltext_other("arab-forums" , $option_object->reply_message) , false , true , false , false , true);

$editor_message = text_other("arab-forums" , htmltext_other("arab-forums" , $editreply_object->editreply_message) , false , true , false , false , true);

insert_mysql("arab-forums" , "editreply" , "editreply_id , editreply_replyid , editreply_user , editreply_date , editreply_message" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"{$editor_edit}\"");

update_mysql("arab-forums" , "reply" , "reply_message = \"{$editor_message}\" where reply_id in({$option_object->reply_id})");

insert_mysql("arab-forums" , "optionreply" , "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type" , "null , \"{$option_object->reply_id}\" , \"".id_user."\" , \"".time()."\" , \"edit\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إرجاع النص إلى الرد بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الرد" ,

"url" => "topic.php?id={$option_object->topic_id}&type=reply&value={$option_object->reply_id}" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

echo bodytop_template("arab-forums" , "مشاهدة تعديل على رد");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

echo "<td width=\"100%\"></td>";

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"70%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">التعديل رقم : {$editreply_object->editreply_id} | الخاص بالرد رقم : {$option_object->reply_id}</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>تم التعديل بواسطة : ".user_other("arab-forums" , array($editreply_object->user_id , $editreply_object->user_group , $editreply_object->user_nameuser , $editreply_object->user_lock1 , $editreply_object->user_coloruser , false))." | بتاريخ : ".times_date("arab-forums" , "" , $editreply_object->editreply_date)."<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">خيارات</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><br>".a_other("arab-forums" , "optionreply.php?id={$option_object->reply_id}&go=showedit&value={$editreply_object->editreply_id}&type=insert" , "إرجاع النص إلى الرد" , img_other("arab-forums" , "images/texte.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إرجاع النص إلى الرد ؟"))."<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">النص السابق</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

echo messagereplase_other("arab-forums" , $editreply_object->editreply_message , $option_object->forum_id);

echo "</td></tr></table></div></td></tr>";

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}else{

$arraymsg = array(

"login" => true ,

"msg" => "لا تملك التصريح المناسب لدخول هذه الصفحة" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

online_other("arab-forums" , "optionreply" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "{$errorop}" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>