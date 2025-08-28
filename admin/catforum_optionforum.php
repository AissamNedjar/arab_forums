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

$forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_catid , forum_lock , forum_hid1 , forum_hid2 , forum_name , forum_wasaf , forum_logo , forum_moderattext , forum_order , forum_sex , forum_totaltopic , forum_totalreply , forum_moderattopic , forum_moderatreply , forum_mode , forum_group0 , forum_group1 , forum_group2 , forum_group3 , forum_group4 , forum_group5 , forum_group6 , forum_post1 , forum_post2 , forum_post3 , forum_post4 , forum_post5 , forum_post6 , forum_phototopic , forum_sigtopic , forum_detailtopic , forum_wasaftopic , forum_photoreply , forum_sigreply , forum_detailreply , forum_wasafreply , forum_visitortopicshow , forum_visitorreplyshow , forum_urlshowtopic , forum_urlshowreply", "where forum_id in(" . id . ")");

if (num_mysql("arab-forums", $forum_sql) != false) {

    $forum_object = object_mysql("arab-forums", $forum_sql);

    if (fort == "edit") {

        if (type == "insert") {

            $catid = text_other("arab-forums", post_other("arab-forums", "catid"), true, true, true, false, true);

            $name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, false, true);

            $wasaf = text_other("arab-forums", post_other("arab-forums", "wasaf"), true, true, true, false, true);

            $logo = text_other("arab-forums", post_other("arab-forums", "logo"), true, true, true, false, true);

            $order = text_other("arab-forums", post_other("arab-forums", "order"), true, true, true, false, true);

            $lock = text_other("arab-forums", post_other("arab-forums", "lock"), true, true, true, false, true);

            $hid1 = text_other("arab-forums", post_other("arab-forums", "hid1"), true, true, true, false, true);

            $hid2 = text_other("arab-forums", post_other("arab-forums", "hid2"), true, true, true, false, true);

            $group0 = text_other("arab-forums", post_other("arab-forums", "group0"), true, true, true, false, true);

            $group1 = text_other("arab-forums", post_other("arab-forums", "group1"), true, true, true, false, true);

            $group2 = text_other("arab-forums", post_other("arab-forums", "group2"), true, true, true, false, true);

            $group3 = text_other("arab-forums", post_other("arab-forums", "group3"), true, true, true, false, true);

            $group4 = text_other("arab-forums", post_other("arab-forums", "group4"), true, true, true, false, true);

            $group5 = text_other("arab-forums", post_other("arab-forums", "group5"), true, true, true, false, true);

            $post1 = text_other("arab-forums", post_other("arab-forums", "post1"), true, true, true, false, true);

            $post2 = text_other("arab-forums", post_other("arab-forums", "post2"), true, true, true, false, true);

            $post3 = text_other("arab-forums", post_other("arab-forums", "post3"), true, true, true, false, true);

            $post4 = text_other("arab-forums", post_other("arab-forums", "post4"), true, true, true, false, true);

            $post5 = text_other("arab-forums", post_other("arab-forums", "post5"), true, true, true, false, true);

            $moderattext = text_other("arab-forums", post_other("arab-forums", "moderattext"), true, true, true, false, true);

            $sex = text_other("arab-forums", post_other("arab-forums", "sex"), true, true, true, false, true);

            $mode = text_other("arab-forums", post_other("arab-forums", "mode"), true, true, true, false, true);

            $topic = text_other("arab-forums", post_other("arab-forums", "topic"), true, true, true, false, true);

            $reply = text_other("arab-forums", post_other("arab-forums", "reply"), true, true, true, false, true);

            $modetopic = text_other("arab-forums", post_other("arab-forums", "modetopic"), true, true, true, false, true);

            $modereply = text_other("arab-forums", post_other("arab-forums", "modereply"), true, true, true, false, true);

            $phototopic = text_other("arab-forums", post_other("arab-forums", "phototopic"), true, true, true, false, true);

            $photoreply = text_other("arab-forums", post_other("arab-forums", "photoreply"), true, true, true, false, true);

            $sigtopic = text_other("arab-forums", post_other("arab-forums", "sigtopic"), true, true, true, false, true);

            $sigreply = text_other("arab-forums", post_other("arab-forums", "sigreply"), true, true, true, false, true);

            $detailtopic = text_other("arab-forums", post_other("arab-forums", "detailtopic"), true, true, true, false, true);

            $detailreply = text_other("arab-forums", post_other("arab-forums", "detailreply"), true, true, true, false, true);

            $wasaftopic = text_other("arab-forums", post_other("arab-forums", "wasaftopic"), true, true, true, false, true);

            $wasafreply = text_other("arab-forums", post_other("arab-forums", "wasafreply"), true, true, true, false, true);

            $visitortopicshow = text_other("arab-forums", post_other("arab-forums", "visitortopicshow"), true, true, true, false, true);

            $visitorreplyshow = text_other("arab-forums", post_other("arab-forums", "visitorreplyshow"), true, true, true, false, true);

            $urlshowtopic = text_other("arab-forums", post_other("arab-forums", "urlshowtopic"), true, true, true, false, true);

            $urlshowreply = text_other("arab-forums", post_other("arab-forums", "urlshowreply"), true, true, true, false, true);

            if ($catid == "" || $name == "" || $wasaf == "" || $logo == "" || $order == "" || $lock == "" || $hid1 == "" || $hid2 == "" || $group0 == "" || $group1 == "" || $group2 == "" || $group3 == "" || $group4 == "" || $group5 == "" || $post1 == "" || $post2 == "" || $post3 == "" || $post4 == "" || $post5 == "" || $moderattext == "" || $sex == "" || $mode == "" || $phototopic == "" || $photoreply == "" || $sigtopic == "" || $sigreply == "" || $detailtopic == "" || $detailreply == "" || $wasaftopic == "" || $wasafreply == "" || $topic == "" || $reply == "" || $modetopic == "" || $modereply == "" || $visitortopicshow == "" || $visitorreplyshow == "" || $urlshowtopic == "" || $urlshowreply == "") {

                $error = "الرجاء ملأ جميع الحقول ليتم التعديل على المنتدى";
            } elseif (!is_numeric($order)) {

                $error = "يجب أن تكون قيمة ترتيب المنتدى صحيحة";
            } elseif (!is_numeric($topic)) {

                $error = "يجب أن تكون قيمة عدد المواضيع المسموح بها يوميا صحيحة";
            } elseif (!is_numeric($reply)) {

                $error = "يجب أن تكون قيمة عدد المشاركات المسموح بها يوميا صحيحة";
            } else {

                $error = "";
            }

            if ($error != "") {

                $arraymsg = array(

                    "msg" => $error,

                    "color" => "error",

                    "url" => "",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            } else {

                if ($forum_object->forum_catid != $catid) {

                    update_mysql("arab-forums", "moderate", "moderate_catid = \"{$catid}\" where moderate_forumid in({$forum_object->forum_id})");

                    update_mysql("arab-forums", "hidforum", "hidforum_catid = \"{$catid}\" where hidforum_forumid in({$forum_object->forum_id})");
                }

                update_mysql("arab-forums", "forum", "forum_catid = \"{$catid}\" , forum_lock = \"{$lock}\" , forum_hid1 = \"{$hid1}\" , forum_hid2 = \"{$hid2}\" , forum_name = \"{$name}\" , forum_wasaf = \"{$wasaf}\" , forum_logo = \"{$logo}\" , forum_moderattext = \"{$moderattext}\" , forum_order = \"{$order}\" , forum_sex = \"{$sex}\" , forum_totaltopic = \"{$topic}\" , forum_totalreply = \"{$reply}\" , forum_moderattopic = \"{$modetopic}\" , forum_moderatreply = \"{$modereply}\" , forum_mode = \"{$mode}\" , forum_group0 = \"{$group0}\" , forum_group1 = \"{$group1}\" , forum_group2 = \"{$group2}\" , forum_group3 = \"{$group3}\" , forum_group4 = \"{$group4}\" , forum_group5 = \"{$group5}\" , forum_post1 = \"{$post1}\" , forum_post2 = \"{$post2}\" , forum_post3 = \"{$post3}\" , forum_post4 = \"{$post4}\" , forum_post5 = \"{$post5}\" , forum_phototopic = \"{$phototopic}\" , forum_sigtopic = \"{$sigtopic}\" , forum_detailtopic = \"{$detailtopic}\" , forum_wasaftopic = \"{$wasaftopic}\" , forum_photoreply = \"{$photoreply}\" , forum_sigreply = \"{$sigreply}\" , forum_detailreply = \"{$detailreply}\" , forum_wasafreply = \"{$wasafreply}\" , forum_visitortopicshow = \"{$visitortopicshow}\" , forum_visitorreplyshow = \"{$visitorreplyshow}\" , forum_urlshowtopic = \"{$urlshowtopic}\" , forum_urlshowreply = \"{$urlshowreply}\" where forum_id in({$forum_object->forum_id})");

                $arraymsg = array(

                    "msg" => "تم تعديل المنتدى بنجاح تام",

                    "color" => "good",

                    "url" => "admin.php?gert=catforum&go=catforum_list",

                );

                echo msgadmin_template("arab-forums", $arraymsg);
            }
        } else {

            echo "<form action=\"admin.php?gert=catforum&go=catforum_optionforum&fort=edit&id={$forum_object->forum_id}&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

            echo "<tr><td class=\"tcotadmin\">المنتدى تابع لفئة</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            $cat_sql = select_mysql("arab-forums", "cat", "cat_id , cat_name , cat_order", " order by cat_order asc");

            if (num_mysql("arab-forums", $cat_sql) != false) {

                echo "<select class=\"inputselect\" name=\"catid\">";

                while ($cat_object = object_mysql("arab-forums", $cat_sql)) {

                    echo "<option value=\"{$cat_object->cat_id}\" " . ($forum_object->forum_catid == $cat_object->cat_id ? "selected" : "") . ">{$cat_object->cat_name}</option>";
                }

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر الفئة التي تريد إضافة المنتدى لهآ</span>";
            }

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">عنوان المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"{$forum_object->forum_name}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">وصف المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input style=\"width:300px\" class=\"input\" name=\"wasaf\" value=\"{$forum_object->forum_wasaf}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال وصف المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">صورة المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input dir=\"ltr\" style=\"width:400px\" class=\"input\" name=\"logo\" value=\"{$forum_object->forum_logo}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ترتيب المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"{$forum_object->forum_order}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالمنتدى و إن كنت لا تريده مرتب أتركه 1</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">حذف المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"delete\">";

            echo "<option value=\"0\" " . ($forum_object->forum_delete == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_delete == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى محذوف ؟</span>";

            echo "<tr><td class=\"tcotadmin\">غلق المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"lock\">";

            echo "<option value=\"0\" " . ($forum_object->forum_lock == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_lock == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى مغلوق ؟</span>";

            echo "<tr><td class=\"tcotadmin\">إخفاء المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"hid1\">";

            echo "<option value=\"0\" " . ($forum_object->forum_hid1 == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_hid1 == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى مخفي ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">إخفاء المنتدى و إظهاره للمشرفين و المراقب و النائب فقط</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"hid2\">";

            echo "<option value=\"0\" " . ($forum_object->forum_hid2 == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_hid2 == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تريد إظهار المنتدى للمشرفين و المراقب و نائب المراقب فقط ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">المشاركة في المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"sex\">";

            echo "<option value=\"0\" " . ($forum_object->forum_sex == 0 ? "selected" : "") . ">للجميع</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_sex == 1 ? "selected" : "") . ">للذكور فقط</option>";

            echo "<option value=\"2\" " . ($forum_object->forum_sex == 2 ? "selected" : "") . ">للإيناث فقط</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">من يمكنه المشاركة في المنتدى الكل أو الذكور فقط أو الإيناث فقط ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور المنتدى للمجموعات</td></tr>";

            $groupup = array($forum_object->forum_group0, $forum_object->forum_group1, $forum_object->forum_group2, $forum_object->forum_group3, $forum_object->forum_group4, $forum_object->forum_group5);

            for ($x = 0; $x <= 5; $x++) {

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"group{$x}\">";

                echo "<option value=\"1\" " . ($groupup[$x] == 1 ? "selected" : "") . ">نعم</option>";

                echo "<option value=\"0\" " . ($groupup[$x] == 0 ? "selected" : "") . ">لآ</option>";

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى يظهر لمجموعة {$group_list[$x]} ؟</span>";

                echo "</div></td></tr>";
            }

            echo "<tr><td class=\"tcotadmin\">السمآح للمجموعات بكتابة مواضيع و مشاركات في المنتدى</td></tr>";

            $groupup = array("", $forum_object->forum_post1, $forum_object->forum_post2, $forum_object->forum_post3, $forum_object->forum_post4, $forum_object->forum_post5);

            for ($x = 1; $x <= 5; $x++) {

                echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"post{$x}\">";

                echo "<option value=\"1\" " . ($groupup[$x] == 1 ? "selected" : "") . ">نعم</option>";

                echo "<option value=\"0\" " . ($groupup[$x] == 0 ? "selected" : "") . ">لآ</option>";

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تستطيع مجموعة {$group_list[$x]} كتابة مواضيع و مشاركات في المنتدى ؟</span>";

                echo "</div></td></tr>";
            }

            echo "<tr><td class=\"tcotadmin\">المنتدى تحت إشراف</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"mode\">";

            echo "<option value=\"0\" " . ($forum_object->forum_mode == 0 ? "selected" : "") . ">الأعضاء المعينين فقط</option>";

            for ($x = 2; $x <= 4; $x++) {

                echo "<option value=\"{$x}\" " . ($forum_object->forum_mode == $x ? "selected" : "") . ">الأعضاء المعينين + مجموعة {$group_list[$x]}</option>";
            }

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر مجموعة لتقوم بالإشراف على هذا المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور مشرفي المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"moderattext\">";

            echo "<option value=\"1\" " . ($forum_object->forum_moderattext == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_moderattext == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">ظهور مشرفي المنتدى في الرئيسية و داخل معلومات المنتديات و داخل بيانات المشرفين ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور صور الأعضاء في مواضيع المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"phototopic\">";

            echo "<option value=\"1\" " . ($forum_object->forum_phototopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_phototopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل صور الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور صور الأعضاء في مشاركات المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"photoreply\">";

            echo "<option value=\"1\" " . ($forum_object->forum_photoreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_photoreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل صور الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور تواقيع الأعضاء في مواضيع المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"sigtopic\">";

            echo "<option value=\"1\" " . ($forum_object->forum_sigtopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_sigtopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تواقيع الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور تواقيع الأعضاء في مشاركات المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"sigreply\">";

            echo "<option value=\"1\" " . ($forum_object->forum_sigreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_sigreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تواقيع الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور بيانات الأعضاء في مواضيع المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"detailtopic\">";

            echo "<option value=\"1\" " . ($forum_object->forum_detailtopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_detailtopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل بيانات الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور بيانات الأعضاء في مشاركات المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"detailreply\">";

            echo "<option value=\"1\" " . ($forum_object->forum_detailreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_detailreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل بيانات الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور أوصاف الأعضاء في مواضيع المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"wasaftopic\">";

            echo "<option value=\"1\" " . ($forum_object->forum_wasaftopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_wasaftopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل أوصاف الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">ظهور أوصاف الأعضاء في مشاركات المنتدى</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"wasafreply\">";

            echo "<option value=\"1\" " . ($forum_object->forum_wasafreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_wasafreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل أوصاف الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">عدد المشاركات و المواضيع المسموح بهم يوميا</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input size=\"1\" class=\"input\" name=\"topic\" value=\"{$forum_object->forum_totaltopic}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عدد المواضيع المسموح به يوميا في هذا المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<input size=\"1\" class=\"input\" name=\"reply\" value=\"{$forum_object->forum_totalreply}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عدد المشاركات المسموح به يوميا في هذا المنتدى</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">تطبيق الرقابة على المواضيع و المشاركات</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"modetopic\">";

            echo "<option value=\"0\" " . ($forum_object->forum_moderattopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_moderattopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل مواضيع هذا المنتدى تنتظر موافقة المشرفي أو المراقب أو نائب المراقب ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"modereply\">";

            echo "<option value=\"0\" " . ($forum_object->forum_moderatreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "<option value=\"1\" " . ($forum_object->forum_moderatreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل مشاركات هذا المنتدى تنتظر موافقة المشرفي أو المراقب أو نائب المراقب ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">مشاهدة الروابط بعد الرد</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"urlshowtopic\">";

            echo "<option value=\"1\" " . ($forum_object->forum_urlshowtopic == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_urlshowtopic == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يجب على العضو الرد ليتمكن من مشاهدة روابط الموضوع ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"urlshowreply\">";

            echo "<option value=\"1\" " . ($forum_object->forumurlshowreply == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_urlshowreply == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يجب على العضو الرد ليتمكن من مشاهدة روابط ردود الموضوع ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"tcotadmin\">مشاهدة المحتوى من قبل الزوار</td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"visitortopicshow\">";

            echo "<option value=\"1\" " . ($forum_object->forum_visitortopicshow == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_visitortopicshow == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للزوآر مشآهدة محتوى المواضيع ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

            echo "<select class=\"inputselect\" name=\"visitorreplyshow\">";

            echo "<option value=\"1\" " . ($forum_object->forum_visitorreplyshow == 1 ? "selected" : "") . ">نعم</option>";

            echo "<option value=\"0\" " . ($forum_object->forum_visitorreplyshow == 0 ? "selected" : "") . ">لآ</option>";

            echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للزوآر مشآهدة محتوى ردود المواضيع ؟</span>";

            echo "</div></td></tr>";

            echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

            echo "</table></form>";
        }
    } elseif (fort == "delete") {

        delete_mysql("arab-forums", "forum", "forum_id in({$forum_object->forum_id})");

        $arraymsg = array(

            "msg" => "تم حذف المنتدى بنجاح تام",

            "color" => "good",

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "lock") {

        if ($forum_object->forum_lock == 1) {
            $error = false;
            $text = "المنتدى مغلوق من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم غلق المنتدى بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "forum", "forum_lock = \"1\" where forum_id in({$forum_object->forum_id})");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "nolock") {

        if ($forum_object->forum_lock == 0) {
            $error = false;
            $text = "المنتدى مفتوح من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم فتح المنتدى بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "forum", "forum_lock = \"0\" where forum_id in({$forum_object->forum_id})");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "hid") {

        if ($forum_object->forum_hid1 == 1) {
            $error = false;
            $text = "المنتدى مخفي من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم إخفاء المنتدى بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "forum", "forum_hid1 = \"1\" where forum_id in({$forum_object->forum_id})");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "nohid") {

        if ($forum_object->forum_hid1 == 0) {
            $error = false;
            $text = "المنتدى ظاهر من قبل";
            $class = "error";
        } else {
            $error = true;
            $text = "تم إظهار المنتدى بنجاح تام";
            $class = "good";
        }

        if ($error == true) {
            update_mysql("arab-forums", "forum", "forum_hid1 = \"0\" where forum_id in({$forum_object->forum_id})");
        }

        $arraymsg = array(

            "msg" => $text,

            "color" => $class,

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } elseif (fort == "goshow") {

        if ($forum_object->forum_hid1 == 0) {

            $error = "يجب عليك إخفاء المنتدى أولا";
        } else {

            $error = "";
        }

        if ($error == "") {

            $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

            $gets  = text_other("arab-forums", post_other("arab-forums", "gets"), false, false, false, false, false);

            $import = @implode(",", $allyu);

            if (isset($gets)) {

                if ($allyu == 0) {

                    $arraymsg = array(

                        "msg" => "الرجاء تحديد عضو وآحد على الأقل ليتم حذفه",

                        "color" => "error",

                        "url" => "",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                } else {

                    delete_mysql("arab-forums", "hidforum", "hidforum_id in({$import})");

                    $arraymsg = array(

                        "msg" => "تم حذف الأعضاء المحددين بنجآح تآم",

                        "color" => "good",

                        "url" => "",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                }
            } elseif (type == "insert") {

                $user = text_other("arab-forums", post_other("arab-forums", "user"), false, false, false, false, false);

                $addwhat = text_other("arab-forums", post_other("arab-forums", "addwhat"), true, true, true, false, true);

                $import = @implode(",", $user);

                if (counts_other("arab-forums", $user) == 0) {

                    $arraymsg = array(

                        "msg" => "الرجاء إدخال رقم أو إسم عضو وآحد على الأقل",

                        "color" => "error",

                        "url" => "",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                } else {

                    if ($addwhat == "name") {

                        $goadd = "user_nameuser";
                    } else {

                        $goadd = "user_id";
                    }

                    for ($x = 0; $x < count($user); ++$x) {

                        $useroft = text_other("arab-forums", $user[$x], true, true, true, false, true);

                        if ($useroft != "") {

                            $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_wait , user_bad", "where {$goadd} = \"{$useroft}\" && user_wait in(0) && user_bad in(0) limit 1");

                            if (num_mysql("arab-forums", $user_sql) != false) {

                                $user_object = object_mysql("arab-forums", $user_sql);

                                $gogo_sql = select_mysql("arab-forums", "hidforum", "hidforum_id , hidforum_forumid , hidforum_userid", "where hidforum_forumid in({$forum_object->forum_id}) && hidforum_userid in({$user_object->user_id}) limit 1");

                                if (num_mysql("arab-forums", $gogo_sql) == false) {

                                    insert_mysql("arab-forums", "hidforum", "hidforum_id , hidforum_forumid , hidforum_catid , hidforum_userid , hidforum_add , hidforum_date", "null , \"{$forum_object->forum_id}\" , \"{$forum_object->forum_catid}\" , \"{$user_object->user_id}\" , \"" . id_user . "\" , \"" . time() . "\"");

                                    $textopp = "إشعار بفتح المنتدى المخفي لك رقم : {$forum_object->forum_id}";

                                    $editor = text_other("arab-forums", "<br><br>السلام عليكم و رحمة الله و براكته<br><br>لقم تم فتح لك المنتدى المخفي رقم : {$forum_object->forum_id}<br><br>بواسطة الإدارة العامة للمنتدى<br><br>يمكنك الدخول و المشاركة في المنتدى من هنا : " . a_other("arab-forums", "forum.php?id={$forum_object->forum_id}", "{$forum_object->forum_name}", "{$forum_object->forum_name}", "") . "<br><br><br>", false, true, false, false, true);

                                    insert_mysql("arab-forums", "message", "message_id , message_getid , message_getmy , message_getto , message_getto2 , message_folder , message_type , message_reade , message_date , message_name , message_message", "null , \"{$user_object->user_id}\", \"{$user_object->user_id}\" , \"0\" , \"" . id_user . "\" , \"-1\" , \"1\" , \"0\" , \"" . time() . "\" , \"{$textopp}\" , \"{$editor}\"");
                                }
                            }
                        }
                    }

                    $arraymsg = array(

                        "msg" => "تم إدخال الأعضاء إلى القائمة بنجاح تام<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير موجود بالقائمة مسبقا و ذلك لتفادي الأخطاء",

                        "color" => "good",

                        "url" => "admin.php?gert=catforum&go=catforum_optionforum&fort=goshow&id={$forum_object->forum_id}",

                    );

                    echo msgadmin_template("arab-forums", $arraymsg);
                }
            } else {

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"100%\" align=\"center\"><tr>";

                echo "<td width=\"100%\"></td>";

                $count_page = tother_option;

                $get_page = (page == "" || !is_numeric(page) ? 1 : page);

                $limit_page = (($get_page * $count_page) - $count_page);

                echo page_pager("arab-forums", "hidforum", "hidforum_id , hidforum_forumid", "where hidforum_forumid in({$forum_object->forum_id})", $count_page, $get_page, "admin.php?gert=catforum&go=catforum_optionforum&fort=goshow&id={$forum_object->forum_id}&");

                echo "</tr></table>";

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"100%\" align=\"center\"><tr>";

                echo "<td><nobr><input class=\"button\" value=\"حذف الأعضاء المحددين من القائمة\" type=\"submit\" name=\"gets\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأعضاء المحددين من القائمة ؟") . "></nobr></td>";

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">الأعضاء المسموح لهم بالدخول للمنتدى رقم : {$forum_object->forum_id}</div></td></tr>";

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><div class=\"pad\"><br>{$forum_object->forum_name}<br><br></div></td></tr>";

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

                $hidforum_sql = select_mysql("arab-forums", "hidforum", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , h.hidforum_id , h.hidforum_userid , h.hidforum_add , h.hidforum_date , h.hidforum_forumid", "as h left join user" . prefix_connect . " as u1 on(u1.user_id = h.hidforum_userid) left join user" . prefix_connect . " as u2 on(u2.user_id = h.hidforum_add) where h.hidforum_forumid in({$forum_object->forum_id}) order by h.hidforum_date desc limit {$limit_page},{$count_page}");

                if (num_mysql("arab-forums", $hidforum_sql) != false) {

                    while ($hidforum_object = object_mysql("arab-forums", $hidforum_sql)) {

                        echo "<tr align=\"center\" class=\"alttext1\" id=\"tr_{$hidforum_object->hidforum_id}\">";

                        echo "<td class=\"topic\"><input onclick=\"check1(this, '{$hidforum_object->hidforum_id}' , 'alttext1' , 'العضو' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد العضو\" value=\"{$hidforum_object->hidforum_id}\"><input type=\"hidden\" name=\"bg_{$hidforum_object->hidforum_id}\" id=\"bg_{$hidforum_object->hidforum_id}\" value=\"alttext1\"></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($hidforum_object->u1user_id, $hidforum_object->u1user_group, $hidforum_object->u1user_name, $hidforum_object->u1user_lock, $hidforum_object->u1user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . user_other("arab-forums", array($hidforum_object->u2user_id, $hidforum_object->u2user_group, $hidforum_object->u2user_name, $hidforum_object->u2user_lock, $hidforum_object->u2user_color, false)) . "</span></td>";

                        echo "<td class=\"topic\"><span style=\"font-size:13px;\">" . times_date("arab-forums", "", $hidforum_object->hidforum_date) . "</span></td>";

                        echo "</tr>";
                    }
                } else {

                    echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"4\"><br><br>لا يوجد أعضاء<br><br><br></td></tr>";
                }

                echo "</table>";

                echo "</form><br>";

                echo "<form action=\"admin.php?gert=catforum&go=catforum_optionforum&fort=goshow&id={$forum_object->forum_id}&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"100%\" align=\"center\">";

                echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"5\"><div class=\"pad\">إدخال قائمة جديدة من الأعضاء ليتمكنو من الدخول إلى المنتدى</div></td></tr>";

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
            }
        } else {

            $arraymsg = array(

                "msg" => $error,

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        $arraymsg = array(

            "msg" => "عفوآ لقد قمت بإختيار خدمة غير متوفرة حاليا",

            "color" => "error",

            "url" => "admin.php?gert=catforum&go=catforum_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    $arraymsg = array(

        "msg" => "المنتدى المختار غير موجود ضمن قائمة المنتديات",

        "color" => "error",

        "url" => "admin.php?gert=catforum&go=catforum_list",

    );

    echo msgadmin_template("arab-forums", $arraymsg);
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
