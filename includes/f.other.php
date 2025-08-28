<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function text_other($copi , $text , $mysql , $add , $strip , $html , $xss){

if($copi == "arab-forums"){

if($html == true){

$text = HtmlSpecialchars($text);

}

if ($mysql == true) {
    $text = mysql_real_escape_string($text);
}

if($add == true){

$text = addslashes($text);

}

if($strip == true){

$text = strip_tags($text);

}

if($xss == true){

$ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'OBJECT', 'IFRAME', 'frame', 'frameset', 'ilayer', 'bgsound','base','quickEditor','');

$ra2 = array('SCRIPT','location','LOCATION','document','DOCUMENT','window','WINDOWS','onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

$ra = array_merge($ra1, $ra2);

foreach($ra as $value){

$text = str_replace($value , "" , $text);

$text = str_replace(strtoupper($value) , "" , $text);

}}

return $text;

}}

function pass_other($copi , $pass){

if($copi == "arab-forums"){

$pass_pass = md5($pass);

return $pass_pass;

}}

function ip_other($copi){

if($copi == "arab-forums"){

$ip_ip1 = "HTTP_X_FORWARDED_FOR";

$ip_ip2 = "HTTP_CLIENT_IP";

$ip_ip3 = "REMOTE_ADDR";

if(isset($_SERVER)){

if(isset($_SERVER["{$ip_ip}"])){

$ip_check = $_SERVER["{$ip_ip1}"];

}elseif(isset($_SERVER["{$ip_ip2}"])){

$ip_check = $_SERVER["{$ip_ip2}"];

}else{

$ip_check = $_SERVER["{$ip_ip3}"];

}}else{

if(@getenv($ip_ip1)){

$ip_check = @getenv($ip_ip1);

}elseif(@getenv($ip_ip2)){

$ip_check = @getenv($ip_ip2);

}else{

$ip_check = @getenv($ip_ip3);

}}

return $ip_check;

}}

function post_other($copi , $name){

if($copi == "arab-forums"){

$post_check = $_POST[$name];

return $post_check;

}}

function get_other($copi , $name){

if($copi == "arab-forums"){

$get_check = trim($_GET[$name]);

return $get_check;

}}

function server_other($copi , $name){

if($copi == "arab-forums"){

$server_check = trim($_SERVER[$name]);

return $server_check;

}}

function img_other($copi , $url , $title , $width , $height , $border , $other , $error){

if($copi == "arab-forums"){

if($width != ""){$width = "width=\"{$width}\"";}else{$width = "";}

if($height != ""){$height = "height=\"{$height}\"";}else{$height = "";}

if($error != ""){$error = "{$error}";}else{$error = "images/spacer.gif";}

if($url != ""){$url = "{$url}";}else{$url = $error;}

return "<img onerror=\"this.src='{$error}';\" {$other} src=\"{$url}\" alt=\"{$title}\" title=\"{$title}\" {$width} {$height} border=\"{$border}\">";

}}

function a_other($copi , $url , $title , $center , $other , $otherclass = ""){

if($copi == "arab-forums"){

return "<a href=\"{$url}\" ".($title == "" ? "" : "title=\"{$title}\" class=\"title{$otherclass}\"")." {$other}>{$center}</a>";

}}

