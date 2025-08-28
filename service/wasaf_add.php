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

if (per_other("arab-forums", 10) == true) {

    if (num_mysql("arab-forums", select_mysql("arab-forums", "forum", "forum_id", "where forum_id in(" . allowedin1_other("arab-forums") . ")")) == false) {

        $arraymsg = array(

            "msg" => "للأسف لا يمكنك إدخال وصف جديد لأن عدد المنتديات التي تشرف عليها هي 0",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        if (type == "insert") {

            $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

            $forumid = text_other("arab-forums", post_other("arab-forums", "forumid"), true, true, true, false, true);

            $forumall = text_other("arab-forums", post_other("arab-forums", "forumall"), true, true, true, false, true);

            if ($name == "" || $forumid == "") {

                $error = "الرجاء ملأ جميع الحقول ليتم إدخال الوصف الجديد";
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

                if (group_user > 2) {

                    $alerrtt = ", wasaf_forumall";

                    $alerrty = ", \"{$forumall}\"";

                    $alerrtr = "0";

                    $alerrtq = "تم إدخال الوصف الجديد بنجآح تام";
                } else {

                    $alerrtt = "";

                    $alerrty = "";

                    $alerrtr = "1";

                    $alerrtq = "تم إدخال الوصف الجديد بنجآح تام و لآكن يحتاج الموافقة ليتم إستخدامه";
                }

                insert_mysql("arab-forums", "wasaf", "wasaf_id , wasaf_name , wasaf_forumid , wasaf_add , wasaf_date , wasaf_lock {$alerrtt}", "null , \"{$name}\" , \"{$forumid}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$alerrtr}\" {$alerrty}");

                $arraymsg = array(

                    "msg" => $alerrtq,

                    "color" => "good",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            echo "<form action=\"service.php?gert=wasaf&go=wasaf_add&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

            echo "<tr><td class=\"tcotadmin\">الوصف تابع للمنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

            if (num_mysql("arab-forums", $forum_sql) != false) {

                echo "<select class=\"inputselect\" name=\"forumid\">";

                if (group_user == 6) {

                    echo "<option value=\"0\">إضافة الوصف في جميع المنتديات</option>";
                }

                while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                    echo "<option value=\"{$forum_object->forum_id}\">{$forum_object->forum_name}</option>";
                }

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الوصف له</span>";
            }

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">عنوان الوصف</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الوصف</span>";

            echo "</div></td></tr>";

            if (group_user > 2) {

                echo "<tr><td class=\"tcotadmin\">ظهور الوصف</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"forumall\">";

                echo "<option value=\"0\">لآ</option>";

                echo "<option value=\"1\">نعم</option>";

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الوصف يظهر في جميع المنتديات ؟</span>";

                echo "</div></td></tr>";
            }

            echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الوصف الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الوصف الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

            echo "</table></form>";
        }
    }
} else {

    $arraymsg = array(

        "msg" => "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية",

        "color" => "error",

        "url" => "",

    );

    echo msgadmin_template("arab-forums", $arraymsg);
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
