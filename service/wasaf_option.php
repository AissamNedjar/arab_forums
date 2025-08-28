<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |


|  site : www.prince-algeriw.com  || www.arab-forums-sc.com             |

|*#####################################################################*/

if (!defined("error_page_arab_forums")) {
    exit(header("location: ../error.php"));
}

if (per_other("arab-forums", 10) == true) {

    $wasaf_sql = select_mysql("arab-forums", "wasaf", "w.wasaf_id , w.wasaf_name , w.wasaf_forumid , w.wasaf_forumall , w.wasaf_lock , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_name , f.forum_mode", "as w left join forum" . prefix_connect . " as f on(w.wasaf_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where wasaf_id in(" . id . ")");

    if (num_mysql("arab-forums", $wasaf_sql) == false) {

        $errorp = "الوصف المختار غير موجود ضمن قائمة الأوصاف";
    } else {

        $wasaf_object = object_mysql("arab-forums", $wasaf_sql);

        $moderatget1 = moderatget1_other("arab-forums", $wasaf_object->forum_id, $wasaf_object->cat_monitor1, $wasaf_object->cat_monitor2, $wasaf_object->forum_mode);

        $moderatget2 = moderatget2_other("arab-forums", $wasaf_object->cat_monitor1, $wasaf_object->cat_monitor2);

        if (($wasaf_object->wasaf_forumid == 0 && group_user != 6) || ($wasaf_object->wasaf_forumid > 0 && $moderatget1 == false)) {

            $errorp = "للأسف لا تملك التصريح المناسب للتحكم في خصائص هذا الوصف";
        } else {

            $errorp = "";
        }
    }

    if ($errorp == "") {

        if (fort == "edit") {

            if (type == "insert") {

                $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

                $forumid = text_other("arab-forums", post_other("arab-forums", "forumid"), true, true, true, false, true);

                $forumall = text_other("arab-forums", post_other("arab-forums", "forumall"), true, true, true, false, true);

                if ($name == "" || $forumid == "") {

                    $error = "الرجاء ملأ جميع الحقول ليتم التعديل على الوصف";
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

                        $alerrtt = ", wasaf_forumall = \"{$forumall}\"";
                    } else {

                        $alerrtt = "";
                    }

                    update_mysql("arab-forums", "wasaf", "wasaf_name = \"{$name}\" , wasaf_forumid = \"{$forumid}\" {$alerrtt} where wasaf_id in({$wasaf_object->wasaf_id})");

                    $arraymsg = array(

                        "msg" => "تم تعديل الوصف بنجاح تام",

                        "color" => "good",

                        "url" => "service.php?gert=wasaf&go=wasaf_list",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                }
            } else {

                echo "<form action=\"service.php?gert=wasaf&go=wasaf_option&fort=edit&id={$wasaf_object->wasaf_id}&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

                echo "<tr><td class=\"tcotadmin\">الوصف تابع للمنتدى</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

                if (num_mysql("arab-forums", $forum_sql) != false) {

                    echo "<select class=\"inputselect\" name=\"forumid\">";

                    if (group_user == 6) {

                        echo "<option value=\"0\" " . ($wasaf_object->wasaf_forumid == 0 ? "selected" : "") . ">إضافة الوصف في جميع المنتديات</option>";
                    }

                    while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                        echo "<option value=\"{$forum_object->forum_id}\" " . ($wasaf_object->wasaf_forumid == $forum_object->forum_id ? "selected" : "") . ">{$forum_object->forum_name}</option>";
                    }

                    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الوصف له</span>";
                }

                echo "</div></td></tr>";

                echo "<tr><td class=\"tcotadmin\">عنوان الوصف</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$wasaf_object->wasaf_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان الوصف</span>";

                echo "</div></td></tr>";

                if (group_user > 2) {

                    echo "<tr><td class=\"tcotadmin\">ظهور الوصف</td></tr>";

                    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                    echo "<select class=\"inputselect\" name=\"forumall\">";

                    echo "<option value=\"0\" " . ($wasaf_object->wasaf_forumall == 0 ? "selected" : "") . ">لآ</option>";

                    echo "<option value=\"1\" " . ($wasaf_object->wasaf_forumall == 1 ? "selected" : "") . ">نعم</option>";

                    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل الوصف يظهر في جميع المنتديات ؟</span>";

                    echo "</div></td></tr>";
                }

                echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الوصف الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الوصف الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

                echo "</table></form>";
            }
        } elseif (fort == "wait" && $moderatget2 == true) {

            if ($wasaf_object->wasaf_lock == 0) {

                $arraymsg = array(

                    "msg" => "الوصف موافق عليه من قبل",

                    "color" => "error",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            } else {

                update_mysql("arab-forums", "wasaf", "wasaf_lock = \"0\" where wasaf_id in({$wasaf_object->wasaf_id})");

                $arraymsg = array(

                    "msg" => "تم الموافقة على الوصف بنجاح تام",

                    "color" => "good",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } elseif (fort == "bad" && $moderatget2 == true) {

            if ($wasaf_object->wasaf_lock == 2) {

                $arraymsg = array(

                    "msg" => "الوصف مرفوض من قبل",

                    "color" => "error",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            } else {

                update_mysql("arab-forums", "wasaf", "wasaf_lock = \"2\" where wasaf_id in({$wasaf_object->wasaf_id})");

                $arraymsg = array(

                    "msg" => "تم رفض الوصف بنجاح تام",

                    "color" => "good",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } elseif (fort == "delete" && $moderatget2 == true) {

            if ($wasaf_object->wasaf_lock == 3) {

                $arraymsg = array(

                    "msg" => "الوصف محذوف من قبل",

                    "color" => "error",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            } else {

                update_mysql("arab-forums", "wasaf", "wasaf_lock = \"3\" where wasaf_id in({$wasaf_object->wasaf_id})");

                $arraymsg = array(

                    "msg" => "تم حذف الوصف بنجاح تام",

                    "color" => "good",

                    "url" => "service.php?gert=wasaf&go=wasaf_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            $arraymsg = array(

                "msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا",

                "color" => "error",

                "url" => "service.php?gert=catforum&go=wasaf_list",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        $arraymsg = array(

            "msg" => $errorp,

            "color" => "error",

            "url" => "service.php?gert=catforum&go=wasaf_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
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


|  site : www.prince-algeriw.com  || www.arab-forums-sc.com             |

|*#####################################################################*/
