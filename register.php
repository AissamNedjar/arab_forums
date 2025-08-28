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

define("pagebody" , "register");

online_other("arab-forums" , "register" , "0" , "0" , "0" , "0");

if(group_user == 0){

if(go == ""){

if(registeroff_option == 1){

$arraymsg = array(

"login" => true ,

"msg" => "عفوآ التسجيل موقف حاليا من طرف الإدارة نعتذر على ذلك" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

echo bodytop_template("arab-forums" , "شروط التسجيل");

$arrayheader = array(

"login" => false ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"register.php?go=register\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"50%\" align=\"center\">";

echo "<tr><td class=\"tcat\"><div class=\"pad\">شروط ".title_option."</div></td></tr>";

echo "<tr><td class=\"alttext1\" align=\"center\"><div class=\"pad\">";

echo "<div style=\"width:640px\" align=\"right\">";
 
echo "<fieldset><legend>قوانين المنتدى</legend>";

echo "<table cellpadding=\"0\" cellspacing=\"3\" border=\"0\" width=\"100%\">";

echo "<tr><td>رجاءآ اقرأ شروط التسجيل وبدقة للموافقة عليها قبل التسارع في انهاء خطوات التسجيل</td></tr>";

echo "<tr><td><div class=\"page\" style=\"border:thin inset; padding:6px; height:175px; overflow:auto\">";

echo "<p><strong>شروط و اتفاقية التسجيل</strong></p>";

echo "<p>التسجيل في هذا المنتدى مجاني و متاح للجميع ، مقابل هذا نحن نصر على التزامك بالقوانين و سياستنا الموضحة أدناه .اذا كانت موافق على هذه الشروط , يرجى منك التأشير على صندوق قراءة الشروط و الموافقة عليها ومن ثم الضغط على زر 'التسجيل' بالأسفل ، أما اذا رأيت بأن هذه الشروط تعجيزية و لا تود التسجيل معنا و إلغاء هذا اضغط <a href=\"home.php\">هنا</a>للعودة إلى واجهة المنتدى الرئيسية .</p>";

echo "<p>بالرغم من ادارة و طاقم مشرفين ".title_option." يبذلون كل ما في وسعهم و يجتهدون لإبقاء المشاركات المخالفة بعيدة عن هذا المنتدى , الا انهم غير قادرين أيضاً على مراجعة وتدقيق كافة المشاركات المطروحة ، ادارة ".title_option." تتمنى أن تراقب نفسك كي لا تراقب ، تأكد من أن المشاركات المطروحة هنا لا تمثّل وجهة نظر الموقع بل وجهة نظر كاتبها فقط و لذلك فإن ادارة ".title_option." لا تتحمل مسؤولية محتوى أي مشاركة .</p>";

echo "<p>بموافقتك على هذه الشروط فأنت تتعهد لله سبحانه و تعالى بأن لا تضيف أية مشاركات تسيء للدين الإسلامي الحنيف , القرآن الكريم , الأنبياء , الصحابة و الخلفاء الصالحين , أمهات المؤمنين , علماء الدين , المذاهب , رؤوساء الدول , الإدارة , المشرفين و أعضاءها ، و لا تضيف مشاركات تخدش الحياء إن كانت جنسية أو اهانات .</p>";

echo "<p>ادارة ".title_option." ومشرفيها لهم الحق بازالة ، تعديل ، نقل أو اغلاق أي موضوع مخالف لأي سبب كان .</p>";

echo "</div><div><label for=\"cb_rules_agree\"><input type=\"checkbox\" name=\"agree\" id=\"cb_rules_agree\" value=\"1\">قرأت كل شروط التسجيل في ".title_option." ، واتعهد بالالتزام بما جاء فيها .</label></div></div></td></tr></table></fieldset></div><div style=\"margin-top:6px\"><input type=\"submit\" class=\"button\" value=\"التسجيل\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك موافق على شروط المنتدى ؟").">";

echo "</div></td></tr></table></form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}elseif(go == "register"){

if(post_other("arab-forums" , "agree") == 1){

$insert  = text_other("arab-forums" , post_other("arab-forums" , "insert") , false , false , false , false , false);

if(isset($insert)){

$nameregister = text_other("arab-forums" , post_other("arab-forums" , "rename") , true , true , true , true , true);

$passregister = text_other("arab-forums" , post_other("arab-forums" , "repass") , true , true , true , true , true);

$emailregister = text_other("arab-forums" , post_other("arab-forums" , "reemail") , true , true , true , true , true);

$countryregister = text_other("arab-forums" , post_other("arab-forums" , "recountry") , true , true , true , true , true);

$cityregister = text_other("arab-forums" , post_other("arab-forums" , "recity") , true , true , true , true , true);

$stateregister = text_other("arab-forums" , post_other("arab-forums" , "restate") , true , true , true , true , true);

$daysregister = text_other("arab-forums" , post_other("arab-forums" , "redays") , true , true , true , true , true);

$monthregister = text_other("arab-forums" , post_other("arab-forums" , "remonth") , true , true , true , true , true);

$yearsregister = text_other("arab-forums" , post_other("arab-forums" , "reyears") , true , true , true , true , true);

$sexregister = text_other("arab-forums" , post_other("arab-forums" , "resex") , true , true , true , true , true);

$halaregister = text_other("arab-forums" , post_other("arab-forums" , "rehala") , true , true , true , true , true);

$coderegister = text_other("arab-forums" , post_other("arab-forums" , "recode") , true , true , true , true , true);

if($nameregister == "" || $passregister == "" || $emailregister == "" || $countryregister == "" || $cityregister == "" || $stateregister == "" || $daysregister == "" || $monthregister == "" || $yearsregister == "" || $sexregister == "" || $halaregister == "" || $coderegister == ""){

$errorerror = "الرجاء ملأ جميع الحقول ليتم التسجيل";

}elseif(mb_strlen($nameregister) < 5 || mb_strlen($nameregister) > 20){

$errorname = "الإسم لا يجب أن يكون اقل من 5 حروف و أكبر من 20 حرف";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_nameuser" , "where user_nameuser = \"".strtolower($nameregister)."\" limit 1")) == true){

$errorname = "الإسم المدخل مسجل لعضو آخر";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_namelogin" , "where user_namelogin = \"".strtolower($nameregister)."\" limit 1")) == true){

$errorname = "الإسم المدخل مسجل لعضو آخر";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "registerband" , "registerband_name" , "where registerband_name = \"".strtolower($nameregister)."\" limit 1")) == true){

$errorname = "الإسم المدخل تم منعه من قبل الإدارة";

}elseif(mb_strlen($passregister) < 5 || mb_strlen($passregister) > 20){

$errorpass = "الكلمة السرية لا يجب أن تكون أقل من 5 حروف و أكبر من 20 حرف";

}elseif(!eregi("^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$" , $emailregister)){

$erroremail = "البريد الإلكتروني يجب أن يكون صحيح";

}elseif(num_mysql("arab-forums" , select_mysql("arab-forums" , "user" , "user_email" , "where user_email = \"".$emailregister."\" limit 1")) == true){

$erroremail = "البريد الإلكتروني مسجل لعضو آخر";

}elseif(md5(strtoupper($coderegister)) != get_cookie("arab-forums" , "codesregister")){

$errorcode = "عفوآ الكود غير مطابق للكود المدخل";

}

}

