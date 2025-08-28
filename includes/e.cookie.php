<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$style_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "style") , true , true , true , true , true);

if(group_user > 0 && style_user != "" && num_mysql("arab-forums" , select_mysql("arab-forums" , "style" , "style_fils , style_lock" , "where style_fils = \"".style_user."\" && style_lock = \"0\" limit 1")) != false){

define("forum_style" , style_user);

}elseif($style_cookie != "" && num_mysql("arab-forums" , select_mysql("arab-forums" , "style" , "style_fils , style_lock" , "where style_fils = \"{$style_cookie}\" && style_lock = \"0\" limit 1")) != false){

define("forum_style" , $style_cookie);

}else{

define("forum_style" , styledefault_fils);

}

$time_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "time") , true , true , true , true , true);

if(group_user > 0 && time_user != "" && time_user <= +12 && time_user >= -12){

define("forum_time" , time_user);

}elseif($time_cookie != "" && $time_cookie <= +12 && $time_cookie >= -12){

define("forum_time" , $time_cookie);

}else{

define("forum_time" , time_option);

}

$usertartib1_array = array("post" , "point" , "name" , "group" , "register" , "lastvisit" , "lastpost" , "country");

$usertartib1_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "usertartib1") , true , true , true , true , true);

if($usertartib1_cookie != "" && in_array($usertartib1_cookie , $usertartib1_array)){

define("forum_usertartib1" , $usertartib1_cookie);

}else{

define("forum_usertartib1" , "post");

}

$usertartib2_array = array("desc" , "asc");

$usertartib2_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "usertartib2") , true , true , true , true , true);

if($usertartib2_cookie != "" && in_array($usertartib2_cookie , $usertartib2_array)){

define("forum_usertartib2" , $usertartib2_cookie);

}else{

define("forum_usertartib2" , "desc");

}

$topictartib1_array = array("post" , "date" , "topic" , "user" , "reply" , "visit");

$topictartib1_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "topictartib1") , true , true , true , true , true);

if($topictartib1_cookie != "" && in_array($topictartib1_cookie , $topictartib1_array)){

define("forum_topictartib1" , $topictartib1_cookie);

}else{

define("forum_topictartib1" , "post");

}

$topictartib2_array = array("desc" , "asc");

$topictartib2_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "topictartib2") , true , true , true , true , true);

if($topictartib2_cookie != "" && in_array($topictartib2_cookie , $topictartib2_array)){

define("forum_topictartib2" , $topictartib2_cookie);

}else{

define("forum_topictartib2" , "desc");

}

$topictartib3_array = array("30" , "40" , "50" , "60");

$topictartib3_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "topictartib3") , true , true , true , true , true);

if($topictartib3_cookie != "" && in_array($topictartib3_cookie , $topictartib3_array)){

define("forum_topictartib3" , $topictartib3_cookie);

}else{

define("forum_topictartib3" , ttopic_option);

}

$tahdit_array = array("0" , "60" , "300" , "600" , "900");

$tahdit_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "tahdit") , true , true , true , true , true);

if($tahdit_cookie != "" && in_array($tahdit_cookie , $tahdit_array)){

define("forum_tahdit" , $tahdit_cookie);

}else{

define("forum_tahdit" , 0);

}

$replytopic_array = array("10" , "30" , "50" , "70");

$replytopic_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "replytopic") , true , true , true , true , true);

if($replytopic_cookie != "" && in_array($replytopic_cookie , $replytopic_array)){

define("forum_replytopic" , $replytopic_cookie);

}else{

define("forum_replytopic" , treply_option);

}

$tawa9i3_array = array("0" , "1");

$tawa9i3_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "tawa9i3") , true , true , true , true , true);

if($tawa9i3_cookie != "" && in_array($tawa9i3_cookie , $tawa9i3_array)){

define("forum_tawa9i3" , $tawa9i3_cookie);

}else{

define("forum_tawa9i3" , 0);

}

$active_array = array("reply" , "visit" , "last" , "new" , "top");

$active_cookie = text_other("arab-forums" , get_cookie("arab-forums" , "active") , true , true , true , true , true);

if($active_cookie != "" && in_array($active_cookie , $active_array)){

define("forum_active" , $active_cookie);

}else{

define("forum_active" , "new");

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>