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

$option_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_namelogin , user_sex , user_lock1 , user_lock2 , user_group , user_post , user_point , user_posts , user_topics , user_dateregister , user_datelastvisite , user_datelastpost , user_adressip , user_lastadressip , user_photo , user_jobe , user_age , user_days , user_month , user_years , user_bio , user_sig , user_country , user_city , user_state , user_titleold , user_hala , user_email , user_time , user_style , user_editorcolor , user_editoralign , user_editorblod , user_editorfont , user_editorsize , user_coloruser , user_colorstar" , "where user_id in(".id.") && user_wait in(0) && user_active in(0) && user_bad in(0)");

if(num_mysql("arab-forums" , $option_sql) == false){

$errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";

}elseif(group_user < 2){

$errorop = "لا تملك التصريح المناسب لدخول هذه الصفحة";

}else{

$option_object = object_mysql("arab-forums" , $option_sql);

$errorop = "";

}

if($errorop == ""){

define("pagebody" , "optionuser");

online_other("arab-forums" , "optionuser" , "0" , "0" , "0" , $option_object->user_id);

if(go == "lock1" && $option_object->user_group != 6 && per_other("arab-forums" , 7) == true){

if($option_object->user_lock1 == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك غلق العضوية لأنها مغلقة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$msgtext = text_other("arab-forums" , post_other("arab-forums" , "msgtext") , false , true , false , false , true);

$msgtextsenf = br_other("arab-forums" , $msgtext);

if($msgtext == ""){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف يجب أن تقوم بإدخال السبب ليتم الحفظ" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "user" , "user_lock1 = \"1\" where user_id in({$option_object->user_id}) limit 1");

insert_mysql("arab-forums" , "optionuser" , "optionuser_id , optionuser_userid , optionuser_user , optionuser_date , optionuser_type , optionuser_msg" , "null , \"{$option_object->user_id}\" , \"".id_user."\" , \"".time()."\" , \"lock1\" , \"{$msgtextsenf}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم غلق العضوية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => get_cookie("arab-forums" , "refererauser") ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

set_cookie("arab-forums" , "refererauser" , referer , 0);

echo bodytop_template("arab-forums" , "غلق عضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"optionuser.php?id={$option_object->user_id}&go=lock1&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"45%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">غلق العضوية رقم : {$option_object->user_id}</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>{$option_object->user_nameuser}<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">سبب الغلق</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><textarea name=\"msgtext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea></div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"غلق العضوية\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد غلق هذه العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}elseif(go == "nolock1" && $option_object->user_group != 6 && per_other("arab-forums" , 8) == true){

if($option_object->user_lock1 == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا بمكنك فتح العضوية لأنها مفتوحة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$msgtext = text_other("arab-forums" , post_other("arab-forums" , "msgtext") , false , true , false , false , true);

$msgtextsenf = br_other("arab-forums" , $msgtext);

if($msgtext == ""){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف يجب أن تقوم بإدخال السبب ليتم الحفظ" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "user" , "user_lock1 = \"0\" where user_id in({$option_object->user_id}) limit 1");

insert_mysql("arab-forums" , "optionuser" , "optionuser_id , optionuser_userid , optionuser_user , optionuser_date , optionuser_type , optionuser_msg" , "null , \"{$option_object->user_id}\" , \"".id_user."\" , \"".time()."\" , \"nolock1\" , \"{$msgtextsenf}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم فتح العضوية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => get_cookie("arab-forums" , "refererauser") ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

set_cookie("arab-forums" , "refererauser" , referer , 0);

echo bodytop_template("arab-forums" , "فتح عضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"optionuser.php?id={$option_object->user_id}&go=nolock1&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"45%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">فتح العضوية رقم : {$option_object->user_id}</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>{$option_object->user_nameuser}<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">سبب الفتح</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><textarea name=\"msgtext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea></div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"فتح العضوية\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد فتح هذه العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}elseif(go == "lock2" && $option_object->user_group != 6 && per_other("arab-forums" , 5) == true){

if($option_object->user_lock2 == 1){

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك تجميد العضوية لأنها مجمدة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$msgtext = text_other("arab-forums" , post_other("arab-forums" , "msgtext") , false , true , false , false , true);

$msgtextsenf = br_other("arab-forums" , $msgtext);

if($msgtext == ""){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف يجب أن تقوم بإدخال السبب ليتم الحفظ" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "user" , "user_lock2 = \"1\" where user_id in({$option_object->user_id}) limit 1");

insert_mysql("arab-forums" , "optionuser" , "optionuser_id , optionuser_userid , optionuser_user , optionuser_date , optionuser_type , optionuser_msg" , "null , \"{$option_object->user_id}\" , \"".id_user."\" , \"".time()."\" , \"lock2\" , \"{$msgtextsenf}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم تجميد العضوية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => get_cookie("arab-forums" , "refererauser") ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

set_cookie("arab-forums" , "refererauser" , referer , 0);

echo bodytop_template("arab-forums" , "تجميد عضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"optionuser.php?id={$option_object->user_id}&go=lock2&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"45%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">تجميد العضوية رقم : {$option_object->user_id}</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>{$option_object->user_nameuser}<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">سبب التجميد</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><textarea name=\"msgtext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea></div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"تجميد العضوية\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد تجميد هذه العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}elseif(go == "nolock2" && $option_object->user_group != 6 && per_other("arab-forums" , 6) == true){

if($option_object->user_lock2 == 0){

$arraymsg = array(

"login" => true ,

"msg" => "لا بمكنك إزالة تجميد العضوية لأنها غير مجمدة من قبل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$msgtext = text_other("arab-forums" , post_other("arab-forums" , "msgtext") , false , true , false , false , true);

$msgtextsenf = br_other("arab-forums" , $msgtext);

if($msgtext == ""){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف يجب أن تقوم بإدخال السبب ليتم الحفظ" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

update_mysql("arab-forums" , "user" , "user_lock2 = \"0\" where user_id in({$option_object->user_id}) limit 1");

insert_mysql("arab-forums" , "optionuser" , "optionuser_id , optionuser_userid , optionuser_user , optionuser_date , optionuser_type , optionuser_msg" , "null , \"{$option_object->user_id}\" , \"".id_user."\" , \"".time()."\" , \"nolock2\" , \"{$msgtextsenf}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم إزالة تجميد العضوية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => get_cookie("arab-forums" , "refererauser") ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

set_cookie("arab-forums" , "refererauser" , referer , 0);

echo bodytop_template("arab-forums" , "إزالة تجميد عضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"optionuser.php?id={$option_object->user_id}&go=nolock2&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"45%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">إزالة تجميد العضوية رقم : {$option_object->user_id}</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\"><br>{$option_object->user_nameuser}<br><br></div></td></tr>";

echo "<tr align=\"center\"><td class=\"tcat\"><div class=\"pad\">سبب إزالة التجميد</div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext2\"><div class=\"pad\"><textarea name=\"msgtext\" class=\"textarea\" cols=\"60\" rows=\"12\"></textarea></div></td></tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"إزالة تجميد العضوية\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إزالة تجميد هذه العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}elseif(go == "edit" && group_user == 6){

if(type == "insert"){

$namelogin = text_other("arab-forums" , post_other("arab-forums" , "namelogin") , true , true , true , true , true);

$nameuser = text_other("arab-forums" , post_other("arab-forums" , "nameuser") , true , true , true , true , true);

$pass = text_other("arab-forums" , post_other("arab-forums" , "pass") , true , true , true , true , true);

$email = text_other("arab-forums" , post_other("arab-forums" , "email") , true , true , true , true , true);

$group = text_other("arab-forums" , post_other("arab-forums" , "group") , true , true , true , true , true);

$titleold = text_other("arab-forums" , post_other("arab-forums" , "titleold") , true , true , true , true , true);

$days = text_other("arab-forums" , post_other("arab-forums" , "days") , true , true , true , true , true);

$month = text_other("arab-forums" , post_other("arab-forums" , "month") , true , true , true , true , true);

$years = text_other("arab-forums" , post_other("arab-forums" , "years") , true , true , true , true , true);

$age = text_other("arab-forums" , post_other("arab-forums" , "age") , true , true , true , true , true);

$sex = text_other("arab-forums" , post_other("arab-forums" , "sex") , true , true , true , true , true);

$country = text_other("arab-forums" , post_other("arab-forums" , "country") , true , true , true , true , true);

$city = text_other("arab-forums" , post_other("arab-forums" , "city") , true , true , true , true , true);

$state = text_other("arab-forums" , post_other("arab-forums" , "state") , true , true , true , true , true);

$hala = text_other("arab-forums" , post_other("arab-forums" , "hala") , true , true , true , true , true);

$jobe = text_other("arab-forums" , post_other("arab-forums" , "jobe") , true , true , true , true , true);

$photo = text_other("arab-forums" , post_other("arab-forums" , "photo") , true , true , true , true , true);

$sayra = text_other("arab-forums" , post_other("arab-forums" , "sayra") , true , false , true , false , true);

$time = text_other("arab-forums" , post_other("arab-forums" , "time") , true , true , true , true , true);

$style = text_other("arab-forums" , post_other("arab-forums" , "style") , true , true , true , true , true);

$coloruser = text_other("arab-forums" , post_other("arab-forums" , "coloruser") , true , true , true , true , true);

$colorstar = text_other("arab-forums" , post_other("arab-forums" , "colorstar") , true , true , true , true , true);

if($coloruser == "FFFFFF"){

$coloruser = "";

}

if($email == "" || $group == "" || $titleold == "" || $days == "" || $month == "" || $years == "" || $age == "" || $sex == "" || $country == "" || $city == "" || $state == "" || $hala == "" || $time == "" || $style == ""){

$errory = "الرجاء ملأ جميع الحقول ليتم إدخال البيانات الجديدة";

}elseif($pass != "" && (mb_strlen($pass) < 5 || mb_strlen($pass) > 20)){

$errory = "الكلمة السرية لا يجب أن تكون أقل من 5 حروف و أكبر من 20 حرف";

}elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i" , $email)){

$errory = "البريد الإلكتروني يجب أن يكون صحيح";

}else{

$errory = "";

}

if($errory != ""){

$arraymsg = array(

"login" => true ,

"msg" => $errory ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

if($pass != ""){

$passcha = ", user_pass = \"".pass_other("arab-forums" , $pass)."\"";

}else{

$passcha = "";

}

update_mysql("arab-forums" , "user" , "user_namelogin = \"{$namelogin}\" , user_nameuser = \"{$nameuser}\" , user_email = \"{$email}\" , user_group = \"{$group}\" , user_titleold = \"{$titleold}\" , user_days = \"{$days}\" , user_month = \"{$month}\" , user_years = \"{$years}\" , user_age = \"{$age}\" , user_sex = \"{$sex}\" , user_country = \"{$country}\" , user_city = \"{$city}\" , user_state = \"{$state}\" , user_hala = \"{$hala}\" , user_jobe = \"{$jobe}\" , user_photo = \"{$photo}\" , user_bio = \"{$sayra}\" , user_time = \"{$time}\" , user_style = \"{$style}\" , user_coloruser = \"{$coloruser}\" , user_colorstar = \"{$colorstar}\" {$passcha}  where user_id in({$option_object->user_id}) limit 1");

insert_mysql("arab-forums" , "optionuser" , "optionuser_id , optionuser_userid , optionuser_user , optionuser_date , optionuser_type , optionuser_msg" , "null , \"{$option_object->user_id}\" , \"".id_user."\" , \"".time()."\" , \"edit\" , \"{$msgtextsenf}\"");

$arraymsg = array(

"login" => true ,

"msg" => "تم تعديل البيانات بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => get_cookie("arab-forums" , "refererauser") ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

set_cookie("arab-forums" , "refererauser" , referer , 0);

echo bodytop_template("arab-forums" , "تعديل عضوية");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"optionuser.php?id={$option_object->user_id}&go=edit&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\" colspan=\"2\"><div class=\"pad\">تعديل العضوية رقم : {$option_object->user_id}</div></td></tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">إسم الدخول للعضوية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"namelogin\" value=\"{$option_object->user_namelogin}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">إسم المشاركات للعضوية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"nameuser\" value=\"{$option_object->user_nameuser}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الكلمة السرية الجديدة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:250px\" class=\"input\" name=\"pass\" value=\"\" type=\"password\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">البريد الإلكتروني : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"email\" value=\"{$option_object->user_email}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">المجموعة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"group\">";

for($x = 1; $x <= 6; $x++){

echo "<option value=\"{$x}\" ".($option_object->user_group == $x ? "selected" : "").">مجموعة {$group_list[$x]}</option>";

}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الوصف السابق : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"titleold\">";

echo "<option value=\"0\" ".($option_object->user_titleold == "0" ? "selected" : "").">بدون وصف سابق</option>";

foreach($titleold_list as $code=>$name){

echo "<option value=\"{$code}\" ".($option_object->user_titleold == $code ? "selected" : "").">{$name}</option>";

}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">ظهور تاريخ الإزدياد و العمر : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"age\">";

echo "<option value=\"1\" ".($option_object->user_age == 1 ? "selected" : "").">نعم</option>";

echo "<option value=\"0\" ".($option_object->user_age == 0 ? "selected" : "").">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للأعضاء مشاهدة تاريخ الإزدياد و العمر في البيانات ؟</span>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">تاريخ الإزدياد : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><select class=\"inputselect\" name=\"days\">";

for($x = 1; $x <= 31 ; $x++){echo "<option value=\"{$x}\" ".($option_object->user_days == $x ? "selected" : "").">{$x}</option>";}

echo "</select>&nbsp;<select class=\"inputselect\" name=\"month\">";

for($x = 1; $x <= 12 ; $x++){echo "<option value=\"{$x}\" ".($option_object->user_month == $x ? "selected" : "").">{$months_list[$x]}</option>";}

echo "</select>&nbsp;<select class=\"inputselect\" name=\"years\">";

for($x = 1904; $x <= 2012 ; $x++){echo "<option value=\"{$x}\" ".($option_object->user_years == $x ? "selected" : "").">{$x}</option>";}

echo "</select></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الجنس : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"sex\">";

echo "<option value=\"1\" ".($option_object->user_sex == 1 ? "selected" : "").">ذكر</option>";

echo "<option value=\"2\" ".($option_object->user_sex == 2 ? "selected" : "").">أنثى</option>";

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الدولة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"country\">";

foreach($country_list as $code=>$name){

echo "<option value=\"{$code}\" ".($option_object->user_country == $code ? "selected" : "").">{$name}</option>";

}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">المدينة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:150px\" class=\"input\" name=\"city\" value=\"{$option_object->user_city}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">المنطقة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:150px\" class=\"input\" name=\"state\" value=\"{$option_object->user_state}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الحالة الإجتماعية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"hala\">";

foreach($hala_list as $code=>$name){

echo "<option value=\"{$code}\" ".($option_object->user_hala == $code ? "selected" : "").">{$name}</option>";

}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">المهنة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:300px\" class=\"input\" name=\"jobe\" value=\"{$option_object->user_jobe}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الصورة الشخصية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input dir=\"ltr\" style=\"width:300px\" class=\"input\" name=\"photo\" value=\"{$option_object->user_photo}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">السيرة الذاتية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><textarea name=\"sayra\" class=\"textarea\" cols=\"50\" rows=\"5\">{$option_object->user_bio}</textarea></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الوقت الإفتراضي : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"time\">";

for($x=-12;$x<=12;$x++){

echo "<option value=\"".($x == 0 ? "00" : $x)."\" ".($option_object->user_time == $x ? "selected" : "").">GMT ".($x == 0 ? "" : ($x > 0 ? "+{$x}" : $x))."</option>";

}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">الستايل الإفتراضي : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"style\">";

$style_sql = select_mysql("arab-forums" , "style" , "style_name , style_fils , style_lock" , "where style_lock = \"0\"");

if(num_mysql("arab-forums" , $style_sql) != false){

while($style_object = object_mysql("arab-forums" , $style_sql)){

echo "<option value=\"{$style_object->style_fils}\" ".($option_object->user_style == $style_object->style_fils ? "selected" : "").">{$style_object->style_name}</option>";

}}

echo "</select>";

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">لون العضوية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><input style=\"width:300px\" class=\"input color\" name=\"coloruser\" value=\"{$style_object->user_coloruser}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">في حال تريد العضو يظهر بلون المجموعة التابعة لها أترك الخانة FFFFFF</span></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"20%\"><div class=\"pad\">لون النجوم : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

echo "<br><input class=\"radio1\" type=\"radio\" name=\"colorstar\" value=\"\" ".($style_object->user_colorstar == "" ? "checked" : "").">&nbsp;<span style=\"color:red;font-size:12px;\">اللون الإفتراضي لمجموعة العضوية</span><br><br>";

foreach($colorn_list as $code=>$name){

echo "".img_other("arab-forums" , "images/star/{$code}.png" , "{$name}" , "" , "" , "0" , "" , "")."<input class=\"radio1\" type=\"radio\" name=\"colorstar\" value=\"{$code}\" ".($style_object->user_colorstar == $code ? "checked" : "").">&nbsp;<span style=\"color:red;font-size:12px;\">{$name}</span><br><br>";

}

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"2\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"تعديل العضوية\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد تعديل هذه العضوية ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}else{

$arraymsg = array(

"login" => true ,

"msg" => "لا تملك التصريح المناسب لدخول هذه الصفحة" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

define("pagebody" , "optionuser");

online_other("arab-forums" , "optionuser" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "{$errorop}" ,

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