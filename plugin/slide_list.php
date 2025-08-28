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

    $slide_get1 = text_other("arab-forums", post_other("arab-forums", "slideorder"), false, false, false, false, true);

    $slide_get2 = text_other("arab-forums", post_other("arab-forums", "slideorder_id"), false, false, false, false, true);

    $i = 0;

    $j = 0;

    while ($i < count($cat_get1)) {

        if ($slide_get1[$j] == "" || !is_numeric($slide_get1[$j])) {

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

        while ($i < count($slide_get1)) {

            $slideoft1 = text_other("arab-forums", $slide_get1[$j], true, true, true, false, true);

            $slideoft2 = text_other("arab-forums", $slide_get2[$i], true, true, true, false, true);

            update_mysql("arab-forums", "slide", "slide_order = \"{$slideoft1}\" where slide_id = \"{$slideoft2}\"");

            $j++;
            $i++;
        }
        $arraymsg = array(

            "msg" => "تم حفظ الترتيب الجديد بنجآح تام",

            "color" => "good",

            "url" => "plugin.php?gert=slide&go=slide_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"plugin.php?gert=slide&go=slide_list&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr>";

    echo "<td class=\"tcotadmin\" colspan=\"2\">عنوان / رقم / صورة الموضوع في السلايد</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">الترتيب</td>";

    echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\">خيارات</td>";

    echo "</tr>";

    $slide_sql = select_mysql("arab-forums", "slide", "slide_id , slide_order , slide_name , slide_link , slide_images", "order by slide_order asc");

    if (num_mysql("arab-forums", $slide_sql) != false) {

        while ($slide_object = object_mysql("arab-forums", $slide_sql)) {

            echo "<tr>";

            echo "<td class=\"alttext1\" width=\"1%\">" . img_other("arab-forums", "{$slide_object->slide_images}", "", "50", "50", "0", "", "") . "</td>";

            echo "<td class=\"alttext1\"><div class=\"pad\">{$slide_object->slide_name}<br><br><span style=\"color:red;font-size:11px;\">{$slide_object->slide_link}</span></div></td>";

            echo "<td class=\"alttext1\" align=\"center\"><input class=\"input\" type=\"text\" name=\"slideorder[]\" size=\"1\" value=\"{$slide_object->slide_order}\"><input type=\"hidden\" name=\"slideorder_id[]\" value=\"{$slide_object->slide_id}\"></td>";

            echo "<td class=\"alttext1\" align=\"center\"><table><tr>";

            echo "<td>" . a_other("arab-forums", "plugin.php?gert=slide&go=slide_option&fort=edit&id={$slide_object->slide_id}", "تعديل الموضوع في السلايد", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

            echo "<td>" . a_other("arab-forums", "plugin.php?gert=slide&go=slide_option&fort=delete&id={$slide_object->slide_id}", "حذف الموضوع في السلايد", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الموضوع في السلايد ؟")) . "</td>";

            echo "</tr></table></td>";

            echo "</tr>";
        }

        echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"6\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"5\"><br><div class=\"pad\">لا يوجد أي مواضيع في السلايد حاليا</div><br></td>";

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
