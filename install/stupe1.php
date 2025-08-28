<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if (!defined("error_page_arab_forums")) {
    exit(header("location: ../error.php"));
}

mysql_mysql("arab-forums", "create table option" . prefix_connect . "(

option_id int(10) unsigned not null auto_increment ,

option_name varchar(191) default null ,

option_value varchar(300) default null ,

primary key(option_id))");

mysql_mysql("arab-forums", "create table user" . prefix_connect . "(

user_id int(10) unsigned not null auto_increment ,

user_lock1 int(10) default \"0\" ,

user_lock2 int(10) default \"0\" ,

user_wait int(10) default \"0\" ,

user_bad int(10) default \"0\" ,

user_active int(10) default \"0\" ,

user_namelogin varchar(191) default null ,

user_nameuser varchar(191) default null ,

user_pass varchar(191) default null ,

user_email varchar(191) default null ,

user_coderegister varchar(191) default null ,

user_codepassword varchar(191) default null ,

user_group int(10) default \"1\" ,

user_post int(10) default \"0\" ,

user_topics int(10) default \"0\" ,

user_posts int(10) default \"0\" ,

user_point int(10) default \"0\" ,

user_show int(10) default \"0\" ,

user_dateregister int(10) unsigned default null ,

user_datelastvisite int(10) unsigned default null ,

user_datelastpost int(10) unsigned default null ,

user_chongename int(10) default \"0\" ,

user_lastchongename int(10) unsigned default null ,

user_adressip varchar(20) default null ,

user_lastadressip varchar(20) default null ,

user_photo varchar(255) default null ,

user_jobe varchar(255) default null ,

user_sex varchar(50) default null ,

user_age int(10) default \"1\" ,

user_days int(10) default null ,

user_month int(10) default null ,

user_years int(10) default null ,

user_bio text ,

user_sig text ,

user_country varchar(191) default null ,

user_city varchar(191) default null ,

user_state varchar(191) default null ,

user_titleold int(10) default \"0\" ,

user_editorcolor varchar(191) default \"#000000\" ,

user_editoralign varchar(191) default \"center\" ,

user_editorblod varchar(191) default \"blod\" ,

user_editorfont varchar(191) default \"comic sans ms\" ,

user_editorsize varchar(191) default \"24px\" ,

user_time int(10) default null ,

user_style varchar(191) default null ,

user_coloruser varchar(191) default null ,

user_colorstar varchar(191) default null ,

user_hala int(10) default null ,

primary key(user_id))");

mysql_mysql("arab-forums", "create table online" . prefix_connect . "(

online_id int(10) unsigned not null auto_increment ,

online_userid int(11) default \"0\" ,

online_group int(11) default \"0\" ,

online_type varchar(191) default null ,

online_catid int(11) default \"0\" ,

online_forumid int(11) default \"0\" ,

online_topicid int(11) default \"0\" ,

online_profileid int(11) default \"0\" ,

online_date int(10) unsigned default null ,

online_last int(10) unsigned default null ,

online_ip varchar(191) default null ,

primary key(online_id))");

mysql_mysql("arab-forums", "create table style" . prefix_connect . "(

style_id int(10) unsigned not null auto_increment ,

style_fils varchar(191) default null ,

style_name varchar(191) default null ,

style_default int(10) default null ,

style_lock int(11) default \"0\" ,

style_order int(11) default \"0\" ,

primary key(style_id))");

