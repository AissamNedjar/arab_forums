<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(is_numeric(value) && allowedin3_other("arab-forums" , value , 1) == false){

$error = "للأسف لا يمكنك عرض المواضيع التي تنتظر الموافقة في هذا المنتدى لأنك لا تملك التصريح المناسب";

}else{

$error = "";

}

if($error == ""){

$allyu  = text_other("arab-forums" , post_other("arab-forums" , "allyu") , false , false , false , false , false);

$wait  = text_other("arab-forums" , post_other("arab-forums" , "wait") , false , false , false , false , false);

$import = @implode("," , $allyu);

if(isset($wait)){

if($allyu == 0){

$arraymsg = array(

"msg" => "الرجاء تحديد موضوع وآحد على الأقل ليتم الموافقة عليه" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$topic_sql = select_mysql("arab-forums" , "topic" , "topic_id , topic_wait" , "where topic_id in({$import}) && topic_wait in(1)");

if(num_mysql("arab-forums" , $topic_sql) != false){

while($topic_object = object_mysql("arab-forums" , $topic_sql)){

update_mysql("arab-forums" , "topic" , "topic_wait = \"0\" where topic_id in({$topic_object->topic_id})");

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$topic_object->topic_id}\" , \"".id_user."\" , \"".time()."\" , \"wait\"");

}}

$arraymsg = array(

"msg" => "تم الموافقة على المواضيع المحددة بنجآح تام" ,

"color" => "good" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

if(is_numeric(value)){

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name" , "where forum_id in(".value.") limit 1");

$forum_object = object_mysql("arab-forums" , $forum_sql);

$textu = "عرض المواضيع في : {$forum_object->forum_name}";

$urlp = "service.php?gert=topicreply&go=topicreply_topicwait&value={$forum_object->forum_id}&";

$sqlp = "&& t.topic_forumid in({$forum_object->forum_id})";

$sqlu = "&& topic_forumid in({$forum_object->forum_id})";

}else{

$textu = "عرض جميع المواضيع في المنتديات التي أشرف عليها";

$urlp = "service.php?gert=topicreply&go=topicreply_topicwait&";

$sqlp = "&& t.topic_forumid in(".allowedin1_other("arab-forums").")";

$sqlu = "&& topic_forumid in(".allowedin1_other("arab-forums").")";

}

$count_page = tother_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}</span></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض مواضيع</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"service.php?gert=topicreply&go=topicreply_topicwait\" ".(value == "" ? "selected" : "").">عرض المواضيع التابعة للمنتديات التي أشرف عليها</option>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"service.php?gert=topicreply&go=topicreply_topicwait&value={$forum_object->forum_id}\" ".(value == "{$forum_object->forum_id}" ? "selected" : "").">عرض مواضيع {$forum_object->forum_name}</option>";

}}

echo "</select></div></td>";

echo page_pager("arab-forums" , "topic" , "topic_id , topic_forumid , topic_wait , topic_delete" , "where topic_wait in(1) && topic_delete in(0) {$sqlu}" , $count_page , $get_page , $urlp);

echo "</tr></table>";

echo "<form action=\"".self."\" method=\"post\">";

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td><nobr><input class=\"button\" value=\"الموافقة على المواضيع المحددة\" type=\"submit\" name=\"wait\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الموافقة على المواضيع المحددة ؟")."></nobr></td>";

echo "<td width=\"100%\"></td>";

echo "</tr></table>";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

$inputtext = array(

1 => "تحديد جميع المواضيع" ,

2 => "إلغاء تحديد جميع المواضيع" ,

3 => "لا توجد مواضيع بالصفحة حاليا" ,

4 => "عدد المواضيع الذي إخترت هو :" ,

5 => "الموضوع" ,

);

echo "<tr>";

echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

echo "<td class=\"tcotadmin\" width=\"55%\" align=\"center\">الموضوع</td>";

echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\">الكاتب</td>";

echo "<td class=\"tcotadmin\" width=\"25%\" align=\"center\">المنتدى</td>";

echo "</tr>";

$topic_sql = select_mysql("arab-forums" , "topic" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , t.topic_id , t.topic_forumid , t.topic_name , t.topic_wait , t.topic_delete , t.topic_date , t.topic_user , f.forum_id , f.forum_name" , "as t left join user".prefix_connect." as u on(u.user_id = t.topic_user) left join forum".prefix_connect." as f on(f.forum_id = t.topic_forumid) where t.topic_wait in(1) && t.topic_delete in(0) {$sqlp} order by t.topic_date asc limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $topic_sql) != false){

while($topic_object = object_mysql("arab-forums" , $topic_sql)){

echo "<tr class=\"alttext1\" id=\"tr_{$topic_object->topic_id}\" align=\"center\">";

echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$topic_object->topic_id}' , 'alttext1' , 'الموضوع' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الموضوع\" value=\"{$topic_object->topic_id}\"><input type=\"hidden\" name=\"bg_{$topic_object->topic_id}\" id=\"bg_{$topic_object->topic_id}\" value=\"alttext1\"></div></td>";

echo "<td><div class=\"pad\" align=\"right\">".a_other("arab-forums" , "topic.php?id={$topic_object->topic_id}" , "{$topic_object->topic_name}" , "{$topic_object->topic_name}" , "")."</div></td>";

echo "<td><div class=\"pad\">".($topic_object->topic_date != "" && $topic_object->topic_user != "" ? "<span style=\"font-size:13px;\">".user_other("arab-forums" , array($topic_object->user_id , $topic_object->user_group , $topic_object->user_nameuser , $topic_object->user_lock1 , $topic_object->user_coloruser , false))."</span><br><nobr>".times_date("arab-forums" , "" , $topic_object->topic_date)."</nobr>" : "")."</div></td>";

echo "<td><div class=\"pad\">".a_other("arab-forums" , "forum.php?id={$topic_object->forum_id}" , "{$topic_object->forum_name}" , "<span style=\"color:red;font-size:12px;\">{$topic_object->forum_name}</span>" , "")."</div></td>";

echo "</tr>";

}}else{

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" colspan=\"4\"><br><div class=\"pad\">لآ يوجد أي موضوع ينتظر الموافقة حاليا</div><br></td>";

echo "</tr>";

}

echo "</table></form>";

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