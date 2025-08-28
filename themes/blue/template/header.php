<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../../../error.php"));}

function header_template($copi , $array){

if($copi == "arab-forums"){

global $gets;

$template  = "";

$template .= "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"3\"><tr>";

$template .= "<td width=\"100%\"><nobr>".a_other("arab-forums" , "home.php" , title_option , img_other("arab-forums" , "themes/".forum_style."/images/logo.png?v=1516" , "" , "" , "" , "0" , "" , "") , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "home.php" , "الرئيسية" , img_other("arab-forums" , "themes/".forum_style."/images/home.png" , "" , "" , "" , "0" , "" , "")."<br>الرئيسية" , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "members.php" , "الأعضاء" , img_other("arab-forums" , "themes/".forum_style."/images/members.png" , "" , "" , "" , "0" , "" , "")."<br>الأعضاء" , "")."</nobr></td>";

if(group_user > 0){

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "mtopic.php" , "مواضيعك" , img_other("arab-forums" , "themes/".forum_style."/images/mtopic.png" , "" , "" , "" , "0" , "" , "")."<br>مواضيعك" , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "mposts.php" , "مشاركاتك" , img_other("arab-forums" , "themes/".forum_style."/images/mposts.png" , "" , "" , "" , "0" , "" , "")."<br>مشاركاتك" , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "monitor.php" , "المفضلة" , img_other("arab-forums" , "themes/".forum_style."/images/monitor.png" , "" , "" , "" , "0" , "" , "")."<br>المفضلة" , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "message.php" , "الرسائل" , img_other("arab-forums" , "themes/".forum_style."/images/message.png" , "" , "" , "" , "0" , "" , "")."<br>الرسائل" , "")."</nobr></td>";

}

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "active.php" , "مواضيع نشطة" , img_other("arab-forums" , "themes/".forum_style."/images/active.png" , "" , "" , "" , "0" , "" , "")."<br>مواضيع نشطة" , "")."</nobr></td>";

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "search.php" , "إبحث" , img_other("arab-forums" , "themes/".forum_style."/images/search.png" , "" , "" , "" , "0" , "" , "")."<br>إبحث" , "")."</nobr></td>";

if(helpforum_option != 0){

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "forum.php?id=".helpforum_option."" , "مساعدة" , img_other("arab-forums" , "themes/".forum_style."/images/help.png" , "" , "" , "" , "0" , "" , "")."<br>مساعدة" , "")."</nobr></td>";

}

if(group_user > 0){

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "data.php" , "بيانتك" , img_other("arab-forums" , "themes/".forum_style."/images/data.png" , "" , "" , "" , "0" , "" , "")."<br>بيانتك" , "")."</nobr></td>";

}

