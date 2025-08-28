<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

echo "<form action=\"install.php?go=install&type=insertoption\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"60%\" align=\"center\">";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>عنوآن المنتدى :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input style=\"width:300px\" class=\"input\" name=\"title\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>رآبط المنتدى :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"adress\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>إيميل المنتدى :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"email\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>الكلمات المفتاحية للمنتدى :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input style=\"width:500px\" class=\"input\" name=\"keywords\" value=\"\" type=\"text\"></nobr></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"20%\"><nobr>وصف المنتدى :</nobr></td>";

echo "<td class=\"alttext1\"><nobr><input style=\"width:500px\" class=\"input\" name=\"description\" value=\"\" type=\"text\"></nobr></td>";

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
?>