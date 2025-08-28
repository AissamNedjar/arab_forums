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

define("pagebody" , "sig");

$get_id = (id == "" || !is_numeric(id) ? id_user : id);

if($get_id != id_user && group_user != 6){

$get_id = id_user;

}

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_wait , user_active , user_bad , user_nameuser , user_sex , user_sig" , "where user_id in({$get_id}) && user_wait in(0) && user_active in(0) && user_bad in(0)");

if(num_mysql("arab-forums" , $user_sql) == false){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

if(group_user == 0){

$error = "للأسف لا يمكنك الولوج إلى هذه الصفحة لأنك لا تملك التصريح المناسب";

}elseif(sig_option == 0){

$error = "للأسف الإدارة قامت بمنع تغيير التوقيع";

}else{

$error = "";

}}

if($error != ""){

online_other("arab-forums" , "sig" , "0" , "0" , "0" , "0");

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

online_other("arab-forums" , "sig" , "0" , "0" , "0" , $user_object->user_id);

if($user_object->user_id == id_user){

$usertitle = "تعديل التوقيع الخاص بك";

$urltt = "sig.php";

$urltp = "sig.php?";

}else{

$usertitle = "تعديل التوقيع الخاص ".($user_object->user_sex == 1 ? "بالعضو" : "بالعضوة")." ".$user_object->user_nameuser."";

$urltt = "sig.php?id={$user_object->user_id}";

$urltp = "sig.php?id={$user_object->user_id}&";

}

if(editor == "true"){

$editor_sizetext = text_other("arab-forums" , post_other("arab-forums" , "message") , true , true , true , true , true);

$editor_message = text_other("arab-forums" , htmltext_other("arab-forums" , post_other("arab-forums" , "message")) , false , true , false , false , true);

if(mb_strlen($editor_sizetext) < 3){

$erroreditor = "محتوى النص قصير جدا";

}else{

$erroreditor = "";

}

if($erroreditor == ""){

update_mysql("arab-forums" , "user" , "user_sig = \"{$editor_message}\" where user_id in({$user_object->user_id})");

$arraymsg = array(

"login" => true ,

"msg" => "تم تعديل التوقيع بنجآح تام" ,

"color" => "good" ,

"old" => true ,

"auto" => true ,

"text" => "" ,

"url" => "data.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

$arraymsg = array(

"login" => true ,

"msg" => $erroreditor ,

"color" => "error" ,

"old" => true ,

"auto" => true ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}}else{

echo bodytop_template("arab-forums" , $usertitle);

$arrayheader = array(

"login" => true ,

);

echo header_template("arab-forums" , $arrayheader);

$arrayeditor = array(

"mode" => false ,

"appc" => 0 ,

"mose" => "" ,

"forum" => true ,

"admin" => false ,

"img" => img_other("arab-forums" , "images/sig.png" , "" , "50" , "50" , "0" , "" , "") ,

"opr" => a_other("arab-forums" , "{$urltt}" , "{$usertitle}" , "{$usertitle}" , "") ,

"trother" => "" ,

"text" => "{$usertitle}" ,

"url" => "{$urltp}" ,

"message" => messagereplase_other("arab-forums" , $user_object->user_sig , 0) ,

"type" => "sig" ,

"title" => "" ,

"other" => "" ,

);

echo editor_template("arab-forums" , $arrayeditor);

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