mysql_mysql("arab-forums", "create table cat" . prefix_connect . "(

cat_id int(10) unsigned not null auto_increment ,

cat_lock int(10) default \"0\" ,

cat_hid int(10) default \"0\" ,

cat_name varchar(191) default null ,

cat_order int(10) default \"1\" ,

cat_home int(10) default \"0\" ,

cat_monitor1 int(10) default \"0\" ,

cat_monitor2 int(10) default \"0\" ,

cat_monitor1text int(10) default \"1\" ,

cat_monitor2text int(10) default \"1\" ,

cat_group0 int(10) default \"1\" ,

cat_group1 int(10) default \"1\" ,

cat_group2 int(10) default \"1\" ,

cat_group3 int(10) default \"1\" ,

cat_group4 int(10) default \"1\" ,

cat_group5 int(10) default \"1\" ,

cat_group6 int(10) default \"1\" ,

cat_post1 int(10) default \"1\" ,

cat_post2 int(10) default \"1\" ,

cat_post3 int(10) default \"1\" ,

cat_post4 int(10) default \"1\" ,

cat_post5 int(10) default \"1\" ,

cat_post6 int(10) default \"1\" ,

primary key(cat_id))");

mysql_mysql("arab-forums", "create table forum" . prefix_connect . "(

forum_id int(10) unsigned not null auto_increment ,

forum_catid int(10) default null ,

forum_lock int(10) default \"0\" ,

forum_hid1 int(10) default \"0\" ,

forum_hid2 int(10) default \"0\" ,

forum_name varchar(191) default null ,

forum_wasaf varchar(250) default null ,

forum_logo varchar(250) default null ,

forum_moderattext int(10) default \"1\" ,

forum_order int(10) default \"1\" ,

forum_topic int(10) default \"0\" ,

forum_reply int(10) default \"0\" ,

forum_lastdate int(10) unsigned default null ,

forum_lastuser int(10) default null ,

forum_sex int(10) default \"0\" ,

forum_phototopic int(10) default \"1\" ,

forum_sigtopic int(10) default \"1\" ,

forum_detailtopic int(10) default \"1\" ,

forum_wasaftopic int(10) default \"1\" ,

forum_photoreply int(10) default \"1\" ,

forum_sigreply int(10) default \"1\" ,

forum_detailreply int(10) default \"1\" ,

forum_wasafreply int(10) default \"1\" ,

forum_totaltopic int(10) default \"20\" ,

forum_totalreply int(10) default \"200\" ,

forum_moderattopic int(10) default \"0\" ,

forum_moderatreply int(10) default \"0\" ,

forum_mode int(10) default \"0\" ,

forum_group0 int(10) default \"1\" ,

forum_group1 int(10) default \"1\" ,

forum_group2 int(10) default \"1\" ,

forum_group3 int(10) default \"1\" ,

forum_group4 int(10) default \"1\" ,

forum_group5 int(10) default \"1\" ,

forum_group6 int(10) default \"1\" ,

forum_post1 int(10) default \"1\" ,

forum_post2 int(10) default \"1\" ,

forum_post3 int(10) default \"1\" ,

forum_post4 int(10) default \"1\" ,

forum_post5 int(10) default \"1\" ,

forum_post6 int(10) default \"1\" ,

forum_visitortopicshow int(10) default \"1\" ,

forum_visitorreplyshow int(10) default \"1\" ,

forum_urlshowtopic int(10) default \"0\" ,

forum_urlshowreply int(10) default \"0\" ,

primary key(forum_id))");

mysql_mysql("arab-forums", "create table moderate" . prefix_connect . "(

moderate_id int(10) unsigned not null auto_increment ,

moderate_userid int(11) default null ,

moderate_forumid int(11) default null ,

moderate_catid int(11) default null ,

moderate_lock int(11) default \"0\" ,

moderate_add int(11) default null ,

moderate_date int(10) unsigned default null ,

primary key(moderate_id))");

mysql_mysql("arab-forums", "create table hidforum" . prefix_connect . "(

hidforum_id int(10) unsigned not null auto_increment ,

hidforum_userid int(11) default null ,

hidforum_forumid int(11) default null ,

hidforum_catid int(11) default null ,

hidforum_add int(11) default null ,

hidforum_date int(10) unsigned default null ,

primary key(hidforum_id))");

