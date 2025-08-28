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

$name = text_other("arab-forums", post_other("arab-forums", "name"), true, true, true, true, true);

$email = text_other("arab-forums", post_other("arab-forums", "email"), true, true, true, true, true);

$pass = text_other("arab-forums", post_other("arab-forums", "pass"), true, true, true, true, true);

if ($name == "" || $pass == "" || $email == "") {

    $error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $error = "الإيميل المدخل غير صحيح";
} else {

    $error = "";
}

if ($error == "") {

    insert_mysql("arab-forums", "user", "user_id , user_namelogin , user_nameuser , user_pass , user_email , user_dateregister , user_adressip , user_group , user_sex , user_coderegister", "null , \"" . $name . "\" , \"" . $name . "\" , \"" . pass_other("arab-forums", $pass) . "\" , \"" . $email . "\" , \"" . time() . "\" , \"" . ip_other("arab-forums") . "\" , \"6\" , \"1\" , \"" . md5(code_other("arab-forums", 10)) . "\"");

    insert_mysql("arab-forums", "cat", "cat_id , cat_name", "null , \"فئة تجريبية\"");

    insert_mysql("arab-forums", "forum", "forum_id , forum_catid, forum_name, forum_wasaf, forum_logo", "null , \"1\", \"منتدى تجريبي\", \"تجريب منتدى جديد للنسخة\", \"http://www.startimes.com/icon.aspx?i=forum211\"");

    insert_mysql("arab-forums", "topic", "topic_id , topic_forumid, topic_date, topic_user, topic_name, topic_message", "null , \"1\", \"" . time() . "\", \"1\", \"موضوع تجريبي للنسخة\", \"تجريب موضوع جديد لنسخة Arab Forums - أهلا و سهلا بك\"");

    update_mysql("arab-forums", "forum", "forum_topic = forum_topic+1 , forum_lastdate = \"" . time() . "\" , forum_lastuser = \"1\" where forum_id in(1)");

    echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

    echo "<tr align=\"center\">";

    echo "<td class=\"alttext1\"><nobr><br>تم إدخال معلومات المدير بنجآح تام<br><br></nobr></td>";

    echo "</tr>";

    echo "<tr align=\"center\">";

    echo "<form action=\"install.php?go=install&type=insertip1\" method=\"post\">";

    echo "<td class=\"tcat\"><nobr><input class=\"button\" value=\"الإنتقال إلى الخطوة التالية\" type=\"submit\"></nobr></td>";

    echo "</form>";

    echo "</tr>";

    echo "</table>";
} else {

    echo "<table class=\"border\" cellpadding=\"6\" cellspacing=\"1\" width=\"60%\" align=\"center\">";

    echo "<tr align=\"center\">";

    echo "<td class=\"alttext1\"><nobr><br>{$error}<br><br>" . a_other("arab-forums", "install.php?go=install&type=admin", "أنقر هنا للرجوع", "أنقر هنا للرجوع", "") . "<br><br></nobr></td>";

    echo "</tr>";

    echo "</table>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
