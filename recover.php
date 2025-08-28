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

define("pagebody" , "recover");

online_other("arab-forums" , "recover" , "0" , "0" , "0" , "0");

if(group_user == 0){

if(go == ""){

echo bodytop_template("arab-forums" , "إسترجاع الكلمة السرية");

$arrayheader = array(

"login" => false ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"recover.php?go=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"50%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcat\">إسترجاع الكلمة السرية</td></tr>";

echo "<tr><td class=\"alttext1\" align=\"center\"><div class=\"pad\">";

echo "<br>لإسترجاع الكلمة السرية<br><br>أدخل إسمك المسجل في المنتديات و إضغط على إسترجاع الكلمة السرية";

echo "<br><br><input style=\"width:250px\" class=\"input\" name=\"namerecover\" value=\"\" type=\"text\">";

echo "<br><br>ملاحظة: يجب ان يكون الاسم مطابقا لسجلاتنا تماما<br><br>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><div class=\"pad\">";

echo "<br><input type=\"submit\" class=\"button\" name=\"insert\" value=\"إسترجاع الكلمة السرية\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إسترجاع الكلمة السرية للإسم المدخل ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقل\"><br><br>";

echo "</div></td></tr>";

echo "</table></form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}elseif(go == "insert"){

$namerecover = text_other("arab-forums" , post_other("arab-forums" , "namerecover") , true , true , true , true , true);

if($namerecover == ""){

$error = "الرجاء إدخال إسم العضوية ليتم إسترجاع الكلمة السرية";

}else{

$recover_sql = select_mysql("arab-forums" , "user" , "user_id , user_email , user_nameuser , user_wait , user_active" , "where user_wait in(0) && user_active in(0) && user_nameuser = \"".$namerecover."\" limit 1");

if(num_mysql("arab-forums" , $recover_sql) == false){

$error = "الإسم الذي أدخلته ليس مسجلا لدينا الرجاء التأكد من الإسم من قائمة الأعضاء";

}else{

$error = "";

$recover_object = object_mysql("arab-forums" , $recover_sql);

}}

if($error == ""){

$codeyserr = md5(code_other("arab-forums" , 10));

update_mysql("arab-forums" , "user" , "user_codepassword = \"{$codeyserr}\" where user_id in({$recover_object->user_id}) limit 1");

$subject = "رسالة من ".title_option." : طلب إسترجاع الكلمة السرية";

$activeurl = "http://".showurl_option."/recover.php?go=reset&id={$recover_object->user_id}&code=".substr($codeyserr , 8 , 8)."";

$message = "مرحباً بك {$recover_object->user_nameuser}

أنت أو شخص آخر طلب بإسترجاع الكلمة السرية
		
-------------------------------------------------

لإستكمال إسترجاع الكلمة السرية, اضغط على الرابط أدناه :

<a href=\"{$activeurl}\">{$activeurl}</a>

-------------------------------------------------

مع أطيب الأمنيات إدارة ".title_option."";

mail_other("arab-forums" , $recover_object->user_email , $subject , $message , "" , "" , "");

$arraymsg = array(

"login" => false ,

"msg" => "تم إرسال إلى بريدك الإلكتروني رابط إسترجاع كلمتك السرية" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "index.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"login" => false ,

"msg" => $error ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "reset"){

$reset_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_codepassword" , "where user_id in(".id.") && user_wait in(0) && user_active in(0) limit 1");

if(num_mysql("arab-forums" , $reset_sql) != false){

$reset_object = object_mysql("arab-forums" , $reset_sql);

if($reset_object->user_codepassword == ""){

$truegood = "لم يتم التعرف على العضوية و السبب من الرابط , الرجاء منك الضغط على الرابط من البريد الإلكتروني";

}elseif(code != substr($reset_object->user_codepassword , 8 , 8)){

$truegood = "لم يتم التعرف على العضوية و السبب من الرابط , الرجاء منك الضغط على الرابط من البريد الإلكتروني";

}else{

$truegood = "";

}}else{

$truegood = "لم يتم التعرف على العضوية و السبب من الرابط , الرجاء منك الضغط على الرابط من البريد الإلكتروني";

}

if($truegood != ""){

$arraymsg = array(

"login" => false ,

"msg" => $truegood ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$insert  = text_other("arab-forums" , post_other("arab-forums" , "insert") , false , false , false , false , false);

if(isset($insert)){

$passnew1 = text_other("arab-forums" , post_other("arab-forums" , "passnew1") , true , true , true , true , true);

$passnew2 = text_other("arab-forums" , post_other("arab-forums" , "passnew2") , true , true , true , true , true);

$codenew = text_other("arab-forums" , post_other("arab-forums" , "codenew") , true , true , true , true , true);

if($passnew1 == "" || $passnew2 == "" || $codenew == ""){

$errorerror = "الرجاء ملأ جميع الحقول ليتم تغيير البيانات";

}elseif(mb_strlen($passnew1) < 5 || mb_strlen($passnew1) > 20){

$errorpass1 = "الكلمة السرية لا يجب أن تكون أقل من 5 حروف و أكبر من 20 حرف";

}elseif($passnew1 != $passnew2){

$errorpass2 = "يجب أن تتطابق الكلمة السرية مع التأكيد";

}elseif(md5(strtoupper($codenew)) != get_cookie("arab-forums" , "codesrecover")){

$errorcode = "عفوآ الكود غير مطابق للكود المدخل";

}

}

if(isset($insert) && $errorerror == "" && $errorpass1 == "" && $errorpass2 == "" && $errorcode == ""){

update_mysql("arab-forums" , "user" , "user_pass = \"".pass_other("arab-forums" , $passnew1)."\" , user_codepassword = null where user_id in(".id.") limit 1");

$arraymsg = array(

"login" => false ,

"msg" => "تم تغيير الكلمة السرية بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$codey = code_other("arab-forums" , 8);

set_cookie("arab-forums" , "codesrecover" , md5(strtoupper($codey)) , time()+60*60*24*365);

echo bodytop_template("arab-forums" , "إسترجاع الكلمة السرية");

$arrayheader = array(

"login" => false ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"".self."\" method=\"post\">";

echo "<input type=\"hidden\" name=\"agree\" value=\"1\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"50%\" align=\"center\">";

echo "<tr><td class=\"tcat\">إسترجاع الكلمة السرية الخاصة بك</td></tr>";

echo "<tr><td class=\"alttext1\" align=\"center\"><div class=\"pad\">";

echo "<br><span style=\"color:red;font-size:12px;\">{$errorerror}</span><br>";

echo "<div style=\"width:640px\" align=\"right\">";
 
echo "<br><fieldset><legend>تغيير الكلمة السرية</legend>";

echo "<p><span style=\"color:green;font-size:12px;\">الكلمة السرية الجديدة :</span></p>";

echo "<p><input style=\"width:250px\" class=\"input\" name=\"passnew1\" value=\"\" type=\"password\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorpass1}</span></p>";

echo "<p><span style=\"color:green;font-size:12px;\">إعادة الكلمة السرية الجديدة :</span></p>";

echo "<p><input style=\"width:250px\" class=\"input\" name=\"passnew2\" value=\"\" type=\"password\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorpass2}</span></p>";

echo "<p><span style=\"color:green;font-size:12px;\">كود التحقق : <span class=\"codes\">{$codey}</span></span>&nbsp;<span style=\"color:green;font-size:12px;\">يرجى كتابة الكود في الخانة المخصصة له</span></p>";

echo "<p><input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"codenew\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorcode}</span></p>";

echo "</select></p>";

echo "</fieldset>";

echo "<br><center><input type=\"submit\" class=\"button\" name=\"insert\" value=\"إدخال البيانات الجديدة\" ".confirm_other("arab-forums" , "")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br>";

echo "</div></div></td></tr></table></form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}else{

exit(header("location: error.php"));

}}else{

$arraymsg = array(

"login" => false ,

"msg" => "عفوآ بيانتنا تأكد أنك مسجل بهذه العضوية : ".name_user."" ,

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
?>