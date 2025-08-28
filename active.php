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

define("pagebody", "active");

online_other("arab-forums", "active", "0", "0", "0", "0");

echo bodytop_template("arab-forums", $usertitle);

$arrayheader = array(

    "login" => true,

);

echo header_template("arab-forums", $arrayheader);

if (forum_active == "reply") {

    $activetitle = "ترتيب بعدد الردود في كل موضوع";

    $activesql = "&& t.topic_reply >= \"10\" order by t.topic_lastdate desc";
} elseif (forum_active == "visit") {

    $activetitle = "ترتيب بعدد المشاهدات في كل موضوع";

    $activesql = "&& t.topic_visit >= \"50\" order by t.topic_lastdate desc";
} elseif (forum_active == "last") {

    $activetitle = "ترتيب بآخر مشاركة في كل موضوع";

    $activesql = "&& t.topic_reply > \"0\" order by t.topic_lastdate desc";
} elseif (forum_active == "top") {

    $activetitle = "ترتيب بالمواضيع المميزة في المنتديات";

    $activesql = "&& t.topic_top > \"0\" order by t.topic_lastdate desc";
} else {

    $activetitle = "ترتيب بآخر المواضيع الجديدة";

    $activesql = "order by t.topic_date desc";
}

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>" . img_other("arab-forums", "images/active.png", "", "", "", "0", "", "") . "</td>";

echo "<td width=\"100%\">" . a_other("arab-forums", "active.php", "مواضيع نشطة", "مواضيع نشطة", "") . "<div class=\"pad\"><span style=\"color:red;font-size:12px;\">{$activetitle}</span></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">خيارت الترتيب</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

echo "<option value=\"change.php?go=active&value=new\" " . (forum_active == "new" ? "selected" : "") . ">ترتيب بآخر المواضيع الجديدة</option>";

echo "<option value=\"change.php?go=active&value=last\" " . (forum_active == "last" ? "selected" : "") . ">ترتيب بآخر مشاركة في كل موضوع</option>";

echo "<option value=\"change.php?go=active&value=reply\" " . (forum_active == "reply" ? "selected" : "") . ">ترتيب بعدد الردود في كل موضوع</option>";

echo "<option value=\"change.php?go=active&value=visit\" " . (forum_active == "visit" ? "selected" : "") . ">ترتيب بعدد المشاهدات في كل موضوع</option>";

echo "<option value=\"change.php?go=active&value=top\" " . (forum_active == "top" ? "selected" : "") . ">ترتيب بالمواضيع المميزة في المنتديات</option>";

echo "</select></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">تحديث الصفحة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

echo "<option value=\"change.php?go=tahdit&value=0\" " . (forum_tahdit == 0 ? "selected" : "") . ">لا تحديث</option>";

echo "<option value=\"change.php?go=tahdit&value=60\" " . (forum_tahdit == 60 ? "selected" : "") . ">كل دقيقة</option>";

echo "<option value=\"change.php?go=tahdit&value=300\" " . (forum_tahdit == 300 ? "selected" : "") . ">كل 5 دقائق</option>";

echo "<option value=\"change.php?go=tahdit&value=600\" " . (forum_tahdit == 600 ? "selected" : "") . ">كل 10 دقائق</option>";

echo "<option value=\"change.php?go=tahdit&value=900\" " . (forum_tahdit == 900 ? "selected" : "") . ">كل 15 دقيقة</option>";

echo "</select></div></td>";

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" width=\"45%\" colspan=\"2\"><div class=\"pad\">الموضوع</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">الكاتب</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">آخر مشاركة</div></td>";

echo "<td class=\"tcat\" width=\"9%\"><div class=\"pad\">الردود</div></td>";

echo "<td class=\"tcat\" width=\"9%\"><div class=\"pad\">المشاهدات</div></td>";

echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">المنتدى</div></td>";

echo "</tr>";

