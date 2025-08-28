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

define("pagebody" , "monitordelete");

online_other("arab-forums" , "monitordelete" , "0" , "0" , "0" , "0");

$monitordelete_sql = select_mysql("arab-forums" , "monitortopic" , "monitortopic_id , monitortopic_topicid , monitortopic_userid" , "where monitortopic_topicid in(".id.")");

if(group_user == 0){

$error = true;

}else{

if(num_mysql("arab-forums" , $monitordelete_sql) == false){

$error = true;

}else{

$monitordelete_object = object_mysql("arab-forums" , $monitordelete_sql);

if((group_user == 6) || ($monitordelete_object->monitortopic_userid == id_user)){

$error = false;

}else{

$error = true;

}}}

if($error == true){

$arraymsg = array(

"login" => true ,

"msg" => "للأسف لا يمكنك حذف هذا الموضوع من قائمة مواضيع المفضلة" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}else{

delete_mysql("arab-forums" , "monitortopic" , "monitortopic_id in({$monitordelete_object->monitortopic_id})");

$arraymsg = array(

"login" => true ,

"msg" => "تم حذف الموضوع من قائمة مواضيع المفضلة بنجآح تام" ,

"color" => "good" ,

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