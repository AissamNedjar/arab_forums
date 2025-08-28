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

define("pagebody" , "profile");

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex , user_lock1 , user_lock2 , user_group , user_post , user_point , user_posts , user_topics , user_dateregister , user_datelastvisite , user_datelastpost , user_adressip , user_lastadressip , user_photo , user_jobe , user_age , user_days , user_month , user_years , user_bio , user_sig , user_country , user_city , user_state , user_titleold , user_hala , user_show" , "where user_id in(".id.") && user_wait in(0) && user_active in(0) && user_bad in(0) limit 1");

if(group_user == 0){

$error = "للأسف خاصية مشاهدة بيانات عضو متوفرة للأعضاء المسجلين فقط";

}else{

if(num_mysql("arab-forums" , $user_sql) == false){

$error = "عفوآ لا يمكنك مشاهدة بيانات هذه العضوية لعدة أسباب";

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

$error = "";

}}

if($error != ""){

online_other("arab-forums" , "profile" , "0" , "0" , "0" , "0");

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

online_other("arab-forums" , "profile" , "0" , "0" , "0" , $user_object->user_id);

if($user_object->user_sex == 1){

$sexr = "العضو";

$sexp = "للعضو";

$imagespr = "images/sex1.png";

$titleold = $sex1titleold_list[$user_object->user_titleold];

$text = "ذكر";

$imgt = "2sex1.png";

$halas = $halasex1_list[$user_object->user_hala];

}else{

$sexr = "العضوة";

$sexp = "للعضوة";

$imagespr = "images/sex2.png";

$titleold = $sex2titleold_list[$user_object->user_titleold];

$text = "أنثى";

$imgt = "2sex2.png";

$halas = $halasex2_list[$user_object->user_hala];

}

if(go == "sendforum" && group_user > 1){

echo bodytop_template("arab-forums" , "إرسال رسالة إشرافية {$sexp} {$user_object->user_nameuser}");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"40%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\"><div class=\"pad\">إرسال رسالة إشرافية {$sexp} {$user_object->user_nameuser}</div></td>";

echo "</tr>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><br>".a_other("arab-forums" , "message.php?go=new&sendmy=-{$forum_object->forum_id}&sendto={$user_object->user_id}" , "مراسلة {$sexr} ببريد إشراف {$forum_object->forum_name}" , "مراسلة {$sexr} ببريد إشراف {$forum_object->forum_name}" , "")."<br><br><br></td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><div class=\"pad\">لآ توجد أي منتديات تحت إشرافك</div><br></td>";

echo "</tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}else{

if($user_object->user_id != id_user){

update_mysql("arab-forums" , "user" , "user_show = user_show+1 where user_id in({$user_object->user_id})");

}

echo bodytop_template("arab-forums" , $user_object->user_nameuser);

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/profile.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\">".a_other("arab-forums" , "profile.php?id={$user_object->user_id}" , "مشاهدة بيانات {$sexr} ".$user_object->user_nameuser."" , "مشاهدة بيانات {$sexr} ".$user_object->user_nameuser."" , "").($user_object->user_lock1 == 1 ? "<div class=\"pad\"><span style=\"color:red;font-size:12px;\">عضوية مغلوقة</span></div>" : "")."</td>";

if(group_user > 1){

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">خيارات أخرى</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"profile.php?id={$user_object->user_id}\" selected>إختر خيار من القائمة</option>";

if($user_object->user_lock2 == 0 && per_other("arab-forums" , 5) == true && $user_object->user_group != 6){

echo "<option value=\"optionuser.php?id={$user_object->user_id}&go=lock2\">تجميد العضوية</option>";

}elseif($user_object->user_lock2 == 1 && per_other("arab-forums" , 6) == true && $user_object->user_group != 6){

echo "<option value=\"optionuser.php?id={$user_object->user_id}&go=nolock2\">إزالة تجميد العضوية</option>";

}

if($user_object->user_lock1 == 0 && per_other("arab-forums" , 7) == true && $user_object->user_group != 6){

echo "<option value=\"optionuser.php?id={$user_object->user_id}&go=lock1\">غلق العضوية</option>";

}elseif($user_object->user_lock1 == 1 && per_other("arab-forums" , 8) == true && $user_object->user_group != 6){

echo "<option value=\"optionuser.php?id={$user_object->user_id}&go=nolock1\">فتح العضوية</option>";

}

if(group_user == 6){

echo "<option value=\"optionuser.php?id={$user_object->user_id}&go=edit\">تعديل العضوية</option>";

echo "<option value=\"sig.php?id={$user_object->user_id}\">تعديل توقيع {$sexr}</option>";

echo "<option value=\"topichid.php?id={$user_object->user_id}\">المواضيع المخفية المفتوحة {$sexp}</option>";

echo "<option value=\"topiclock.php?id={$user_object->user_id}\">المواضيع المغلوقة المفتوحة {$sexp}</option>";

echo "<option value=\"mip.php?id={$user_object->user_id}\">تتبع الدخول {$sexp}</option>";

echo "<option value=\"message.php?msgu={$user_object->user_id}\">مراقبة رسائل {$sexr}</option>";

echo "<option value=\"ipts.php?id={$user_object->user_id}\">تطابق الأيبي {$sexp}</option>";

}

echo "</select></td>";

}

if(group_user > 1){

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">خيارات الإشراف</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"profile.php?id={$user_object->user_id}\" selected>إختر خيار من القائمة</option>";


if(per_other("arab-forums" , 9) == true){

echo "<option value=\"service.php?gert=medal&go=medal_goone&orp=id&user={$user_object->user_id}\">أضف وسام {$sexp}</option>";

}

if(per_other("arab-forums" , 10) == true){

echo "<option value=\"service.php?gert=wasaf&go=wasaf_goone&orp=id&user={$user_object->user_id}\">أضف وصف {$sexp}</option>";

}

/*
if($user_object->user_group != 6){

echo "<option value=\"mposts.php?id={$user_object->user_id}\">تطبيق رقابة على {$sexr}</option>";

}*/

if(per_other("arab-forums" , 9) == true){

echo "<option value=\"service.php?gert=medal&go=medal_listgo&user={$user_object->user_id}\">عرض أوسمة {$sexr}</option>";

}

if(per_other("arab-forums" , 10) == true){

echo "<option value=\"service.php?gert=wasaf&go=wasaf_listgo&user={$user_object->user_id}\">عرض أوصاف {$sexr}</option>";

}

/*
if($user_object->user_group != 6){

echo "<option value=\"mposts.php?id={$user_object->user_id}\">عرض رقابات {$sexr}</option>";

}*/

echo "</select></td>";

}

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">خيارات الأعضاء</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"profile.php?id={$user_object->user_id}\" selected>إختر خيار من القائمة</option>";

//echo "<option value=\"message.php?id={$user_object->user_id}\">مراسلتك مع العضو</option>";

echo "<option value=\"mtopic.php?id={$user_object->user_id}\">مواضيع {$sexr}</option>";

echo "<option value=\"mposts.php?id={$user_object->user_id}\">مشاركات {$sexr}</option>";

echo "</select></td>";

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" align=\"center\">";

echo "<tr>";

echo "<td width=\"30%\" valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"right\">";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\" align=\"right\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\"><div class=\"pad\">الصورة الشخصية</div></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext2\"><div class=\"pad\">".a_other("arab-forums" , "{$user_object->user_photo}" , "إضغط على الصورة لتكبيرها" , img_other("arab-forums" , "{$user_object->user_photo}" , "" , "100" , "" , "0" , "" , $imagespr) , "target=\"_blank\"")."</div><div class=\"pad\"><span style=\"color:red;\">إضغط على الصورة لتكبيرها</span></div></td>";

echo "</tr>";

echo "</table></td>";

echo "</tr>";

if($user_object->user_lock1 == 0){

echo "<tr><td><br></td></tr>";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\" align=\"right\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">طرق الإتصال</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">رسالة خاصة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".a_other("arab-forums" , "message.php?go=new&sendmy=".id_user."&sendto={$user_object->user_id}" , "إرسال رسالة خاصة {$sexp}" , "إرسال رسالة خاصة {$sexp}" , "")."</div></td>";

echo "</tr>";

if(group_user > 1){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">رسالة إشرافية : </div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">".a_other("arab-forums" , "profile.php?id={$user_object->user_id}&go=sendforum" , "إرسال رسالة إشرافية {$sexp}" , "إرسال رسالة إشرافية {$sexp}" , "")."</div></td>";

echo "</tr>";

}

if(group_user == 6){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">رسالة إدارية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".a_other("arab-forums" , "message.php?go=new&sendmy=0&sendto={$user_object->user_id}" , "إرسال رسالة إدارية {$sexp}" , "إرسال رسالة إدارية {$sexp}" , "")."</div></td>";

echo "</tr>";

}

echo "</table></td>";

echo "</tr>";

}

echo "<tr><td><br></td></tr>";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\" align=\"right\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">معلومات أخرى</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">تاريخ التسجيل : </div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\"><nobr>".times_date("arab-forums" , "" , $user_object->user_dateregister)."</nobr></div></td>";

echo "</tr>";

if($user_object->user_datelastpost != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">آخر مشاركة : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><nobr>".times_date("arab-forums" , "" , $user_object->user_datelastpost)."</nobr></div></td>";

echo "</tr>";

}

if(($user_object->user_group != 6) || ($user_object->user_group == 6 && group_user == 6)){

if($user_object->user_datelastvisite != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">آخر زيارة : </div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\"><nobr>".times_date("arab-forums" , "" , $user_object->user_datelastvisite)."</nobr></div></td>";

echo "</tr>";

}

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"30%\"><div class=\"pad\">الإتصال : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";



if(num_mysql("arab-forums" , select_mysql("arab-forums" , "online" , "online_userid" , "where online_userid in(".$user_object->user_id.") limit 1")) == true){

echo img_other("arab-forums" , "images/online.gif" , "{$user_object->user_nameuser} ".($user_object->user_sex == 1 ? "متصل" : "متصلة")." حاليا" , "" , "" , "0" , "class=\"title\"" , "");

}else{

echo img_other("arab-forums" , "images/offline.gif" , "{$user_object->user_nameuser} ".($user_object->user_sex == 1 ? "غير متصل" : "غير متصلة")." حاليا" , "" , "" , "0" , "class=\"title\"" , "");

}

echo "</div></td></tr>";

}

echo "</table></td>";

echo "</tr>";

$name_sql = select_mysql("arab-forums" , "changename" , "changename_id , changename_userid , changename_wait , changename_nameold , changename_namenew , changename_date" , "where changename_userid in({$user_object->user_id}) && changename_wait in(0) order by changename_date desc");

if(num_mysql("arab-forums" , $name_sql) != false){

echo "<tr><td><br></td></tr>";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\" align=\"right\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">الأسماء السابقة {$sexp}</div></td>";

echo "</tr>";

while($name_object = object_mysql("arab-forums" , $name_sql)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext2\"><br><div class=\"pad\"><nobr>{$name_object->changename_nameold}</nobr></div><br></td>";

echo "<td class=\"alttext1\" width=\"30%\"><div class=\"pad\"><nobr>".times_date("arab-forums" , "" , $name_object->changename_date)."</nobr></div></td>";

echo "</tr>";


echo "</table></td>";

echo "</tr>";

}}

echo "</table></td>";

echo "<td valign=\"top\"></td>";

echo "<td width=\"68%\" valign=\"top\"><table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">البيانات الكاملة</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">رقم العضوية : </div></td>";

echo "<td class=\"alttext2\"><div class=\"textw4 pad\">{$user_object->user_id}</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">عدد المشاهدات : </div></td>";

echo "<td class=\"alttext1\"><div class=\"textw4 pad\">{$user_object->user_show}</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">عدد المشاركات : </div></td>";

echo "<td class=\"alttext2\"><div class=\"textw4 pad\">{$user_object->user_post}</span> <span style=\"color:red;\">( المواضيع : {$user_object->user_topics} ) - ( الردود : {$user_object->user_posts} )</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">عدد نقاط التميز : </div></td>";

echo "<td class=\"alttext1\"><div class=\"textw4 pad\">{$user_object->user_point}</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">الأوصاف : </div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">";

$titlemonitor1 = titlemonitor1_other("arab-forums" , $user_object->user_id , $user_object->user_sex , "<div class=\"textw4 desting\">" , "</div>");

$titlemonitor2 = titlemonitor2_other("arab-forums" , $user_object->user_id , $user_object->user_sex , "<div class=\"textw4 desting\">" , "</div>");

$titlemodirater = titlemodirater_other("arab-forums" , $user_object->user_id , $user_object->user_sex , "<div class=\"textw4 desting\">" , "</div>");

echo "<div class=\"textw4 desting\">".title_other("arab-forums" , array($user_object->user_sex , $user_object->user_group , $user_object->user_post))."</div>";

if($user_object->user_titleold > 0){

echo "<div class=\"textw4 desting\">{$titleold}</div>";

}

echo $titlemonitor1;

echo $titlemonitor2;

echo $titlemodirater;

echo titlewasaf_other("arab-forums" , $user_object->user_id , true , 0 , "<div class=\"textw4 desting\">" , "</div>");

echo "</div></td>";

echo "</tr>";

if($user_object->user_sex == 1 || $user_object->user_sex == 2){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">الجنس : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\"><table><tr><td>".img_other("arab-forums" , "images/{$imgt}" , "{$text}" , "" , "" , "0" , "class=\"title\"" , "")."</td><td><span style=\"color:blue;\">{$text}</span></td></tr></table></div></td>";

echo "</tr>";

}

if($user_object->user_days != "" && $user_object->user_month != "" && $user_object->user_years != "" && (($user_object->user_age == 1) || ($user_object->user_age == 0 && group_user == 6))){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">تاريخ الإزدياد : </div></td>";

echo "<td class=\"alttext2\"><div class=\"textw4 pad\">{$user_object->user_days} - {$months_list[$user_object->user_month]} - {$user_object->user_years}</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">العمر : </div></td>";

echo "<td class=\"alttext1\"><div class=\"textw4 pad\">".(date("Y.m.d") - "{$user_object->user_years}.{$user_object->user_month}.{$user_object->user_days}")."</div></td>";

echo "</tr>";

}

if($user_object->user_hala != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">الحالة الإجتماعية : </div></td>";

echo "<td class=\"alttext2\"><div class=\"textw4 pad\">{$halas}</div></td>";

echo "</tr>";

}

if($user_object->user_country != "" || $user_object->user_city != "" || $user_object->user_state != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">العنوآن : </div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">";

if($user_object->user_country != ""){

echo "<div class=\"textw4 desting\">{$country_list[$user_object->user_country]}</div>";

}

if($user_object->user_city != ""){

echo "<div class=\"textw4 desting\">{$user_object->user_city}</div>";

}

if($user_object->user_state != ""){

echo "<div class=\"textw4 desting\">{$user_object->user_state}</div>";

}

echo "</div></td>";

echo "</tr>";

}

if($user_object->user_jobe != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">المهنة : </div></td>";

echo "<td class=\"alttext2\"><div class=\"textw4 pad\">{$user_object->user_jobe}</div></td>";

echo "</tr>";

}

if($user_object->user_bio != ""){

echo "<tr align=\"right\">";

echo "<td class=\"tcot\" width=\"25%\"><div class=\"pad\">السيرة الذاتية : </div></td>";

echo "<td class=\"alttext1\"><div class=\"textw4 pad\">{$user_object->user_bio}</div></td>";

echo "</tr>";

}

echo "</table></td>";

echo "</tr>";

if(type == "all"){

$limitu = "";

$titleee = "إضغط هنا للرجوع إلى الترتيب الإفتراضي";

$urlll = "profile.php?id={$user_object->user_id}";

}else{

$limitu = "limit ".tmedals_option."";

$titleee = "إضغط هنا لإظهار جميع الأوسمة";

$urlll = "profile.php?id={$user_object->user_id}&type=all";

}

$medal_sql = select_mysql("arab-forums" , "getmedal" , "g.getmedal_id , g.getmedal_medalid , g.getmedal_userid , g.getmedal_lock , g.getmedal_date , f.forum_id , f.forum_name , w.medal_id , w.medal_forumid , w.medal_lock , w.medal_name , w.medal_url" , "as g left join medal".prefix_connect." as w on(w.medal_id = g.getmedal_medalid) left join forum".prefix_connect." as f on(f.forum_id = w.medal_forumid) where w.medal_lock in(0) && g.getmedal_lock in(0) && g.getmedal_userid in({$user_object->user_id}) order by g.getmedal_date desc {$limitu}");

if(num_mysql("arab-forums" , $medal_sql) != false){

echo "<tr><td><br></td></tr>";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"3\"><div class=\"pad\">الأوسة</div></td>";

echo "</tr>";

echo "<tr align=\"center\"><td class=\"alttext1\"><br><table width=\"100%\" align=\"center\"><tr>";

while($medal_object = object_mysql("arab-forums" , $medal_sql)){

echo "<td align=\"center\"><table align=\"center\"><tr><td align=\"center\">".img_other("arab-forums" , "{$medal_object->medal_url}" , "" , "100" , "100" , "0" , "" , "images/nophoto.gif")."</td></tr>

<tr><td align=\"center\"><span style=\"color:red;font-size:12px;\">".($medal_object->medal_forumid != 0 ? a_other("arab-forums" , "forum.php?id={$medal_object->forum_id}" , "{$medal_object->forum_name}" , "{$medal_object->forum_name}" , "") : "الإدارة العامة للمنتدى")."</span></td></tr>

<tr><td align=\"center\"><span style=\"color:blue;font-size:11px;\">{$medal_object->medal_name}</span></td></tr>

<tr><td align=\"center\"><span style=\"color:blue;font-size:10px;\">".times_date("arab-forums" , "date" , $medal_object->getmedal_date)."</span></td></tr>

</table></td>";

$m_s = $m_s+1;

if($m_s == 3){

echo "</tr><tr>";

$m_s = 0;

}

}

echo "</tr></table></td></tr>";


echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"3\"><br><div class=\"pad\">".a_other("arab-forums" , "{$urlll}" , "{$titleee}" , "{$titleee}" , "")."</div><br></td>";

echo "</tr>";

echo "</table></td>";

echo "</tr>";

}

if(group_user > 1){

echo "<tr><td><br></td></tr>";

echo "<tr>";

echo "<td><table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"100%\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">الخدمات المقام بها على العضوية</div></td>";

echo "</tr>";

$optionuser_sql = select_mysql("arab-forums" , "optionuser" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , o.optionuser_id , o.optionuser_userid , o.optionuser_date , o.optionuser_user , o.optionuser_type , o.optionuser_msg" , "as o left join user".prefix_connect." as u on(u.user_id = o.optionuser_user) where o.optionuser_userid in({$user_object->user_id}) order by o.optionuser_date desc");

if(num_mysql("arab-forums" , $optionuser_sql) != false){

while($optionuser_object = object_mysql("arab-forums" , $optionuser_sql)){

if($optionuser_object->optionuser_type != "edit" || ($optionuser_object->optionuser_type == "edit" && group_user == 6)){

echo "<tr align=\"right\">";

echo "<td class=\"alttext1\" colspan=\"2\"><br><div class=\"pad\"><nobr>(".times_date("arab-forums" , "" , $optionuser_object->optionuser_date).") - تم {$option_list[$optionuser_object->optionuser_type]} العضوية بواسطة ".user_other("arab-forums" , array($optionuser_object->user_id , $optionuser_object->user_group , $optionuser_object->user_nameuser , $optionuser_object->user_lock1 , $optionuser_object->user_coloruser , false))."".($optionuser_object->optionuser_type == "edit" ? "" : " - ".a_other("arab-forums" , "javascript:montre('option_tr_{$optionuser_object->optionuser_id}')" , "مشاهدة التفاصيل" , "مشاهدة التفاصيل" , ""))."</nobr></div><br></td>";

echo "</tr>";

echo "<tr align=\"right\" id=\"option_tr_{$optionuser_object->optionuser_id}\" style=\"display: none;\">";

echo "<td class=\"alttext2 select\" colspan=\"2\"><br><div class=\"pad\">{$optionuser_object->optionuser_msg}</div><br></td>";

echo "</tr>";

}}}else{

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"2\"><br><div class=\"pad\">لا توجد خدمات مقام بها على العضوية حاليا</div><br></td>";

echo "</tr>";

}

echo "</table></td>";

echo "</tr>";

}

echo "</table></td>";

echo "</tr>";

if($user_object->user_sig != ""){

echo "<tr><td><br><br><br><br></td></tr>";

echo "<tr>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\"><div class=\"pad\">التوقيع</div></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext2\"><table style=\"table-layout:fixed;\" align=\"center\" width=\"100%\"><tr><td>".messagereplase_other("arab-forums" , $user_object->user_sig , "0")."</td></tr></table></td>";

echo "</tr>";

echo "</table></td>";

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