$topic_sql = select_mysql("arab-forums", "topic", "i.iconstopic_id , i.iconstopic_name , i.iconstopic_images , i.iconstopic_forumid , x.texttopic_id , x.texttopic_name , x.texttopic_forumid , c.cat_id , c.cat_lock , c.cat_hid , c.cat_name , c.cat_monitor1 , c.cat_monitor2 , c.cat_group0 , c.cat_group1 , c.cat_group2 , c.cat_group3 , c.cat_group4 , c.cat_group5 , c.cat_group6 , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_logo , f.forum_moderattext , f.forum_totaltopic , f.forum_sex , f.forum_group0 , f.forum_group1 , f.forum_group2 , f.forum_group3 , f.forum_group4 , f.forum_group5 , f.forum_group6 , f.forum_mode , u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , t.topic_id , t.topic_forumid , t.topic_lock , t.topic_name , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_stiky , t.topic_top , t.topic_survey , t.topic_icons , t.topic_text , t.topic_reply , t.topic_visit , t.topic_date , t.topic_user , t.topic_lastdate , t.topic_lastuser", "as t left join iconstopic" . prefix_connect . " as i on(i.iconstopic_id = t.topic_icons) left join texttopic" . prefix_connect . " as x on(x.texttopic_id = t.topic_text) left join forum" . prefix_connect . " as f on(f.forum_id = t.topic_forumid) left join cat" . prefix_connect . " as c on(c.cat_id = f.forum_catid) left join user" . prefix_connect . " as u1 on(u1.user_id = t.topic_user) left join user" . prefix_connect . " as u2 on(u2.user_id = t.topic_lastuser) where f.forum_hid1 in(0) && f.forum_hid2 in(0) && c.cat_hid in(0) && c.cat_group0 in(1) && c.cat_group1 in(1) && c.cat_group2 in(1) && c.cat_group3 in(1) && c.cat_group4 in(1) && c.cat_group5 in(1) && c.cat_group6 in(1) && f.forum_group0 in(1) && f.forum_group1 in(1) && f.forum_group2 in(1) && f.forum_group3 in(1) && f.forum_group4 in(1) && f.forum_group5 in(1) && f.forum_group6 in(1) && t.topic_delete in(0) && t.topic_hid in(0) && t.topic_wait in(0) {$activesql} limit 50");

