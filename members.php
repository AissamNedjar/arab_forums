<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums" , true);

@include("includes.php");

@include("includes/e.noopen.php");

define("pageupdate" , true);

define("pagebody" , "members");

if(go == "online"){

online_other("arab-forums" , "online" , "0" , "0" , "0" , "0");

if(group_user == 0){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف قائمة المتصلين حاليا متوفرة للأعضاء المسجلين فقط" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

echo bodytop_template("arab-forums" , "قائمة المتصلين");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);


echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/monline.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\">".a_other("arab-forums" , "members.php?go=online" , "قائمة المتصلين" , "قائمة المتصلين" , "")."</td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">الإنتقال إلى</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"members.php?go=user\" ".(go == "user" ? "selected" : "").">قائمة الأعضاء</option>";

echo "<option value=\"members.php?go=online\" ".(go == "online" ? "selected" : "").">قائمة المتصلين</option>";

echo "</select></div></td>";

echo list_forumcatlist("arab-forums" , "");

echo "</tr></table>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"70%\" align=\"center\">";

if(group_user == 0 || group_user == 1 || group_user == 2){

$totalonline = 2;

}elseif(group_user == 3){

$totalonline = 3;

}elseif(group_user == 4){

$totalonline = 4;

}elseif(group_user == 5){

$totalonline = 5;

}else{

$totalonline = 6;

}

for($x = 1; $x <= $totalonline; $x++){

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">قائمة {$group_list[$x]} المتصلين</div></td>";

echo "</tr><tr align=\"center\"><td class=\"alttext1\"><div class=\"pad\">";

$online_sql = select_mysql("arab-forums" , "online" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_coloruser , u.user_group , o.online_userid , o.online_type , o.online_date" , "as o left join user".prefix_connect." as u on(u.user_id = o.online_userid) where u.user_group in({$x})");

if(num_mysql("arab-forums" , $online_sql) != false){

$userrr = 0;

echo "<table cellpadding=\"0\" cellspacing=\"5\" align=\"center\"><tr>";

while($online_object = object_mysql("arab-forums" , $online_sql)){

if($userrr == 8){echo "</tr><tr>";$userrr = 0;}

echo "<td><table cellpadding=\"7\" cellspacing=\"3\"><tr><td class=\"stats\"><nobr>".user_other("arab-forums" , array($online_object->user_id , $online_object->user_group , $online_object->user_nameuser , $online_object->user_lock1 , $online_object->user_coloruser , false))."</nobr></td></tr></table></td>";

$userrr++;

}

echo "</tr></table>";

}else{

echo "<br><br>لا يوجد متصلين من مجموعة {$group_list[$x]}<br><br><br>";

}

echo "</div></td></tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}else{

online_other("arab-forums" , "members" , "0" , "0" , "0" , "0");

echo bodytop_template("arab-forums" , "قائمة الأعضاء");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

if(forum_usertartib1 == "post"){

$tartib1 = "user_post";

}elseif(forum_usertartib1 == "point"){

$tartib1 = "user_point";

}elseif(forum_usertartib1 == "name"){

$tartib1 = "user_nameuser";

}elseif(forum_usertartib1 == "group"){

$tartib1 = "user_group";

}elseif(forum_usertartib1 == "register"){

$tartib1 = "user_dateregister";

}elseif(forum_usertartib1 == "lastvisit"){

$tartib1 = "user_datelastvisite";

}elseif(forum_usertartib1 == "lastpost"){

$tartib1 = "user_datelastpost";

}elseif(forum_usertartib1 == "country"){

$tartib1 = "user_country";

}else{

$tartib1 = "user_post";

}

$tartib2 = forum_usertartib2;

$serachuser = text_other("arab-forums" , post_other("arab-forums" , "serachuser") , true , true , true , true , true);

if(search == "true" && $serachuser != ""){

$userseargg = "&& user_nameuser like \"%{$serachuser}%\"";

}else{

$userseargg = "";

}

echo "<form action=\"members.php?search=true\" method=\"post\">";

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/members.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\">".a_other("arab-forums" , "members.php?go=user" , "قائمة الأعضاء" , "قائمة الأعضاء" , "")."</td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">الإنتقال إلى</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

echo "<option value=\"members.php?go=user\" ".(go == "user" ? "selected" : "").">قائمة الأعضاء</option>";

echo "<option value=\"members.php?go=online\" ".(go == "online" ? "selected" : "").">قائمة المتصلين</option>";

echo "</select></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">البحث</span><div class=\"pad\"><nobr><input style=\"width:100px\" class=\"input\" name=\"serachuser\" value=\"{$serachuser}\" type=\"text\">&nbsp;<input type=\"submit\" class=\"button\" name=\"insert\" value=\"إبحث\"></nobr></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">ترتيب حسب</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

echo "<option value=\"change.php?go=usertartib1&value=post\" ".(forum_usertartib1 == "post" ? "selected" : "").">عدد المشاركات</option>";

echo "<option value=\"change.php?go=usertartib1&value=point\" ".(forum_usertartib1 == "point" ? "selected" : "").">نقاط التميز</option>";

echo "<option value=\"change.php?go=usertartib1&value=name\" ".(forum_usertartib1 == "name" ? "selected" : "").">الإسم</option>";

echo "<option value=\"change.php?go=usertartib1&value=group\" ".(forum_usertartib1 == "group" ? "selected" : "").">الرتبة</option>";

echo "<option value=\"change.php?go=usertartib1&value=register\" ".(forum_usertartib1 == "register" ? "selected" : "").">تاريخ التسجيل</option>";

echo "<option value=\"change.php?go=usertartib1&value=lastvisit\" ".(forum_usertartib1 == "lastvisit" ? "selected" : "").">آخر زيارة</option>";

echo "<option value=\"change.php?go=usertartib1&value=lastpost\" ".(forum_usertartib1 == "lastpost" ? "selected" : "").">آخر مشاركة</option>";

echo "<option value=\"change.php?go=usertartib1&value=country\" ".(forum_usertartib1 == "country" ? "selected" : "").">الدولة</option>";

echo "</select></div></td>";

echo "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">ترتيب</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"relext(this)\">";

echo "<option value=\"change.php?go=usertartib2&value=desc\" ".(forum_usertartib2 == "desc" ? "selected" : "").">الأكبر للأصغر</option>";

echo "<option value=\"change.php?go=usertartib2&value=asc\" ".(forum_usertartib2 == "asc" ? "selected" : "").">الأصغر للأكبر</option>";

echo "</select></div></td>";

$count_page = tuser_option;

$get_page = (page == "" || !is_numeric(page) ? 1 : page);

$limit_page = (($get_page * $count_page) - $count_page);

echo page_pager("arab-forums" , "user" , "user_id , user_wait , user_bad , user_nameuser" , "where user_wait in(0) && user_bad in(0) {$userseargg}" , $count_page , $get_page , "members.php?go=user&");

echo list_forumcatlist("arab-forums");

echo "</tr></table>";

echo "</form>";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\" align=\"right\"><div class=\"pad\">الإسم</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">الدولة</div></td>";

echo "<td class=\"tcat\" width=\"12%\"><div class=\"pad\">المشاركات</div></td>";

echo "<td class=\"tcat\" width=\"8%\"><div class=\"pad\">نقاط التميز</div></td>";

echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">آخر زيارة</div></td>";

echo "<td class=\"tcat\" width=\"15%\"><div class=\"pad\">آخر مشاركة</div></td>";

echo "</tr>";

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_lock1 , user_nameuser , user_active , user_wait , user_bad , user_photo , user_sex , user_titleold , user_coloruser , user_colorstar , user_group , user_country , user_state , user_post , user_point , user_dateregister , user_datelastvisite , user_datelastpost" , "where user_active in(0) && user_wait in(0) && user_bad in(0) {$userseargg} order by {$tartib1} {$tartib2} limit {$limit_page},{$count_page}");

if(num_mysql("arab-forums" , $user_sql) != false){

while($user_object = object_mysql("arab-forums" , $user_sql)){

if($user_object->user_titleold == 0){

$titeloo = title_other("arab-forums" , array($user_object->user_sex , $user_object->user_group , $user_object->user_post));

}else{

$titeloo = ($user_object->user_sex == 1 ? $sex1titleold_list[$user_object->user_titleold] : $sex2titleold_list[$user_object->user_titleold]);

}

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" width=\"1%\">".img_other("arab-forums" , "{$user_object->user_photo}" , "" , "50" , "50" , "0" , "" , ($user_object->user_sex == 2 ? "images/sex2.png" : "images/sex1.png"))."</td>";

echo "<td class=\"alttext1\" align=\"right\"><div class=\"pad\">".user_other("arab-forums" , array($user_object->user_id , $user_object->user_group , $user_object->user_nameuser , $user_object->user_lock1 , $user_object->user_coloruser , false))."<br><span style=\"color:gray;font-size:11px;\">".$titeloo."</span></div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".($user_object->user_country == "" ? "غير محددة" : country_other("arab-forums" , $user_object->user_country))."</div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">".num_other("arab-forums" , $user_object->user_post)."<br>".star_other("arab-forums" , array($user_object->user_colorstar , $user_object->user_group , $user_object->user_post , $user_object->user_nameuser))."</div></td>";

echo "<td class=\"alttext2\"><div class=\"pad\">".num_other("arab-forums" , $user_object->user_point)."</div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".($user_object->user_datelastvisite != "" ? "<nobr>".times_date("arab-forums" , "" , $user_object->user_datelastvisite)."</nobr>" : "")."</div></td>";

echo "<td class=\"alttext1\"><div class=\"pad\">".($user_object->user_datelastpost != "" ? "<nobr>".times_date("arab-forums" , "" , $user_object->user_datelastpost)."</nobr>" : "")."</div></td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"8\"><br><br>لا يوجد أعضاء<br><br><br></td></tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>