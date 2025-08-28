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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "wasaf");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[wasaf_forum] == "-1") {
        $array[wasaf_forum] = "0";
    } else {
        $array[wasaf_forum] = $array[wasaf_forum];
    }

    if ($array[wasaf_lock] == "1") {
        $array[wasaf_lock] = "1";
    } elseif ($array[wasaf_lock] == "2") {
        $array[wasaf_lock] = "3";
    } else {
        $array[wasaf_lock] = "0";
    }

    insert_mysql("arab-forums", "wasaf", "wasaf_id , wasaf_forumid , wasaf_forumall , wasaf_lock , wasaf_add , wasaf_date , wasaf_name", "\"" . $array[wasaf_id] . "\" , \"" . $array[wasaf_forum] . "\" , \"" . $array[wasaf_all] . "\" , \"" . $array[wasaf_lock] . "\" , \"" . $array[wasaf_user] . "\" , \"" . $array[wasaf_date] . "\" , \"" . $array[wasaf_name] . "\"");
}

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "getwasaf");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[wasaf_forum] == "-1") {
        $array[wasaf_forum] = "0";
    } else {
        $array[wasaf_forum] = $array[wasaf_forum];
    }

    if ($array[getwasaf_lock] == "1") {
        $array[getwasaf_lock] = "1";
    } elseif ($array[getwasaf_lock] == "2") {
        $array[getwasaf_lock] = "3";
    } else {
        $array[getwasaf_lock] = "0";
    }

    insert_mysql("arab-forums", "getwasaf", "getwasaf_id , getwasaf_wasafid , getwasaf_userid , getwasaf_lock , getwasaf_add , getwasaf_date", "\"" . $array[getwasaf_id] . "\" , \"" . $array[getwasaf_wasaf_id] . "\" , \"" . $array[getwasaf_user] . "\" , \"" . $array[getwasaf_lock] . "\" , \"" . $array[getwasaf_member] . "\" , \"" . $array[getwasaf_date] . "\"");
}

echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال الأوصاف و الأوصاف الموزعة بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable9\" method=\"post\">";

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