if(group_user == 0){

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "register.php" , "التسجيل" , img_other("arab-forums" , "themes/".forum_style."/images/register.png" , "" , "" , "" , "0" , "" , "")."<br>التسجيل" , "")."</nobr></td>";

}else{

$template .= "<td class=\"menu\"><nobr>".a_other("arab-forums" , "logout.php?go=".(md5(id_user*51285858585455*sqlcode_connect))."" , "خروج !" , img_other("arab-forums" , "themes/".forum_style."/images/logout.png" , "" , "" , "" , "0" , "" , "")."<br>خروج !" , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد تسجيل الخروج ؟"))."</nobr></td>";

}

$template .= "</tr></table><br><br><br><br><br>";

if($array["login"] == true){

$template .= "<center><table width=\"99%\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\" class=\"user\"><tr>";

$template .= "<td width=\"100%\">";

if(group_user == 0){

$template .= "<form action=\"login.php\" method=\"post\">";

$template .= "<input style=\"width:120px\" class=\"input\" name=\"login_username\" value=\"إسم المستخدم\" onfocus=\"this.value=(this.value=='إسم المستخدم') ? '' : this.value;\" onblur=\"this.value=(this.value=='') ? 'إسم المستخدم' : this.value;\" type=\"text\">";

$template .= "&nbsp;<input name=\"login_usersave\" value=\"1\" id=\"usersave\" type=\"checkbox\"><label for=\"usersave\">البقاء متصلا ؟</label>";

$template .= "<br><br>";

$template .= "<input style=\"width:120px\" class=\"input\" name=\"login_userpass\" value=\"الكلمة السرية\" onfocus=\"this.value=(this.value=='الكلمة السرية') ? '' : this.value;\" onblur=\"this.value=(this.value=='') ? 'الكلمة السرية' : this.value;\"type=\"password\">";

$template .= "&nbsp;<input class=\"button\" value=\"تسجيل الدخول\" type=\"submit\">";

$template .= "</form>";

$template .= "<br>";

$template .= "".a_other("arab-forums" , "recover.php" , "نسيت الكلمة السرية الخاص بي" , "هل نسيت الكلمة السرية ؟" , "")." || ".a_other("arab-forums" , "register.php" , "أريد تسجيل عضوية جديدة بالمنتدى" , "أو تريد تسجيل عضوية جديدة ؟" , "")."";

}else{

$msguser = num_mysql("arab-forums" , select_mysql("arab-forums" , "message" , "message_id , message_getid , message_reade , message_folder , message_delete" , "where message_getid in(".id_user.") && message_reade in(0) && message_delete in(0) && message_folder in(-1)"));

$template .= "أهلا و سهلا بك يا : ".a_other("arab-forums" , "profile.php?id=".id_user."" , "أهلا و سهلا بك يا : ".name_user , name_user , "")."";

$template .= "<br><br>المشاركات الخاصة بك : ".a_other("arab-forums" , "mposts.php" , "المشاركات الخاصة بك : ".num_other("arab-forums" , post_user) , num_other("arab-forums" , post_user) , "")."";

$template .= "<br><br>الرسائل الجديدة : ".a_other("arab-forums" , "message.php" , "الرسائل الجديدة : {$msguser}" , "{$msguser}" , "")."";

if(group_user == 6){

$notifyadmin = num_mysql("arab-forums" , select_mysql("arab-forums" , "notify" , "notify_id , notify_delete , notify_type" , "where notify_delete in(0) && notify_type = \"msg\""));

$msgadmin = num_mysql("arab-forums" , select_mysql("arab-forums" , "message" , "message_id , message_getid , message_reade , message_folder , message_delete" , "where message_getid in(0) && message_reade in(0) && message_delete in(0) && message_folder in(-1)"));

$template .= " || بريد الإدارة : ".a_other("arab-forums" , "message.php?admin=true" , "بريد الإدارة : {$msgadmin}" , "{$msgadmin}" , "")."";

$template .= " || شكاوي الإدارة : ".a_other("arab-forums" , "notify.php?go=showall&fort=admin" , "شكاوي الإدارة : {$notifyadmin}" , "{$notifyadmin}" , "")."";

}

if(group_user > 1){

$totaltopic = num_mysql("arab-forums" , select_mysql("arab-forums" , "topic" , "topic_id , topic_forumid , topic_wait , topic_delete" , "where topic_forumid in(".allowedin1_other("arab-forums").") && topic_wait in(1) && topic_delete in(0)"));

$totalreply = num_mysql("arab-forums" , select_mysql("arab-forums" , "reply" , "r.reply_id  , r.reply_topicid , r.reply_wait , r.reply_delete , t.topic_id , t.topic_forumid , t.topic_delete" , "as r left join topic".prefix_connect." as t on(t.topic_id = r.reply_topicid) where t.topic_forumid in(".allowedin1_other("arab-forums").") && r.reply_wait in(1) && r.reply_delete in(0) && t.topic_delete in(0)"));

$template .= "<br><br>مواضيع تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=topicreply&go=topicreply_topicwait" , "مواضيع تنتظر الموافقة : {$totaltopic}" , "{$totaltopic}" , "")."";

$template .= " || ردود تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=topicreply&go=topicreply_replywait" , "ردود تنتظر الموافقة : {$totalreply}" , "{$totalreply}" , "")."";

}

if(group_user > 2){

$totalwasaf = num_mysql("arab-forums" , select_mysql("arab-forums" , "wasaf" , "wasaf_id , wasaf_forumid , wasaf_lock" , "where wasaf_forumid in(".allowedin1_other("arab-forums").") && wasaf_lock in(1)"));

$totalgetwasaf = num_mysql("arab-forums" , select_mysql("arab-forums" , "getwasaf" , "g.getwasaf_id  , g.getwasaf_wasafid , g.getwasaf_lock , w.wasaf_id , w.wasaf_forumid , w.wasaf_lock" , "as g left join wasaf".prefix_connect." as w on(w.wasaf_id = g.getwasaf_wasafid) where w.wasaf_forumid in(".allowedin1_other("arab-forums").") && g.getwasaf_lock in(1) && w.wasaf_lock in(0)"));

$totalmedal = num_mysql("arab-forums" , select_mysql("arab-forums" , "medal" , "medal_id , medal_forumid , medal_lock" , "where medal_forumid in(".allowedin1_other("arab-forums").") && medal_lock in(1)"));

$totalgetmedal = num_mysql("arab-forums" , select_mysql("arab-forums" , "getmedal" , "g.getmedal_id  , g.getmedal_medalid , g.getmedal_lock , w.medal_id , w.medal_forumid , w.medal_lock" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) where w.medal_forumid in(".allowedin1_other("arab-forums").") && g.getmedal_lock in(1) && w.medal_lock in(0)"));

$template .= "<br><br>أوصاف تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_list&type=wait" , "أوصاف تنتظر الموافقة : {$totalwasaf}" , "{$totalwasaf}" , "")."";

$template .= " || أوصاف موزعة تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=wasaf&go=wasaf_listgo&type=wait" , "أوصاف موزعة تنتظر الموافقة : {$totalgetwasaf}" , "{$totalgetwasaf}" , "")."";

$template .= " || أوسمة تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=medal&go=medal_list&type=wait" , "أوسمة تنتظر الموافقة : {$totalmedal}" , "{$totalmedal}" , "")."";