if (num_mysql("arab-forums", $topic_sql) != false) {

    while ($topic_object = object_mysql("arab-forums", $topic_sql)) {

        $moderatget1 = moderatget1_other("arab-forums", $topic_object->forum_id, $topic_object->cat_monitor1, $topic_object->cat_monitor2, $topic_object->forum_mode);

        $moderatget2 = moderatget2_other("arab-forums", $topic_object->cat_monitor1, $topic_object->cat_monitor2);

        if ($topic_object->topic_stiky == 1) {

            $classtopic = "topics";
        } else {

            $classtopic = "topicn";
        }

        if ($topic_object->topic_text != 0 && ($topic_object->texttopic_forumid == 0 || $topic_object->texttopic_forumid == $topic_object->forum_id)) {

            $text1topic = "<span style=\"color:red;\">{$topic_object->texttopic_name} : </span>";

            $text2topic = "{$topic_object->texttopic_name} : ";
        } else {

            $text1topic = "";

            $text2topic = "";
        }

        if ($topic_object->topic_icons != 0 && ($topic_object->iconstopic_forumid == 0 || $topic_object->iconstopic_forumid == $topic_object->forum_id)) {

            $iconstopic = img_other("arab-forums", $topic_object->iconstopic_images, $topic_object->iconstopic_name, "", "", "0", "class=\"title\"", "images/iconsno.png");
        } else {

            if ($topic_object->topic_lock == 1) {

                $iconstopic = img_other("arab-forums", "images/folder/lock.png", "هذا الموضوع مغلوق", "", "", "0", "class=\"title\"", "");
            } elseif ($topic_object->topic_lock == 0 && $topic_object->topic_reply >= 10) {

                $iconstopic = img_other("arab-forums", "images/folder/hote.png", "هذا الموضوع نشيط", "", "", "0", "class=\"title\"", "");
            } else {

                $iconstopic = img_other("arab-forums", "images/folder/new.png", "هذا الموضوع مفتوح", "", "", "0", "class=\"title\"", "");
            }
        }

        echo "<tr align=\"center\" class=\"topice {$classtopic}\">";

        echo "<td class=\"topic\" width=\"1%\">{$iconstopic}</td>";

        echo "<td class=\"topic\" align=\"right\"><table cellpadding=\"3\" cellspacing=\"1\"><tr>";

        echo "<td>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "", img_other("arab-forums", "images/plus.gif", "", "", "", "0", "", ""), "target=\"_blank\"") . "</td>";

        if ($topic_object->topic_survey > 0) {

            echo "<td>" . img_other("arab-forums", "images/survey.png", "هذا الموضوع يحتوي على إستفتاء", "", "", "0", "class=\"title\"", "") . "</td>";
        }

        if ($topic_object->topic_top == 1) {

            echo "<td>" . img_other("arab-forums", "images/top1.png", "هذا الموضوع متميز في هذا المنتدى", "", "", "0", "class=\"title\"", "") . "</td>";
        } elseif ($topic_object->topic_top == 2) {

            echo "<td>" . img_other("arab-forums", "images/top2.png", "هذا الموضوع متميز في جميع المنتديات", "", "", "0", "class=\"title\"", "") . "</td>";
        }

        echo "<td width=\"100%\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "{$text2topic}{$topic_object->topic_name}", "{$text1topic}{$topic_object->topic_name}", "") . "" . reply_pager("arab-forums", forum_replytopic, $topic_object->topic_id, $topic_object->topic_reply) . "</td>";

        if (group_user > 0) {

            if (($moderatget1 == true) || ($topic_object->topic_lock == 0 && $topic_object->topic_user == id_user)) {

                echo "<td>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=edittopic", "تعديل الموضوع", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";
            }

            if (($moderatget1 == true) || ($topic_object->topic_lock == 0) || (num_mysql("arab-forums", select_mysql("arab-forums", "locktopic", "locktopic_userid , locktopic_topicid", "where locktopic_userid in(" . id_user . ") && locktopic_topicid in(" . $topic_object->topic_id . ") limit 1")) != false)) {

                echo "<td>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=newreply", "الرد على الموضوع", img_other("arab-forums", "images/add.png", "", "", "", "0", "", ""), "") . "</td>";
            }
        }

        echo "</tr></table></td>";

        echo "<td class=\"topic\">" . ($topic_object->topic_date != "" && $topic_object->topic_user != "" ? "<span style=\"font-size:13px;\">" . user_other("arab-forums", array($topic_object->u1user_id, $topic_object->u1user_group, $topic_object->u1user_name, $topic_object->u1user_lock, $topic_object->u1user_color, false)) . "</span><br><nobr>" . times_date("arab-forums", "", $topic_object->topic_date) . "</nobr>" : "") . "</td>";

        echo "<td class=\"topic\">" . ($topic_object->topic_lastdate != "" && $topic_object->topic_lastuser != "" ? "<span style=\"font-size:13px;\">" . user_other("arab-forums", array($topic_object->u2user_id, $topic_object->u2user_group, $topic_object->u2user_name, $topic_object->u2user_lock, $topic_object->u2user_color, false)) . "</span><br><nobr>" . times_date("arab-forums", "", $topic_object->topic_lastdate) . "</nobr>" : "") . "</td>";

        echo "<td class=\"topic\">" . num_other("arab-forums", $topic_object->topic_reply) . "</td>";

        echo "<td class=\"topic\">" . num_other("arab-forums", $topic_object->topic_visit) . "</td>";

        echo "<td class=\"topic\">" . a_other("arab-forums", "forum.php?id={$topic_object->forum_id}", "{$topic_object->forum_name}", "<span style=\"color:red;font-size:12px;\">{$topic_object->forum_name}</span>", "") . "</td>";

        echo "</tr>";
    }
} else {

    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"8\"><br><br>لا توجد مواضيع<br><br><br></td></tr>";
}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
