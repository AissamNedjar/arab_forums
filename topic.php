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

$topic_sql = select_mysql("arab-forums", "topic", "i.iconstopic_id , i.iconstopic_name , i.iconstopic_images , i.iconstopic_forumid , x.texttopic_id , x.texttopic_name , x.texttopic_forumid , t.topic_id , t.topic_survey , t.topic_forumid , t.topic_user , t.topic_wait , t.topic_delete , t.topic_lock , t.topic_hid , t.topic_stiky , t.topic_top , t.topic_text , t.topic_icons , t.topic_name , t.topic_message , t.topic_date , t.topic_img , t.topic_url , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_sex , u.user_post , u.user_photo , u.user_point , u.user_coloruser , u.user_colorstar , u.user_country , u.user_dateregister , u.user_titleold , u.user_sig , c.cat_id , c.cat_lock , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , c.cat_group" . group_user . " , f.forum_name , f.forum_logo , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_totalreply , f.forum_visitortopicshow , f.forum_visitorreplyshow , f.forum_urlshowtopic , f.forum_urlshowreply , f.forum_sex , f.forum_group" . group_user . " , f.forum_mode , f.forum_phototopic , f.forum_sigtopic , f.forum_detailtopic , f.forum_wasaftopic , f.forum_photoreply , f.forum_sigreply , f.forum_detailreply , f.forum_wasafreply , c.cat_post1 , c.cat_post2 , c.cat_post3 , c.cat_post4 , c.cat_post5 , c.cat_post6 , f.forum_post1 , f.forum_post2 , f.forum_post3 , f.forum_post4 , f.forum_post5 , f.forum_post6 , f.forum_moderatreply", "as t left join iconstopic" . prefix_connect . " as i on(i.iconstopic_id = t.topic_icons) left join texttopic" . prefix_connect . " as x on(x.texttopic_id = t.topic_text) left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) left join user" . prefix_connect . " as u on(t.topic_user = u.user_id) where t.topic_id in(" . id . ") && c.cat_group" . group_user . " in(1) && f.forum_group" . group_user . " in(1) limit 1");

if (num_mysql("arab-forums", $topic_sql) == false) {

    $errorop = "رقم الموضوع خاطئ";
} else {

    $topic_object = object_mysql("arab-forums", $topic_sql);

    if ($topic_object->cat_hid == true && cathide_other("arab-forums", $topic_object->cat_id, $topic_object->cat_monitor1, $topic_object->cat_monitor2) == false) {

        $errorop = "الموضوع تابع لفئة مخفية";
    } elseif ($topic_object->forum_hid1 == true && forumhide1_other("arab-forums", $topic_object->forum_id, $topic_object->cat_monitor1, $topic_object->cat_monitor2, $topic_object->forum_mode) == false) {

        $errorop = "الموضوع تابع لمنتدى مخفي";
    } elseif ($topic_object->forum_hid2 == true && forumhide2_other("arab-forums", $topic_object->cat_id, $topic_object->cat_monitor1, $topic_object->cat_monitor2, $topic_object->forum_mode) == false) {

        $errorop = "الموضوع تابع لمنتدى مخفي";
    } else {

        $moderatget1 = moderatget1_other("arab-forums", $topic_object->forum_id, $topic_object->cat_monitor1, $topic_object->cat_monitor2, $topic_object->forum_mode);

        $moderatget2 = moderatget2_other("arab-forums", $topic_object->cat_monitor1, $topic_object->cat_monitor2);

        $totalreplyu = num_mysql("arab-forums", select_mysql("arab-forums", "reply", "reply_topicid , reply_date , reply_user , reply_wait , reply_delete", "where reply_user in(" . id_user . ") && reply_topicid in({$topic_object->topic_id}) && reply_wait in(0) && reply_delete in(0)"));

        if ($topic_object->topic_wait == 1 && $moderatget1 == false && $topic_object->topic_user != id_user) {

            $errorop = "الموضوع ينتظر الموافقة";
        } elseif ($topic_object->topic_hid == 1 && $moderatget1 == false && $topic_object->topic_user != id_user && num_mysql("arab-forums", select_mysql("arab-forums", "hidtopic", "hidtopic_userid , hidtopic_topicid", "where hidtopic_userid in(" . id_user . ") && hidtopic_topicid in({$topic_object->topic_id}) limit 1")) == false) {

            $errorop = "الموضوع مخفي";
        } elseif ($topic_object->topic_delete == 1 && $moderatget2 == false) {

            $errorop = "الموضوع محذوف";
        } else {

            $errorop = "";
        }
    }
}

