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

define("pagebody" , "changename");

$get_id = id_user;

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_days , user_chongename , user_lastchongename" , "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if(num_mysql("arab-forums" , $user_sql) == false){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

if(group_user == 0){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}elseif(change_option == 0){

$error = "للأسف الإدارة قامت بمنع طلبات تغيير أسماء العضويات";

}else{

$error = "";

}}

if($error != ""){

online_other("arab-forums" , "changename" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => $error ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

online_other("arab-forums" , "changename" , "0" , "0" , "0" , $user_object->user_id);

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , true , true);

$code = text_other("arab-forums" , post_other("arab-forums" , "code") , true , true , true , true , true);

if($name == "" || $code == ""){

$errori = "الرجاء ملأ جميع الحقول ليتم إرسال الطلب";

}elseif($user_object->user_chongename >= changename_option){

$errori = "للأسف لقد تجاوزت الحد المسموح لطلب تغيير إسم العضوية";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "changename" , "changename_userid , changename_wait" , "where changename_userid in({$user_object->user_id}) && changename_wait in(1)"))){

$errori = "هناك طلب لتغيير إسم العضوية في إنتظار موافقة الإدارة";

}elseif($user_object->user_lastchongename > dayspp1_other("arab-forums" , changenamedays_option)){

$errori = "لا يمكنك طلب تغيير إسم العضوية إلى بعد مرور ".changenamedays_option." من طلبك الأخير";

}elseif(mb_strlen($name) < 5 || mb_strlen($name) > 20){

$errori = "الإسم لا يجب أن يكون اقل من 5 حروف و أكبر من 20 حرف";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_nameuser" , "where user_nameuser = \"".strtolower($name)."\" limit 1")) == true){

$errori = "الإسم المدخل مسجل لعضو آخر";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_namelogin" , "where user_namelogin = \"".strtolower($name)."\" limit 1")) == true){

$errori = "الإسم المدخل مسجل لعضو آخر";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "registerband" , "registerband_name" , "where registerband_name = \"".strtolower($name)."\" limit 1")) == true){

$errori = "الإسم المدخل تم منعه من قبل الإدارة";

}elseif(md5(strtoupper($code)) != get_cookie("arab-forums" , "codechangename")){

$errori = "عفوآ الكود غير مطابق للكود المدخل";

}else{

$errori = "";

}

if($errori == ""){

insert_mysql("arab-forums" , "changename" , "changename_id , changename_userid , changename_wait , changename_nameold , changename_namenew , changename_date" , "null , \"".id_user."\" , \"1\" , \"".name_user."\" , \"{$name}\" , \"".time()."\"");

update_mysql("arab-forums" , "user" , "user_lastchongename = \"".time()."\" where user_id in({$user_object->user_id})");

$arraymsg = array(

"login" => true ,

"msg" => "تم إرسال طلب تغيير إسم العضوية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "changename.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"login" => true ,

"msg" => $errori ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(type == "delete"){

$name_sql = select_mysql("arab-forums" , "changename" , "changename_id , changename_userid , changename_wait" , "where changename_userid in({$user_object->user_id}) && changename_id in(".id.") && changename_wait in(1)");

if(num_mysql("arab-forums" , $name_sql) != false){

$name_object = object_mysql("arab-forums" , $name_sql);

delete_mysql("arab-forums" , "changename" , "changename_id in({$name_object->changename_id})");

update_mysql("arab-forums" , "user" , "user_lastchongename = null where user_id in({$name_object->changename_userid})");

$arraymsg = array(

"login" => true ,

"msg" => "تم حذف الطلب بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"login" => true ,

"msg" => "للأسف لا يمكنك حذف هذا الطلب لأنه غير تابع لعضويتك" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

$codey = code_other("arab-forums" , 8);

set_cookie("arab-forums" , "codechangename" , md5(strtoupper($codey)) , time()+60*60*24*365);

echo bodytop_template("arab-forums" , "طلب تغيير إسم العضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/changename.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\">".a_other("arab-forums" , "changename.php" , "طلب تغيير إسم العضوية" , "طلب تغيير إسم العضوية" , "")."</td>";

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<form action=\"changename.php?type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"50%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">طلب تغيير إسم العضوية</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">إسم العضوية :</div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"name\" value=\"\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">كود التحقق : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><span class=\"codes\">{$codey}</span>&nbsp;&nbsp;<input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"code\" value=\"\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext2\" align=\"center\" colspan=\"2\"><br><input type=\"submit\" class=\"button\" value=\"إرسال الطلب\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إرسال طلب تغيير إسم العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"><br><br></td>";

echo "</tr>";

echo "</table></form><br><br>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"70%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"6\"><div class=\"pad\">سجل طلبات إسم عضويتك</div></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"tcot\"><div class=\"pad\">الرقم</div></td>";

echo "<td class=\"tcot\"><div class=\"pad\">الإسم الجديد</div></td>";

echo "<td class=\"tcot\"><div class=\"pad\">الإسم القديم</div></td>";

echo "<td class=\"tcot\"><div class=\"pad\">الوضعية</div></td>";

echo "<td class=\"tcot\"><div class=\"pad\">تاريخ الطلب</div></td>";

echo "<td class=\"tcot\"><div class=\"pad\">خيارات</div></td>";

echo "</tr>";

$name_sql = select_mysql("arab-forums" , "changename" , "changename_id , changename_userid , changename_wait , changename_nameold , changename_namenew , changename_date" , "where changename_userid in({$user_object->user_id}) order by changename_date desc");

if(num_mysql("arab-forums" , $name_sql) != false){

while($name_object = object_mysql("arab-forums" , $name_sql)){

if($name_object->changename_wait == 0){

$waitr = "تمت الموافقة";

$color = "green";

}elseif($name_object->changename_wait == 1){

$waitr = "ينتظر الموافقة";

$color = "blue";

}elseif($name_object->changename_wait == 2){

$waitr = "تم رفض الطلب";

$color = "red";

}

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><div class=\"pad\"><nobr>{$name_object->changename_id}</nobr></div><br></td>";

echo "<td class=\"alttext2\"><div class=\"pad\"><nobr>{$name_object->changename_namenew}</nobr></div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><nobr>{$name_object->changename_nameold}</nobr></div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\"><nobr><span style=\"color:{$color};\">{$waitr}</span></nobr></div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><nobr>".times_date("arab-forums" , "" , $name_object->changename_date)."</nobr></div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">";

if($name_object->changename_wait == 1){

echo a_other("arab-forums" , "changename.php?type=delete&id={$name_object->changename_id}" , "حذف الطلب" , img_other("arab-forums" , "images/delete.png" , "" , "" , "" , "0" , "" , "") , confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد حذف هذا الطلب ؟"));

}else{

echo "--";

}

echo "</div></td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"6\"><br><div class=\"pad\">لا يوجد أي طلب حاليا</div><br></td>";

echo "</tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>