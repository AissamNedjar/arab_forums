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

define("pagebody" , "service");

online_other("arab-forums" , "service" , "0" , "0" , "0" , "0");

if(group_user > 1){

$gert = array(

"wasaf" => "إعدادات أوصاف الأعضاء" ,

"medal" => "إعدادات أوسمة التميز" ,

"iconstopic" => "إعدادات أيقونات المواضيع" ,

"texttopic" => "إعدادات إختصارات المواضيع" ,

"topicreply" => "إعدادات المواضيع و الردود" ,

);

$service["wasaf"] = array(

"wasaf_list" => "عرض الأوصاف" ,

"wasaf_listgo" => "عرض الأوصاف الموزعة" ,

"wasaf_add" => "إضافة وصف جديد" ,

"wasaf_option" => "إعدادات وصف" ,

"wasaf_goall" => "توزيع وصف جماعي" ,

"wasaf_goone" => "توزيع وصف فردي" ,

);

$service["medal"] = array(

"medal_list" => "عرض الأوسمة" ,

"medal_listgo" => "عرض الأوسمة الموزعة" ,

"medal_add" => "إضافة وسام جديد" ,

"medal_option" => "إعدادات وسام" ,

"medal_goall" => "توزيع وسام جماعي" ,

"medal_goone" => "توزيع وسام فردي" ,

);

$service["iconstopic"] = array(

"iconstopic_list" => "عرض أيقونات المواضيع" ,

"iconstopic_add" => "إضافة أيقونة جديدة" ,

"iconstopic_option" => "إعدادات أيقونة" ,

);

$service["texttopic"] = array(

"texttopic_list" => "عرض إختصارات المواضيع" ,

"texttopic_add" => "إضافة إختصار جديد" ,

"texttopic_option" => "إعدادات إختصار" ,

);

$service["topicreply"] = array(

"topicreply_order" => "ترتيب وصلات المواضيع" ,

"topicreply_topicwait" => "مواضيع تنتظر الموافقة" ,

"topicreply_replywait" => "ردود تنتظر الموافقة" ,

);

if(gert == "wasaf"){

$true1 = true;

}elseif(gert == "medal"){

$true1 = true;

}elseif(gert == "iconstopic"){

$true1 = true;

}elseif(gert == "texttopic"){

$true1 = true;

}elseif(gert == "topicreply"){

$true1 = true;

}else{

$true1 = false;

}

if(go == "wasaf_list"){

$true2 = true;

}elseif(go == "wasaf_listgo"){

$true2 = true;

}elseif(go == "wasaf_add"){

$true2 = true;

}elseif(go == "wasaf_option"){

$true2 = true;

}elseif(go == "wasaf_goall"){

$true2 = true;

}elseif(go == "wasaf_goone"){

$true2 = true;

}elseif(go == "medal_list"){

$true2 = true;

}elseif(go == "medal_listgo"){

$true2 = true;

}elseif(go == "medal_add"){

$true2 = true;

}elseif(go == "medal_option"){

$true2 = true;

}elseif(go == "medal_goall"){

$true2 = true;

}elseif(go == "medal_goone"){

$true2 = true;

}elseif(go == "iconstopic_list"){

$true2 = true;

}elseif(go == "iconstopic_add"){

$true2 = true;

}elseif(go == "iconstopic_option"){

$true2 = true;

}elseif(go == "texttopic_list"){

$true2 = true;

}elseif(go == "texttopic_add"){

$true2 = true;

}elseif(go == "texttopic_option"){

$true2 = true;

}elseif(go == "topicreply_order"){

$true2 = true;

}elseif(go == "topicreply_topicwait"){

$true2 = true;

}elseif(go == "topicreply_replywait"){

$true2 = true;

}else{

$true2 = false;

}

echo bodytop_template("arab-forums" , "خدمات الإشراف");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcatadmin\" colspan=\"2\" align=\"center\">أهلا و سهلا بك يا ".name_user." في خدمات الإشراف</td></tr>";

echo "<tr>";

echo "<td class=\"alttext1\" align=\"center\" width=\"20%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"98%\">";

echo "<tr><td class=\"tcotadmin\">خدمات الإشراف</td></tr>";

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "service.php" , "الصفحة الرئيسية" , "الصفحة الرئيسية" , "")."</div></td></tr>";

foreach($gert as $fort=>$text){

echo "<tr><td class=\"tcotadmin\">{$text}</td></tr>";

foreach($service[$fort] as $url=>$name){

if($url != "iconstopic_option" && $url != "texttopic_option" && $url != "topicreply_order" && $url != "wasaf_option" && $url != "medal_option"){

echo "<tr><td class=\"tcatborder\"><div class=\"pad\">".a_other("arab-forums" , "service.php?gert={$fort}&go={$url}" , $name , $name , "")."</div></td></tr>";

}}}

echo "</table>";

echo "<br></td>";

echo "<td class=\"alttext1\" align=\"center\" width=\"80%\" valign=\"top\"><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" align=\"center\" width=\"99%\">";

if($true1 == true && $true2 == true){

echo "<tr><td class=\"tcotadmin\" align=\"center\">{$gert[gert]} => {$service[gert][go]}</td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\">";

@include("service/".go.".php");

}else{

echo "<tr><td class=\"tcotadmin\" align=\"center\">خدمات الإشراف => الصفحة الرئيسية</td></tr>";

echo "<tr><td class=\"alttext2\"><div class=\"pad\">";

@include("service/home.php");

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