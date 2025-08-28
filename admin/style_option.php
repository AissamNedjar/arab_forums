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

$style_sql = select_mysql("arab-forums", "style", "style_id , style_lock , style_order , style_fils , style_name , style_default", "where style_id in(" . id . ")");

if (num_mysql("arab-forums", $style_sql) != false) {

    $style_object = object_mysql("arab-forums", $style_sql);

    if (fort == "edit") {

        if (type == "insert") {

            $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

            $fils = text_other("arab-forums", post_other("arab-forums", "fils"), true, true, true, false, true);

            $order = text_other("arab-forums", post_other("arab-forums", "order"), true, true, true, false, true);

            $lock = text_other("arab-forums", post_other("arab-forums", "lock"), true, true, true, false, true);

            if ($name == "" || $order == "" || $lock == "" || $fils == "") {

                $error = "الرجاء ملأ جميع الحقول ليتم التعديل على الستايل";
            } elseif (!is_numeric($order)) {

                $error = "يجب أن تكون قيمة ترتيب الستايل صحيحة";
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

                update_mysql("arab-forums", "style", "style_lock = \"{$lock}\" , style_order = \"{$order}\" , style_fils = \"{$fils}\" , style_name = \"{$name}\" where style_id in({$style_object->style_id})");

                $arraymsg = array(

                    "msg" => "تم تعديل الستايل بنجاح تام",

                    "color" => "good",

                    "url" => "admin.php?gert=style&go=style_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            echo "<form action=\"admin.php?gert=style&go=style_option&fort=edit&id={$style_object->style_id}&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

            echo "<tr><td class=\"tcotadmin\">عنوان الستايل</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$style_object->style_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الستايل</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">مجلد الستايل</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"fils\" value=\"{$style_object->style_fils}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم مجلد الستايل</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ترتيب الستايل</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"{$style_object->style_order}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالستايل و إن كنت لا تريده مرتب أتركه 1</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">تعطيل الستايل</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"lock\">";

            echo "<option value=\"0\" " . ($style_object->style_lock == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($style_object->style_lock == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الستايل معطل ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

            echo "</table></form>";
        }
    } elseif (fort == "delete") {

        if ($style_object->style_default == 1) {
            $error = false;
            $text = "لا يمكنك حذف الستايل الإفتراضي";
            $class = "error";
        } else {
            $error = true;
            $text = "تم حذف الستايل بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            delete_mysql("arab-forums", "style", "style_id in({$style_object->style_id})");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=style&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "lock") {

        if ($style_object->style_lock == 1) {
            $error = false;
            $text = "الستايل معطل من قبل";
            $class = "error";
        } elseif ($style_object->style_default == 1) {
            $error = false;
            $text = "لا يمكنك تعطيل الستايل الإفتراضي";
            $class = "error";
        } else {
            $error = true;
            $text = "تم تعطيل الستايل بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "style", "style_lock = \"1\" where style_id = \"{$style_object->style_id}\"");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=style&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "nolock") {

        if ($style_object->style_lock == 0) {
            $error = false;
            $text = "الستايل مفعل من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم تفعيل الستايل بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "style", "style_lock = \"0\" where style_id = \"{$style_object->style_id}\"");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=style&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "default") {

        if ($style_object->style_default == 1) {
            $error = false;
            $text = "الستايل معين كستايل إفتراضي من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم تفعيل الستايل كستايل إفتراضي بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "style", "style_default = \"0\" where style_default = \"1\"");
            update_mysql("arab-forums", "style", "style_default = \"1\" where style_id = \"{$style_object->style_id}\"");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=style&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $arraymsg = array(

            "msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا",

            "color" => "error",

            "url" => "admin.php?gert=catforum&go=style_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    $arraymsg = array(

        "msg" => "الستايل المختار غير موجود ضمن قائمة الستايلات",

        "color" => "error",

        "url" => "admin.php?gert=catforum&go=style_list",

    );

    echo msgadmin_template("arab-forums", $arraymsg);
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
