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

define("pagebody" , "change");

online_other("arab-forums" , "change" , "0" , "0" , "0" , "0");

if(go == "time"){

set_cookie("arab-forums" , "time" , value , time()+60*60*24*365);

if(group_user > 0){

update_mysql("arab-forums" , "user" , "user_time = \"".value."\" where user_id = \"".id_user."\"");

}

exit(header("location: ".re.""));

}elseif(go == "style"){

set_cookie("arab-forums" , "style" , value , time()+60*60*24*365);

if(group_user > 0){

update_mysql("arab-forums" , "user" , "user_style = \"".value."\" where user_id = \"".id_user."\"");

}

exit(header("location: ".re.""));

}elseif(go == "usertartib1"){

set_cookie("arab-forums" , "usertartib1" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "usertartib2"){

set_cookie("arab-forums" , "usertartib2" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "topictartib1"){

set_cookie("arab-forums" , "topictartib1" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "topictartib2"){

set_cookie("arab-forums" , "topictartib2" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "topictartib3"){

set_cookie("arab-forums" , "topictartib3" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "tahdit"){

set_cookie("arab-forums" , "tahdit" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "replytopic"){

set_cookie("arab-forums" , "replytopic" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "tawa9i3"){

set_cookie("arab-forums" , "tawa9i3" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}elseif(go == "active"){

set_cookie("arab-forums" , "active" , value , time()+60*60*24*365);

exit(header("location: ".re.""));

}else{

$arraymsg = array(

"login" => true ,

"msg" => "عفوا لقد إتبعت رابط غير صحيح" ,

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