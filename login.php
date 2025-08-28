<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums" , true);

@include("includes.php");

define("pagebody" , "login");

online_other("arab-forums" , "login" , "0" , "0" , "0" , "0");

if(group_user == 0){

define("loginusername" , text_other("arab-forums" , post_other("arab-forums" , "login_username") , true , true , true , true , true));

define("loginuserpass" , text_other("arab-forums" , post_other("arab-forums" , "login_userpass") , true , true , true , true , true));

define("loginusersave" , text_other("arab-forums" , post_other("arab-forums" , "login_usersave") , true , true , true , true , true));

if(loginusername == "" || loginuserpass == "" || loginusername == "إسم المستخدم" || loginuserpass == "الكلمة السرية"){

$logintrue = false;

$loginmsg = "الرجاء منك ملأ جميع البيانات ليتم التأكد من العضوية";

$errorclass = "error";

$loginip = array(false , 0);

}else{

$login_sql = select_mysql("arab-forums" , "user" , "user_id , user_namelogin , user_pass , user_lock1 , user_wait , user_active , user_bad" , "where user_namelogin = \"".loginusername."\" limit 1");

if(num_mysql("arab-forums" , $login_sql) == false){

$logintrue = false;

$loginmsg = "للأسف إسم المستخدم المدخل غير متوفر في بيانتنا";

$errorclass = "error";

$loginip = array(false , 0);

}else{

$login_object = object_mysql("arab-forums" , $login_sql);

if($login_object->user_pass != pass_other("arab-forums" , loginuserpass)){

$logintrue = false;

$loginmsg = "للأسف إسم المستخدم و الكلمة السرية المدخلتان غير متطابقتان مع بيانتنا";

$errorclass = "error";

$loginip = array(true , 1);

}elseif($login_object->user_lock1 == 1){

$logintrue = false;

$loginmsg = "للأسف العضوية المراد الدخول بها تم غلقها";

$errorclass = "error";

$loginip = array(false , 0);

}elseif($login_object->user_active == 1){

$logintrue = false;

$loginmsg = "للأسف العضوية المراد الدخول بها لم يتم تفعيلها بعد , الرجاء الذهاب إلى بريدك الإلكتروني و قم بتفعيلها";

$errorclass = "info";

$loginip = array(false , 0);

}elseif($login_object->user_wait == 1){

$logintrue = false;

$loginmsg = "للأسف العضوية المراد الدخول بها لم تتم مراجعتها من قبل الإدارة بعد";

$errorclass = "info";

$loginip = array(false , 0);

}elseif($login_object->user_bad == 1){

$logintrue = false;

$loginmsg = "للأسف العضوية المراد الدخول بها تم رفضها نهائيا";

$errorclass = "error";

$loginip = array(false , 0);

}else{

$logintrue = true;

$loginmsg = "";

$errorclass = "";

$loginip = array(true , 2);

}}}

if($logintrue == true){

if(loginusersave == 1){

set_cookie("arab-forums" , "username" , loginusername , time()+60*60*24*365);

set_cookie("arab-forums" , "userpass" , pass_other("arab-forums" , loginuserpass) , time()+60*60*24*365);

}else{

set_cookie("arab-forums" , "username" , loginusername , 0);

set_cookie("arab-forums" , "userpass" , pass_other("arab-forums" , loginuserpass) , 0);

}}

if($loginip[0] == true){

insert_mysql("arab-forums" , "ip" , "ip_id , ip_ip , ip_user , ip_date , ip_type , ip_code" , "null , \"".ip_other("arab-forums")."\" , \"{$login_object->user_id}\" , \"".time()."\" , \"{$loginip[1]}\" , \"".couip_other("arab-forums" , ip_other("arab-forums"))."\"");

}

if($loginmsg == ""){

exit(header("location: ".referer.""));

}else{

$arraymsg = array(

"login" => false ,

"msg" => $loginmsg ,

"color" => $errorclass ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"login" => false ,

"msg" => "بياناتنا تأكد أنك مسجل الدخول بالعضوية التالية : ".name_user."" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

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