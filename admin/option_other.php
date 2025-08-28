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

if (type == "insert") {

    $time = text_other("arab-forums", post_other("arab-forums", "time"), true, true, true, false, true);

    $registeroff = text_other("arab-forums", post_other("arab-forums", "registeroff"), true, true, true, false, true);

    $registerwait = text_other("arab-forums", post_other("arab-forums", "registerwait"), true, true, true, false, true);

    $password = text_other("arab-forums", post_other("arab-forums", "password"), true, true, true, false, true);

    $email = text_other("arab-forums", post_other("arab-forums", "email"), true, true, true, false, true);

    $sex = text_other("arab-forums", post_other("arab-forums", "sex"), true, true, true, false, true);

    $age = text_other("arab-forums", post_other("arab-forums", "age"), true, true, true, false, true);

    $detail = text_other("arab-forums", post_other("arab-forums", "detail"), true, true, true, false, true);

    $default = text_other("arab-forums", post_other("arab-forums", "default"), true, true, true, false, true);

    $sig = text_other("arab-forums", post_other("arab-forums", "sig"), true, true, true, false, true);

    $change = text_other("arab-forums", post_other("arab-forums", "change"), true, true, true, false, true);

    if ($time == "" || $registeroff == "" || $registerwait == "" || $password == "" || $email == "" || $sex == "" || $age == "" || $detail == "" || $default == "" || $sig == "" || $change == "") {

        $error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";
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

        update_mysql("arab-forums", "option", "option_value = \"{$time}\" where option_name = \"time\"");

        update_mysql("arab-forums", "option", "option_value = \"{$registeroff}\" where option_name = \"registeroff\"");

        update_mysql("arab-forums", "option", "option_value = \"{$registerwait}\" where option_name = \"registerwait\"");

        update_mysql("arab-forums", "option", "option_value = \"{$password}\" where option_name = \"password\"");

        update_mysql("arab-forums", "option", "option_value = \"{$email}\" where option_name = \"email\"");

        update_mysql("arab-forums", "option", "option_value = \"{$sex}\" where option_name = \"sex\"");

        update_mysql("arab-forums", "option", "option_value = \"{$age}\" where option_name = \"age\"");

        update_mysql("arab-forums", "option", "option_value = \"{$detail}\" where option_name = \"detail\"");

        update_mysql("arab-forums", "option", "option_value = \"{$default}\" where option_name = \"default\"");

        update_mysql("arab-forums", "option", "option_value = \"{$change}\" where option_name = \"change\"");

        update_mysql("arab-forums", "option", "option_value = \"{$sig}\" where option_name = \"sig\"");

        $arraymsg = array(

            "msg" => "تم إدخال البيانات الجديدة بنجآح تآم",

            "color" => "good",

            "url" => "admin.php?gert=option&go=option_other",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=option&go=option_other&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" border=\"0\" width=\"99%\" align=\"center\">";

    echo "<tr><td class=\"tcotadmin\">الوقت الأصلي للمنتدى</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"time\">";

    for ($x = -12; $x <= 12; $x++) {

        echo "<option value=\"" . ($x == 0 ? "00" : $x) . "\" " . (time_option == $x ? "selected" : "") . ">GMT " . ($x == 0 ? "" : ($x > 0 ? "+{$x}" : $x)) . "</option>";
    }

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الوقت الأصلي الخاص بالمنتدى</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">التسجيل</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"registeroff\">";

    echo "<option value=\"0\" " . (registeroff_option == 0 ? "selected" : "") . ">مفتوح</option>";

    echo "<option value=\"1\" " . (registeroff_option == 1 ? "selected" : "") . ">مغلوق</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">التسجيل مفتوح أم مغلوق</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">حالة التسجيل</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"registerwait\">";

    echo "<option value=\"0\" " . (registerwait_option == 0 ? "selected" : "") . ">بدون موافقة أو تفعيل</option>";

    echo "<option value=\"1\" " . (registerwait_option == 1 ? "selected" : "") . ">ينتظر موافقة الإدارة</option>";

    echo "<option value=\"2\" " . (registerwait_option == 2 ? "selected" : "") . ">التفعيل بالبريد الإلكتروني</option>";

    echo "<option value=\"3\" " . (registerwait_option == 3 ? "selected" : "") . ">التفعيل بالبريد الإلكتروني + ينتظر موافقة الإدارة</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">حالة التسجيل بالمنتدى (إن قمت بإختيار التفعيل بالبريد الإلكتروني يجب أن تكون إستضافتك تدعم دالة mail)</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير البيانات</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"detail\">";

    echo "<option value=\"1\" " . (detail_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (detail_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير بيانتهم أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير الكلمة السرية</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"password\">";

    echo "<option value=\"1\" " . (password_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (password_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير الكلمة السرية أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير الإيميل</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"email\">";

    echo "<option value=\"1\" " . (email_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (email_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير الإيميل أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير الجنس</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"sex\">";

    echo "<option value=\"1\" " . (sex_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (sex_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير الجنس أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير تاريخ الإزدياد</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"age\">";

    echo "<option value=\"1\" " . (age_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (age_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير تاريخ الإزدياد أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير الإعدادات الإفتراضية</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"default\">";

    echo "<option value=\"1\" " . (default_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (default_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير الإعدادات الإفتراضية أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بتغيير التوقيع</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"sig\">";

    echo "<option value=\"1\" " . (sig_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (sig_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بتغيير التوقيع أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"tcotadmin\">السماح بطلب تغيير إسم العضوية</td></tr>";

    echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

    echo "<select class=\"inputselect\" name=\"change\">";

    echo "<option value=\"1\" " . (change_option == 1 ? "selected" : "") . ">نعم</option>";

    echo "<option value=\"0\" " . (change_option == 0 ? "selected" : "") . ">لآ</option>";

    echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">السماح للأعضاء بطلب تغيير إسم العضوية أو لآ</span>";

    echo "</div></td></tr>";

    echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  " . confirm_other("arab-forums", "") . "> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

    echo "</table></form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
