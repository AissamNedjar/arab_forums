<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 10) == false){

$error = "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية";

}else{

$error = "";

}

if($error == ""){

if(type == "insert"){

$user = text_other("arab-forums" , post_other("arab-forums" , "user") , false , false , false , false , false);

$addwhat = text_other("arab-forums" , post_other("arab-forums" , "addwhat") , true , true , true , true , true);

$plaseid = text_other("arab-forums" , post_other("arab-forums" , "plaseid") , true , true , true , true , true);

$import = @implode("," , $user);

if(wasafallo_other("arab-forums" , $plaseid , 1 , "goall" , true) == false){

$error = "لا يمكنك توزيع هذا الوصف على الأعضاء لأنك لا تملك التصريح المناسب";

}elseif(counts_other("arab-forums" , $user) == 0){

$error = "الرجاء إدخال رقم أو إسم عضو وآحد على الأقل";

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

if($addwhat == "name"){

$goadd = "user_nameuser";

}else{

$goadd = "user_id";

}

if(group_user > 2){

$lockw = 0;

$plus = "";

}else{

$lockw = 1;

$plus = "لآكن ينتظرون موافقة المراقب";

}

for($x = 0; $x < count($user); ++$x){

$useroft = text_other("arab-forums" , $user[$x] , true , true , true , true , true);

if($useroft != ""){

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_nameuser , user_wait , user_bad" , "where {$goadd} = \"{$useroft}\" && user_wait in(0) && user_bad in(0) limit 1");

if(num_mysql("arab-forums" , $user_sql) != false){

$user_object = object_mysql("arab-forums" , $user_sql);

$gogo_sql = select_mysql("arab-forums" , "getwasaf" , "getwasaf_id , getwasaf_wasafid , getwasaf_userid" , "where getwasaf_wasafid in({$plaseid}) && getwasaf_userid in({$user_object->user_id}) limit 1");

if(num_mysql("arab-forums" , $gogo_sql) == false){

insert_mysql("arab-forums" , "getwasaf" , "getwasaf_id , getwasaf_wasafid , getwasaf_userid , getwasaf_lock , getwasaf_add , getwasaf_date" , "null , \"{$plaseid}\" , \"{$user_object->user_id}\" , \"{$lockw}\" , \"".id_user."\" , \"".time()."\"");

}}}}

$arraymsg = array(

"msg" => "تم إضافة الوصف إلى الأعضاء بنجآح تام {$plus}<br><br>ملاحظة : قبل أن يتم الإدخال إلى القاعدة يتم التأكد من أن العضو موجود فعلا<br><br>و أيضا يقوم بالتأكد من أن العضو غير حاصل على الوصف نفسه من قبل و ذلك لتفادي الأخطاء" ,

"color" => "good" ,

"url" => "service.php?gert=wasaf&go=wasaf_listgo" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

if(is_numeric(plase)){

$opplas = plase;

}else{

$opplas = "";

}

echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

echo "<td>".img_other("arab-forums" , "images/service.png" , "" , "" , "" , "0" , "" , "")."</td>";

echo "<td width=\"100%\"><span style=\"color:red;font-size:13px;\">توزيع وصف جماعي</span></td>";

echo "</tr></table>";

echo "<form action=\"service.php?gert=wasaf&go=wasaf_goall&type=insert\" method=\"post\">";

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

echo "<tr align=\"center\"><td class=\"tcotadmin\" colspan=\"5\"><div class=\"pad\">رقم الوصف</div></td></tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><input style=\"width:80px\" class=\"input\" name=\"plaseid\" value=\"{$opplas}\" type=\"text\"></div></td>";

echo "</tr>";

echo "<tr align=\"center\"><td class=\"tcotadmin\" colspan=\"5\"><div class=\"pad\">أسماء أو أرقام العضويات</div></td></tr>";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"5\"><div class=\"pad\">";

echo "<select class=\"inputselect\" name=\"addwhat\">";

echo "<option value=\"name\">إدخال بأسماء العضويات</option>";

echo "<option value=\"id\">إدخال بأرقام العضويات</option>";

echo "</select></div></td>";

echo "</tr>";

echo "<tr align=\"center\">";

$xi = 0;

for($x = 1; $x <= 50; ++$x){

if($xi == 5){echo "</tr><tr align=\"center\">";$xi = 0;}

echo "<td class=\"alttext2\"><div class=\"pad\"><input style=\"width:120px\" class=\"input\" name=\"user[]\" value=\"\" type=\"text\"></div></td>";

$xi++;

}

echo "</tr>";

echo "<tr align=\"center\"><td class=\"alttext1\" colspan=\"5\"><div class=\"pad\"><br><center><input type=\"submit\" class=\"button\" value=\"توزيع الوصف على الأعضاء\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد توزيع الوصف على الأعضاء المدخلين ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"></center><br></div></td></tr>";

echo "</table>";

echo "</form>";

}}else{

$arraymsg = array(

"msg" => $error ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>