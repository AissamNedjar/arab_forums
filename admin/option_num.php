<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(type == "insert"){

$helpforum = text_other("arab-forums" , post_other("arab-forums" , "helpforum") , true , true , true , false , true);

$messagedays = text_other("arab-forums" , post_other("arab-forums" , "messagedays") , true , true , true , false , true);

$maxpmlist = text_other("arab-forums" , post_other("arab-forums" , "maxpmlist") , true , true , true , false , true);

$changename = text_other("arab-forums" , post_other("arab-forums" , "changename") , true , true , true , false , true);

$changenamedays = text_other("arab-forums" , post_other("arab-forums" , "changenamedays") , true , true , true , false , true);

$monitortopic = text_other("arab-forums" , post_other("arab-forums" , "monitortopic") , true , true , true , false , true);

$topicshow = text_other("arab-forums" , post_other("arab-forums" , "topicshow") , true , true , true , false , true);

$locktopic = text_other("arab-forums" , post_other("arab-forums" , "locktopic") , true , true , true , false , true);

$totalpost = text_other("arab-forums" , post_other("arab-forums" , "totalpost") , true , true , true , false , true);

$totalmessages = text_other("arab-forums" , post_other("arab-forums" , "totalmessages") , true , true , true , false , true);

$ttopic = text_other("arab-forums" , post_other("arab-forums" , "ttopic") , true , true , true , false , true);

$treply = text_other("arab-forums" , post_other("arab-forums" , "treply") , true , true , true , false , true);

$tuser = text_other("arab-forums" , post_other("arab-forums" , "tuser") , true , true , true , false , true);

$tmedals = text_other("arab-forums" , post_other("arab-forums" , "tmedals") , true , true , true , false , true);

$tother = text_other("arab-forums" , post_other("arab-forums" , "tother") , true , true , true , false , true);

if($helpforum == "" || $messagedays == "" || $maxpmlist == "" || $monitortopic == ""  || $changename == "" || $topicshow == "" || $locktopic == "" || $ttopic == "" || $treply == "" || $tuser == "" || $tmedals == "" || $tother == "" || $totalpost == "" || $totalmessages == "" || $changenamedays == "" ){

$error = "الرجاء ملأ جميع الحقول ليتم تسجيل البيانات";

}elseif(!is_numeric($helpforum)){

$error = "يجب أن تكون قيمة رقم المساعدة صحيحة";

}elseif(!is_numeric($messagedays)){

$error = "يجب أن تكون قيمة عدد الرسائل المسموح به يوميا صحيحة";

}elseif(!is_numeric($maxpmlist)){

$error = "يجب أن تكون قيمة عدد المجلدات المسموح بإضافته في مجلدات الرسائل صحيحة و أكبر من 0";

}elseif(!is_numeric($changename)){

$error = "يجب أن تكون قيمة العدد الأقصى لتغيير إسم العضوية صحيحة";

}elseif(!is_numeric($changenamedays)){

$error = "يجب أن تكون قيمة عدد الأيام بين الطلب القديم و الطلب الجديد صحيحة";

}elseif(!is_numeric($monitortopic)){

$error = "يجب أن تكون قيمة عدد المواضيع المسموح إضافته للمفضلة صحيحة";

}elseif(!is_numeric($topicshow)){

$error = "يجب أن تكون قيمة عدد مشاركات الأعضاء الجدد لمشاهدة مواضيع الآخرين صحيحة";

}elseif(!is_numeric($locktopic)){

$error = "يجب أن تكون قيمة عدد المشاركات ليتم غلق الموضوع أوتوماتكيا صحيحة";

}elseif(!is_numeric($totalpost)){

$error = "يجب أن تكون قيمة عدد المشاركات ليتم رفع الرقابة على المواضيع و الردود صحيحة";

}elseif(!is_numeric($totalmessages)){

$error = "يجب أن تكون قيمة عدد المشاركات ليتم رفع الرقابة على الرسائل الخاصة صحيحة";

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

update_mysql("arab-forums" , "option" , "option_value = \"{$helpforum}\" where option_name = \"helpforum\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$messagedays}\" where option_name = \"messagedays\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$maxpmlist}\" where option_name = \"maxpmlist\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$monitortopic}\" where option_name = \"monitortopic\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$changename}\" where option_name = \"changename\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$changenamedays}\" where option_name = \"changenamedays\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$topicshow}\" where option_name = \"topicshow\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$locktopic}\" where option_name = \"locktopic\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$totalpost}\" where option_name = \"totalpost\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$totalmessages}\" where option_name = \"totalmessages\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$ttopic}\" where option_name = \"ttopic\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$treply}\" where option_name = \"treply\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$tuser}\" where option_name = \"tuser\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$tmedals}\" where option_name = \"tmedals\"");

update_mysql("arab-forums" , "option" , "option_value = \"{$tother}\" where option_name = \"tother\"");

$arraymsg = array(

"msg" => "تم إدخال البيانات الجديدة بنجآح تآم" ,

"color" => "good" ,

"url" => "admin.php?gert=option&go=option_num" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=option&go=option_num&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">رقم منتدى المساعدة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"helpforum\" value=\"".helpforum_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">ضع الرقم الخاص بمنتدى المساعدة و إن كنت لا تريد أن تظهر أعلاه أكتب في الخانة 0</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد الرسائل المسموح بها يوميا</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"messagedays\" value=\"".messagedays_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من رسالة يستطيع إرسالها العضو في اليوم ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المجلدات المسموح بإضافته في مجلدات الرسائل</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"maxpmlist\">";

for($x = 1; $x <= 20; ++$x){

echo "<option value=\"{$x}\" ".(maxpmlist_option == $x ? "selected" : "").">{$x}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">كم من مجلد مسموح بإضافته في مجلدات الرسائل ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">العدد الأقصى المسموح به لتغيير إسم العضوية</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"changename\" value=\"".changename_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من مرة يستطيع العضو طلب تغيير إسم عضويته ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">كم من يوم ليستطيع العضو طلب تغيير إسم العضوية</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"changenamedays\" value=\"".changenamedays_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من يوم بين الطلب القديم و الطلب الجديد لتغيير إسم العضوية المسموح به ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المواضيع المسموح إضافته في قائمة المفضلة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"monitortopic\" value=\"".monitortopic_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من موضوع يستطيع العضو إضافته في قائمة مفضلته ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد مشاركات الأعضاء الجدد ليتمكنو من مشاهدة مواضيع الآخرين</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"topicshow\" value=\"".topicshow_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم مشاركة يملك العضو الجديد ليتمكن من مشاهدة مواضيع الآخرين ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المشاركات ليتم غلق الموضوع أوتوماتكيا</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"locktopic\" value=\"".locktopic_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من مشاركة في  الموضوع ليتم غلقه أوتوماتكيا ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المشاركات ليتم رفع الرقابة على المواضيع و الردود</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"totalpost\" value=\"".totalpost_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من مشاركة يملك العضو ليتم نزع الرقابة عليه ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المشاركات ليتم رفع الرقابة على الرسائل الخاصة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:40px\" class=\"input\" name=\"totalmessages\" value=\"".totalmessages_option."\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">كم من مشاركة يملك العضو ليستطيع إرسال رسائل خاصة ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المواضيع التي تظهر في الصفحة الواحدة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"ttopic\">";

echo "<option value=\"30\" ".(ttopic_option == 30 ? "selected" : "").">30</option>";

echo "<option value=\"40\" ".(ttopic_option == 40 ? "selected" : "").">40</option>";

echo "<option value=\"50\" ".(ttopic_option == 50 ? "selected" : "").">50</option>";

echo "<option value=\"60\" ".(ttopic_option == 60 ? "selected" : "").">60</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">العدد الإفتراضي للمواضيع التي تظهر في الصفحة الواحدة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد الردود التي تظهر في الصفحة الواحدة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"treply\">";

echo "<option value=\"10\" ".(treply_option == 10 ? "selected" : "").">10</option>";

echo "<option value=\"30\" ".(treply_option == 30 ? "selected" : "").">30</option>";

echo "<option value=\"50\" ".(treply_option == 50 ? "selected" : "").">50</option>";

echo "<option value=\"70\" ".(treply_option == 70 ? "selected" : "").">70</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">العدد الإفتراضي للردود التي تظهر في الصفحة الواحدة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد الأعضاء الذي يظهرون في الصفحة الواحدة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"tuser\">";

echo "<option value=\"30\" ".(tuser_option == 30 ? "selected" : "").">30</option>";

echo "<option value=\"40\" ".(tuser_option == 40 ? "selected" : "").">40</option>";

echo "<option value=\"50\" ".(tuser_option == 50 ? "selected" : "").">50</option>";

echo "<option value=\"60\" ".(tuser_option == 60 ? "selected" : "").">60</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">العدد الإفتراضي للأعضاء الذين يظهرون في الصفحة الواحدة</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد الأوسمة التي تظهر في صفحة بيانات الأعضاء</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"tmedals\">";

echo "<option value=\"9\" ".(tmedals_option == 9 ? "selected" : "").">9</option>";

echo "<option value=\"12\" ".(tmedals_option == 12 ? "selected" : "").">12</option>";

echo "<option value=\"15\" ".(tmedals_option == 15 ? "selected" : "").">15</option>";

echo "<option value=\"18\" ".(tmedals_option == 18 ? "selected" : "").">18</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">العدد الإفتراضي للأوسمة التي تظهر في صفحة بيانات العضو</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد الخيارات الأخرى التي تظهر في الصفحة الواحدة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"tother\">";

echo "<option value=\"20\" ".(tother_option == 20 ? "selected" : "").">20</option>";

echo "<option value=\"30\" ".(tother_option == 30 ? "selected" : "").">30</option>";

echo "<option value=\"40\" ".(tother_option == 40 ? "selected" : "").">40</option>";

echo "<option value=\"50\" ".(tother_option == 50 ? "selected" : "").">50</option>";

echo "<option value=\"60\" ".(tother_option == 60 ? "selected" : "").">60</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">العدد الإفتراضي للخيارات الأخرى التي تظهر في الصفحة الواحدة</span>";

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