mysql_mysql("arab-forums", "create table ip" . prefix_connect . "(

ip_id int(10) unsigned not null auto_increment ,

ip_ip varchar(20) default null ,

ip_user int(10) default null ,

ip_date int(10) unsigned default null ,

ip_type int(10) default null ,

ip_code varchar(2) default null ,

primary key(ip_id))");

mysql_mysql("arab-forums", "create table iconsheader" . prefix_connect . "(

iconsheader_id int(10) unsigned not null auto_increment ,

iconsheader_lock int(10) default \"0\" ,

iconsheader_order int(10) default \"1\" ,

iconsheader_open int(10) default \"0\" ,

iconsheader_name varchar(255) default null ,

iconsheader_link varchar(255) default null ,

iconsheader_images varchar(255) default null ,

iconsheader_group0 int(10) default \"1\" ,

iconsheader_group1 int(10) default \"1\" ,

iconsheader_group2 int(10) default \"1\" ,

iconsheader_group3 int(10) default \"1\" ,

iconsheader_group4 int(10) default \"1\" ,

iconsheader_group5 int(10) default \"1\" ,

iconsheader_group6 int(10) default \"1\" ,

primary key(iconsheader_id))");

mysql_mysql("arab-forums", "create table couip" . prefix_connect . "(

couip_id int(10) unsigned not null auto_increment ,

couip_star varchar(20) default null ,

couip_end varchar(20) default null ,

couip_code varchar(2) default null ,

primary key(couip_id))");

mysql_mysql("arab-forums", "create table topic" . prefix_connect . "(

topic_id int(10) unsigned not null auto_increment ,

topic_forumid int(10) default null ,

topic_lock int(10) default \"0\" ,

topic_wait int(10) default \"0\" ,

topic_delete int(10) default \"0\" ,

topic_hid int(10) default \"0\" ,

topic_stiky int(10) default \"0\" ,

topic_top int(10) default \"0\" ,

topic_link int(10) default \"0\" ,

topic_linkorder int(10) default \"1\" ,

topic_survey int(10) default \"0\" ,

topic_icons int(10) default \"0\" ,

topic_text int(10) default \"0\" ,

topic_img int(10) default \"0\" ,

topic_url int(10) default \"0\" ,

topic_optionlock int(10) default \"0\" ,

topic_reply int(10) default \"0\" ,

topic_visit int(10) default \"0\" ,

topic_date int(10) unsigned default null ,

topic_user int(10) default null ,

topic_lastdate int(10) unsigned default null ,

topic_lastuser int(10) default null ,

topic_name varchar(191) default null ,

topic_message text default null ,

primary key(topic_id))");

mysql_mysql("arab-forums", "create table hidtopic" . prefix_connect . "(

hidtopic_id int(10) unsigned not null auto_increment ,

hidtopic_userid int(11) default null ,

hidtopic_topicid int(11) default null ,

hidtopic_add int(11) default null ,

hidtopic_date int(10) unsigned default null ,

primary key(hidtopic_id))");

mysql_mysql("arab-forums", "create table locktopic" . prefix_connect . "(

locktopic_id int(10) unsigned not null auto_increment ,

locktopic_userid int(11) default null ,

locktopic_topicid int(11) default null ,

locktopic_add int(11) default null ,

locktopic_date int(10) unsigned default null ,

primary key(locktopic_id))");

mysql_mysql("arab-forums", "create table optiontopic" . prefix_connect . "(

optiontopic_id int(10) unsigned not null auto_increment ,

optiontopic_topicid int(11) default null ,

optiontopic_user int(11) default null ,

optiontopic_date int(10) unsigned default null ,

optiontopic_type varchar(191) default null ,

primary key(optiontopic_id))");

mysql_mysql("arab-forums", "create table edittopic" . prefix_connect . "(

edittopic_id int(10) unsigned not null auto_increment ,

edittopic_topicid int(11) default null ,

edittopic_user int(11) default null ,

edittopic_date int(10) unsigned default null ,

edittopic_name varchar(191) default null ,

edittopic_message text default null ,

primary key(edittopic_id))");

