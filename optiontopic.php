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

define("pagebody", "optiontopic");

$option_sql = select_mysql("arab-forums", "topic", "t.topic_id , t.topic_survey , t.topic_forumid , t.topic_user , t.topic_wait , t.topic_delete , t.topic_reply , t.topic_lock , t.topic_hid , t.topic_stiky , t.topic_text , t.topic_icons , t.topic_name , t.topic_message , t.topic_img , t.topic_url , c.cat_id , c.cat_lock , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_lock , f.forum_mode", "as t left join forum" . prefix_connect . " as f on(t.topic_forumid = f.forum_id) left join cat" . prefix_connect . " as c on(f.forum_catid = c.cat_id) where t.topic_id in(" . id . ") limit 1");

if (num_mysql("arab-forums", $option_sql) == false) {

    $errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";
} else {

    $option_object = object_mysql("arab-forums", $option_sql);

    $moderatget1 = moderatget1_other("arab-forums", $option_object->forum_id, $option_object->cat_monitor1, $option_object->cat_monitor2, $option_object->forum_mode);

    $moderatget2 = moderatget2_other("arab-forums", $option_object->cat_monitor1, $option_object->cat_monitor2);

    if ($moderatget1 == false) {

        $errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";
    } else {

        $errorop = "";
    }
}

