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

    $scolor1 = text_other("arab-forums", post_other("arab-forums", "scolor1"), true, true, true, false, true);

    $scolor2 = text_other("arab-forums", post_other("arab-forums", "scolor2"), true, true, true, false, true);

    $scolor3 = text_other("arab-forums", post_other("arab-forums", "scolor3"), true, true, true, false, true);

    $scolor4 = text_other("arab-forums", post_other("arab-forums", "scolor4"), true, true, true, false, true);

    $scolor5 = text_other("arab-forums", post_other("arab-forums", "scolor5"), true, true, true, false, true);

    $scolor6 = text_other("arab-forums", post_other("arab-forums", "scolor6"), true, true, true, false, true);

    if ($scolor1 == "" || $scolor2 == "" || $scolor3 == "" || $scolor4 == "" || $scolor5 == "" || $scolor6 == "") {

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

        update_mysql("arab-forums", "option", "option_value = \"{$scolor1}\" where option_name = \"scolor1\"");

        update_mysql("arab-forums", "option", "option_value = \"{$scolor2}\" where option_name = \"scolor2\"");

        update_mysql("arab-forums", "option", "option_value = \"{$scolor3}\" where option_name = \"scolor3\"");

        update_mysql("arab-forums", "option", "option_value = \"{$scolor4}\" where option_name = \"scolor4\"");

        update_mysql("arab-forums", "option", "option_value = \"{$scolor5}\" where option_name = \"scolor5\"");

        update_mysql("arab-forums", "option", "option_value = \"{$scolor6}\" where option_name = \"scolor6\"");

        $arraymsg = array(

            "msg" => "تم إدخال البيانات الجديدة بنجآح تآم",

            "color" => "good",

            "url" => "admin.php?gert=usergroup&go=usergroup_colorn",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=usergroup&go=usergroup_colorn&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    $groupup = array("", scolor1_option, scolor2_option, scolor3_option, scolor4_option, scolor5_option, scolor6_option);

    for ($x = 1; $x <= 6; $x++) {

        echo "<tr><td class=\"tcotadmin\">لون نجوم مجموعة {$group_list[$x]}</td></tr>";

        foreach ($colorn_list as $code => $name) {

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "" . img_other("arab-forums", "images/star/{$code}.png", "{$name}", "", "", "0", "", "") . "<input class=\"radio1\" type=\"radio\" name=\"scolor{$x}\" value=\"{$code}\" " . ($groupup[$x] == $code ? "checked" : "") . ">&nbsp;<span style=\"color:red;font-size:12px;\">{$name}</span>";

            echo "</div></td></tr>";
        }
    }

    echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
