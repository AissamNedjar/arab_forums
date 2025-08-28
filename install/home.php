<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

echo "<table cellpadding=\"10\" cellspacing=\"10\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"menu\"><nobr>".a_other("arab-forums" , "install.php?go=install" , "تنصيب النسخة من 0" , img_other("arab-forums" , "themes/install.png" , "تنصيب النسخة من 0" , "" , "" , "0" , "" , "")."<br>تنصيب النسخة من 0" , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد تركيب النسخة من 0 ؟"))."</nobr></td>";

echo "<td class=\"menu\"><nobr>".a_other("arab-forums" , "install.php?go=updatec0lddz" , "الترقية من نسخة c0lddz forum" , img_other("arab-forums" , "themes/update.png" , "الترقية من نسخة c0lddz forum" , "" , "" , "0" , "" , "")."<br>الترقية من نسخة c0lddz forum" , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد الترقية من نسخة c0lddz forum ؟"))."</nobr></td>";

echo "</tr>";

echo "</table>";

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>