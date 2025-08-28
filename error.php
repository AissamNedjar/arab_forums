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

define("pagebody" , "error");

online_other("arab-forums" , "error" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "عفوآ لقد إتبعت رابط خاطئ" ,

"color" => "att" ,

"old" => true ,

"auto" => false ,

"text" => "الذهاب إلى الصفحة الرئيسية" ,

"url" => "home.php" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>