mysql_mysql("arab-forums", "create table reply" . prefix_connect . "(

reply_id int(10) unsigned not null auto_increment ,

reply_topicid int(10) default null ,

reply_wait int(10) default \"0\" ,

reply_delete int(10) default \"0\" ,

reply_hid int(10) default \"0\" ,

reply_top int(10) default \"0\" ,

reply_img int(10) default \"0\" ,

reply_url int(10) default \"0\" ,

reply_date int(10) unsigned default null ,

reply_user int(10) default null ,

reply_message text default null ,

primary key(reply_id))");

mysql_mysql("arab-forums", "create table optionreply" . prefix_connect . "(

optionreply_id int(10) unsigned not null auto_increment ,

optionreply_replyid int(11) default null ,

optionreply_user int(11) default null ,

optionreply_date int(10) unsigned default null ,

optionreply_type varchar(191) default null ,

primary key(optionreply_id))");

mysql_mysql("arab-forums", "create table editreply" . prefix_connect . "(

editreply_id int(10) unsigned not null auto_increment ,

editreply_replyid int(11) default null ,

editreply_user int(11) default null ,

editreply_date int(10) unsigned default null ,

editreply_message text default null ,

primary key(editreply_id))");

mysql_mysql("arab-forums", "create table registerband" . prefix_connect . "(

registerband_id int(10) unsigned not null auto_increment ,

registerband_name varchar(191) default null ,

registerband_user int(11) default null ,

registerband_date int(10) unsigned default null ,

primary key(registerband_id))");

mysql_mysql("arab-forums", "create table monitortopic" . prefix_connect . "(

monitortopic_id int(10) unsigned not null auto_increment ,

monitortopic_topicid int(11) default null ,

monitortopic_userid int(11) default null ,

monitortopic_date int(10) unsigned default null ,

primary key(monitortopic_id))");

mysql_mysql("arab-forums", "create table notify" . prefix_connect . "(

notify_id int(10) unsigned not null auto_increment ,

notify_delete int(10) default \"0\" ,

notify_forumid int(11) default null ,

notify_topicid int(11) default null ,

notify_replyid int(11) default null ,

notify_msgid int(11) default null ,

notify_userid int(11) default null ,

notify_usersend int(11) default null ,

notify_datesend int(10) unsigned default null ,

notify_userlock int(11) default null ,

notify_datelock int(10) unsigned default null ,

notify_name varchar(191) default null ,

notify_text text default null ,

notify_type varchar(191) default null ,

notify_reply text default null ,

primary key(notify_id))");

mysql_mysql("arab-forums", "create table iconstopic" . prefix_connect . "(

iconstopic_id int(10) unsigned not null auto_increment ,

iconstopic_forumid int(11) default null ,

iconstopic_name varchar(255) default null ,

iconstopic_images varchar(255) default null ,

iconstopic_add int(11) default null ,

iconstopic_date int(10) unsigned default null ,

primary key(iconstopic_id))");

mysql_mysql("arab-forums", "create table texttopic" . prefix_connect . "(

texttopic_id int(10) unsigned not null auto_increment ,

texttopic_forumid int(11) default null ,

texttopic_name varchar(255) default null ,

texttopic_add int(11) default null ,

texttopic_date int(10) unsigned default null ,

primary key(texttopic_id))");

mysql_mysql("arab-forums", "create table optionuser" . prefix_connect . "(

optionuser_id int(10) unsigned not null auto_increment ,

optionuser_userid int(11) default null ,

optionuser_user int(11) default null ,

optionuser_date int(10) unsigned default null ,

optionuser_type varchar(191) default null ,

optionuser_msg text default null ,

primary key(optionuser_id))");

mysql_mysql("arab-forums", "create table changename" . prefix_connect . "(

changename_id int(10) unsigned not null auto_increment ,

changename_userid int(11) default null ,

changename_wait int(10) default \"0\" ,

changename_nameold varchar(191) default null ,

changename_namenew varchar(191) default null ,

changename_date int(10) unsigned default null ,

primary key(changename_id))");

