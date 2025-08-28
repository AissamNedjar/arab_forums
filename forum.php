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

$forum_sql = select_mysql("arab-forums", "forum", "count(distinct o.online_ip) as forum_online , o.online_type , o.online_forumid , c.cat_id , c.cat_lock , c.cat_hid , c.cat_name , c.cat_monitor1 , c.cat_monitor2 , c.cat_group" . group_user . " , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_logo , f.forum_moderattext , f.forum_totaltopic , f.forum_sex , f.forum_group" . group_user . " , f.forum_mode , c.cat_post1 , c.cat_post2 , c.cat_post3 , c.cat_post4 , c.cat_post5 , c.cat_post6 , f.forum_post1 , f.forum_post2 , f.forum_post3 , f.forum_post4 , f.forum_post5 , f.forum_post6 , f.forum_moderattopic", "as f left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) left join online" . prefix_connect . " as o on(o.online_forumid = f.forum_id) where f.forum_id in(" . id . ") && c.cat_group" . group_user . " in(1) && f.forum_group" . group_user . " in(1) group by f.forum_id limit 1");

if (num_mysql("arab-forums", $forum_sql) == false) {

    $errorop = "رقم المنتدى خاطئ";
} else {

    $forum_object = object_mysql("arab-forums", $forum_sql);

    if ($forum_object->cat_hid == true && cathide_other("arab-forums", $forum_object->cat_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2) == false) {

        $errorop = "المنتدى تابع لفئة مخفية";
    } elseif ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums", $forum_object->forum_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2, $forum_object->forum_mode) == false) {

        $errorop = "المنتدى مخفي";
    } elseif ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums", $forum_object->cat_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2, $forum_object->forum_mode) == false) {

        $errorop = "المنتدى مخفي";
    } else {

        $errorop = "";
    }
}

