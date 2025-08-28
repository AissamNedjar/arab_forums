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

    $name = text_other("arab-forums", post_other("arab-forums", "name"), false, false, false, false, false);

    $import = @implode(",", $name);

    if (counts_other("arab-forums", $name) == 0) {

        $arraymsg = array(

            "msg" => "الرجاء إدخال إسم وآحد على الأقل",

            "color" => "error",

            "url" => "",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    } else {

        for ($x = 0; $x < count($name); ++$x) {

            $nameoft = text_other("arab-forums", $name[$x], true, true, true, false, true);

            if ($nameoft != "") {

                insert_mysql("arab-forums", "registerband", "registerband_id , registerband_name , registerband_user , registerband_date", "null , \"{$nameoft}\" , \"" . id_user . "\" , \"" . time() . "\"");
            }
        }

        $arraymsg = array(

            "msg" => "تم إدخال الأسماء الجديدة بنجآح تام",

            "color" => "good",

            "url" => "admin.php?gert=registerband&go=registerband_list",

        );

        echo msgadmin_template("arab-forums", $arraymsg);
    }
} else {

    echo "<form action=\"admin.php?gert=registerband&go=registerband_add&type=insert\" method=\"post\">";

    echo "<table class=\"border\" cellpadding=\"" . CELLPADDING . "\" cellspacing=\"" . CELLSPACING . "\" width=\"99%\" align=\"center\">";

    echo "<tr align=\"center\">";

    $xi = 0;

    for ($x = 1; $x <= 50; ++$x) {

        if ($xi == 5) {
            echo "</tr><tr align=\"center\">";
            $xi = 0;
        }

        echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:120px\" class=\"input\" name=\"name[]\" value=\"\" type=\"text\"></div></td>";

        $xi++;
    }

    echo "</tr>";

    echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"5\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الأسماء الجديدة\"  " . confirm_other("arab-forums", "هل أنت متأكد من أنك تريد إدخال الأسماء الجديدة ؟") . "> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

    echo "</table>";

    echo "</form>";
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
