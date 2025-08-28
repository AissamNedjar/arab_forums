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

echo "<form action=\"install.php?go=install&type=insertadmin\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>إسم عضوية المدير :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>باس عضوية المدير :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input style=\"width:300px\" class=\"input\" name=\"pass\" value=\"\" type=\"password\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>إيميل عضوية المدير :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"email\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><nobr><input class=\"button\" value=\"الإنتقال إلى الخطوة التالية\" type=\"submit\"></nobr></td>";

echo "</tr>";

echo "</table>";

echo "</form>";

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
