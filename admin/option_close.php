<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$closeoff = text_other("arab-forums" , post_other("arab-forums" , "closeoff") , true , true , true , false , true);

$closemsg = text_other("arab-forums" , post_other("arab-forums" , "closemsg") , true , false , true , false , true);

if($closeoff == "" || $closemsg == ""){

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

update_mysql("arab-forums" , "option" , "option_value = \"{$closeoff}\" where option_name = \"closeoff\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$closemsg}\" where option_name = \"closemsg\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=option&go=option_close" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=option&go=option_close&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">حالة إغلاق المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"closeoff\">";

echo "<option value=\"0\" ".(closeoff_option == 0 ? "selected" : "").">المنتدى مفتوح</option>";

echo "<option value=\"1\" ".(closeoff_option == 1 ? "selected" : "").">المنتدى مغلوق</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">حالة المنتدى / مفتوح أو مغلوق</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">سبب إغلاق المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<textarea name=\"closemsg\" class=\"textarea\" cols=\"120\" rows=\"12\">".closemsg_option."</textarea>";

echo "</div></td></tr>";

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