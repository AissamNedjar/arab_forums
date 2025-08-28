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

$title = text_other("arab-forums", post_other("arab-forums", "title"), true, true, true, true, true);

$adress = text_other("arab-forums", post_other("arab-forums", "adress"), true, true, true, true, true);

$email = text_other("arab-forums", post_other("arab-forums", "email"), true, true, true, true, true);

$description = text_other("arab-forums", post_other("arab-forums", "description"), true, true, true, true, true);

$keywords = text_other("arab-forums", post_other("arab-forums", "keywords"), true, true, true, true, true);

if ($title == "" || $adress == "" || $email == "" || $description == "" || $keywords == "") {

    $error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";
} elseif (!eregi("^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$", $email)) {

    $error = "الإيميل المدخل غير صحيح";
} else {

    $error = "";
}

if ($error == "") {

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"dateforum\" , \"" . time() . "\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title\" , \"{$title}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"adress\" , \"{$adress}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"showurl\" , \"{$adress}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"keywords\" , \"{$keywords}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"description\" , \"{$description}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"emailbiot\" , \"{$email}\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"time\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"closeoff\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"closemsg\" , \"المنتديات تحت الصيانة حاليا\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"registeroff\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"registerwait\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint0\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint1\" , \"30\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint2\" , \"100\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint3\" , \"500\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint4\" , \"1000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint5\" , \"2000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint6\" , \"3000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint7\" , \"4000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint8\" , \"5000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint9\" , \"6000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"titlepoint10\" , \"7000\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title1sex1\" , \"عضو جديد\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title2sex1\" , \"عضو مبتدئ\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title3sex1\" , \"عضو\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title4sex1\" , \"عضو نشيط\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title5sex1\" , \"عضو متطور\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title6sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title7sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title8sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title9sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title10sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title11sex1\" , \"عضو أساسي\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title12sex1\" , \"مشرف\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title13sex1\" , \"نائب مراقب\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title14sex1\" , \"مراقب\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title15sex1\" , \"مراقب عام\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title16sex1\" , \"مدير\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title1sex2\" , \"عضوة جديدة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title2sex2\" , \"عضوة مبتدئة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title3sex2\" , \"عضوة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title4sex2\" , \"عضوة نشيطة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title5sex2\" , \"عضوة متطورة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title6sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title7sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title8sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title9sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title10sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title11sex2\" , \"عضوة أساسية\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title12sex2\" , \"مشرفة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title13sex2\" , \"نائبة مراقب\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title14sex2\" , \"مراقبة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title15sex2\" , \"مراقبة عام\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"title16sex2\" , \"مديرة\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"detail\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"password\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"email\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"sex\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"age\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"sig\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"default\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"change\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor1\" , \"1c2022\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor2\" , \"c63d3d\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor3\" , \"2f7242\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor4\" , \"c87d33\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor5\" , \"996633\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"mcolor6\" , \"1b78b9\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor1\" , \"black\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor2\" , \"red\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor3\" , \"green\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor4\" , \"orange\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor5\" , \"brown\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"scolor6\" , \"blue\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"ttopic\" , \"40\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"treply\" , \"30\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"tuser\" , \"40\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"tmedals\" , \"9\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"tother\" , \"30\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"ico\" , \"images/arab-forums.png\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"topicshow\" , \"50\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"monitortopic\" , \"40\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"totalpost\" , \"30\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"totalmessages\" , \"100\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"locktopic\" , \"500\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"changename\" , \"5\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"changenamedays\" , \"30\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin1\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin2\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin3\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin4\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin5\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin6\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin7\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin8\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin9\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin10\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin11\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permochrifin12\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab1\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab2\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab3\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab4\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab5\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab6\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab7\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab8\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab9\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab10\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab11\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"pernawab12\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin1\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin2\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin3\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin4\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin5\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin6\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin7\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin8\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin9\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin10\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin11\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"permrakbin12\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin1\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin2\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin3\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin4\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin5\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin6\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin7\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin8\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin9\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin10\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin11\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"per3amin12\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"helpforum\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"notifyadmin1\" , \"أهلا و سهلا بكم في نسخة منتديات Arab Forums\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"notifyadmin2\" , \"1\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"notifyadmin3\" , \"" . time() . "\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"facebook\" , \"home.php\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"twitter\" , \"home.php\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"youtube\" , \"home.php\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"maxpmlist\" , \"5\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"messagedays\" , \"80\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"ads1\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"client1\" , \"ca-pub-3968429406361418\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"slot1\" , \"3429738503\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"url1\" , \"http://pagead2.googlesyndication.com/pagead/show_ads.js\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"ads2\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"client2\" , \"ca-pub-3968429406361418\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"slot2\" , \"3429738503\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"url2\" , \"http://pagead2.googlesyndication.com/pagead/show_ads.js\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"ads3\" , \"0\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"client3\" , \"ca-pub-3968429406361418\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"slot3\" , \"3429738503\"");

    insert_mysql("arab-forums", "option", "option_id , option_name , option_value", "null , \"url3\" , \"http://pagead2.googlesyndication.com/pagead/show_ads.js\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"الأخضر الأول\" , \"green1\" , \"1\" , \"0\" , \"1\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"الأخضر الثاني\" , \"green2\" , \"0\" , \"0\" , \"2\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"الأزرق\" , \"blue\" , \"0\" , \"0\" , \"3\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"البرتقالي\" , \"orange\" , \"0\" , \"0\" , \"4\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"الأزرق الفلاشي\" , \"blue_flash\" , \"0\" , \"0\" , \"5\"");

    insert_mysql("arab-forums", "style", "style_id , style_name , style_fils , style_default , style_lock , style_order", "null , \"البرتقالي الفلاشي\" , \"orange_flash\" , \"0\" , \"0\" , \"6\"");

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

    echo "<tr align=\"center\">";

    echo "<td class=\"alttext1\"><nobr><br>تم إدخال البيانات بنجآح تام<br><br></nobr></td>";

    echo "</tr>";

    echo "<tr align=\"center\">";

    echo "<form action=\"install.php?go=install&type=admin\" method=\"post\">";

    echo "<td class=\"tcat\"><nobr><input class=\"button\" value=\"الإنتقال إلى الخطوة التالية\" type=\"submit\"></nobr></td>";

    echo "</form>";

    echo "</tr>";

    echo "</table>";
} else {

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

    echo "<tr align=\"center\">";

    echo "<td class=\"alttext1\"><nobr><br>{$error}<br><br>" . a_other("arab-forums", "install.php?go=install&type=option", "أنقر هنا للرجوع", "أنقر هنا للرجوع", "") . "<br><br></nobr></td>";

    echo "</tr>";

    echo "</table>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
