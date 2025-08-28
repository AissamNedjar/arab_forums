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

if (per_other("arab-forums", 9) == true) {

    if (num_mysql("arab-forums", select_mysql("arab-forums", "forum", "forum_id", "where forum_id in(" . allowedin1_other("arab-forums") . ")")) == false) {

        $arraymsg = array(

            "msg" => "للأسف لا يمكنك إدخال وسام جديد لأن عدد المنتديات التي تشرف عليها هي 0",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        if (type == "insert") {

            $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

            $point = text_other("arab-forums", post_other("arab-forums", "point"), true, true, true, false, true);

            $url = text_other("arab-forums", post_other("arab-forums", "url"), true, true, true, false, true);

            $forumid = text_other("arab-forums", post_other("arab-forums", "forumid"), true, true, true, false, true);

            if ($name == "" || $forumid == "" || $point == "" || $url == "") {

                $error = "الرجاء ملأ جميع الحقول ليتم إدخال الوسام الجديد";
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

                    $alerrtr = "0";

                    $alerrtq = "تم إدخال الوسام الجديد بنجآح تام";
                } else {

                    $alerrtr = "1";

                    $alerrtq = "تم إدخال الوسام الجديد بنجآح تام و لآكن يحتاج الموافقة ليتم إستخدامه";
                }

                insert_mysql("arab-forums", "medal", "medal_id , medal_name , medal_point , medal_url , medal_forumid , medal_add , medal_date , medal_lock", "null , \"{$name}\" , \"{$point}\" , \"{$url}\" , \"{$forumid}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$alerrtr}\"");

                $arraymsg = array(

                    "msg" => $alerrtq,

                    "color" => "good",

                    "url" => "service.php?gert=medal&go=medal_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            echo "<form action=\"service.php?gert=medal&go=medal_add&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

            echo "<tr><td class=\"tcotadmin\">الوسام تابع للمنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

            if (num_mysql("arab-forums", $forum_sql) != false) {

                echo "<select class=\"inputselect\" name=\"forumid\">";

                if (group_user == 6) {

                    echo "<option value=\"0\">إضافة الوسام في جميع المنتديات</option>";
                }

                while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                    echo "<option value=\"{$forum_object->forum_id}\">{$forum_object->forum_name}</option>";
                }

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الوسام له</span>";
            }

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">عنوان الوسام</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الوسام</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">رابط صورة الوسام</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"url\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الوسام</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">نقاط تميز الوسام</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"point\">";

            for ($vv = 1; $vv <= 50; $vv++) {

                echo "<option value=\"{$vv}\">{$vv}</option>";
            }

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">كم من نقطة تميز للوسام</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الوسام الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الوسام الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

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
