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

if (is_numeric(value) && allowedin3_other("arab-forums", value, 1) == false) {

    $error = "للأسف لا يمكنك عرض الردود التي تنتظر الموافقة في هذا المنتدى لأنك لا تملك التصريح المناسب";
} else {

    $error = "";
}

if ($error == "") {

    $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

    $wait  = text_other("arab-forums", post_other("arab-forums", "wait"), false, false, false, false, false);

    $import = @implode(",", $allyu);

    if (isset($wait)) {

        if ($allyu == 0) {

            $arraymsg = array(

                "msg" => "الرجاء تحديد رد وآحد على الأقل ليتم الموافقة عليه",

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            $reply_sql = select_mysql("arab-forums", "reply", "reply_id , reply_wait", "where reply_id in({$import}) && reply_wait in(1)");

            if (num_mysql("arab-forums", $reply_sql) != false) {

                while ($reply_object = object_mysql("arab-forums", $reply_sql)) {

                    update_mysql("arab-forums", "reply", "reply_wait = \"0\" where reply_id in({$reply_object->reply_id})");

                    insert_mysql("arab-forums", "optionreply", "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type", "null , \"{$reply_object->reply_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"wait\"");
                }
            }

            $arraymsg = array(

                "msg" => "تم الموافقة على الردود المحددة بنجآح تام",

                "color" => "good",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        if (is_numeric(value)) {

            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name", "where forum_id in(" . value . ") limit 1");

            $forum_object = object_mysql("arab-forums", $forum_sql);

            $textu = "عرض الردود في : {$forum_object->forum_name}";

            $urlp = "service.php?gert=topicreply&go=topicreply_replywait&value={$forum_object->forum_id}&";

            $sqlp = "&& t.topic_forumid in({$forum_object->forum_id})";

            $sqlu = "&& t.topic_forumid in({$forum_object->forum_id})";
        } else {

            $textu = "عرض جميع الردود في المنتديات التي أشرف عليها";

            $urlp = "service.php?gert=topicreply&go=topicreply_replywait&";

            $sqlp = "&& t.topic_forumid in(" . allowedin1_other("arab-forums") . ")";

            $sqlu = "&& t.topic_forumid in(" . allowedin1_other("arab-forums") . ")";
        }

        $count_page = tother_option;

        $get_page = (page == "" || !is_numeric(page) ? 1 : page);

        $limit_page = (($get_page * $count_page) - $count_page);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/service.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}</span></td>";

        echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض ردود</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

        echo "<option value=\"service.php?gert=topicreply&go=topicreply_replywait\" " . (value == "" ? "selected" : "") . ">عرض الردود التابعة للمنتديات التي أشرف عليها</option>";

        $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

        if (num_mysql("arab-forums", $forum_sql) != false) {

            while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                echo "<option value=\"service.php?gert=topicreply&go=topicreply_replywait&value={$forum_object->forum_id}\" " . (value == "{$forum_object->forum_id}" ? "selected" : "") . ">عرض ردود {$forum_object->forum_name}</option>";
            }
        }

        echo "</select></div></td>";

        echo page_pager("arab-forums", "reply", "r.reply_id , r.reply_topicid ,  r.reply_wait , r.reply_delete , t.topic_id , t.topic_forumid , t.topic_delete", "as r left join topic" . prefix_connect . " as t on(t.topic_id = r.reply_topicid) where r.reply_wait in(1) && r.reply_delete in(0) && t.topic_delete in(0) {$sqlu}", $count_page, $get_page, $urlp);

        echo "</tr></table>";

        echo "<form action=\"" . self . "\" method=\"post\">";

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td><nobr><input class=\"button\" value=\"الموافقة على الردود المحددة\" type=\"submit\" name=\"wait\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الردود المحددة ؟") . "></nobr></td>";

        echo "<td width=\"100%\"></td>";

        echo "</tr></table>";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

        $inputtext = array(

            1 => "تحديد جميع الردود",

            2 => "إلغاء تحديد جميع الردود",

            3 => "لا توجد ردود بالصفحة حاليا",

            4 => "عدد الردود الذي إخترت هو :",

            5 => "الرد",

        );

        echo "<tr>";

        echo "<td class=\"tcotadmin\" width=\"95%\" align=\"center\" colspan=\"4\">الرد</td>";

        echo "</tr>";

        echo "<tr>";

        echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";

        echo "<td class=\"tcotadmin\" width=\"60%\" align=\"center\">الموضوع</td>";

        echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\">كاتب الرد</td>";

        echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">المنتدى</td>";

        echo "</tr>";

        $reply_sql = select_mysql("arab-forums", "reply", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , r.reply_id , r.reply_topicid , r.reply_user , r.reply_date ,  r.reply_wait , r.reply_delete , r.reply_message , t.topic_id , t.topic_forumid , t.topic_name , t.topic_delete , f.forum_id , f.forum_name", "as r left join user" . prefix_connect . " as u on(u.user_id = r.reply_user) left join topic" . prefix_connect . " as t on(t.topic_id = r.reply_topicid) left join forum" . prefix_connect . " as f on(f.forum_id = t.topic_forumid) where r.reply_wait in(1) && r.reply_delete in(0) && t.topic_delete in(0) {$sqlp} order by r.reply_date asc limit {$limit_page},{$count_page}");

        if (num_mysql("arab-forums", $reply_sql) != false) {

            while ($reply_object = object_mysql("arab-forums", $reply_sql)) {

                echo "<tr>";

                echo "<td class=\"alttext2\" align=\"center\"><div class=\"pad\"><input onclick=\"check1(this, '{$reply_object->reply_id}' , 'alttext1' , 'الرد' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الرد\" value=\"{$reply_object->reply_id}\"><input type=\"hidden\" name=\"bg_{$reply_object->reply_id}\" id=\"bg_{$reply_object->reply_id}\" value=\"alttext1\"></div></td>";

                echo "<td class=\"alttext2\" align=\"center\"><div class=\"pad\">" . a_other("arab-forums", "topic.php?id={$reply_object->topic_id}", "{$reply_object->topic_name}", "{$reply_object->topic_name}", "") . "</div></td>";

                echo "<td class=\"alttext2\" align=\"center\"><div class=\"pad\">" . ($reply_object->reply_date != "" && $reply_object->reply_user != "" ? "<span style=\"font-size:13px;\">" . user_other("arab-forums", array($reply_object->user_id, $reply_object->user_group, $reply_object->user_nameuser, $reply_object->user_lock1, $reply_object->user_coloruser, false)) . "</span><br><nobr>" . times_date("arab-forums", "", $reply_object->reply_date) . "</nobr>" : "") . "</div></td>";

                echo "<td class=\"alttext2\" align=\"center\"><div class=\"pad\">" . a_other("arab-forums", "forum.php?id={$reply_object->forum_id}", "{$reply_object->forum_name}", "<span style=\"color:red;font-size:12px;\">{$reply_object->forum_name}</span>", "") . "</div></td>";

                echo "</tr>";

                echo "<tr class=\"alttext1\" id=\"tr_{$reply_object->reply_id}\" align=\"center\">";

                echo "<td colspan=\"4\"><div class=\"pad\"><table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">" . messagereplase_other("arab-forums", $reply_object->reply_message, $reply_object->forum_id) . "</td></tr></table></div></td>";

                echo "</tr>";
            }
        } else {

            echo "<tr>";

            echo "<td class=\"alttext1\" align=\"center\" colspan=\"4\"><br><div class=\"pad\">لآ يوجد أي رد ينتظر الموافقة حاليا</div><br></td>";

            echo "</tr>";
        }

        echo "</table></form>";
    }
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