if ($errorop == "") {

    if (go == "edittopic") {

        define("pagebody", "edittopic");

        online_other("arab-forums", "edittopic", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        if (group_user == 0) {

            $errorop = "تعديل المواضيع للأعضاء المسجلين فقط";
        } elseif ($topic_object->cat_lock == 1 && $moderatget1 == false) {

            $errorop = "الفئة مغلوقة";
        } elseif ($topic_object->forum_lock == 1 && $moderatget1 == false) {

            $errorop = "المنتدى مغلوق";
        } elseif ($topic_object->topic_user != id_user && $moderatget1 == false) {

            $errorop = "الموضوع غير خاص بك";
        } elseif ($topic_object->topic_wait == 1 && $moderatget1 == false) {

            $errorop = "الموضوع ينتظر الموافقة";
        } elseif ($topic_object->topic_lock == 1 && $moderatget1 == false) {

            $errorop = "الموضوع مغلوق";
        } else {

            $errorop = "";
        }

        if ($errorop == "") {

            if (editor == "true") {

                $editor_sizetext = text_other("arab-forums", post_other("arab-forums", "message"), true, true, true, true, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", post_other("arab-forums", "message")), false, true, false, false, true);

                $editor_edit = text_other("arab-forums", htmltext_other("arab-forums", $topic_object->topic_message), false, true, false, false, true);

                $editor_title = text_other("arab-forums", post_other("arab-forums", "title"), true, true, true, false, true);

                if (mb_strlen($editor_title) < 5 || mb_strlen($editor_title) > 300) {

                    $erroreditor = "العنوان يجب أن يكون أطول من 5 حروف و أقل من 300 حرف";
                } elseif (mb_strlen($editor_sizetext) < 3) {

                    $erroreditor = "محتوى النص قصير جدا";
                } else {

                    $erroreditor = "";
                }

                if ($erroreditor == "") {

                    if ($moderatget1 == true) {

                        $lock = text_other("arab-forums", post_other("arab-forums", "lock"), true, true, true, true, true);

                        $hid = text_other("arab-forums", post_other("arab-forums", "hid"), true, true, true, true, true);

                        $stiky = text_other("arab-forums", post_other("arab-forums", "stiky"), true, true, true, true, true);

                        $top = text_other("arab-forums", post_other("arab-forums", "top"), true, true, true, true, true);

                        if ($lock != $topic_object->topic_lock) {

                            if ($lock == 1) {
                                $insert1 = "lock";
                            } else {
                                $insert1 = "nolock";
                            }

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$insert1}\"");
                        }

                        if ($hid != $topic_object->topic_hid) {

                            if ($hid == 1) {
                                $insert2 = "hid";
                            } else {
                                $insert2 = "nohid";
                            }

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$insert2}\"");
                        }

                        if ($stiky != $topic_object->topic_stiky) {

                            if ($stiky == 1) {
                                $insert3 = "stiky";
                            } else {
                                $insert3 = "nostiky";
                            }

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$insert3}\"");
                        }

                        if ($top != $topic_object->topic_top) {

                            if ($top == 0) {
                                $insert4 = "top0";
                            } elseif ($top == 1) {
                                $insert4 = "top1";
                            } elseif ($top == 2) {
                                $insert4 = "top2";
                            }

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$insert4}\"");
                        }

                        $mofr = ", topic_lock = \"{$lock}\" , topic_hid = \"{$hid}\" , topic_stiky = \"{$stiky}\" , topic_top = \"{$top}\"";
                    } else {

                        $mofr = "";
                    }

                    insert_mysql("arab-forums", "edittopic", "edittopic_id , edittopic_topicid , edittopic_user , edittopic_date , edittopic_name , edittopic_message", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$topic_object->topic_name}\" , \"{$editor_edit}\"");

                    update_mysql("arab-forums", "topic", "topic_name = \"{$editor_title}\" , topic_message = \"{$editor_message}\" {$mofr} where topic_id in({$topic_object->topic_id})");

                    insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"edit\"");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تعديل الموضوع بنجاح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => true,

                        "text" => "أنقر هنا للذهاب إلى الموضوع",

                        "url" => "topic.php?id={$topic_object->topic_id}",

                        "array" => array("أنقر هنا للذهاب إلى المنتدى", "forum.php?id={$topic_object->forum_id}", "أنقر هنا للذهاب إلى الصفحة الرئيسية", "home.php"),

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك تعديل الموضوع و السبب <br><br>{$erroreditor}",

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

                echo bodytop_template("arab-forums", $topic_object->topic_name . " | تعديل الموضوع");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                $arrayeditor = array(

                    "mode" => $moderatget1,

                    "appc" => 1,

                    "mose" => array($topic_object->topic_lock, $topic_object->topic_hid, $topic_object->topic_stiky, $topic_object->topic_top),

                    "forum" => true,

                    "admin" => false,

                    "img" => img_other("arab-forums", "{$topic_object->forum_logo}", "", "50", "50", "0", "", ""),

                    "opr" => a_other("arab-forums", "forum.php?id={$topic_object->forum_id}", "{$topic_object->forum_name} - تعديل موضوع", "{$topic_object->forum_name} - تعديل موضوع", ""),

                    "trother" => "",

                    "text" => "تعديل موضوع",

                    "url" => "topic.php?id={$topic_object->topic_id}&go=edittopic&",

                    "message" => messagereplase_other("arab-forums", $topic_object->topic_message, $topic_object->forum_id),

                    "type" => "edittopic",

                    "title" => $topic_object->topic_name,

                    "other" => "",

                );

                echo editor_template("arab-forums", $arrayeditor);

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك تعديل هذا الموضوع و السبب <br><br>{$errorop}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "newreply") {

        define("pagebody", "newreply");

        online_other("arab-forums", "newreply", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        $catpost = array("0", $topic_object->cat_post1, $topic_object->cat_post2, $topic_object->cat_post3, $topic_object->cat_post4, $topic_object->cat_post5, $topic_object->cat_post6);

        $forumpost = array("0", $topic_object->forum_post1, $topic_object->forum_post2, $topic_object->forum_post3, $topic_object->forum_post4, $topic_object->forum_post5, $topic_object->forum_post6);

        $totalreplynew = num_mysql("arab-forums", select_mysql("arab-forums", "reply", "r.reply_topicid , r.reply_date , r.reply_user , t.topic_id , t.topic_forumid", "as r left join topic" . prefix_connect . " as t on(t.topic_id = r.reply_topicid && t.topic_forumid in({$topic_object->forum_id})) where r.reply_user in(" . id_user . ") && r.reply_date > \"" . (time() - (60 * 60 * 24)) . "\""));

        if (group_user == 0) {

            $errorop = "المشاركة للأعضاء المسجلين فقط";
        } elseif ($topic_object->cat_lock == 1 && $moderatget1 == false) {

            $errorop = "الفئة مغلوقة";
        } elseif ($topic_object->forum_lock == 1 && $moderatget1 == false) {

            $errorop = "المنتدى مغلوق";
        } elseif ($catpost[group_user] == 0 && $moderatget1 == false) {

            $errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذه الفئة";
        } elseif ($forumpost[group_user] == 0 && $moderatget1 == false) {

            $errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذا المنتدى";
        } elseif ($topic_object->forum_sex == 1 && sex_user == 2 && $moderatget1 == false) {

            $errorop = "المشاركة للذكور فقط";
        } elseif ($topic_object->forum_sex == 2 && sex_user == 1 && $moderatget1 == false) {

            $errorop = "المشاركة للإيناث فقط";
        } elseif ($topic_object->topic_wait == 1 && $moderatget1 == false) {

            $errorop = "الموضوع ينتظر الموافقة";
        } elseif ($topic_object->topic_lock == 1 && $moderatget1 == false && num_mysql("arab-forums", select_mysql("arab-forums", "locktopic", "locktopic_userid , locktopic_topicid", "where locktopic_userid in(" . id_user . ") && locktopic_topicid in({$topic_object->topic_id}) limit 1")) == false) {

            $errorop = "الموضوع مغلوق";
        } elseif ($totalreplynew >= $topic_object->forum_totalreply && $moderatget1 == false) {

            $errorop = "تجاوزت الحد المسموح من الردود لك اليوم";
        } else {

            $errorop = "";
        }

        if ($errorop == "") {

            if (editor == "true") {

                if (get_cookie("arab-forums", "referer") != "") {
                    $referer = get_cookie("arab-forums", "referer");
                } else {
                    $referer = referer;
                }

                $howde = text_other("arab-forums", post_other("arab-forums", "howde"), true, true, true, true, true);

                if ($howde == "speed") {

                    $postmessage = br_other("arab-forums", post_other("arab-forums", "message"));
                } else {

                    $postmessage = post_other("arab-forums", "message");
                }

                $editor_sizetext = text_other("arab-forums", $postmessage, true, true, true, true, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", $postmessage), false, true, false, false, true);

                if (mb_strlen($editor_sizetext) < 3) {

                    $erroreditor = "محتوى النص قصير جدا";
                } elseif (datelastpost_user >= (time() - 3)) {

                    $erroreditor = "محاولة إدخال عدة ردود في نفس الوقت";
                } else {

                    $erroreditor = "";
                }

                set_cookie("arab-forums", "referer", "", 0);

                if ($erroreditor == "") {

                    if (totalpost_option >= post_user && $moderatget1 == false) {

                        $getwait = true;
                    } elseif ($topic_object->forum_moderatreply == 1 && $moderatget1 == false) {

                        $getwait = true;
                    } else {

                        $getwait = false;
                    }

                    if ($getwait == true) {

                        $waitinsert = "1";

                        $msginsert = "تم إدخال الرد بنجاح تام لآكن يحتاج موافقة الإشراف";
                    } else {

                        $waitinsert = "0";

                        $msginsert = "تم إدخال الرد بنجاح تام";
                    }

                    if ($moderatget1 == true) {

                        $option = text_other("arab-forums", post_other("arab-forums", "option"), true, true, true, true, true);

                        if ($option == "wait" && $topic_object->topic_wait == 1) {

                            $typei = "wait";

                            $types = "topic_wait = \"0\"";

                            $typet = "+ الموافقة على الموضوع بنجآح تام";
                        } elseif ($option == "lock" && $topic_object->topic_lock == 0) {

                            $typei = "lock";

                            $types = "topic_lock = \"1\"";

                            $typet = "+ غلق الموضوع بنجآح تام";
                        } elseif ($option == "nolock" && $topic_object->topic_lock == 1) {

                            $typei = "nolock";

                            $types = "topic_lock = \"0\"";

                            $typet = "+ فتح الموضوع بنجآح تام";
                        } elseif ($option == "hid" && $topic_object->topic_hid == 0) {

                            $typei = "hid";

                            $types = "topic_hid = \"1\"";

                            $typet = "+ إخفاء الموضوع بنجآح تام";
                        } elseif ($option == "nohid" && $topic_object->topic_hid == 1) {

                            $typei = "nohid";

                            $types = "topic_hid = \"0\"";

                            $typet = "+ إظهار الموضوع بنجآح تام";
                        } elseif ($option == "stiky" && $topic_object->topic_stiky == 0) {

                            $typei = "stiky";

                            $types = "topic_stiky = \"1\"";

                            $typet = "+ تثيث الموضوع بنجآح تام";
                        } elseif ($option == "nostiky" && $topic_object->topic_stiky == 1) {

                            $typei = "nostiky";

                            $types = "topic_stiky = \"0\"";

                            $typet = "+ إزالة تثبيث الموضوع بنجآح تام";
                        } else {

                            $typei = "";

                            $types = "";

                            $typet = "";
                        }



                        if ($typei != "") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$typei}\"");

                            $mofr = ", {$types}";
                        } else {

                            $mofr = "";
                        }
                    }

                    insert_mysql("arab-forums", "reply", "reply_id , reply_topicid , reply_wait , reply_date , reply_user , reply_message", "null , \"{$topic_object->topic_id}\" , \"{$waitinsert}\" , \"" . time() . "\" , \"" . id_user . "\" , \"{$editor_message}\"");

                    $insert = mysql_insert_id();

                    update_mysql("arab-forums", "forum", "forum_reply = forum_reply+1 , forum_lastdate = \"" . time() . "\" , forum_lastuser = \"" . id_user . "\" where forum_id in({$topic_object->forum_id})");

                    update_mysql("arab-forums", "topic", "topic_reply = topic_reply+1 , topic_lastdate = \"" . time() . "\" , topic_lastuser = \"" . id_user . "\" {$mofr} where topic_id in({$topic_object->topic_id})");

                    update_mysql("arab-forums", "user", "user_post = user_post+1 , user_posts = user_posts+1 , user_datelastpost = \"" . time() . "\" where user_id in(" . id_user . ")");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $msginsert . " " . ($typei == "" ? "> شكرا لك على المشاركة معانا" : "{$typet} > شكرا لك على المشاركة معانا") . "",

                        "color" => "good",

                        "old" => true,

                        "auto" => true,

                        "text" => "",

                        "url" => $referer,

                        "array" => array("أنقر هنا للذهاب إلى الموضوع", "topic.php?id={$topic_object->topic_id}", "أنقر هنا للذهاب إلى المنتدى", "forum.php?id={$topic_object->forum_id}", "أنقر هنا للذهاب إلى الصفحة الرئيسية", "home.php"),

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك إدخال الرد و السبب <br><br>{$erroreditor}",

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

                set_cookie("arab-forums", "referer", referer, 0);

                echo bodytop_template("arab-forums", $topic_object->topic_name . " | رد جديد");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                if (quote == 1) {

                    $quote_sql = select_mysql("arab-forums", "topic", "t.topic_id , t.topic_user , t.topic_message , t.topic_url , t.topic_img , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as t left join user" . prefix_connect . " as u on(t.topic_user = u.user_id) where t.topic_id in(" . codesql2_other("arab-forums", qtopic, 1) . ") limit 1");

                    if (num_mysql("arab-forums", $quote_sql) != false) {

                        $quote_object = object_mysql("arab-forums", $quote_sql);

                        if ($topic_object->topic_id == $quote_object->topic_id) {

                            $message_quote = quote_other("arab-forums", user_other("arab-forums", array($quote_object->user_id, $quote_object->user_group, $quote_object->user_nameuser, $quote_object->user_lock1, $quote_object->user_coloruser, false)), "topic.php?id={$topic_object->topic_id}", urlimghids_other("arab-forums", messagereplase_other("arab-forums", $quote_object->topic_message, $topic_object->forum_id), $quote_object->topic_url, $quote_object->topic_img, $topic_object->forum_urlshowtopic, $totalreplyu, $moderatget1, $topic_object->topic_user));
                        } else {

                            $message_quote = "";
                        }
                    } else {

                        $message_quote = "";
                    }
                } elseif (quote == 2) {

                    $quote_sql = select_mysql("arab-forums", "reply", "r.reply_id , r.reply_topicid , r.reply_user , r.reply_url , r.reply_img , r.reply_message , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as r left join user" . prefix_connect . " as u on(r.reply_user = u.user_id) where r.reply_id in(" . codesql2_other("arab-forums", qreply, 2) . ") limit 1");

                    if (num_mysql("arab-forums", $quote_sql) != false) {

                        $quote_object = object_mysql("arab-forums", $quote_sql);

                        if ($topic_object->topic_id == $quote_object->reply_topicid) {

                            $message_quote = quote_other("arab-forums", user_other("arab-forums", array($quote_object->user_id, $quote_object->user_group, $quote_object->user_nameuser, $quote_object->user_lock1, $quote_object->user_coloruser, false)), "topic.php?id={$quote_object->reply_topicid}&type=reply&value={$quote_object->reply_id}", urlimghids_other("arab-forums", messagereplase_other("arab-forums", $quote_object->reply_message, $topic_object->forum_id), $quote_object->reply_url, $topic_object->reply_img, $topic_object->forum_urlshowreply, $totalreplyu, $moderatget1, $quote_object->reply_user));
                        } else {

                            $message_quote = "";
                        }
                    } else {

                        $message_quote = "";
                    }
                } else {

                    $message_quote = "";
                }

                $arrayeditor = array(

                    "mode" => $moderatget1,

                    "appc" => 2,

                    "mose" => array($topic_object->topic_wait, $topic_object->topic_lock, $topic_object->topic_hid, $topic_object->topic_stiky),

                    "forum" => true,

                    "admin" => false,

                    "img" => img_other("arab-forums", "{$topic_object->forum_logo}", "", "50", "50", "0", "", ""),

                    "opr" => a_other("arab-forums", "forum.php?id={$topic_object->forum_id}", "{$topic_object->forum_name} - رد جديد", "{$topic_object->forum_name} - رد جديد", ""),

                    "trother" => a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "الموضوع : {$topic_object->topic_name}", "الموضوع : {$topic_object->topic_name}", "") . "&nbsp;-&nbsp;" . a_other("arab-forums", "profile.php?id={$topic_object->user_id}", "الكاتب : {$topic_object->user_nameuser}", "الكاتب : {$topic_object->user_nameuser}", ""),

                    "text" => "إضافة رد جديد",

                    "url" => "topic.php?id={$topic_object->topic_id}&go=newreply&",

                    "message" => $message_quote,

                    "type" => "newreply",

                    "title" => "",

                    "other" => "عدد الردود<br>الجديدة المتبقية<br>لك في هذا المنتدى<br>هو : <span style=\"color:red;\">" . ($moderatget1 == true ? "غير محدود" : ($topic_object->forum_totalreply - $totalreplynew)) . "</span>",

                );

                echo editor_template("arab-forums", $arrayeditor);

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك المشاركة في الموضوع و السبب <br><br>{$errorop}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "editreply") {

        define("pagebody", "editreply");

        online_other("arab-forums", "editreply", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        $reply_sql = select_mysql("arab-forums", "reply", "r.reply_id , r.reply_topicid , r.reply_user , r.reply_delete , r.reply_message , r.reply_wait , r.reply_hid , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as r left join user" . prefix_connect . " as u on(u.user_id = r.reply_user) where r.reply_id in(" . value . ") && r.reply_topicid in({$topic_object->topic_id}) limit 1");

        if (group_user == 0) {

            $errorop = "تعديل الردود للأعضاء المسجلين فقط";
        } elseif (num_mysql("arab-forums", $reply_sql) == false) {

            $errorop = "رقم الرد خاطئ";
        } else {

            $reply_object = object_mysql("arab-forums", $reply_sql);

            if ($topic_object->cat_lock == 1 && $moderatget1 == false) {

                $errorop = "الفئة مغلوقة";
            } elseif ($topic_object->forum_lock == 1 && $moderatget1 == false) {

                $errorop = "المنتدى مغلوق";
            } elseif ($topic_object->topic_lock == 1 && $moderatget1 == false && num_mysql("arab-forums", select_mysql("arab-forums", "locktopic", "locktopic_userid , locktopic_topicid", "where locktopic_userid in(" . id_user . ") && locktopic_topicid in({$topic_object->topic_id}) limit 1")) == false) {

                $errorop = "الموضوع مغلوق";
            } elseif ($reply_object->reply_user != id_user && $moderatget1 == false) {

                $errorop = "الرد غير خاص بك";
            } elseif ($reply_object->reply_wait == 1 && $moderatget1 == false) {

                $errorop = "الرد ينتظر الموافقة";
            } elseif ($reply_object->reply_delete == 1 && $moderatget1 == false) {

                $errorop = "الرد محذوف";
            } else {

                $errorop = "";
            }
        }

        if ($errorop == "") {

            if (editor == "true") {

                $editor_sizetext = text_other("arab-forums", post_other("arab-forums", "message"), true, true, true, true, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", post_other("arab-forums", "message")), false, true, false, false, true);

                $editor_edit = text_other("arab-forums", htmltext_other("arab-forums", $reply_object->reply_message), false, true, false, false, true);

                if (mb_strlen($editor_sizetext) < 3) {

                    $erroreditor = "محتوى النص قصير جدا";
                } else {

                    $erroreditor = "";
                }

                if ($erroreditor == "") {

                    insert_mysql("arab-forums", "editreply", "editreply_id , editreply_replyid , editreply_user , editreply_date , editreply_message", "null , \"{$reply_object->reply_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$editor_edit}\"");

                    update_mysql("arab-forums", "reply", "reply_message = \"{$editor_message}\" where reply_id in({$reply_object->reply_id})");

                    insert_mysql("arab-forums", "optionreply", "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type", "null , \"{$reply_object->reply_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"edit\"");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تعديل الرد بنجاح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => true,

                        "text" => "أنقر هنا للذهاب إلى الرد",

                        "url" => "topic.php?id={$topic_object->topic_id}&type=reply&value={$reply_object->reply_id}",

                        "array" => array("أنقر هنا للذهاب إلى الموضوع", "topic.php?id={$topic_object->topic_id}", "أنقر هنا للذهاب إلى المنتدى", "forum.php?id={$topic_object->forum_id}", "أنقر هنا للذهاب إلى الصفحة الرئيسية", "home.php"),

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك تعديل الرد و السبب <br><br>{$erroreditor}",

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

                echo bodytop_template("arab-forums", $reply_object->reply_name . " | تعديل رد");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                $arrayeditor = array(

                    "mode" => $moderatget1,

                    "appc" => 0,

                    "mose" => "",

                    "forum" => true,

                    "admin" => false,

                    "img" => img_other("arab-forums", "{$topic_object->forum_logo}", "", "50", "50", "0", "", ""),

                    "opr" => a_other("arab-forums", "forum.php?id={$topic_object->forum_id}", "{$topic_object->forum_name} - تعديل رد", "{$topic_object->forum_name} - تعديل رد", ""),

                    "trother" => a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "الموضوع : {$topic_object->topic_name}", "الموضوع : {$topic_object->topic_name}", "") . "&nbsp;-&nbsp;" . a_other("arab-forums", "profile.php?id={$topic_object->user_id}", "الكاتب : {$topic_object->user_nameuser}", "الكاتب : {$topic_object->user_nameuser}", ""),

                    "text" => "تعديل رد",

                    "url" => "topic.php?id={$topic_object->topic_id}&go=editreply&value={$reply_object->reply_id}&",

                    "message" => messagereplase_other("arab-forums", $reply_object->reply_message, $topic_object->forum_id),

                    "type" => "editreply",

                    "title" => $topic_object->topic_name,

                    "other" => "",

                );

                echo editor_template("arab-forums", $arrayeditor);

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك تعديل هذا الرد و السبب <br><br>{$errorop}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "sendtopic") {

        define("pagebody", "sendtopic");

        online_other("arab-forums", "sendtopic", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        if (group_user == 0) {

            $errorop = "خاصية إرسال المواضيع متوفرة للأعضاء المسجلين فقط";
        } elseif ($topic_object->topic_wait == 1) {

            $errorop = "الموضوع ينتظر الموافقة";
        } elseif ($topic_object->topic_hid == 1) {

            $errorop = "الموضوع مخفي";
        } else {

            $errorop = "";
        }

        if ($errorop == "") {

            if (type == "insert") {

                $emailsend = text_other("arab-forums", post_other("arab-forums", "emailsend"), true, true, true, true, true);

                if ($emailsend == "") {

                    $error = "الرجاء إدخال البريد الإلكتروني الخاص بصديقك ليتم الإرسال";
                } elseif (!filter_var($emailsend, FILTER_VALIDATE_EMAIL)) {

                    $error = "الرجاء إدخال بريد إلكتروني صحيح ليتم الإرسال";
                } else {

                    $error = "";
                }

                if ($error == "") {

                    $subject = "رسالة من " . title_option . " : موضوع : {$topic_object->topic_name}";

                    $activeurl = "http://" . showurl_option . "/topic.php?id={$topic_object->topic_id}";

                    $message = "إلى : {$emailsend}

هذه رسالة لك من : " . name_user . "
		
وهو عضو في " . title_option . " ويود ان يلفت انتابهك الى موضوع قد يثير اهتمامك على الوصلة التالية :

<a href=\"{$activeurl}\">{$activeurl}</a>

-------------------------------------------------

مع أطيب الأمنيات إدارة " . title_option . "";

                    mail_other("arab-forums", $emailsend, $subject, $message, "", "", "");

                    $arraymsg = array(

                        "login" => false,

                        "msg" => "تم إرسال الموضوع إلى البريد الإلكتروني بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "الذهاب إلى الموضوع",

                        "url" => "topic.php?id={$topic_object->topic_id}",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => false,

                        "msg" => $error,

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

                echo bodytop_template("arab-forums", "إرسال موضوع");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"topic.php?id={$topic_object->topic_id}&go=sendtopic&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">إرسال موضوع لصديق</div></td></tr>";

                echo "<tr><td class=\"alttext1\" align=\"center\"><div class=\"pad\">";

                echo "<br>إرسال الموضوع التالي لصديق<br><br><span style=\"color:red;font-size:14px;\">{$topic_object->topic_name}</span><br><br>أدخل البريد الإلكتروني الخاص بصديقك و إضغط على إرسال الموضوع";

                echo "<br><br><input style=\"width:250px\" class=\"input\" name=\"emailsend\" value=\"\" type=\"text\">";

                echo "<br><br>ملاحظة: يجب ان يكون البريد الإلكتروني صحيح<br><br>";

                echo "</div></td></tr>";

                echo "<tr><td class=\"alttext2\" align=\"center\"><div class=\"pad\">";

                echo "<br><input type=\"submit\" class=\"button\" name=\"insert\" value=\"إرسال الموضوع\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرسال الموضوع للإيميل المدخل ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"><br><br>";

                echo "</div></td></tr>";

                echo "</table></form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك المشاركة في الموضوع و السبب <br><br>{$errorop}",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "printtopic") {

        define("pagebody", "printtopic");

        online_other("arab-forums", "printtopic", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        echo bodytop_template("arab-forums", "طباعة موضوع");

        $arrayheader = array(

            "login" => true,

        );

        echo "<br><table width=\"99%\" border=\"3\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" align=\"center\"><tr>";

        echo "<td width=\"100%\" class=\"print2\">" . a_other("arab-forums", "home.php", title_option, title_option, "") . "</td>";

        echo "<td class=\"print1\"><nobr>" . adress_option . "</nobr></td>";

        echo "</tr></table><br><br>";

        echo "<center><span style=\"color:red;font-size:30px;\">{$topic_object->topic_name}</span></center><br><br>";

        echo "<table border=\"3\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

        echo "<tr align=\"center\"><td class=\"print1\" align=\"right\">{$topic_object->user_nameuser}</td><td class=\"print2\" width=\"15%\"><nobr>" . times_date("arab-forums", "", $topic_object->topic_date) . "</nobr></td></tr>";

        echo "<tr><td class=\"print2\" colspan=\"2\">";

        echo "<table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

        if (group_user == 0 && $topic_object->forum_visitortopicshow == 0) {

            echo "<br><table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\"><tr><td width=\"100%\" class=\"tcot\" align=\"center\"><div class=\"pad\">للأسف تم منع الزوار من مشاهدة محتوى المواضيع في هذا المنتدى</div></td></tr></table><br>";
        } else {

            echo urlimghids_other("arab-forums", messagereplase_other("arab-forums", $topic_object->topic_message, $topic_object->forum_id), $topic_object->topic_url, $topic_object->topic_img, $topic_object->forum_urlshowtopic, $totalreplyu, $moderatget1, $topic_object->topic_user);
        }

        echo "</td></tr></table>";

        echo "</td></tr>";

        echo "</table>";

        echo "<br><br>";

        echo "<center><span style=\"color:black;font-size:13px;\">Arab Forums 0.2, Copyright ©2011 - 2012, (Prince Algeria) Issam Nedjar</span></center><br><br>";

        echo bodybottom_template("arab-forums");
    } elseif (go == "monitortopic") {

        define("pagebody", "monitortopic");

        online_other("arab-forums", "monitortopic", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        $monitor_num1 = num_mysql("arab-forums", select_mysql("arab-forums", "monitortopic", "monitortopic_topicid , monitortopic_userid", "where monitortopic_topicid in({$topic_object->topic_id}) && monitortopic_userid in(" . id_user . ") limit 1"));

        $monitor_num2 = num_mysql("arab-forums", select_mysql("arab-forums", "monitortopic", "monitortopic_userid", "where monitortopic_userid in(" . id_user . ")"));

        if ($monitor_num1 != false) {

            $errormonitor = "للأسف الموضوع المختار في قائمة مفضلتك حاليا";
        } elseif ($monitor_num2 >= monitortopic_option) {

            $errormonitor = "للأسف لقد تجاوزت الحد المسموح لك بإضافة مواضيع لمفضلتك";
        } else {

            $errormonitor = "";
        }

        if ($errormonitor == "") {

            insert_mysql("arab-forums", "monitortopic", "monitortopic_id , monitortopic_topicid , monitortopic_userid , monitortopic_date", "null , \"{$topic_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\"");

            $arraymsg = array(

                "login" => false,

                "msg" => "تم إضافة الموضوع لقائمة مواضيعك المفضلة بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            $arraymsg = array(

                "login" => false,

                "msg" => $errormonitor,

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

        define("pagebody", "topic");

        online_other("arab-forums", "topic", $topic_object->cat_id, $topic_object->forum_id, $topic_object->topic_id, "0");

        $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

        $allyp  = text_other("arab-forums", post_other("arab-forums", "allyp"), true, true, true, true, false);

        $gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

        $import = @implode(",", $allyu);

        if (isset($gets) && $moderatget1 == true) {

            if ($allyu == 0) {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء تحديد رد وآحد على الأقل",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                if ($allyp == "wait") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_wait in(1)",

                        "update" => "reply_wait = \"0\"",

                        "text1" => "الموافقة على",

                        "text2" => "ينتظر الموافقة",

                        "text3" => "الموافقة عليه",

                        "option" => "wait",

                    );
                } elseif ($allyp == "hid") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_hid in(0)",

                        "update" => "reply_hid = \"1\"",

                        "text1" => "إخفاء",

                        "text2" => "ظاهر",

                        "text3" => "إخفائه",

                        "option" => "hid",

                    );
                } elseif ($allyp == "nohid") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_hid in(1)",

                        "update" => "reply_hid = \"0\"",

                        "text1" => "إظهار",

                        "text2" => "مخفي",

                        "text3" => "إظهاره",

                        "option" => "nohid",

                    );
                } elseif ($allyp == "top") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_top in(0)",

                        "update" => "reply_top = \"1\"",

                        "text1" => "تمييز",

                        "text2" => "غير مميز",

                        "text3" => "تميزه",

                        "option" => "top",

                    );
                } elseif ($allyp == "notop") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_top in(1)",

                        "update" => "reply_top = \"0\"",

                        "text1" => "إزالة تمييز",

                        "text2" => "مميز",

                        "text3" => "إزالة تمييزه",

                        "option" => "notop",

                    );
                } elseif ($allyp == "delete") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_delete in(0)",

                        "update" => "reply_delete = \"1\"",

                        "text1" => "حذف",

                        "text2" => "غير محذوف",

                        "text3" => "حذفه",

                        "option" => "delete",

                    );
                } elseif ($allyp == "nodelete") {

                    $option_im = array(

                        "true" => true,

                        "select" => "reply_delete in(1)",

                        "update" => "reply_delete = \"0\"",

                        "text1" => "إرجاع",

                        "text2" => "محذوف",

                        "text3" => "إرجاعه",

                        "option" => "nodelete",

                    );
                } else {

                    $option_im = array(

                        "true" => false,

                    );
                }

                if ($option_im["true"] == true) {

                    $im_sql = select_mysql("arab-forums", "reply", "reply_top , reply_id , reply_delete , reply_hid , reply_wait , reply_user , reply_topicid", "where reply_id in({$import}) && {$option_im["select"]}");

                    if (num_mysql("arab-forums", $im_sql) != false) {

                        while ($im_object = object_mysql("arab-forums", $im_sql)) {

                            update_mysql("arab-forums", "reply", "{$option_im["update"]} where reply_id in({$im_object->reply_id}) limit 1");

                            insert_mysql("arab-forums", "optionreply", "optionreply_id , optionreply_replyid , optionreply_user , optionreply_date , optionreply_type", "null , \"{$im_object->reply_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$option_im["option"]}\"");

                            if ($option_im["option"] == "delete") {

                                update_mysql("arab-forums", "forum", "forum_reply = forum_reply-1 where forum_id in({$topic_object->forum_id})");

                                update_mysql("arab-forums", "topic", "topic_reply = topic_reply-1 where topic_id in({$im_object->reply_topicid})");

                                update_mysql("arab-forums", "user", "user_post = user_post-1 , user_posts = user_posts-1 where user_id in({$im_object->reply_user})");
                            } elseif ($option_im["option"] == "nodelete") {

                                update_mysql("arab-forums", "forum", "forum_reply = forum_reply+1 where forum_id in({$topic_object->forum_id})");

                                update_mysql("arab-forums", "topic", "topic_reply = topic_reply+1 where topic_id in({$im_object->reply_topicid})");

                                update_mysql("arab-forums", "user", "user_post = user_post+1 , user_posts = user_posts+1 where user_id in({$im_object->reply_user})");
                            }
                        }

                        $arraymsg = array(

                            "login" => true,

                            "msg" => "تم {$option_im["text1"]} الردود المحددة بنجآح تآم",

                            "color" => "good",

                            "old" => true,

                            "auto" => false,

                            "text" => "",

                            "url" => "",

                            "array" => "",

                        );

                        echo msg_template("arab-forums", $arraymsg);
                    } else {

                        $arraymsg = array(

                            "login" => true,

                            "msg" => "عفوا لم تختر أي رد {$option_im["text2"]} ليتم {$option_im["text3"]}",

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

                        "msg" => "لا يمكنك المتابعة لأن الأمر المطبق غير متوفر",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                }
            }
        } else {

            update_mysql("arab-forums", "topic", "topic_lock = \"1\" where topic_reply >= \"" . locktopic_option . "\"");

            if ($topic_object->topic_user != id_user) {

                update_mysql("arab-forums", "topic", "topic_visit = topic_visit+1 where topic_id in({$topic_object->topic_id})");
            }

            echo bodytop_template("arab-forums", $topic_object->topic_name);

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            if (type == "user" && is_numeric(value) && group_user > 0) {

                $user_sql = select_mysql("arab-forums", "user", "user_id , user_sex , user_lock1 , user_group , user_nameuser , user_coloruser , user_wait , user_bad", "where user_id in(" . value . ") && user_wait in(0) && user_bad in(0) limit 1");

                if (num_mysql("arab-forums", $user_sql) != false) {

                    $user_object = object_mysql("arab-forums", $user_sql);

                    $typereply1 = "&& r.reply_user in({$user_object->user_id})";

                    $typereply2 = "&& reply_user in({$user_object->user_id})";

                    $typereply3 = array(true, ($user_object->user_id == id_user ? "تعرض حاليا ردودك" : "تعرض حاليا ردود " . ($user_object->user_sex == 1 ? $sex1get_list[$user_object->user_group] : $sex2get_list[$user_object->user_group]) . " " . user_other("arab-forums", array($user_object->user_id, $user_object->user_group, $user_object->user_nameuser, $user_object->user_lock1, $user_object->user_coloruser, false)) . ""));

                    $typereply4 = "&type=user&value={$user_object->user_id}";
                } else {

                    $typereply1 = "";

                    $typereply2 = "";

                    $typereply3 = array(false, "");

                    $typereply4 = "";
                }
            } elseif (type == "reply" && is_numeric(value)) {

                $reply_sql = select_mysql("arab-forums", "reply", "reply_id", "where reply_id in(" . value . ") limit 1");

                if (num_mysql("arab-forums", $reply_sql) != false) {

                    $reply_object = object_mysql("arab-forums", $reply_sql);

                    $typereply1 = "&& r.reply_id in({$reply_object->reply_id})";

                    $typereply2 = "&& reply_id in({$reply_object->reply_id})";

                    $typereply3 = array(true, "يعرض حاليا رد معين فقط من الموضوع");

                    $typereply4 = "&type=reply&value={$reply_object->reply_id}";
                } else {

                    $typereply1 = "";

                    $typereply2 = "";

                    $typereply3 = array(false, "");

                    $typereply4 = "";
                }
            } elseif (type == "wait" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_wait in(1)";

                $typereply2 = "&& reply_wait in(1)";

                $typereply3 = array(true, "تعرض حاليا الردود التي تنتظر الموافقة");

                $typereply4 = "&type=wait";
            } elseif (type == "nowait" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_wait in(0)";

                $typereply2 = "&& reply_wait in(0)";

                $typereply3 = array(true, "تعرض حاليا الردود الموافق عليها");

                $typereply4 = "&type=nowait";
            } elseif (type == "hid" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_hid in(1)";

                $typereply2 = "&& reply_hid in(1)";

                $typereply3 = array(true, "تعرض حاليا الردود المخفية");

                $typereply4 = "&type=hid";
            } elseif (type == "nohid" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_hid in(0)";

                $typereply2 = "&& reply_hid in(0)";

                $typereply3 = array(true, "تعرض حاليا الردود الظاهرة");

                $typereply4 = "&type=nohid";
            } elseif (type == "top" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_top in(1)";

                $typereply2 = "&& reply_top in(1)";

                $typereply3 = array(true, "تعرض حاليا الردود المميزة");

                $typereply4 = "&type=top";
            } elseif (type == "notop" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_top in(0)";

                $typereply2 = "&& reply_top in(0)";

                $typereply3 = array(true, "تعرض حاليا الردود الغير مميزة");

                $typereply4 = "&type=notop";
            } elseif (type == "delete" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_delete in(1)";

                $typereply2 = "&& reply_delete in(1)";

                $typereply3 = array(true, "تعرض حاليا الردود المحذوفة");

                $typereply4 = "&type=delete";
            } elseif (type == "nodelete" && $moderatget1 == true) {

                $typereply1 = "&& r.reply_delete in(0)";

                $typereply2 = "&& reply_delete in(0)";

                $typereply3 = array(true, "تعرض حاليا الردود الغير محذوفة");

                $typereply4 = "&type=nodelete";
            } else {

                $typereply1 = "";

                $typereply2 = "";

                $typereply3 = array(false, "");

                $typereply4 = "";
            }

            $topictemplate  = "";

            $topictemplate .= "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            $topictemplate .= "<td>" . img_other("arab-forums", "{$topic_object->forum_logo}", "", "50", "50", "0", "", "") . "</td>";

            $topictemplate .= "<td width=\"100%\">" . a_other("arab-forums", "forum.php?id={$topic_object->forum_id}", "{$topic_object->forum_name}", "{$topic_object->forum_name}", "") . "</td>";

            $topictemplate .= "<td class=\"menu\"><nobr>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=newreply", "رد جديد", img_other("arab-forums", "images/newreply.png", "", "", "", "0", "", "") . "<br>رد جديد", "") . "</nobr></td>";

            $topictemplate .= "<td class=\"menu\"><nobr>" . a_other("arab-forums", "forum.php?id={$topic_object->forum_id}&go=newtopic", "موضوع جديد", img_other("arab-forums", "images/newtopic.png", "", "", "", "0", "", "") . "<br>موضوع جديد", "") . "</nobr></td>";

            if (group_user > 0) {

                $topictemplate .= "<td class=\"menu\"><nobr>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=sendtopic", "أرسل الموضوع", img_other("arab-forums", "images/sendtopics.png", "", "", "", "0", "", "") . "<br>أرسل", "") . "</nobr></td>";

                $topictemplate .= "<td class=\"menu\"><nobr>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=monitortopic", "أضف الموضوع للمفضلة", img_other("arab-forums", "images/monitortopics.png", "", "", "", "0", "", "") . "<br>المفضلة", confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إضافة هذا الموضوع إلى قائمة مفضلتك ؟")) . "</nobr></td>";
            }

            $topictemplate .= "<td class=\"menu\"><nobr>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=printtopic", "طباعة الموضوع", img_other("arab-forums", "images/printtopics.png", "", "", "", "0", "", "") . "<br>طباعة", "") . "</nobr></td>";

            if (group_user > 0) {

                $topictemplate .= "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">التواقيع</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

                $topictemplate .= "<option value=\"change.php?go=tawa9i3&value=0\" " . (forum_tawa9i3 == 0 ? "selected" : "") . ">مخفية</option>";

                $topictemplate .= "<option value=\"change.php?go=tawa9i3&value=1\" " . (forum_tawa9i3 == 1 ? "selected" : "") . ">ظاهرة</option>";

                $topictemplate .= "</select></div></td>";
            }

            $topictemplate .= "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">حجم الصفحة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

            $topictemplate .= "<option value=\"change.php?go=replytopic&value=10\" " . (forum_replytopic == 10 ? "selected" : "") . ">10 ردود</option>";

            $topictemplate .= "<option value=\"change.php?go=replytopic&value=30\" " . (forum_replytopic == 30 ? "selected" : "") . ">30 رد</option>";

            $topictemplate .= "<option value=\"change.php?go=replytopic&value=50\" " . (forum_replytopic == 50 ? "selected" : "") . ">50 رد</option>";

            $topictemplate .= "<option value=\"change.php?go=replytopic&value=70\" " . (forum_replytopic == 70 ? "selected" : "") . ">70 رد</option>";

            $topictemplate .= "</select></div></td>";

            $count_page = forum_replytopic;

            $get_page = (page == "" || !is_numeric(page) ? 1 : page);

            $limit_page = (($get_page * $count_page) - $count_page);

            $topictemplate .= page_pager("arab-forums", "reply", "reply_id , reply_topicid , reply_delete , reply_hid , reply_wait , reply_user , reply_top", "where reply_topicid in({$topic_object->topic_id}) {$typereply2}", $count_page, $get_page, "topic.php?id={$topic_object->topic_id}{$typereply4}&");

            $topictemplate .= list_forumcatlist("arab-forums");

            $topictemplate .= "</tr></table>";

            echo $topictemplate;

            if ($moderatget1 == true) {

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                echo "<td width=\"100%\"></td>";

                echo "<td><select class=\"inputselect\" onchange=\"getst(this)\">";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}\" " . (type == "" ? "selected" : "") . ">ع / جميع الردود</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=wait\" " . (type == "wait" ? "selected" : "") . ">ع / الردود التي تنتظر الموافقة</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=nowait\" " . (type == "nowait" ? "selected" : "") . ">ع / الردود الموافق عليها</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=hid\" " . (type == "hid" ? "selected" : "") . ">ع / الردود المخفية</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=nohid\" " . (type == "nohid" ? "selected" : "") . ">ع / الردود الظاهرة</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=top\" " . (type == "top" ? "selected" : "") . ">ع / الردود المميزة</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=notop\" " . (type == "notop" ? "selected" : "") . ">ع / الردود الغير مميزة</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=delete\" " . (type == "delete" ? "selected" : "") . ">ع / الردود المحذوفة</option>";

                echo "<option value=\"topic.php?id={$topic_object->topic_id}&type=nodelete\" " . (type == "nodelete" ? "selected" : "") . ">ع / الردود الغير محذوفة</option>";

                echo "</select></td>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<td><select class=\"inputselect\" name=\"allyp\">";

                echo "<option value=\"wait\">الموافقة على الردود المحددة</option>";

                echo "<option value=\"hid\">إخفاء الردود المحددة</option>";

                echo "<option value=\"nohid\">إظهار الردود المحددة</option>";

                echo "<option value=\"top\">تمييز الردود المحددة</option>";

                echo "<option value=\"notop\">إزالة تمييز الردود المحددة</option>";

                echo "<option value=\"delete\">حذف الردود المحددة</option>";

                echo "<option value=\"nodelete\">إرجاع الردود المحددة</option>";

                echo "</select></td>";

                echo "<td><nobr><input class=\"button\" value=\"تطبيق\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد التطبيق على الردود المحددة ؟") . "></nobr></td>";

                $inputtext = array(

                    1 => "تحديد جميع الردود",

                    2 => "إلغاء تحديد جميع الردود",

                    3 => "لا يوجد ردود بالصفحة حاليا",

                    4 => "عدد الردود الذي إخترت هو :",

                    5 => "الرد",

                );

                echo "<td class=\"menu\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'topice select topic');\"></td>";

                echo "</tr></table>";
            } else {

                echo "<br>";
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

                if ($topic_object->topic_delete == 1) {

                    $iconstopic = img_other("arab-forums", "images/folder/delete.png", "هذا الموضوع محذوف", "", "", "0", "class=\"title\"", "");
                } elseif ($topic_object->topic_wait == 1) {

                    $iconstopic = img_other("arab-forums", "images/folder/wait.png", "هذا الموضوع ينتظر الموافقة", "", "", "0", "class=\"title\"", "");
                } elseif ($topic_object->topic_lock == 1) {

                    $iconstopic = img_other("arab-forums", "images/folder/lock.png", "هذا الموضوع مغلوق", "", "", "0", "class=\"title\"", "");
                } elseif ($topic_object->topic_lock == 0 && $topic_object->topic_reply >= 10) {

                    $iconstopic = img_other("arab-forums", "images/folder/hote.png", "هذا الموضوع نشيط", "", "", "0", "class=\"title\"", "");
                } else {

                    $iconstopic = img_other("arab-forums", "images/folder/new.png", "هذا الموضوع مفتوح", "", "", "0", "class=\"title\"", "");
                }
            }

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

            $titletemplate = "<tr align=\"center\"><td class=\"tcat\" style=\"font-size:17px;\" colspan=\"2\" align=\"center\"><div class=\"pad\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr><td>{$iconstopic}</td><td width=\"100%\" align=\"center\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "{$text2topic}{$topic_object->topic_name}", "{$text1topic}{$topic_object->topic_name}", "") . "</td></tr></table></div></td></tr>";

            echo $titletemplate;

            if ($typereply3[0] == true) {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" colspan=\"2\"><br>{$typereply3[1]} >> " . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}", "عرض جميع الردود", "عرض جميع الردود", "") . "<br><br></td>";

                echo "</tr>";
            }

            if ($get_page == 1 && $typereply3[0] == false) {

                echo "<tr align=\"center\">";

                echo "</tr>";

                if ($topic_object->topic_delete == 1) {

                    $classtopic = "topicd";

                    $teretopic = "هذا الموضوع تم حذفه";
                } elseif ($topic_object->topic_wait == 1) {

                    $classtopic = "topicw";

                    $teretopic = "هذا الموضوع لم تتم الموافقة عليه بعد";
                } elseif ($topic_object->topic_hid == 1) {

                    $classtopic = "topich";

                    $teretopic = "هذا الموضوع تم إخفائه  -- للإستفسار عن السبب الرجاء الإتصال بمشرف المنتدى";
                } else {

                    $classtopic = "topicn";

                    $teretopic = "";
                }

                echo "<tr align=\"center\"><td class=\"tcot\" colspan=\"2\">";

                echo "<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" align=\"center\"><tr>";

                echo "<td>" . img_other("arab-forums", "images/date.png", "", "", "", "0", "", "") . "</td>";

                echo "<td>&nbsp;&nbsp;</td>";

                echo "<td>" . ($topic_object->topic_date != "" ? "<nobr>" . times_date("arab-forums", "", $topic_object->topic_date) . "</nobr>" : "") . "</td>";

                echo "<td width=\"100%\"></td>";

                echo "<td class=\"menu\">" . a_other("arab-forums", "profile.php?id={$topic_object->user_id}", "مشاهدة بيانات {$topic_object->user_nameuser}", img_other("arab-forums", "images/profilt.png", "", "", "", "0", "", ""), "") . "</td>";

                if (group_user > 0) {

                    echo "<td class=\"menu\">" . a_other("arab-forums", "message.php?go=new&sendmy=" . id_user . "&sendto={$topic_object->user_id}&quote=1&qtopic=" . codesql1_other("arab-forums", $topic_object->topic_id, 3) . "", "إرسال رسالة خاصة إلى {$topic_object->user_nameuser}", img_other("arab-forums", "images/mailuser.png", "", "", "", "0", "", ""), "") . "</td>";

                    if ($topic_object->user_id != id_user) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "notify.php?go=add&fort=topic&id={$topic_object->topic_id}", "لفت إنتباه المشرف إلى هذه المشاركة", img_other("arab-forums", "images/warningt.png", "", "", "", "0", "", ""), "") . "</td>";
                    }

                    if ($moderatget1 == true) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "message.php?go=new&sendmy=-{$topic_object->forum_id}&sendto={$topic_object->user_id}", "إرسال رسالة خاصه من إشراف المنتدى إلى {$topic_object->user_nameuser}", img_other("arab-forums", "images/mailforum.png", "", "", "", "0", "", ""), "") . "</td>";
                    }

                    if (($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0 && $topic_object->topic_user == id_user)) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=edittopic", "تعديل الموضوع", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";
                    }

                    echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=newreply&quote=1&qtopic=" . codesql1_other("arab-forums", $topic_object->topic_id, 1) . "", "إقتباس لهذا الموضوع", img_other("arab-forums", "images/add.png", "", "", "", "0", "", ""), "") . "</td>";

                    echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&type=user&value=" . $topic_object->topic_user . "", "عرض ردود {$topic_object->user_nameuser} فقط", img_other("arab-forums", "images/user1.png", "", "", "", "0", "", ""), "") . "</td>";
                }

                if ($moderatget1 == true) {

                    echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=state", "عرض إحصائيات الموضوع", img_other("arab-forums", "images/state.png", "", "", "", "0", "", ""), "") . "</td>";

                    echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=goedit", "التعديلات المقام بها على الموضوع", img_other("arab-forums", "images/edituu.png", "", "", "", "0", "", ""), "") . "</td>";

                    echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=goshow", "الأعضاء المسموح لهم بمشاهدة الموضوع", img_other("arab-forums", "images/goshow.png", "", "", "", "0", "", ""), "") . "</td>";

                    echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=golock", "الأعضاء المسموح لهم بالرد على الموضوع", img_other("arab-forums", "images/golock.png", "", "", "", "0", "", ""), "") . "</td>";

                    if ($topic_object->topic_wait == 1) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=wait", "الموافقة على الموضوع", img_other("arab-forums", "images/wait.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_img == 0) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=img", "إخفاء صور الموضوع", img_other("arab-forums", "images/img.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء صور الموضوع ؟")) . "</td>";
                    } else {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=noimg", "إظهار صور الموضوع", img_other("arab-forums", "images/noimg.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار صور الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_url == 0) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=url", "إخفاء روابط الموضوع", img_other("arab-forums", "images/url.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء روابط الموضوع ؟")) . "</td>";
                    } else {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nourl", "إظهار روابط الموضوع", img_other("arab-forums", "images/nourl.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار روابط الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_lock == 0) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=lock", "غلق الموضوع", img_other("arab-forums", "images/lock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد غلق الموضوع ؟")) . "</td>";
                    } else {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nolock", "فتح الموضوع", img_other("arab-forums", "images/nolock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد فتح الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_hid == 0) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=hid", "إخفاء الموضوع", img_other("arab-forums", "images/hid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء الموضوع ؟")) . "</td>";
                    } else {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nohid", "إظهار الموضوع", img_other("arab-forums", "images/nohid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_stiky == 0) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=stiky", "تثبيث الموضوع", img_other("arab-forums", "images/stiky.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تثبيث الموضوع ؟")) . "</td>";
                    } else {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nostiky", "إزالة تثبيث الموضوع", img_other("arab-forums", "images/nostiky.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إزالة تثبيث الموضوع ؟")) . "</td>";
                    }

                    if ($topic_object->topic_delete == 0 && per_other("arab-forums", 2) == true) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=delete", "حذف الموضوع", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الموضوع ؟")) . "</td>";
                    } elseif ($topic_object->topic_delete == 1 && $moderatget2 == true) {

                        echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nodelete", "إرجاع الموضوع", img_other("arab-forums", "images/nodelete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع الموضوع ؟")) . "</td>";
                    }

                    echo "<td class=\"menu\">" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=option", "خيارات الموضوع", img_other("arab-forums", "images/option.png", "", "", "", "0", "", ""), "") . "</td>";
                }

                echo "</tr></table>";

                echo "</td></tr>";

                echo "<tr align=\"center\"><td class=\"topice topics topic\" width=\"16%\" valign=\"top\">";

                echo "<div class=\"textw1 paddse\"><strong><nobr>" . user_other("arab-forums", array($topic_object->user_id, $topic_object->user_group, $topic_object->user_nameuser, $topic_object->user_lock1, $topic_object->user_coloruser, false)) . "</nobr></strong></div>";

                if (group_user > 0) {

                    if ($topic_object->user_lock1 == 1) {

                        echo "<div class=\"paddse textw2\">عضوية مغلوقة</div>";
                    } else {

                        echo "<div class=\"paddse textw3\">المشاركات : " . num_other("arab-forums", $topic_object->user_post) . "</div>";

                        echo "<div class=\"paddse textw5\">نقاط التميز : " . num_other("arab-forums", $topic_object->user_point) . "</div>";

                        $startuser = star_other("arab-forums", array($topic_object->user_colorstar, $topic_object->user_group, $topic_object->user_post));

                        if ($startuser != "") {

                            echo "<div class=\"paddse\">" . $startuser . "</div>";
                        }

                        if ($topic_object->forum_wasaftopic == 1) {

                            $titlemonitor1 = titlemonitor1_other("arab-forums", $topic_object->user_id, $topic_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                            $titlemonitor2 = titlemonitor2_other("arab-forums", $topic_object->user_id, $topic_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                            $titlemodirater = titlemodirater_other("arab-forums", $topic_object->user_id, $topic_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                            if ($titlemonitor1 == "" && $titlemonitor2 == "" && $titlemodirater == "") {

                                if ($topic_object->user_titleold == 0) {

                                    echo "<div class=\"paddse textw3\">" . title_other("arab-forums", array($topic_object->user_sex, $topic_object->user_group, $topic_object->user_post)) . "</div>";
                                } else {

                                    echo "<div class=\"paddse textw3\">" . ($topic_object->user_sex == 1 ? $sex1titleold_list[$topic_object->user_titleold] : $sex2titleold_list[$topic_object->user_titleold]) . "</div>";
                                }
                            } else {

                                echo $titlemonitor1;

                                echo $titlemonitor2;

                                echo $titlemodirater;
                            }

                            echo titlewasaf_other("arab-forums", $topic_object->user_id, false, $topic_object->forum_id, "<div class=\"paddse textw3\">", "</div>");
                        }

                        if ($topic_object->forum_phototopic == 1) {

                            echo "<div class=\"padpho paddse\">" . img_other("arab-forums", "{$topic_object->user_photo}", "", "100", "", "0", "", ($topic_object->user_sex == 2 ? "images/sex2.png" : "images/sex1.png")) . "</div>";
                        }

                        if ($topic_object->forum_detailtopic == 1) {

                            echo "<div class=\"paddse textw3\">الدولة : " . ($topic_object->user_country == "" ? "غير محددة" : country_other("arab-forums", $topic_object->user_country)) . "</div>";

                            echo "<div class=\"paddse textw3\"><nobr>عدد الأيام مند الإنضمام : " . totaldays_other("arab-forums", $topic_object->user_dateregister) . "</nobr></div>";

                            echo "<div class=\"paddse textw3\"><nobr>معدل المشاركات في اليوم : " . middleposts_other("arab-forums", $topic_object->user_post, $topic_object->user_dateregister) . "</nobr></div>";
                        }

                        if (num_mysql("arab-forums", select_mysql("arab-forums", "online", "online_userid", "where online_userid in(" . $topic_object->user_id . ") limit 1")) == true) {

                            echo "<div class=\"paddse\">" . img_other("arab-forums", "images/online.gif", "{$topic_object->user_nameuser} " . ($topic_object->user_sex == 1 ? "متصل" : "متصلة") . " حاليا", "", "", "0", "class=\"title\"", "") . "</div>";
                        } else {

                            echo "<div class=\"paddse\">" . img_other("arab-forums", "images/offline.gif", "{$topic_object->user_nameuser} " . ($topic_object->user_sex == 1 ? "غير متصل" : "غير متصلة") . " حاليا", "", "", "0", "class=\"title\"", "") . "</div>";
                        }
                    }
                }

                echo "</td><td class=\"topice {$classtopic} topic\" width=\"84%\" valign=\"top\">";

                if ($teretopic != "") {

                    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\"><tr><td width=\"100%\" class=\"tcot\" align=\"center\"><div class=\"pad\">{$teretopic}</div></td></tr></table><br>";
                }

                echo "<table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

                if (group_user == 0 && $topic_object->forum_visitortopicshow == 0) {

                    echo "<br><table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\"><tr><td width=\"100%\" class=\"tcot\" align=\"center\"><div class=\"pad\">للأسف تم منع الزوار من مشاهدة محتوى المواضيع في هذا المنتدى</div></td></tr></table><br>";
                } else {

                    echo urlimghids_other("arab-forums", messagereplase_other("arab-forums", $topic_object->topic_message, $topic_object->forum_id), $topic_object->topic_url, $topic_object->topic_img, $topic_object->forum_urlshowtopic, $totalreplyu, $moderatget1, $topic_object->topic_user);
                }

                echo "</td></tr></table>";

                if (group_user > 1) {

                    $optiontopic_sql = select_mysql("arab-forums", "optiontopic", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , o.optiontopic_id , o.optiontopic_topicid , o.optiontopic_date , o.optiontopic_user , o.optiontopic_type", "as o left join user" . prefix_connect . " as u on(u.user_id = o.optiontopic_user) where o.optiontopic_topicid in({$topic_object->topic_id}) order by o.optiontopic_date desc");

                    if (num_mysql("arab-forums", $optiontopic_sql) != false) {

                        echo "<hr><table style=\"table-layout:fixed;\">";

                        while ($optiontopic_object = object_mysql("arab-forums", $optiontopic_sql)) {

                            echo "<tr><td width=\"100%\"></td><td class=\"optionget\"><nobr>(" . times_date("arab-forums", "", $optiontopic_object->optiontopic_date) . ") - تم {$option_list[$optiontopic_object->optiontopic_type]} الموضوع بواسطة " . user_other("arab-forums", array($optiontopic_object->user_id, $optiontopic_object->user_group, $optiontopic_object->user_nameuser, $optiontopic_object->user_lock1, $optiontopic_object->user_coloruser, false)) . "</nobr></td></tr>";
                        }

                        echo "</table>";
                    }
                }

                if (group_user > 0) {

                    $siguser = messagereplase_other("arab-forums", $topic_object->user_sig, "0");

                    if ($topic_object->forum_sigtopic == 1 && forum_tawa9i3 == 1 && $siguser != "") {

                        echo "<table style=\"table-layout:fixed;\" align=\"center\" width=\"100%\"><tr><td><fieldset><legend>&nbsp;<font color=\"black\">التوقيع</font></legend>{$siguser}</fieldset></td></tr></table>";
                    }
                }

                echo "</td></tr>";

                if (ads2_option == 1) {

                    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\">";

                    echo "<script type=\"text/javascript\">";

                    echo "google_ad_client = \"" . client2_option . "\";";

                    echo "google_ad_slot = \"" . slot2_option . "\";";

                    echo "google_ad_width = 728;";

                    echo "google_ad_height = 90;";

                    echo "</script>";

                    echo "<script type=\"text/javascript\" src=\"" . url2_option . "\"></script>";

                    echo "</center>";

                    echo "</td></tr>";
                }
            }

            $reply_sql = select_mysql("arab-forums", "reply", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_sex , u.user_post , u.user_photo , u.user_point , u.user_coloruser , u.user_colorstar , u.user_country , u.user_dateregister , u.user_titleold , u.user_sig , r.reply_id , r.reply_topicid , r.reply_wait , r.reply_delete , r.reply_hid , r.reply_top , r.reply_date , r.reply_user , r.reply_img , r.reply_url , r.reply_message", "as r left join user" . prefix_connect . " as u on(u.user_id = r.reply_user) where r.reply_topicid in({$topic_object->topic_id}) {$typereply1} order by r.reply_date asc limit {$limit_page},{$count_page}");

            if (num_mysql("arab-forums", $reply_sql) != false) {

                while ($reply_object = object_mysql("arab-forums", $reply_sql)) {

                    if ((($reply_object->reply_delete == 0) || ($reply_object->reply_delete == 1 && ($moderatget1 == true || $reply_object->reply_user == id_user))) && (($reply_object->reply_wait == 0) || ($reply_object->reply_wait == 1 && ($moderatget1 == true || $reply_object->reply_user == id_user))) && (($reply_object->reply_hid == 0) || ($reply_object->reply_hid == 1 && ($moderatget1 == true || $reply_object->reply_user == id_user)))) {

                        if ($reply_object->reply_delete == 1) {

                            $classreply = "topicd";

                            $terereply = "هذا الرد تم حذفه";
                        } elseif ($reply_object->reply_wait == 1) {

                            $classreply = "topicw";

                            $terereply = "هذا الرد لم تتم الموافقة عليه بعد";
                        } elseif ($reply_object->reply_hid == 1) {

                            $classreply = "topich";

                            $terereply = "هذا الرد تم إخفائه  -- للإستفسار عن السبب الرجاء الإتصال بمشرف المنتدى";
                        } else {

                            $classreply = "topicn";

                            $terereply = "";
                        }

                        echo "<tr align=\"center\"><td class=\"tcot\" colspan=\"2\">";

                        echo "<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" align=\"center\"><tr>";

                        echo "<td>" . img_other("arab-forums", "images/date.png", "", "", "", "0", "", "") . "</td>";

                        echo "<td>&nbsp;&nbsp;</td>";

                        echo "<td>" . ($reply_object->reply_date != "" ? "<nobr>" . times_date("arab-forums", "", $reply_object->reply_date) . "</nobr>" : "") . "</td>";

                        echo "<td width=\"100%\"></td>";

                        echo "<td class=\"menu\">" . a_other("arab-forums", "profile.php?id={$reply_object->user_id}", "مشاهدة بيانات {$reply_object->user_nameuser}", img_other("arab-forums", "images/profilt.png", "", "", "", "0", "", ""), "") . "</td>";

                        if (group_user > 0) {

                            echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&type=reply&value={$reply_object->reply_id}", "عرض هذا الرد فقط", img_other("arab-forums", "images/sign.png", "", "", "", "0", "", ""), "") . "</td>";

                            echo "<td class=\"menu\">" . a_other("arab-forums", "message.php?go=new&sendmy=" . id_user . "&sendto={$reply_object->user_id}&quote=2&qreply=" . codesql1_other("arab-forums", $reply_object->reply_id, 4) . "", "إرسال رسالة خاصة إلى {$reply_object->user_nameuser}", img_other("arab-forums", "images/mailuser.png", "", "", "", "0", "", ""), "") . "</td>";

                            if ($reply_object->user_id != id_user) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "notify.php?go=add&fort=reply&id={$reply_object->reply_id}", "لفت إنتباه المشرف إلى هذه المشاركة", img_other("arab-forums", "images/warningt.png", "", "", "", "0", "", ""), "") . "</td>";
                            }

                            if ($moderatget1 == true) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "message.php?go=new&sendmy=-{$topic_object->forum_id}&sendto={$reply_object->user_id}", "إرسال رسالة خاصه من إشراف المنتدى إلى {$reply_object->user_nameuser}", img_other("arab-forums", "images/mailforum.png", "", "", "", "0", "", ""), "") . "</td>";
                            }

                            if (($moderatget1 == true) || ($reply_object->reply_wait == 0 && $reply_object->reply_user == id_user)) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=editreply&value={$reply_object->reply_id}", "تعديل الرد", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";
                            }

                            echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=newreply&quote=2&qreply=" . codesql1_other("arab-forums", $reply_object->reply_id, 2) . "", "إقتباس لهذا الرد", img_other("arab-forums", "images/add.png", "", "", "", "0", "", ""), "") . "</td>";

                            echo "<td class=\"menu\">" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&type=user&value={$reply_object->reply_user}", "عرض ردود {$reply_object->user_nameuser} فقط", img_other("arab-forums", "images/user1.png", "", "", "", "0", "", ""), "") . "</td>";
                        }

                        if ($moderatget1 == true) {

                            echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=goedit", "التعديلات المقام بها على الرد", img_other("arab-forums", "images/edituu.png", "", "", "", "0", "", ""), "") . "</td>";

                            if ($reply_object->reply_wait == 1) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=wait", "الموافقة على الرد", img_other("arab-forums", "images/wait.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الرد ؟")) . "</td>";
                            }
                        }

                        if ($reply_object->reply_hid == 0 && ($moderatget1 == true || per_other("arab-forums", 4) == true)) {

                            echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=hid", "إخفاء الرد", img_other("arab-forums", "images/hid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء الرد ؟")) . "</td>";
                        }

                        if ($moderatget1 == true) {

                            if ($reply_object->reply_hid == 1) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=nohid", "إظهار الرد", img_other("arab-forums", "images/nohid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار الرد ؟")) . "</td>";
                            }

                            if ($reply_object->reply_top == 0) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=top", "تمييز الرد", img_other("arab-forums", "images/replytop.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تمييز الرد ؟")) . "</td>";
                            } else {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=notop", "إزالة تمييز الرد", img_other("arab-forums", "images/replynotop.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إزالة تمييز الرد ؟")) . "</td>";
                            }

                            if ($reply_object->reply_img == 0) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=img", "إخفاء صور الرد", img_other("arab-forums", "images/img.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء صور الرد ؟")) . "</td>";
                            } else {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=noimg", "إظهار صور الرد", img_other("arab-forums", "images/noimg.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار صور الرد ؟")) . "</td>";
                            }

                            if ($reply_object->reply_url == 0) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=url", "إخفاء روابط الرد", img_other("arab-forums", "images/url.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء روابط الرد ؟")) . "</td>";
                            } else {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=nourl", "إظهار روابط الرد", img_other("arab-forums", "images/nourl.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار روابط الرد ؟")) . "</td>";
                            }
                        }

                        if ($reply_object->reply_delete == 0 && (($moderatget1 == true && per_other("arab-forums", 3) == true) || ($reply_object->reply_user == id_user))) {

                            echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=delete", "حذف الرد", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الرد ؟")) . "</td>";
                        }

                        if ($moderatget1 == true) {

                            if ($reply_object->reply_delete == 1) {

                                echo "<td class=\"menu\">" . a_other("arab-forums", "optionreply.php?id={$reply_object->reply_id}&go=nodelete", "إرجاع الرد", img_other("arab-forums", "images/nodelete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع الرد ؟")) . "</td>";
                            }

                            echo "<td class=\"menu\"><input onclick=\"check1(this, '{$reply_object->reply_id}' , 'topice {$classreply} topic' , 'الرد' , 'topice select topic');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الرد\" value=\"{$reply_object->reply_id}\"><input type=\"hidden\" name=\"bg_{$reply_object->reply_id}\" id=\"bg_{$reply_object->reply_id}\" value=\"topice {$classreply} topic\"></td>";
                        }

                        echo "</tr></table>";

                        echo "</td></tr>";

                        echo "<tr align=\"center\"><td class=\"topice topics topic\" width=\"16%\" valign=\"top\">";

                        echo "<div class=\"textw1 paddse\"><strong><nobr>" . user_other("arab-forums", array($reply_object->user_id, $reply_object->user_group, $reply_object->user_nameuser, $reply_object->user_lock1, $reply_object->user_coloruser, false)) . "</nobr></strong></div>";

                        if (group_user > 0) {

                            if ($reply_object->user_lock1 == 1) {

                                echo "<div class=\"paddse textw2\">عضوية مغلوقة</div>";
                            } else {

                                echo "<div class=\"paddse textw3\">المشاركات : " . num_other("arab-forums", $reply_object->user_post) . "</div>";

                                echo "<div class=\"paddse textw5\">نقاط التميز : " . num_other("arab-forums", $reply_object->user_point) . "</div>";

                                $startuser = star_other("arab-forums", array($reply_object->user_colorstar, $reply_object->user_group, $reply_object->user_post));

                                if ($startuser != "") {

                                    echo "<div class=\"paddse\">" . $startuser . "</div>";
                                }

                                if ($topic_object->forum_wasafreply == 1) {

                                    $titlemonitor1 = titlemonitor1_other("arab-forums", $reply_object->user_id, $reply_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                                    $titlemonitor2 = titlemonitor2_other("arab-forums", $reply_object->user_id, $reply_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                                    $titlemodirater = titlemodirater_other("arab-forums", $reply_object->user_id, $reply_object->user_sex, "<div class=\"paddse textw3\">", "</div>");

                                    if ($titlemonitor1 == "" && $titlemonitor2 == "" && $titlemodirater == "") {

                                        if ($reply_object->user_titleold == 0) {

                                            echo "<div class=\"paddse textw3\">" . title_other("arab-forums", array($reply_object->user_sex, $reply_object->user_group, $reply_object->user_post)) . "</div>";
                                        } else {

                                            echo "<div class=\"paddse textw3\">" . ($reply_object->user_sex == 1 ? $sex1titleold_list[$reply_object->user_titleold] : $sex2titleold_list[$reply_object->user_titleold]) . "</div>";
                                        }
                                    } else {

                                        echo $titlemonitor1;

                                        echo $titlemonitor2;

                                        echo $titlemodirater;
                                    }

                                    echo titlewasaf_other("arab-forums", $reply_object->user_id, false, $topic_object->forum_id, "<div class=\"paddse textw3\">", "</div>");
                                }

                                if ($topic_object->forum_photoreply == 1) {

                                    echo "<div class=\"padpho paddse\">" . img_other("arab-forums", "{$reply_object->user_photo}", "", "100", "", "0", "", ($reply_object->user_sex == 2 ? "images/sex2.png" : "images/sex1.png")) . "</div>";
                                }

                                if ($topic_object->forum_detailreply == 1) {

                                    echo "<div class=\"paddse textw3\">الدولة : " . ($reply_object->user_country == "" ? "غير محددة" : country_other("arab-forums", $reply_object->user_country)) . "</div>";

                                    echo "<div class=\"paddse textw3\"><nobr>عدد الأيام مند الإنضمام : " . totaldays_other("arab-forums", $reply_object->user_dateregister) . "</nobr></div>";

                                    echo "<div class=\"paddse textw3\"><nobr>معدل المشاركات في اليوم : " . middleposts_other("arab-forums", $reply_object->user_post, $reply_object->user_dateregister) . "</nobr></div>";
                                }

                                if (num_mysql("arab-forums", select_mysql("arab-forums", "online", "online_userid", "where online_userid in(" . $reply_object->user_id . ") limit 1")) == true) {

                                    echo "<div class=\"paddse\">" . img_other("arab-forums", "images/online.gif", "{$reply_object->user_nameuser} " . ($reply_object->user_sex == 1 ? "متصل" : "متصلة") . " حاليا", "", "", "0", "class=\"title\"", "") . "</div>";
                                } else {

                                    echo "<div class=\"paddse\">" . img_other("arab-forums", "images/offline.gif", "{$reply_object->user_nameuser} " . ($reply_object->user_sex == 1 ? "غير متصل" : "غير متصلة") . " حاليا", "", "", "0", "class=\"title\"", "") . "</div>";
                                }
                            }
                        }

                        if ($reply_object->reply_top == 1) {

                            $topclass = "replyclass";
                        } else {

                            $topclass = "";
                        }

                        echo "</td><td class=\"topice {$classreply} topic {$topclass}\" id=\"tr_{$reply_object->reply_id}\" width=\"84%\" valign=\"top\">";

                        if ($terereply != "") {

                            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\"><tr><td width=\"100%\" class=\"tcot\" align=\"center\"><div class=\"pad\">{$terereply}</div></td></tr></table><br>";
                        }

                        echo "<table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

                        if (group_user == 0 && $topic_object->forum_visitorreplyshow == 0) {

                            echo "<br><table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\"><tr><td width=\"100%\" class=\"tcot\" align=\"center\"><div class=\"pad\">للأسف تم منع الزوار من مشاهدة محتوى الردود في هذا المنتدى</div></td></tr></table><br>";
                        } else {

                            echo urlimghids_other("arab-forums", messagereplase_other("arab-forums", $reply_object->reply_message, $topic_object->forum_id), $reply_object->reply_url, $reply_object->reply_img, $topic_object->forum_urlshowreply, $totalreplyu, $moderatget1, $topic_object->reply_user);
                        }

                        echo "</td></tr></table>";

                        if (group_user > 1) {

                            $optionreply_sql = select_mysql("arab-forums", "optionreply", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , o.optionreply_id , o.optionreply_replyid , o.optionreply_date , o.optionreply_user , o.optionreply_type", "as o left join user" . prefix_connect . " as u on(u.user_id = o.optionreply_user) where o.optionreply_replyid in({$reply_object->reply_id}) order by o.optionreply_date desc");

                            if (num_mysql("arab-forums", $optionreply_sql) != false) {

                                echo "<hr><table style=\"table-layout:fixed;\">";

                                while ($optionreply_object = object_mysql("arab-forums", $optionreply_sql)) {

                                    echo "<tr><td width=\"100%\"></td><td class=\"optionget\"><nobr>(" . times_date("arab-forums", "", $optionreply_object->optionreply_date) . ") - تم {$option_list[$optionreply_object->optionreply_type]} الرد بواسطة " . user_other("arab-forums", array($optionreply_object->user_id, $optionreply_object->user_group, $optionreply_object->user_nameuser, $optionreply_object->user_lock1, $optionreply_object->user_coloruser, false)) . "</nobr></td></tr>";
                                }

                                echo "</table>";
                            }
                        }

                        if (group_user > 0) {

                            $siguser = messagereplase_other("arab-forums", $reply_object->user_sig, "0");

                            if ($topic_object->forum_sigreply == 1 && forum_tawa9i3 == 1 && $siguser != "") {

                                echo "<table style=\"table-layout:fixed;\" align=\"center\" width=\"100%\"><tr><td><fieldset><legend>&nbsp;<font color=\"black\">التوقيع</font></legend>{$siguser}</fieldset></td></tr></table>";
                            }
                        }

                        echo "</td></tr>";
                    }
                }
            }

            if ($moderatget1 == true) {

                echo "</form>";
            }

            if (group_user > 0 && (($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0) || ($topic_object->topic_wait == 0 && num_mysql("arab-forums", select_mysql("arab-forums", "locktopic", "locktopic_userid , locktopic_topicid", "where locktopic_userid in(" . id_user . ") && locktopic_topicid in({$topic_object->topic_id}) limit 1")) != false))) {

                echo "<form method=\"post\" action=\"topic.php?id={$topic_object->topic_id}&go=newreply&editor=true\"><input type=\"hidden\" name=\"howde\" value=\"speed\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"2\"><div class=\"pad\">أضف رد سريع</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"ttopityr\" colspan=\"2\"><textarea class=\"textarea\" name=\"message\" style=\"width:97%;height:200;font-weight:" . editorblod_user . ";text-align:" . editoralign_user . ";font-family:" . editorfont_user . ";font-size:" . editorsize_user . ";color:" . editorcolor_user . "\" rows=\"6\"></textarea></td></tr>";

                echo "<tr><td class=\"ttopityr\" colspan=\"2\" align=\"center\"><div class=\"pad\">";

                echo "<input type=\"submit\" class=\"button\" value=\"أضف الرد للموضوع\">";

                if ($moderatget1 == true) {

                    echo "&nbsp;+&nbsp;<select class=\"inputselect\" name=\"option\">";

                    echo "<option value=\"\">-- إختر خيار من القائمة --</option>";

                    if ($topic_object->topic_wait == 1) {

                        echo "<option value=\"wait\">الموافقة على الموضوع</option>";
                    }

                    if ($topic_object->topic_lock == 0) {

                        echo "<option value=\"lock\">غلق الموضوع</option>";
                    } elseif ($topic_object->topic_lock == 1) {

                        echo "<option value=\"nolock\">فتح الموضوع</option>";
                    }

                    if ($topic_object->topic_hid == 0) {

                        echo "<option value=\"hid\">إخفاء الموضوع</option>";
                    } elseif ($topic_object->topic_hid == 1) {

                        echo "<option value=\"nohid\">إظهار الموضوع</option>";
                    }

                    if ($topic_object->topic_stiky == 1) {

                        echo "<option value=\"nostiky\">إزالة تثبيث الموضوع</option>";
                    } elseif ($topic_object->topic_stiky == 0) {

                        echo "<option value=\"stiky\">تثبيث الموضوع</option>";
                    }

                    echo "</select>";
                }

                echo "</div></td></tr>";

                echo "</form>";
            }

            echo $titletemplate;

            echo "</table>";

            echo "<br>" . $topictemplate;

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    }
} else {

    define("pagebody", "topic");

    online_other("arab-forums", "topic", "0", "0", "0", "0");

    $arraymsg = array(

        "login" => true,

        "msg" => "لا يمكنك الدخول إلى الموضوع و السبب <br><br>{$errorop}",

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
