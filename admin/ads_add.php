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

    $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

    $order = text_other("arab-forums", post_other("arab-forums", "order"), true, true, true, false, true);

    $lock = text_other("arab-forums", post_other("arab-forums", "lock"), true, true, true, false, true);

    $open = text_other("arab-forums", post_other("arab-forums", "open"), true, true, true, false, true);

    $br = text_other("arab-forums", post_other("arab-forums", "br"), true, true, true, false, true);

    $link = text_other("arab-forums", post_other("arab-forums", "link"), true, true, true, false, true);

    $images = text_other("arab-forums", post_other("arab-forums", "images"), true, true, true, false, true);

    if ($name == "" || $order == "" || $lock == "" || $open == "" || $br == "" || $link == "" || $images == "") {

        $error = "الرجاء ملأ جميع الحقول ليتم إدخال الإعلان الجديد";
    } elseif (!is_numeric($order)) {

        $error = "يجب أن تكون قيمة ترتيب الإعلان صحيحة";
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

        insert_mysql("arab-forums", "ads", "ads_id , ads_lock , ads_order , ads_open , ads_br , ads_name , ads_link , ads_images", "null , \"{$lock}\" , \"{$order}\" , \"{$open}\" , \"{$br}\" , \"{$name}\" , \"{$link}\" , \"{$images}\"");

        $arraymsg = array(

            "msg" => "تم إدخال الإعلان الجديد بنجاح تام",

            "color" => "good",

            "url" => "admin.php?gert=ads&go=ads_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=ads&go=ads_add&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr><td class=\"tcotadmin\">عنوان الإعلان</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الإعلان</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">رابط الإعلان</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"link\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الرابط الذي يأدي إليه الإعلان و يجب أن يكون مسبوق ب http://www</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">صورة الإعلان</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الإعلان التي تظهر في مكان الإعلانات</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">ترتيب الإعلان</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"1\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالإعلان و إن كنت لا تريده مرتب أتركه 1</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">تعطيل الإعلان</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"lock\">";

    echo "<option value=\"0\">لآ</option>";

    echo "<option value=\"1\">نعم</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الإعلان معطل ؟</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">فتح الإعلان في صفحة مستقلة</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"open\">";

    echo "<option value=\"0\">لآ</option>";

    echo "<option value=\"1\">نعم</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل رابط الإعلان يفتح في صفحة مستقلة ؟</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">ظهور الإعلان في سطر جديد</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"br\">";

    echo "<option value=\"0\">لآ</option>";

    echo "<option value=\"1\">نعم</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الإعلان يوضع في سطر جديد أي تحت الإعلانات السابقة ؟</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الإعلان الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الإعلان الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
