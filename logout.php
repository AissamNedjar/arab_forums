<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

define("error_page_arab_forums" , true);

@include("includes.php");

define("pagebody" , "logout");

online_other("arab-forums" , "logout" , "0" , "0" , "0" , "0");

if(group_user > 0){

if(go == (md5(id_user*51285858585455*sqlcode_connect))){

$logoutmsg = "";

}else{

$logoutmsg = "للأسف الرابط المتبع ليس لعضويتك و لهذا لا يمكنك تسجيل الخروج";

}

if($logoutmsg == ""){

set_cookie("arab-forums" , "username" , "" , time()+60*60*24*365);

set_cookie("arab-forums" , "userpass" , "" , time()+60*60*24*365);

exit(header("location: ".referer.""));

}else{

$arraymsg = array(

"login" => true ,

"msg" => $logoutmsg ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

$arraymsg = array(

"login" => true ,

"msg" => "للأسف بيانتنا تأكد أنك غير مسجل للدخول" ,

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