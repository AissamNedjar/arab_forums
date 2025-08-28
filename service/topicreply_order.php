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

if (allowedin3_other("arab-forums", value, 1) == false) {

    $error = "للأسف لا يمكنك ترتيب وصلات مواضيع هذا المنتدى لأنك لا تملك التصريح المناسب";
} else {

    $error = "";
}

if ($error == "") {

    if (type == "insert") {

        $error = "";

        $topic_get1 = text_other("arab-forums", post_other("arab-forums", "topicorder"), false, false, false, false, true);

        $topic_get2 = text_other("arab-forums", post_other("arab-forums", "topicorder_id"), false, false, false, false, true);

        $i = 0;

        $j = 0;

        while ($i < count($cat_get1)) {

            if ($topic_get1[$j] == "" || !is_numeric($topic_get1[$j])) {

                $error .= "1";
            }

            $j++;

            $i++;
        }

        if ($error != "") {

            $arraymsg = array(

                "msg" => "الرجاء ملأ جميع الحقول ليتم إدخال الترتيب الجديد",

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            $i = 0;
            $j = 0;

            while ($i < count($topic_get1)) {

                $topicoft1 = text_other("arab-forums", $topic_get1[$j], true, true, true, false, true);

                $topicoft2 = text_other("arab-forums", $topic_get2[$i], true, true, true, false, true);

                update_mysql("arab-forums", "topic", "topic_linkorder = \"{$topicoft1}\" where topic_id = \"{$topicoft2}\"");

                $j++;
                $i++;
            }
            $arraymsg = array(

                "msg" => "تم حفظ الترتيب الجديد بنجآح تام",

                "color" => "good",

                "url" => "service.php?gert=topicreply&go=topicreply_order&value=" . value . "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name", "where forum_id in(" . value . ") limit 1");

        $forum_object = object_mysql("arab-forums", $forum_sql);

        $textu = "عرض وصلات مواضيع : {$forum_object->forum_name}";

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/service.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}</span></td>";

        echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض وصلات مواضيع</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

        $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

        if (num_mysql("arab-forums", $forum_sql) != false) {

            while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                echo "<option value=\"service.php?gert=topicreply&go=topicreply_order&value={$forum_object->forum_id}\" " . (value == "{$forum_object->forum_id}" ? "selected" : "") . ">عرض وصلات مواضيع {$forum_object->forum_name}</option>";
            }
        }

        echo "</select></div></td>";

        echo "</tr></table>";

        echo "<form action=\"service.php?gert=topicreply&go=topicreply_order&value=" . value . "&type=insert\" method=\"post\">";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

        echo "<tr>";

        echo "<td class=\"tcotadmin\" width=\"75%\"><nobr>الموضوع</nobr></td>";

        echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\"><nobr>الوصلة</nobr></td>";

        echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><nobr>الترتيب</nobr></td>";

        echo "</tr>";

        $link_sql = select_mysql("arab-forums", "topic", "topic_id , topic_forumid , topic_name , topic_wait , topic_delete , topic_hid , topic_link ,  topic_linkorder", "where topic_forumid in(" . value . ") && topic_wait in(0) && topic_delete in(0) && topic_hid in(0) && topic_link in(1,2) order by topic_linkorder asc");

        if (num_mysql("arab-forums", $link_sql) != false) {

            while ($link_object = object_mysql("arab-forums", $link_sql)) {

                echo "<tr>";

                echo "<td class=\"alttext1\" align=\"right\"><br><div class=\"pad\">" . a_other("arab-forums", "topic.php?id={$link_object->topic_id}", "{$link_object->topic_name}", "{$link_object->topic_name}", "") . "</div><br></td>";

                echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\">" . ($link_object->topic_link == 1 ? "عادية" : "أساسية") . "</div></td>";

                echo "<td class=\"alttext1\" align=\"center\"><div class=\"pad\"><span style=\"color:orange;font-size:12px;\"><input class=\"input\" type=\"text\" name=\"topicorder[]\" size=\"1\" value=\"{$link_object->topic_linkorder}\"><input type=\"hidden\" name=\"topicorder_id[]\" value=\"{$link_object->topic_id}\"></span></div></td>";

                echo "</tr>";
            }

            echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"6\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الترتيب الجديد\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الترتيب الجديد ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";
        } else {

            echo "<tr>";

            echo "<td class=\"alttext1\" align=\"center\" colspan=\"3\"><br><div class=\"pad\">لا يوجد أي موضوع مجعول كوصلة في هذا المنتدى حاليا</div><br></td>";

            echo "</tr>";
        }

        echo "</table>";

        echo "</form>";
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
