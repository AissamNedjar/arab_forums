<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$mcolor1 = text_other("arab-forums" , post_other("arab-forums" , "mcolor1") , true , true , true , false , true);

$mcolor2 = text_other("arab-forums" , post_other("arab-forums" , "mcolor2") , true , true , true , false , true);

$mcolor3 = text_other("arab-forums" , post_other("arab-forums" , "mcolor3") , true , true , true , false , true);

$mcolor4 = text_other("arab-forums" , post_other("arab-forums" , "mcolor4") , true , true , true , false , true);

$mcolor5 = text_other("arab-forums" , post_other("arab-forums" , "mcolor5") , true , true , true , false , true);

$mcolor6 = text_other("arab-forums" , post_other("arab-forums" , "mcolor6") , true , true , true , false , true);

if($mcolor1 == "" || $mcolor2 == "" || $mcolor3 == "" || $mcolor4 == "" || $mcolor5 == "" || $mcolor6 == ""){

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

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor1}\" where option_name = \"mcolor1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor2}\" where option_name = \"mcolor2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor3}\" where option_name = \"mcolor3\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor4}\" where option_name = \"mcolor4\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor5}\" where option_name = \"mcolor5\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$mcolor6}\" where option_name = \"mcolor6\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=usergroup&go=usergroup_coloru" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=usergroup&go=usergroup_coloru&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

$groupup = array("" , mcolor1_option , mcolor2_option , mcolor3_option , mcolor4_option , mcolor5_option , mcolor6_option);

for($x = 1; $x <= 6; $x++){

echo "<tr><td class=\"tcotadmin\">لون مجموعة {$group_list[$x]}</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input color\" name=\"mcolor{$x}\" value=\"".$groupup[$x]."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إضغط على الخانة لكي تظهر قائمة الألوان و قم بالتغيير</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال البيانات الجديدة\"  ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إرجاع البيانات الأصلية\"><br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>