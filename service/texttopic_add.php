<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(per_other("arab-forums" , 12) == true){

if(num_mysql("arab-forums" , select_mysql("arab-forums" , "forum" , "forum_id" , "where forum_id in(".allowedin1_other("arab-forums").")")) == false){

$arraymsg = array(

"msg" => "للأسف لا يمكنك إدخال إختصار جديد لأن عدد المنتديات التي تشرف عليها هي 0" ,

"color" => "error" ,

"url" => "" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}else{

if(type == "insert"){

$name = text_other("arab-forums" , post_other("arab-forums" , "name") , true , true , true , false , true);

$forumid = text_other("arab-forums" , post_other("arab-forums" , "forumid") , true , true , true , false , true);

if($name == "" || $forumid == ""){

$error = "الرجاء ملأ جميع الحقول ليتم إدخال الإختصار الجديد";

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

insert_mysql("arab-forums" , "texttopic" , "texttopic_id , texttopic_name , texttopic_forumid , texttopic_add , texttopic_date" , "null , \"{$name}\" , \"{$forumid}\" , \"".id_user."\" , \"".time()."\"");

$arraymsg = array(

"msg" => "تم إدخال الإختصار الجديد بنجاح تام" ,

"color" => "good" ,

"url" => "service.php?gert=texttopic&go=texttopic_list" ,

);

echo msgadmin_template("arab-forums" , $arraymsg);

}}else{

echo "<form action=\"service.php?gert=texttopic&go=texttopic_add&type=insert\" method=\"post\">";
 
echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" border=\"0\" width=\"99%\" align=\"center\">";

echo "<tr><td class=\"tcotadmin\">الإختصار تابع للمنتدى</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "where forum_id in(".allowedin1_other("arab-forums").") order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

echo "<select class=\"inputselect\" name=\"forumid\">";

if(group_user == 6){

echo "<option value=\"0\">إضافة الإختصار في جميع المنتديات</option>";

}

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

echo "<option value=\"{$forum_object->forum_id}\">{$forum_object->forum_name}</option>";

}

echo "</select>&nbsp;<span style=\"color:red;font-size:12px;\">إختر المنتدى الذي تريد إضافة الإختصار له</span>";

}

echo "</div></td></tr>";

echo "<tr><td class=\"tcotadmin\">إسم الإختصار</td></tr>";

echo "<tr><td class=\"alttext1\"><div class=\"pad\">";

echo "<input style=\"width:300px\" class=\"input\" name=\"name\" value=\"\" type=\"text\">&nbsp;<span style=\"color:red;font-size:12px;\">إدخال إسم الإختصار</span>";

echo "</div></td></tr>";

echo "<tr><td class=\"alttext2\" align=\"center\"><br><input type=\"submit\" class=\"button\" value=\"إدخال الإختصار الجديد\"  ".confirm_other("arab-forums" , "هل أنت متأكد من أنك تريد إدخال الإختصار الجديد ؟")."> - <input type=\"reset\" class=\"button\" value=\"إفراغ الحقول\"><br><br></td></tr>";

echo "</table></form>";

}}}else{

$arraymsg = array(

"msg" => "للأسف المجموعة التي تنتمي إليها لا تملك التصريح المناسب لهذه الخاصية" ,

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