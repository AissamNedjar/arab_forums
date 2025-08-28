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

if (type == "insert") {

    $facebook = text_other("arab-forums", post_other("arab-forums", "facebook"), true, true, true, false, true);

    $twitter = text_other("arab-forums", post_other("arab-forums", "twitter"), true, true, true, false, true);

    $youtube = text_other("arab-forums", post_other("arab-forums", "youtube"), true, true, true, false, true);

    if ($facebook == "" || $twitter == "" || $youtube == "") {

        $error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";
    } else {

        $error = "";
    }

    if ($error != "") {

        $arraymsg = array(

            "msg" => $error,

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        update_mysql("arab-forums", "option", "option_value = \"{$facebook}\" where option_name = \"facebook\"");

        update_mysql("arab-forums", "option", "option_value = \"{$twitter}\" where option_name = \"twitter\"");

        update_mysql("arab-forums", "option", "option_value = \"{$youtube}\" where option_name = \"youtube\"");

        $arraymsg = array(

            "msg" => "تم إدخال البيانات الجديدة بنجآح تآم",

            "color" => "good",

            "url" => "admin.php?gert=option&go=option_sosial",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=option&go=option_sosial&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr><td class=\"tcotadmin\">رابط صفحة المنتدى على الفيس بوك</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input dir=\"ltr\" style=\"width:500px\" class=\"input\" name=\"facebook\" value=\"" . facebook_option . "\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صفحة أو قروب الفيس بوك الخاص بالمنتدى</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">رابط حساب تويتر الخاص بالمنتدى</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input dir=\"ltr\" style=\"width:500px\" class=\"input\" name=\"twitter\" value=\"" . twitter_option . "\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط حساب تويتر الخاص بالمنتدى</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">رابط قناة المنتدى على اليوتيب</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input dir=\"ltr\" style=\"width:500px\" class=\"input\" name=\"youtube\" value=\"" . youtube_option . "\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط قناة اليوتيب الخاصة بالمنتدى</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