if(isset($insert) && $errorerror == "" && $errorname == "" && $errorpass == "" && $erroremail == "" && $errorcode == ""){

$codeyserr = md5(code_other("arab-forums" , 10));

if(registerwait_option == 0){

$wait = "0";

$active = "0";

$text = "تم تسجيل عضوتك بنجاح تام يمكنك الأن المشاركة بها";

$email = false;

$msgcolor = "good";

}elseif(registerwait_option == 1){

$wait = "1";

$active = "0";

$text = "تم تسجيل عضويتك بنجاح تام لاكن تحتاج لموافقة الإدارة";

$msgcolor = "info";

$email = false;

}elseif(registerwait_option == 2){

$wait = "0";

$active = "1";

$text = "تم تسجيل عضويتك بنجاح تام لاكن يجب عليك الذهاب الى البريد الالكتروني الذي سجلت عندنا لتفعيل العضوية";

$msgcolor = "info";

$email = true;

}elseif(registerwait_option == 3){

$wait = "1";

$active = "1";

$text = "تم تسجيل عضويتك بنجاح تام لاكن يجب عليك الذهاب الى البريد الالكتروني الذي سجلت عندنا لتفعيل العضوية";

$msgcolor = "info";

$email = true;

}

insert_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_namelogin , user_nameuser , user_pass , user_email , user_dateregister , user_adressip , user_sex , user_days , user_month , user_years , user_country , user_city , user_state , user_hala , user_coderegister" , "null , \"{$wait}\" , \"{$active}\" , \"{$nameregister}\" , \"{$nameregister}\" , \"".pass_other("arab-forums" , $passregister)."\" , \"{$emailregister}\" , \"".time()."\" , \"".ip_other("arab-forums")."\" , \"{$sexregister}\" , \"{$daysregister}\" , \"{$monthregister}\" , \"{$yearsregister}\" , \"{$countryregister}\" , \"{$cityregister}\" , \"{$stateregister}\" , \"{$halaregister}\" , \"{$codeyserr}\"");