$template .= " || أوسمة موزعة تنتظر الموافقة : ".a_other("arab-forums" , "service.php?gert=medal&go=medal_listgo&type=wait" , "أوسمة موزعة تنتظر الموافقة : {$totalgetmedal}" , "{$totalgetmedal}" , "")."";

}

if(group_user == 6){

$moderatwait = num_mysql("arab-forums" , select_mysql("arab-forums" , "moderate" , "moderate_id , moderate_lock" , "where moderate_lock in(2)"));

$userwait = num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active" , "where user_wait in(1) && user_active in(0)"));

$namewait = num_mysql("arab-forums" , select_mysql("arab-forums" , "changename" , "changename_id , changename_wait" , "where changename_wait in(1)"));

$template .= "<br><br>تعيينات تنتظر الموافقة : ".a_other("arab-forums" , "moderator.php" , "تعيينات تنتظر الموافقة : {$moderatwait}" , "{$moderatwait}" , "")."";

$template .= " || عضويات تنتظر الموافقة : ".a_other("arab-forums" , "admin.php?gert=wait&go=wait_user" , "عضويات تنتظر الموافقة : {$userwait}" , "{$userwait}" , "")."";

$template .= " || أسماء تنتظر الموافقة : ".a_other("arab-forums" , "admin.php?gert=wait&go=wait_name" , "أسماء تنتظر الموافقة : {$namewait}" , "{$namewait}" , "")."";

}

if(group_user > 1){

$ip_sql = select_mysql("arab-forums" , "ip" , "ip_ip , ip_user , ip_date , ip_type , ip_code" , "where ip_user in(".id_user.") && ip_type in(2) order by ip_date desc");

if(num_mysql("arab-forums" , $ip_sql) != false){

$ip_object = object_mysql("arab-forums" , $ip_sql);

$template .= "<br><br>تتبع آخر دخول : ".a_other("arab-forums" , "mip.php" , "تتبع آخر دخول" , (group_user > 2 ? $ip_object->ip_ip : hasip_other("arab-forums" , $ip_object->ip_ip)) , "")." || ".countip_other("arab-forums" , $ip_object->ip_code)." || ".img_other("arab-forums" , "images/flags/".strtolower($ip_object->ip_code).".png" , countip_other("arab-forums" , $ip_object->ip_code) , "" , "" , "0" , "class=\"title\"" , "")."";

}}}

$template .= "</td>";

$template .= "<td valign=\"top\" width=\"100%\"></td>";

$template .= "<td valign=\"top\">";

if(group_user > 1){

$template .= "<td valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"menu\"><nobr>".a_other("arab-forums" , "service.php" , "خدمات الإشراف" , img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "") , "")."</nobr></td></tr></table></td>";

}

if(group_user > 3){

$template .= "<td valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"menu\"><nobr>".a_other("arab-forums" , "moderator.php" , "التعيينات الإشرافية" , img_other("arab-forums" , "images/moderator.png" , "" , "" , "" , "0" , "" , "") , "")."</nobr></td></tr></table></td>";

}

