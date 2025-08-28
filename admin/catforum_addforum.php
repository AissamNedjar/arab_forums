<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(num_mysql("arab-forums" , select_mysql("arab-forums" , "cat" , "cat_id" , "")) == false){

$arraymsg = array(

"msg" => "للأسف لا يمكنك إدخال منتدى جديد لأن عدد الفئات في المنتدى هو 0" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$catid = text_other("arab-forums" , post_other("arab-forums" , "catid") , true , true , true , false , true);

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$wasaf = text_other("arab-forums" , post_other("arab-forums" , "wasaf") , true , true , true , false , true);

$logo = text_other("arab-forums" , post_other("arab-forums" , "logo") , true , true , true , false , true);

$order = text_other("arab-forums" , post_other("arab-forums" , "order") , true , true , true , false , true);

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

$hid1 = text_other("arab-forums" , post_other("arab-forums" , "hid1") , true , true , true , false , true);

$hid2 = text_other("arab-forums" , post_other("arab-forums" , "hid2") , true , true , true , false , true);

$group0 = text_other("arab-forums" , post_other("arab-forums" , "group0") , true , true , true , false , true);

$group1 = text_other("arab-forums" , post_other("arab-forums" , "group1") , true , true , true , false , true);

$group2 = text_other("arab-forums" , post_other("arab-forums" , "group2") , true , true , true , false , true);

$group3 = text_other("arab-forums" , post_other("arab-forums" , "group3") , true , true , true , false , true);

$group4 = text_other("arab-forums" , post_other("arab-forums" , "group4") , true , true , true , false , true);

$group5 = text_other("arab-forums" , post_other("arab-forums" , "group5") , true , true , true , false , true);

$post1 = text_other("arab-forums" , post_other("arab-forums" , "post1") , true , true , true , false , true);

$post2 = text_other("arab-forums" , post_other("arab-forums" , "post2") , true , true , true , false , true);

$post3 = text_other("arab-forums" , post_other("arab-forums" , "post3") , true , true , true , false , true);

$post4 = text_other("arab-forums" , post_other("arab-forums" , "post4") , true , true , true , false , true);

$post5 = text_other("arab-forums" , post_other("arab-forums" , "post5") , true , true , true , false , true);

$moderattext = text_other("arab-forums" , post_other("arab-forums" , "moderattext") , true , true , true , false , true);

$sex = text_other("arab-forums" , post_other("arab-forums" , "sex") , true , true , true , false , true);

$mode = text_other("arab-forums" , post_other("arab-forums" , "mode") , true , true , true , false , true);

$topic = text_other("arab-forums" , post_other("arab-forums" , "topic") , true , true , true , false , true);

$reply = text_other("arab-forums" , post_other("arab-forums" , "reply") , true , true , true , false , true);

$modetopic = text_other("arab-forums" , post_other("arab-forums" , "modetopic") , true , true , true , false , true);

$modereply = text_other("arab-forums" , post_other("arab-forums" , "modereply") , true , true , true , false , true);

$phototopic = text_other("arab-forums" , post_other("arab-forums" , "phototopic") , true , true , true , false , true);

$photoreply = text_other("arab-forums" , post_other("arab-forums" , "photoreply") , true , true , true , false , true);

$sigtopic = text_other("arab-forums" , post_other("arab-forums" , "sigtopic") , true , true , true , false , true);

$sigreply = text_other("arab-forums" , post_other("arab-forums" , "sigreply") , true , true , true , false , true);

$detailtopic = text_other("arab-forums" , post_other("arab-forums" , "detailtopic") , true , true , true , false , true);

$detailreply = text_other("arab-forums" , post_other("arab-forums" , "detailreply") , true , true , true , false , true);

$wasaftopic = text_other("arab-forums" , post_other("arab-forums" , "wasaftopic") , true , true , true , false , true);

$wasafreply = text_other("arab-forums" , post_other("arab-forums" , "wasafreply") , true , true , true , false , true);

$visitortopicshow = text_other("arab-forums" , post_other("arab-forums" , "visitortopicshow") , true , true , true , false , true);

$visitorreplyshow = text_other("arab-forums" , post_other("arab-forums" , "visitorreplyshow") , true , true , true , false , true);

$urlshowtopic = text_other("arab-forums" , post_other("arab-forums" , "urlshowtopic") , true , true , true , false , true);

$urlshowreply = text_other("arab-forums" , post_other("arab-forums" , "urlshowreply") , true , true , true , false , true);

if($catid == "" || $name == "" || $wasaf == "" || $logo == "" || $order == "" || $lock == "" || $hid1 == "" || $hid2 == "" || $group0 == "" || $group1 == "" || $group2 == "" || $group3 == "" || $group4 == "" || $group5 == "" || $post1 == "" || $post2 == "" || $post3 == "" || $post4 == "" || $post5 == "" || $moderattext == "" || $sex == "" || $mode == "" || $phototopic == "" || $photoreply == "" || $sigtopic == "" || $sigreply == "" || $detailtopic == "" || $detailreply == "" || $wasaftopic == "" || $wasafreply == "" || $topic == "" || $reply == "" || $modetopic == "" || $modereply == "" || $visitortopicshow == "" || $visitorreplyshow == "" || $urlshowtopic == "" || $urlshowreply == ""){

$error = "الرجاء ملأ جميع الحقول ليتم إدخال المنتدى الجديد";

}elseif(!is_numeric($order)){

$error = "يجب أن تكون قيمة ترتيب المنتدى صحيحة";

}elseif(!is_numeric($topic)){

$error = "يجب أن تكون قيمة عدد المواضيع المسموح بها يوميا صحيحة";

}elseif(!is_numeric($reply)){

$error = "يجب أن تكون قيمة عدد المشاركات المسموح بها يوميا صحيحة";

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

insert_mysql("arab-forums" , "forum" , "forum_id , forum_catid , forum_lock , forum_hid1 , forum_hid2 , forum_name , forum_wasaf , forum_logo , forum_moderattext , forum_order , forum_sex , forum_phototopic , forum_sigtopic , forum_detailtopic , forum_wasaftopic , forum_photoreply , forum_sigreply , forum_detailreply , forum_wasafreply , forum_totaltopic , forum_totalreply , forum_moderattopic , forum_moderatreply , forum_mode , forum_group0 , forum_group1 , forum_group2 , forum_group3 , forum_group4 , forum_group5 , forum_post1 , forum_post2 , forum_post3 , forum_post4 , forum_post5 , forum_visitortopicshow , forum_visitorreplyshow , forum_urlshowtopic , forum_urlshowreply" , "null , \"{$catid}\" , \"{$lock}\" , \"{$hid1}\" , \"{$hid2}\" , \"{$name}\" , \"{$wasaf}\" , \"{$logo}\" , \"{$moderattext}\" , \"{$order}\" , \"{$sex}\" , \"{$phototopic}\" , \"{$sigtopic}\" , \"{$detailtopic}\" , \"{$wasaftopic}\" , \"{$photoreply}\" , \"{$sigreply}\" , \"{$detailreply}\" , \"{$wasafreply}\" , \"{$topic}\" , \"{$reply}\" , \"{$modetopic}\" , \"{$modereply}\" , \"{$mode}\" , \"{$group0}\" , \"{$group1}\" , \"{$group2}\" , \"{$group3}\" , \"{$group4}\" , \"{$group5}\" , \"{$post1}\" , \"{$post2}\" , \"{$post3}\" , \"{$post4}\" , \"{$post5}\" , \"{$visitortopicshow}\" , \"{$visitorreplyshow}\" , \"{$urlshowtopic}\" , \"{$urlshowreply}\"");

$arraymsg = array(

"msg" => "تم إدخال المنتدى الجديد بنجاح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=catforum&go=catforum_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"admin.php?gert=catforum&go=catforum_addforum&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">المنتدى تابع لفئة</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_name , cat_order" , "order by cat_order asc");

if(num_mysql("arab-forums" , $cat_sql) != false){

echo "<select class=\"inputselect\" name=\"catid\">";

while($cat_object = object_mysql("arab-forums" , $cat_sql)){

echo "<option value=\"{$cat_object->cat_id}\" ".(id == $cat_object->cat_id ? "selected" : "").">{$cat_object->cat_name}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر الفئة التي تريد إضافة المنتدى لهآ</span>";

}

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عنوان المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عنوان المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">وصف المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"wasaf\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال وصف المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">صورة المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input dir=\"ltr\" style=\"width:400px\" class=\"input\" name=\"logo\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال رابط صورة المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ترتيب المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"order\" value=\"1\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال الترتيب الخاص بالمنتدى و إن كنت لا تريده مرتب أتركه 1</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">غلق المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"lock\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى مغلوق ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إخفاء المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"hid1\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى مخفي ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إخفاء المنتدى و إظهاره للمشرفين و المراقب و النائب فقط</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"hid2\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تريد إظهار المنتدى للمشرفين و المراقب و نائب المراقب فقط ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">المشاركة في المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"sex\">";

echo "<option value=\"0\">للجميع</option>";

echo "<option value=\"1\">للذكور فقط</option>";

echo "<option value=\"2\">للإيناث فقط</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">من يمكنه المشاركة في المنتدى الكل أو الذكور فقط أو الإيناث فقط ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور المنتدى للمجموعات</td></tr>";

for($x = 0; $x <= 5; $x++){

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"group{$x}\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل المنتدى يظهر لمجموعة {$group_list[$x]} ؟</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"tcotadmin\">السمآح للمجموعات بكتابة مواضيع و مشاركات في المنتدى</td></tr>";

for($x = 1; $x <= 5; $x++){

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"post{$x}\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تستطيع مجموعة {$group_list[$x]} كتابة مواضيع و مشاركات في المنتدى ؟</span>";

echo "</div></td></tr>";

}

echo "<tr><td class=\"tcotadmin\">المنتدى تحت إشراف</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"mode\">";

echo "<option value=\"0\">الأعضاء المعينين فقط</option>";

for($x = 2; $x <= 4; $x++){

echo "<option value=\"{$x}\">الأعضاء المعينين + مجموعة {$group_list[$x]}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر مجموعة لتقوم بالإشراف على هذا المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور مشرفي المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"moderattext\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">ظهور مشرفي المنتدى في الرئيسية و داخل معلومات المنتديات و داخل بيانات المشرفين ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور صور الأعضاء في مواضيع المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"phototopic\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل صور الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور صور الأعضاء في مشاركات المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"photoreply\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل صور الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور تواقيع الأعضاء في مواضيع المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"sigtopic\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تواقيع الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور تواقيع الأعضاء في مشاركات المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"sigreply\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل تواقيع الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور بيانات الأعضاء في مواضيع المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"detailtopic\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل بيانات الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور بيانات الأعضاء في مشاركات المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"detailreply\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل بيانات الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور أوصاف الأعضاء في مواضيع المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"wasaftopic\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل أوصاف الأعضاء تظهر في مواضيع هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">ظهور أوصاف الأعضاء في مشاركات المنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"wasafreply\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل أوصاف الأعضاء تظهر في مشاركات هذا المنتدى ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">عدد المشاركات و المواضيع المسموح بهم يوميا</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"topic\" value=\"10\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عدد المواضيع المسموح به يوميا في هذا المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input size=\"1\" class=\"input\" name=\"reply\" value=\"100\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال عدد المشاركات المسموح به يوميا في هذا المنتدى</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">تطبيق الرقابة على المواضيع و المشاركات</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"modetopic\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل مواضيع هذا المنتدى تنتظر موافقة المشرفي أو المراقب أو نائب المراقب ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"modereply\">";

echo "<option value=\"0\">لآ</option>";

echo "<option value=\"1\">نعم</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل مشاركات هذا المنتدى تنتظر موافقة المشرفي أو المراقب أو نائب المراقب ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">مشاهدة الروابط بعد الرد</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"urlshowtopic\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يجب على العضو الرد ليتمكن من مشاهدة روابط الموضوع ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"urlshowreply\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يجب على العضو الرد ليتمكن من مشاهدة روابط ردود الموضوع ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">مشاهدة المحتوى من قبل الزوار</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"visitortopicshow\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للزوآر مشآهدة محتوى المواضيع ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"visitorreplyshow\">";

echo "<option value=\"1\">نعم</option>";

echo "<option value=\"0\">لآ</option>";

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">هل يمكن للزوآر مشآهدة محتوى ردود المواضيع ؟</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال المنتدى الجديد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال المنتدى الجديد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>