if ($errorop == "") {

    $moderatget1 = moderatget1_other("arab-forums", $forum_object->forum_id, $forum_object->cat_monitor1, $forum_object->cat_monitor2, $forum_object->forum_mode);

    $moderatget2 = moderatget2_other("arab-forums", $forum_object->cat_monitor1, $forum_object->cat_monitor2);

    if (go == "newtopic") {

        $catpost = array("0", $forum_object->cat_post1, $forum_object->cat_post2, $forum_object->cat_post3, $forum_object->cat_post4, $forum_object->cat_post5, $forum_object->cat_post6);

        $forumpost = array("0", $forum_object->forum_post1, $forum_object->forum_post2, $forum_object->forum_post3, $forum_object->forum_post4, $forum_object->forum_post5, $forum_object->forum_post6);

        $totaltopicsnew = num_mysql("arab-forums", select_mysql("arab-forums", "topic", "topic_forumid , topic_date , topic_user", "where topic_user in(" . id_user . ") && topic_forumid in({$forum_object->forum_id}) && topic_date > \"" . (time() - (60 * 60 * 24)) . "\""));

        if (group_user == 0) {

            $errorop = "المشاركة للأعضاء المسجلين فقط";
        } elseif ($forum_object->cat_lock == 1 && $moderatget1 == false) {

            $errorop = "الفئة مغلوقة";
        } elseif ($forum_object->forum_lock == 1 && $moderatget1 == false) {

            $errorop = "المنتدى مغلوق";
        } elseif ($catpost[group_user] == 0 && $moderatget1 == false) {

            $errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذه الفئة";
        } elseif ($forumpost[group_user] == 0 && $moderatget1 == false) {

            $errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذا المنتدى";
        } elseif ($forum_object->forum_sex == 1 && sex_user == 2 && $moderatget1 == false) {

            $errorop = "المشاركة للذكور فقط";
        } elseif ($forum_object->forum_sex == 2 && sex_user == 1 && $moderatget1 == false) {

            $errorop = "المشاركة للإيناث فقط";
        } elseif ($totaltopicsnew >= $forum_object->forum_totaltopic && $moderatget1 == false) {

            $errorop = "تجاوزت الحد المسموح من المواضيع لك اليوم";
        } else {

            $errorop = "";
        }

        if ($errorop == "") {

            define("pagebody", "newtopic");

            online_other("arab-forums", "newtopic", $forum_object->cat_id, $forum_object->forum_id, "0", "0");

            if (editor == "true") {

                $editor_sizetext = text_other("arab-forums", post_other("arab-forums", "message"), true, true, true, true, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", post_other("arab-forums", "message")), false, true, false, false, true);

                $editor_title = text_other("arab-forums", post_other("arab-forums", "title"), true, true, true, false, true);

                if (mb_strlen($editor_title) < 5 || mb_strlen($editor_title) > 400) {

                    $erroreditor = "العنوان يجب أن يكون أطول من 5 حروف و أقل من 300 حرف";
                } elseif (mb_strlen($editor_sizetext) < 3) {

                    $erroreditor = "محتوى النص قصير جدا";
                } elseif (datelastpost_user >= (time() - 3)) {

                    $erroreditor = "محاولة إدخال عدة مواضيع في نفس الوقت";
                } else {

                    $erroreditor = "";
                }

                if ($erroreditor == "") {

                    if (totalpost_option >= post_user && $moderatget1 == false) {

                        $getwait = true;
                    } elseif ($forum_object->forum_moderattopic == 1 && $moderatget1 == false) {

                        $getwait = true;
                    } else {

                        $getwait = false;
                    }

                    if ($getwait == true) {

                        $waitinsert = "1";

                        $msginsert = "تم إدخال الموضوع بنجاح تام لآكن يحتاج موافقة الإشراف";
                    } else {

                        $waitinsert = "0";

                        $msginsert = "تم إدخال الموضوع بنجاح تام";
                    }

                    if ($moderatget1 == true) {

                        $lock = text_other("arab-forums", post_other("arab-forums", "lock"), true, true, true, true, true);

                        $hid = text_other("arab-forums", post_other("arab-forums", "hid"), true, true, true, true, true);

                        $stiky = text_other("arab-forums", post_other("arab-forums", "stiky"), true, true, true, true, true);

                        $top = text_other("arab-forums", post_other("arab-forums", "top"), true, true, true, true, true);

                        $mofr = ", topic_lock , topic_hid , topic_stiky , topic_top";

                        $mofg = ", \"{$lock}\" , \"{$hid}\" , \"{$stiky}\" , \"{$top}\"";
                    } else {

                        $mofr = "";

                        $mofg = "";
                    }

                    insert_mysql("arab-forums", "topic", "topic_id , topic_forumid , topic_wait {$mofr} , topic_date , topic_user , topic_lastdate , topic_name , topic_message", "null , \"{$forum_object->forum_id}\" , \"{$waitinsert}\" {$mofg} , \"" . time() . "\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$editor_title}\" , \"{$editor_message}\"");

                    $insert = mysql_insert_id();

                    update_mysql("arab-forums", "forum", "forum_topic = forum_topic+1 , forum_lastdate = \"" . time() . "\" , forum_lastuser = \"" . id_user . "\" where forum_id in({$forum_object->forum_id})");

                    update_mysql("arab-forums", "user", "user_post = user_post+1 , user_topics = user_topics+1 , user_datelastpost = \"" . time() . "\" where user_id in(" . id_user . ")");

                    if ($moderatget1 == true) {

                        if ($lock == "1") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$insert}\" , \"" . id_user . "\" , \"" . time() . "\" , \"lock\"");
                        }

                        if ($hid == "1") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$insert}\" , \"" . id_user . "\" , \"" . time() . "\" , \"hid\"");
                        }

                        if ($stiky == "1") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$insert}\" , \"" . id_user . "\" , \"" . time() . "\" , \"stiky\"");
                        }

                        if ($top == "1") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$insert}\" , \"" . id_user . "\" , \"" . time() . "\" , \"top1\"");
                        } elseif ($top == "2") {

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$insert}\" , \"" . id_user . "\" , \"" . time() . "\" , \"top2\"");
                        }
                    }

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $msginsert . " > شكرا لك على المشاركة معانا",

                        "color" => "good",

                        "old" => true,

                        "auto" => true,

                        "text" => "أنقر هنا للذهاب إلى المنتدى",

                        "url" => "forum.php?id={$forum_object->forum_id}",

                        "array" => array("أنقر هنا للذهاب إلى الموضوع", "topic.php?id={$insert}", "أنقر هنا للذهاب إلى الصفحة الرئيسية", "home.php"),

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "لا يمكنك إدخال الموضوع و السبب <br><br>{$erroreditor}",

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

                echo bodytop_template("arab-forums", $forum_object->forum_name . " | موضوع جديد");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                $arrayeditor = array(

                    "mode" => $moderatget1,

                    "appc" => 1,

                    "mose" => array("0", "0", "0", "0"),

                    "forum" => true,

                    "admin" => false,

                    "img" => img_other("arab-forums", "{$forum_object->forum_logo}", "", "50", "50", "0", "", ""),

                    "opr" => a_other("arab-forums", "forum.php?id={$forum_object->forum_id}", "{$forum_object->forum_name} - موضوع جديد", "{$forum_object->forum_name} - موضوع جديد", ""),

                    "trother" => "",

                    "text" => "إضافة موضوع جديد",

                    "url" => "forum.php?id={$forum_object->forum_id}&go=newtopic&",

                    "message" => "",

                    "type" => "newtopic",

                    "title" => "",

                    "other" => "عدد المواضيع<br>الجديدة المتبقية<br>لك في هذا المنتدى<br>هو : <span style=\"color:red;\">" . ($moderatget1 == true ? "غير محدود" : ($forum_object->forum_totaltopic - $totaltopicsnew)) . "</span>",

                );

                echo editor_template("arab-forums", $arrayeditor);

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            define("pagebody", "newtopic");

            online_other("arab-forums", "newtopic", "0", "0", "0", "0");

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك المشاركة في المنتدى و السبب<br><br>{$errorop}",

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

        define("pagebody", "forum");

        online_other("arab-forums", "forum", $forum_object->cat_id, $forum_object->forum_id, "0", "0");

        $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

        $allyp  = text_other("arab-forums", post_other("arab-forums", "allyp"), true, true, true, true, false);

        $gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

        $import = @implode(",", $allyu);

        if (isset($gets) && $moderatget1 == true) {

            if ($allyu == 0) {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء تحديد موضوع وآحد على الأقل",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                if ($allyp == "lock") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_lock in(0)",

                        "update" => "topic_lock = \"1\"",

                        "text1" => "غلق",

                        "text2" => "مفتوح",

                        "text3" => "غلقه",

                        "option" => "lock",

                    );
                } elseif ($allyp == "nolock") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_lock = \"1\"",

                        "update" => "topic_lock = \"0\"",

                        "text1" => "فتح",

                        "text2" => "مغلوق",

                        "text3" => "فتحه",

                        "option" => "nolock",

                    );
                } elseif ($allyp == "wait") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_wait in(1)",

                        "update" => "topic_wait = \"0\"",

                        "text1" => "الموافقة على",

                        "text2" => "ينتظر الموافقة",

                        "text3" => "الموافقة عليه",

                        "option" => "wait",

                    );
                } elseif ($allyp == "hid") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_hid in(0)",

                        "update" => "topic_hid = \"1\"",

                        "text1" => "إخفاء",

                        "text2" => "ظاهر",

                        "text3" => "إخفائه",

                        "option" => "hid",

                    );
                } elseif ($allyp == "nohid") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_hid in(1)",

                        "update" => "topic_hid = \"0\"",

                        "text1" => "إظهار",

                        "text2" => "مخفي",

                        "text3" => "إظهاره",

                        "option" => "nohid",

                    );
                } elseif ($allyp == "stiky") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_stiky in(0)",

                        "update" => "topic_stiky = \"1\"",

                        "text1" => "تثبيث",

                        "text2" => "غير مثبث",

                        "text3" => "تثبيثه",

                        "option" => "stiky",

                    );
                } elseif ($allyp == "nostiky") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_stiky in(1)",

                        "update" => "topic_stiky = \"0\"",

                        "text1" => "إزالة تثبيث",

                        "text2" => "مثبث",

                        "text3" => "إزالة تثبيثه",

                        "option" => "nostiky",

                    );
                } elseif ($allyp == "top0") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_top > \"0\"",

                        "update" => "topic_top = \"0\"",

                        "text1" => "إزالة تمييز",

                        "text2" => "مميز",

                        "text3" => "إزالة تمييزه",

                        "option" => "top0",

                    );
                } elseif ($allyp == "top1") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_top in(0,2)",

                        "update" => "topic_top = \"1\"",

                        "text1" => "تمييز بنجمة",

                        "text2" => "غير مميز بنجمة",

                        "text3" => "تميزه بنجمة",

                        "option" => "top1",

                    );
                } elseif ($allyp == "top2") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_top in(0,1)",

                        "update" => "topic_top = \"2\"",

                        "text1" => "تمييز بميدالية",

                        "text2" => "غير مميز بميدالية",

                        "text3" => "تميزه بميدالية",

                        "option" => "top2",

                    );
                } elseif ($allyp == "link0") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_link > \"0\"",

                        "update" => "topic_link = \"0\"",

                        "text1" => "إزالة من الوصلات",

                        "text2" => "موجود في الوصلات",

                        "text3" => "إزالته من الوصلات",

                        "option" => "link0",

                    );
                } elseif ($allyp == "link1") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_link in(0,2)",

                        "update" => "topic_link = \"1\"",

                        "text1" => "جعل كوصلة عادية",

                        "text2" => "غير موجود في الوصلات العادية",

                        "text3" => "وضعه في الوصلات العادية",

                        "option" => "link1",

                    );
                } elseif ($allyp == "link2") {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_link in(0,1)",

                        "update" => "topic_link = \"2\"",

                        "text1" => "جعل كوصلة أساسية",

                        "text2" => "غير موجود في الوصلات الأساسية",

                        "text3" => "وضعه في الوصلات الأساسية",

                        "option" => "link2",

                    );
                } elseif ($allyp == "delete" && per_other("arab-forums", 2) == true) {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_delete in(0)",

                        "update" => "topic_delete = \"1\"",

                        "text1" => "حذف",

                        "text2" => "غير محذوف",

                        "text3" => "حذفه",

                        "option" => "delete",

                    );
                } elseif ($allyp == "nodelete" && $moderatget2 == true) {

                    $option_im = array(

                        "true" => true,

                        "select" => "topic_delete = \"1\"",

                        "update" => "topic_delete = \"0\"",

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

                    $im_sql = select_mysql("arab-forums", "topic", "topic_top , topic_user , topic_id , topic_forumid , topic_lock , topic_delete , topic_hid , topic_stiky , topic_link , topic_wait", "where topic_id in({$import}) && {$option_im["select"]}");

                    if (num_mysql("arab-forums", $im_sql) != false) {

                        while ($im_object = object_mysql("arab-forums", $im_sql)) {

                            update_mysql("arab-forums", "topic", "{$option_im["update"]} where topic_id in({$im_object->topic_id}) limit 1");

                            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$im_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$option_im["option"]}\"");

                            if ($option_im["option"] == "delete") {

                                update_mysql("arab-forums", "forum", "forum_topic = forum_topic-1 where forum_id in({$im_object->topic_forumid})");

                                update_mysql("arab-forums", "user", "user_post = user_post-1 , user_topics = user_topics-1 where user_id in({$im_object->topic_user})");
                            } elseif ($option_im["option"] == "nodelete") {

                                update_mysql("arab-forums", "forum", "forum_topic = forum_topic+1 where forum_id in({$im_object->topic_forumid})");

                                update_mysql("arab-forums", "user", "user_post = user_post+1 , user_topics = user_topics+1 where user_id in({$im_object->topic_user})");
                            }
                        }

                        $arraymsg = array(

                            "login" => true,

                            "msg" => "تم {$option_im["text1"]} المواضيع المحددة بنجآح تآم",

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

                            "msg" => "عفوا لم تختر أي موضوع {$option_im["text2"]} ليتم {$option_im["text3"]}",

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

            echo bodytop_template("arab-forums", $forum_object->forum_name);

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            if (forum_topictartib1 == "post") {

                $tartib1 = "t.topic_lastdate";
            } elseif (forum_topictartib1 == "date") {

                $tartib1 = "t.topic_date";
            } elseif (forum_topictartib1 == "topic") {

                $tartib1 = "t.topic_name";
            } elseif (forum_topictartib1 == "user") {

                $tartib1 = "t.topic_user";
            } elseif (forum_topictartib1 == "reply") {

                $tartib1 = "t.topic_reply";
            } elseif (forum_topictartib1 == "visit") {

                $tartib1 = "t.topic_visit";
            } else {

                $tartib1 = "t.topic_lastdate";
            }

            $tartib2 = forum_topictartib2;

            $tartib3 = forum_topictartib3;

            if (type == "user" && is_numeric(value) && group_user > 0) {

                $user_sql = select_mysql("arab-forums", "user", "user_id , user_sex , user_lock1 , user_group , user_nameuser , user_coloruser , user_wait , user_bad", "where user_id in(" . value . ") && user_wait in(0) && user_bad in(0) limit 1");

                if (num_mysql("arab-forums", $user_sql) != false) {

                    $user_object = object_mysql("arab-forums", $user_sql);

                    $typetopic1 = "&& t.topic_delete in(0) && t.topic_user in({$user_object->user_id})";

                    $typetopic2 = "&& topic_delete in(0) && topic_user in({$user_object->user_id})";

                    $typetopic3 = array(true, ($user_object->user_id == id_user ? "تعرض حاليا مواضيعك" : "تعرض حاليا مواضيع " . ($user_object->user_sex == 1 ? "العضو" : "") . " " . user_other("arab-forums", array($user_object->user_id, $user_object->user_group, $user_object->user_nameuser, $user_object->user_lock1, $user_object->user_coloruser, false)) . ""));

                    $typetopic4 = "&type=user&value={$user_object->user_id}";
                } else {

                    $typetopic1 = "&& t.topic_delete in(0)";

                    $typetopic2 = "&& topic_delete in(0)";

                    $typetopic3 = array(false, "");

                    $typetopic4 = "";
                }
            } elseif (type == "lock" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_lock in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_lock in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المغلوقة");

                $typetopic4 = "&type=lock";
            } elseif (type == "nolock" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_lock in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_lock in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الفتوحة");

                $typetopic4 = "&type=nolock";
            } elseif (type == "wait" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_wait in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_wait in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع التي تنتظر الموافقة");

                $typetopic4 = "&type=wait";
            } elseif (type == "nowait" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_wait in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_wait in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الموافق عليها");

                $typetopic4 = "&type=nowait";
            } elseif (type == "hid" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_hid in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_hid in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المخفية");

                $typetopic4 = "&type=hid";
            } elseif (type == "nohid" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_hid in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_hid in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الظاهرة");

                $typetopic4 = "&type=nohid";
            } elseif (type == "stiky" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_stiky in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_stiky in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المثبثة");

                $typetopic4 = "&type=stiky";
            } elseif (type == "nostiky" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_stiky in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_stiky in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الغير مثبثة");

                $typetopic4 = "&type=nostiky";
            } elseif (type == "top0" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_top in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_top in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الغير مميزة");

                $typetopic4 = "&type=top0";
            } elseif (type == "top1" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_top in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_top in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المميزة بنجمة");

                $typetopic4 = "&type=top1";
            } elseif (type == "top2" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_top in(2)";

                $typetopic2 = "&& topic_delete in(0) && topic_top in(2)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المميزة بميدالية");

                $typetopic4 = "&type=top2";
            } elseif (type == "link0" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_link in(0)";

                $typetopic2 = "&& topic_delete in(0) && topic_link in(0)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع الغير مجعولة كوصلة");

                $typetopic4 = "&type=link0";
            } elseif (type == "link1" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_link in(1)";

                $typetopic2 = "&& topic_delete in(0) && topic_link in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المجعولة كوصلة عادية");

                $typetopic4 = "&type=link1";
            } elseif (type == "link2" && $moderatget1 == true) {

                $typetopic1 = "&& t.topic_delete in(0) && t.topic_link in(2)";

                $typetopic2 = "&& topic_delete in(0) && topic_link in(2)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المجعولة كوصلة أساسية");

                $typetopic4 = "&type=link2";
            } elseif (type == "delete" && $moderatget2 == true) {

                $typetopic1 = "&& t.topic_delete in(1)";

                $typetopic2 = "&& topic_delete in(1)";

                $typetopic3 = array(true, "تعرض حاليا المواضيع المحذوفة");

                $typetopic4 = "&type=delete";
            } else {

                $typetopic1 = "&& t.topic_delete in(0)";

                $typetopic2 = "&& topic_delete in(0)";

                $typetopic3 = array(false, "");

                $typetopic4 = "";
            }

            if (forum_tahdit != 0) {

                echo "<meta http-equiv=\"refresh\" content=\"" . forum_tahdit . "; url=" . self . "\">";
            }

            if (group_user > 0) {

                echo "<table cellpadding=\"0\" cellspacing=\"3\" align=\"center\"><tr>";

                echo "<td class=\"menu\"><nobr><br><span style=\"color:#000000;font-size:12px;\">المتصلين في هذا<br>المنتدى حاليا : <span style=\"color:red;\">{$forum_object->forum_online}</span></span><br><br></nobr></td>";

                echo "</tr></table><br><br>";
            }

            echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            echo "<td>" . img_other("arab-forums", "{$forum_object->forum_logo}", "", "50", "50", "0", "", "") . "</td>";

            echo "<td width=\"100%\">" . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}", "{$forum_object->forum_name}", "{$forum_object->forum_name}", "") . "<div class=\"pad\">";

            if ($forum_object->forum_moderattext == 1) {

                if ($forum_object->forum_mode > 0) {
                    echo "<span style=\"color:#000000;font-size:11px;\">مجموعة " . $group_list[$forum_object->forum_mode] . "</span>";
                }

                $moderate_sql = select_mysql("arab-forums", "moderate", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , m.moderate_userid , m.moderate_lock , m.moderate_forumid", "as m left join user" . prefix_connect . " as u on(u.user_id = m.moderate_userid) where m.moderate_lock in(0) && m.moderate_forumid in({$forum_object->forum_id})");

                if (num_mysql("arab-forums", $moderate_sql) != false) {

                    $moderate = 0;

                    if ($forum_object->forum_mode > 0) {
                        echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";
                    }

                    while ($moderate_object = object_mysql("arab-forums", $moderate_sql)) {

                        if ($forum_object->forum_mode > 0) {

                            if ($moderate == 2) {
                                echo "<br>";
                                $moderate = 0;
                            }

                            if ($moderate) {
                                echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";
                            }
                        } else {

                            if ($moderate == 3) {
                                echo "<br>";
                                $moderate = 0;
                            }

                            if ($moderate) {
                                echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> ";
                            }
                        }

                        echo "<span style=\"font-size:11px;\">" . user_other("arab-forums", array($moderate_object->user_id, $moderate_object->user_group, $moderate_object->user_nameuser, $moderate_object->user_lock1, $moderate_object->user_coloruser, "000000")) . "</span>";

                        $moderate++;
                    }
                }
            }

            echo "</div></td>";

            echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "message.php?go=new&sendmy=" . id_user . "&sendto=-{$forum_object->forum_id}", "مراسلة إشراف المنتدى", img_other("arab-forums", "images/newmsg.png", "", "", "", "0", "", "") . "<br>المراسلة", "") . "</nobr></td>";

            echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}&go=newtopic", "موضوع جديد", img_other("arab-forums", "images/newtopic.png", "", "", "", "0", "", "") . "<br>موضوع جديد", "") . "</nobr></td>";

            if (group_user > 0) {

                echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "aboutforum.php?id={$forum_object->forum_id}", "معلومات عن المنتدى", img_other("arab-forums", "images/about.png", "", "", "", "0", "", "") . "<br>معلومات", "") . "</nobr></td>";
            }

            if ($moderatget1 == true) {

                $msgtotal = num_mysql("arab-forums", select_mysql("arab-forums", "message", "message_id , message_getid , message_reade , message_folder , message_delete", "where message_getid in(-{$forum_object->forum_id}) && message_reade in(0) && message_delete in(0) && message_folder in(-1)"));

                $notifytotal = num_mysql("arab-forums", select_mysql("arab-forums", "notify", "notify_id , notify_delete , notify_forumid", "where notify_delete in(0) && notify_forumid in({$forum_object->forum_id})"));

                echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "message.php?msgf={$forum_object->forum_id}", "بريد المنتدى", img_other("arab-forums", "images/mailer.png", "", "", "", "0", "", "") . "<br>البريد <span style=\"color:red;\">({$msgtotal})</span>", "") . "</nobr></td>";

                echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "notify.php?go=showall&fort=forum&id={$forum_object->forum_id}", "شكاوي المنتدى", img_other("arab-forums", "images/warning.png", "", "", "", "0", "", "") . "<br>الشكاوي <span style=\"color:red;\">({$notifytotal})</span>", "") . "</nobr></td>";
            }

            echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">تحديث الصفحة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

            echo "<option value=\"change.php?go=tahdit&value=0\" " . (forum_tahdit == 0 ? "selected" : "") . ">لا تحديث</option>";

            echo "<option value=\"change.php?go=tahdit&value=60\" " . (forum_tahdit == 60 ? "selected" : "") . ">كل دقيقة</option>";

            echo "<option value=\"change.php?go=tahdit&value=300\" " . (forum_tahdit == 300 ? "selected" : "") . ">كل 5 دقائق</option>";

            echo "<option value=\"change.php?go=tahdit&value=600\" " . (forum_tahdit == 600 ? "selected" : "") . ">كل 10 دقائق</option>";

            echo "<option value=\"change.php?go=tahdit&value=900\" " . (forum_tahdit == 900 ? "selected" : "") . ">كل 15 دقيقة</option>";

            echo "</select></div></td>";

            $count_page = $tartib3;

            $get_page = (page == "" || !is_numeric(page) ? 1 : page);

            $limit_page = (($get_page * $count_page) - $count_page);

            echo page_pager("arab-forums", "topic", "topic_id , topic_forumid , topic_delete , topic_lock , topic_hid , topic_wait , topic_user , topic_stiky , topic_top , topic_link", "where topic_forumid in({$forum_object->forum_id}) {$typetopic2}", $count_page, $get_page, "forum.php?id={$forum_object->forum_id}{$typetopic4}&");

            echo list_forumcatlist("arab-forums");

            echo "</tr></table>";

            echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            if ($moderatget1 == true) {

                echo "<td><select class=\"inputselect\" onchange=\"getst(this)\">";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}\" selected>الإنتقال إلى خدمات المنتدى</option>";

                echo "<option value=\"service.php?gert=iconstopic&go=iconstopic_list&value={$forum_object->forum_id}\">الإنتقال إلى أيقونات المواضيع</option>";

                echo "<option value=\"service.php?gert=texttopic&go=texttopic_list&value={$forum_object->forum_id}\">الإنتقال إلى إختصارات المواضيع</option>";

                echo "<option value=\"service.php?gert=topicreply&go=topicreply_order&value={$forum_object->forum_id}\">الإنتقال إلى ترتيب وصلات المواضيع</option>";

                echo "<option value=\"service.php?gert=topicreply&go=topicreply_topicwait&value={$forum_object->forum_id}\">الإنتقال إلى المواضيع التي تنتظر الموافقة</option>";

                echo "<option value=\"service.php?gert=topicreply&go=topicreply_replywait&value={$forum_object->forum_id}\">الإنتقال إلى الردود التي تنتظر الموافقة</option>";

                echo "</select></td>";

                echo "<td><select class=\"inputselect\" onchange=\"getst(this)\">";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}\" " . (type == "" ? "selected" : "") . ">ع / جميع المواضيع</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=lock\" " . (type == "lock" ? "selected" : "") . ">ع / المواضيع المغلوقة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=nolock\" " . (type == "nolock" ? "selected" : "") . ">ع / المواضيع المفتوحة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=wait\" " . (type == "wait" ? "selected" : "") . ">ع / المواضيع التي تنتظر الموافقة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=nowait\" " . (type == "nowait" ? "selected" : "") . ">ع / المواضيع الموافق عليها</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=hid\" " . (type == "hid" ? "selected" : "") . ">ع / المواضيع المخفية</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=nohid\" " . (type == "nohid" ? "selected" : "") . ">ع / المواضيع الظاهرة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=stiky\" " . (type == "stiky" ? "selected" : "") . ">ع / المواضيع المثبثة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=nostiky\" " . (type == "nostiky" ? "selected" : "") . ">ع / المواضيع الغير مثبثة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=top1\" " . (type == "top1" ? "selected" : "") . ">ع / المواضيع المميزة بنجمة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=top2\" " . (type == "top2" ? "selected" : "") . ">ع / المواضيع المميزة بميدالية</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=top0\" " . (type == "top0" ? "selected" : "") . ">ع / المواضيع الغير مميزة</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=link1\" " . (type == "link1" ? "selected" : "") . ">ع / المواضيع المجعولة كوصلة عادية</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=link2\" " . (type == "link2" ? "selected" : "") . ">ع / المواضيع المجعولة كوصلة أساسية</option>";

                echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=link0\" " . (type == "link0" ? "selected" : "") . ">ع / المواضيع الغير مجعولة كوصلة</option>";

                if ($moderatget2 == true) {

                    echo "<option value=\"forum.php?id={$forum_object->forum_id}&type=delete\" " . (type == "delete" ? "selected" : "") . ">ع / المواضيع المحذوفة</option>";
                }

                echo "</select></td>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<td><select class=\"inputselect\" name=\"allyp\">";

                echo "<option value=\"lock\">غلق المواضيع المحددة</option>";

                echo "<option value=\"nolock\">فتح المواضيع المحددة</option>";

                echo "<option value=\"wait\">الموافقة على المواضيع المحددة</option>";

                echo "<option value=\"hid\">إخفاء المواضيع المحددة</option>";

                echo "<option value=\"nohid\">إظهار المواضيع المحددة</option>";

                echo "<option value=\"stiky\">تثبيث المواضيع المحددة</option>";

                echo "<option value=\"nostiky\">إلغاء تثبيث المواضيع المحددة</option>";

                echo "<option value=\"top0\">إزالة تمييز المواضيع المحددة</option>";

                echo "<option value=\"top1\">تمييز بنجمة المواضيع المحددة</option>";

                echo "<option value=\"top2\">تمييز بميدالية المواضيع المحددة</option>";

                echo "<option value=\"link0\">إزالة من الوصلات المواضيع المحددة</option>";

                echo "<option value=\"link1\">جعل كوصلة عادية المواضيع المحددة</option>";

                echo "<option value=\"link2\">جعل كوصلة أساسية المواضيع المحددة</option>";

                if (per_other("arab-forums", 2) == true) {

                    echo "<option value=\"delete\">حذف المواضيع المحددة</option>";
                }

                if ($moderatget2 == true) {

                    echo "<option value=\"nodelete\">إرجاع المواضيع المحددة</option>";
                }

                echo "</select></td>";

                echo "<td><nobr><input class=\"button\" value=\"تطبيق\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد التطبيق على المواضيع المحددة ؟") . "></nobr></td>";
            }

            echo "<td width=\"100%\"></td>";

            echo "<td><select class=\"inputselect\" onchange=\"relext(this)\">";

            echo "<option value=\"change.php?go=topictartib1&value=post\" " . (forum_topictartib1 == "post" ? "selected" : "") . ">آخر مشاركة</option>";

            echo "<option value=\"change.php?go=topictartib1&value=date\" " . (forum_topictartib1 == "date" ? "selected" : "") . ">تاريخ الموضوع</option>";

            echo "<option value=\"change.php?go=topictartib1&value=topic\" " . (forum_topictartib1 == "topic" ? "selected" : "") . ">عنوان الموضوع</option>";

            echo "<option value=\"change.php?go=topictartib1&value=user\" " . (forum_topictartib1 == "user" ? "selected" : "") . ">كاتب الموضوع</option>";

            echo "<option value=\"change.php?go=topictartib1&value=reply\" " . (forum_topictartib1 == "reply" ? "selected" : "") . ">ردود الموضوع</option>";

            echo "<option value=\"change.php?go=topictartib1&value=visit\" " . (forum_topictartib1 == "visit" ? "selected" : "") . ">مشاهدات الموضوع</option>";

            echo "</select></td>";

            echo "<td><select class=\"inputselect\" onchange=\"relext(this)\">";

            echo "<option value=\"change.php?go=topictartib2&value=desc\" " . (forum_topictartib2 == "desc" ? "selected" : "") . ">الأكبر للأصغر</option>";

            echo "<option value=\"change.php?go=topictartib2&value=asc\" " . (forum_topictartib2 == "asc" ? "selected" : "") . ">الأصغر للأكبر</option>";

            echo "</select></td>";

            echo "<td><select class=\"inputselect\" onchange=\"relext(this)\">";

            echo "<option value=\"change.php?go=topictartib3&value=30\" " . (forum_topictartib3 == "30" ? "selected" : "") . ">30 موضوع</option>";

            echo "<option value=\"change.php?go=topictartib3&value=40\" " . (forum_topictartib3 == "40" ? "selected" : "") . ">40 موضوع</option>";

            echo "<option value=\"change.php?go=topictartib3&value=50\" " . (forum_topictartib3 == "50" ? "selected" : "") . ">50 موضوع</option>";

            echo "<option value=\"change.php?go=topictartib3&value=60\" " . (forum_topictartib3 == "60" ? "selected" : "") . ">60 موضوع</option>";

            echo "</select></td>";

            echo "</tr></table>";

            $link_sql = select_mysql("arab-forums", "topic", "topic_id , topic_forumid , topic_name , topic_wait , topic_delete , topic_hid , topic_link ,  topic_linkorder", "where topic_forumid in({$forum_object->forum_id}) && topic_wait in(0) && topic_delete in(0) && topic_hid in(0) && topic_link in(1,2) order by topic_linkorder asc");

            if (num_mysql("arab-forums", $link_sql) != false) {

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                while ($link_object = object_mysql("arab-forums", $link_sql)) {

                    echo "<td class=\"" . ($link_object->topic_link == 1 ? "topiclink1" : "topiclink2") . "\"><nobr><div class=\"pad\">" . a_other("arab-forums", "topic.php?id={$link_object->topic_id}", "{$link_object->topic_name}", "{$link_object->topic_name}", "") . "</div></nobr></td>";
                }

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";
            }

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

            echo "<tr align=\"center\">";

            if ($moderatget1 == true) {

                $inputtext = array(

                    1 => "تحديد جميع المواضيع",

                    2 => "إلغاء تحديد جميع المواضيع",

                    3 => "لا يوجد مواضيع بالصفحة حاليا",

                    4 => "عدد المواضيع الذي إخترت هو :",

                    5 => "الموضوع",

                );

                echo "<td class=\"tcat\" width=\"1%\"><div class=\"pad\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'topice select');\"></div></td>";
            }

            echo "<td class=\"tcat\" width=\"50%\" colspan=\"2\"><div class=\"pad\">الموضوع</div></td>";

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">الكاتب</div></td>";

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">آخر مشاركة</div></td>";

            echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">الردود</div></td>";

            echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">المشاهدات</div></td>";

            echo "</tr>";

            if ($typetopic3[0] == true) {

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" colspan=\"7\"><br>{$typetopic3[1]} >> " . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}", "عرض جميع المواضيع", "عرض جميع المواضيع", "") . "<br><br></td>";

                echo "</tr>";
            }

            $topic_sql = select_mysql("arab-forums", "topic", "i.iconstopic_id , i.iconstopic_name , i.iconstopic_images , i.iconstopic_forumid , x.texttopic_id , x.texttopic_name , x.texttopic_forumid , u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , t.topic_id , t.topic_forumid , t.topic_lock , t.topic_name , t.topic_wait , t.topic_delete , t.topic_hid , t.topic_stiky , t.topic_top , t.topic_survey , t.topic_icons , t.topic_text , t.topic_reply , t.topic_visit , t.topic_date , t.topic_user , t.topic_lastdate , t.topic_lastuser", "as t left join iconstopic" . prefix_connect . " as i on(i.iconstopic_id = t.topic_icons) left join texttopic" . prefix_connect . " as x on(x.texttopic_id = t.topic_text) left join user" . prefix_connect . " as u1 on(u1.user_id = t.topic_user) left join user" . prefix_connect . " as u2 on(u2.user_id = t.topic_lastuser) where t.topic_forumid in({$forum_object->forum_id}) {$typetopic1} order by t.topic_stiky desc , {$tartib1} {$tartib2} limit {$limit_page},{$count_page}");

            if (num_mysql("arab-forums", $topic_sql) != false) {

                while ($topic_object = object_mysql("arab-forums", $topic_sql)) {

                    if ((($topic_object->topic_wait == 0) || ($topic_object->topic_wait == 1 && ($moderatget1 == true || $topic_object->topic_user == id_user))) && (($topic_object->topic_hid == 0) || ($topic_object->topic_hid == 1 && ($moderatget1 == true || $topic_object->topic_user == id_user || num_mysql("arab-forums", select_mysql("arab-forums", "hidtopic", "hidtopic_userid , hidtopic_topicid", "where hidtopic_userid in(" . id_user . ") && hidtopic_topicid in({$topic_object->topic_id}) limit 1")) != false)))) {

                        if ($topic_object->topic_delete == 1) {

                            $classtopic = "topicd";
                        } elseif ($topic_object->topic_wait == 1) {

                            $classtopic = "topicw";
                        } elseif ($topic_object->topic_hid == 1) {

                            $classtopic = "topich";
                        } elseif ($topic_object->topic_stiky == 1) {

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

                        echo "<tr align=\"center\" class=\"topice {$classtopic}\" id=\"tr_{$topic_object->topic_id}\">";

                        if ($moderatget1 == true) {

                            echo "<td class=\"topic\"><input onclick=\"check1(this, '{$topic_object->topic_id}' , 'topice {$classtopic}' , 'الموضوع' , 'topice select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الموضوع\" value=\"{$topic_object->topic_id}\"><input type=\"hidden\" name=\"bg_{$topic_object->topic_id}\" id=\"bg_{$topic_object->topic_id}\" value=\"topice {$classtopic}\"></td>";
                        }

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

                            if (($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0 && $topic_object->topic_user == id_user)) {

                                echo "<td>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=edittopic", "تعديل الموضوع", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";
                            }

                            if (($moderatget1 == true) || ($topic_object->topic_wait == 0 && $topic_object->topic_lock == 0) || ($topic_object->topic_wait == 0 && num_mysql("arab-forums", select_mysql("arab-forums", "locktopic", "locktopic_userid , locktopic_topicid", "where locktopic_userid in(" . id_user . ") && locktopic_topicid in(" . $topic_object->topic_id . ") limit 1")) != false)) {

                                echo "<td>" . a_other("arab-forums", "topic.php?id={$topic_object->topic_id}&go=newreply", "الرد على الموضوع", img_other("arab-forums", "images/add.png", "", "", "", "0", "", ""), "") . "</td>";
                            }

                            if ($moderatget1 == true) {

                                echo "<td>" . a_other("arab-forums", "javascript:montre('topic_tr_{$topic_object->topic_id}')", "إظهار خصائص الموضوع", img_other("arab-forums", "images/list.png", "", "", "", "0", "", ""), "") . "</td>";
                            }
                        }

                        echo "</tr></table></td>";

                        echo "<td class=\"topic\">" . ($topic_object->topic_date != "" && $topic_object->topic_user != "" ? "<span style=\"font-size:13px;\">" . user_other("arab-forums", array($topic_object->u1user_id, $topic_object->u1user_group, $topic_object->u1user_name, $topic_object->u1user_lock, $topic_object->u1user_color, false)) . "</span><br><nobr>" . times_date("arab-forums", "", $topic_object->topic_date) . "</nobr>" : "") . "</td>";

                        echo "<td class=\"topic\">" . ($topic_object->topic_lastdate != "" && $topic_object->topic_lastuser != "" ? "<span style=\"font-size:13px;\">" . user_other("arab-forums", array($topic_object->u2user_id, $topic_object->u2user_group, $topic_object->u2user_name, $topic_object->u2user_lock, $topic_object->u2user_color, false)) . "</span><br><nobr>" . times_date("arab-forums", "", $topic_object->topic_lastdate) . "</nobr>" : "") . "</td>";

                        echo "<td class=\"topic\">" . num_other("arab-forums", $topic_object->topic_reply) . "</td>";

                        echo "<td class=\"topic\">" . num_other("arab-forums", $topic_object->topic_visit) . "</td>";

                        echo "</tr>";

                        if ($moderatget1 == true) {

                            echo "<tr align=\"left\" id=\"topic_tr_{$topic_object->topic_id}\" style=\"display: none;\"><td class=\"topice opyiu topic\" colspan=\"7\"><table cellpadding=\"3\" cellspacing=\"1\"><tr>";

                            if ($topic_object->topic_wait == 1) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=wait", "الموافقة على الموضوع", img_other("arab-forums", "images/wait.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الموضوع ؟")) . "</td>";
                            }

                            if ($topic_object->topic_lock == 0) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=lock", "غلق الموضوع", img_other("arab-forums", "images/lock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد غلق الموضوع ؟")) . "</td>";
                            } else {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nolock", "فتح الموضوع", img_other("arab-forums", "images/nolock.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد فتح الموضوع ؟")) . "</td>";
                            }

                            if ($topic_object->topic_hid == 0) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=hid", "إخفاء الموضوع", img_other("arab-forums", "images/hid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إخفاء الموضوع ؟")) . "</td>";
                            } else {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nohid", "إظهار الموضوع", img_other("arab-forums", "images/nohid.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إظهار الموضوع ؟")) . "</td>";
                            }

                            if ($topic_object->topic_stiky == 0) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=stiky", "تثبيث الموضوع", img_other("arab-forums", "images/stiky.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تثبيث الموضوع ؟")) . "</td>";
                            } else {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nostiky", "إزالة تثبيث الموضوع", img_other("arab-forums", "images/nostiky.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إزالة تثبيث الموضوع ؟")) . "</td>";
                            }

                            if ($topic_object->topic_delete == 0 && per_other("arab-forums", 2) == true) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=delete", "حذف الموضوع", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الموضوع ؟")) . "</td>";
                            } elseif ($topic_object->topic_delete == 1 && $moderatget2 == true) {

                                echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=nodelete", "إرجاع الموضوع", img_other("arab-forums", "images/nodelete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع الموضوع ؟")) . "</td>";
                            }

                            echo "<td>" . a_other("arab-forums", "optiontopic.php?id={$topic_object->topic_id}&go=option", "خيارات الموضوع", img_other("arab-forums", "images/option.png", "", "", "", "0", "", ""), "") . "</td>";

                            echo "</tr></table></tr>";
                        }
                    }
                }
            } else {

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"8\"><br><br>لا توجد مواضيع<br><br><br></td></tr>";
            }

            if ($moderatget1 == true) {

                echo "</form>";
            }

            echo "</table>";

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    }
} else {

    define("pagebody", "forum");

    online_other("arab-forums", "forum", "0", "0", "0", "0");

    $arraymsg = array(

        "login" => true,

        "msg" => "لا يمكنك الدخول إلى المنتدى و السبب <br><br>{$errorop}",

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