function code_other($copi, $size)
{
    if ($copi == "arab-forums") {
        $chars = "azertyuiopqsdfghjkllmwxcvbn123456789";
        $rand_str = "";

        for ($i = 0; $i < $size; $i++) {
            $rand_str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $rand_str;
    }
}

function confirm_other($copi , $msg){

if($copi == "arab-forums"){

if($msg == ""){$msg = "هل أنت متأكد من أنك تريد إدخال البيانات الجديدة ؟";}

return "onclick=\"return message('{$msg}');\"";

}}

function online_other($copi , $type , $catid , $forumid , $topicid , $userid){

if($copi == "arab-forums"){

$sql_online = select_mysql("arab-forums" , "online" , "online_ip" , "where online_ip = \"".ip_other("arab-forums")."\"");

if(@mysql_num_rows($sql_online) == false){

insert_mysql("arab-forums" , "online" , "online_id , online_userid , online_group , online_type , online_catid , online_forumid , online_topicid , online_profileid , online_date , online_last , online_ip" , "null , \"".id_user."\" , \"".group_user."\" , \"".$type."\" , \"".$catid."\" , \"".$forumid."\" , \"".$topicid."\" , \"".$userid."\" , \"".time()."\" , \"".time()."\" , \"".ip_other("arab-forums")."\"");

}

update_mysql("arab-forums" , "online" , "online_userid = \"".id_user."\" , online_group = \"".group_user."\" , online_type = \"".$type."\" , online_catid = \"".$catid."\" , online_forumid = \"".$forumid."\" , online_topicid = \"".$topicid."\" , online_profileid = \"".$userid."\" , online_last = \"".time()."\" where online_ip = \"".ip_other("arab-forums")."\"");

delete_mysql("arab-forums" , "online" , "online_last < \"".(time()-60*10)."\"");

}}

function user_other($copi , $array){

if($copi == "arab-forums"){

if($array[5] != false){

$colors = $array[5];

}elseif($array[4] != null){

$colors = $array[4];

}else{if($array[1] == 1){

$colors = mcolor1_option;

}elseif($array[1] == 2){

$colors = mcolor2_option;

}elseif($array[1] == 3){

$colors = mcolor3_option;

}elseif($array[1] == 4){

$colors = mcolor4_option;

}elseif($array[1] == 5){

$colors = mcolor5_option;

}elseif($array[1] == 6){

$colors = mcolor6_option;

}}

if($array[3] == 1){

$strike1 = "<strike>";

$strike2 = "</strike>";

}else{

$strike1 = "";

$strike2 = "";

}

$user = a_other("arab-forums" , "profile.php?id={$array[0]}" , "مشاهدة بيانات : {$array[2]}" , "<span style=\"color:#{$colors};\">{$strike1}{$array[2]}{$strike2}</span>" , "");

return $user;

}}

function star_other($copi , $array){

if($copi == "arab-forums"){

$starget = "";

if($array[0] != null){

$star = $array[0];

}else{

if($array[1] == 1){

$star = scolor1_option;

}elseif($array[1] == 2){

$star = scolor2_option;

}elseif($array[1] == 3){

$star = scolor3_option;

}elseif($array[1] == 4){

$star = scolor4_option;

}elseif($array[1] == 5){

$star = scolor5_option;

}elseif($array[1] == 6){

$star = scolor6_option;

}}

if($array[2] < titlepoint1_option){

$numstar = 0;

}elseif($array[2] >= titlepoint1_option && $array[2] < titlepoint2_option){

$numstar = 1;

}elseif($array[2] >= titlepoint2_option && $array[2] < titlepoint3_option){

$numstar = 2;

}elseif($array[2] >= titlepoint3_option && $array[2] < titlepoint4_option){

$numstar = 3;

}elseif($array[2] >= titlepoint4_option && $array[2] < titlepoint5_option){

$numstar = 4;

}elseif($array[2] >= titlepoint5_option && $array[2] < titlepoint6_option){

$numstar = 5;

}elseif($array[2] >= titlepoint6_option && $array[2] < titlepoint7_option){

$numstar = 6;

}elseif($array[2] >= titlepoint7_option && $array[2] < titlepoint8_option){

$numstar = 7;

}elseif($array[2] >= titlepoint8_option && $array[2] < titlepoint9_option){

$numstar = 8;

}elseif($array[2] >= titlepoint9_option && $array[2] < titlepoint10_option){

$numstar = 9;

}elseif($array[2] >= titlepoint10_option){

$numstar = 10;

}

if($numstar > 0){

for($x = 1; $x <= $numstar; $x++){

$starget .= img_other("arab-forums" , "images/star/{$star}.png" , "" , "" , "" , "0" , "" , "");

if($x == 5){$starget .= "<br>";}

}}

return $starget;

}}

function title_other($copi , $array){

if($copi == "arab-forums"){

$titlesex1 = array(title1sex1_option , title2sex1_option , title3sex1_option , title4sex1_option , title5sex1_option , title6sex1_option , title7sex1_option , title8sex1_option , title9sex1_option , title10sex1_option , title11sex1_option , title12sex1_option , title13sex1_option , title14sex1_option , title15sex1_option , title16sex1_option);

$titlesex2 = array(title1sex2_option , title2sex2_option , title3sex2_option , title4sex2_option , title5sex2_option , title6sex2_option , title7sex2_option , title8sex2_option , title9sex2_option , title10sex2_option , title11sex2_option , title12sex2_option , title13sex2_option , title14sex2_option , title15sex2_option , title16sex2_option);

if($array[0] == 1){

$titleshow = $titlesex1;

}else{

$titleshow = $titlesex2;

}

if($array[2] < titlepoint1_option){

$titleget = $titleshow[0];

}elseif($array[2] >= titlepoint1_option && $array[2] < titlepoint2_option){

$titleget = $titleshow[1];

}elseif($array[2] >= titlepoint2_option && $array[2] < titlepoint3_option){

$titleget = $titleshow[2];

}elseif($array[2] >= titlepoint3_option && $array[2] < titlepoint4_option){

$titleget = $titleshow[3];

}elseif($array[2] >= titlepoint4_option && $array[2] < titlepoint5_option){

$titleget = $titleshow[4];

}elseif($array[2] >= titlepoint5_option && $array[2] < titlepoint6_option){

$titleget = $titleshow[5];

}elseif($array[2] >= titlepoint6_option && $array[2] < titlepoint7_option){

$titleget = $titleshow[6];

}elseif($array[2] >= titlepoint7_option && $array[2] < titlepoint8_option){

$titleget = $titleshow[7];

}elseif($array[2] >= titlepoin8_option && $array[2] < titlepoint9_option){

$titleget = $titleshow[8];

}elseif($array[2] >= titlepoin9_option && $array[2] < titlepoint10_option){

$titleget = $titleshow[9];

}elseif($array[2] >= titlepoin10_option){

$titleget = $titleshow[10];

}

if($array[1] == 1){

$titlereturn = $titleget;

}elseif($array[1] == 2){

$titlereturn = $titleshow[11];

}elseif($array[1] == 3){

$titlereturn = $titleshow[12];

}elseif($array[1] == 4){

$titlereturn = $titleshow[13];

}elseif($array[1] == 5){

$titlereturn = $titleshow[14];

}elseif($array[1] == 6){

$titlereturn = $titleshow[15];

}

return $titlereturn;

}}

function titlemonitor1_other($copi , $userid , $usersex , $div1 , $div2){

if($copi == "arab-forums"){

$get = "";

$sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_hid , cat_name , cat_monitor1 , cat_monitor1text" , "where cat_hid in(0) && cat_monitor1 in({$userid}) && cat_monitor1text in(1)");

if(num_mysql("arab-forums" , $sql) != false){

while($object = object_mysql("arab-forums" , $sql)){

$get .= $div1.($usersex == 1 ? "مراقب" : "مراقبة")." ".a_other("arab-forums" , "cat.php?id={$object->cat_id}" , $object->cat_name , $object->cat_name , "").$div2;

}}

return $get;

}}

function titlemonitor2_other($copi , $userid , $usersex , $div1 , $div2){

if($copi == "arab-forums"){

$get = "";

$sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_hid , cat_name , cat_monitor2 , cat_monitor2text" , "where cat_hid in(0) && cat_monitor2 in({$userid}) && cat_monitor2text in(1)");

if(num_mysql("arab-forums" , $sql) != false){

while($object = object_mysql("arab-forums" , $sql)){

$get .= $div1.($usersex == 1 ? "نائب مراقب" : "نائبة مراقب")." ".a_other("arab-forums" , "cat.php?id={$object->cat_id}" , $object->cat_name , $object->cat_name , "").$div2;

}}

return $get;

}}

function titlemodirater_other($copi , $userid , $usersex , $div1 , $div2){

if($copi == "arab-forums"){

$get = "";

$sql = select_mysql("arab-forums" , "moderate" , "f.forum_id , f.forum_hid1 , f.forum_hid2 , f.forum_moderattext , f.forum_name , m.moderate_forumid , m.moderate_userid , m.moderate_lock" , "as m left join forum".prefix_connect." as f on (m.moderate_forumid = f.forum_id) where f.forum_hid1 in(0) && f.forum_hid2 in(0) && m.moderate_userid in({$userid}) && m.moderate_lock in(0) && f.forum_moderattext in(1)");

if(num_mysql("arab-forums" , $sql) != false){

while($object = object_mysql("arab-forums" , $sql)){

$get .= $div1.($usersex == 1 ? "مشرف" : "مشرفة")." ".a_other("arab-forums" , "forum.php?id={$object->forum_id}" , $object->forum_name , $object->forum_name , "").$div2;

}}

return $get;

}}

function num_other($copi , $num){

if($copi == "arab-forums"){

if(mb_strlen($num) == 4){

$nums = substr($num , 0 , 1).",".substr($num , 1 , 3);

}elseif(mb_strlen($num) == 5){

$nums = substr($num , 0 , 2).",".substr($num , 2 , 4);

}elseif(mb_strlen($num) == 6){

$nums = substr($num , 0 , 3).",".substr($num , 3 , 5);

}elseif(mb_strlen($num) == 7){

$nums = substr($num , 0 , 1).",".substr($num , 1 , 3).",".substr($num , 4 , 6);

}elseif(mb_strlen($num) == 8){

$nums = substr($num , 0 , 2).",".substr($num , 2 , 3).",".substr($num , 5 , 7);

}else{

$nums = $num;

}

return $nums;

}}

function cathide_other($copi , $catid , $catmonitor1 , $catmonitor2){

if($copi == "arab-forums"){

$hidforum_sql = select_mysql("arab-forums" , "hidforum" , "hidforum_userid , hidforum_lock , hidforum_catid" , "where hidforum_lock in(0) && hidforum_userid in(".id_user.") && hidforum_catid in({$catid})");

$moderate_sql = select_mysql("arab-forums" , "moderate" , "moderate_userid , moderate_lock , moderate_catid" , "where moderate_lock in(0) && moderate_userid in(".id_user.") && moderate_catid in({$catid})");

$mode_sql = select_mysql("arab-forums" , "forum" , "forum_catid , forum_mode" , "where forum_catid in({$catid}) && (forum_mode != \"0\" && forum_mode = in({".group_user."})");

if((group_user > 4) || (num_mysql("arab-forums" , $mode_sql) != false) || ($catmonitor1 != 0 && id_user == $catmonitor1) || ($catmonitor2 != 0 && id_user == $catmonitor2) || (num_mysql("arab-forums" , $moderate_sql) != false) || (num_mysql("arab-forums" , $hidforum_sql) != false)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function forumhide1_other($copi , $forumid , $catmonitor1 , $catmonitor2 , $cyu){

if($copi == "arab-forums"){

$hidforum_sql = select_mysql("arab-forums" , "hidforum" , "hidforum_userid , hidforum_lock , hidforum_forumid" , "where hidforum_lock in(0) && hidforum_userid in(".id_user.") && hidforum_forumid in({$forumid})");

$moderate_sql = select_mysql("arab-forums" , "moderate" , "moderate_userid , moderate_lock , moderate_forumid" , "where moderate_lock in(0) && moderate_userid in(".id_user.") && moderate_forumid in({$forumid})");

if((group_user > 4) || ($cyu != 0 && group_user == $cyu) || ($catmonitor1 != 0 && id_user == $catmonitor1) || ($catmonitor2 != 0 && id_user == $catmonitor2) || (num_mysql("arab-forums" , $moderate_sql) != false) || (num_mysql("arab-forums" , $hidforum_sql) != false)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function forumhide2_other($copi , $catid , $catmonitor1 , $catmonitor2 , $cyu){

if($copi == "arab-forums"){

$moderate_sql = select_mysql("arab-forums" , "moderate" , "moderate_userid , moderate_lock , moderate_catid" , "where moderate_lock in(0) && moderate_userid in(".id_user.") && moderate_catid in({$catid})");

if((group_user > 4) || ($cyu != 0 && group_user == $cyu) || ($catmonitor1 != 0 && id_user == $catmonitor1) || ($catmonitor2 != 0 && id_user == $catmonitor2) || (num_mysql("arab-forums" , $moderate_sql) != false)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function br_other($copi , $text){

if($copi == "arab-forums"){

$check = str_replace("\r\n" , "<br>" , $text);

return $check;

}}

function class_other($copi , $class1 , $class2){

if($copi == "arab-forums"){

$check = "onmouseout=\"this.className='{$class1}'\" onmouseover=\"this.className='{$class2}'\"";

return $check;

}}

function couip_other($copi , $ip){

if($copi == "arab-forums"){

$couip_sql = select_mysql("arab-forums" , "couip" , "couip_star , couip_end , couip_code" , "where couip_star <= ".ip2long($ip)." && couip_end >= ".ip2long($ip)."");

if($ip == "127.0.0.1"){

return "LH";

}elseif(num_mysql("arab-forums" , $couip_sql) != false){

$couip_object = object_mysql("arab-forums" , $couip_sql);

return $couip_object->couip_code;

}else{

return "--";

}}}

function hasip_other($copi , $ip){

if($copi == "arab-forums"){

$ip = explode(".",$ip);

$ip[3] = "XXX";

$ip = implode("." , $ip);

$ip = "<span dir=\"ltr\">{$ip}</span>";

return $ip;

}}

function countip_other($copi , $code){

if($copi == "arab-forums"){

global $count_list;

return $count_list[$code];

}}

function allowedin1_other($copi){

if($copi == "arab-forums"){

if(group_user > 4){

$s1_sql = select_mysql("arab-forums" , "forum" , "forum_id" , "");

if(num_mysql("arab-forums" , $s1_sql) != false){

while($s1_object = object_mysql("arab-forums" , $s1_sql)){

$get1[] = $s1_object->forum_id;

}

$p1 = 1;

$p2 = 0;

$p3 = 0;

}else{

$get1[] = "";

$p1 = 0;

$p2 = 0;

$p3 = 0;

}}else{

$s1_sql = select_mysql("arab-forums" , "moderate" , "f.forum_id , m.moderate_userid , m.moderate_lock , m.moderate_forumid" , "as m left join forum".prefix_connect." as f on(m.moderate_forumid = f.forum_id) where m.moderate_lock in(0) && m.moderate_userid in(".id_user.")");

if(num_mysql("arab-forums" , $s1_sql) != false){

while($s1_object = object_mysql("arab-forums" , $s1_sql)){

$get1[] = $s1_object->moderate_forumid;

}

$p1 = 1;

}else{

$get1[] = "";

$p1 = 0;

}

$s2_sql = select_mysql("arab-forums" , "cat" , "cat_monitor1 , cat_id" , "where cat_monitor1 in(".id_user.")");

if(num_mysql("arab-forums" , $s2_sql) != false){

while($s2_object = object_mysql("arab-forums" , $s2_sql)){

$s3_sql = select_mysql("arab-forums" , "forum" , "forum_catid , forum_id" , "where forum_catid in(".$s2_object->cat_id.")");

if(num_mysql("arab-forums" , $s3_sql) != false){

while($s3_object = object_mysql("arab-forums" , $s3_sql)){

$get2[] = $s3_object->forum_id;

}

$p2 = 1;

}else{

$get2[] = "";

$p2 = 0;

}}

$p2 = 1;

}else{

$get2[] = "";

$p2 = 0;

}

$s4_sql = select_mysql("arab-forums" , "cat" , "cat_monitor2 , cat_id" , "where cat_monitor2 in(".id_user.")");

if(num_mysql("arab-forums" , $s4_sql) != false){

while($s4_object = object_mysql("arab-forums" , $s4_sql)){

$s5_sql = select_mysql("arab-forums" , "forum" , "forum_catid , forum_id" , "where forum_catid in(".$s4_object->cat_id.")");

if(num_mysql("arab-forums" , $s5_sql) != false){

while($s5_object = object_mysql("arab-forums" , $s5_sql)){

$get3[] = $s5_object->forum_id;

}

$p3 = 1;

}else{

$get3[] = "";

$p3 = 0;

}}

$p3 = 1;

}else{

$get3[] = "";

$p3 = 0;

}

$s6_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_mode" , "where (forum_mode != \"0\" && forum_mode in(".group_user."))");

if(num_mysql("arab-forums" , $s6_sql) != false){

while($s6_object = object_mysql("arab-forums" , $s6_sql)){

$get4[] = $s6_object->forum_id;

}

$p4 = 1;

}else{

$get4[] = "";

$p4 = 0;

}}

$forum1_yrp = $get1;

$forum2_yrp = $get2;

$forum3_yrp = $get3;

$forum4_yrp = $get4;

for($x1 = 0; $x1 < count($forum1_yrp); $x1++){

$forum1_for .= $forum1_yrp[$x1];

if($x1+1 != count($forum1_yrp)){

$forum1_for .= ", ";

}}

for($x2 = 0; $x2 < count($forum2_yrp); $x2++){

$forum2_for .= $forum2_yrp[$x2];

if($x2+1 != count($forum2_yrp)){

$forum2_for .= ", ";

}}

for($x3 = 0; $x3 < count($forum3_yrp); $x3++){

$forum3_for .= $forum3_yrp[$x3];

if($x3+1 != count($forum3_yrp)){

$forum3_for .= ", ";

}}

for($x4 = 0; $x4 < count($forum4_yrp); $x4++){

$forum4_for .= $forum4_yrp[$x4];

if($x4+1 != count($forum4_yrp)){

$forum4_for .= ", ";

}}

if($p1 == 1 && $p2 == 1 && $p3 == 1 && $p4 == 1){

$check = $forum1_for.", ".$forum2_for.", ".$forum3_for.", ".$forum4_for;

}elseif($p1 == 1 && $p2 == 0 && $p3 == 0 && $p4 == 0){

$check = $forum1_for;

}elseif($p1 == 0 && $p2 == 1 && $p3 == 0 && $p4 == 0){

$check = $forum2_for;

}elseif($p1 == 0 && $p2 == 0 && $p3 == 1 && $p4 == 0){

$check = $forum3_for;

}elseif($p1 == 0 && $p2 == 0 && $p3 == 0 && $p4 == 1){

$check = $forum4_for;

}elseif($p1 == 1 && $p2 == 1 && $p3 == 1 && $p4 == 1){

$check = $forum1_for.", ".$forum2_for.", ".$forum3_for.", ".$forum4_for;

}elseif($p1 == 1 && $p2 == 1 && $p3 == 1 && $p4 == 0){

$check = $forum1_for.", ".$forum2_for.", ".$forum3_for;

}elseif($p1 == 0 && $p2 == 1 && $p3 == 1 && $p4 == 0){

$check = $forum2_for.", ".$forum3_for;

}elseif($p1 == 1 && $p2 == 0 && $p3 == 1 && $p4 == 0){

$check = $forum1_for.", ".$forum3_for;

}elseif($p1 == 1 && $p2 == 1 && $p3 == 0 && $p4 == 0){

$check = $forum1_for.", ".$forum2_for;

}elseif($p1 == 1 && $p2 == 1 && $p3 == 0 && $p4 == 1){

$check = $forum1_for.", ".$forum2_for.", ".$forum4_for;

}elseif($p1 == 1 && $p2 == 0 && $p3 == 0 && $p4 == 1){

$check = $forum1_for.", ".$forum4_for;

}elseif($p1 == 0 && $p2 == 1 && $p3 == 0 && $p4 == 1){

$check = $forum2_for.", ".$forum4_for;

}elseif($p1 == 1 && $p2 == 0 && $p3 == 1 && $p4 == 1){

$check = $forum1_for.", ".$forum3_for.", ".$forum4_for;

}elseif($p1 == 0 && $p2 == 0 && $p3 == 1 && $p4 == 1){

$check = $forum3_for.", ".$forum4_for;

}elseif($p1 == 0 && $p2 == 1 && $p3 == 1 && $p4 == 1){

$check = $forum2_for.", ".$forum3_for.", ".$forum4_for;

}else{

$check = "";

}

return $check;

}}

function allowedin2_other($copi){

if($copi == "arab-forums"){

if(group_user > 4){

$s1_sql = select_mysql("arab-forums" , "forum" , "forum_id" , "");

if(num_mysql("arab-forums" , $s1_sql) != false){

while($s1_object = object_mysql("arab-forums" , $s1_sql)){

$get1[] = $s1_object->forum_id;

}}else{

$get1[] = "";

}}else{

$s2_sql = select_mysql("arab-forums" , "cat" , "cat_monitor1 , cat_id" , "where cat_monitor1 in(".id_user.")");

if(num_mysql("arab-forums" , $s2_sql) != false){

while($s2_object = object_mysql("arab-forums" , $s2_sql)){

$s3_sql = select_mysql("arab-forums" , "forum" , "forum_catid , forum_id" , "where forum_catid in(".$s2_object->cat_id.")");

if(num_mysql("arab-forums" , $s3_sql) != false){

while($s3_object = object_mysql("arab-forums" , $s3_sql)){

$get1[] = $s3_object->forum_id;

}}else{

$get1[] = "";

}}}else{

$get1[] = "";

}

}

$forum1_yrp = $get1;

for($x1 = 0; $x1 < count($forum1_yrp); $x1++){

$forum1_for .= $forum1_yrp[$x1];

if($x1+1 != count($forum1_yrp)){

$forum1_for .= ", ";

}}

$check = $forum1_for;

return $check;

}}

function allowedin3_other($copi , $forumid , $modetype){

if($copi == "arab-forums"){

$forum_sql = select_mysql("arab-forums" , "forum" , "c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , c.cat_group".group_user." , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_group".group_user." , f.forum_mode" , "as f left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where f.forum_id in({$forumid}) && c.cat_group".group_user." in(1) && f.forum_group".group_user." in(1) limit 1");

if(num_mysql("arab-forums" , $forum_sql) == false){

$error = false;

}else{

$forum_object = object_mysql("arab-forums" , $forum_sql);

if($forum_object->cat_hid == true && cathide_other("arab-forums" , $forum_object->cat_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2) == false){

$error = false;

}elseif($forum_object->forum_hid1 == true && forumhide1_other("arab-forums" , $forum_object->forum_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode) == false){

$error = false;

}elseif($forum_object->forum_hid2 == true && forumhide2_other("arab-forums" , $forum_object->cat_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode) == false){

$error = false;

}else{

$moderatget1 = moderatget1_other("arab-forums" , $forum_object->forum_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $forum_object->cat_monitor1 , $forum_object->cat_monitor2);

if($modetype == 1 && $moderatget1 == true){

$error = true;

}elseif($modetype == 2 && $moderatget2 == true){

$error = true;

}elseif($modetype == 3){

$error = true;

}else{

$error = false;

}}}

return $error;

}}

function per_other($copi , $num){

if($copi == "arab-forums"){

$per1 = array(permochrifin1_option , pernawab1_option , permrakbin1_option , per3amin1_option);

$per2 = array(permochrifin2_option , pernawab2_option , permrakbin2_option , per3amin2_option);

$per3 = array(permochrifin3_option , pernawab3_option , permrakbin3_option , per3amin3_option);

$per4 = array(permochrifin4_option , pernawab4_option , permrakbin4_option , per3amin4_option);

$per5 = array(permochrifin5_option , pernawab5_option , permrakbin5_option , per3amin5_option);

$per6 = array(permochrifin6_option , pernawab6_option , permrakbin6_option , per3amin6_option);

$per7 = array(permochrifin7_option , pernawab7_option , permrakbin7_option , per3amin7_option);

$per8 = array(permochrifin8_option , pernawab8_option , permrakbin8_option , per3amin8_option);

$per9 = array(permochrifin9_option , pernawab9_option , permrakbin9_option , per3amin9_option);

$per10 = array(permochrifin10_option , pernawab10_option , permrakbin10_option , per3amin10_option);

$per11 = array(permochrifin11_option , pernawab11_option , permrakbin11_option , per3amin11_option);

$per12 = array(permochrifin12_option , pernawab12_option , permrakbin12_option , per3amin12_option);

if($num == 1){

$permess = $per1;

}elseif($num == 2){

$permess = $per2;

}elseif($num == 2){

$permess = $per2;

}elseif($num == 3){

$permess = $per3;

}elseif($num == 4){

$permess = $per4;

}elseif($num == 5){

$permess = $per5;

}elseif($num == 6){

$permess = $per6;

}elseif($num == 7){

$permess = $per7;

}elseif($num == 8){

$permess = $per8;

}elseif($num == 9){

$permess = $per9;

}elseif($num == 10){

$permess = $per10;

}elseif($num == 11){

$permess = $per11;

}elseif($num == 12){

$permess = $per12;

}

if((group_user == 6) || (group_user == 5 && $permess[3] == 1) || (group_user == 4 && $permess[2] == 1) || (group_user == 3 && $permess[1] == 1) || (group_user == 2 && $permess[0] == 1)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function moderatget1_other($copi , $forumid , $catmonitor1 , $catmonitor2 , $cyu){

if($copi == "arab-forums"){

$moderate_sql = select_mysql("arab-forums" , "moderate" , "moderate_userid , moderate_lock , moderate_forumid" , "where moderate_lock in(0) && moderate_userid in(".id_user.") && moderate_forumid in({$forumid})");

if((group_user == 6) || (group_user == 5 && per3amin1_option == 1) || ($cyu != 0 && group_user == $cyu) || ($catmonitor1 != 0 && id_user == $catmonitor1 && permrakbin1_option == 1) || ($catmonitor2 != 0 && id_user == $catmonitor2 && pernawab1_option == 1) || (num_mysql("arab-forums" , $moderate_sql) != false && permochrifin1_option == 1)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function moderatget2_other($copi , $catmonitor1 , $catmonitor2){

if($copi == "arab-forums"){

if((group_user == 6) || (group_user == 5 && per3amin1_option == 1) || ($catmonitor1 != 0 && id_user == $catmonitor1 && permrakbin1_option == 1) || ($catmonitor2 != 0 && id_user == $catmonitor2 && pernawab1_option == 1)){

$check = true;

}else{

$check = false;

}

return $check;

}}

function htmltext_other($copi , $text){

if($copi == "arab-forums"){

$text2 = "<div style=\"font-weight:".editorblod_user.";text-align:".editoralign_user.";font-family:".editorfont_user.";font-size:".editorsize_user.";color:".editorcolor_user."\">{$text}</div>";

return $text2;

}}

function country_other($copi , $code){

if($copi == "arab-forums"){

global $country_list;

return $country_list[$code];

}}

function totaldays_other($copi , $totaldays){

if($copi == "arab-forums"){

$totaldays = time()-$totaldays;

$totaldays = $totaldays/86500;

$totaldays = ceil($totaldays);

return $totaldays;

}}

function middleposts_other($copi , $middleposts1 , $middleposts2){

if($copi == "arab-forums"){

$middleposts3 = totaldays_other("arab-forums" , $middleposts2);

$middleposts4 = $middleposts1/$middleposts3;

$middleposts4 = sprintf("%.2f",$middleposts4);

return $middleposts4;

}}

function messagereplase_other($copi , $message , $forumid){

if($copi == "arab-forums"){

$message = stripslashes($message);

$message = str_replace("[]" , "" , $message);

$message = preg_replace("#<meta(.*)>#" , "" ,$message);

$message = preg_replace("#<META(.*)>#" , "" , $message);

$message = str_replace("position:absolute;" , "" , $message);

$message = str_replace("absolute" , "" , $message);

$message = str_replace("overflow:hidden;" , "" , $message);

$message = str_replace("z-index" , "" , $message);
   
return $message;

}}

function codesql1_other($copi , $code1 , $code2){

if($copi == "arab-forums"){

if($code2 == 1){

$forp1 = "0125845241343".sqlcode_connect;

$forp2 = "451451961709744457";

}elseif($code2 == 2){

$forp1 = "4464461414126".sqlcode_connect;

$forp2 = "426416422412485541";

}elseif($code2 == 3){

$forp1 = "9787857472247".sqlcode_connect;

$forp2 = "427457545745746474";

}elseif($code2 == 4){

$forp1 = "9878878748754".sqlcode_connect;

$forp2 = "425747463335453754";

}elseif($code2 == 5){

$forp1 = "8754527427427".sqlcode_connect;

$forp2 = "575457427425976467";

}

$code4 = $forp1.$code1.$forp2;

$code5 = base64_encode($code4);

$code6 = str_replace("=" , "" , $code5);

return $code6;

}}

function codesql2_other($copi , $code1 , $code2){

if($copi == "arab-forums"){

if($code2 == 1){

$forp1 = "0125845241343".sqlcode_connect;

$forp2 = "451451961709744457";

}elseif($code2 == 2){

$forp1 = "4464461414126".sqlcode_connect;

$forp2 = "426416422412485541";

}elseif($code2 == 3){

$forp1 = "9787857472247".sqlcode_connect;

$forp2 = "427457545745746474";

}elseif($code2 == 4){

$forp1 = "9878878748754".sqlcode_connect;

$forp2 = "425747463335453754";

}elseif($code2 == 5){

$forp1 = "8754527427427".sqlcode_connect;

$forp2 = "575457427425976467";

}

$code4 = $code1."==";

$code5 = base64_decode($code4);

$code6 = str_replace($forp1 , "" , $code5);

$code7 = str_replace($forp2 , "" , $code6);

return $code7;

}}

function quote_other($copi , $user , $url , $message){

if($copi == "arab-forums"){

$text  = "";

$text .= "<br><center><table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"90%\" align=\"center\" style=\"border:2px dashed #ff9c00;margin:10px;\">";

$text .= "<tr><td align=\"center\" style=\"background:#fffbc3 url(images/quote.gif) no-repeat center right;border-bottom:2px dashed #ff9c00;\">&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
 
$text .= "<tr><td style=\"background:#ffffff\"><div style=\"font-weight:blod;text-align:right;font-family:comic sans ms;font-size:15px;color:gray\">المشاركة الأصلية كتبت بواسطة : {$user} ".a_other("arab-forums" , $url , "مشاهدة المشاركة" , img_other("arab-forums" , "images/viewpost.gif" , "مشاهدة المشاركة" , "" , "" , "0" , "" , "") , "")."</div>";
 
$text .= "<div>{$message}</div></td></tr></table></center>";

return $text;

}}

function counts_other($copi , $v){

if($copi == "arab-forums"){

$count = 0;

for($x = 0; $x < count($v); ++$x){

if($v[$x] != ""){

$count = $count + 1;

}}

return($count);

}}

function mailcode_other($copi , $text , $charset , $base){

if($copi == "arab-forums"){

$text = iconv("windows-1256" , $charset , $text);

if($base == true){

$text = "=?{$charset}?B?".base64_encode($text)."?=";

}

return $text;

}}

function mail_other($copi , $to , $subject , $message , $from , $fromname , $toname){

if($copi == "arab-forums"){

$headers = "";

$charset = "utf-8";

$message = str_replace("\n" , "<br>" , $message);

$message = mailcode_other("arab-forums" , $message , $charset , false);

$subject= mailcode_other("arab-forums" , $subject , $charset , true);

$forumtitle = mailcode_other("arab-forums" , title_option , $charset , true);

if($toname != ""){

$to = "To: { ".mailcode_other("arab-forums" , $toname , $charset , true)."} <{$to}>";

}

if($from == ""){

$headers .= "From: ".title_option." <".emailbiot_option.">\r\n";

}else{

if($fromname != ""){

$forumtitle .= ":{ ".mailcode_other("arab-forums" , $fromname , $charset , true)."}";

}

$headers .= "From: ".title_option." <{$from}>\t\n";

}

$headers .= "Sender: ".emailbiot_option."\t\n";

$headers .= "Return-Path: ".emailbiot_option."\t\n";

$headers .= "MIME-Version: 1.0\t\n";

$headers .= "Content-Type: text/html; charset=\"{$charset}\"\t\n";

$headers .= "Content-Transfer-Encoding: 8bit\t\n";

$headers .= "X-Priority: 3\t\n";

$headers .= "X-Mailer: Arab Forums Mail By PHP\t\n";

@ini_set("sendmail_from" , emailbiot_option);

$result = @mail($to , $subject , $message , trim($headers));

return $result;

}}

function dayspp1_other($copi , $dayspp1){

if($copi == "arab-forums"){

$dayspp2 = ceil(time() - 60*60*24*$dayspp1);

return $dayspp2;

}}

function file_get_contents_arabs($copi , $urlt){

if($copi == "arab-forums"){

$content = @file_get_contents($urlt);

return $content;

}}

function codeio_other($copi , $code , $plu){

if($copi == "arab-forums"){

$forp1 = "8875522026666".$plu;

$forp2 = "988515152152555255".$plu;

$code4 = $forp1.$code.$forp2;

$code5 = base64_encode($code4);

$code6 = str_replace("=" , "" , $code5);

return $code6;

}}

function decosedtate_other($copi , $code , $plu){

if($copi == "arab-forums"){

$forp1 = "8875522026666".$plu;

$forp2 = "988515152152555255".$plu;

$code4 = $code."==";

$code5 = base64_decode($code4);

$code6 = str_replace($forp1 , "" , $code5);

$code7 = str_replace($forp2 , "" , $code6);

return $code7;

}}

function urlimghids_other($copi , $message , $url , $img , $urlhid , $total , $moderat , $user){

if($copi == "arab-forums"){

if($user != id_user && $moderat == false){

$oppoo = false;

}else{

$oppoo = true;

}

$message = str_replace('<span id="skype_highlighting_settings" display="none" autoextractnumbers="1">' , "" , $message);

$message = preg_replace('#< id="skype_plugin_" (.*)"></>#siU' , "" , $message);

if($url == 1){

$message = preg_replace('#<a (.*)">(.*)></>#siU' , "<table cellpadding=\"3\" cellspacing=\"1\" align=\"center\"><tr><td class=\"topiclink1\"><span style=\"color:red;font-size:13px;\">رابط مخفي</span></td></tr></table><br>" , $message);

}elseif($urlhid == 1 && $total == false && $oppoo == false){

$message = preg_replace('#<a (.*)">(.*)</a>#siU' , "<span style=\"color:red;font-size:14px;\">لا يمكنك مشاهدة الروابط إلى بعد الرد على الموضوع</span>" , $message);

}


if($img == 1){

$message = preg_replace("#<img (.*)>#siU" , "<table cellpadding=\"3\" cellspacing=\"1\" align=\"center\"><tr><td class=\"topiclink1\"><span style=\"color:red;font-size:13px;\">صورة مخفية</span></td></tr></table><br>" , $message);

}
   
return $message;

}}

function wasafallo_other($copi , $wasafid , $modetype , $ouii , $waiut){

if($copi == "arab-forums"){

$wasaf_sql = select_mysql("arab-forums" , "wasaf" , "w.wasaf_id , w.wasaf_forumid , w.wasaf_lock , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_group".group_user." , f.forum_mode" , "as w left join forum".prefix_connect." as f on(w.wasaf_forumid = f.forum_id) left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where w.wasaf_id in({$wasafid}) limit 1");

if(num_mysql("arab-forums" , $wasaf_sql) == false){

$error = false;

}else{

$wasaf_object = object_mysql("arab-forums" , $wasaf_sql);

if($wasaf_object->wasaf_forumid == 0){

if(group_user == 6){

$error = true;

}else{

if($ouii == "show"){

$error = true;

}else{

$error = false;

}}}else{

$moderatget1 = moderatget1_other("arab-forums" , $wasaf_object->forum_id , $wasaf_object->cat_monitor1 , $wasaf_object->cat_monitor2 , $wasaf_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $wasaf_object->cat_monitor1 , $wasaf_object->cat_monitor2);

if($modetype == 1 && $moderatget1 == true){

$error = true;

}elseif($modetype == 2 && $moderatget2 == true){

$error = true;

}else{

$error = false;

}}}

if($waiut == true){

if($error == false){

$opooooo = $error;

}else{

if($wasaf_object->wasaf_lock == 0){

$opooooo = true;

}else{

$opooooo = false;

}}}else{

$opooooo = $error;

}

return $opooooo;

}}

function medalallo_other($copi , $medalid , $modetype , $ouii , $waiut){

if($copi == "arab-forums"){

$medal_sql = select_mysql("arab-forums" , "medal" , "w.medal_id , w.medal_forumid , w.medal_lock , c.cat_id , c.cat_hid , c.cat_monitor1 , c.cat_monitor2 , f.forum_id , f.forum_catid , f.forum_hid1 , f.forum_hid2 , f.forum_group".group_user." , f.forum_mode" , "as w left join forum".prefix_connect." as f on(w.medal_forumid = f.forum_id) left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) where w.medal_id in({$medalid}) limit 1");

if(num_mysql("arab-forums" , $medal_sql) == false){

$error = false;

}else{

$medal_object = object_mysql("arab-forums" , $medal_sql);

if($medal_object->medal_forumid == 0){

if(group_user == 6){

$error = true;

}else{

if($ouii == "show"){

$error = true;

}else{

$error = false;

}}}else{

$moderatget1 = moderatget1_other("arab-forums" , $medal_object->forum_id , $medal_object->cat_monitor1 , $medal_object->cat_monitor2 , $medal_object->forum_mode);

$moderatget2 = moderatget2_other("arab-forums" , $medal_object->cat_monitor1 , $medal_object->cat_monitor2);

if($modetype == 1 && $moderatget1 == true){

$error = true;

}elseif($modetype == 2 && $moderatget2 == true){

$error = true;

}else{

$error = false;

}}}

if($waiut == true){

if($error == false){

$opooooo = $error;

}else{

if($medal_object->medal_lock == 0){

$opooooo = true;

}else{

$opooooo = false;

}}}else{

$opooooo = $error;

}

return $opooooo;

}}

function userallo_other($copi , $tyu , $user){

if($copi == "arab-forums"){

if($tyu == "name"){

$goadd = "user_nameuser";

}else{

$goadd = "user_id";

}

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_id , user_wait , user_bad , user_active" , "where {$goadd} = \"{$user}\" && user_wait in(0) && user_bad in(0) && user_active in(0) limit 1");

if(num_mysql("arab-forums" , $user_sql) == false){

$error = false;

}else{

$user_object = object_mysql("arab-forums" , $user_sql);

$error = true;

}

return $error;

}}

function bars_other($copi , $name , $wait1 , $wait2 , $color){

if($copi == "arab-forums"){

$get  = "<style>";

$get .= ".{$name}-arab-forums-1{background-color:transparent;width:{$wait1}px;height:8px;border-color:{$color};border-width:2px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border-style:solid;text-align:right;}";

$get .= ".{$name}-arab-forums-2{background-color:{$color};width:{$wait2}px;height:4px;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;margin:2px;}";

$get .= "</style>";

$get .= "<div class=\"{$name}-arab-forums-1\"><div class=\"{$name}-arab-forums-2\"></div></div>";
   
return $get;

}}

function percentage_other($copi , $counts , $total){

if($copi == "arab-forums"){

$option = $counts * 500;

$total_p = $total + 0.01;

$option = $option / $total_p;

$option = ceil($option);

if($option > 100) $option = 100;

return $option;

}}

function titlewasaf_other($copi , $userid , $uos , $forumid , $div1 , $div2){

if($copi == "arab-forums"){

$get = "";

$sql = select_mysql("arab-forums" , "getwasaf" , "g.getwasaf_id , g.getwasaf_wasafid , g.getwasaf_userid , g.getwasaf_lock , g.getwasaf_date , f.forum_id , f.forum_name , w.wasaf_id , w.wasaf_forumid , w.wasaf_forumall , w.wasaf_lock , w.wasaf_name" , "as g left join wasaf".prefix_connect." as w on(w.wasaf_id = g.getwasaf_wasafid) left join forum".prefix_connect." as f on(f.forum_id = w.wasaf_forumid) where g.getwasaf_userid in({$userid}) && w.wasaf_lock in(0) && g.getwasaf_lock in(0) order by g.getwasaf_date asc");

if(num_mysql("arab-forums" , $sql) != false){

while($object = object_mysql("arab-forums" , $sql)){

if($uos == false){

if($object->wasaf_forumid == 0){

$yuusiisi = true;

}elseif($object->wasaf_forumall == 1){

$yuusiisi = true;

}elseif($object->wasaf_forumid != 0 && $object->wasaf_forumall == 0 && $object->wasaf_forumid == $forumid){

$yuusiisi = true;

}else{

$yuusiisi = false;

}}else{

$yuusiisi = true;

}

if($object->wasaf_forumid == 0){

$span1 = "<span style=\"color:red;\">";

$span2 = "</span>";

}elseif($object->wasaf_forumid > 0 && $object->wasaf_forumall == 1){

$span1 = "<span style=\"color:blue;\">";

$span2 = "</span>";

}else{

$span1 = "";

$span2 = "";

}

if($yuusiisi == true){

$get .= "{$div1}{$span1}{$object->wasaf_name}{$span2}".($uos == true ? ($object->wasaf_forumid != 0 ? " - ".a_other("arab-forums" , "forum.php?id={$object->forum_id}" , "{$object->forum_name}" , "{$object->forum_name}" , "") : "")."" : "")."{$div2}";

}}}

return $get;

}}

function passtoui_other($copi , $pass , $md5){

if($copi == "arab-forums"){

if($md5 == true){

$pass_pass = md5($pass);

}else{

$pass_pass = $pass;

}

return $pass_pass;

}}

function sqlolll_other($copi , $var){

if($copi == "arab-forums"){

$vlink = trim($var); 

$vlink = stripslashes($vlink);

$vlink = nl2br($vlink); 

$xarray = array("select" , "insert" , "update" , "delet" , "great" , "drop" , "grant" , "union" , "group" , "FROM" , "where" , "limit" , "order" , "by" , "\." , "\.." , "\..." , "\/" , "\"" , "\'" , "<" , ">" , "%" , "\*" , "\#" , "\;" , "\\" , "\~" , "\&" , "@" , "\!" , ":" , "+" , "_" , "(" , ")");

foreach ($xarray as $danger) {
    if (@preg_match("/" . preg_quote($danger, "/") . "/i", $vlink)) {
        header("Location: error.php");
        exit;
    }
}

return $vlink;

}}

if(!function_exists('mb_strlen')){

function mb_strlen($str){

return strlen(iconv("UTF-8","cp1251", $str));

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>