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

if (per_other("arab-forums", 11) == true) {

    $iconstopic_sql = select_mysql("arab-forums", "iconstopic", "a.iconstopic_id , a.iconstopic_name , a.iconstopic_images , a.iconstopic_forumid , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_name , f.forum_mode", "as a left join forum" . prefix_connect . " as f on(a.iconstopic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where iconstopic_id in(" . id . ")");

    if (num_mysql("arab-forums", $iconstopic_sql) == false) {

        $errorp = "الأيقونة المختارة غير موجودة ضمن قائمة الأيقونات";
    } else {

        $iconstopic_object = object_mysql("arab-forums", $iconstopic_sql);

        $moderatget1 = moderatget1_other("arab-forums", $iconstopic_object->forum_id, $iconstopic_object->cat_monitor1, $iconstopic_object->cat_monitor2, $iconstopic_object->forum_mode);

        if (($iconstopic_object->iconstopic_forumid == 0 && group_user != 6) || ($iconstopic_object->iconstopic_forumid > 0 && $moderatget1 == false)) {

            $errorp = "للأسف لا تملك التصريح المناسب لتعديل أو حذف هذه الأيقونة";
        } else {

            $errorp = "";
        }
    }

    if ($errorp == "") {

        if (fort == "edit") {

            if (type == "insert") {

                $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

                $images = text_other("arab-forums", post_other("arab-forums", "images"), true, true, true, false, true);

                $forumid = text_other("arab-forums", post_other("arab-forums", "forumid"), true, true, true, false, true);

                if ($name == "" || $images == "" || $forumid == "") {

                    $error = "الرجاء ملأ جميع الحقول ليتم التعديل على الأيقونة";
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

                    update_mysql("arab-forums", "iconstopic", "iconstopic_name = \"{$name}\" , iconstopic_images = \"{$images}\" , iconstopic_forumid = \"{$forumid}\" where iconstopic_id in({$iconstopic_object->iconstopic_id})");

                    $arraymsg = array(

                        "msg" => "تم تعديل الأيقونة بنجاح تام",

                        "color" => "good",

                        "url" => "service.php?gert=iconstopic&go=iconstopic_list",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                }
            } else {

                echo "<form action=\"service.php?gert=iconstopic&go=iconstopic_option&fort=edit&id={$iconstopic_object->iconstopic_id}&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

                echo "<tr><td class=\"tcotadmin\">الأيقونة تابعة لمنتدى</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

                if (num_mysql("arab-forums", $forum_sql) != false) {

                    echo "<select class=\"inputselect\" name=\"forumid\">";

                    if (group_user == 6) {

                        echo "<option value=\"0\" " . ($iconstopic_object->iconstopic_forumid == 0 ? "selected" : "") . ">إضافة الأيقونة في جميع المنتديات</option>";
                    }

                    while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                        echo "<option value=\"{$forum_object->forum_id}\" " . ($iconstopic_object->iconstopic_forumid == $forum_object->forum_id ? "selected" : "") . ">{$forum_object->forum_name}</option>";
                    }

                    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الأيقونة له</span>";
                }

                echo "</div></td></tr>";

                echo "<tr><td class=\"tcotadmin\">إسم الأيقونة</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$iconstopic_object->iconstopic_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم الأيقونة</span>";

                echo "</div></td></tr>";

                echo "<tr><td class=\"tcotadmin\">صورة الأيقونة</td></tr>";

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"images\" value=\"{$iconstopic_object->iconstopic_images}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة الأيقونة التي تظهر في الموضوع</span>";

                echo "</div></td></tr>";

                echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

                echo "</table></form>";
            }
        } elseif (fort == "delete") {

            update_mysql("arab-forums", "topic", "topic_icons = \"0\" where topic_icons in({$iconstopic_object->iconstopic_id})");

            delete_mysql("arab-forums", "iconstopic", "iconstopic_id in({$iconstopic_object->iconstopic_id})");

            $arraymsg = array(

                "msg" => "تم حذف الأيقونة بنجاح تام",

                "color" => "good",

                "url" => "service.php?gert=iconstopic&go=iconstopic_list",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            $arraymsg = array(

                "msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا",

                "color" => "error",

                "url" => "service.php?gert=catforum&go=iconstopic_list",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        $arraymsg = array(

            "msg" => $errorp,

            "color" => "error",

            "url" => "service.php?gert=catforum&go=iconstopic_list",

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

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
