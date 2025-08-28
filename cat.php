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

$cat_sql = select_mysql("arab-forums" , "cat" , "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , c.cat_id , c.cat_lock , c.cat_hid , c.cat_name , c.cat_order , c.cat_home , c.cat_monitor1 , c.cat_monitor2 , c.cat_monitor1text , c.cat_monitor2text , c.cat_group".group_user."" , "as c left join user".prefix_connect." as u1 on(u1.user_id = c.cat_monitor1) left join user".prefix_connect." as u2 on(u2.user_id = c.cat_monitor2) where c.cat_id in(".id.") && c.cat_group".group_user." in(1) order by c.cat_order asc , c.cat_id asc");

if(num_mysql("arab-forums" , $cat_sql) == false){

$errorop = "رقم الفئة خاطئ";

}else{

$cat_object = object_mysql("arab-forums" , $cat_sql);

if($cat_object->cat_hid == true && cathide_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2) == false){

$errorop = "الفئة مخفية";

}else{

$errorop = "";

}}

if($errorop == ""){

define("pagebody" , "cat");

online_other("arab-forums" , "cat" , $cat_object->cat_id , "0" , "0" , "0");

echo bodytop_template("arab-forums" , $cat_object->cat_name);

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" width=\"40%\" colspan=\"2\" style=\"font-size:17px;\" align=\"right\"><div class=\"pad\">المنتديات التابعة لــ : {$cat_object->cat_name}</div></td>";

echo "<td class=\"tcat\" width=\"9%\">المواضيع</td>";

echo "<td class=\"tcat\" width=\"9%\">الردود</td>";

echo "<td class=\"tcat\" width=\"2%\">".img_other("arab-forums" , "images/user1.png" , "المتواجدون في هذا المنتدى حاليا" , "" , "" , "0" , "class=\"title\"" , "")."</td>";

echo "<td class=\"tcat\" width=\"12%\">آخر مشاركة</td>";

echo "<td class=\"tcat\" width=\"28%\">المشرفون</td>";

echo "</tr>";

$forum_sql = select_mysql("arab-forums" , "forum" , "count(distinct o.online_ip) as forum_online , o.online_type , o.online_forumid , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_wasaf , f.forum_order , f.forum_logo , f.forum_topic , f.forum_reply , f.forum_lastdate , f.forum_lastuser , f.forum_group".group_user." , f.forum_moderattext , f.forum_mode" , "as f left join online".prefix_connect." as o on(o.online_forumid = f.forum_id) left join user".prefix_connect." as u on(u.user_id = f.forum_lastuser) where f.forum_catid in({$cat_object->cat_id}) && f.forum_group".group_user." in(1) group by f.forum_id order by f.forum_order asc , f.forum_id asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

$totaltopic = 0;

$totalreply = 0;

$totalonline = 0;

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

if($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums" , $forum_object->forum_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

if($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" width=\"1%\">".img_other("arab-forums" , "{$forum_object->forum_logo}" , "" , "50" , "50" , "0" , "" , "")."</td>";

echo "<td class=\"alttext1\" align=\"right\"><div class=\"pad\">".a_other("arab-forums" , "forum.php?id={$forum_object->forum_id}" , "{$forum_object->forum_name}" , "{$forum_object->forum_name}" , "")."<div class=\"desc\">{$forum_object->forum_wasaf}</div></div></td>";

echo "<td class=\"alttext2\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr align=\"center\"><td width=\"1%\"><div class=\"pad\">".($forum_object->forum_lock == 1 ? img_other("arab-forums" , "images/folder/lock.png" , "المنتدى مغلوق" , "" , "" , "0" , "class=\"title\"" , "") : img_other("arab-forums" , "images/folder/new.png" , "المنتدى مفتوح" , "" , "" , "0" , "class=\"title\"" , ""))."</div></td><td><div class=\"pad\">".num_other("arab-forums" , $forum_object->forum_topic)."</div></td></tr></table></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">".num_other("arab-forums" , $forum_object->forum_reply)."</div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".(group_user == 0 ? "--" : num_other("arab-forums" , $forum_object->forum_online))."</div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">".($forum_object->forum_lastdate != "" && $forum_object->forum_lastuser != "" ? "<span style=\"font-size:13px;\">".user_other("arab-forums" , array($forum_object->user_id , $forum_object->user_group , $forum_object->user_nameuser , $forum_object->user_lock1 , $forum_object->user_coloruser , false))."</span><br><nobr>".times_date("arab-forums" , "" , $forum_object->forum_lastdate)."</nobr>" : "")."</div></td>";

echo "<td class=\"alttext1\" align=\"right\"><div class=\"pad\">";

if($forum_object->forum_moderattext == 1){

if($forum_object->forum_mode > 0){echo "<span style=\"font-size:11px;\">مجموعة ".$group_list[$forum_object->forum_mode]."</span>";}

$moderate_sql = select_mysql("arab-forums" , "moderate" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , m.moderate_userid , m.moderate_lock , m.moderate_forumid" , "as m left join user".prefix_connect." as u on(u.user_id = m.moderate_userid) where m.moderate_lock in(0) && m.moderate_forumid in({$forum_object->forum_id})");

if(num_mysql("arab-forums" , $moderate_sql) != false){

$moderate = 0;

if($forum_object->forum_mode > 0){echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";}

while($moderate_object = object_mysql("arab-forums" , $moderate_sql)){

if($forum_object->forum_mode > 0){

if($moderate == 2){echo "<br>";$moderate = 0;}

if($moderate){echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";}

}else{

if($moderate == 3){echo "<br>";$moderate = 0;}

if($moderate){echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";}

}

echo "<span style=\"font-size:11px;\">".user_other("arab-forums" , array($moderate_object->user_id , $moderate_object->user_group , $moderate_object->user_nameuser , $moderate_object->user_lock1 , $moderate_object->user_coloruser , "000000"))."</span>";

$moderate++;

}}

echo "";

echo "</div></td>";

echo "</tr>";

$totaltopic = ($totaltopic+$forum_object->forum_topic);

$totalreply = ($totalreply+$forum_object->forum_reply);

$totalonline = ($totalonline+$forum_object->forum_online);

}}}}

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"7\" align=\"right\"><div class=\"pad\">";

echo "<table cellpadding=\"7\" cellspacing=\"3\" align=\"center\"><tr>";

echo "<td class=\"stats\"><nobr>حالة الفئة : ".($cat_object->cat_lock == 1 ? "مغلوقة" : "مفتوحة")."</nobr></td>";

echo "<td class=\"stats\"><nobr>المواضيع : ".num_other("arab-forums" , $totaltopic)."</nobr></td>";

echo "<td class=\"stats\"><nobr>الردود : ".num_other("arab-forums" , $totalreply)."</nobr></td>";

echo "<td class=\"stats\"><nobr>المتواجدون : ".(group_user == 0 ? "--" : num_other("arab-forums" , $totalonline))."</nobr></td>";

echo "<td class=\"stats\"><nobr>المراقب : ".($cat_object->cat_monitor1 != 0 && $cat_object->cat_monitor1text == 1 ? user_other("arab-forums" , array($cat_object->u1user_id , $cat_object->u1user_group , $cat_object->u1user_name , $cat_object->u1user_lock , $cat_object->u1user_color , false)) : "لا يوجد")."</nobr></td>";

echo "<td class=\"stats\"><nobr>نائب المراقب : ".($cat_object->cat_monitor2 != 0 && $cat_object->cat_monitor2text == 1 ? user_other("arab-forums" , array($cat_object->u2user_id , $cat_object->u2user_group , $cat_object->u2user_name , $cat_object->u2user_lock , $cat_object->u2user_color , false)) : "لا يوجد")."</nobr></td>";

echo "</tr></table>";

echo "</div></td>";

echo "</tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}else{

define("pagebody" , "cat");

online_other("arab-forums" , "cat" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك الدخول إلى الفئة و السبب <br><br>{$errorop}" ,

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