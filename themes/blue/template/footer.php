<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../../../error.php"));}

function footer_template($copi){

if($copi == "arab-forums"){

$template  = "";

if(ads3_option == 1){

$template .= "<br><br><center>";

$template .= "<script type=\"text/javascript\">";

$template .= "google_ad_client = \"".client3_option."\";";

$template .= "google_ad_slot = \"".slot3_option."\";";

$template .= "google_ad_width = 728;";

$template .= "google_ad_height = 90;";

$template .= "</script>";

$template .= "<script type=\"text/javascript\" src=\"".url3_option."\"></script>";

$template .= "</center>";

}

$template .= "<br><br><br>";

$template .= "<center>";

$template .= a_other("arab-forums" , "rss.php" , "ملخص المواضيع" , img_other("arab-forums" , "images/footer/rss.png" , "" , "" , "" , "0" , "" , "")."" , "");

$template .= "&nbsp;".a_other("arab-forums" , facebook_option , "صفحتنا على الفيس بوك" , img_other("arab-forums" , "images/footer/facebook.png" , "" , "" , "" , "0" , "" , "")."" , "");

$template .= "&nbsp;".a_other("arab-forums" , twitter_option , "تابعنا على تويتر" , img_other("arab-forums" , "images/footer/twitter.png" , "" , "" , "" , "0" , "" , "")."" , "");

$template .= "&nbsp;".a_other("arab-forums" , youtube_option , "قناتنا على اليوتيب" , img_other("arab-forums" , "images/footer/youtube.png" , "" , "" , "" , "0" , "" , "")."" , "");

$template .= "</center>";

$template .= "<br>";

$template .= "<div class=\"footer\">".copi_arab_forums."</div><br>";

$template .= "</div></div></div>";

$template .= "<div class=\"footer-center\">";

$template .= "<div class=\"footer-right\"></div>";

$template .= "<div class=\"footer-left\"></div></div>";

return $template;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>