if(group_user == 6){

$template .= "<td valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"menu\"><nobr>".a_other("arab-forums" , "admin.php" , "الإدارة العامة" , img_other("arab-forums" , "images/admin.png" , "" , "" , "" , "0" , "" , "") , "")."</nobr></td></tr></table></td>";

$template .= "<td valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"menu\"><nobr>".a_other("arab-forums" , "plugin.php" , "الإضافات البرمجية" , img_other("arab-forums" , "images/plugin.png" , "" , "" , "" , "0" , "" , "") , "")."</nobr></td></tr></table></td>";

}

$iconsheader_sql = select_mysql("arab-forums" , "iconsheader" , "iconsheader_lock , iconsheader_order , iconsheader_open , iconsheader_name , iconsheader_link , iconsheader_images , iconsheader_group".group_user."" , "where iconsheader_lock in(0) && iconsheader_group".group_user." in(1) order by iconsheader_order asc");

if(num_mysql("arab-forums" , $iconsheader_sql) != false){

while($iconsheader_object = object_mysql("arab-forums" , $iconsheader_sql)){

if($iconsheader_object->iconsheader_open == 1){$openurl = "target=\"_blank\"";}else{$openurl = "";}

$template .= "<td valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"menu\"><nobr>".a_other("arab-forums" , $iconsheader_object->iconsheader_link , $iconsheader_object->iconsheader_name , img_other("arab-forums" , $iconsheader_object->iconsheader_images , "" , "" , "" , "0" , "" , "") , $openurl)."</nobr></td></tr></table></td>";

}}

$template .= "</td>";

$template .= "</tr></table></center>";

}

$slide_sql = select_mysql("arab-forums" , "slide" , "slide_order , slide_name , slide_link , slide_images" , "order by slide_order asc , slide_id asc");

if(num_mysql("arab-forums" , $slide_sql) != false){

$template .= "<br><div class=\"head_ads_s\"><div id=\"wrapper_work\"><div class=\"image_carousel\"><div id=\"foo4\">";

while($slide_object = object_mysql("arab-forums" , $slide_sql)){

$template .= a_other("arab-forums" , "topic.php?id={$slide_object->slide_link}" , $slide_object->slide_name , img_other("arab-forums" , $slide_object->slide_images , "" , "201" , "127" , "0" , "" , "") , "");

}

$template .= "</div></div><div class=\"clearfix\"></div>";

$template .= "<a style=\"display: block;\" class=\"prev\" id=\"foo4_prev\" href=\"#\"><span>prev</span></a>";

$template .= "<a style=\"display: block;\" class=\"next\" id=\"foo4_next\" href=\"#\"><span>next</span></a>";

$template .= "<div class=\"pagination\" id=\"foo4_pag\"></div>";

$template .= "</div></div><br><br>";

}

if(ads1_option == 1){

$template .= "<br><br><center>";

$template .= "<script type=\"text/javascript\">";

$template .= "google_ad_client = \"".client1_option."\";";

$template .= "google_ad_slot = \"".slot1_option."\";";

$template .= "google_ad_width = 728;";

$template .= "google_ad_height = 90;";

$template .= "</script>";

$template .= "<script type=\"text/javascript\" src=\"".url1_option."\"></script>";

$template .= "</center>";

}

$ads_sql = select_mysql("arab-forums" , "ads" , "ads_lock , ads_order , ads_open , ads_br , ads_name , ads_link , ads_images" , "where ads_lock in(0) order by ads_order asc , ads_id asc");

if(num_mysql("arab-forums" , $ads_sql) != false){

$numqds = 0;

$template .= "<br><br><table cellpadding=\"2\" cellspacing=\"0\" align=\"center\"><tr><td align=\"center\" valign=\"top\">";

while($ads_object = object_mysql("arab-forums" , $ads_sql)){

if($ads_object->ads_open == 1){$openurl = "target=\"_blank\"";}else{$openurl = "";}

$template .= "".($ads_object->ads_br == 1 && $numqds != 0 ? "<br><br>" : "")."".a_other("arab-forums" , $ads_object->ads_link , $ads_object->ads_name , img_other("arab-forums" , $ads_object->ads_images , "" , "" , "" , "0" , "" , "") , $openurl)."&nbsp;&nbsp;";

$numqds++;

}

$template .= "</td></tr></table>";

}

$template .= "<br><br>";

return $template;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>