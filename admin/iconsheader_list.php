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

    $error = "";

    $iconsheader_get1 = text_other("arab-forums", post_other("arab-forums", "iconsheaderorder"), false, false, false, false, true);

    $iconsheader_get2 = text_other("arab-forums", post_other("arab-forums", "iconsheaderorder_id"), false, false, false, false, true);

    $i = 0;

    $j = 0;

    while ($i < count($cat_get1)) {

        if ($iconsheader_get1[$j] == "" || !is_numeric($iconsheader_get1[$j])) {

            $error .= "1";
        }

        $j++;

        $i++;
    }

    if ($error != "") {

        $arraymsg = array(

            "msg" => "الرجاء ملأ جميع الحقول ليتم إدخال الترتيب الجديد",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $i = 0;
        $j = 0;

        while ($i < count($iconsheader_get1)) {

            $iconsheaderoft1 = text_other("arab-forums", $iconsheader_get1[$j], true, true, true, false, true);

            $iconsheaderoft2 = text_other("arab-forums", $iconsheader_get2[$i], true, true, true, false, true);

            update_mysql("arab-forums", "iconsheader", "iconsheader_order = \"{$iconsheaderoft1}\" where iconsheader_id = \"{$iconsheaderoft2}\"");

            $j++;
            $i++;
        }
        $arraymsg = array(

            "msg" => "تم حفظ الترتيب الجديد بنجآح تام",

            "color" => "good",

            "url" => "admin.php?gert=iconsheader&go=iconsheader_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=iconsheader&go=iconsheader_list&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"45%\" colspan=\"2\">عنوان / رابط / صورة الأيقونة</td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">الحالة</td>";

    echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\">الظهور للمجموعات</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">الترتيب</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">خيارات</td>";

    echo "</tr>";

    $iconsheader_sql = select_mysql("arab-forums", "iconsheader", "iconsheader_id , iconsheader_order , iconsheader_lock , iconsheader_open , iconsheader_name , iconsheader_link , iconsheader_images , iconsheader_group0 , iconsheader_group1 , iconsheader_group2 , iconsheader_group3 , iconsheader_group4 , iconsheader_group5", "order by iconsheader_order asc");

    if (num_mysql("arab-forums", $iconsheader_sql) != false) {

        while ($iconsheader_object = object_mysql("arab-forums", $iconsheader_sql)) {

            echo "<tr>";

            echo "<td class=\"alttext1\" width=\"1%\">" . img_other("arab-forums", "{$iconsheader_object->iconsheader_images}", "", "50", "50", "0", "", "") . "</td>";

            echo "<td class=\"alttext1\"><div class=\"pad\">{$iconsheader_object->iconsheader_name}<br><br><span style=\"color:red;font-size:11px;\">{$iconsheader_object->iconsheader_link}</span></div></td>";

            echo "<td class=\"alttext1\" align=\"center\">" . ($iconsheader_object->iconsheader_lock == 1 ? "معطلة" : "مفعلة") . "</td>";

            echo "<td class=\"alttext1\" align=\"center\">";

            $groupup = array($iconsheader_object->iconsheader_group0, $iconsheader_object->iconsheader_group1, $iconsheader_object->iconsheader_group2, $iconsheader_object->iconsheader_group3, $iconsheader_object->iconsheader_group4, $iconsheader_object->iconsheader_group5);

            for ($x = 0; $x <= 5; $x++) {

                echo "<span style=\"font-size:11px;\">{$group_list[$x]} : <span style=\"color:red;\">" . ($groupup[$x] == 1 ? "ظاهرة" : "مخفية") . "</span></span><br>";
            }

            echo "</td>";

            echo "<td class=\"alttext1\" align=\"center\"><input class=\"input\" type=\"text\" name=\"iconsheaderorder[]\" size=\"1\" value=\"{$iconsheader_object->iconsheader_order}\"><input type=\"hidden\" name=\"iconsheaderorder_id[]\" value=\"{$iconsheader_object->iconsheader_id}\"></td>";

            echo "<td class=\"alttext1\" align=\"center\"><table><tr>";

            echo "<td>" . a_other("arab-forums", "admin.php?gert=iconsheader&go=iconsheader_option&fort=edit&id={$iconsheader_object->iconsheader_id}", "تعديل الأيقونة", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

            if ($iconsheader_object->iconsheader_lock == 0) {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=iconsheader&go=iconsheader_option&fort=lock&id={$iconsheader_object->iconsheader_id}", "تعطيل الأيقونة", img_other("arab-forums", "images/lock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تعطيل الأيقونة ؟")) . "</td>";
            } else {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=iconsheader&go=iconsheader_option&fort=nolock&id={$iconsheader_object->iconsheader_id}", "تفعيل الأيقونة", img_other("arab-forums", "images/nolock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تفعيل الأيقونة ؟")) . "</td>";
            }

            echo "<td>" . a_other("arab-forums", "admin.php?gert=iconsheader&go=iconsheader_option&fort=delete&id={$iconsheader_object->iconsheader_id}", "حذف الأيقونة", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأيقونة ؟")) . "</td>";

            echo "</tr></table></td>";

            echo "</tr>";
        }

        echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"6\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"6\"><br><div class=\"pad\">لا توجد أي أيقونة حاليا</div><br></td>";

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
