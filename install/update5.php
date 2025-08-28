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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "forum");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[forum_last_d] == "") {

        $array[forum_last_d] = "null";
    } else {

        $array[forum_last_d] = "\"" . $array[forum_last_d] . "\"";
    }

    if ($array[forum_last_u] == "") {

        $array[forum_last_u] = "null";
    } else {

        $array[forum_last_u] = "\"" . $array[forum_last_u] . "\"";
    }

    insert_mysql("arab-forums", "forum", "forum_id , forum_catid , forum_lock , forum_hid1 , forum_hid2 , forum_name , forum_wasaf , forum_logo , forum_moderattext , forum_order , forum_topic , forum_reply , forum_lastdate , forum_lastuser , forum_sex , forum_mode , forum_group0 , forum_group1 ,forum_group2 , forum_group3 , forum_group4 , forum_group5 , forum_group6", "\"" . $array[forum_id] . "\" , \"" . $array[forum_cat_id] . "\" , \"" . $array[forum_lock] . "\" , \"" . $array[forum_hid1] . "\" , \"" . $array[forum_hid2] . "\" , \"" . $array[forum_name] . "\" , \"" . $array[forum_wasaf] . "\" , \"" . $array[forum_logo] . "\" , \"1\" , \"" . $array[forum_order] . "\" , \"" . $array[forum_topic] . "\" , \"" . $array[forum_reply] . "\" , " . $array[forum_last_d] . " , " . $array[forum_last_u] . " , \"" . $array[forum_sex] . "\" , \"" . $array[forum_mode] . "\" , \"" . $array[forum_group0] . "\" , \"" . $array[forum_group1] . "\" , \"" . $array[forum_group2] . "\" , \"" . $array[forum_group3] . "\" , \"" . $array[forum_group4] . "\" , \"" . $array[forum_group5] . "\" , \"" . $array[forum_group6] . "\"");
}

echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال المنتديات بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable4\" method=\"post\">";

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