mysql_mysql("arab-forums", "create table message" . prefix_connect . "(

message_id int(10) unsigned not null auto_increment ,

message_delete int(10) default \"0\"  ,

message_getid int(10) default null  ,

message_getmy int(10) default null  ,

message_getto int(10) default null  ,

message_getto2 int(10) default null  ,

message_folder int(10) default null  ,

message_type int(10) default null  ,

message_reade int(10) default \"0\"  ,

message_reply int(10) default \"0\"  ,

message_date int(10) unsigned default null ,

message_name varchar(191) default null ,

message_message text default null ,

primary key(message_id))");

mysql_mysql("arab-forums", "create table ads" . prefix_connect . "(

ads_id int(10) unsigned not null auto_increment ,

ads_lock int(10) default \"0\" ,

ads_order int(10) default \"1\" ,

ads_open int(10) default \"0\" ,

ads_br int(10) default \"0\" ,

ads_name varchar(255) default null ,

ads_link varchar(255) default null ,

ads_images varchar(255) default null ,

primary key(ads_id))");

mysql_mysql("arab-forums", "create table pmlist" . prefix_connect . "(

pmlist_id int(10) unsigned not null auto_increment ,

pmlist_user int(10) default null  ,

pmlist_folder int(11) default null  ,

pmlist_name varchar(191) default null ,

primary key(pmlist_id))");

mysql_mysql("arab-forums", "create table slide" . prefix_connect . "(

slide_id int(10) unsigned not null auto_increment ,

slide_order int(10) default \"1\" ,

slide_name varchar(255) default null ,

slide_link varchar(255) default null ,

slide_images varchar(255) default null ,

primary key(slide_id))");

mysql_mysql("arab-forums", "create table wasaf" . prefix_connect . "(

wasaf_id int(10) unsigned not null auto_increment ,

wasaf_forumid int(10) default \"0\" ,

wasaf_forumall int(10) default \"0\" ,

wasaf_lock int(10) default \"0\" ,

wasaf_add int(10) default null ,

wasaf_date int(10) unsigned default null ,

wasaf_name varchar(191) default null ,

primary key(wasaf_id))");

mysql_mysql("arab-forums", "create table getwasaf" . prefix_connect . "(

getwasaf_id int(10) unsigned not null auto_increment ,

getwasaf_wasafid int(10) default \"0\" ,

getwasaf_userid int(10) default null ,

getwasaf_lock int(10) default \"0\" ,

getwasaf_add int(10) default null ,

getwasaf_date int(10) unsigned default null ,

primary key(getwasaf_id))");

mysql_mysql("arab-forums", "create table medal" . prefix_connect . "(

medal_id int(10) unsigned not null auto_increment ,

medal_forumid int(10) default \"0\" ,

medal_lock int(10) default \"0\" ,

medal_add int(10) default null ,

medal_date int(10) unsigned default null ,

medal_point int(10) default \"0\" ,

medal_name varchar(191) default null ,

medal_url varchar(191) default null ,

primary key(medal_id))");

mysql_mysql("arab-forums", "create table getmedal" . prefix_connect . "(

getmedal_id int(10) unsigned not null auto_increment ,

getmedal_medalid int(10) default \"0\" ,

getmedal_userid int(10) default null ,

getmedal_lock int(10) default \"0\" ,

getmedal_add int(10) default null ,

getmedal_date int(10) unsigned default null ,

primary key(getmedal_id))");

echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم تركيب جداول المنتدى بنجآح تآم<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=install&type=option\" method=\"post\">";

echo "<td class=\"tcat\"><nobr><input class=\"button\" value=\"الإنتقال إلى الخطوة التالية\" type=\"submit\"></nobr></td>";

echo "</form>";

echo "</tr>";

echo "</table>";

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