if ($errorop == "") {

    online_other("arab-forums", "optiontopic", $option_object->cat_id, $option_object->forum_id, $option_object->topic_id, "0");

    if (go == "wait") {

        if ($option_object->topic_wait == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك  الموافقة على الموضوع لأنه موافق عليه من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_wait = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"wait\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم الموافقة على الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "img") {

        if ($option_object->topic_img == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إخفاء صور الموضوع لأنها مخفية من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_img = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"img\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إخفاء صور الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "noimg") {

        if ($option_object->topic_img == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إظهار صور الموضوع لأنها ظاهرة من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_img = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"noimg\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إظهار صور الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "url") {

        if ($option_object->topic_url == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إخفاء روابط الموضوع لأنها مخفية من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_url = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"url\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إخفاء روابط الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "nourl") {

        if ($option_object->topic_url == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إظهار روابط الموضوع لأنها ظاهرة من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_url = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"nourl\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إظهار روابط الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "lock") {

        if ($option_object->topic_lock == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك غلق الموضوع لأنه مغلوق من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_lock = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"lock\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم غلق الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "nolock") {

        if ($option_object->topic_lock == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك فتح الموضوع لأنه مفتوح من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_lock = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"nolock\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم فتح الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "hid") {

        if ($option_object->topic_hid == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إخفاء الموضوع لأنه مخفي من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_hid = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"hid\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إخفاء الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "nohid") {

        if ($option_object->topic_hid == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إظهار الموضوع لأنه ظاهر من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_hid = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"nohid\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إظهار الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "stiky") {

        if ($option_object->topic_stiky == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك تثبيث الموضوع لأنه مثبث من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_stiky = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"stiky\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم تثبيث الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "nostiky") {

        if ($option_object->topic_stiky == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إزالة تثبيث الموضوع لأنه غير مثبث من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_stiky = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"nostiky\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم إزالة تثبيث الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "delete" && per_other("arab-forums", 2) == true) {

        if ($option_object->topic_delete == 1) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك حذف الموضوع لأنه محذوف من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_delete = \"1\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"delete\"");

            update_mysql("arab-forums", "forum", "forum_topic = forum_topic-1 where forum_id = \"{$option_object->forum_id}\"");

            update_mysql("arab-forums", "user", "user_post = user_post-1 , user_topics = user_topics-1 where user_id = \"{$option_object->topic_user}\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم حذف الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "nodelete" && $moderatget2 == true) {

        if ($option_object->topic_delete == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "لا يمكنك إرجاع الموضوع لأنه غير محذوف من قبل",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "topic", "topic_delete = \"0\" where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"nodelete\"");

            update_mysql("arab-forums", "forum", "forum_topic = forum_topic+1 where forum_id = \"{$option_object->forum_id}\"");

            update_mysql("arab-forums", "user", "user_post = user_post+1 , user_topics = user_topics+1 where user_id = \"{$option_object->topic_user}\"");
            $arraymsg = array(

                "login" => true,

                "msg" => "تم إرجاع الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "option") {

        if (type == "insert") {

            $forumid = text_other("arab-forums", post_other("arab-forums", "forumsget"), true, true, true, true, true);

            $iconsid = text_other("arab-forums", post_other("arab-forums", "iconsid"), true, true, true, true, true);

            $textid = text_other("arab-forums", post_other("arab-forums", "textid"), true, true, true, true, true);

            if ($option_object->forum_id != $forumid) {

                update_mysql("arab-forums", "forum", "forum_topic = forum_topic-1 , forum_reply = forum_reply-{$option_object->topic_reply} where forum_id = \"{$option_object->forum_id}\"");

                update_mysql("arab-forums", "forum", "forum_topic = forum_topic+1 , forum_reply = forum_reply+{$option_object->topic_reply} where forum_id = \"{$forumid}\"");
            }

            if (per_other("arab-forums", 11) == true) {

                $update1 = ", topic_icons = \"{$iconsid}\"";
            } else {

                $update1 = "";
            }

            if (per_other("arab-forums", 12) == true) {

                $update2 = ", topic_text = \"{$textid}\"";
            } else {

                $update2 = "";
            }

            update_mysql("arab-forums", "topic", "topic_forumid = \"{$forumid}\" {$update1} {$update2} where topic_id in({$option_object->topic_id}) limit 1");

            insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"option\"");

            $arraymsg = array(

                "login" => true,

                "msg" => "تم تعديل خيارات الموضوع بنجآح تام",

                "color" => "good",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => get_cookie("arab-forums", "refereracoun"),

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            set_cookie("arab-forums", "refereracoun", referer, 0);

            echo bodytop_template("arab-forums", "خيارات موضوع");

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            echo "<form action=\"optiontopic.php?id={$option_object->topic_id}&go=option&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"45%\" align=\"center\">";

            echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تعديل خيارات الموضوع رقم : {$option_object->topic_id}</div></td></tr>";

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br>{$option_object->topic_name}<br><br></div></td></tr>";

            echo "<tr align=\"right\"><td class=\"tcat\"><div class=\"pad\">المنتدى : </div></td><td class=\"alttext2\"><div class=\"pad\">" . list2_forumcatlist("arab-forums", $option_object->forum_id) . "</div></td></tr>";

            if (per_other("arab-forums", 11) == true) {

                echo "<tr align=\"right\"><td class=\"tcat\"><div class=\"pad\">الأيقونة : </div></td><td class=\"alttext2\"><div class=\"pad\"><select class=\"inputselect\" name=\"iconsid\">";

                echo "<option value=\"0\" " . ($option_object->topic_icons == 0 ? "selected" : "") . ">بدون أيقونة</option>";

                $iconstopic_sql = select_mysql("arab-forums", "iconstopic", "iconstopic_id , iconstopic_name , iconstopic_forumid", "where (iconstopic_forumid in(0) || iconstopic_forumid in(" . allowedin1_other("arab-forums") . ")) order by iconstopic_date desc");

                if (num_mysql("arab-forums", $iconstopic_sql) != false) {

                    while ($iconstopic_object = object_mysql("arab-forums", $iconstopic_sql)) {

                        echo "<option value=\"{$iconstopic_object->iconstopic_id}\" " . ($option_object->topic_icons == $iconstopic_object->iconstopic_id ? "selected" : "") . ">{$iconstopic_object->iconstopic_name}</option>";
                    }
                }

                echo "</select></div></td></tr>";
            }

            if (per_other("arab-forums", 12) == true) {

                echo "<tr align=\"right\"><td class=\"tcat\"><div class=\"pad\">الإختصار : </div></td><td class=\"alttext2\"><div class=\"pad\"><select class=\"inputselect\" name=\"textid\">";

                echo "<option value=\"0\" " . ($option_object->topic_text == 0 ? "selected" : "") . ">بدون إختصار</option>";

                $texttopic_sql = select_mysql("arab-forums", "texttopic", "texttopic_id , texttopic_name , texttopic_forumid", "where (texttopic_forumid in(0) || texttopic_forumid in(" . allowedin1_other("arab-forums") . ")) order by texttopic_date desc");

                if (num_mysql("arab-forums", $texttopic_sql) != false) {

                    while ($texttopic_object = object_mysql("arab-forums", $texttopic_sql)) {

                        echo "<option value=\"{$texttopic_object->texttopic_id}\" " . ($option_object->topic_text == $texttopic_object->texttopic_id ? "selected" : "") . ">{$texttopic_object->texttopic_name}</option>";
                    }
                }

                echo "</select></div></td></tr>";
            }

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"></center><br></div></td></tr>";

            echo "</table>";

            echo "</form>";

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    } elseif (go == "goshow") {

        if ($option_object->topic_hid == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "يجب عليك إخفاء الموضوع أولآ",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

            $gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

            $import = @implode(",", $allyu);

            if (isset($gets)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء تحديد عضو وآحد على الأقل ليتم حذفه",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    delete_mysql("arab-forums", "hidtopic", "hidtopic_id in({$import})");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم حذف الأعضاء المحددين بنجآح تآم",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                }
            } elseif (type == "insert") {

                $user = text_other("arab-forums", post_other("arab-forums", "user"), false, false, false, false, false);

                $addwhat = text_other("arab-forums", post_other("arab-forums", "addwhat"), true, true, true, true, true);

                $import = @implode(",", $user);

                if (counts_other("arab-forums", $user) == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء إدخال رقم أو إسم عضو وآحد على الأقل",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    if ($addwhat == "name") {

                        $goadd = "user_nameuser";
                    } else {

                        $goadd = "user_id";
                    }

                    for ($x = 0; $x < count($user); ++$x) {

                        $useroft = text_other("arab-forums", $user[$x], true, true, true, true, true);

                        if ($useroft != "") {

                            $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_wait , user_bad", "where {$goadd} = \"{$useroft}\" && user_wait in(0) && user_bad in(0) limit 1");

                            if (num_mysql("arab-forums", $user_sql) != false) {

                                $user_object = object_mysql("arab-forums", $user_sql);

                                $gogo_sql = select_mysql("arab-forums", "hidtopic", "hidtopic_id , hidtopic_topicid , hidtopic_userid", "where hidtopic_topicid in({$option_object->topic_id}) && hidtopic_userid in({$user_object->user_id}) limit 1");

                                if (num_mysql("arab-forums", $gogo_sql) == false) {

                                    insert_mysql("arab-forums", "hidtopic", "hidtopic_id , hidtopic_topicid , hidtopic_userid , hidtopic_add , hidtopic_date", "null , \"{$option_object->topic_id}\" , \"{$user_object->user_id}\" , \"" . id_user . "\" , \"" . time() . "\"");

                                    $textopp = "إشعار بفتح الموضوع المخفي لك رقم : {$option_object->topic_id}";

                                    $editor = text_other("arab-forums", "<br><br>السلام عليكم و رحمة الله و براكته<br><br>لقم تم فتح لك الموضوع المخفي رقم : {$option_object->topic_id}<br><br>بواسطة فريق إشراف المنتدى<br><br>يمكنك الدخول و المشاركة في الموضوع من هنا : " . a_other("arab-forums", "topic.php?id={$option_object->topic_id}", "{$option_object->topic_name}", "{$option_object->topic_name}", "") . "<br><br><br>", false, true, false, false, true);

                                    insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$user_object->user_id}\", \"{$user_object->user_id}\" , \"-{$option_object->forum_id}\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$textopp}\" , \"{$editor}\"");
                                }
                            }
                        }
                    }

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم إدخال الأعضاء إلى القائمة بنجاح تام<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير موجود بالقائمة مسبقا و ذلك لتفادي الأخطاء",

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

                echo bodytop_template("arab-forums", "الأعضاء المسموح لهم بمشاهدة موضوع");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

                echo "<td width=\"100%\"></td>";

                $count_page = tother_option;

                $get_page = (page == "" || !is_numeric(page) ? 1 : page);

                $limit_page = (($get_page * $count_page) - $count_page);

                echo page_pager("arab-forums", "hidtopic", "hidtopic_id , hidtopic_topicid", "where hidtopic_topicid in({$option_object->topic_id})", $count_page, $get_page, "optiontopic.php?id={$option_object->topic_id}&go=goshow&");

                echo list_forumcatlist("arab-forums");

                echo "</tr></table>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

                echo "<td><nobr><input class=\"button\" value=\"حذف الأعضاء المحددين من القائمة\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأعضاء المحددين من القائمة ؟") . "></nobr></td>";

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">الأعضاء المسموح لهم بمشاهدة الموضوع رقم : {$option_object->topic_id}</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><div class=\"pad\"><br>{$option_object->topic_name}<br><br></div></td></tr>";

                $inputtext = array(

                    1 => "تحديد جميع الأعضاء",

                    2 => "إلغاء تحديد جميع الأعضاء",

                    3 => "لا يوجد أعضاء بالصفحة حاليا",

                    4 => "عدد الأعضاء الذي إخترت هو :",

                    5 => "العضو",

                );

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" width=\"1%\"><div class=\"pad\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">إسم العضو</div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">تمت الإضافة بواسطة</div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">تاريخ الإضافة</div></td>";

                echo "</tr>";

                $hidtopic_sql = select_mysql("arab-forums", "hidtopic", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , h.hidtopic_id , h.hidtopic_userid , h.hidtopic_add , h.hidtopic_date , h.hidtopic_topicid", "as h left join user" . prefix_connect . " as u1 on(u1.user_id = h.hidtopic_userid) left join user" . prefix_connect . " as u2 on(u2.user_id = h.hidtopic_add) where h.hidtopic_topicid in({$option_object->topic_id}) order by h.hidtopic_date desc limit {$limit_page},{$count_page}");

                if (num_mysql("arab-forums", $hidtopic_sql) != false) {

                    while ($hidtopic_object = object_mysql("arab-forums", $hidtopic_sql)) {

                        echo "<tr align=\"center\" class=\"alttext1\" id=\"tr_{$hidtopic_object->hidtopic_id}\">";

                        echo "<td class=\"topic\"><input onclick=\"check1(this, '{$hidtopic_object->hidtopic_id}' , 'alttext1' , 'العضو' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد العضو\" value=\"{$hidtopic_object->hidtopic_id}\"><input type=\"hidden\" name=\"bg_{$hidtopic_object->hidtopic_id}\" id=\"bg_{$hidtopic_object->hidtopic_id}\" value=\"alttext1\"></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($hidtopic_object->u1user_id, $hidtopic_object->u1user_group, $hidtopic_object->u1user_name, $hidtopic_object->u1user_lock, $hidtopic_object->u1user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($hidtopic_object->u2user_id, $hidtopic_object->u2user_group, $hidtopic_object->u2user_name, $hidtopic_object->u2user_lock, $hidtopic_object->u2user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . times_date("arab-forums", "", $hidtopic_object->hidtopic_date) . "</span></td>";

                        echo "</tr>";
                    }
                } else {

                    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><br><br>لا يوجد أعضاء<br><br><br></td></tr>";
                }

                echo "</table>";

                echo "</form><br>";

                echo "<form action=\"optiontopic.php?id={$option_object->topic_id}&go=goshow&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"5\"><div class=\"pad\">إدخال قائمة جديدة من الأعضاء ليتمكنو من مشاهدة الموضوع</div></td></tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"addwhat\">";

                echo "<option value=\"name\">إدخال بأسماء العضويات</option>";

                echo "<option value=\"id\">إدخال بأرقام العضويات</option>";

                echo "</select></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                $xi = 0;

                for ($x = 1; $x <= 50; ++$x) {

                    if ($xi == 5) {
                        echo "</tr><tr align=\"center\">";
                        $xi = 0;
                    }

                    echo "<td class=\"alttext2\"><div class=\"pad\"><input style=\"width:80px\" class=\"input\" name=\"user[]\" value=\"\" type=\"text\"></div></td>";

                    $xi++;
                }

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إدخال الأعضاء إلى القائمة\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الأعضاء إلى القائمة ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        }
    } elseif (go == "golock") {

        if ($option_object->topic_lock == 0) {

            $arraymsg = array(

                "login" => true,

                "msg" => "يجب عليك غلق الموضوع أولآ",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

            $gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

            $import = @implode(",", $allyu);

            if (isset($gets)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء تحديد عضو وآحد على الأقل ليتم حذفه",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    delete_mysql("arab-forums", "locktopic", "locktopic_id in({$import})");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم حذف الأعضاء المحددين بنجآح تآم",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                }
            } elseif (type == "insert") {

                $user = text_other("arab-forums", post_other("arab-forums", "user"), false, false, false, false, false);

                $addwhat = text_other("arab-forums", post_other("arab-forums", "addwhat"), true, true, true, true, true);

                $import = @implode(",", $user);

                if (counts_other("arab-forums", $user) == 0) {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "الرجاء إدخال رقم أو إسم عضو وآحد على الأقل",

                        "color" => "error",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    if ($addwhat == "name") {

                        $goadd = "user_nameuser";
                    } else {

                        $goadd = "user_id";
                    }

                    for ($x = 0; $x < count($user); ++$x) {

                        $useroft = text_other("arab-forums", $user[$x], true, true, true, true, true);

                        if ($useroft != "") {

                            $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_wait , user_bad", "where {$goadd} = \"{$useroft}\" && user_wait in(0) && user_bad in(0) limit 1");

                            if (num_mysql("arab-forums", $user_sql) != false) {

                                $user_object = object_mysql("arab-forums", $user_sql);

                                $gogo_sql = select_mysql("arab-forums", "locktopic", "locktopic_id , locktopic_topicid , locktopic_userid", "where locktopic_topicid in({$option_object->topic_id}) && locktopic_userid in({$user_object->user_id}) limit 1");

                                if (num_mysql("arab-forums", $gogo_sql) == false) {

                                    insert_mysql("arab-forums", "locktopic", "locktopic_id , locktopic_topicid , locktopic_userid , locktopic_add , locktopic_date", "null , \"{$option_object->topic_id}\" , \"{$user_object->user_id}\" , \"" . id_user . "\" , \"" . time() . "\"");

                                    $textopp = "إشعار بفتح الموضوع المغلوق لك رقم : {$option_object->topic_id}";

                                    $editor = text_other("arab-forums", "<br><br>السلام عليكم و رحمة الله و براكته<br><br>لقم تم فتح لك الموضوع المغلوق رقم : {$option_object->topic_id}<br><br>بواسطة فريق إشراف المنتدى<br><br>يمكنك الدخول و المشاركة في الموضوع من هنا : " . a_other("arab-forums", "topic.php?id={$option_object->topic_id}", "{$option_object->topic_name}", "{$option_object->topic_name}", "") . "<br><br><br>", false, true, false, false, true);

                                    insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$user_object->user_id}\", \"{$user_object->user_id}\" , \"-{$option_object->forum_id}\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$textopp}\" , \"{$editor}\"");
                                }
                            }
                        }
                    }

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم إدخال الأعضاء إلى القائمة بنجاح تام<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير موجود بالقائمة مسبقا و ذلك لتفادي الأخطاء",

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

                echo bodytop_template("arab-forums", "الأعضاء المسموح لهم بالرد على موضوع");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

                echo "<td width=\"100%\"></td>";

                $count_page = tother_option;

                $get_page = (page == "" || !is_numeric(page) ? 1 : page);

                $limit_page = (($get_page * $count_page) - $count_page);

                echo page_pager("arab-forums", "locktopic", "locktopic_id , locktopic_topicid", "where locktopic_topicid in({$option_object->topic_id})", $count_page, $get_page, "optiontopic.php?id={$option_object->topic_id}&go=golock&");

                echo list_forumcatlist("arab-forums");

                echo "</tr></table>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

                echo "<td><nobr><input class=\"button\" value=\"حذف الأعضاء المحددين من القائمة\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأعضاء المحددين من القائمة ؟") . "></nobr></td>";

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">الأعضاء المسموح لهم بالرد على الموضوع رقم : {$option_object->topic_id}</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><div class=\"pad\"><br>{$option_object->topic_name}<br><br></div></td></tr>";

                $inputtext = array(

                    1 => "تحديد جميع الأعضاء",

                    2 => "إلغاء تحديد جميع الأعضاء",

                    3 => "لا يوجد أعضاء بالصفحة حاليا",

                    4 => "عدد الأعضاء الذي إخترت هو :",

                    5 => "العضو",

                );

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" width=\"1%\"><div class=\"pad\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">إسم العضو</div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">تمت الإضافة بواسطة</div></td>";

                echo "<td class=\"tcat\"><div class=\"pad\">تاريخ الإضافة</div></td>";

                echo "</tr>";

                $locktopic_sql = select_mysql("arab-forums", "locktopic", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , h.locktopic_id , h.locktopic_userid , h.locktopic_add , h.locktopic_date , h.locktopic_topicid", "as h left join user" . prefix_connect . " as u1 on(u1.user_id = h.locktopic_userid) left join user" . prefix_connect . " as u2 on(u2.user_id = h.locktopic_add) where h.locktopic_topicid in({$option_object->topic_id}) order by h.locktopic_date desc limit {$limit_page},{$count_page}");

                if (num_mysql("arab-forums", $locktopic_sql) != false) {

                    while ($locktopic_object = object_mysql("arab-forums", $locktopic_sql)) {

                        echo "<tr align=\"center\" class=\"alttext1\" id=\"tr_{$locktopic_object->locktopic_id}\">";

                        echo "<td class=\"topic\"><input onclick=\"check1(this, '{$locktopic_object->locktopic_id}' , 'alttext1' , 'العضو' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد العضو\" value=\"{$locktopic_object->locktopic_id}\"><input type=\"hidden\" name=\"bg_{$locktopic_object->locktopic_id}\" id=\"bg_{$locktopic_object->locktopic_id}\" value=\"alttext1\"></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($locktopic_object->u1user_id, $locktopic_object->u1user_group, $locktopic_object->u1user_name, $locktopic_object->u1user_lock, $locktopic_object->u1user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($locktopic_object->u2user_id, $locktopic_object->u2user_group, $locktopic_object->u2user_name, $locktopic_object->u2user_lock, $locktopic_object->u2user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . times_date("arab-forums", "", $locktopic_object->locktopic_date) . "</span></td>";

                        echo "</tr>";
                    }
                } else {

                    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><br><br>لا يوجد أعضاء<br><br><br></td></tr>";
                }

                echo "</table>";

                echo "</form><br>";

                echo "<form action=\"optiontopic.php?id={$option_object->topic_id}&go=golock&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"5\"><div class=\"pad\">إدخال قائمة جديدة من الأعضاء ليتمكنو من الرد على الموضوع</div></td></tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"addwhat\">";

                echo "<option value=\"name\">إدخال بأسماء العضويات</option>";

                echo "<option value=\"id\">إدخال بأرقام العضويات</option>";

                echo "</select></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                $xi = 0;

                for ($x = 1; $x <= 50; ++$x) {

                    if ($xi == 5) {
                        echo "</tr><tr align=\"center\">";
                        $xi = 0;
                    }

                    echo "<td class=\"alttext2\"><div class=\"pad\"><input style=\"width:80px\" class=\"input\" name=\"user[]\" value=\"\" type=\"text\"></div></td>";

                    $xi++;
                }

                echo "</tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إدخال الأعضاء إلى القائمة\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الأعضاء إلى القائمة ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        }
    } elseif (go == "goedit") {

        echo bodytop_template("arab-forums", "التعديلات المقامة على موضوع");

        $arrayheader = array(

            "login" => true,

        );

        echo header_template("arab-forums", $arrayheader);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

        echo "<td width=\"100%\"></td>";

        $count_page = tother_option;

        $get_page = (page == "" || !is_numeric(page) ? 1 : page);

        $limit_page = (($get_page * $count_page) - $count_page);

        echo page_pager("arab-forums", "edittopic", "edittopic_id , edittopic_topicid", "where edittopic_topicid in({$option_object->topic_id})", $count_page, $get_page, "optiontopic.php?id={$option_object->topic_id}&go=goedit&");

        echo list_forumcatlist("arab-forums");

        echo "</tr></table>";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

        echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">التعديلات على الموضوع رقم : {$option_object->topic_id}</div></td></tr>";

        echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><div class=\"pad\"><br>{$option_object->topic_name}<br><br></div></td></tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcat\"><div class=\"pad\">رقم التعديل</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">تم التعديل بواسطة</div></td>";

        echo "<td class=\"tcat\"><div class=\"pad\">تاريخ التعديل</div></td>";

        echo "</tr>";

        $edittopic_sql = select_mysql("arab-forums", "edittopic", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , e.edittopic_id , e.edittopic_user , e.edittopic_date , e.edittopic_topicid", "as e left join user" . prefix_connect . " as u on(u.user_id = e.edittopic_user) where e.edittopic_topicid in({$option_object->topic_id}) order by e.edittopic_date desc limit {$limit_page},{$count_page}");

        if (num_mysql("arab-forums", $edittopic_sql) != false) {

            while ($edittopic_object = object_mysql("arab-forums", $edittopic_sql)) {

                echo "<tr align=\"center\" class=\"alttext1\">";

                echo "<td class=\"topic\">التعديل رقم {$edittopic_object->edittopic_id} " . a_other("arab-forums", "optiontopic.php?id={$option_object->topic_id}&go=showedit&value={$edittopic_object->edittopic_id}", "مشاهدة التعديل رقم : {$edittopic_object->edittopic_id}", "<span style=\"color:red;font-size:11px;\">(لرؤية هذا التعديل إضغط هنا)</span>", "") . "</td>";

                echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($edittopic_object->user_id, $edittopic_object->user_group, $edittopic_object->user_nameuser, $edittopic_object->user_lock1, $edittopic_object->user_coloruser, false)) . "</span></td>";

                echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . times_date("arab-forums", "", $edittopic_object->edittopic_date) . "</span></td>";

                echo "</tr>";
            }
        } else {

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><br><br>لا توجد تعديلات<br><br><br></td></tr>";
        }

        echo "</table>";

        echo footer_template("arab-forums");

        echo bodybottom_template("arab-forums");
    } elseif (go == "showedit") {

        $edittopic_sql = select_mysql("arab-forums", "edittopic", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , e.edittopic_id , e.edittopic_user , e.edittopic_date , e.edittopic_topicid , e.edittopic_name , e.edittopic_message", "as e left join user" . prefix_connect . " as u on(u.user_id = e.edittopic_user) where edittopic_id in(" . value . ") && edittopic_topicid in({$option_object->topic_id})");

        if (num_mysql("arab-forums", $edittopic_sql) == false) {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف لا يمكنك مشاهدة هذا التعديل لعدة أسباب",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        } else {

            $edittopic_object = object_mysql("arab-forums", $edittopic_sql);

            if (type == "insert1") {

                $editor_edit = text_other("arab-forums", htmltext_other("arab-forums", $option_object->topic_message), false, true, false, false, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", $edittopic_object->edittopic_message), false, true, false, false, true);

                insert_mysql("arab-forums", "edittopic", "edittopic_id , edittopic_topicid , edittopic_user , edittopic_date , edittopic_name , edittopic_message", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$option_object->topic_name}\" , \"{$editor_edit}\"");

                update_mysql("arab-forums", "topic", "topic_name = \"{$edittopic_object->edittopic_name}\" , topic_message = \"{$editor_message}\" where topic_id in({$option_object->topic_id})");

                insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"edit\"");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم إرجاع العنوآن و النص إلى الموضوع بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "الذهاب إلى الموضوع",

                    "url" => "topic.php?id={$option_object->topic_id}",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } elseif (type == "insert2") {

                $editor_edit = text_other("arab-forums", htmltext_other("arab-forums", $option_object->topic_message), false, true, false, false, true);

                insert_mysql("arab-forums", "edittopic", "edittopic_id , edittopic_topicid , edittopic_user , edittopic_date , edittopic_name , edittopic_message", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$option_object->topic_name}\" , \"{$editor_edit}\"");

                update_mysql("arab-forums", "topic", "topic_name = \"{$edittopic_object->edittopic_name}\" where topic_id in({$option_object->topic_id})");

                insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"edit\"");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم إرجاع العنوآن  إلى الموضوع بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "الذهاب إلى الموضوع",

                    "url" => "topic.php?id={$option_object->topic_id}",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } elseif (type == "insert3") {

                $editor_edit = text_other("arab-forums", htmltext_other("arab-forums", $option_object->topic_message), false, true, false, false, true);

                $editor_message = text_other("arab-forums", htmltext_other("arab-forums", $edittopic_object->edittopic_message), false, true, false, false, true);

                insert_mysql("arab-forums", "edittopic", "edittopic_id , edittopic_topicid , edittopic_user , edittopic_date , edittopic_name , edittopic_message", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$option_object->topic_name}\" , \"{$editor_edit}\"");

                update_mysql("arab-forums", "topic", "topic_message = \"{$editor_message}\" where topic_id in({$option_object->topic_id})");

                insert_mysql("arab-forums", "optiontopic", "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type", "null , \"{$option_object->topic_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"edit\"");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم إرجاع النص إلى الموضوع بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "الذهاب إلى الموضوع",

                    "url" => "topic.php?id={$option_object->topic_id}",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                echo bodytop_template("arab-forums", "مشاهدة تعديل على موضوع");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

                echo "<td width=\"100%\"></td>";

                echo list_forumcatlist("arab-forums");

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">التعديل رقم : {$edittopic_object->edittopic_id} | الخاص بالموضوع رقم : {$option_object->topic_id}</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>تم التعديل بواسطة : " . user_other("arab-forums", array($edittopic_object->user_id, $edittopic_object->user_group, $edittopic_object->user_nameuser, $edittopic_object->user_lock1, $edittopic_object->user_coloruser, false)) . " | بتاريخ : " . times_date("arab-forums", "", $edittopic_object->edittopic_date) . "<br><br></div></td></tr>";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">خيارات</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><br>" . a_other("arab-forums", "optiontopic.php?id={$option_object->topic_id}&go=showedit&value={$edittopic_object->edittopic_id}&type=insert1", "إرجاع العنوان و النص إلى الموضوع", img_other("arab-forums", "images/alle.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع العنوان و النص إلى الموضوع ؟")) . " - " . a_other("arab-forums", "optiontopic.php?id={$option_object->topic_id}&go=showedit&value={$edittopic_object->edittopic_id}&type=insert2", "إرجاع العنوان إلى الموضوع", img_other("arab-forums", "images/namee.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع العنوان إلى الموضوع ؟")) . " - " . a_other("arab-forums", "optiontopic.php?id={$option_object->topic_id}&go=showedit&value={$edittopic_object->edittopic_id}&type=insert3", "إرجاع النص إلى الموضوع", img_other("arab-forums", "images/texte.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إرجاع النص إلى الموضوع ؟")) . "<br><br></div></td></tr>";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">العنوان السابق</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><br>{$edittopic_object->edittopic_name}<br><br></div></td></tr>";

                echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">النص السابق</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><table style=\"table-layout:fixed;\" width=\"100%\"><tr><td width=\"100%\">";

                echo messagereplase_other("arab-forums", $edittopic_object->edittopic_message, $option_object->forum_id);

                echo "</td></tr></table></div></td></tr>";

                echo "</table>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        }
    } elseif (go == "state") {

        echo bodytop_template("arab-forums", "عرض إحصائيات موضوع");

        $arrayheader = array(

            "login" => true,

        );

        echo header_template("arab-forums", $arrayheader);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"70%\" align=\"center\"><tr>";

        echo "<td width=\"100%\"></td>";

        echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

        echo "<option value=\"optiontopic.php?id={$option_object->topic_id}&go=state\" " . (type == "" ? "selected" : "") . ">جميع الأعضاء</option>";

        echo "<option value=\"optiontopic.php?id={$option_object->topic_id}&go=state&type=5\" " . (type == 5 ? "selected" : "") . ">5 أعضاء</option>";

        echo "<option value=\"optiontopic.php?id={$option_object->topic_id}&go=state&type=10\" " . (type == 10 ? "selected" : "") . ">10 أعضاء</option>";

        echo "<option value=\"optiontopic.php?id={$option_object->topic_id}&go=state&type=20\" " . (type == 20 ? "selected" : "") . ">20 عضو</option>";

        echo "<option value=\"optiontopic.php?id={$option_object->topic_id}&go=state&type=30\" " . (type == 30 ? "selected" : "") . ">30 عضو</option>";

        echo "</select></div></td>";

        echo list_forumcatlist("arab-forums");

        echo "</tr></table>";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"70%\" align=\"center\">";

        echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"3\"><div class=\"pad\">عرض إحصائيات الموضوع رقم : {$option_object->topic_id}</div></td></tr>";

        echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\"><br>{$option_object->topic_name}<br><br></div></td></tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcot\" width=\"50%\"><div class=\"pad\">إسم العضوية</div></td>";

        echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">عدد الردود</div></td>";

        echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">النسبة المئوية</div></td>";

        echo "</tr>";

        if (type == 5) {

            $limit = "limit 5";
        } elseif (type == 10) {

            $limit = "limit 10";
        } elseif (type == 20) {

            $limit = "limit 20";
        } elseif (type == 30) {

            $limit = "limit 30";
        } else {

            $limit = "";
        }

        $total_sql = num_mysql("arab-forums", select_mysql("arab-forums", "reply", "reply_id reply_topicid , reply_wait , reply_delete , reply_hid", "where reply_topicid in({$option_object->topic_id}) && reply_wait in(0) && reply_hid in(0)  && reply_delete in(0)"));

        $state_sql = select_mysql("arab-forums", "reply", "distinct r.reply_user , count(r.reply_id) as statreply , r.reply_topicid , r.reply_wait , r.reply_delete , r.reply_hid , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser", "as r left join user" . prefix_connect . " as u on(u.user_id = r.reply_user) where r.reply_topicid in({$option_object->topic_id}) && r.reply_wait in(0) && r.reply_hid in(0)  && r.reply_delete in(0) group by r.reply_user order by statreply desc {$limit}");

        if (num_mysql("arab-forums", $state_sql) != false) {

            while ($state_object = object_mysql("arab-forums", $state_sql)) {

                $opsl = percentage_other("arab-forums", $state_object->statreply, $total_sql);

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext1\" width=\"50%\"><div class=\"pad\">" . user_other("arab-forums", array($state_object->user_id, $state_object->user_group, $state_object->user_nameuser, $state_object->user_lock1, $state_object->user_coloruser, false)) . "</div></td>";

                echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\">{$state_object->statreply}</div></td>";

                echo "<td class=\"alttext1\" width=\"30%\"><div class=\"pad\">" . $opsl . " % <br><br>" . bars_other("arab-forums", "reply-s-{$state_object->reply_user}", "300", ($opsl + 200), sprintf('#%06x', rand(0, 16777215))) . "</div></td>";

                echo "</tr>";
            }
        } else {

            echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\"><br>لا توجد أي إحصائيات لهذا الموضوع<br><br></div></td></tr>";
        }

        echo "</table>";

        echo footer_template("arab-forums");

        echo bodybottom_template("arab-forums");
    } else {

        $arraymsg = array(

            "login" => true,

            "msg" => "لا تملك التصريح المناسب لدخول هذه الصفحة",

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

    online_other("arab-forums", "optiontopic", "0", "0", "0", "0");

    $arraymsg = array(

        "login" => true,

        "msg" => "{$errorop}",

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
