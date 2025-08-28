<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../../../error.php"));}

function bodytop_template($copi , $title){

if($copi == "arab-forums"){

$template  = "";

$template .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

$template .= "<html dir=\"rtl\" xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"ar-dz\"><head>";

$template .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1256\">";

$template .= "<meta name=\"generator\" content=\"Arab Forums 0.0.1 Beta\">";

$template .= "<meta name=\"keywords\" content=\"".keywords_option."\">";

$template .= "<meta name=\"description\" content=\"".description_option."\">";

$template .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"".ico_option."\">";

$template .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".forum_style."/css/reset.css\">";

$template .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".forum_style."/css/style.css\">";

$template .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".forum_style."/css/slide.css\">";

$template .= "<script type=\"text/javascript\" src=\"ajax/jquery.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"ajax/function.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"ajax/jscolor.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/rainbow.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/slide.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/slide2.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/easing.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/jquery.ui.totop.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"themes/".forum_style."/ajax/jquery.ui.totop2.js\"></script>";

$template .= "<title>".title_option." | {$title}</title>";

$template .= "</head><body onbeforeunload=\"beforeUnload(event);\">";

return $template;

}}

function bodybottom_template($copi){

if($copi == "arab-forums"){

$template = "</div></body></html>";

return $template;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>