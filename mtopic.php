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

define("pagebody", "mtopic");

$get_id = (id == "" || !is_numeric(id) ? id_user : id);

$user_sql = select_mysql("arab-forums", "user", "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex", "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if (group_user == 0) {

    $error = "للأسف خاصية مواضيعك أو مواضيع عضو آخر متوفرة للأعضاء المسجلين فقط";
} else {

    if (num_mysql("arab-forums", $user_sql) == false) {

        $error = "عفوآ لا يمكنك مشاهدة مواضيع هذه العضوية لعدة أسباب";
    } else {

        $user_object = object_mysql("arab-forums", $user_sql);

        if (group_user == 1 && topicshow_option > post_user && $user_object->user_id != id_user) {

            $error = "للأسف خاصية مشاهدة مواضيع الأعضاء غير متوفرة للأعضاء الجدد";
        } else {

            $error = "";
        }
    }
}

if ($error != "") {

    online_other("arab-forums", "mtopic", "0", "0", "0", "0");

    $arraymsg = array(

        "login" => true,

        "msg" => $error,

        "color" => "error",

        "old" => true,

        "auto" => false,

        "text" => "",

        "url" => "",

        "array" => "",

    );

    echo msg_template("arab-forums", $arraymsg);
} else {

    online_other("arab-forums", "mtopic", "0", "0", "0", $user_object->user_id);

    if ($user_object->user_id == id_user) {

        $usertitle = "جميع مواضيعك";

        $usertitleerror = "لا توجد أي مواضيع لك بالمنتديات";

        $urltt = "mtopic.php";
    } else {

        $usertitle = "جميع مواضيع " . ($user_object->user_sex == 1 ? "العضو" : "العضوة") . " " . $user_object->user_nameuser . "";

        $usertitleerror = "لا توجد أي مواضيع " . ($user_object->user_sex == 1 ? "للعضو" : "للعضوة") . " " . $user_object->user_nameuser . " بالمنتديات";

        $urltt = "mtopic.php?id={$user_object->user_id}";
    }

    $gest = "";

    $echoaa = "";

    $echoaa .= bodytop_template("arab-forums", $usertitle);

    $arrayheader = array(

        "login" => true,

    );

    $echoaa .= header_template("arab-forums", $arrayheader);

    $echoaa .= "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    $echoaa .= "<td>" . img_other("arab-forums", "images/mtopic.png", "", "", "", "0", "", "") . "</td>";

    $echoaa .= "<td width=\"100%\">" . a_other("arab-forums", "{$urltt}", "{$usertitle}", "{$usertitle}", "") . "</td>";

    $echoaa .= list_forumcatlist("arab-forums");

    $echoaa .= "</tr></table>";

    $echoaa .= "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"40%\" align=\"center\">";

    $echoaa .= "<tr align=\"center\">";

    $echoaa .= "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">لتصفح المواضيع في منتدى معين إضغط على عددها</div></td>";

    $echoaa .= "</tr>";

    $cat_sql = select_mysql("arab-forums", "cat", "cat_id , cat_lock , cat_hid , cat_name , cat_order , cat_monitor1 , cat_monitor2 , cat_group" . group_user . "", "where cat_group" . group_user . " in(1) order by cat_order asc , cat_id asc");

    if (num_mysql("arab-forums", $cat_sql) != false) {

        while ($cat_object = object_mysql("arab-forums", $cat_sql)) {

            if ($cat_object->cat_hid == false || ($cat_object->cat_hid == true && cathide_other("arab-forums", $cat_object->cat_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2) == true)) {

                $forum_sql = select_mysql("arab-forums", "forum", "count(distinct t.topic_id) as topics_count , t.topic_user , t.topic_delete , t.topic_wait , t.topic_forumid , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_order , f.forum_group" . group_user . " , f.forum_moderattext , f.forum_mode", "as f left join topic" . prefix_connect . " as t on(t.topic_forumid = f.forum_id && t.topic_user in({$user_object->user_id}) && t.topic_delete in(0) && t.topic_wait in(0)) where f.forum_catid in({$cat_object->cat_id}) && f.forum_group" . group_user . " in(1) group by f.forum_id having(topics_count > 0) order by f.forum_order asc , f.forum_id asc");

                if (num_mysql("arab-forums", $forum_sql) != false) {

                    $gest .= "1";

                    $echoaa .= "<tr align=\"center\">";

                    $echoaa .= "<td class=\"tcat\" width=\"70%\" style=\"font-size:17px;\" align=\"right\"><div class=\"pad\">" . a_other("arab-forums", "cat.php?id={$cat_object->cat_id}", "{$cat_object->cat_name}", "{$cat_object->cat_name}", "") . "</div></td>";

                    $echoaa .= "<td class=\"tcat\" width=\"30%\">عدد المواضيع</td>";

                    $echoaa .= "</tr>";

                    $totaltopic = 0;

                    while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                        if ($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums", $forum_object->forum_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2, $forum_object->forum_mode) == true)) {

                            if ($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums", $cat_object->cat_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2, $forum_object->forum_mode) == true)) {

                                $echoaa .= "<tr align=\"center\">";

                                $echoaa .= "<td class=\"alttext1\" align=\"right\"><br><div class=\"pad\">" . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}", "{$forum_object->forum_name}", "{$forum_object->forum_name}", "") . "</div><br></td>";

                                $echoaa .= "<td class=\"alttext2\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr align=\"center\"><td width=\"1%\"><div class=\"pad\">" . ($forum_object->forum_lock == 1 ? img_other("arab-forums", "images/folder/lock.png", "المنتدى مغلوق", "", "", "0", "class=\"title\"", "") : img_other("arab-forums", "images/folder/new.png", "المنتدى مفتوح", "", "", "0", "class=\"title\"", "")) . "</div></td><td><div class=\"pad\">" . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}&type=user&value={$user_object->user_id}", "عدد المواضيع في هذا المنتدى هو : {$forum_object->topics_count}", num_other("arab-forums", $forum_object->topics_count), "") . "</div></td></tr></table></td>";

                                $echoaa .= "</tr>";

                                $totaltopic = ($totaltopic + $forum_object->topics_count);
                            }
                        }
                    }

                    $echoaa .= "<tr align=\"center\">";

                    $echoaa .= "<td class=\"tcot\" align=\"right\"><br><div class=\"pad\">مجموع المواضيع في الفئة</div><br></td>";

                    $echoaa .= "<td class=\"tcot\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr align=\"center\"><td width=\"1%\"><div class=\"pad\">" . ($cat_object->cat_lock == 1 ? img_other("arab-forums", "images/folder/lock.png", "الفئة مغلوقة", "", "", "0", "class=\"title\"", "") : img_other("arab-forums", "images/folder/new.png", "الفئة مفتوحة", "", "", "0", "class=\"title\"", "")) . "</div></td><td><div class=\"pad\">" . a_other("arab-forums", "cat.php?id={$cat_object->cat_id}", "مجموع المواضيع في الفئة هو : {$totaltopic}", num_other("arab-forums", $totaltopic), "") . "</div></td></tr></table></td>";

                    $echoaa .= "</tr>";
                }
            }
        }
    }

    $echoaa .= "</table>";

    $echoaa .= footer_template("arab-forums");

    $echoaa .= bodybottom_template("arab-forums");

    if ($gest == "") {

        $arraymsg = array(

            "login" => true,

            "msg" => $usertitleerror,

            "color" => "error",

            "old" => true,

            "auto" => false,

            "text" => "",

            "url" => "",

            "array" => "",

        );

        echo msg_template("arab-forums", $arraymsg);
    } else {

        echo $echoaa;
    }
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