set_cookie("arab-forums" , "username" , $nameregister , time()+60*60*24*365);

set_cookie("arab-forums" , "userpass" , pass_other("arab-forums" , $passregister) , time()+60*60*24*365);

$insert = mysql_insert_id();

insert_mysql("arab-forums" , "ip" , "ip_id , ip_ip , ip_user , ip_date , ip_type , ip_code" , "null , \"".ip_other("arab-forums")."\" , \"{$insert}\" , \"".time()."\" , \"2\" , \"".couip_other("arab-forums" , ip_other("arab-forums"))."\"");

if($email == true){

$subject = "طلب تفعيل العضوية في ".title_option."";

$activeurl = "http://".showurl_option."/register.php?go=active&id=".$insert."&code=".substr($codeyserr , 9 , 9)."";

$message = "مرحباً بك {$nameregister}

شكراً لتسجيلك في ".title_option."
		
-------------------------------------------------

لاستكمال تسجيلك, اضغط على الرابط أدناه :

<a href=\"{$activeurl}\">{$activeurl}</a>

-------------------------------------------------

مع أطيب الأمنيات إدارة ".title_option."";

mail_other("arab-forums" , $emailregister , $subject , $message , "" , "" , "");

}

$arraymsg = array(

"login" => false ,

"msg" => $text ,

"color" => $msgcolor ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$codey = code_other("arab-forums" , 8);

set_cookie("arab-forums" , "codesregister" , md5(strtoupper($codey)) , time()+60*60*24*365);

echo bodytop_template("arab-forums" , "التسجيل");

$arrayheader = array(

"login" => false ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<form action=\"".self."\" method=\"post\">";

echo "<input type=\"hidden\" name=\"agree\" value=\"1\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"50%\" align=\"center\">";

echo "<tr><td class=\"tcat\"><div class=\"pad\">التسجيل في ".title_option."</div></td></tr>";

echo "<tr><td class=\"alttext1\" align=\"center\"><div class=\"pad\">";

echo "<br><span style=\"color:red;font-size:12px;\">{$errorerror}</span><br>";

echo "<div style=\"width:640px\" align=\"right\">";
 
echo "<br><fieldset><legend>بيانات العضوية</legend>";

echo "<p><span style=\"color:green;font-size:12px;\">الإسم الذي يعرفك في المنتديات :</span></p>";

echo "<p><input style=\"width:250px\" class=\"input\" name=\"rename\" value=\"{$nameregister}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorname}</span></p>";

echo "<p><span style=\"color:green;font-size:12px;\">الكلمة السرية :</span></p>";

echo "<p><input style=\"width:250px\" class=\"input\" name=\"repass\" value=\"\" type=\"password\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorpass}</span></p>";

echo "<p><span style=\"color:green;font-size:12px;\">البريد الإلكتروني :</span></p>";

echo "<p><input dir=\"ltr\" style=\"width:250px\" class=\"input\" name=\"reemail\" value=\"{$emailregister}\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">{$erroremail}</span></p>";

echo "</fieldset>";

echo "<br><fieldset><legend>بيانات أخرى</legend>";

echo "<p><span style=\"color:green;font-size:12px;\">الدولة :</span></p>";

echo "<p><select class=\"inputselect\" name=\"recountry\">";

foreach($country_list as $code=>$name){

echo "<option value=\"{$code}\" ".($countryregister == $code ? "selected" : "").">{$name}</option>";

}

echo "</select></p>";

echo "<p><span style=\"color:green;font-size:12px;\">المدينة :</span></p>";

echo "<p><input style=\"width:150px\" class=\"input\" name=\"recity\" value=\"{$cityregister}\" type=\"text\"></p>";

echo "<p><span style=\"color:green;font-size:12px;\">المنطقة :</span></p>";

echo "<p><input style=\"width:150px\" class=\"input\" name=\"restate\" value=\"{$stateregister}\" type=\"text\"></p>";

echo "<p><span style=\"color:green;font-size:12px;\">تاريخ الإزدياد :</span></p>";

echo "<p><select class=\"inputselect\" name=\"redays\">";

for($x = 1; $x <= 31 ; $x++){echo "<option value=\"{$x}\" ".($daysregister == $x ? "selected" : "").">{$x}</option>";}

echo "</select>&nbsp;<select class=\"inputselect\" name=\"remonth\">";

for($x = 1; $x <= 12 ; $x++){echo "<option value=\"{$x}\" ".($monthregister == $x ? "selected" : "").">{$months_list[$x]}</option>";}

echo "</select>&nbsp;<select class=\"inputselect\" name=\"reyears\">";

for($x = 1904; $x <= 2012 ; $x++){echo "<option value=\"{$x}\" ".($yearsregister == $x ? "selected" : "").">{$x}</option>";}

echo "</select></p>";

echo "<p><span style=\"color:green;font-size:12px;\">الجنس :</span></p>";

echo "<p><select class=\"inputselect\" name=\"resex\">";

echo "<option value=\"1\" ".($sexregister == 1 ? "selected" : "").">ذكر</option>";

echo "<option value=\"2\" ".($sexregister == 2 ? "selected" : "").">أنثى</option>";

echo "</select></p>";

echo "<p><span style=\"color:green;font-size:12px;\">الحالة الإجتماعية :</span></p>";

echo "<p><select class=\"inputselect\" name=\"rehala\">";

foreach($hala_list as $code=>$name){

echo "<option value=\"{$code}\" ".($halaregister == $code ? "selected" : "").">{$name}</option>";

}

echo "</select></p>";

echo "<p><span style=\"color:green;font-size:12px;\">كود التحقق : <span class=\"codes\">{$codey}</span></span>&nbsp;<span style=\"color:green;font-size:12px;\">يرجى كتابة الكود في الخانة المخصصة له</span></p>";

echo "<p><input dir=\"ltr\" style=\"width:150px\" class=\"input\" name=\"recode\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">{$errorcode}</span></p>";

echo "</select></p>";

echo "</fieldset>";

echo "<br><center><input type=\"submit\" class=\"button\" name=\"insert\" value=\"التسجيل\" ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد التسجيل بهذه البيانات ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br>";

echo "</div></div></td></tr></table></form>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}else{

$arraymsg = array(

"login" => false ,

"msg" => "عفوآ أنت لم توافق على قوانين المنتدى لذلك لا يمكنك التسجيل" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}elseif(go == "active"){

$active_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_coderegister" , "where user_id in(".id.") limit 1");

if(num_mysql("arab-forums" , $active_sql) != false){

$active_object = object_mysql("arab-forums" , $active_sql);

if($active_object->user_active == 0){

$truegood = "للأسف العضوية المراد تفعيلها مفعلة من قبل , ربما تنتظر موافقة الإدارة فقط";

}elseif(code != substr($active_object->user_coderegister , 9 , 9)){

$truegood = "لم يتم تفعيل العضوية و السبب من الرابط , الرجاء منك الضغط على الرابط من البريد الإلكتروني";

}else{

$truegood = "";

}}else{

$truegood = "لم يتم تفعيل العضوية و السبب من الرابط , الرجاء منك الضغط على الرابط من البريد الإلكتروني";

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

update_mysql("arab-forums" , "user" , "user_active = \"0\" where user_id in(".id.") limit 1");

if($active_object->user_wait == 1){

$textgood = "تم تفعيل العضوية بنجآح و لآكن تحتاج إلى موافقة الإدارة و سوف يتم الموافقة عليها بعد ساعات";

$msgcolor = "info";

}else{

$textgood = "تم تفعيل العضوية بنجآح يمكنك بدأ المشاركة بها";

$msgcolor = "good";

}

$arraymsg = array(

"login" => false ,

"msg" => $textgood ,

"color" => $msgcolor ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

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