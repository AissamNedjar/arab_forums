<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$title1sex1 = text_other("arab-forums" , post_other("arab-forums" , "title1sex1") , true , true , true , false , true);

$title1sex2 = text_other("arab-forums" , post_other("arab-forums" , "title1sex2") , true , true , true , false , true);

$title2sex1 = text_other("arab-forums" , post_other("arab-forums" , "title2sex1") , true , true , true , false , true);

$title2sex2 = text_other("arab-forums" , post_other("arab-forums" , "title2sex2") , true , true , true , false , true);

$title3sex1 = text_other("arab-forums" , post_other("arab-forums" , "title3sex1") , true , true , true , false , true);

$title3sex2 = text_other("arab-forums" , post_other("arab-forums" , "title3sex2") , true , true , true , false , true);

$title4sex1 = text_other("arab-forums" , post_other("arab-forums" , "title4sex1") , true , true , true , false , true);

$title4sex2 = text_other("arab-forums" , post_other("arab-forums" , "title4sex2") , true , true , true , false , true);

$title5sex1 = text_other("arab-forums" , post_other("arab-forums" , "title5sex1") , true , true , true , false , true);

$title5sex2 = text_other("arab-forums" , post_other("arab-forums" , "title5sex2") , true , true , true , false , true);

$title6sex1 = text_other("arab-forums" , post_other("arab-forums" , "title6sex1") , true , true , true , false , true);

$title6sex2 = text_other("arab-forums" , post_other("arab-forums" , "title6sex2") , true , true , true , false , true);

$title7sex1 = text_other("arab-forums" , post_other("arab-forums" , "title7sex1") , true , true , true , false , true);

$title7sex2 = text_other("arab-forums" , post_other("arab-forums" , "title7sex2") , true , true , true , false , true);

$title8sex1 = text_other("arab-forums" , post_other("arab-forums" , "title8sex1") , true , true , true , false , true);

$title8sex2 = text_other("arab-forums" , post_other("arab-forums" , "title8sex2") , true , true , true , false , true);

$title9sex1 = text_other("arab-forums" , post_other("arab-forums" , "title9sex1") , true , true , true , false , true);

$title9sex2 = text_other("arab-forums" , post_other("arab-forums" , "title9sex2") , true , true , true , false , true);

$title10sex1 = text_other("arab-forums" , post_other("arab-forums" , "title10sex1") , true , true , true , false , true);

$title10sex2 = text_other("arab-forums" , post_other("arab-forums" , "title10sex2") , true , true , true , false , true);

$title11sex1 = text_other("arab-forums" , post_other("arab-forums" , "title11sex1") , true , true , true , false , true);

$title11sex2 = text_other("arab-forums" , post_other("arab-forums" , "title11sex2") , true , true , true , false , true);

$title12sex1 = text_other("arab-forums" , post_other("arab-forums" , "title12sex1") , true , true , true , false , true);

$title12sex2 = text_other("arab-forums" , post_other("arab-forums" , "title12sex2") , true , true , true , false , true);

$title13sex1 = text_other("arab-forums" , post_other("arab-forums" , "title13sex1") , true , true , true , false , true);

$title13sex2 = text_other("arab-forums" , post_other("arab-forums" , "title13sex2") , true , true , true , false , true);

$title14sex1 = text_other("arab-forums" , post_other("arab-forums" , "title14sex1") , true , true , true , false , true);

$title14sex2 = text_other("arab-forums" , post_other("arab-forums" , "title14sex2") , true , true , true , false , true);

$title15sex1 = text_other("arab-forums" , post_other("arab-forums" , "title15sex1") , true , true , true , false , true);

$title15sex2 = text_other("arab-forums" , post_other("arab-forums" , "title15sex2") , true , true , true , false , true);

$title16sex1 = text_other("arab-forums" , post_other("arab-forums" , "title16sex1") , true , true , true , false , true);

$title16sex2 = text_other("arab-forums" , post_other("arab-forums" , "title16sex2") , true , true , true , false , true);

$titlepoint1 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint1") , true , true , true , false , true);

$titlepoint2 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint2") , true , true , true , false , true);

$titlepoint3 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint3") , true , true , true , false , true);

$titlepoint4 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint4") , true , true , true , false , true);

$titlepoint5 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint5") , true , true , true , false , true);

$titlepoint6 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint6") , true , true , true , false , true);

$titlepoint7 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint7") , true , true , true , false , true);

$titlepoint8 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint8") , true , true , true , false , true);

$titlepoint9 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint9") , true , true , true , false , true);

$titlepoint10 = text_other("arab-forums" , post_other("arab-forums" , "titlepoint10") , true , true , true , false , true);

if($title1sex1 == "" || $title1sex2 == "" || $title2sex1 == "" || $title2sex2 == "" || $title3sex1 == "" || $title3sex2 == "" || $title4sex1 == "" || $title4sex2 == "" || $title5sex1 == "" || $title5sex2 == "" || $title6sex1 == "" || $title6sex2 == "" || $title7sex1 == "" || $title7sex2 == "" || $title8sex1 == "" || $title8sex2 == "" || $title9sex1 == "" || $title9sex2 == "" || $title10sex1 == "" || $title10sex2 == "" || $title11sex1 == "" || $title11sex2 == "" || $title12sex1 == "" || $title12sex2 == "" || $title13sex1 == "" || $title13sex2 == "" || $title14sex1 == "" || $title14sex2 == "" || $title15sex1 == "" || $title15sex2 == "" || $title16sex1 == "" || $title16sex2 == "" || $titlepoint1 == "" || $titlepoint2 == "" || $titlepoint3 == "" || $titlepoint4 == "" || $titlepoint5 == "" || $titlepoint6 == "" || $titlepoint7 == "" || $titlepoint8 == "" || $titlepoint9 == "" || $titlepoint10 == ""){

$error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";

}else{

$error = "";

}

