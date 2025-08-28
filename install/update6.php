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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "moderate");

while ($array  =  @mysql_fetch_assoc($sql)) {

    insert_mysql("arab-forums", "moderate", "moderate_id , moderate_userid , moderate_forumid , moderate_catid , moderate_lock , moderate_add , moderate_date", "\"" . $array[moderate_id] . "\" , \"" . $array[moderate_user_id] . "\" , \"" . $array[moderate_forum_id] . "\" , \"" . $array[moderate_cat_id] . "\" , \"0\" , \"" . $array[moderate_member_id] . "\" , \"" . $array[moderate_date] . "\"");
}

echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال المشرفين بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable5\" method=\"post\">";

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
