<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums", true);

@include("includes.php");

define("pageupdate", true);

@include("includes/e.noopen.php");

define("pagebody", "pmlist");

online_other("arab-forums", "pmlist", "0", "0", "0", "0");

if (group_user == 0) {

    $arraymsg = array(

        "login" => true,

        "msg" => "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب",

        "color" => "error",

        "old" => true,

        "auto" => false,

        "text" => "",

        "url" => "",

        "array" => "",

    );

    echo msg_template("arab-forums", $arraymsg);
} else {

    if (msgf != "" && is_numeric(msgf)) {

        $pmlistrt = "f";
    } elseif (msgu != "" && is_numeric(msgu)) {

        $pmlistrt = "t";
    } elseif (admin != "") {

        $pmlistrt = "a";
    } else {

        $pmlistrt = "m";
    }

    $forum_sql = select_mysql("arab-forums", "forum", "c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_mode", "as f left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where f.forum_id in(" . msgf . ") limit 1");

    if (num_mysql("arab-forums", $forum_sql) == false) {

        $error_forum = false;
    } else {

        $forum_object = object_mysql("arab-forums", $forum_sql);

        $moderatget1 = moderatget1_other("arab-forums", $forum_object->forum_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2, $forum_object->forum_mode);

        $moderatget2 = moderatget2_other("arab-forums", $forum_object->cat_monitor1, $forum_object->cat_monitor2);

        if ($moderatget1 == true) {

            $error_forum = true;
        } else {

            $error_forum = false;
        }
    }

    $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_wait , user_bad , user_active", "where user_id in(" . msgu . ") && user_wait in(0) && user_bad in(0) && user_active in(0) limit 1");

    if (num_mysql("arab-forums", $user_sql) == false) {

        $error_user = false;
    } else {

        $user_object = object_mysql("arab-forums", $user_sql);

        if ($user_object->user_id != id_user && group_user == 6) {

            $error_user = true;
        } else {

            $error_user = false;
        }
    }

    if ($pmlistrt == "f" && $error_forum == true) {

        $titlem = "الرسائل الخاصة بــ {$forum_object->forum_name}";

        $getm = "-{$forum_object->forum_id}";

        $url1 = "message.php?msgf={$forum_object->forum_id}";

        $url2 = "pmlist.php?msgf={$forum_object->forum_id}&";

        $typeo = "forum";
    } elseif ($pmlistrt == "t" && msgu != id_user && $error_user == true) {

        $titlem = "الرسائل الخاصة بــ {$user_object->user_nameuser}";

        $getm = "{$user_object->user_id}";

        $url1 = "message.php?msgu={$user_object->user_id}";

        $url2 = "pmlist.php?msgu={$user_object->user_id}&";

        $typeo = "user";
    } elseif ($pmlistrt == "a" && group_user == 6) {

        $titlem = "الرسائل الخاصة بإدارة المنتديات";

        $getm = "0";

        $url1 = "message.php?admin=true";

        $url2 = "pmlist.php?admin=true&";

        $typeo = "admin";
    } else {

        $titlem = "الرسائل الخاصة بك";

        $getm = id_user;

        $url1 = "message.php";

        $url2 = "pmlist.php?";

        $typeo = "my";
    }

    if (type == "insert") {

        for ($x = 1; $x <= maxpmlist_option; ++$x) {

            $folder = "folder{$x}";

            $foldert = text_other("arab-forums", post_other("arab-forums", $folder), true, true, true, true, true);

            if (mb_strlen($foldert) <= 3) {

                $foldert = "";
            } else {

                $foldert = $foldert;
            }

            if ($foldert != "") {

                $folder_sql = select_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "where pmlist_user in({$getm}) && pmlist_folder in({$x}) limit 1");

                if (num_mysql("arab-forums", $folder_sql) == false) {

                    insert_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "null , \"{$getm}\" , \"{$x}\" , \"{$foldert}\"");
                } else {

                    update_mysql("arab-forums", "pmlist", "pmlist_name = \"{$foldert}\" where pmlist_user in({$getm}) && pmlist_folder in({$x}) limit 1");
                }
            } else {

                $folder_sql = select_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "where pmlist_user in({$getm}) && pmlist_folder in({$x}) limit 1");

                if (num_mysql("arab-forums", $folder_sql) != false) {

                    update_mysql("arab-forums", "pmlist", "pmlist_name = null where pmlist_user in({$getm}) && pmlist_folder in({$x}) limit 1");
                }
            }
        }

        $arraymsg = array(

            "login" => true,

            "msg" => "تم حفظ التعديلات الجديدة بنجآح تام",

            "color" => "good",

            "old" => true,

            "auto" => false,

            "text" => "",

            "url" => "",

            "array" => "",

        );

        echo msg_template("arab-forums", $arraymsg);
    } else {

        echo bodytop_template("arab-forums", $titlem);

        $arrayheader = array(

            "login" => true,

        );

        echo header_template("arab-forums", $arrayheader);

        $count_page = tother_option;

        $get_page = (page == "" || !is_numeric(page) ? 1 : page);

        $limit_page = (($get_page * $count_page) - $count_page);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/pmlist.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\">" . a_other("arab-forums", $url1, $titlem, $titlem, "") . "</td>";

        echo list_forumcatlist("arab-forums");

        echo "</tr></table>";

        echo "<form action=\"{$url2}type=insert\" method=\"post\">";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">المجلدات البريدية</div></td>";

        echo "</tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcot\" colspan=\"2\"><div class=\"pad\">لإضافة مجلدات بريدية لحفظ الرسائل فيها<br><br>الرجاء إدخال أسماء المجلدات في الخانات أدناه</div></td>";

        echo "</tr>";

        echo "<tr align=\"right\">";

        echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">رقم المجلد</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">العنوان</div></td>";

        echo "</tr>";

        for ($x = 1; $x <= maxpmlist_option; ++$x) {

            $pmlist_sql = select_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "where pmlist_user in({$getm}) && pmlist_folder in({$x}) limit 1");

            $pmlist_object = object_mysql("arab-forums", $pmlist_sql);

            echo "<tr align=\"right\">";

            echo "<td class=\"tcot\"><div class=\"pad\">المجلد رقم {$x} : </div></td>";

            echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"folder{$x}\" value=\"{$pmlist_object->pmlist_name}\" type=\"text\"></div></td>";

            echo "</tr>";
        }

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td>";

        echo "</tr>";

        echo "</table>";

        echo "</form>";

        echo footer_template("arab-forums");

        echo bodybottom_template("arab-forums");
    }
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
