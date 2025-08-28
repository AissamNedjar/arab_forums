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

define("pagebody", "notify");

online_other("arab-forums", "notify", "0", "0", "0", "0");

if (go == "add") {

    if (fort == "topic") {

        $notify_sql = select_mysql("arab-forums", "topic", "t.topic_id , t.topic_forumid , t.topic_user , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_name , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_mode", "as t left join user" . prefix_connect . " as u on(u.user_id = t.topic_user) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where t.topic_id in(" . id . ") && t.topic_delete in(0) && t.topic_hid in(0) && t.topic_wait in(0) && t.topic_user != \"" . id_user . "\" limit 1");

        if (num_mysql("arab-forums", $notify_sql) == false) {

            $errorop = true;
        } else {

            $notify_object = object_mysql("arab-forums", $notify_sql);

            if (group_user == 0) {

                $errorop = true;
            } elseif ($notify_object->cat_hid == true && cathide_other("arab-forums", $notify_object->cat_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2) == false) {

                $errorop = true;
            } elseif ($notify_object->forum_hid1 == true && forumhide1_other("arab-forums", $notify_object->forum_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode) == false) {

                $errorop = true;
            } elseif ($notify_object->forum_hid2 == true && forumhide2_other("arab-forums", $notify_object->cat_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode) == false) {

                $errorop = true;
            } else {

                $texto = "لفت إنتباه المشرف عن الموضوع الخاص بـ : " . user_other("arab-forums", array($notify_object->user_id, $notify_object->user_group, $notify_object->user_nameuser, $notify_object->user_lock1, $notify_object->user_coloruser, false)) . "<br><br><span style=\"color:red;font-size:30px;\">{$notify_object->topic_name}</span>";

                $urluj = "notify.php?go=add&fort=topic&id={$notify_object->topic_id}";

                $msgtitle = "إضغط هنا للذهاب إلى الموضوع";

                $msgurl = "topic.php?id={$notify_object->topic_id}";

                $errorop = false;
            }
        }
    } elseif (fort == "reply") {

        $notify_sql = select_mysql("arab-forums", "reply", "r.reply_id , r.reply_topicid , r.reply_user , r.reply_delete , r.reply_wait , r.reply_hid , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , t.topic_id , t.topic_forumid , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_name , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_mode", "as r left join user" . prefix_connect . " as u on(u.user_id = r.reply_user) left join topic" . prefix_connect . " as t on(r.reply_topicid = t.topic_id) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where r.reply_id in(" . id . ") && r.reply_delete in(0) && r.reply_hid in(0) && r.reply_wait in(0) && t.topic_delete in(0) && t.topic_hid in(0) && t.topic_wait in(0) && r.reply_user != \"" . id_user . "\" limit 1");

        if (num_mysql("arab-forums", $notify_sql) == false) {

            $errorop = true;
        } else {

            $notify_object = object_mysql("arab-forums", $notify_sql);

            if ($notify_object->cat_hid == true && cathide_other("arab-forums", $notify_object->cat_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2) == false) {

                $errorop = true;
            } elseif ($notify_object->forum_hid1 == true && forumhide1_other("arab-forums", $notify_object->forum_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode) == false) {

                $errorop = true;
            } elseif ($notify_object->forum_hid2 == true && forumhide2_other("arab-forums", $notify_object->cat_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode) == false) {

                $errorop = true;
            } else {

                $texto = "لفت إنتباه المشرف عن المشاركة الخاصة بـ : " . user_other("arab-forums", array($notify_object->user_id, $notify_object->user_group, $notify_object->user_nameuser, $notify_object->user_lock1, $notify_object->user_coloruser, false)) . " في الموضوع التالي<br><br><span style=\"color:red;font-size:30px;\">{$notify_object->topic_name}</span>";

                $urluj = "notify.php?go=add&fort=reply&id={$notify_object->reply_id}";

                $msgtitle = "إضغط هنا للذهاب إلى الموضوع";

                $msgurl = "topic.php?id={$notify_object->topic_id}";

                $errorop = false;
            }
        }
    } else {

        $errorop = true;
    }

    if ($errorop == false) {

        if (type == "insert") {

            $notifyname = $notify_list[text_other("arab-forums", post_other("arab-forums", "notifyname"), true, true, true, true, true)];

            $notifytext = text_other("arab-forums", post_other("arab-forums", "notifytext"), false, true, false, false, true);

            if ($notifyname == "" || $notifytext == "") {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء ملأ جميع الحقول ليتم إرسال الشكوى",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                if (fort == "topic") {

                    $forumid = $notify_object->forum_id;

                    $topicid = $notify_object->topic_id;

                    $replyid = "0";

                    $msgid = "0";

                    $userid = $notify_object->topic_user;
                } elseif (fort == "reply") {

                    $forumid = $notify_object->forum_id;

                    $topicid = $notify_object->topic_id;

                    $replyid = $notify_object->reply_id;

                    $msgid = "0";

                    $userid = $notify_object->reply_user;
                }

                $notifytextsenf = br_other("arab-forums", $notifytext);

                insert_mysql("arab-forums", "notify", "notify_id , notify_forumid , notify_topicid , notify_replyid , notify_msgid , notify_userid , notify_usersend , notify_datesend , notify_name , notify_text , notify_type", "null , \"{$forumid}\" , \"{$topicid}\" , \"{$replyid}\" , \"{$msgid}\" , \"{$userid}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$notifyname}\" , \"{$notifytextsenf}\" , \"" . fort . "\"");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم إرسال الشكوى بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => $msgtitle,

                    "url" => $msgurl,

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            }
        } else {

            echo bodytop_template("arab-forums", "إرسال شكوى");

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            echo "<form action=\"{$urluj}&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

            echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">إرسال شكوى</div></td></tr>";

            echo "<tr align=\"center\"><td class=\"alttext2\"><br>{$texto}<br><br></td></tr>";

            echo "<tr align=\"center\">";

            echo "<td class=\"alttext1\"><br>";

            echo "لتسهيل المهم الرجاء تحديد نوع البلاغ من القائمة التالية<br><br>";

            echo "<select class=\"inputselect\" name=\"notifyname\">";

            foreach ($notify_list as $code => $name) {

                echo "<option value=\"{$code}\">{$name}</option>";
            }

            echo "</select><br><br></td>";

            echo "</tr>";

            echo "<tr align=\"center\">";

            echo "<td class=\"alttext1\" align=\"center\"><br><textarea name=\"notifytext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea><br><br></td>";

            echo "</tr>";

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إرسال الشكوى\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرسال الشكوى ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";

            echo "</table>";

            echo "</form>";

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    } else {

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
    }
} elseif (go == "showall") {

    if (fort == "forum") {

        $notify_sql = select_mysql("arab-forums", "forum", "c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_mode", "as f left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where f.forum_id in(" . id . ") limit 1");

        if (num_mysql("arab-forums", $notify_sql) == false) {

            $errorop = true;
        } else {

            $notify_object = object_mysql("arab-forums", $notify_sql);

            $moderatget1 = moderatget1_other("arab-forums", $notify_object->forum_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode);

            $moderatget2 = moderatget2_other("arab-forums", $notify_object->cat_monitor1, $notify_object->cat_monitor2);

            if ($moderatget1 == false) {

                $errorop = true;
            } else {

                $errorop = false;

                $titleget = "عرض شكاوي {$notify_object->forum_name}";

                $whereget = "n.notify_forumid in({$notify_object->forum_id})";

                $whereget2 = "notify_forumid in({$notify_object->forum_id})";

                $urlget = "notify.php?go=showall&fort=forum&id={$notify_object->forum_id}";
            }
        }
    } elseif (fort == "admin") {

        if (group_user != 6) {

            $errorop = true;
        } else {

            $errorop = false;

            $titleget = "عرض شكاوي الإدارة";

            $whereget = "n.notify_forumid in(0)";

            $whereget2 = "notify_forumid in(0)";

            $urlget = "notify.php?go=showall&fort=admin";
        }
    } else {

        $errorop = true;
    }

    if ($errorop == false) {

        echo bodytop_template("arab-forums", $titleget);

        $arrayheader = array(

            "login" => true,

        );

        echo header_template("arab-forums", $arrayheader);

        if (gert == "delete") {

            $namemenu = "عرض الشكاوي<br>الجديدة";

            $urlmenu = "{$urlget}";

            $pagemenu = "";

            $pagemenu2 = "{$urlget}&gert=delete";

            $titlemenu = "تعرض الشكاوي القديمة";

            $sql1menu = "notify_delete in(1) &&";

            $sql2menu = "n.notify_delete in(1) &&";
        } else {

            $namemenu = "عرض الشكاوي<br>القديمة";

            $urlmenu = "{$urlget}&gert=delete";

            $pagemenu = "&gert=delete";

            $pagemenu2 = "{$urlget}";

            $titlemenu = "تعرض الشكاوي الجديدة";

            $sql1menu = "notify_delete in(0) &&";

            $sql2menu = "n.notify_delete in(0) &&";
        }

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/warningto.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\">" . a_other("arab-forums", $pagemenu2, "{$titleget} - {$titlemenu}", "{$titleget} <span style=\"color:red;\">- {$titlemenu}</span>", "") . "</td>";

        echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", $urlmenu, $namemenu, $namemenu, "") . "</nobr></td>";

        $count_page = tother_option;

        $get_page = (page == "" || !is_numeric(page) ? 1 : page);

        $limit_page = (($get_page * $count_page) - $count_page);

        echo page_pager("arab-forums", "notify", "notify_id , notify_delete , notify_forumid", "where {$sql1menu} {$whereget2}", $count_page, $get_page, "{$urlget}{$pagemenu}&");

        echo list_forumcatlist("arab-forums");

        echo "</tr></table>";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

        echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"8\"><div class=\"pad\">{$titleget} - {$titlemenu}</div></td></tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcat\"><div class=\"pad\">الرقم</div></td>";

        echo "<td class=\"tcat\" align=\"right\" width=\"50%\"><div class=\"pad\">العنوان</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">نوع الشكوى</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">مرسل الشكوى</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">تاريخ الإرسل</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">تم الرد بواسطة</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">تاريخ الرد</div></td>";

        echo "</tr>";

        $notifylist_sql = select_mysql("arab-forums", "notify", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , n.notify_id , n.notify_forumid , n.notify_topicid , n.notify_replyid , n.notify_msgid , n.notify_type , n.notify_name , n.notify_usersend , n.notify_userlock , n.notify_datesend , n.notify_datelock , n.notify_delete", "as n left join user" . prefix_connect . " as u1 on(u1.user_id = n.notify_usersend) left join user" . prefix_connect . " as u2 on(u2.user_id = n.notify_userlock) where {$sql2menu} {$whereget} order by n.notify_datesend desc , n.notify_id asc limit {$limit_page},{$count_page}");

        if (num_mysql("arab-forums", $notifylist_sql) == false) {

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"8\"><br><br>لا توجد شكاوي بعد<br><br><br></td></tr>";
        } else {

            while ($notifylist_object = object_mysql("arab-forums", $notifylist_sql)) {

                if ($notifylist_object->notify_type == "topic") {
                    $typeo = "شكوى على موضوع";
                    $typep = "الخاصة بالموضوع رقم : {$notifylist_object->notify_topicid}";
                } elseif ($notifylist_object->notify_type == "reply") {
                    $typeo = "شكوى على رد";
                    $typep = "الخاصة بالرد رقم : {$notifylist_object->notify_replyid}";
                } elseif ($notifylist_object->notify_type == "msg") {
                    $typeo = "شكوى على رسالة";
                    $typep = "الخاصة بالرسالة رقم : {$notifylist_object->notify_msgid}";
                }

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\">{$notifylist_object->notify_id}</td>";

                echo "<td class=\"alttext2\" align=\"right\"><br><div class=\"pad\">" . a_other("arab-forums", "notify.php?go=showone&fort={$notifylist_object->notify_type}&id={$notifylist_object->notify_id}", "الشكوى رقم : {$notifylist_object->notify_id} | {$typep}", "الشكوى رقم : {$notifylist_object->notify_id} | {$typep}", "") . "<div class=\"desc\">{$notifylist_object->notify_name}</div></div><br></td>";

                echo "<td class=\"alttext1\"><nobr>{$typeo}</nobr></td>";

                echo "<td class=\"alttext2\"><nobr>" . user_other("arab-forums", array($notifylist_object->u1user_id, $notifylist_object->u1user_group, $notifylist_object->u1user_name, $notifylist_object->u1user_lock, $notifylist_object->u1user_color, false)) . "</nobr></td>";

                echo "<td class=\"alttext1\"><nobr>" . times_date("arab-forums", "", $notifylist_object->notify_datesend) . "</nobr></td>";

                echo "<td class=\"alttext2\"><nobr>" . ($notifylist_object->notify_delete == 0 ? "لم يتم الرد" : user_other("arab-forums", array($notifylist_object->u2user_id, $notifylist_object->u2user_group, $notifylist_object->u2user_name, $notifylist_object->u2user_lock, $notifylist_object->u2user_color, false))) . "</nobr></td>";

                echo "<td class=\"alttext1\"><nobr>" . ($notifylist_object->notify_delete == 0 ? "لم يتم الرد" : times_date("arab-forums", "", $notifylist_object->notify_datelock)) . "</nobr></td>";

                echo "</tr>";
            }
        }

        echo "</table>";

        echo footer_template("arab-forums");

        echo bodybottom_template("arab-forums");
    } else {

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
    }
} elseif (go == "showone") {

    if (fort == "topic") {

        $notify_sql = select_mysql("arab-forums", "notify", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , u3.user_id as u3user_id , u3.user_lock1 as u3user_lock , u3.user_nameuser as u3user_name , u3.user_group as u3user_group , u3.user_coloruser as u3user_color , n.notify_id , n.notify_forumid , n.notify_topicid , n.notify_userid , n.notify_reply , n.notify_userlock , n.notify_datelock , n.notify_replyid , n.notify_msgid , n.notify_type , n.notify_name , n.notify_text , n.notify_usersend , t.topic_id , t.topic_forumid , t.topic_name , n.notify_datesend , n.notify_delete , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_name , f.forum_catid , f.forum_mode", "as n left join user" . prefix_connect . " as u1 on(u1.user_id = n.notify_usersend) left join user" . prefix_connect . " as u2 on(u2.user_id = n.notify_userid) left join user" . prefix_connect . " as u3 on(u3.user_id = n.notify_userlock) left join topic" . prefix_connect . " as t on(t.topic_id = n.notify_topicid) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where n.notify_id in(" . id . ") limit 1");

        if (num_mysql("arab-forums", $notify_sql) == false) {

            $errorop = true;
        } else {

            $notify_object = object_mysql("arab-forums", $notify_sql);

            $moderatget1 = moderatget1_other("arab-forums", $notify_object->forum_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode);

            $moderatget2 = moderatget2_other("arab-forums", $notify_object->cat_monitor1, $notify_object->cat_monitor2);

            if ($moderatget1 == false) {

                $errorop = true;
            } else {

                $errorop = false;

                $title1 = "عرض الشكوى رقم : {$notify_object->notify_id} | الخاصة بالموضوع رقم : {$notify_object->topic_id}";

                $title2 = "لقد قام : " . user_other("arab-forums", array($notify_object->u1user_id, $notify_object->u1user_group, $notify_object->u1user_name, $notify_object->u1user_lock, $notify_object->u1user_color, false)) . " بإرسال شكوى على : " . user_other("arab-forums", array($notify_object->u2user_id, $notify_object->u2user_group, $notify_object->u2user_name, $notify_object->u2user_lock, $notify_object->u2user_color, false)) . " بكتابة الموضوع :<br><br>{$notify_object->topic_name}<br><br>لمشاهدة الموضوع " . a_other("arab-forums", "topic.php?id={$notify_object->topic_id}", "إضغط هنا", "إضغط هنا", "") . "<br><br><div class=\"desc\">{$notify_object->notify_name}</div><br><hr><br>نص الشكوى :<br><br><hr><br>{$notify_object->notify_text}";
            }
        }
    } elseif (fort == "reply") {

        $notify_sql = select_mysql("arab-forums", "notify", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , u3.user_id as u3user_id , u3.user_lock1 as u3user_lock , u3.user_nameuser as u3user_name , u3.user_group as u3user_group , u3.user_coloruser as u3user_color , n.notify_id , n.notify_forumid , n.notify_topicid , n.notify_userid , n.notify_reply , n.notify_userlock , n.notify_datelock , n.notify_replyid , n.notify_msgid , n.notify_type , n.notify_name , n.notify_text , n.notify_usersend , r.reply_id , r.reply_topicid , t.topic_id , t.topic_forumid , t.topic_name , n.notify_datesend , n.notify_delete , c.cat_id , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_name , f.forum_catid , f.forum_mode", "as n left join user" . prefix_connect . " as u1 on(u1.user_id = n.notify_usersend) left join user" . prefix_connect . " as u2 on(u2.user_id = n.notify_userid) left join user" . prefix_connect . " as u3 on(u3.user_id = n.notify_userlock) left join reply" . prefix_connect . " as r on(r.reply_id = n.notify_replyid) left join topic" . prefix_connect . " as t on(t.topic_id = r.reply_topicid) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where n.notify_id in(" . id . ") limit 1");

        if (num_mysql("arab-forums", $notify_sql) == false) {

            $errorop = true;
        } else {

            $notify_object = object_mysql("arab-forums", $notify_sql);

            $moderatget1 = moderatget1_other("arab-forums", $notify_object->forum_id, $notify_object->cat_monitor1, $notify_object->cat_monitor2, $notify_object->forum_mode);

            $moderatget2 = moderatget2_other("arab-forums", $notify_object->cat_monitor1, $notify_object->cat_monitor2);

            if ($moderatget1 == false) {

                $errorop = true;
            } else {

                $errorop = false;

                $title1 = "عرض الشكوى رقم : {$notify_object->notify_id} | الخاصة الرد رقم : {$notify_object->reply_id}";

                $title2 = "لقد قام : " . user_other("arab-forums", array($notify_object->u1user_id, $notify_object->u1user_group, $notify_object->u1user_name, $notify_object->u1user_lock, $notify_object->u1user_color, false)) . " بإرسال شكوى على : " . user_other("arab-forums", array($notify_object->u2user_id, $notify_object->u2user_group, $notify_object->u2user_name, $notify_object->u2user_lock, $notify_object->u2user_color, false)) . " بالمشاركة في موضوع :<br><br>{$notify_object->topic_name}<br><br>لمشاهدة المشاركة " . a_other("arab-forums", "topic.php?id={$notify_object->topic_id}&type=reply&value={$notify_object->reply_id}", "إضغط هنا", "إضغط هنا", "") . "<br><br><div class=\"desc\">{$notify_object->notify_name}</div><br><hr><br>نص الشكوى :<br><br><hr><br>{$notify_object->notify_text}";
            }
        }
    } else {

        $errorop = true;
    }

    if ($errorop == false) {

        if (type == "insert") {

            $notifytext = text_other("arab-forums", post_other("arab-forums", "notifytext"), false, true, false, false, true);

            if ($notifytext == "") {

                $msgerror = "الرجاء ملأ جميع الحقول ليتم الرد على الشكوى";
            } elseif ($notify_object->notify_delete == 1) {

                $msgerror = "لا يمكنك الرد على شكوى تم الرد عليها من قبل";
            } else {

                $msgerror = "";
            }

            if ($msgerror != "") {

                $arraymsg = array(

                    "login" => true,

                    "msg" => $msgerror,

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                $notifytextsenf = br_other("arab-forums", $notifytext);

                update_mysql("arab-forums", "notify", "notify_delete = \"1\" , notify_reply = \"{$notifytextsenf}\" , notify_datelock = \"" . time() . "\" , notify_userlock = \"" . id_user . "\" where notify_id in({$notify_object->notify_id}) limit 1");

                $textopp = "رد على ملاحظتك لإشراف {$notify_object->forum_name}";

                $editor = text_other("arab-forums", "<br><br>السلام عليكم و رحمة الله و براكته<br><br>بخصوص ملاحظتك التالية الى إشراف : {$notify_object->forum_name}<br><br><hr><br>{$notify_object->notify_name}<br><br><hr><br>لقد تم متابعة الملاحظة بواسطة فريق الإشراف و التالي نص الرد عليك :<br><br><hr><br>{$notifytextsenf}<br><br><br>", false, true, false, false, true);

                insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$notify_object->u1user_id}\", \"{$notify_object->u1user_id}\" , \"-{$notify_object->forum_id}\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$textopp}\" , \"{$editor}\"");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم الرد على الشكوى و إغلاقها بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            }
        } else {

            echo bodytop_template("arab-forums", "عرض شكوى");

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            if ($notify_object->notify_delete == 0) {

                echo "<form action=\"notify.php?go=showone&fort=" . fort . "&id={$notify_object->notify_id}&type=insert\" method=\"post\">";
            }

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

            echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">{$title1}</div></td></tr>";

            echo "<tr align=\"center\"><td class=\"alttext2\"><br><div class=\"pad\">{$title2}</div><br></td></tr>";

            if ($notify_object->notify_delete == 0) {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\"><br><div class=\"pad\">ملاحظة : أنت الذي تقرأ الشكوى إن لم تستطع فهم ماتحتويه أو لا يعنيك الأمر الرجاء منك ترك الشكوى للرتبة الأعلى منك ليتم التصرف</div><br></td>";

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">الرد على الشكوى</div></td></tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\" align=\"center\"><br><textarea name=\"notifytext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea><br><br></td>";

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إرسال الرد و إغلاق الشكوى\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الرد على الشكوى و إغلاقها ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";
            } else {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\"><br><div class=\"pad\">هذه الشكوى تم الرد عليها و تم غلقها بواسطة : <br><br>" . user_other("arab-forums", array($notify_object->u3user_id, $notify_object->u3user_group, $notify_object->u3user_name, $notify_object->u3user_lock, $notify_object->u3user_color, false)) . " | بتاريخ : " . times_date("arab-forums", "", $notify_object->notify_datelock) . "</div><br></td>";

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">نص الرد على الشكوى</div></td></tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\"><br><div class=\"pad\">{$notify_object->notify_reply}</div><br></td>";

                echo "</tr>";
            }

            echo "</table>";

            if ($notify_object->notify_delete == 0) {

                echo "</form>";
            }

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    } else {

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
    }
} else {

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
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
