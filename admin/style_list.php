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

    $style_get1 = text_other("arab-forums", post_other("arab-forums", "styleorder"), false, false, false, false, true);

    $style_get2 = text_other("arab-forums", post_other("arab-forums", "styleorder_id"), false, false, false, false, true);

    $i = 0;

    $j = 0;

    while ($i < count($cat_get1)) {

        if ($style_get1[$j] == "" || !is_numeric($style_get1[$j])) {

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

        while ($i < count($style_get1)) {

            $styleoft1 = text_other("arab-forums", $style_get1[$j], true, true, true, false, true);

            $styleoft2 = text_other("arab-forums", $style_get2[$i], true, true, true, false, true);

            update_mysql("arab-forums", "style", "style_order = \"{$styleoft1}\" where style_id = \"{$styleoft2}\"");

            $j++;
            $i++;
        }
        $arraymsg = array(

            "msg" => "تم حفظ الترتيب الجديد بنجآح تام",

            "color" => "good",

            "url" => "admin.php?gert=style&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=style&go=style_list&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\">عنوآن الستايل</td>";

    echo "<td class=\"tcotadmin\" width=\"30%\" align=\"center\">مجلد الستايل</td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">الحالة</td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">الإفتراضي</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">الترتيب</td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">خيارات</td>";

    echo "</tr>";

    $style_sql = select_mysql("arab-forums", "style", "style_id , style_order , style_lock , style_name , style_fils , style_default", " order by style_order asc");

    if (num_mysql("arab-forums", $style_sql) != false) {

        while ($style_object = object_mysql("arab-forums", $style_sql)) {

            echo "<tr>";

            echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\">{$style_object->style_name}</div></td>";

            echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\"><span style=\"color:red;\">{$style_object->style_fils}</span></div></td>";

            echo "<td class=\"alttext1\" align=\"center\">" . ($style_object->style_lock == 1 ? "معطل" : "مفعل") . "</td>";

            echo "<td class=\"alttext1\" align=\"center\">" . ($style_object->style_default == 1 ? img_other("arab-forums", "images/ok.png", "الستايل الإفتراضي للمنتدى", "", "", "0", "class=\"title\"", "") : a_other("arab-forums", "admin.php?gert=style&go=style_option&fort=default&id={$style_object->style_id}", "تعيينه الستايل الإفتراضي للمنتدى", img_other("arab-forums", "images/re.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تعيين الستايل كستايل إفتراضي للمنتدى ؟"))) . "</td>";

            echo "<td class=\"alttext1\" align=\"center\"><input class=\"input\" type=\"text\" name=\"styleorder[]\" size=\"1\" value=\"{$style_object->style_order}\"><input type=\"hidden\" name=\"styleorder_id[]\" value=\"{$style_object->style_id}\"></td>";

            echo "<td class=\"alttext1\" align=\"center\"><table><tr>";

            echo "<td>" . a_other("arab-forums", "admin.php?gert=style&go=style_option&fort=edit&id={$style_object->style_id}", "تعديل الستايل", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

            if ($style_object->style_lock == 0) {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=style&go=style_option&fort=lock&id={$style_object->style_id}", "تعطيل الستايل", img_other("arab-forums", "images/lock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تعطيل الستايل ؟")) . "</td>";
            } else {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=style&go=style_option&fort=nolock&id={$style_object->style_id}", "تفعيل الستايل", img_other("arab-forums", "images/nolock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تفعيل الستايل ؟")) . "</td>";
            }

            echo "<td>" . a_other("arab-forums", "admin.php?gert=style&go=style_option&fort=delete&id={$style_object->style_id}", "حذف الستايل", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الستايل ؟")) . "</td>";

            echo "</tr></table></td>";

            echo "</tr>";
        }

        echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"6\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

        echo "</table></form>";
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"6\"><br><div class=\"pad\">لا يوجد أي ستايل حاليا</div><br></td>";

        echo "</tr>";
    }
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
