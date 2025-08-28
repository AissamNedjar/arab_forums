<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums" , true);

@include("includes.php");

define("pageupdate" , true);

@include("includes/e.noopen.php");

define("pagebody" , "plugin");

online_other("arab-forums" , "admin" , "0" , "0" , "0" , "0");

if(group_user == 6){

$gert = array(

"slide" => "إضافة مواضيع السلايد" ,

);

$service["slide"] = array(

"slide_list" => "عرض و ترتيب مواضيع السلايد" ,

"slide_add" => "إضافة موضوع جديد في السلايد" ,

"slide_option" => "إعدادات موضوع في السلايد" ,

);

if(gert == "slide"){

$true1 = true;

}else{

$true1 = false;

}

if(go == "slide_list"){

$true2 = true;

}elseif(go == "slide_add"){

$true2 = true;

}elseif(go == "slide_option"){

$true2 = true;

}else{

$true2 = false;

}

echo bodytop_template("arab-forums" , "الإضافات البرمجية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcatadmin\" colspan=\"2\" align=\"center\">أهلا و سهلا بك يا ".name_user." في الإضافات البرمجية</td></tr>";

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" width=\"25%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"98%\">";

echo "<tr><td class=\"tcotadmin\">الإضافات البرمجية</td></tr>";

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "plugin.php" , "الصفحة الرئيسية" , "الصفحة الرئيسية" , "")."</div></td></tr>";

foreach($gert as $fort=>$text){

echo "<tr><td class=\"tcotadmin\">{$text}</td></tr>";

foreach($service[$fort] as $url=>$name){

if($url != "slide_option"){

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "plugin.php?gert={$fort}&go={$url}" , $name , $name , "")."</div></td></tr>";

}}}

echo "</table>";

echo "<br></td>";

echo "<td class=\"alttext1\" align=\"center\" width=\"75%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"99%\">";

if($true1 == true && $true2 == true){

echo "<tr><td class=\"tcotadmin\" align=\"center\">{$gert[gert]} => {$service[gert][go]}</td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\">";

@include("plugin/".go.".php");

}else{

echo "<tr><td class=\"tcotadmin\" align=\"center\">الإضافات البرمجية => الصفحة الرئيسية</td></tr>";

echo "<tr><td class=\"alttext2\"><div class=\"pad\">";

@include("plugin/home.php");

}

echo "</div></td></tr>";

echo "</table>";

echo "<br></td>";

echo "</tr></table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}else{

$arraymsg = array(

"login" => true ,

"msg" => "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>