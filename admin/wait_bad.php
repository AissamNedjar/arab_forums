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

$allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

$wait  = text_other("arab-forums", post_other("arab-forums", "wait"), false, false, false, false, false);

$delete  = text_other("arab-forums", post_other("arab-forums", "delete"), false, false, false, false, false);

$import = @implode(",", $allyu);

if (isset($wait)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد عضوية وآحدة على الأقل ليتم الموافقة عليها",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        update_mysql("arab-forums", "user", "user_bad = \"0\" where user_id in({$import})");

        $arraymsg = array(

            "msg" => "تم الموافقة على العضويات المحددة بنجآح تام",

            "color" => "good",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} elseif (isset($delete)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد عضوية وآحدة على الأقل ليتم حذفها",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        delete_mysql("arab-forums", "user", "user_id in({$import})");

        $arraymsg = array(

            "msg" => "تم حذف العضويات المحددة بنجآح تام",

            "color" => "good",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    $count_page = tother_option;

    $get_page = (page == "" || !is_numeric(page) ? 1 : page);

    $limit_page = (($get_page * $count_page) - $count_page);

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td width=\"100%\"></td>";

    echo page_pager("arab-forums", "user", "user_id , user_bad , user_active", "where user_bad in(1) && user_active in(0)", $count_page, $get_page, "admin.php?gert=wait&go=wait_bad&");

    echo "</tr></table>";

    echo "<form action=\"" . self . "\" method=\"post\">";

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td><nobr><input class=\"button\" value=\"الموافقة على العضويات المحددة\" type=\"submit\" name=\"wait\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على العضويات المحددة ؟") . "></nobr></td>";

    echo "<td><nobr><input class=\"button\" value=\"حذف العضويات المحددة\" type=\"submit\" name=\"delete\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف العضويات المحددة ؟") . "></nobr></td>";

    echo "<td width=\"100%\"></td>";

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    $inputtext = array(

        1 => "تحديد جميع العضويات",

        2 => "إلغاء تحديد جميع العضويات",

        3 => "لا توجد عضويات بالصفحة حاليا",

        4 => "عدد العضويات الذي إخترت هو :",

        5 => "العضوية",

    );

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">إسم العضوية</td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">البريد الإلكتروني</td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">الدولة</td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">الايبي</td>";

    echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\">تاريخ التسجيل</td>";

    echo "</tr>";

    $user_sql = select_mysql("arab-forums", "user", "user_id , user_bad , user_active , user_dateregister , user_nameuser , user_adressip , user_email , user_country", "where user_bad in(1) && user_active in(0) order by user_dateregister desc limit {$limit_page},{$count_page}");

    if (num_mysql("arab-forums", $user_sql) != false) {

        while ($user_object = object_mysql("arab-forums", $user_sql)) {

            echo "<tr class=\"alttext1\" id=\"tr_{$user_object->user_id}\" align=\"center\">";

            echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$user_object->user_id}' , 'alttext1' , 'العضوية' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد العضوية\" value=\"{$user_object->user_id}\"><input type=\"hidden\" name=\"bg_{$user_object->user_id}\" id=\"bg_{$user_object->user_id}\" value=\"alttext1\"></div></td>";

            echo "<td><div class=\"pad\">{$user_object->user_nameuser}</div></td>";

            echo "<td><div class=\"pad\">{$user_object->user_email}</div></td>";

            echo "<td><div class=\"pad\">{$country_list[$user_object->user_country]}</div></td>";

            echo "<td><div class=\"pad\">{$user_object->user_adressip}</div></td>";

            echo "<td><div class=\"pad\"><nobr>" . times_date("arab-forums", "", $user_object->user_dateregister) . "</nobr></div></td>";

            echo "</tr>";
        }
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"6\"><br><div class=\"pad\">لا توجد أي عضوية مرفوضة حاليا</div><br></td>";

        echo "</tr>";
    }

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
