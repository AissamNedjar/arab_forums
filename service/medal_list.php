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

if (per_other("arab-forums", 9) == false) {

    $error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";
} elseif (is_numeric(value) && allowedin3_other("arab-forums", value, 1) == false) {

    $error = "للأسف لا يمكنك عرض الأوسمة في هذا المنتدى لأنك لا تملك التصريح المناسب";
} else {

    $error = "";
}

if ($error == "") {

    $allyu  = text_other("arab-forums", post_other("arab-forums", "allyu"), false, false, false, false, false);

    $wait  = text_other("arab-forums", post_other("arab-forums", "wait"), false, false, false, false, false);

    $bad  = text_other("arab-forums", post_other("arab-forums", "bad"), false, false, false, false, false);

    $delete  = text_other("arab-forums", post_other("arab-forums", "delete"), false, false, false, false, false);

    $import = @implode(",", $allyu);

    if (isset($wait)) {

        if ($allyu == 0) {

            $arraymsg = array(

                "msg" => "الرجاء تحديد وسام وآحد على الأقل ليتم الموافقة عليه",

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "medal", "medal_lock = \"0\" where medal_id in({$import})");

            $arraymsg = array(

                "msg" => "تم الموافقة على الأوسمة المحددة بنجآح تام",

                "color" => "good",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } elseif (isset($bad)) {

        if ($allyu == 0) {

            $arraymsg = array(

                "msg" => "الرجاء تحديد وسام وآحد على الأقل ليتم رفضه",

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "medal", "medal_lock = \"2\" where medal_id in({$import})");

            $arraymsg = array(

                "msg" => "تم رفض الأوسمة المحددة بنجآح تام",

                "color" => "good",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } elseif (isset($delete)) {

        if ($allyu == 0) {

            $arraymsg = array(

                "msg" => "الرجاء تحديد وسام وآحد على الأقل ليتم حذفه",

                "color" => "error",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        } else {

            update_mysql("arab-forums", "medal", "medal_lock = \"3\" where medal_id in({$import})");

            $arraymsg = array(

                "msg" => "تم حذف الأوسمة المحددة بنجآح تام",

                "color" => "good",

                "url" => "",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        if (type == "wait") {

            $sqlo = "w.medal_lock in(1)";

            $sqly = "medal_lock in(1)";

            $texto = "تعرض الأوسمة التي تنتظر الموافقة";

            $urlo = "&type=wait";
        } elseif (type == "bad") {

            $sqlo = "w.medal_lock in(2)";

            $sqly = "medal_lock in(2)";

            $texto = "تعرض الأوسمة المرفوضة";

            $urlo = "&type=bad";
        } elseif (type == "delete") {

            $sqlo = "w.medal_lock in(3)";

            $sqly = "medal_lock in(3)";

            $texto = "تعرض الأوسمة المحذوفة";

            $urlo = "&type=delete";
        } else {

            $sqlo = "w.medal_lock in(0)";

            $sqly = "medal_lock in(0)";

            $texto = "تعرض الأوسمة السارية حالية";

            $urlo = "";
        }

        if (is_numeric(value)) {

            $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name", "where forum_id in(" . value . ") limit 1");

            $forum_object = object_mysql("arab-forums", $forum_sql);

            $textu = "عرض الأوسمة في : {$forum_object->forum_name}";

            $urlp = "&value={$forum_object->forum_id}";

            $sqlp = "&& w.medal_forumid in({$forum_object->forum_id})";

            $sqlu = "&& medal_forumid in({$forum_object->forum_id})";
        } else {

            $textu = "عرض جميع الأوسمة في المنتديات التي أشرف عليها";

            $urlp = "";

            $sqlp = "&& (w.medal_forumid in(0) || w.medal_forumid in(" . allowedin1_other("arab-forums") . "))";

            $sqlu = "&& (medal_forumid in(0) || medal_forumid in(" . allowedin1_other("arab-forums") . "))";
        }

        $count_page = tother_option;

        $get_page = (page == "" || !is_numeric(page) ? 1 : page);

        $limit_page = (($get_page * $count_page) - $count_page);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/service.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">{$textu}<br><br>{$texto}</span></td>";

        echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض الأوسمة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

        echo "<option value=\"service.php?gert=medal&go=medal_list{$urlp}\" " . (type == "" ? "selected" : "") . ">السارية حاليا</option>";

        echo "<option value=\"service.php?gert=medal&go=medal_list{$urlp}&type=wait\" " . (type == "wait" ? "selected" : "") . ">التي تنتظر الموافقة</option>";

        echo "<option value=\"service.php?gert=medal&go=medal_list{$urlp}&type=bad\" " . (type == "bad" ? "selected" : "") . ">المرفوضة</option>";

        echo "<option value=\"service.php?gert=medal&go=medal_list{$urlp}&type=delete\" " . (type == "delete" ? "selected" : "") . ">المحذوفة</option>";

        echo "</select></div></td>";

        echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض أوسمة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

        echo "<option value=\"service.php?gert=medal&go=medal_list{$urlo}\" " . (value == "" ? "selected" : "") . ">عرض الأوسمة التابعة للمنتديات التي أشرف عليها</option>";

        $forum_sql = select_mysql("arab-forums", "forum", "forum_id , forum_name , forum_order", "where forum_id in(" . allowedin1_other("arab-forums") . ") order by forum_order asc");

        if (num_mysql("arab-forums", $forum_sql) != false) {

            while ($forum_object = object_mysql("arab-forums", $forum_sql)) {

                echo "<option value=\"service.php?gert=medal&go=medal_list&value={$forum_object->forum_id}{$urlo}\" " . (value == "{$forum_object->forum_id}" ? "selected" : "") . ">عرض أوسمة {$forum_object->forum_name}</option>";
            }
        }

        echo "</select></div></td>";

        echo page_pager("arab-forums", "medal", "medal_id , medal_forumid , medal_lock", "where {$sqly} {$sqlu}", $count_page, $get_page, "service.php?gert=medal&go=medal_list{$urlp}{$urlo}&");

        echo "</tr></table>";

        if (group_user > 2) {

            echo "<form action=\"" . self . "\" method=\"post\">";

            echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

            if (type == "wait" || type == "delete" || type == "bad") {

                echo "<td><nobr><input class=\"button\" value=\"الموافقة على الأوسمة المحددة\" type=\"submit\" name=\"wait\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الأوسمة المحددة ؟") . "></nobr></td>";
            }

            if (type == "wait") {

                echo "<td><nobr><input class=\"button\" value=\"رفض الأوسمة المحددة\" type=\"submit\" name=\"bad\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد رفض الأوسمة المحددة ؟") . "></nobr></td>";
            }

            if (type == "" || type == "wait") {

                echo "<td><nobr><input class=\"button\" value=\"حذف الأوسمة المحددة\" type=\"submit\" name=\"delete\" " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الأوسمة المحددة ؟") . "></nobr></td>";
            }

            echo "<td width=\"100%\"></td>";

            echo "</tr></table>";
        }

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

        $inputtext = array(

            1 => "تحديد جميع الأوسمة",

            2 => "إلغاء تحديد جميع الأوسمة",

            3 => "لا توجد أوسمة بالصفحة حاليا",

            4 => "عدد الأوسمة الذي إخترت هو :",

            5 => "الوسام",

        );

        echo "<tr>";

        if (group_user > 2) {

            echo "<td class=\"tcotadmin\" width=\"5%\" align=\"center\"><input type=\"checkbox\" title=\"{$inputtext["1"]}\" name=\"chk_all\" onclick=\"check2(this.form , this , '{$inputtext["1"]}' , '{$inputtext["2"]}' , '{$inputtext["3"]}' , '{$inputtext["4"]}' , '{$inputtext["5"]}' , 'alttext1 select');\"></td>";
        }

        echo "<td class=\"tcotadmin\" width=\"35%\" align=\"center\" colspan=\"2\">الوسام</td>";

        echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\">النقاط</td>";

        echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تمت الإضافة بواسطة</nobr></td>";

        echo "<td class=\"tcotadmin\" width=\"15%\" align=\"center\"><nobr>تاريخ الإضافة</nobr></td>";

        echo "<td class=\"tcotadmin\" width=\"20%\" align=\"center\">المنتدى</td>";

        echo "<td class=\"tcotadmin\" width=\"10%\" align=\"center\"><nobr>خيارات</nobr></td>";

        echo "</tr>";

        $medal_sql = select_mysql("arab-forums", "medal", "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , f.forum_id , f.forum_name , w.medal_id , w.medal_forumid , w.medal_lock , w.medal_add , w.medal_date , w.medal_name , w.medal_point , w.medal_url", "as w left join user" . prefix_connect . " as u on(u.user_id = w.medal_add) left join forum" . prefix_connect . " as f on(f.forum_id = w.medal_forumid) where {$sqlo} {$sqlp} order by w.medal_date desc limit {$limit_page},{$count_page}");

        if (num_mysql("arab-forums", $medal_sql) != false) {

            while ($medal_object = object_mysql("arab-forums", $medal_sql)) {

                echo "<tr class=\"alttext1\" id=\"tr_{$medal_object->medal_id}\" align=\"center\">";

                if (group_user > 2) {

                    if (($medal_object->medal_forumid > 0) || ($medal_object->medal_forumid == 0 && group_user == 6)) {

                        echo "<td><div class=\"pad\"><input onclick=\"check1(this, '{$medal_object->medal_id}' , 'alttext1' , 'الوسام' , 'alttext1 select');\" type=\"checkbox\" name=\"allyu[]\" title=\"تحديد الوسام\" value=\"{$medal_object->medal_id}\"><input type=\"hidden\" name=\"bg_{$medal_object->medal_id}\" id=\"bg_{$medal_object->medal_id}\" value=\"alttext1\"></div></td>";
                    }
                }

                echo "<td class=\"alttext1\" align=\"center\" width=\"1%\">" . img_other("arab-forums", "{$medal_object->medal_url}", "", "100", "100", "0", "", "images/nophoto.gif") . "</td>";

                echo "<td><div class=\"pad\" align=\"right\">{$medal_object->medal_name}<br><br><span style=\"color:green;font-size:10px;\">رقم الوسام للتوزيع : {$medal_object->medal_id}</span></div></td>";

                echo "<td><div class=\"pad\">{$medal_object->medal_point}</div></td>";

                echo "<td align=\"center\"><div class=\"pad\">" . user_other("arab-forums", array($medal_object->user_id, $medal_object->user_group, $medal_object->user_nameuser, $medal_object->user_lock1, $medal_object->user_coloruser, false)) . "</div></td>";

                echo "<td align=\"center\"><div class=\"pad\">" . times_date("arab-forums", "", $medal_object->medal_date) . "</div></td>";

                echo "<td><div class=\"pad\"><span style=\"color:orange;font-size:12px;\">" . ($medal_object->medal_forumid != 0 ? a_other("arab-forums", "forum.php?id={$medal_object->forum_id}", "{$medal_object->forum_name}", "{$medal_object->forum_name}", "") : "في جميع المنتديات") . "</span></div></td>";

                echo "<td align=\"center\"><table><tr>";

                echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_listgo&id={$medal_object->medal_id}", "مشاهدة على من وزع الوسام", img_other("arab-forums", "images/goshow.png", "", "", "", "0", "", ""), "") . "</td>";

                if (($medal_object->medal_forumid == 0 && group_user == 6) || ($medal_object->medal_forumid > 0)) {

                    if ($medal_object->medal_lock == 0) {

                        echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_option&fort=edit&id={$medal_object->medal_id}", "تعديل الوسام", img_other("arab-forums", "images/edit.png", "", "", "", "0", "", ""), "") . "</td>";

                        echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_goall&plase={$medal_object->medal_id}", "توزيع جماعي للوسام", img_other("arab-forums", "images/replytop.png", "", "", "", "0", "", ""), "") . "</td>";

                        echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_goone&plase={$medal_object->medal_id}", "توزيع فردي للوسام", img_other("arab-forums", "images/replynotop.png", "", "", "", "0", "", ""), "") . "</td>";
                    }

                    if (group_user > 2) {

                        if ($medal_object->medal_lock == 0 || $medal_object->medal_lock == 1) {

                            echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_option&fort=delete&id={$medal_object->medal_id}", "حذف الوسام", img_other("arab-forums", "images/delete.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد حذف الوسام ؟")) . "</td>";
                        }

                        if ($medal_object->medal_lock == 1) {

                            echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_option&fort=bad&id={$medal_object->medal_id}", "رفض الوسام", img_other("arab-forums", "images/getdo.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد رفض الوسام ؟")) . "</td>";
                        }

                        if ($medal_object->medal_lock != 0) {

                            echo "<td>" . a_other("arab-forums", "service.php?gert=medal&go=medal_option&fort=wait&id={$medal_object->medal_id}", "الموافقة على الوسام", img_other("arab-forums", "images/wait.png", "", "", "", "0", "", ""), confirm_other("arab-forums", "هل أنت متأكد من أنك تريد الموافقة على الوسام ؟")) . "</td>";
                        }
                    }
                }

                echo "</tr></table></td>";

                echo "</tr>";
            }
        } else {

            echo "<tr>";

            echo "<td class=\"alttext1\" align=\"center\" colspan=\"8\"><br><div class=\"pad\">لآ يوجد أي وسام حاليا</div><br></td>";

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
