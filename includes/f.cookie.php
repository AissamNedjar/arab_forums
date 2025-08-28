<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function set_cookie($copi , $name , $value , $time){

if($copi == "arab-forums"){

setcookie("{$name}".prefix_connect."" , $value , $time);

}}

function get_cookie($copi , $name){

if($copi == "arab-forums"){

$cookie = $_COOKIE["{$name}".prefix_connect.""];

return $cookie;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>