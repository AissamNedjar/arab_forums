<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums", true);

@include("includes.php");

define("pageupdate", false);

@include("includes/e.noopen.php");

define("pagebody", "data");

$get_id = id_user;

$user_sql = select_mysql("arab-forums", "user", "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex , user_pass , user_email , user_days , user_month , user_years , user_age , user_country , user_city , user_state , user_hala , user_photo , user_jobe , user_bio , user_time , user_style , user_editorcolor , user_editoralign , user_editorblod , user_editorfont , user_editorsize", "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if (num_mysql("arab-forums", $user_sql) == false) {

    $error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";
} else {

    $user_object = object_mysql("arab-forums", $user_sql);

    if (group_user == 0) {

        $error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";
    } else {

        $error = "";
    }
}

if ($error != "") {

    online_other("arab-forums", "data", "0", "0", "0", "0");

    $arraymsg = array(

        "login" => true,

        "msg" => $error,

        "color" => "error",

        "old" => true,

        "auto" => false,

        "text" => "",

        "url" => "",

        "array" => "",

    );

    echo msg_template("arab-forums", $arraymsg);
} else {

    online_other("arab-forums", "data", "0", "0", "0", $user_object->user_id);

    if (go == "pass") {

        if (password_option == 1) {

            if (type == "insert") {

                $passold = text_other("arab-forums", post_other("arab-forums", "passold"), true, true, true, true, true);

                $passnew1 = text_other("arab-forums", post_other("arab-forums", "passnew1"), true, true, true, true, true);

                $passnew2 = text_other("arab-forums", post_other("arab-forums", "passnew2"), true, true, true, true, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if ($passold == "" || $passnew1 == "" || $passnew2 == "" || $code == "") {

                    $errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";
                } elseif (pass_other("arab-forums", $passold) != $user_object->user_pass) {

                    $errory = "للأسف الكلمة السرية القديمة غير متطابقة مع بيانتنا";
                } elseif ($passnew1 != $passnew2) {

                    $errory = "للأسف الكلمة السرية الجديدة غير متطابقة مع الإعادة";
                } elseif (pass_other("arab-forums", $passnew1) == $user_object->user_pass) {

                    $errory = "للأسف الكلمة السرية الجديدة نفسها الكلمة السرية القديمة";
                } elseif (mb_strlen($passnew1) < 5 || mb_strlen($passnew1) > 20) {

                    $errory = "الكلمة السرية لا يجب أن تكون أقل من 5 حروف و أكبر من 20 حرف";
                } elseif (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_pass = \"" . pass_other("arab-forums", $passnew1) . "\" where user_id in({$user_object->user_id}) limit 1");

                    set_cookie("arab-forums", "userpass", pass_other("arab-forums", $passnew1), time() + 60 * 60 * 24 * 365);

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير الكلمة السرية بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير الكلمة السرية");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=pass&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير الكلمة السرية</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الكلمة السرية القديمة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"passold\" value=\"\" type=\"password\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الكلمة السرية الجديدة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"passnew1\" value=\"\" type=\"password\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">إعادة الكلمة السرية الجديدة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"passnew2\" value=\"\" type=\"password\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير الكلمة السرية",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "email") {

        if (email_option == 1) {

            if (type == "insert") {

                $email = text_other("arab-forums", post_other("arab-forums", "email"), true, true, true, true, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if ($email == "" || $code == "") {

                    $errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $errory = "البريد الإلكتروني يجب أن يكون صحيح";
                } elseif ($email == $user_object->user_email) {

                    $errory = "البريد الإلكتروني المدخل مطابق للبريد الإلكتروني القديم";
                } elseif (num_mysql("arab-forums", select_mysql("arab-forums", "user", "user_id , user_email", "where user_email = \"" . $email . "\" && user_id != \"{$user_object->user_id}\" limit 1")) == true) {

                    $errory = "البريد الإلكتروني مسجل لعضو آخر مسجل لعضو آخر";
                } elseif (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_email = \"{$email}\" where user_id in({$user_object->user_id}) limit 1");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير البريد الإلكتروني بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير البريد الإلكتروني");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=email&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير الكلمة السرية</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">البريد الإلكتروني القديم : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"emailold\" value=\"{$user_object->user_email}\" type=\"text\" disabled></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">البريد الإلكتروني الجديد : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"email\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير البريد الإلكتروني",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "date") {

        if (age_option == 1) {

            if (type == "insert") {

                $days = text_other("arab-forums", post_other("arab-forums", "days"), true, true, true, true, true);

                $month = text_other("arab-forums", post_other("arab-forums", "month"), true, true, true, true, true);

                $years = text_other("arab-forums", post_other("arab-forums", "years"), true, true, true, true, true);

                $age = text_other("arab-forums", post_other("arab-forums", "age"), true, true, true, true, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if ($days == "" || $month == "" || $years == "" || $age == "" || $code == "") {

                    $errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";
                } elseif (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_days = \"{$days}\" , user_month = \"{$month}\" , user_years = \"{$years}\" , user_age = \"{$age}\" where user_id in({$user_object->user_id}) limit 1");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير تاريخ الإزدياد بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير تاريخ الإزدياد");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=date&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير تاريخ الإزدياد</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">ظهور تاريخ الإزدياد و العمر : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"age\">";

                echo "<option value=\"1\" " . ($user_object->user_age == 1 ? "selected" : "") . ">نعم</option>";

                echo "<option value=\"0\" " . ($user_object->user_age == 0 ? "selected" : "") . ">لآ</option>";

                echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للأعضاء مشاهدة تاريخ الإزدياد و العمر في بيانتك ؟</span>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">تاريخ الإزدياد : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><select class=\"inputselect\" name=\"days\">";

                for ($x = 1; $x <= 31; $x++) {
                    echo "<option value=\"{$x}\" " . ($user_object->user_days == $x ? "selected" : "") . ">{$x}</option>";
                }

                echo "</select>&nbsp;<select class=\"inputselect\" name=\"month\">";

                for ($x = 1; $x <= 12; $x++) {
                    echo "<option value=\"{$x}\" " . ($user_object->user_month == $x ? "selected" : "") . ">{$months_list[$x]}</option>";
                }

                echo "</select>&nbsp;<select class=\"inputselect\" name=\"years\">";

                for ($x = 1904; $x <= 2012; $x++) {
                    echo "<option value=\"{$x}\" " . ($user_object->user_years == $x ? "selected" : "") . ">{$x}</option>";
                }

                echo "</select></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير تاريخ الإزدياد",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "sex") {

        if (sex_option == 1) {

            if (type == "insert") {

                $sex = text_other("arab-forums", post_other("arab-forums", "sex"), true, true, true, true, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if ($sex == "" || $code == "") {

                    $errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";
                } elseif (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_sex = \"{$sex}\" where user_id in({$user_object->user_id}) limit 1");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير الجنس بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير الجنس");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=sex&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير الجنس</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الجنس : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"sex\">";

                echo "<option value=\"1\" " . ($user_object->user_sex == 1 ? "selected" : "") . ">ذكر</option>";

                echo "<option value=\"2\" " . ($user_object->user_sex == 2 ? "selected" : "") . ">أنثى</option>";

                echo "</select>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير الجنس",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "detail") {

        if (detail_option == 1) {

            if (type == "insert") {

                $country = text_other("arab-forums", post_other("arab-forums", "country"), true, true, true, true, true);

                $city = text_other("arab-forums", post_other("arab-forums", "city"), true, true, true, true, true);

                $state = text_other("arab-forums", post_other("arab-forums", "state"), true, true, true, true, true);

                $hala = text_other("arab-forums", post_other("arab-forums", "hala"), true, true, true, true, true);

                $jobe = text_other("arab-forums", post_other("arab-forums", "jobe"), true, true, true, true, true);

                $photo = text_other("arab-forums", post_other("arab-forums", "photo"), true, true, true, true, true);

                $sayra = text_other("arab-forums", post_other("arab-forums", "sayra"), true, false, true, false, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if ($country == "" || $city == "" || $state == "" || $hala == "" || $code == "") {

                    $errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";
                } elseif (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_country = \"{$country}\" , user_city = \"{$city}\" , user_state = \"{$state}\" , user_hala = \"{$hala}\" , user_jobe = \"{$jobe}\" , user_photo = \"{$photo}\" , user_bio = \"{$sayra}\" where user_id in({$user_object->user_id}) limit 1");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير البيانات الشخصية بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير البيانات الشخصية");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=detail&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير البيانات الشخصية</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الدولة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"country\">";

                foreach ($country_list as $code => $name) {

                    echo "<option value=\"{$code}\" " . ($user_object->user_country == $code ? "selected" : "") . ">{$name}</option>";
                }

                echo "</select>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">المدينة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:150px\" class=\"input\" name=\"city\" value=\"{$user_object->user_city}\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">المنطقة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:150px\" class=\"input\" name=\"state\" value=\"{$user_object->user_state}\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الحالة الإجتماعية : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"hala\">";

                foreach ($hala_list as $code => $name) {

                    echo "<option value=\"{$code}\" " . ($user_object->user_hala == $code ? "selected" : "") . ">{$name}</option>";
                }

                echo "</select>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">المهنة : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:300px\" class=\"input\" name=\"jobe\" value=\"{$user_object->user_jobe}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">يمكنك تركها فارغة</span></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الصورة الشخصية : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"photo\" value=\"{$user_object->user_photo}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">يمكنك تركها فارغة</span></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">السيرة الذاتية : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><textarea name=\"sayra\" class=\"textarea\" cols=\"50\" rows=\"5\">{$user_object->user_bio}</textarea></div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير البيانات الشخصية",

                "color" => "error",

                "old" => true,

                "auto" => false,

                "text" => "",

                "url" => "",

                "array" => "",

            );

            echo msg_template("arab-forums", $arraymsg);
        }
    } elseif (go == "default") {

        if (default_option == 1) {

            if (type == "insert") {

                $time = text_other("arab-forums", post_other("arab-forums", "time"), true, true, true, true, true);

                $style = text_other("arab-forums", post_other("arab-forums", "style"), true, true, true, true, true);

                $code = text_other("arab-forums", post_other("arab-forums", "code"), true, true, true, true, true);

                if (md5(strtoupper($code)) != get_cookie("arab-forums", "codedata")) {

                    $errory = "عفوآ الكود غير مطابق للكود المدخل";
                } else {

                    $errory = "";
                }

                if ($errory == "") {

                    update_mysql("arab-forums", "user", "user_time = \"{$time}\" , user_style = \"{$style}\" where user_id in({$user_object->user_id}) limit 1");

                    $arraymsg = array(

                        "login" => true,

                        "msg" => "تم تغيير الإعدادات الإفتراضية بنجآح تام",

                        "color" => "good",

                        "old" => true,

                        "auto" => false,

                        "text" => "",

                        "url" => "data.php",

                        "array" => "",

                    );

                    echo msg_template("arab-forums", $arraymsg);
                } else {

                    $arraymsg = array(

                        "login" => true,

                        "msg" => $errory,

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

                $codey = code_other("arab-forums", 8);

                set_cookie("arab-forums", "codedata", md5(strtoupper($codey)), time() + 60 * 60 * 24 * 365);

                echo bodytop_template("arab-forums", "تغيير الإعدادات الإفتراضية");

                $arrayheader = array(

                    "login" => true,

                );

                echo header_template("arab-forums", $arrayheader);

                echo "<form action=\"data.php?go=default&type=insert\" method=\"post\">";

                echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

                echo "<tr align=\"center\">";

                echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تغيير الإعدادات الإفتراضية</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الوقت الإفتراضي : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"time\">";

                for ($x = -12; $x <= 12; $x++) {

                    echo "<option value=\"" . ($x == 0 ? "00" : $x) . "\" " . ($user_object->user_time == $x ? "selected" : "") . ">GMT " . ($x == 0 ? "" : ($x > 0 ? "+{$x}" : $x)) . "</option>";
                }

                echo "</select>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الستايل الإفتراضي : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\">";

                echo "<select class=\"inputselect\" name=\"style\">";

                $style_sql = select_mysql("arab-forums", "style", "style_name , style_fils , style_lock", "where style_lock = \"0\"");

                if (num_mysql("arab-forums", $style_sql) != false) {

                    while ($style_object = object_mysql("arab-forums", $style_sql)) {

                        echo "<option value=\"{$style_object->style_fils}\" " . ($user_object->user_style == $style_object->style_fils ? "selected" : "") . ">{$style_object->style_name}</option>";
                    }
                }

                echo "</select>";

                echo "</div></td>";

                echo "</tr>";

                echo "<tr align=\"right\">";

                echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

                echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

                echo "</tr>";

                echo "<tr align=\"center\">";

                echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td>";

                echo "</tr>";

                echo "</table>";

                echo "</form>";

                echo footer_template("arab-forums");

                echo bodybottom_template("arab-forums");
            }
        } else {

            $arraymsg = array(

                "login" => true,

                "msg" => "للأسف الإدارة قامت بمنع تغيير الإعدادات الإفتراضية",

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

        echo bodytop_template("arab-forums", "تعديل بيانتك");

        $arrayheader = array(

            "login" => true,

        );

        echo header_template("arab-forums", $arrayheader);

        echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

        echo "<td>" . img_other("arab-forums", "images/data.png", "", "", "", "0", "", "") . "</td>";

        echo "<td width=\"100%\">" . a_other("arab-forums", "data.php", "تعديل بياناتك", "تعديل بياناتك", "") . "</td>";

        echo list_forumcatlist("arab-forums");

        echo "</tr></table>";

        echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"50%\" align=\"center\">";

        echo "<tr align=\"center\">";

        echo "<td class=\"tcat\" colspan=\"4\"><div class=\"pad\">تغيير البيانات الخاصة بك</div></td>";

        echo "</tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=pass", "تغيير الكلمة السرية", img_other("arab-forums", "images/data/pass.png", "", "", "", "0", "", "") . "<br>تغيير الكلمة السرية<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=email", "تغيير البريد الإلكتروني", img_other("arab-forums", "images/data/email.png", "", "", "", "0", "", "") . "<br>تغيير البريد الإلكتروني<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=date", "تغيير تاريخ الإزدياد", img_other("arab-forums", "images/data/date.png", "", "", "", "0", "", "") . "<br>تغيير تاريخ الإزدياد<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=sex", "تغيير الجنس الخاص بك", img_other("arab-forums", "images/data/sex.png", "", "", "", "0", "", "") . "<br>تغيير الجنس الخاص بك<br><br>", "") . "</div></td>";

        echo "</tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=detail", "تغيير البيانات الشخصية", img_other("arab-forums", "images/data/detail.png", "", "", "", "0", "", "") . "<br>تغيير البيانات الشخصية<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "data.php?go=default", "تغيير الإعدادات الإفتراضية", img_other("arab-forums", "images/data/default.png", "", "", "", "0", "", "") . "<br>تغيير الإعدادات الإفتراضية<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "sig.php", "تغيير التوقيع الخاص بك", img_other("arab-forums", "images/data/sig.png", "", "", "", "0", "", "") . "<br>تغيير التوقيع الخاص بك<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "changename.php", "طلب تغيير إسم العضوية", img_other("arab-forums", "images/data/name.png", "", "", "", "0", "", "") . "<br>طلب تغيير إسم العضوية<br><br>", "") . "</div></td>";

        echo "</tr>";

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "topichid.php", "المواضيع المخفية المفتوحة لك", img_other("arab-forums", "images/data/topichid.png", "", "", "", "0", "", "") . "<br>المواضيع المخفية المفتوحة لك<br><br>", "") . "</div></td>";

        echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "topiclock.php", "المواضيع المغلوقة المفتوحة لك", img_other("arab-forums", "images/data/topiclock.png", "", "", "", "0", "", "") . "<br>المواضيع المغلوقة المفتوحة لك<br><br>", "") . "</div></td>";

        if (group_user > 1) {

            echo "<td class=\"alttext1\"><div class=\"pad\">" . a_other("arab-forums", "mip.php", "تتبع الدخول لعضويتك", img_other("arab-forums", "images/data/mip.png", "", "", "", "0", "", "") . "<br>تتبع الدخول لعضويتك<br><br>", "") . "</div></td>";
        } else {

            echo "<td class=\"alttext1\"><div class=\"pad\"></div></td>";
        }

        echo "<td class=\"alttext1\"><div class=\"pad\"></div></td>";

        echo "</tr>";

        echo "</table>";

        echo footer_template("arab-forums");

        echo bodybottom_template("arab-forums");
    }
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
