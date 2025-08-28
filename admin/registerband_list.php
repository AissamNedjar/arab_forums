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

$gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

$import = @implode(",", $allyu);

if (isset($gets)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد إسم وآحد على الأقل",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        delete_mysql("arab-forums", "registerband", "registerband_id in({$import})");

        $arraymsg = array(

            "msg" => "تم حذف الأسماء المحددة بنجآح تآم",

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

    echo page_pager("arab-forums", "registerband", "registerband_id", "", $count_page, $get_page, "admin.php?gert=registerband&go=registerband_list&");

    echo "</tr></table>";

    echo "<form action=\"" . self . "\" method=\"post\">";

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td><nobr><input class=\"button\" value=\"حذف الأسماء المحددة\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأسماء المحددة ؟") . "></nobr></td>";

    echo "<td width=\"100%\"></td>";

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    $inputtext = array(

        1 => "تحديد جميع الأسماء",

        2 => "إلغاء تحديد جميع الأسماء",

        3 => "لا يوجد أسماء بالصفحة حاليا",

        4 => "عدد الأسماء الذي إخترت هو :",

        5 => "الإسم",

    );

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

    echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\">الإسم</td>";

    echo "<td class=\"tcotadmin\" width=\"30%\" align=\"center\">تم منعه بواسطة</td>";

    echo "<td class=\"tcotadmin\" width=\"30%\" align=\"center\">تاريخ المنع</td>";

    echo "</tr>";

    $registerband_sql = select_mysql("arab-forums", "registerband", "r.registerband_id , r.registerband_name , r.registerband_user , r.registerband_date , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as r left join user" . prefix_connect . " as u on(u.user_id = r.registerband_user) limit {$limit_page},{$count_page}");

    if (num_mysql("arab-forums", $registerband_sql) != false) {

        while ($registerband_object = object_mysql("arab-forums", $registerband_sql)) {

            echo "<tr class=\"alttext1\" id=\"tr_{$registerband_object->registerband_id}\" align=\"center\">";

            echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$registerband_object->registerband_id}' , 'alttext1' , 'الإسم' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الإسم\" value=\"{$registerband_object->registerband_id}\"><input type=\"hidden\" name=\"bg_{$registerband_object->registerband_id}\" id=\"bg_{$registerband_object->registerband_id}\" value=\"alttext1\"></div></td>";

            echo "<td><div class=\"pad\">{$registerband_object->registerband_name}</div></td>";

            echo "<td><div class=\"pad\">" . user_other("arab-forums", array($registerband_object->user_id, $registerband_object->user_group, $registerband_object->user_nameuser, $registerband_object->user_lock1, $registerband_object->user_coloruser, false)) . "</div></td>";

            echo "<td><div class=\"pad\"><nobr>" . times_date("arab-forums", "", $registerband_object->registerband_date) . "</nobr></div></td>";

            echo "</tr>";
        }
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"4\"><br><div class=\"pad\">لا توجد أي أسماء ممنوعة حاليا</div><br></td>";

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
