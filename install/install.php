<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums", true);

@include("../includes/f.hacker.php");

@include("../includes/f.mysql.php");

@include("../includes/f.other.php");

@include("../includes/f.otherto.php");

echo post_hacker("arab-forums");

echo xss_hacker("arab-forums");

echo sql_hacker("arab-forums");

echo url_hacker("arab-forums");

echo cracker_hacker("arab-forums");

@include("../includes/e.connect.php");

connect_mysql("arab-forums", hostname_connect, username_connect, userpass_connect, dbname_connect);

@include("../includes/e.get.php");

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

echo "<html dir=\"rtl\" xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"ar-dz\"><head>";

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1256\">";

echo "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"images/arab-forums.png\">";

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/style.css\">";

echo "<script type=\"text/javascript\" src=\"themes/jquery.js\"></script>";

echo "<script type=\"text/javascript\" src=\"themes/function.js\"></script>";

echo "<title>Arab Forums 0.2 Install Script</title>";

echo "</head><body>";

echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"90%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\">Arab Forums 0.2 Install Script</td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><br>";

if (go == "install") {

    if (type == "") {

        @include("stupe1.php");
    } elseif (type == "option") {

        @include("stupe2.php");
    } elseif (type == "insertoption") {

        @include("stupe3.php");
    } elseif (type == "admin") {

        @include("stupe4.php");
    } elseif (type == "insertadmin") {

        @include("stupe5.php");
    } elseif (type == "insertip1") {

        @include("stupe6.php");
    } elseif (type == "insertip2") {

        @include("stupe7.php");
    } elseif (type == "insertip3") {

        @include("stupe8.php");
    } elseif (type == "insertip4") {

        @include("stupe9.php");
    } elseif (type == "insertip5") {

        @include("stupe10.php");
    } elseif (type == "insertip6") {

        @include("stupe11.php");
    } elseif (type == "insertip7") {

        @include("stupe12.php");
    } elseif (type == "insertip8") {

        @include("stupe13.php");
    } elseif (type == "insertip9") {

        @include("stupe14.php");
    } elseif (type == "insertip10") {

        @include("stupe15.php");
    } elseif (type == "insertip11") {

        @include("stupe16.php");
    } elseif (type == "insertip12") {

        @include("stupe17.php");
    } elseif (type == "insertip13") {

        @include("stupe18.php");
    } elseif (type == "insertip14") {

        @include("stupe19.php");
    } elseif (type == "insertip15") {

        @include("stupe20.php");
    } elseif (type == "insertip16") {

        @include("stupe21.php");
    }
} elseif (go == "updatec0lddz") {

    $connect    =     array(

        "prefix"    =>    "forum_",

    );

    if (type == "") {

        @include("update1.php");
    } elseif (type == "insertoption") {

        @include("update2.php");
    } elseif (type == "updatetable1") {

        @include("update3.php");
    } elseif (type == "updatetable2") {

        @include("update4.php");
    } elseif (type == "updatetable3") {

        @include("update5.php");
    } elseif (type == "updatetable4") {

        @include("update6.php");
    } elseif (type == "updatetable5") {

        @include("update7.php");
    } elseif (type == "updatetable6") {

        @include("update8.php");
    } elseif (type == "updatetable7") {

        @include("update9.php");
    } elseif (type == "updatetable8") {

        @include("update10.php");
    } elseif (type == "updatetable9") {

        @include("update11.php");
    }
} else {

    @include("home.php");
}

@include("themes/footer.php");

echo "<br><br><br></td>";

echo "</tr>";

echo "</table>";

echo "<br><br>";

echo "<center>Arab Forums 0.2, Copyright ©2011 - " . date("Y") . ", Aissam Nedjar</center>";

echo "</body></html>";

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
