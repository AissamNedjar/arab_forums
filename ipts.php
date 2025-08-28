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

define("pagebody" , "ipts");

if(group_user == 6){

if(go == "ip"){

if(value == ""){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}else{

$error = "";

}

if($error != ""){

online_other("arab-forums" , "ipts" , "0" , "0" , "0" , "0");

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

online_other("arab-forums" , "ipts" , "0" , "0" , "0" , "0");

echo bodytop_template("arab-forums" , "مطابقة الأيبي");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"40%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">مطابقة الأيبي ".value."</div></td>";

echo "</tr>";

$ip_sql = select_mysql("arab-forums" , "ip" , "i.ip_id , i.ip_ip , i.ip_user , i.ip_date , i.ip_type , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser" , "as i left join user".prefix_connect." as u on(u.user_id = i.ip_user) where (i.ip_ip = \"".value."\") group by u.user_id order by i.ip_date desc");

if(num_mysql("arab-forums" , $ip_sql) != false){

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" width=\"50%\"><div class=\"pad\">العضوية</div></td>";

echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">الحالة</div></td>";

echo "</tr>";

while($ip_object = object_mysql("arab-forums" , $ip_sql)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><br>".user_other("arab-forums" , array($ip_object->user_id , $ip_object->user_group , $ip_object->user_nameuser , $ip_object->user_lock1 , $ip_object->user_coloruser , false))."<br><br><br></td>";

echo "<td class=\"alttext2\">".($ip_object->ip_type == 2 ? img_other("arab-forums" , "images/ipy.png" , "دخول ناجح" , "" , "" , "0" , "class=\"title\"" , "") : img_other("arab-forums" , "images/ipn.png" , "محاولة دخول فاشلة" , "" , "" , "0" , "class=\"title\"" , ""))."</td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"2\"><br><div class=\"pad\">لآ توجد أي مطابقات حاليا</div><br></td>";

echo "</tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}else{

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex , user_adressip , user_lastadressip" , "where user_id in(".id.") && user_wait in(0) && user_active in(0) && user_bad in(0)");

if(num_mysql("arab-forums" , $user_sql) == false){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

$error = "";

}

if($error != ""){

online_other("arab-forums" , "ipts" , "0" , "0" , "0" , "0");

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

online_other("arab-forums" , "ipts" , "0" , "0" , "0" , $user_object->user_id);

echo bodytop_template("arab-forums" , "مطابقة الأيبي");

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"40%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">مطابقة الأيبي ".($user_object->user_sex == 1 ? "للعضو" : "للعضوة")." ".$user_object->user_nameuser."</div></td>";

echo "</tr>";

$ip_sql = select_mysql("arab-forums" , "ip" , "i.ip_id , i.ip_ip , i.ip_user , i.ip_date , i.ip_type , u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser" , "as i left join user".prefix_connect." as u on(u.user_id = i.ip_user) where (i.ip_ip = \"{$user_object->user_adressip}\" || i.ip_ip = \"{$user_object->user_lastadressip}\") group by u.user_id order by i.ip_date desc");

if(num_mysql("arab-forums" , $ip_sql) != false){

echo "<tr align=\"center\">";

echo "<td class=\"tcat\" width=\"50%\"><div class=\"pad\">العضوية</div></td>";

echo "<td class=\"tcat\" width=\"10%\"><div class=\"pad\">الحالة</div></td>";

echo "</tr>";

while($ip_object = object_mysql("arab-forums" , $ip_sql)){

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><br><br>".user_other("arab-forums" , array($ip_object->user_id , $ip_object->user_group , $ip_object->user_nameuser , $ip_object->user_lock1 , $ip_object->user_coloruser , false))."<br><br><br></td>";

echo "<td class=\"alttext2\">".($ip_object->ip_type == 2 ? img_other("arab-forums" , "images/ipy.png" , "دخول ناجح" , "" , "" , "0" , "class=\"title\"" , "") : img_other("arab-forums" , "images/ipn.png" , "محاولة دخول فاشلة" , "" , "" , "0" , "class=\"title\"" , ""))."</td>";

echo "</tr>";

}}else{

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\" colspan=\"2\"><br><div class=\"pad\">لآ توجد أي مطابقات حاليا</div><br></td>";

echo "</tr>";

}

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}}}else{

online_other("arab-forums" , "ipts" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب" ,

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