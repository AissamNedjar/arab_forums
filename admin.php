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

define("pagebody" , "admin");

online_other("arab-forums" , "admin" , "0" , "0" , "0" , "0");

if(group_user == 6){

$gert = array(

"option" => "إعدادات المنتدى" ,

"catforum" => "إعدادات الفئات و المنتديات" ,

"ads" => "إعدادات الإعلانات" ,

"style" => "إعدادات الستايلات" ,

"iconsheader" => "إعدادات أيقونات الهيدر" ,

"usergroup" => "إعدادات الأعضاء و المجموعات" ,

"registerband" => "إعدادات الأسماء الممنوعة في التسجيل" ,

"wait" => "إعدادات الموافقة و الرفض" ,

"topic" => "إعدادات المواضيع" ,

);

$service["option"] = array(

"option_option" => "الإعدادات الأساسية" ,

"option_other" => "الإعدادات الأخرى" ,

"option_num" => "إعدادات الأرقام" ,

"option_close" => "إعدادات الإغلاق" ,

"option_sosial" => "إعدادات المواقع الإجتماعية" ,

);

$service["catforum"] = array(

"catforum_list" => "عرض و ترتيب الفئات و المنتديات" ,

"catforum_addcat" => "إضافة فئة جديدة" ,

"catforum_addforum" => "إضافة منتدى جديد" ,

"catforum_optioncat" => "إعدادات فئة" ,

"catforum_optionforum" => "إعدادات منتدى" ,

);

$service["ads"] = array(

"ads_list" => "عرض و ترتيب الإعلانات" ,

"ads_add" => "إضافة إعلان جديد" ,

"ads_option" => "إعدادات إعلان" ,

"ads_google" => "إعدادات إعلانات قوقل" ,

);

$service["style"] = array(

"style_list" => "عرض و ترتيب الستايلات" ,

"style_add" => "إضافة ستايل جديد" ,

"style_option" => "إعدادات ستايل" ,

);

$service["iconsheader"] = array(

"iconsheader_list" => "عرض و ترتيب أيقونات الهيدر" ,

"iconsheader_add" => "إضافة أيقونة جديدة" ,

"iconsheader_option" => "إعدادات أيقونة" ,

);

$service["usergroup"] = array(

"usergroup_coloru" => "ألوان المجموعات" ,

"usergroup_colorn" => "ألوان نجوم المجموعات" ,

"usergroup_title" => "الأوصاف الإفتراضية" ,

"usergroup_permis" => "تصاريح المجموعات" ,

);

$service["registerband"] = array(

"registerband_list" => "عرض الأسماء الممنوعة في التسجيل" ,

"registerband_add" => "إضافة أسماء جديدة" ,

);

$service["wait"] = array(

"wait_user" => "عضويات تنتظر الموافقة" ,

"wait_bad" => "عضويات تم رفضها" ,

"wait_name" => "أسماء تنتظر الموافقة" ,

);

$service["topic"] = array(

"topic_topicall" => "إدخال موضوع جماعي" ,

);

if(gert == "option"){

$true1 = true;

}elseif(gert == "catforum"){

$true1 = true;

}elseif(gert == "ads"){

$true1 = true;

}elseif(gert == "style"){

$true1 = true;

}elseif(gert == "iconsheader"){

$true1 = true;

}elseif(gert == "usergroup"){

$true1 = true;

}elseif(gert == "registerband"){

$true1 = true;

}elseif(gert == "wait"){

$true1 = true;

}elseif(gert == "topic"){

$true1 = true;

}else{

$true1 = false;

}

if(go == "option_option"){

$true2 = true;

}elseif(go == "option_other"){

$true2 = true;

}elseif(go == "option_num"){

$true2 = true;

}elseif(go == "option_close"){

$true2 = true;

}elseif(go == "option_sosial"){

$true2 = true;

}elseif(go == "catforum_list"){

$true2 = true;

}elseif(go == "catforum_addcat"){

$true2 = true;

}elseif(go == "catforum_addforum"){

$true2 = true;

}elseif(go == "catforum_optioncat"){

$true2 = true;

}elseif(go == "catforum_optionforum"){

$true2 = true;

}elseif(go == "ads_list"){

$true2 = true;

}elseif(go == "ads_add"){

$true2 = true;

}elseif(go == "ads_option"){

$true2 = true;

}elseif(go == "ads_google"){

$true2 = true;

}elseif(go == "style_list"){

$true2 = true;

}elseif(go == "style_add"){

$true2 = true;

}elseif(go == "style_option"){

$true2 = true;

}elseif(go == "iconsheader_list"){

$true2 = true;

}elseif(go == "iconsheader_add"){

$true2 = true;

}elseif(go == "iconsheader_option"){

$true2 = true;

}elseif(go == "usergroup_coloru"){

$true2 = true;

}elseif(go == "usergroup_colorn"){

$true2 = true;

}elseif(go == "usergroup_permis"){

$true2 = true;

}elseif(go == "usergroup_title"){

$true2 = true;

}elseif(go == "registerband_list"){

$true2 = true;

}elseif(go == "registerband_add"){

$true2 = true;

}elseif(go == "wait_user"){

$true2 = true;

}elseif(go == "wait_bad"){

$true2 = true;

}elseif(go == "wait_name"){

$true2 = true;

}elseif(go == "topic_topicall"){

$true2 = true;

}else{

$true2 = false;

}

echo bodytop_template("arab-forums" , "الإدارة العامة");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcatadmin\" colspan=\"2\" align=\"center\">أهلا و سهلا بك يا ".name_user." في الإدارة العامة</td></tr>";

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" width=\"25%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"98%\">";

echo "<tr><td class=\"tcotadmin\">الإدارة العامة</td></tr>";

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "admin.php" , "الصفحة الرئيسية" , "الصفحة الرئيسية" , "")."</div></td></tr>";

foreach($gert as $fort=>$text){

echo "<tr><td class=\"tcotadmin\">{$text}</td></tr>";

foreach($service[$fort] as $url=>$name){

if($url != "catforum_optionforum" && $url != "catforum_optioncat" && $url != "ads_option" && $url != "iconsheader_option" && $url != "style_option"){

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "admin.php?gert={$fort}&go={$url}" , $name , $name , "")."</div></td></tr>";

}}}

echo "</table>";

echo "<br></td>";

echo "<td class=\"alttext1\" align=\"center\" width=\"75%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"99%\">";

if($true1 == true && $true2 == true){

echo "<tr><td class=\"tcotadmin\" align=\"center\">{$gert[gert]} => {$service[gert][go]}</td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\">";

@include("admin/".go.".php");

}else{

echo "<tr><td class=\"tcotadmin\" align=\"center\">الإدارة العامة => الصفحة الرئيسية</td></tr>";

echo "<tr><td class=\"alttext2\"><div class=\"pad\">";

@include("admin/home.php");

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