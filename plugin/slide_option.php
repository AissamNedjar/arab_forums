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

$slide_sql = select_mysql("arab-forums", "slide", "slide_id , slide_order , slide_name , slide_link , slide_images", "where slide_id in(" . id . ")");

if (num_mysql("arab-forums", $slide_sql) != false) {

    $slide_object = object_mysql("arab-forums", $slide_sql);

    if (fort == "edit") {

        if (type == "insert") {

            $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

            $order = text_other("arab-forums", post_other("arab-forums", "order"), true, true, true, false, true);

            $link = text_other("arab-forums", post_other("arab-forums", "link"), true, true, true, false, true);

            $images = text_other("arab-forums", post_other("arab-forums", "images"), true, true, true, false, true);

            if ($name == "" || $order == "" || $link == "" || $images == "") {

                $error = "الرجاء ملأ جميع الحقول ليتم التعديل على الموضوع في السلايد";
            } elseif (!is_numeric($order)) {

                $error = "يجب أن تكون قيمة ترتيب الموضوع في السلايد صحيحة";
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

                update_mysql("arab-forums", "slide", "slide_order = \"{$order}\" , slide_name = \"{$name}\" , slide_link = \"{$link}\" , slide_images = \"{$images}\" where slide_id in({$slide_object->slide_id})");

                $arraymsg = array(

                    "msg" => "تم تعديل الموضوع في السلايد بنجاح تام",

                    "color" => "good",

                    "url" => "plugin.php?gert=slide&go=slide_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            echo "<form action=\"plugin.php?gert=slide&go=slide_option&fort=edit&id={$slide_object->slide_id}&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

            echo "<tr><td class=\"tcotadmin\">عنوان الموضوع في السلايد</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$slide_object->slide_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الموضوع في السلايد</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">رقم الموضوع للسلايد</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input dir=\"ltr\" style=\"width:100px\" class=\"input\" name=\"link\" value=\"{$slide_object->slide_link}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رقم الموضوع الذي يأدي إليه السلايد</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">صورة الموضوه في السلايد</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"{$slide_object->slide_images}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الموضوع في السلايد التي تظهر في الهايدر</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ترتيب الموضوع في السلايد</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"{$slide_object->slide_order}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالموضوع في السلايد و إن كنت لا تريده مرتب أتركه 1</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

            echo "</table></form>";
        }
    } elseif (fort == "delete") {

        delete_mysql("arab-forums", "slide", "slide_id in({$slide_object->slide_id})");

        $arraymsg = array(

            "msg" => "تم حذف الإعلان بنجاح تام",

            "color" => "good",

            "url" => "plugin.php?gert=slide&go=slide_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        $arraymsg = array(

            "msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا",

            "color" => "error",

            "url" => "plugin.php?gert=catforum&go=slide_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    $arraymsg = array(

        "msg" => "الموضوع في السلايد المختار غير موجود ضمن قائمة المواضيع في السلايد",

        "color" => "error",

        "url" => "plugin.php?gert=catforum&go=slide_list",

    );

    echo msgadmin_template("arab-forums", $arraymsg);
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
