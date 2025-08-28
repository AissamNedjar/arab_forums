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

define("pagebody" , "rss");

online_other("arab-forums" , "rss" , "0" , "0" , "0" , "0");

header('Content-Type: application/rss+xml');

echo "<?xml version=\"1.0\" encoding=\"windows-1256\"?><rss xmlns:app='http://purl.org/atom/app#' xmlns:atom='http://www.w3.org/2005/Atom' xmlns:openSearch='http://a9.com/-/spec/opensearchrss/1.0/' version=\"2.0\">\n";

echo "<channel>";

echo "<title>".title_option." - rss feed</title>";

$topic_sql = select_mysql("arab-forums" , "topic" , "c.cat_id , c.cat_hid , c.cat_group0 , c.cat_group1 , c.cat_group2 , c.cat_group3 , c.cat_group4 , c.cat_group5 , c.cat_group6 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_group0 , f.forum_group1 , f.forum_group2 , f.forum_group3 , f.forum_group4 , f.forum_group5 , f.forum_group6 , f.forum_mode , t.topic_id , t.topic_forumid , t.topic_name , t.topic_message , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_date" , "as t left join forum".prefix_connect." as f on(f.forum_id = t.topic_forumid) left join cat".prefix_connect." as c on(c.cat_id = f.forum_catid) where f.forum_hid1 in(0) && f.forum_hid2 in(0) && c.cat_hid in(0) && c.cat_group0 in(1) && c.cat_group1 in(1) && c.cat_group2 in(1) && c.cat_group3 in(1) && c.cat_group4 in(1) && c.cat_group5 in(1) && c.cat_group6 in(1) && f.forum_group0 in(1) && f.forum_group1 in(1) && f.forum_group2 in(1) && f.forum_group3 in(1) && f.forum_group4 in(1) && f.forum_group5 in(1) && f.forum_group6 in(1) && t.topic_delete in(0) && t.topic_hid in(0) && t.topic_wait in(0) order by t.topic_date desc limit 30");

if(num_mysql("arab-forums" , $topic_sql) != false){

while($topic_object = object_mysql("arab-forums" , $topic_sql)){

echo "<item>";

echo "<title>".text_other("arab-forums" , $topic_object->topic_name , false , false , false , true , false)."</title>";

echo "<description>".text_other("arab-forums" , $topic_object->topic_message , false , false , false , true , false)."</description>";

echo "<link>http://".showurl_option."/topic.php?id={$topic_object->topic_id}</link>";

echo "<pubDate>".timesrss_date("arab-forums" , $topic_object->topic_date)."</pubDate>";

echo "</item>";

}}

echo "</channel>";

echo "</rss>";

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>