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

if (per_other("arab-forums", 10) == false) {

    $error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";
} else {

    $error = "";
}

if ($error == "") {

    if (type == "insert") {

        $addwhat = text_other("arab-forums", post_other("arab-forums", "addwhat"), true, true, true, true, true);

        $useroft = text_other("arab-forums", post_other("arab-forums", "userid"), true, true, true, true, true);

        $plaseid = text_other("arab-forums", post_other("arab-forums", "plaseid"), true, true, true, true, true);

        if (wasafallo_other("arab-forums", $plaseid, 1, "goall", true) == false) {

            $error = "لا يمكنك توزيع هذا الوصف على الأعضاء لأنك لا تملك التصريح المناسب";
        } elseif (userallo_other("arab-forums", $addwhat, $useroft) == false) {

            $error = "لا يمكنك توزيع الوصف على العضوية المحددة لأن لا تملك التصريح المناسب";
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

            if ($addwhat == "name") {

                $goadd = "user_nameuser";
            } else {

                $goadd = "user_id";
            }

            if (group_user > 2) {

                $lockw = 0;

                $plus = "";
            } else {

                $lockw = 1;

                $plus = "لآكن ينتظرون موافقة المراقب";
            }

            if ($addwhat == "name") {

                $goadd = "user_nameuser";
            } else {

                $goadd = "user_id";
            }

            $user_sql = select_mysql("arab-forums", "user", "user_id , user_nameuser", "where {$goadd} = \"{$useroft}\"  limit 1");

            $user_object = object_mysql("arab-forums", $user_sql);

            $gogo_sql = select_mysql("arab-forums", "getwasaf", "getwasaf_id , getwasaf_wasafid , getwasaf_userid", "where getwasaf_wasafid in({$plaseid}) && getwasaf_userid in({$user_object->user_id}) limit 1");

            if (num_mysql("arab-forums", $gogo_sql) == false) {

                insert_mysql("arab-forums", "getwasaf", "getwasaf_id , getwasaf_wasafid , getwasaf_userid , getwasaf_lock , getwasaf_add , getwasaf_date", "null , \"{$plaseid}\" , \"{$user_object->user_id}\" , \"{$lockw}\" , \"" . id_user . "\" , \"" . time() . "\"");
            }

            $arraymsg = array(

                "msg" => "تم إضافة الوصف إلى العضو بنجآح تام {$plus}<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير حاصل على الوصف نفسه من قبل و ذلك لتفادي الأخطاء",

                "color" => "good",

                "url" => "service.php?gert=wasaf&go=wasaf_listgo",

            );

            echo msgadmin_template("arab-forums", $arraymsg);
        }
    } else {

        if (is_numeric(plase)) {

            $opplas = plase;
        } else {

            $opplas = "";
        }

        if (is_numeric(user)) {

            $userlas = user;
        } else {

            $userlas = "";
        }

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/service.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">توزيع وصف فردي</span></td>";

        echo "</tr></table>";

        echo "<form action=\"service.php?gert=wasaf&go=wasaf_goone&type=insert\" method=\"post\">";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

        echo "<tr align=\"center\"><td class=\"tcotadmin\" colspan=\"5\"><div class=\"pad\">رقم الوصف</div></td></tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><input style=\"width:80px\" class=\"input\" name=\"plaseid\" value=\"{$opplas}\" type=\"text\"></div></td>";

        echo "</tr>";

        echo "<tr align=\"center\"><td class=\"tcotadmin\" colspan=\"5\"><div class=\"pad\">إسم أو رقم العضوية</div></td></tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\">";

        echo "<select class=\"inputselect\" name=\"addwhat\">";

        echo "<option value=\"name\" " . (orp == "name" ? "selected" : "") . ">إدخال بإسم العضوية</option>";

        echo "<option value=\"id\" " . (orp == "id" ? "selected" : "") . ">إدخال برقم العضوية</option>";

        echo "</select></div></td>";

        echo "</tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><input style=\"width:80px\" class=\"input\" name=\"userid\" value=\"{$userlas}\" type=\"text\"></div></td>";

        echo "</tr>";

        echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"توزيع الوصف على العضوية\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد توزيع الوصف على العضوية المدخلة ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";

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
