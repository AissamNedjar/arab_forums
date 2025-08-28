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

$sql  =  @mysql_query("select * from " . $connect["prefix"] . "cat");

while ($array  =  @mysql_fetch_assoc($sql)) {

    insert_mysql("arab-forums", "cat", "cat_id , cat_lock , cat_hid , cat_name , cat_order , cat_monitor1 , cat_monitor2 , cat_monitor1text , cat_monitor2text , cat_group0 , cat_group1 , cat_group2 , cat_group3 , cat_group4 , cat_group5 , cat_group6", "\"" . $array[cat_id] . "\" , \"" . $array[cat_lock] . "\" , \"" . $array[cat_hid] . "\" , \"" . $array[cat_name] . "\" , \"" . $array[cat_order] . "\" , \"" . $array[cat_monitor1] . "\" , \"" . $array[cat_monitor2] . "\" , \"1\" , \"1\" , \"" . $array[cat_group0] . "\" , \"" . $array[cat_group1] . "\" , \"" . $array[cat_group2] . "\" , \"" . $array[cat_group3] . "\" , \"" . $array[cat_group4] . "\" , \"" . $array[cat_group5] . "\" , \"" . $array[cat_group6] . "\"");
}

echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال الفئات بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable3\" method=\"post\">";

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
