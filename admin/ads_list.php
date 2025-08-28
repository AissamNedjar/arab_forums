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

    $ads_get1 = text_other("arab-forums", post_other("arab-forums", "adsorder"), false, false, false, false, true);

    $ads_get2 = text_other("arab-forums", post_other("arab-forums", "adsorder_id"), false, false, false, false, true);

    $i = 0;

    $j = 0;

    while ($i < count($cat_get1)) {

        if ($ads_get1[$j] == "" || !is_numeric($ads_get1[$j])) {

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

        while ($i < count($ads_get1)) {

            $adsoft1 = text_other("arab-forums", $ads_get1[$j], true, true, true, false, true);

            $adsoft2 = text_other("arab-forums", $ads_get2[$i], true, true, true, false, true);

            update_mysql("arab-forums", "ads", "ads_order = \"{$adsoft1}\" where ads_id = \"{$adsoft2}\"");

            $j++;
            $i++;
        }
        $arraymsg = array(

            "msg" => "تم حفظ الترتيب الجديد بنجآح تام",

            "color" => "good",

            "url" => "admin.php?gert=ads&go=ads_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=ads&go=ads_list&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr>";

    echo "<td class=\"tcotadmin\" colspan=\"2\">عنوان / رابط / صورة الإعلان</td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">الحالة</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">الترتيب</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">خيارات</td>";

    echo "</tr>";

    $ads_sql = select_mysql("arab-forums", "ads", "ads_id , ads_order , ads_lock , ads_open , ads_name , ads_link , ads_images", "order by ads_order asc");

    if (num_mysql("arab-forums", $ads_sql) != false) {

        while ($ads_object = object_mysql("arab-forums", $ads_sql)) {

            echo "<tr>";

            echo "<td class=\"alttext1\" width=\"1%\">" . img_other("arab-forums", "{$ads_object->ads_images}", "", "200", "50", "0", "", "") . "</td>";

            echo "<td class=\"alttext1\"><div class=\"pad\">{$ads_object->ads_name}<br><br><span style=\"color:red;font-size:11px;\">{$ads_object->ads_link}</span></div></td>";

            echo "<td class=\"alttext1\" align=\"center\">" . ($ads_object->ads_lock == 1 ? "معطل" : "مفعل") . "</td>";

            echo "<td class=\"alttext1\" align=\"center\"><input class=\"input\" type=\"text\" name=\"adsorder[]\" size=\"1\" value=\"{$ads_object->ads_order}\"><input type=\"hidden\" name=\"adsorder_id[]\" value=\"{$ads_object->ads_id}\"></td>";

            echo "<td class=\"alttext1\" align=\"center\"><table><tr>";

            echo "<td>" . a_other("arab-forums", "admin.php?gert=ads&go=ads_option&fort=edit&id={$ads_object->ads_id}", "تعديل الإعلان", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

            if ($ads_object->ads_lock == 0) {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=ads&go=ads_option&fort=lock&id={$ads_object->ads_id}", "تعطيل الإعلان", img_other("arab-forums", "images/lock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تعطيل الإعلان ؟")) . "</td>";
            } else {

                echo "<td>" . a_other("arab-forums", "admin.php?gert=ads&go=ads_option&fort=nolock&id={$ads_object->ads_id}", "تفعيل الإعلان", img_other("arab-forums", "images/nolock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تفعيل الإعلان ؟")) . "</td>";
            }

            echo "<td>" . a_other("arab-forums", "admin.php?gert=ads&go=ads_option&fort=delete&id={$ads_object->ads_id}", "حذف الإعلان", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الإعلان ؟")) . "</td>";

            echo "</tr></table></td>";

            echo "</tr>";
        }

        echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"6\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"5\"><br><div class=\"pad\">لا يوجد أي إعلان حاليا</div><br></td>";

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
