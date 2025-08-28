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

define("pagebody", "mip");

$get_id = (id == "" || !is_numeric(id) ? id_user : id);

if ($get_id != id_user && group_user != 6) {

    $get_id = id_user;
}

$user_sql = select_mysql("arab-forums", "user", "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex", "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if (num_mysql("arab-forums", $user_sql) == false) {

    $error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";
} else {

    $user_object = object_mysql("arab-forums", $user_sql);

    if (group_user == 0 && group_user == 1) {

        $error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";
    } else {

        $error = "";
    }
}

if ($error != "") {

    online_other("arab-forums", "mip", "0", "0", "0", "0");

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

    online_other("arab-forums", "mip", "0", "0", "0", $user_object->user_id);

    if ($user_object->user_id == id_user) {

        $usertitle = "تتبع الدخول لعضويتك";

        $urltt = "mip.php";

        $urltp = "mip.php?";
    } else {

        $usertitle = "تتبع الدخول " . ($user_object->user_sex == 1 ? "للعضو" : "للعضوة") . " " . $user_object->user_nameuser . "";

        $urltt = "mip.php?id={$user_object->user_id}";

        $urltp = "mip.php?id={$user_object->user_id}&";
    }

    echo bodytop_template("arab-forums", $usertitle);

    $arrayheader = array(

        "login" => true,

    );

    echo header_template("arab-forums", $arrayheader);

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td>" . img_other("arab-forums", "images/mip.png", "", "", "", "0", "", "") . "</td>";

    echo "<td width=\"100%\">" . a_other("arab-forums", "{$urltt}", "{$usertitle}", "{$usertitle}", "") . "</td>";

    $count_page = tother_option;

    $get_page = (page == "" || !is_numeric(page) ? 1 : page);

    $limit_page = (($get_page * $count_page) - $count_page);

    echo page_pager("arab-forums", "ip", "ip_id , ip_user", "where ip_user in({$user_object->user_id})", $count_page, $get_page, "{$urltp}");

    echo list_forumcatlist("arab-forums");

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"40%\" align=\"center\">";

    $ip_sql = select_mysql("arab-forums", "ip", "ip_id , ip_ip , ip_user , ip_date , ip_type , ip_code", "where ip_user in({$user_object->user_id}) order by ip_date desc limit {$limit_page},{$count_page}");

    if (num_mysql("arab-forums", $ip_sql) != false) {

        echo "<tr align=\"center\">";

        echo "<td class=\"tcat\" width=\"35%\"><div class=\"pad\">الأيبي</div></td>";

        echo "<td class=\"tcat\" width=\"30%\" colspan=\"2\"><div class=\"pad\">الدولة</div></td>";

        echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">الحالة</div></td>";

        echo "<td class=\"tcat\" width=\"25%\"><div class=\"pad\">الوقت</div></td>";

        echo "</tr>";

        while ($ip_object = object_mysql("arab-forums", $ip_sql)) {

            echo "<tr align=\"center\">";

            echo "<td class=\"alttext1\"><br><br>" . (group_user > 2 ? $ip_object->ip_ip : hasip_other("arab-forums", $ip_object->ip_ip)) . "<br><br><br></td>";

            echo "<td class=\"alttext2\" width=\"5%\">" . img_other("arab-forums", "images/flags/" . strtolower($ip_object->ip_code) . ".png", countip_other("arab-forums", $ip_object->ip_code), "", "", "0", "class=\"title\"", "") . "</td>";

            echo "<td class=\"alttext1\">" . countip_other("arab-forums", $ip_object->ip_code) . "</td>";

            echo "<td class=\"alttext2\">" . ($ip_object->ip_type == 2 ? img_other("arab-forums", "images/ipy.png", "دخول ناجح", "", "", "0", "class=\"title\"", "") : img_other("arab-forums", "images/ipn.png", "محاولة دخول فاشلة", "", "", "0", "class=\"title\"", "")) . "</td>";

            echo "<td class=\"alttext1\">" . times_date("arab-forums", "", $ip_object->ip_date) . "</td>";

            echo "</tr>";
        }
    } else {

        echo "<tr align=\"center\">";

        echo "<td class=\"alttext1\" colspan=\"6\"><br><div class=\"pad\">لا توجد أي محاولة دخول حاليا</div><br></td>";

        echo "</tr>";
    }

    echo "</table>";

    echo footer_template("arab-forums");

    echo bodybottom_template("arab-forums");
}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
