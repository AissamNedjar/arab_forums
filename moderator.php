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

define("pagebody", "moderator");

online_other("arab-forums", "moderator", "0", "0", "0", "0");

if (group_user > 3) {

    if (go == "add") {

        if (type == "insert") {

            $user = text_other("arab-forums", post_other("arab-forums", "user"), false, false, false, false, false);

            $addwhat = text_other("arab-forums", post_other("arab-forums", "addwhat"), true, true, true, true, true);

            $forumsget = text_other("arab-forums", post_other("arab-forums", "forumsget"), true, true, true, true, true);

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
            } elseif ($forumsget == "") {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء إختيار المنتدى المراد ترشيح المشرفين فيه",

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

                if (group_user == 6) {

                    $classmp = "good";

                    $textmp = "";

                    $waitmp = "0";
                } else {

                    $classmp = "info";

                    $textmp = "و لآكن ينتظرون موافقة الإدارة";

                    $waitmp = "2";
                }

                for ($x = 0; $x < count($user); ++$x) {

                    $useroft = text_other("arab-forums", $user[$x], true, true, true, true, true);

                    if ($useroft != "") {

                        $forum_sql = select_mysql("arab-forums", "forum", "forum_id", "where forum_id in({$forumsget}) limit 1");

                        if (num_mysql("arab-forums", $forum_sql) != false) {

                            $forum_object = object_mysql("arab-forums", $forum_sql);

                            $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser , user_wait , user_bad", "where {$goadd} = \"{$useroft}\" && user_wait in(0) && user_bad in(0) limit 1");

                            if (num_mysql("arab-forums", $user_sql) != false) {

                                $user_object = object_mysql("arab-forums", $user_sql);

                                $gogo_sql = select_mysql("arab-forums", "moderate", "moderate_id , moderate_forumid , moderate_userid", "where moderate_forumid in({$forum_object->forum_id}) && moderate_userid in({$user_object->user_id}) limit 1");

                                if (num_mysql("arab-forums", $gogo_sql) == false) {

                                    insert_mysql("arab-forums", "moderate", "moderate_id , moderate_forumid , moderate_userid , moderate_add , moderate_date , moderate_lock", "null , \"{$forum_object->forum_id}\" , \"{$user_object->user_id}\" , \"" . id_user . "\" , \"" . time() . "\" , \"{$waitmp}\"");
                                }
                            }
                        }
                    }
                }

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم ترشيح المشرفين للمنتدى بنجآح تام {$textmp}<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير مرشح للمنتدى المختار مسبقا و ذلك لتفادي الأخطاء",

                    "color" => $classmp,

                    "old" => true,

                    "auto" => false,

                    "text" => "الذهاب إلى التعيينات الإشرافية",

                    "url" => "moderator.php",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            }
        } else {

            echo bodytop_template("arab-forums", "تعيين مشرفين جدد");

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            echo "<form action=\"moderator.php?go=add&type=insert\" method=\"post\">";

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"60%\" align=\"center\">";

            echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"4\"><div class=\"pad\">تعيين مشرفين جدد</div></td></tr>";

            echo "<tr align=\"center\"><td class=\"alttext2\" colspan=\"4\"><br><div class=\"pad\">الرجاء إختيار المنتدى المراد ترشيح المشرفين فيه و القيام بإدخال أسماء العضويات المراد ترشيحهم للإشراف</div><br></td></tr>";

            echo "<tr align=\"center\"><td class=\"alttext2\" colspan=\"4\"><div class=\"pad\"><select class=\"inputselect\" name=\"forumsget\">";

            echo "<option value=\"\">إختر المنتدى الذي تريد ترشيح المشرفين فيه من القائمة</option>";

            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_catid , forum_name , forum_order", "where forum_id in(" . allowedin2_other("arab-forums") . ") order by forum_order asc");

            if (num_mysql("arab-forums", $forum_sql) != false) {

                while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                    echo "<option value=\"{$forum_object->forum_id}\">{$forum_object->forum_name}</option>";
                }
            }

            echo "</select>&nbsp;&nbsp;<select class=\"inputselect\" name=\"addwhat\">";

            echo "<option value=\"name\">إدخال بأسماء العضويات</option>";

            echo "<option value=\"id\">إدخال بأرقام العضويات</option>";

            echo "</select></div></td></tr>";

            echo "<tr align=\"center\">";

            $xi = 0;

            for ($x = 1; $x <= 21; ++$x) {

                if ($xi == 3) {
                    echo "</tr><tr align=\"center\">";
                    $xi = 0;
                }

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:140px\" class=\"input\" name=\"user[]\" value=\"\" type=\"text\"></div></td>";

                $xi++;
            }

            echo "</tr>";

            echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"5\"><br><input type=\"submit\" class=\"button\" value=\"إدخال التعيينات الإشرافية الجديدة\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال التعيينات الإشرافية الجديدة ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

            echo "</table>";

            echo "</form>";

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
    } else {

        $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

        $wait  = text_other("arab-forums", post_other("arab-forums", "wait"), false, false, false, false, false);

        $lock  = text_other("arab-forums", post_other("arab-forums", "lock"), false, false, false, false, false);

        $delete  = text_other("arab-forums", post_other("arab-forums", "delete"), false, false, false, false, false);

        $import = @implode(",", $allyu);

        if (isset($wait)) {

            if ($allyu == 0) {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء تحديد تعيين واحد على الأقل ليتم الموافقة عليه",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                update_mysql("arab-forums", "moderate", "moderate_lock = \"0\" where moderate_id in({$import})");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم الموافقة على التعيينات المحددة بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            }
        } elseif (isset($lock)) {

            if ($allyu == 0) {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء تحديد تعيين واحد على الأقل ليتم تجميده",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                update_mysql("arab-forums", "moderate", "moderate_lock = \"1\" where moderate_id in({$import})");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم تجميد التعيينات المحددة بنجآح تام",

                    "color" => "good",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            }
        } elseif (isset($delete)) {

            if ($allyu == 0) {

                $arraymsg = array(

                    "login" => true,

                    "msg" => "الرجاء تحديد تعيين واحد على الأقل ليتم حذفه",

                    "color" => "error",

                    "old" => true,

                    "auto" => false,

                    "text" => "",

                    "url" => "",

                    "array" => "",

                );

                echo msg_template("arab-forums", $arraymsg);
            } else {

                delete_mysql("arab-forums", "moderate", "moderate_id in({$import})");

                $arraymsg = array(

                    "login" => true,

                    "msg" => "تم حذف التعيينات المحددة بنجآح تام",

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

            echo bodytop_template("arab-forums", "التعيينات الإشرافية");

            $arrayheader = array(

                "login" => true,

            );

            echo header_template("arab-forums", $arrayheader);

            echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            echo "<td>" . img_other("arab-forums", "images/moderator.png", "", "", "", "0", "", "") . "</td>";

            echo "<td width=\"100%\">" . a_other("arab-forums", $urlget, "التعيينات الإشرافية", "التعيينات الإشرافية", "") . "</td>";

            echo "<td class=\"menu\"><nobr>" . a_other("arab-forums", "moderator.php?go=add", "تعيين مشرفين جدد", img_other("arab-forums", "images/nmoderator.png", "", "", "", "0", "", "") . "<br>تعيين مشرفين", "") . "</nobr></td>";

            $count_page = tother_option;

            $get_page = (page == "" || !is_numeric(page) ? 1 : page);

            $limit_page = (($get_page * $count_page) - $count_page);

            echo page_pager("arab-forums", "moderate", "moderate_id , moderate_lock , moderate_forumid", "where moderate_forumid in(" . allowedin2_other("arab-forums") . ")", $count_page, $get_page, "moderator.php?");

            echo list_forumcatlist("arab-forums");

            echo "</tr></table>";

            if (group_user == 6) {

                echo "<form action=\"" . self . "\" method=\"post\">";

                echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

                echo "<td class=\"menu\"><nobr><input class=\"button\" value=\"الموافقة على التعيينات المحددة\" type=\"submit\" name=\"wait\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على التعيينات المحددة ؟") . "></nobr></td>";

                echo "<td class=\"menu\"><nobr><input class=\"button\" value=\"تجميد التعيينات المحددة\" type=\"submit\" name=\"lock\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد تجميد التعيينات المحددة ؟") . "></nobr></td>";

                echo "<td class=\"menu\"><nobr><input class=\"button\" value=\"حذف التعيينات المحددة\" type=\"submit\" name=\"delete\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف التعيينات المحددة ؟") . "></nobr></td>";

                echo "<td width=\"100%\"></td>";

                echo "</tr></table>";
            }

            echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

            echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"6\"><div class=\"pad\">التعيينات الإشرافية على المنتديات التي تراقب عليها</div></td></tr>";

            echo "<tr align=\"center\">";

            if (group_user == 6) {

                $inputtext = array(

                    1 => "تحديد جميع التعيينات",

                    2 => "إلغاء تحديد جميع التعيينات",

                    3 => "لا يوجد تعيينات بالصفحة حاليا",

                    4 => "عدد التعيينات الذي إخترت هو :",

                    5 => "التعيين",

                );

                echo "<td class=\"tcat\" width=\"3%\"><div class=\"pad\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></div></td>";
            }

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">الإسم</div></td>";

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">تم التعيين بواسطة</div></td>";

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">تاريخ التعيين</div></td>";

            echo "<td class=\"tcat\" width=\"37%\"><div class=\"pad\">المنتدى</div></td>";

            echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">الحالة</div></td>";

            echo "</tr>";

            $moderate_sql = select_mysql("arab-forums", "moderate", "u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , m.moderate_id , m.moderate_forumid , m.moderate_userid , m.moderate_lock , m.moderate_add , m.moderate_date , f.forum_id , f.forum_name", "as m left join user" . prefix_connect . " as u1 on(u1.user_id = m.moderate_userid) left join user" . prefix_connect . " as u2 on(u2.user_id = m.moderate_add) left join forum" . prefix_connect . " as f on(f.forum_id = m.moderate_forumid) order by m.moderate_lock desc , m.moderate_date desc limit {$limit_page},{$count_page}");

            if (num_mysql("arab-forums", $moderate_sql) == false) {

                echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"6\"><br><br>لا توجد تعيينات تابعة لمنتديات تحت رقابتك<br><br><br></td></tr>";
            } else {

                while ($moderate_object = object_mysql("arab-forums", $moderate_sql)) {

                    if ($moderate_object->moderate_lock == 0) {

                        $colort = "green";

                        $textt = "ساري حاليا";
                    } elseif ($moderate_object->moderate_lock == 1) {

                        $colort = "red";

                        $textt = "مجمد";
                    } else {

                        $colort = "blue";

                        $textt = "ينتظر الموافقة";
                    }

                    echo "<tr class=\"alttext1\" id=\"tr_{$moderate_object->moderate_id}\" align=\"center\">";

                    if (group_user == 6) {

                        echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$moderate_object->moderate_id}' , 'alttext1' , 'التعيين' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد التعيين\" value=\"{$moderate_object->moderate_id}\"><input type=\"hidden\" name=\"bg_{$moderate_object->moderate_id}\" id=\"bg_{$moderate_object->moderate_id}\" value=\"alttext1\"></div></td>";
                    }

                    echo "<td><div class=\"pad\"><nobr>" . user_other("arab-forums", array($moderate_object->u1user_id, $moderate_object->u1user_group, $moderate_object->u1user_name, $moderate_object->u1user_lock, $moderate_object->u1user_color, false)) . "</nobr></div></td>";

                    echo "<td><div class=\"pad\"><nobr>" . user_other("arab-forums", array($moderate_object->u2user_id, $moderate_object->u2user_group, $moderate_object->u2user_name, $moderate_object->u2user_lock, $moderate_object->u2user_color, false)) . "</nobr></div></td>";

                    echo "<td><div class=\"pad\"><nobr>" . times_date("arab-forums", "", $moderate_object->moderate_date) . "</nobr></div></td>";

                    echo "<td><div class=\"pad\">" . a_other("arab-forums", "forum.php?id={$moderate_object->forum_id}", "{$moderate_object->forum_name}", "<span style=\"color:orange;font-size:12px;\">{$moderate_object->forum_name}</span>", "") . "</div></td>";

                    echo "<td><div class=\"pad\"><nobr><span style=\"color:{$colort};font-size:12px;\">{$textt}</span></nobr></div></td>";

                    echo "</tr>";
                }
            }

            echo "</table>";

            if (group_user == 6) {

                echo "</form>";
            }

            echo footer_template("arab-forums");

            echo bodybottom_template("arab-forums");
        }
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
