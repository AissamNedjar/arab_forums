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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "hidtopic");

while ($array  =  @mysql_fetch_assoc($sql)) {

    insert_mysql("arab-forums", "hidtopic", "hidtopic_id , hidtopic_userid , hidtopic_topicid , hidtopic_add , hidtopic_date", "\"" . $array[hidtopic_id] . "\" , \"" . $array[hidtopic_user_id] . "\" , \"" . $array[hidtopic_topic_id] . "\" , \"" . $array[hidtopic_member_id] . "\" , \"" . $array[hidtopic_date] . "\"");
}

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "locktopic");

while ($array  =  @mysql_fetch_assoc($sql)) {

    insert_mysql("arab-forums", "locktopic", "locktopic_id , locktopic_userid , locktopic_topicid , locktopic_add , locktopic_date", "\"" . $array[locktopic_id] . "\" , \"" . $array[locktopic_user_id] . "\" , \"" . $array[locktopic_topic_id] . "\" , \"" . $array[locktopic_member_id] . "\" , \"" . $array[locktopic_date] . "\"");
}

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "iconstopic");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[iconstopic_forum_id] == "-1") {
        $array[iconstopic_forum_id] = "0";
    } else {
        $array[iconstopic_forum_id] = $array[iconstopic_forum_id];
    }

    insert_mysql("arab-forums", "iconstopic", "iconstopic_id , iconstopic_forumid , iconstopic_name , iconstopic_images , iconstopic_add , iconstopic_date", "\"" . $array[iconstopic_id] . "\" , \"" . $array[iconstopic_forum_id] . "\" , \"" . $array[iconstopic_name] . "\" , \"" . $array[iconstopic_url] . "\" , \"" . $array[iconstopic_user_id] . "\" , \"" . $array[iconstopic_date] . "\"");
}

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "texttopic");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[texttopic_forum_id] == "-1") {
        $array[texttopic_forum_id] = "0";
    } else {
        $array[texttopic_forum_id] = $array[texttopic_forum_id];
    }

    insert_mysql("arab-forums", "texttopic", "texttopic_id , texttopic_forumid , texttopic_name , texttopic_add , texttopic_date", "\"" . $array[texttopic_id] . "\" , \"" . $array[texttopic_forum_id] . "\" , \"" . $array[texttopic_name] . "\" , \"" . $array[texttopic_user_id] . "\" , \"" . $array[texttopic_date] . "\"");
}

echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال المواضيع المخفية + المواضيع المغلوقة + الأيقونات + الإختصارات بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable8\" method=\"post\">";

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
