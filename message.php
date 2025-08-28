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

define("pagebody", "message");

online_other("arab-forums", "message", "0", "0", "0", "0");

if (group_user == 0) {

    $arraymsg = array(

        "login" => true,

        "msg" => "للأسف خاصية الرسائل متوفرة للأعضاء المسجلين فقط",

        "color" => "error",

        "old" => true,

        "auto" => false,

        "text" => "",

        "url" => "",

        "array" => "",

    );

    echo msg_template("arab-forums", $arraymsg);
} else {

    if (go == "new") {

        if (sendmy == 0) {

            if (group_user == 6) {

                $errormpm = "";

                $titlepmy = "الإدارة العامة للمنتديات";
            } else {

                $errormpm = "لا يمكنك إرسال رسالة خاصة ببريد الإدارة";

                $titlepmy = "";
            }
        } elseif (sendmy < 0) {

            $forum_sql = select_mysql("arab-forums", "forum", "c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_mode", "as f left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where f.forum_id in(" . abs(sendmy) . ") limit 1");

            if (num_mysql("arab-forums", $forum_sql) == false) {

                $errormpm = "لا يمكنك إرسال رسالة خاصة ببريد هذا المنتدى";

                $titlepmy = "";
            } else {

                $forum_object = object_mysql("arab-forums", $forum_sql);

                $moderatget1 = moderatget1_other("arab-forums", $forum_object->forum_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2, $forum_object->forum_mode);

                $moderatget2 = moderatget2_other("arab-forums", $forum_object->cat_monitor1, $forum_object->cat_monitor2);

                if ($moderatget1 == false) {

                    $errormpm = "لا يمكنك إرسال رسالة خاصة ببريد هذا المنتدى";

                    $titlepmy = "";
                } else {

                    $errormpm = "";

                    $titlepmy = "إشراف {$forum_object->forum_name}";
                }
            }
        } else {

            if (sendmy == id_user) {

                $errormpm = "";

                $titlepmy = name_user;
            } else {

                $errormpm = "لا يمكنك إرسال رسالة خاصة بعضوية أخرى";

                $titlepmy = "";
            }
        }


        if (sendto == 0) {

            $errormpk = "";

            $titlepto = "الإدارة العامة للمنتديات";
        } elseif (sendto < 0) {

            if (allowedin3_other("arab-forums", abs(sendto), 3) != false) {

                $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name", "where forum_id in(" . abs(sendto) . ") limit 1");

                $forum_object = object_mysql("arab-forums", $forum_sql);

                $errormpk = "";

                $titlepto = "إشراف {$forum_object->forum_name}";
            } else {

                $errormpk = "لا يمكنك إرسال رسالة خاصة إلى إشراف هذا المنتدى";

                $titlepto = "";
            }
        } else {

            $user_sql = select_mysql("arab-forums", "user", "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex , user_lock1", "where user_id in(" . sendto . ") && user_wait in(0) && user_active in(0) && user_bad in(0) && user_lock1 in(0) limit 1");

            if (num_mysql("arab-forums", $user_sql) != false) {

                $user_object = object_mysql("arab-forums", $user_sql);

                $errormpk = "";

                $titlepto = "{$user_object->user_nameuser}";
            } else {

                $errormpk = "لا يمكنك إرسال رسالة خاصة لهذه العضوية لأنها مغلوقة أو تنتظر الموافقة";

                $titlepto = "";
            }
        }

        $totalmsgnew = num_mysql("arab-forums", select_mysql("arab-forums", "message", "message_id , message_getid , message_type , message_date", "where message_getid in(" . sendmy . ") && message_type in(1) && message_date > \"" . (time() - (60 * 60 * 24)) . "\""));

        if (totalmessages_option >= post_user && group_user == 1 && sendmy > 0) {

            $errormpu = "يجب أن يكون عدد مشاركاتك أكثر من " . totalmessages_option . " لتستطيع مراسلة الأعضاء";
        } elseif ($totalmsgnew >= messagedays_option && group_user == 1 && sendmy > 0) {

            $errormpu = "تجاوزت الحد المسموح من الرسائل لك اليوم";
        } else {

            $errormpu = "";
        }

        if ($errormpm != "") {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إرسال رسالة جديدة و السبب <br><br>{$errormpm}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } elseif ($errormpk != "") {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إرسال رسالة جديدة و السبب <br><br>{$errormpk}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } elseif ($errormpu != "") {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إرسال رسالة جديدة و السبب <br><br>{$errormpu}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            if (editor == "true") {

                if (get_cookie("arab-forums", "refererkj") != "") {
                    $referer = get_cookie("arab-forums", "refererkj");
                } else {
                    $referer = referer;
                }

                $postmessage = post_other("arab-forums", "message");

                $editor_title = text_other("arab-forums", post_other("arab-forums", "title"), true, true, true, false, true);

                $editor_sizetext = text_other("arab-forums", $postmessage, true, true, true, true, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", $postmessage), false, true, false, false, true);

                if (mb_strlen($editor_title) < 5 || mb_strlen($editor_title) > 300) {

                    $erroreditor = "العنوان يجب أن يكون أطول من 5 حروف و أقل من 300 حرف";
                } elseif (mb_strlen($editor_sizetext) < 3) {

                    $erroreditor = "محتوى النص قصير جدا";
                } else {

                    $erroreditor = "";
                }

                if ($erroreditor == "") {

                    insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"" . sendmy . "\", \"" . sendto . "\" , \"" . sendmy . "\" , \"" . id_user . "\" , \"-1\" , \"2\" , \"1\" , \"" . time() . "\" , \"{$editor_title}\" , \"{$editor_message}\"");

                    insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"" . sendto . "\", \"" . sendto . "\" , \"" . sendmy . "\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$editor_title}\" , \"{$editor_message}\"");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم إرسال الرسالة بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => true,

                        "text" => "",

                        "url" => $referer,

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك إرسال رسالة جديدة و السبب <br><br>{$erroreditor}",

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

                set_cookie("arab-forums", "refererkj", referer, 0);

                echo bodytop_template("arab-forums", "إرسال رسالة جديدة");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                if (sendto > 0 && sendmy > 0) {

                    if (quote == 1) {

                        $quote_sql = select_mysql("arab-forums", "topic", "t.topic_id , t.topic_user , t.topic_forumid , t.topic_message , t.topic_name , t.topic_url , t.topic_img , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_urlshowtopic , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_mode , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as t left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) left join user" . prefix_connect . " as u on(t.topic_user = u.user_id) where t.topic_id in(" . codesql2_other("arab-forums", qtopic, 3) . ") limit 1");

                        if (num_mysql("arab-forums", $quote_sql) != false) {

                            $quote_object = object_mysql("arab-forums", $quote_sql);

                            $totalreplyu = num_mysql("arab-forums", select_mysql("arab-forums", "reply", "reply_topicid , reply_date , reply_user , reply_wait , reply_delete", "where reply_user in(" . id_user . ") && reply_topicid in({$quote_object->topic_id}) && reply_wait in(0) && reply_delete in(0)"));

                            $message_quote = quote_other("arab-forums", user_other("arab-forums", array($quote_object->user_id, $quote_object->user_group, $quote_object->user_nameuser, $quote_object->user_lock1, $quote_object->user_coloruser, false)), "topic.php?id={$topic_object->topic_id}", urlimghids_other("arab-forums", messagereplase_other("arab-forums", $quote_object->topic_message, $quote_object->topic_forumid), $quote_object->topic_url, $quote_object->topic_img, $quote_object->forum_urlshowtopic, $totalreplyu, moderatget1_other("arab-forums", $quote_object->forum_id, $quote_object->cat_monitor1, $quote_object->cat_monitor2, $quote_object->forum_mode), $quote_object->topic_user));

                            $titley = "رسالة بخصوص موضوعك : {$quote_object->topic_name}";

                            $yuhuhh = "&quote=1&qtopic=" . codesql1_other("arab-forums", $quote_object->topic_id, 3) . "";
                        } else {

                            $message_quote = "";

                            $titley = "رسالة من {$titlepmy} إلى {$titlepto}";

                            $yuhuhh = "";
                        }
                    } elseif (quote == 2) {

                        $quote_sql = select_mysql("arab-forums", "reply", "r.reply_id , r.reply_topicid , r.reply_user , r.reply_message , r.reply_url , r.reply_img , t.topic_id , t.topic_forumid , t.topic_name , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_urlshowreply , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_mode , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as r left join topic" . prefix_connect . " as t on(r.reply_topicid = t.topic_id) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) left join user" . prefix_connect . " as u on(r.reply_user = u.user_id) where r.reply_id in(" . codesql2_other("arab-forums", qreply, 4) . ") limit 1");

                        if (num_mysql("arab-forums", $quote_sql) != false) {

                            $quote_object = object_mysql("arab-forums", $quote_sql);

                            $totalreplyu = num_mysql("arab-forums", select_mysql("arab-forums", "reply", "reply_topicid , reply_date , reply_user , reply_wait , reply_delete", "where reply_user in(" . id_user . ") && reply_topicid in({$quote_object->topic_id}) && reply_wait in(0) && reply_delete in(0)"));

                            $message_quote = quote_other("arab-forums", user_other("arab-forums", array($quote_object->user_id, $quote_object->user_group, $quote_object->user_nameuser, $quote_object->user_lock1, $quote_object->user_coloruser, false)), "topic.php?id={$quote_object->reply_topicid}&type=reply&value={$quote_object->reply_id}", urlimghids_other("arab-forums", messagereplase_other("arab-forums", $quote_object->reply_message, $quote_object->topic_forumid), $quote_object->reply_url, $quote_object->reply_img, $quote_object->forum_urlshowreply, $totalreplyu, moderatget1_other("arab-forums", $quote_object->forum_id, $quote_object->cat_monitor1, $quote_object->cat_monitor2, $quote_object->forum_mode), $quote_object->reply_user));

                            $titley = "رسالة بخصوص ردك في موضوع : {$quote_object->topic_name}";

                            $yuhuhh = "&quote=2&qreply=" . codesql1_other("arab-forums", $quote_object->reply_id, 4) . "";
                        } else {

                            $message_quote = "";

                            $titley = "رسالة من {$titlepmy} إلى {$titlepto}";

                            $yuhuhh = "";
                        }
                    } else {

                        $message_quote = "";

                        $titley = "رسالة من {$titlepmy} إلى {$titlepto}";

                        $yuhuhh = "";
                    }
                } else {

                    $message_quote = "";

                    $titley = "رسالة من {$titlepmy} إلى {$titlepto}";

                    $yuhuhh = "";
                }

                $arrayeditor = array(

                    "mode" => false,

                    "appc" => 0,

                    "mose" => "",

                    "forum" => true,

                    "admin" => false,

                    "img" => img_other("arab-forums", "images/messageread.png", "", "50", "50", "0", "", ""),

                    "opr" => a_other("arab-forums", "", "إرسال رسالة جديدة", "إرسال رسالة جديدة", ""),

                    "trother" => "رسالة من {$titlepmy} إلى {$titlepto}",

                    "text" => "إرسال رسالة جديدة",

                    "url" => "message.php?go=new&sendmy=" . sendmy . "&sendto=" . sendto . "{$yuhuhh}&",

                    "message" => $message_quote,

                    "type" => "sendmsg",

                    "title" => $titley,

                    "other" => "عدد الرسائل<br>الجديدة المتبقية<br>لك لهذا اليوم<br>هو : <span style=\"color:red;\">" . (group_user > 0 ? "غير محدود" : (messagedays_option - $totalmsgnew)) . "</span>",

                );

                echo editor_template("arab-forums", $arrayeditor);

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        }
    } elseif (go == "read") {

        $message_sql = select_mysql("arab-forums", "message", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , u3.user_id as u3user_id , u3.user_lock1 as u3user_lock , u3.user_nameuser as u3user_name , u3.user_group as u3user_group , u3.user_coloruser as u3user_color , m.message_id , m.message_getid , m.message_delete , m.message_getmy , m.message_getto , m.message_getto2 , m.message_folder , m.message_type , m.message_reade , m.message_reply , m.message_name , m.message_date , m.message_message , f1.forum_id as f1forum_id , f1.forum_name as f1forum_name , f2.forum_id as f2forum_id , f2.forum_name as f2forum_name , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f3.forum_id as f3forum_id , f3.forum_catid as f3forum_catid , f3.forum_hid1 as f3forum_hid1 , f3.forum_hid2 as f3forum_hid2 , f3.forum_name as f3forum_name , f3.forum_mode as f3forum_mode", "as m left join user" . prefix_connect . " as u1 on(u1.user_id = m.message_getmy) left join user" . prefix_connect . " as u2 on(u2.user_id = m.message_getto) left join user" . prefix_connect . " as u3 on(u3.user_id = m.message_getto2) left join forum" . prefix_connect . " as f1 on(f1.forum_id = abs(m.message_getmy)) left join forum" . prefix_connect . " as f2 on(f2.forum_id = abs(m.message_getto)) left join forum" . prefix_connect . " as f3 on(f3.forum_id = abs(m.message_getid)) left join cat" . prefix_connect . " as c on(f3.forum_catid = c.cat_id) where m.message_id in(" . id . ") group by m.message_id limit 1");

        if (num_mysql("arab-forums", $message_sql) == false) {

            $error = "رقم الرسالة خاطئ";
        } else {

            $message_object = object_mysql("arab-forums", $message_sql);

            $moderatget1 = moderatget1_other("arab-forums", $message_object->f3forum_id, $message_object->cat_monitor1, $message_object->cat_monitor2, $message_object->f3forum_mode);

            $moderatget2 = moderatget2_other("arab-forums", $message_object->cat_monitor1, $message_object->cat_monitor2);

            if ($message_object->message_getid == 0 && group_user != 6) {

                $error = "الرسالة تابعة للإدارة";
            } elseif ($message_object->message_getid > 0 && $message_object->message_getid != id_user && group_user != 6) {

                $error = "الرسالة تابعة لعضوية أخرى";
            } elseif ($message_object->message_getid < 0 && $moderatget1 == false) {

                $error = "الرسالة تابعة لمنتدى ليست تحت إشرافك";
            } else {

                $error = "";
            }
        }

        if ($message_object->message_getid > 0 && $message_object->message_getid != id_user) {

            $noreply = true;
        } else {

            $noreply = false;
        }

        if ($error == "") {

            if (type == "reply") {

                $totalmsgnew = num_mysql("arab-forums", select_mysql("arab-forums", "message", "message_id , message_getid , message_type , message_date", "where message_getid in({$message_object->message_getid}) && message_type in(1) && message_date > \"" . (time() - (60 * 60 * 24)) . "\""));

                if (totalmessages_option >= post_user && group_user == 1 && $message_object->message_getto > 0) {

                    $errorio = "يجب أن يكون عدد مشاركاتك أكثر من " . totalmessages_option . " لتستطيع مراسلة الأعضاء";
                } elseif ($totalmsgnew >= messagedays_option && group_user == 1 && $message_object->message_getto > 0) {

                    $errorio = "تجاوزت الحد المسموح من الرسائل لك اليوم";
                } elseif ($message_object->message_type != 1) {

                    $errorio = "الرسالة موجودة بالبريد الصادر";
                } elseif ($noreply == true) {

                    $errorio = "الرسالة تابعة لعضوية أخرى";
                } else {

                    $errorio = "";
                }

                if ($errorio == "") {

                    if (editor == "true") {

                        if (get_cookie("arab-forums", "refererm") != "") {
                            $referer = get_cookie("arab-forums", "refererm");
                        } else {
                            $referer = referer;
                        }

                        $howde = text_other("arab-forums", post_other("arab-forums", "howde"), true, true, true, true, true);

                        if ($howde == "speed") {

                            $postmessage = br_other("arab-forums", post_other("arab-forums", "message"));

                            $editor_title = $message_object->message_name;
                        } else {

                            $postmessage = post_other("arab-forums", "message");

                            $editor_title = text_other("arab-forums", post_other("arab-forums", "title"), true, true, true, false, true);
                        }

                        $editor_sizetext = text_other("arab-forums", $postmessage, true, true, true, true, true);

                        $editor_message = text_other("arab-forums", htmltext_other("arab-forums", $postmessage), false, true, false, false, true);

                        if (mb_strlen($editor_title) < 5 || mb_strlen($editor_title) > 300) {

                            $erroreditor = "العنوان يجب أن يكون أطول من 5 حروف و أقل من 300 حرف";
                        } elseif (mb_strlen($editor_sizetext) < 3) {

                            $erroreditor = "محتوى النص قصير جدا";
                        } else {

                            $erroreditor = "";
                        }

                        if ($erroreditor == "") {

                            insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$message_object->message_getmy}\", \"{$message_object->message_getto}\" , \"{$message_object->message_getmy}\" , \"" . id_user . "\" , \"-1\" , \"2\" , \"1\" , \"" . time() . "\" , \"{$editor_title}\" , \"{$editor_message}\"");

                            insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$message_object->message_getto}\", \"{$message_object->message_getto}\" , \"{$message_object->message_getmy}\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$editor_title}\" , \"{$editor_message}\"");

                            $arraymsg = array(

                                "login" => true,

                                "msg" => "تم إرسال الرد على الرسالة بنجآح تام",

                                "color" => "good",

                                "old" => true,

                                "auto" => true,

                                "text" => "",

                                "url" => $referer,

                                "array" => "",

                            );

                            echo msg_template("arab-forums", $arraymsg);
                        } else {

                            $arraymsg = array(

                                "login" => true,

                                "msg" => "لا يمكنك إرسال الرد على الرسالة و السبب <br><br>{$erroreditor}",

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

                        set_cookie("arab-forums", "refererm", referer, 0);

                        echo bodytop_template("arab-forums", "رد على رسالة");

                        $arrayheader = array(

                            "login" => true,

                        );

                        echo header_template("arab-forums", $arrayheader);

                        $arrayeditor = array(

                            "mode" => false,

                            "appc" => 0,

                            "mose" => "",

                            "forum" => true,

                            "admin" => false,

                            "img" => img_other("arab-forums", "images/messageread.png", "", "50", "50", "0", "", ""),

                            "opr" => a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}&type=reply", "رد على رسالة", "رد على رسالة", ""),

                            "trother" => a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}", "الرسالة : {$message_object->message_name}", "الرسالة : {$message_object->message_name}", ""),

                            "text" => "رد على رسالة",

                            "url" => "message.php?go=read&id={$message_object->message_id}&type=reply&",

                            "message" => "",

                            "type" => "replymsg",

                            "title" => $message_object->message_name,

                            "other" => "عدد الرسائل<br>الجديدة المتبقية<br>لك لهذا اليوم<br>هو : <span style=\"color:red;\">" . (group_user > 0 ? "غير محدود" : (messagedays_option - $totalmsgnew)) . "</span>",

                        );

                        echo editor_template("arab-forums", $arrayeditor);

                        echo footer_template("arab-forums");

                        echo bodybottom_template("arab-forums");
                    }
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك الرد على الرسالة و السبب <br><br>{$errorio}",

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

                if ($message_object->message_getid == 0) {

                    $update = true;
                } elseif ($message_object->message_getid < 0) {

                    $update = true;
                } else {

                    if ($message_object->message_getid == id_user) {

                        $update = true;
                    } else {

                        $update = false;
                    }
                }

                if ($update == true && $message_object->message_type == 1) {

                    update_mysql("arab-forums", "message", "	message_reade = \"1\" where message_id = \"{$message_object->message_id}\"");
                }

                echo bodytop_template("arab-forums", "قراءة رسالة");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                if ($message_object->message_getmy == 0) {

                    $moi = "الإدارة العامة للمنتديات";
                } elseif ($message_object->message_getmy > 0) {

                    $moi = user_other("arab-forums", array($message_object->u1user_id, $message_object->u1user_group, $message_object->u1user_name, $message_object->u1user_lock, $message_object->u1user_color, false));
                } else {

                    $moi = a_other("arab-forums", "forum.php?id={$message_object->f1forum_id}", "إشراف {$message_object->f1forum_name}", "إشراف {$message_object->f1forum_name}", "");
                }

                if ($message_object->message_getto == 0) {

                    $toi = "الإدارة العامة للمنتديات<br><br>" . user_other("arab-forums", array($message_object->u3user_id, $message_object->u3user_group, $message_object->u3user_name, $message_object->u3user_lock, $message_object->u3user_color, false));
                } elseif ($message_object->message_getto > 0) {

                    $toi = user_other("arab-forums", array($message_object->u2user_id, $message_object->u2user_group, $message_object->u2user_name, $message_object->u2user_lock, $message_object->u2user_color, false));
                } else {

                    $toi = a_other("arab-forums", "forum.php?id={$message_object->f2forum_id}", "إشراف {$message_object->f2forum_name}", "إشراف {$message_object->f2forum_name}", "") . "<br><br>" . user_other("arab-forums", array($message_object->u3user_id, $message_object->u3user_group, $message_object->u3user_name, $message_object->u3user_lock, $message_object->u3user_color, false));
                }

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                echo "<td>" . img_other("arab-forums", "images/messageread.png", "", "", "", "0", "", "") . "</td>";

                echo "<td width=\"100%\">" . a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}", "قراءة رسالة", "قراءة رسالة", "") . "</td>";

                echo list_forumcatlist("arab-forums");

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" style=\"font-size:17px;\" colspan=\"2\" align=\"center\"><div class=\"pad\">" . a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}", "{$message_object->message_name}", "{$message_object->message_name}", "") . "</div></td></tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"15%\"><div class=\"pad\">المرسل : </div></td>";

                echo "<td class=\"alttext2\"><div class=\"pad\">{$toi}</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"15%\"><div class=\"pad\">المستقبل : </div></td>";

                echo "<td class=\"alttext2\"><div class=\"pad\">{$moi}</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"15%\"><div class=\"pad\">التاريخ : </div></td>";

                echo "<td class=\"alttext2\"><div class=\"pad\"><nobr>" . times_date("arab-forums", "", $message_object->message_date) . "</nobr></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\" valign=\"top\"><div class=\"pad\">";

                echo "<table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

                echo messagereplase_other("arab-forums", $message_object->message_message, 0);

                echo "</div></td></tr></table>";

                echo "</td></tr>";

                if ($message_object->message_type == 1 && $noreply == false) {

                    echo "<form method=\"post\" action=\"message.php?go=read&id={$message_object->message_id}&type=reply&editor=true\"><input type=\"hidden\" name=\"howde\" value=\"speed\">";

                    echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"2\"><div class=\"pad\">رد سريع على الرسالة</div></td></tr>";

                    echo "<tr align=\"center\"><td class=\"ttopityr\" colspan=\"2\"><textarea class=\"textarea\" name=\"message\" style=\"width:97%;height:200;font-weight:" . editorblod_user . ";text-align:" . editoralign_user . ";font-family:" . editorfont_user . ";font-size:" . editorsize_user . ";color:" . editorcolor_user . "\" rows=\"6\"></textarea></td></tr>";

                    echo "<tr><td class=\"ttopityr\" colspan=\"2\" align=\"center\"><div class=\"pad\">";

                    echo "<input type=\"submit\" class=\"button\" value=\"إرسال الرد\"";

                    echo "</div></td></tr>";

                    echo "</form>";
                }

                echo "</table>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك الدخول إلى الرسالة و السبب <br><br>{$error}",

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

        if (msgf != "" && is_numeric(msgf)) {

            $messagert = "f";
        } elseif (msgu != "" && is_numeric(msgu)) {

            $messagert = "t";
        } elseif (admin != "") {

            $messagert = "a";
        } else {

            $messagert = "m";
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

            if (group_user == 6) {

                $error_user = true;
            } else {

                $error_user = false;
            }
        }

        if ($messagert == "f" && $error_forum == true) {

            $titlem = "الرسائل الخاصة بــ {$forum_object->forum_name}";

            $getm = "-{$forum_object->forum_id}";

            $url1 = "message.php?msgf={$forum_object->forum_id}";

            $url2 = "message.php?msgf={$forum_object->forum_id}&";

            $url3 = "pmlist.php?msgf={$forum_object->forum_id}";
        } elseif ($messagert == "t" && msgu != id_user && $error_user == true) {

            $titlem = "الرسائل الخاصة بــ {$user_object->user_nameuser}";

            $getm = "{$user_object->user_id}";

            $url1 = "message.php?msgu={$user_object->user_id}";

            $url2 = "message.php?msgu={$user_object->user_id}&";

            $url3 = "pmlist.php?msgu={$user_object->user_id}";
        } elseif ($messagert == "a" && group_user == 6) {

            $titlem = "الرسائل الخاصة بإدارة المنتديات";

            $getm = "0";

            $url1 = "message.php?admin=true";

            $url2 = "message.php?admin=true&";

            $url3 = "pmlist.php?admin=true";
        } else {

            $titlem = "الرسائل الخاصة بك";

            $getm = id_user;

            $url1 = "message.php";

            $url2 = "message.php?";

            $url3 = "pmlist.php";
        }

        if (gert == "new" && $messagert != "t") {

            echo bodytop_template("arab-forums", $titlem);

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            echo "<td>" . img_other("arab-forums", "images/message.png", "", "", "", "0", "", "") . "</td>";

            echo "<td width=\"100%\">" . a_other("arab-forums", $url1, $titlem, $titlem, "") . "<div class=\"pad\"><span style=\"color:red;font-size:12px;\">إرسال رسالة جديدة</span></div></td>";

            echo list_forumcatlist("arab-forums");

            echo "</tr></table>";

            echo "<form action=\"{$url2}gert=new&search=true\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

            echo "<tr align=\"center\">";

            echo "<td class=\"tcat\"><div class=\"pad\">إرسال رسالة جديدة</div></td>";

            echo "</tr>";

            $serachmsg = text_other("arab-forums", post_other("arab-forums", "serachmsg"), true, true, true, true, true);

            echo "<tr align=\"center\">";

            echo "<td class=\"alttext1\"><div class=\"pad\">";

            echo "<br><br>قم وضع إسم العضوية المراد مراسلتها و إضغط على كلمة بحث<br><br><input style=\"width:200px\" class=\"input\" name=\"serachmsg\" value=\"{$serachmsg}\" type=\"text\"><br><br><input type=\"submit\" class=\"button\" name=\"insert\" value=\"إبحث\"><br><br><br>";

            echo "</div></td>";

            echo "</tr>";

            if (search == "true" && $serachmsg != "") {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\"><div class=\"pad\"><br><br>";

                echo "<table cellpadding=\"0\" cellspacing=\"5\" align=\"center\"><tr>";

                $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_active , user_lock1 , user_wait , user_bad", "where user_active in(0) && user_lock1 in(0) && user_wait in(0) && user_bad in(0) && user_nameuser like \"%{$serachmsg}%\" order by user_nameuser desc");

                if (num_mysql("arab-forums", $user_sql) != false) {

                    $userrr = 0;

                    while ($user_object = object_mysql("arab-forums", $user_sql)) {

                        if ($userrr == 8) {
                            echo "</tr><tr>";
                            $userrr = 0;
                        }

                        echo "<td><table cellpadding=\"7\" cellspacing=\"3\"><tr><td class=\"stats\"><nobr>" . a_other("arab-forums", "message.php?go=new&sendmy={$getm}&sendto={$user_object->user_id}", "مراسلة : {$user_object->user_nameuser}", "مراسلة : {$user_object->user_nameuser}", "") . "</nobr></td></tr></table></td>";

                        $userrr++;
                    }
                } else {

                    echo "<td>لم يتم العثور عما يطابق بحثك الرجاء التوجه إلى صفحة الأعضاء و البحث من جديد</td>";
                }

                echo "</tr></table><br><br></div></td>";

                echo "</tr>";
            } else {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\"><div class=\"pad\"><br><br>";

                echo "أو قم بمراسلة إدارة المنتديات<br><br><table cellpadding=\"0\" cellspacing=\"5\" align=\"center\"><tr>";

                echo "<td><table cellpadding=\"7\" cellspacing=\"3\"><tr><td class=\"stats\"><nobr>" . a_other("arab-forums", "message.php?go=new&sendmy={$getm}&sendto=0", "مراسلة : إدارة المنتديات", "مراسلة : إدارة المنتديات", "") . "</nobr></td></tr></table></td>";

                echo "</tr></table><br><br></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\"><div class=\"pad\"><br><br>";

                echo "أو قم بمراسلة إشراف منتدى من القائمة التالية<br><br><table cellpadding=\"0\" cellspacing=\"5\" align=\"center\"><tr>";

                $cat_sql = select_mysql("arab-forums", "cat", "cat_id , cat_hid , cat_order , cat_monitor1 , cat_monitor2 , cat_group" . group_user . "", "where cat_group" . group_user . " in(1) order by cat_order asc");

                if (num_mysql("arab-forums", $cat_sql) != false) {

                    $forummm = 0;

                    while ($cat_object = object_mysql("arab-forums", $cat_sql)) {

                        if ($cat_object->cat_hid == false || ($cat_object->cat_hid == true && cathide_other("arab-forums", $cat_object->cat_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2) == true)) {

                            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_catid , forum_hid1 , forum_hid2 , forum_name , forum_order , forum_group" . group_user . " , forum_mode", "where forum_catid in({$cat_object->cat_id}) && forum_group" . group_user . " in(1) order by forum_order asc");

                            if (num_mysql("arab-forums", $forum_sql) != false) {

                                while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                                    if ($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums", $forum_object->forum_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2, $forum_object->forum_mode) == true)) {

                                        if ($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums", $cat_object->cat_id, $cat_object->cat_monitor1, $cat_object->cat_monitor2, $forum_object->forum_mode) == true)) {

                                            if ($forummm == 5) {
                                                echo "</tr><tr>";
                                                $forummm = 0;
                                            }

                                            echo "<td><table cellpadding=\"7\" cellspacing=\"3\"><tr><td class=\"stats\"><nobr>" . a_other("arab-forums", "message.php?go=new&sendmy={$getm}&sendto=-{$forum_object->forum_id}", "مراسلة : إشراف {$forum_object->forum_name}", "مراسلة : إشراف {$forum_object->forum_name}", "") . "</nobr></td></tr></table></td>";

                                            $forummm++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo "</tr></table><br><br></div></td>";

                echo "</tr>";
            }

            echo "</table>";

            echo "</form>";

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        } else {

            $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

            $default  = text_other("arab-forums", post_other("arab-forums", "default"), false, false, false, false, false);

            $delete  = text_other("arab-forums", post_other("arab-forums", "delete"), false, false, false, false, false);

            $folderst  = text_other("arab-forums", post_other("arab-forums", "folderst"), false, false, false, false, false);

            $folderid  = text_other("arab-forums", post_other("arab-forums", "folderid"), true, true, true, true, false);

            $import = @implode(",", $allyu);

            if (isset($delete)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء تحديد رسالة واحدة على الأقل ليتم نقلها لمجلد المحذوفات",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    update_mysql("arab-forums", "message", "message_delete = \"1\" where message_id in({$import})");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم نقل الرسائل المحددة إلى مجلد المحذوفات بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                }
            } elseif (isset($default)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء تحديد رسالة واحدة على الأقل ليتم نقلها لمجلدها الأصلي",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    update_mysql("arab-forums", "message", "message_delete = \"0\" where message_id in({$import})");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم نقل الرسائل المحددة إلى مجلدها الأصلي بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                }
            } elseif (isset($folderst)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء تحديد رسالة واحدة على الأقل ليتم نقلها للمجلد المختار",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    update_mysql("arab-forums", "message", "message_folder = \"{$folderid}\" where message_id in({$import})");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم نقل الرسائل المحددة إلى المجلد المختار بنجآح تام",

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

                if (is_numeric(folder)) {

                    $folder_sql = select_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "where pmlist_user in({$getm}) && pmlist_folder in(" . folder . ") limit 1");
                }

                if (folder == "new") {

                    $folderty = "&& m.message_folder in(-1)";

                    $foldertv = "&& message_folder in(-1)";

                    $foldertu = "المجلد العام";

                    $foldeytr = "new";

                    $no1delete = "&& m.message_delete in(0)";

                    $no2delete = "&& message_delete in(0)";
                } elseif (is_numeric(folder) && num_mysql("arab-forums", $folder_sql) != false) {

                    $folder_object = object_mysql("arab-forums", $folder_sql);

                    $folderty = "&& m.message_folder in({$folder_object->pmlist_folder})";

                    $foldertv = "&& message_folder in({$folder_object->pmlist_folder})";

                    $foldertu = "{$folder_object->pmlist_name}";

                    $foldeytr = "{$folder_object->pmlist_folder}";

                    $no1delete = "&& m.message_delete in(0)";

                    $no2delete = "&& message_delete in(0)";
                } elseif (folder == "delete") {

                    $folderty = "";

                    $foldertv = "";

                    $foldertu = "مجلد المحذوفات";

                    $foldeytr = "delete";

                    $no1delete = "&& m.message_delete in(1)";

                    $no2delete = "&& message_delete in(1)";
                } else {

                    $folderty = "&& m.message_folder in(-1)";

                    $foldertv = "&& message_folder in(-1)";

                    $foldertu = "المجلد العام";

                    $foldeytr = "new";

                    $no1delete = "&& m.message_delete in(0)";

                    $no2delete = "&& message_delete in(0)";
                }

                if (fort == "in") {

                    $folderte = "1";

                    $foldertr = "الرسائل الواردة";

                    $foldeyto = "in";
                } elseif (fort == "out") {

                    $folderte = "2";

                    $foldertr = "الرسائل الصادرة";

                    $foldeyto = "out";
                } else {

                    $folderte = "1";

                    $foldertr = "الرسائل الواردة";

                    $foldeyto = "in";
                }

                echo bodytop_template("arab-forums", $titlem);

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                $count_page = tother_option;

                $get_page = (page == "" || !is_numeric(page) ? 1 : page);

                $limit_page = (($get_page * $count_page) - $count_page);

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                echo "<td>" . img_other("arab-forums", "images/message.png", "", "", "", "0", "", "") . "</td>";

                echo "<td width=\"100%\">" . a_other("arab-forums", $url1, $titlem, $titlem, "") . "<div class=\"pad\"><span style=\"color:red;font-size:12px;\">{$foldertu} - {$foldertr}</span></div></td>";

                if ($messagert != "t") {

                    echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "{$url2}gert=new", "إرسال رسالة جديدة", img_other("arab-forums", "images/newmsg.png", "", "", "", "0", "", "") . "<br>إرسال رسالة جديدة", "") . "</nobr></td>";
                }

                echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", $url3, "المجلدات البريدية", img_other("arab-forums", "images/folderpm.png", "", "", "", "0", "", "") . "<br>المجلدات البريدية", "") . "</nobr></td>";

                echo page_pager("arab-forums", "message", "message_id , message_getid , message_delete , message_getmy , message_getto , message_getto2 , message_folder , message_type", "where message_getid in({$getm}) {$foldertv} && message_type in({$folderte}) {$no2delete}", $count_page, $get_page, "{$url2}folder={$foldeytr}&fort={$foldeyto}&");

                echo list_forumcatlist("arab-forums");

                echo "</tr></table>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                echo "<td class=\"" . ($foldeytr == "new" && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=new&fort=in", "المجلد العام", "المجلد العام", "") . "</div></nobr></td>";

                echo "<td class=\"" . ($foldeytr == "new" && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=new&fort=in", "البريد الوارد في المجلد العام", img_other("arab-forums", "images/messageright.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                echo "<td class=\"" . ($foldeytr == "new" && $foldeyto == "out" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=new&fort=out", "البريد الصادر في المجلد العام", img_other("arab-forums", "images/messageleft.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                echo "<td>&nbsp;</td>";

                echo "<td class=\"" . ($foldeytr == "delete" && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=delete&fort=in", "مجلد المحذوفات", "مجلد المحذوفات", "") . "</div></nobr></td>";

                echo "<td class=\"" . ($foldeytr == "delete" && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=delete&fort=in", "البريد الوارد في مجلد المحذوفات", img_other("arab-forums", "images/messageright.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                echo "<td class=\"" . ($foldeytr == "delete" && $foldeyto == "out" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder=delete&fort=out", "البريد الصادر في مجلد المحذوفات", img_other("arab-forums", "images/messageleft.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";

                $textoption = "";

                if ($foldeytr != "new") {

                    $textoption .= "<option value=\"-1\">المجلد العام</option>";
                }

                $pmlist_sql = select_mysql("arab-forums", "pmlist", "pmlist_id , pmlist_user , pmlist_folder , pmlist_name", "where pmlist_user in({$getm}) && pmlist_name != \"\"");

                if (num_mysql("arab-forums", $pmlist_sql) != false) {

                    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                    while ($pmlist_object = object_mysql("arab-forums", $pmlist_sql)) {

                        if ($foldeytr != $pmlist_object->pmlist_folder) {

                            $textoption .= "<option value=\"{$pmlist_object->pmlist_folder}\">{$pmlist_object->pmlist_name}</option>";
                        }

                        echo "<td class=\"" . ($foldeytr == $pmlist_object->pmlist_folder && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder={$pmlist_object->pmlist_folder}&fort=in", "{$pmlist_object->pmlist_name}", "{$pmlist_object->pmlist_name}", "") . "</div></nobr></td>";

                        echo "<td class=\"" . ($foldeytr == $pmlist_object->pmlist_folder && $foldeyto == "in" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder={$pmlist_object->pmlist_folder}&fort=in", "البريد الوارد في {$pmlist_object->pmlist_name}", img_other("arab-forums", "images/messageright.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                        echo "<td class=\"" . ($foldeytr == $pmlist_object->pmlist_folder && $foldeyto == "out" ? "topiclink2" : "topiclink1") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "{$url2}folder={$pmlist_object->pmlist_folder}&fort=out", "البريد الصادر في {$pmlist_object->pmlist_name}", img_other("arab-forums", "images/messageleft.png", "", "", "", "0", "", ""), "") . "</div></nobr></td>";

                        echo "<td>&nbsp;</td>";
                    }

                    echo "<td width=\"100%\"></td>";

                    echo "</tr></table>";
                }

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                if ($textoption != "" && $foldeytr != "delete") {

                    echo "<td><select class=\"inputselect\" name=\"folderid\">{$textoption}</select></td>";

                    echo "<td><nobr><input class=\"button\" value=\"نقل الرسائل المحددة إلى المجلد المختار\" type=\"submit\" name=\"folderst\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد نقل الرسائل المحددة إلى المجلد المختار ؟") . "></nobr></td>";
                }

                if (folder == "delete") {

                    echo "<td><nobr><input class=\"button\" value=\"نقل الرسائل المحددة إلى المجلد الأصلي\" type=\"submit\" name=\"default\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد نقل الرسائل المحددة إلى المجلد الأصلي ؟") . "></nobr></td>";
                } else {

                    echo "<td><nobr><input class=\"button\" value=\"نقل الرسائل المحددة إلى مجلد المحذوفات\" type=\"submit\" name=\"delete\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد نقل الرسائل المحددة إلى مجلد المحذوفات ؟") . "></nobr></td>";
                }

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

                echo "<tr align=\"center\">";

                $inputtext = array(

                    1 => "تحديد جميع الرسائل",

                    2 => "إلغاء تحديد جميع الرسائل",

                    3 => "لا يوجد رسائل بالصفحة حاليا",

                    4 => "عدد الرسائل الذي إخترت هو :",

                    5 => "الرسالة",

                );

                echo "<td class=\"tcat\" width=\"1%\"><div class=\"pad\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></div></td>";

                echo "<td class=\"tcat\" width=\"45%\"><div class=\"pad\">الرسالة</div></td>";

                echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">المرسل</div></td>";

                echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">المستقبل</div></td>";

                echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">التاريخ</div></td>";

                if (folder != "delete" && $foldeyto == "in" && $messagert != "t") {

                    echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">خيارات</div></td>";
                }

                echo "</tr>";

                $message_sql = select_mysql("arab-forums", "message", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , u3.user_id as u3user_id , u3.user_lock1 as u3user_lock , u3.user_nameuser as u3user_name , u3.user_group as u3user_group , u3.user_coloruser as u3user_color , m.message_id , m.message_getid , m.message_delete , m.message_getmy , m.message_getto , m.message_getto2 , m.message_folder , m.message_type , m.message_reade , m.message_reply , m.message_name , m.message_date , m.message_message , f1.forum_id as f1forum_id , f1.forum_name as f1forum_name , f2.forum_id as f2forum_id , f2.forum_name as f2forum_name", "as m left join user" . prefix_connect . " as u1 on(u1.user_id = m.message_getmy) left join user" . prefix_connect . " as u2 on(u2.user_id = m.message_getto) left join user" . prefix_connect . " as u3 on(u3.user_id = m.message_getto2) left join forum" . prefix_connect . " as f1 on(f1.forum_id = abs(m.message_getmy)) left join forum" . prefix_connect . " as f2 on(f2.forum_id = abs(m.message_getto)) where m.message_getid in({$getm}) {$folderty} && m.message_type in({$folderte}) {$no1delete} group by m.message_id order by m.message_reade asc , m.message_date desc limit {$limit_page},{$count_page}");

                if (num_mysql("arab-forums", $message_sql) != false) {

                    while ($message_object = object_mysql("arab-forums", $message_sql)) {

                        if ($message_object->message_reade == 0) {

                            $classp = "topics";
                        } else {

                            $classp = "topicn";
                        }

                        if ($message_object->message_getmy == 0) {

                            $moi = "الإدارة العامة للمنتديات";
                        } elseif ($message_object->message_getmy > 0) {

                            $moi = user_other("arab-forums", array($message_object->u1user_id, $message_object->u1user_group, $message_object->u1user_name, $message_object->u1user_lock, $message_object->u1user_color, false));
                        } else {

                            $moi = a_other("arab-forums", "forum.php?id={$message_object->f1forum_id}", "إشراف {$message_object->f1forum_name}", "إشراف {$message_object->f1forum_name}", "");
                        }

                        if ($message_object->message_getto == 0) {

                            $toi = "الإدارة العامة للمنتديات<br><br>" . user_other("arab-forums", array($message_object->u3user_id, $message_object->u3user_group, $message_object->u3user_name, $message_object->u3user_lock, $message_object->u3user_color, false));
                        } elseif ($message_object->message_getto > 0) {

                            $toi = user_other("arab-forums", array($message_object->u2user_id, $message_object->u2user_group, $message_object->u2user_name, $message_object->u2user_lock, $message_object->u2user_color, false));
                        } else {

                            $toi = a_other("arab-forums", "forum.php?id={$message_object->f2forum_id}", "إشراف {$message_object->f2forum_name}", "إشراف {$message_object->f2forum_name}", "") . "<br><br>" . user_other("arab-forums", array($message_object->u3user_id, $message_object->u3user_group, $message_object->u3user_name, $message_object->u3user_lock, $message_object->u3user_color, false));
                        }

                        echo "<tr align=\"center\" class=\"topice {$classp}\" id=\"tr_{$message_object->message_id}\">";

                        echo "<td class=\"topic\"><input onclick=\"check1(this, '{$message_object->message_id}' , 'topice {$classp}' , 'الرسالة' , 'topice select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الرسالة\" value=\"{$message_object->message_id}\"><input type=\"hidden\" name=\"bg_{$message_object->message_id}\" id=\"bg_{$message_object->message_id}\" value=\"topice {$classp}\"></td>";

                        echo "<td class=\"topic\" align=\"right\"><table cellpadding=\"3\" cellspacing=\"1\"><tr>";

                        echo "<td>" . a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}", "", img_other("arab-forums", "images/plus.gif", "", "", "", "0", "", ""), "target=\"_blank\"") . "</td>";

                        if ($message_object->message_reply == 1) {

                            echo "<td>" . img_other("arab-forums", "images/messagereply.png", "هذه الرسالة تم الرد عليها", "", "", "0", "class=\"title\"", "") . "</td>";
                        }

                        echo "<td width=\"100%\">" . a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}", "{$message_object->message_name}", "{$message_object->message_name}", "") . "</td>";

                        echo "</tr></table></td>";

                        echo "<td class=\"topic\"><nobr>{$toi}</nobr></td>";

                        echo "<td class=\"topic\"><nobr>{$moi}</nobr></td>";

                        echo "<td class=\"topic\"><nobr>" . times_date("arab-forums", "", $message_object->message_date) . "</nobr></td>";

                        if (folder != "delete" && $foldeyto == "in" && $messagert != "t") {

                            echo "<td class=\"topic\"><table><tr>";

                            echo "<td>" . a_other("arab-forums", "message.php?go=read&id={$message_object->message_id}&type=reply", "الرد على الرسالة", img_other("arab-forums", "images/replymsg.png", "", "", "", "0", "", ""), "") . "</td>";

                            echo "</tr></table></td>";
                        }

                        echo "</tr>";
                    }
                } else {

                    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"8\"><br><br>لا توجد رسائل في هذا المجلد حاليا<br><br><br></td></tr>";
                }

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        }
    }
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
