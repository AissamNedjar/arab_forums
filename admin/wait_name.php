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

$bad  = text_other("arab-forums", post_other("arab-forums", "bad"), false, false, false, false, false);

$delete  = text_other("arab-forums", post_other("arab-forums", "delete"), false, false, false, false, false);

$import = @implode(",", $allyu);

if (isset($wait)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد إسم وآحد على الأقل ليتم الموافقة عليه",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $name_sql = select_mysql("arab-forums", "changename", "changename_id , changename_userid , changename_namenew", "where changename_id in({$import})");

        if (num_mysql("arab-forums", $name_sql) != false) {

            while ($name_object = object_mysql("arab-forums", $name_sql)) {

                update_mysql("arab-forums", "changename", "changename_wait = \"0\" where changename_id in({$name_object->changename_id})");

                update_mysql("arab-forums", "user", "user_namelogin = \"{$name_object->changename_namenew}\" , user_nameuser = \"{$name_object->changename_namenew}\" where user_id in({$name_object->changename_userid})");
            }
        }

        $arraymsg = array(

            "msg" => "تم الموافقة على الأسماء المحددة بنجآح تام",

            "color" => "good",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} elseif (isset($bad)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد إسم وآحد على الأقل ليتم رفضه",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $name_sql = select_mysql("arab-forums", "changename", "changename_id , changename_userid , changename_namenew", "where changename_id in({$import})");

        if (num_mysql("arab-forums", $name_sql) != false) {

            while ($name_object = object_mysql("arab-forums", $name_sql)) {

                update_mysql("arab-forums", "changename", "changename_wait = \"2\" where changename_id in({$name_object->changename_id})");

                update_mysql("arab-forums", "user", "user_lastchongename = null where user_id in({$name_object->changename_userid})");

                $textopp = "تم رفض طلب تغيير إسم عضويتك";

                $editor = text_other("arab-forums", "<br><br>السلام عليكم و رحمة الله و براكته<br><br>لقد تم رفض طلب تغيير إسم عضويتك بسبب مخالفة قوانين المنتدى<br><br>لهذا المرجو المحاولة بإسم آخر و موافق لقوانين المنتدى<br><br>إدارة " . title_option . "<br><br><br>", false, true, false, false, true);

                insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$name_object->changename_userid}\", \"{$name_object->changename_userid}\" , \"0\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$textopp}\" , \"{$editor}\"");
            }
        }

        $arraymsg = array(

            "msg" => "تم رفض الأسماء المحددة بنجآح تام",

            "color" => "good",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} elseif (isset($delete)) {

    if ($allyu == 0) {

        $arraymsg = array(

            "msg" => "الرجاء تحديد إسم وآحد على الأقل ليتم حذفه",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $name_sql = select_mysql("arab-forums", "changename", "changename_id , changename_userid , changename_namenew", "where changename_id in({$import})");

        if (num_mysql("arab-forums", $name_sql) != false) {

            while ($name_object = object_mysql("arab-forums", $name_sql)) {

                delete_mysql("arab-forums", "changename", "changename_id in({$name_object->changename_id})");

                update_mysql("arab-forums", "user", "user_lastchongename = null where user_id in({$name_object->changename_userid})");
            }
        }

        $arraymsg = array(

            "msg" => "تم حذف الأسماء المحددة بنجآح تام",

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

    echo page_pager("arab-forums", "changename", "changename_id , changename_wait", "where changename_wait in(1)", $count_page, $get_page, "admin.php?gert=wait&go=wait_name&");

    echo "</tr></table>";

    echo "<form action=\"" . self . "\" method=\"post\">";

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td><nobr><input class=\"button\" value=\"الموافقة على الأسماء المحددة\" type=\"submit\" name=\"wait\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الأسماء المحددة ؟") . "></nobr></td>";

    echo "<td><nobr><input class=\"button\" value=\"رفض الأسماء المحددة\" type=\"submit\" name=\"bad\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد رفض الأسماء المحددة ؟") . "></nobr></td>";

    echo "<td><nobr><input class=\"button\" value=\"حذف الأسماء المحددة\" type=\"submit\" name=\"delete\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأسماء المحددة ؟") . "></nobr></td>";

    echo "<td width=\"100%\"></td>";

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    $inputtext = array(

        1 => "تحديد جميع الأسماء",

        2 => "إلغاء تحديد جميع الأسماء",

        3 => "لا توجد أسماء بالصفحة حاليا",

        4 => "عدد الأسماء الذي إخترت هو :",

        5 => "الإسم",

    );

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">الإسم الجديد</td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">الإسم القديم</td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">تاريخ الطلب</td>";

    echo "</tr>";

    $name_sql = select_mysql("arab-forums", "changename", "changename_id , changename_wait , changename_date , changename_namenew , changename_nameold", "where changename_wait in(1) order by changename_date asc limit {$limit_page},{$count_page}");

    if (num_mysql("arab-forums", $name_sql) != false) {

        while ($name_object = object_mysql("arab-forums", $name_sql)) {

            echo "<tr class=\"alttext1\" id=\"tr_{$name_object->changename_id}\" align=\"center\">";

            echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$name_object->changename_id}' , 'alttext1' , 'الإسم' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الإسم\" value=\"{$name_object->changename_id}\"><input type=\"hidden\" name=\"bg_{$name_object->changename_id}\" id=\"bg_{$name_object->changename_id}\" value=\"alttext1\"></div></td>";

            echo "<td><div class=\"pad\">{$name_object->changename_namenew}</div></td>";

            echo "<td><div class=\"pad\">{$name_object->changename_nameold}</div></td>";

            echo "<td><div class=\"pad\"><nobr>" . times_date("arab-forums", "", $name_object->changename_date) . "</nobr></div></td>";

            echo "</tr>";
        }
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"4\"><br><div class=\"pad\">لا يوجد أي إسم ينتظر الموافقة حاليا</div><br></td>";

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
