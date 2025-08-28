<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$ads1 = text_other("arab-forums" , post_other("arab-forums" , "ads1") , true , true , true , false , true);

$client1 = text_other("arab-forums" , post_other("arab-forums" , "client1") , true , true , true , false , true);

$slot1 = text_other("arab-forums" , post_other("arab-forums" , "slot1") , true , true , true , false , true);

$url1 = text_other("arab-forums" , post_other("arab-forums" , "url1") , true , true , true , false , true);

$ads2 = text_other("arab-forums" , post_other("arab-forums" , "ads2") , true , true , true , false , true);

$client2 = text_other("arab-forums" , post_other("arab-forums" , "client2") , true , true , true , false , true);

$slot2 = text_other("arab-forums" , post_other("arab-forums" , "slot2") , true , true , true , false , true);

$url2 = text_other("arab-forums" , post_other("arab-forums" , "url2") , true , true , true , false , true);

$ads3 = text_other("arab-forums" , post_other("arab-forums" , "ads3") , true , true , true , false , true);

$client3 = text_other("arab-forums" , post_other("arab-forums" , "client3") , true , true , true , false , true);

$slot3 = text_other("arab-forums" , post_other("arab-forums" , "slot3") , true , true , true , false , true);

$url3 = text_other("arab-forums" , post_other("arab-forums" , "url3") , true , true , true , false , true);

if($ads1 == "" || $client1 == "" || $slot1 == "" || $url1 == "" || $ads2 == "" || $client2 == "" || $slot2 == "" || $url2 == "" || $ads3 == "" || $client3 == "" || $slot3 == "" || $url3 == ""){

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

update_mysql("arab-forums" , "option" , "option_value = \"{$ads1}\" where option_name = \"ads1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$client1}\" where option_name = \"client1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$slot1}\" where option_name = \"slot1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$url1}\" where option_name = \"url1\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$ads2}\" where option_name = \"ads2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$client2}\" where option_name = \"client2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$slot2}\" where option_name = \"slot2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$url2}\" where option_name = \"url2\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$ads3}\" where option_name = \"ads3\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$client3}\" where option_name = \"client3\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$slot3}\" where option_name = \"slot3\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$url3}\" where option_name = \"url3\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=ads&go=ads_google" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=ads&go=ads_google&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">إعلان الهايدر (728 * 90)</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"ads1\">";

echo "<option value=\"1\" ".(ads1_option == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".(ads1_option == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تود تشغيل الإعلان في الهايدر ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"client1\" value=\"".client1_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_client</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"slot1\" value=\"".slot1_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_slot</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:400px\" class=\"input\" name=\"url1\" value=\"".url1_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">page ads</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إعلان المواضيع (728 * 90)</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"ads2\">";

echo "<option value=\"1\" ".(ads2_option == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".(ads2_option == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تود تشغيل الإعلان في المواضيع ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"client2\" value=\"".client2_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_client</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"slot2\" value=\"".slot2_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_slot</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:400px\" class=\"input\" name=\"url2\" value=\"".url2_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">page ads</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إعلان الفوتر (728 * 90)</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"ads3\">";

echo "<option value=\"1\" ".(ads3_option == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".(ads3_option == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تود تشغيل الإعلان في الفوتر ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"client3\" value=\"".client3_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_client</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"slot3\" value=\"".slot3_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">google_ad_slot</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:400px\" class=\"input\" name=\"url3\" value=\"".url3_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">page ads</span>";

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