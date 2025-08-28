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

$type = text_other("arab-forums" , post_other("arab-forums" , "type") , true , true , true , true , true);

if($type == "style_user_arab_forums"){

$align = text_other("arab-forums" , post_other("arab-forums" , "align") , true , true , true , true , true);

$weight = text_other("arab-forums" , post_other("arab-forums" , "weight") , true , true , true , true , true);

$family = text_other("arab-forums" , post_other("arab-forums" , "family") , true , true , true , true , true);

$size = text_other("arab-forums" , post_other("arab-forums" , "size") , true , true , true , true , true);

$color = text_other("arab-forums" , post_other("arab-forums" , "color") , true , true , true , true , true);

if($align != "" || $weight != "" || $family != "" || $size != "" || $color != ""){

update_mysql("arab-forums" , "user" , "user_editoralign = \"{$align}\" , user_editorblod = \"{$weight}\" , user_editorsize = \"{$size}\" , user_editorcolor = \"{$color}\" , user_editorfont = \"{$family}\" where user_id = \"".id_user."\"");

echo "1";

}

}elseif($type == "phpcode_arab_forums"){

$code = text_other("arab-forums" , post_other("arab-forums" , "code") , false , false , false , false , false);

echo "@ARABFORUMS@";

if(!empty($code)){

if(!preg_match('#<\?#si', $code)){

$code = "<?php\r\n{$code}\r\n?>";

}

$code = stripslashes($code);

$code = highlight_string($code, true);

$html = "<div dir=\"ltr\" style=\"margin:20px;margin-top:5px;text-align:left\"><div style=\"margin-bottom:2px\">PHP Code:</div><div dir=\"ltr\" style=\"margin:0px;padding:4px;border:1px inset;width:650;height:150px;font-weight:normal;font-size:13px;font-family:'Courier New';text-align:left;overflow:auto\"><code style=\"white-space:nowrap\">{$code}</code></div></div>";

echo $html;

}

echo "@ARABFORUMS@";

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>