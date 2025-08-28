<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(editor == "true"){

$editor_sizetext = text_other("arab-forums" , post_other("arab-forums" , "message") , true , true , true , false , true);

$editor_message = text_other("arab-forums" , htmltext_other("arab-forums" , post_other("arab-forums" , "message")) , false , true , false , false , true);

$editor_title = text_other("arab-forums" , post_other("arab-forums" , "title") , true , true , true , false , true);

if(mb_strlen($editor_title) < 5 || mb_strlen($editor_title) > 100){

$erroreditor = "العنوان يجب أن يكون أطول من 5 حروف و أقل من 100 حرف";

}elseif(mb_strlen($editor_sizetext) < 3){

$erroreditor = "محتوى النص قصير جدا";

}else{

$erroreditor = "";

}

if($erroreditor != ""){

$arraymsg = array(

"msg" => $erroreditor ,

"color" => "error" ,

"url" => "" ,

);

}else{

$check = text_other("arab-forums" , post_other("arab-forums" , "check") , false , false , false , false , false);

$x = 0;

while($x < count($check)){

$lock = text_other("arab-forums" , post_other("arab-forums" , "lock") , true , true , true , false , true);

$hid = text_other("arab-forums" , post_other("arab-forums" , "hid") , true , true , true , false , true);

$stiky = text_other("arab-forums" , post_other("arab-forums" , "stiky") , true , true , true , false , true);

$top = text_other("arab-forums" , post_other("arab-forums" , "top") , true , true , true , false , true);

$mofr = ", topic_lock , topic_hid , topic_stiky , topic_top";

$mofg = ", \"{$lock}\" , \"{$hid}\" , \"{$stiky}\" , \"{$top}\"";

insert_mysql("arab-forums" , "topic" , "topic_id , topic_forumid , topic_wait {$mofr} , topic_date , topic_user , topic_lastdate , topic_name , topic_message" , "null , \"{$check[$x]}\" , \"0\" {$mofg} , \"".time()."\" , \"".id_user."\" , \"".time()."\" , \"{$editor_title}\" , \"{$editor_message}\"");

$insert = mysql_insert_id();

update_mysql("arab-forums" , "forum" , "forum_topic = forum_topic+1 , forum_lastdate = \"".time()."\" , forum_lastuser = \"".id_user."\" where forum_id in({$check[$x]})");

update_mysql("arab-forums" , "user" , "user_post = user_post+1 , user_topics = user_topics+1 , user_datelastpost = \"".time()."\" where user_id in(".id_user.")");

if($lock == "1"){

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$insert}\" , \"".id_user."\" , \"".time()."\" , \"lock\"");

}

if($hid == "1"){

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$insert}\" , \"".id_user."\" , \"".time()."\" , \"hid\"");

}

if($stiky == "1"){

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$insert}\" , \"".id_user."\" , \"".time()."\" , \"stiky\"");

}

if($top == "1"){

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$insert}\" , \"".id_user."\" , \"".time()."\" , \"top1\"");

}elseif($top == "2"){

insert_mysql("arab-forums" , "optiontopic" , "optiontopic_id , optiontopic_topicid , optiontopic_user , optiontopic_date , optiontopic_type" , "null , \"{$insert}\" , \"".id_user."\" , \"".time()."\" , \"top2\"");

}

++$x;

}

$arraymsg = array(

"msg" => "تم إدخال المواضيع بنجآح تام" ,

"color" => "good" ,

"url" => "admin.php?gert=topic&go=topic_topicall" ,

);

}

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

$arrayeditor = array(

"mode" => true ,

"appc" => 1 ,

"mose" => array("0" , "0" , "0" , "0") ,

"forum" => false ,

"admin" => true ,

"img" => img_other("arab-forums" , "images/admin.png" , "" , "50" , "50" , "0" , "" , "") ,

"opr" => a_other("arab-forums" , "admin.php?gert=topic&go=topic_topicall" , "إدخال موضوع جماعي" , "إدخال موضوع جماعي" , "") ,

"trother" => "" ,

"text" => "إدخال موضوع جماعي" ,

"url" => "admin.php?gert=topic&go=topic_topicall&" ,

"message" => "" ,

"type" => "newtopic" ,

"title" => "" ,

"other" => "" ,

);
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"alttext1\" align=\"center\"><br>".editor_template("arab-forums" , $arrayeditor)."<br><br></td></tr>";

echo "</table></form>";

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>