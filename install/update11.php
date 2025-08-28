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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "medal");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[medal_forum] == "-1") {
        $array[medal_forum] = "0";
    } else {
        $array[medal_forum] = $array[medal_forum];
    }

    if ($array[medal_lock] == "1") {
        $array[medal_lock] = "1";
    } elseif ($array[medal_lock] == "2") {
        $array[medal_lock] = "3";
    } else {
        $array[medal_lock] = "0";
    }

    insert_mysql("arab-forums", "medal", "medal_id , medal_forumid , medal_lock , medal_add , medal_date , medal_name , medal_point , medal_url", "\"" . $array[medal_id] . "\" , \"" . $array[medal_forum] . "\" , \"" . $array[medal_lock] . "\" , \"" . $array[medal_user] . "\" , \"" . $array[medal_date] . "\" , \"" . $array[medal_name] . "\" , \"" . $array[medal_point] . "\" , \"" . $array[medal_url] . "\"");
}

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "getmedal");

while ($array  =  @mysql_fetch_assoc($sql)) {

    if ($array[medal_forum] == "-1") {
        $array[medal_forum] = "0";
    } else {
        $array[medal_forum] = $array[medal_forum];
    }

    if ($array[getmedal_lock] == "1") {
        $array[getmedal_lock] = "1";
    } elseif ($array[getmedal_lock] == "2") {
        $array[getmedal_lock] = "3";
    } else {
        $array[getmedal_lock] = "0";
    }

    insert_mysql("arab-forums", "getmedal", "getmedal_id , getmedal_medalid , getmedal_userid , getmedal_lock , getmedal_add , getmedal_date", "\"" . $array[getmedal_id] . "\" , \"" . $array[getmedal_medal_id] . "\" , \"" . $array[getmedal_user] . "\" , \"" . $array[getmedal_lock] . "\" , \"" . $array[getmedal_member] . "\" , \"" . $array[getmedal_date] . "\"");
}

echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال الأوسمة و الأوسمة الموزعة بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=install&type=insertip1\" method=\"post\">";

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
