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

    $notify = text_other("arab-forums", post_other("arab-forums", "notify"), true, false, true, false, true);

    update_mysql("arab-forums", "option", "option_value = \"{$notify}\" where option_name = \"notifyadmin1\"");

    update_mysql("arab-forums", "option", "option_value = \"" . id_user . "\" where option_name = \"notifyadmin2\"");

    update_mysql("arab-forums", "option", "option_value = \"" . time() . "\" where option_name = \"notifyadmin3\"");

    $arraymsg = array(

        "msg" => "تم إدخال البيآنات الجديدة بنجآح تام",

        "color" => "good",

        "url" => "admin.php",

    );

    echo msgadmin_template("arab-forums", $arraymsg);
} else {

    echo "<form action=\"admin.php?type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr><td class=\"tcotadmin\" align=\"center\">Arab Forums</td></tr>";

    echo "<tr><td class=\"alttext1\" align=\"center\"><br>أهلا و سهلا بك في نسخة منتديات Arab Forums 0.2<br><br>مبرمج النسخة : Aissam Nedjar<br><br>لأي إستفسار حول النسخة إتصل بنا من هنا<br><br>https://www.facebook.com/aissam.nedjar.43<br><br></td></tr>";

    $user_sql = select_mysql("arab-forums", "user", "user_id , user_lock1 , user_group , user_nameuser , user_coloruser", "where user_id in(" . notifyadmin2_option . ") limit 1");

    $user_object = object_mysql("arab-forums", $user_sql);

    echo "<tr><td class=\"tcotadmin\" align=\"center\">مذكرة المدراء</td></tr>";

    echo "<tr><td class=\"alttext1\" align=\"center\"><br>آخر تحديث للمذكرة تم بواسطة : " . user_other("arab-forums", array($user_object->user_id, $user_object->user_group, $user_object->user_nameuser, $user_object->user_lock1, $user_object->user_coloruser, false)) . " | بتاريخ : " . times_date("arab-forums", "", notifyadmin3_option) . "<br><br></td></tr>";

    echo "<tr><td class=\"alttext1\" align=\"center\"><br><textarea name=\"notify\" class=\"textarea\" cols=\"115\" rows=\"12\">" . notifyadmin1_option . "</textarea><br><br></td></tr>";

    echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