if($error != ""){

$arraymsg = array(

"msg" => $error ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "option" , "option_value = \"{$title1sex1}\" where option_name = \"title1sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title1sex2}\" where option_name = \"title1sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title2sex1}\" where option_name = \"title2sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title2sex2}\" where option_name = \"title2sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title3sex1}\" where option_name = \"title3sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title3sex2}\" where option_name = \"title3sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title4sex1}\" where option_name = \"title4sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title4sex2}\" where option_name = \"title4sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title5sex1}\" where option_name = \"title5sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title5sex2}\" where option_name = \"title5sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title6sex1}\" where option_name = \"title6sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title6sex2}\" where option_name = \"title6sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title7sex1}\" where option_name = \"title7sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title7sex2}\" where option_name = \"title7sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title8sex1}\" where option_name = \"title8sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title8sex2}\" where option_name = \"title8sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title9sex1}\" where option_name = \"title9sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title9sex2}\" where option_name = \"title9sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title10sex1}\" where option_name = \"title10sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title10sex2}\" where option_name = \"title10sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title11sex1}\" where option_name = \"title11sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title11sex2}\" where option_name = \"title11sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title12sex1}\" where option_name = \"title12sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title12sex2}\" where option_name = \"title12sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title13sex1}\" where option_name = \"title13sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title13sex2}\" where option_name = \"title13sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title14sex1}\" where option_name = \"title14sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title14sex2}\" where option_name = \"title14sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title15sex1}\" where option_name = \"title15sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title15sex2}\" where option_name = \"title15sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title16sex1}\" where option_name = \"title16sex1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$title16sex2}\" where option_name = \"title16sex2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint1}\" where option_name = \"titlepoint1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint2}\" where option_name = \"titlepoint2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint3}\" where option_name = \"titlepoint3\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint4}\" where option_name = \"titlepoint4\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint5}\" where option_name = \"titlepoint5\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint6}\" where option_name = \"titlepoint6\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint7}\" where option_name = \"titlepoint7\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint8}\" where option_name = \"titlepoint8\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint9}\" where option_name = \"titlepoint9\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$titlepoint10}\" where option_name = \"titlepoint10\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=usergroup&go=usergroup_title" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=usergroup&go=usergroup_title&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\" colspan=\"3\">أوصاف فريق عمل المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">الوصف الإفتراضي للمدير</span><br><br><input style=\"width:150px\" class=\"input\" name=\"title16sex1\" value=\"".title16sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title16sex2\" value=\"".title16sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">الوصف الإفتراضي للمراقب العام</span><br><br><input style=\"width:150px\" class=\"input\" name=\"title15sex1\" value=\"".title15sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title15sex2\" value=\"".title15sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">الوصف الإفتراضي للمراقب</span><br><br><input style=\"width:150px\" class=\"input\" name=\"title14sex1\" value=\"".title14sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title14sex2\" value=\"".title14sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">الوصف الإفتراضي لنائب المراقب</span><br><br><input style=\"width:150px\" class=\"input\" name=\"title13sex1\" value=\"".title13sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title13sex2\" value=\"".title13sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" colspan=\"3\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">الوصف الإفتراضي للمشرف</span><br><br><input style=\"width:150px\" class=\"input\" name=\"title12sex1\" value=\"".title12sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title12sex2\" value=\"".title12sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\" colspan=\"3\">أوصاف و نجوم الأعضاء</td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">بلا نجوم</span>";

echo "</div></td><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title1sex1\" value=\"".title1sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title1sex2\" value=\"".title1sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الأولى</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint1\" value=\"".titlepoint1_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title2sex1\" value=\"".title2sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title2sex2\" value=\"".title2sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الثانية</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint2\" value=\"".titlepoint2_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title3sex1\" value=\"".title3sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title3sex2\" value=\"".title3sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الثالثة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint3\" value=\"".titlepoint3_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title4sex1\" value=\"".title4sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title4sex2\" value=\"".title4sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الرابعة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint4\" value=\"".titlepoint4_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title5sex1\" value=\"".title5sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title5sex2\" value=\"".title5sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الخامسة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint5\" value=\"".titlepoint5_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title6sex1\" value=\"".title6sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title6sex2\" value=\"".title6sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة السادسة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint6\" value=\"".titlepoint6_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title7sex1\" value=\"".title7sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title7sex2\" value=\"".title7sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة السابعة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint7\" value=\"".titlepoint7_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title8sex1\" value=\"".title8sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title8sex2\" value=\"".title8sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة الثامنة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint8\" value=\"".titlepoint8_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title9sex1\" value=\"".title9sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title9sex2\" value=\"".title9sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة التاسعة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint9\" value=\"".titlepoint9_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title10sex1\" value=\"".title10sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title10sex2\" value=\"".title10sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\" width=\"20%\"><div class=\"pad\">";

echo "<span style=\"color:red;font-size:12px;\">النجمة العاشرة</span>";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"titlepoint10\" value=\"".titlepoint10_option."\" type=\"text\">";

echo "</div></td><td class=\"alttext1\" width=\"30%\"><div class=\"pad\">";

echo "<input style=\"width:150px\" class=\"input\" name=\"title11sex1\" value=\"".title11sex1_option."\" type=\"text\"><br><br><input style=\"width:150px\" class=\"input\" name=\"title11sex2\" value=\"".title11sex2_option."\" type=\"text\">";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\" colspan=\"3\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>