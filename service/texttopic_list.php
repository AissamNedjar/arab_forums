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

if (per_other("arab-forums", 12) == false) {

    $error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";
} elseif (is_numeric(value) && allowedin3_other("arab-forums", value, 1) == false) {

    $error = "للأسف لا يمكنك عرض أسماء هذا المنتدى لأنك لا تملك التصريح المناسب";
} else {

    $error = "";
}

if ($error == "") {

    if (is_numeric(value)) {

        $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name", "where forum_id in(" . value . ") limit 1");

        $forum_object = object_mysql("arab-forums", $forum_sql);

        $textu = "عرض إختصارات : {$forum_object->forum_name}";

        $urlp = "service.php?gert=texttopic&go=texttopic_list&value={$forum_object->forum_id}&";

        $sqlp = "a.texttopic_forumid in({$forum_object->forum_id})";

        $sqlu = "texttopic_forumid in({$forum_object->forum_id})";
    } else {

        $textu = "عرض الإختصرات التابعة للمنتديات التي أشرف عليها";

        $urlp = "service.php?gert=texttopic&go=texttopic_list&";

        $sqlp = "(a.texttopic_forumid in(0) || a.texttopic_forumid in(" . allowedin1_other("arab-forums") . "))";

        $sqlu = "(texttopic_forumid in(0) || texttopic_forumid in(" . allowedin1_other("arab-forums") . "))";
    }

    $count_page = tother_option;

    $get_page = (page == "" || !is_numeric(page) ? 1 : page);

    $limit_page = (($get_page * $count_page) - $count_page);

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td>" . img_other("arab-forums", "images/service.png", "", "", "", "0", "", "") . "</td>";

    echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}</span></td>";

    echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض إختصارات</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

    echo "<option value=\"service.php?gert=texttopic&go=texttopic_list\" " . (value == "" ? "selected" : "") . ">عرض الإختصارات التابعة للمنتديات التي أشرف عليها</option>";

    $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

    if (num_mysql("arab-forums", $forum_sql) != false) {

        while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

            echo "<option value=\"service.php?gert=texttopic&go=texttopic_list&value={$forum_object->forum_id}\" " . (value == "{$forum_object->forum_id}" ? "selected" : "") . ">عرض إختصارات {$forum_object->forum_name}</option>";
        }
    }

    echo "</select></div></td>";

    echo page_pager("arab-forums", "texttopic", "texttopic_id , texttopic_forumid", "where {$sqlu}", $count_page, $get_page, $urlp);

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr>";

    echo "<td class=\"tcotadmin\" width=\"25%\"><nobr>إسم الإختصار</nobr></td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\"><nobr>تمت الإضافة بواسطة</nobr></td>";

    echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\"><nobr>تاريخ الإضافة</nobr></td>";

    echo "<td class=\"tcotadmin\" width=\"25%\" align=\"center\"><nobr>المنتدى</nobr></td>";

    echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\"><nobr>خيارات</nobr></td>";

    echo "</tr>";

    $texttopic_sql = select_mysql("arab-forums", "texttopic", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , f.forum_id , f.forum_name , a.texttopic_id , a.texttopic_name , a.texttopic_forumid , a.texttopic_add , a.texttopic_date", "as a left join user" . prefix_connect . " as u on(u.user_id = a.texttopic_add) left join forum" . prefix_connect . " as f on(f.forum_id = a.texttopic_forumid) where {$sqlp} order by a.texttopic_date desc limit {$limit_page},{$count_page}");

    if (num_mysql("arab-forums", $texttopic_sql) != false) {

        while ($texttopic_object = object_mysql("arab-forums", $texttopic_sql)) {

            echo "<tr>";

            echo "<td class=\"alttext1\" align=\"center\"><br><div class=\"pad\">{$texttopic_object->texttopic_name}</div><br></td>";

            echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\">" . user_other("arab-forums", array($texttopic_object->user_id, $texttopic_object->user_group, $texttopic_object->user_nameuser, $texttopic_object->user_lock1, $texttopic_object->user_coloruser, false)) . "</div></td>";

            echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\">" . times_date("arab-forums", "", $texttopic_object->texttopic_date) . "</div></td>";

            echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\"><span style=\"color:orange;font-size:12px;\">" . ($texttopic_object->texttopic_forumid != 0 ? a_other("arab-forums", "forum.php?id={$texttopic_object->forum_id}", "{$texttopic_object->forum_name}", "{$texttopic_object->forum_name}", "") : "في جميع المنتديات") . "</span></div></td>";

            echo "<td class=\"alttext1\" align=\"center\"><table><tr>";

            if (($texttopic_object->texttopic_forumid == 0 && group_user == 6) || ($texttopic_object->texttopic_forumid > 0)) {

                echo "<td>" . a_other("arab-forums", "service.php?gert=texttopic&go=texttopic_option&fort=edit&id={$texttopic_object->texttopic_id}", "تعديل الإختصار", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

                echo "<td>" . a_other("arab-forums", "service.php?gert=texttopic&go=texttopic_option&fort=delete&id={$texttopic_object->texttopic_id}", "حذف الإختصار", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الإختصار ؟")) . "</td>";
            }

            echo "</tr></table></td>";

            echo "</tr>";
        }
    } else {

        echo "<tr>";

        echo "<td class=\"alttext1\" align=\"center\" colspan=\"5\"><br><div class=\"pad\">لا يوجد أي إختصار حاليا</div><br></td>";

        echo "</tr>";
    }

    echo "</table>";
} else {

    $arraymsg = array(

        "msg" => $error,

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
