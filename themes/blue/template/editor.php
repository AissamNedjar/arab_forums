<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../../../error.php"));}

function editor_template($copi , $array){

if($copi == "arab-forums"){

$editor_array = array("newtopic" , "edittopic" , "sendmsg" , "replymsg");

$template  = "";

$template .= "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\">";

$template .= "<tr>";

$template .= "<td>{$array["img"]}</td>";

$template .= "<td width=\"100%\">{$array["opr"]}</td>";

if($array["other"] != ""){

$template .= "<td class=\"menu\"><nobr><span style=\"color:black;font-size:11px;\">{$array["other"]}</span></nobr></td>";

}

if($array["forum"] == true){

$template .= list_forumcatlist("arab-forums");

}

$template .= "</tr>";

if($array["trother"] != ""){

$template .= "<tr>";

$template .= "<td colspan=\"3\">{$array["trother"]}</td>";

$template .= "</tr><tr></tr><tr></tr><tr></tr>";

}

$template .= "</table>";

$template .= "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\">";

$template .= "<tr align=\"center\">";

$template .= "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">{$array["text"]}</div></td>";

$template .= "</tr>";

$template .= "<form method=\"post\" action=\"{$array["url"]}editor=true\" id=\"editorFrm\" name=\"editorFrm\">";

if(in_array($array["type"] , $editor_array)){

$template .= "<tr>";

$template .= "<td class=\"tcat\" width=\"10%\"><div class=\"pad\"><nobr>العنوان : </nobr></div></td>";

$template .= "<td class=\"alttext2\"><div class=\"pad\"><input style=\"width:600px\" class=\"input\" name=\"title\" value=\"{$array["title"]}\" type=\"text\"></div></td>";

$template .= "</tr>";

}

if($array["mode"] == true && $array["appc"] == 1){

$template .= "<tr>";

$template .= "<td class=\"tcat\" width=\"10%\"><div class=\"pad\"><nobr>خيارات الموضوع : </nobr></div></td>";

$template .= "<td class=\"alttext2\"><div class=\"pad\">";

$template .= "<select class=\"inputselect\" name=\"lock\">";

$template .= "<option value=\"0\" ".($array["mose"]["0"] == 0 ? "selected" : "").">الموضوع مفتوح</option>";

$template .= "<option value=\"1\" ".($array["mose"]["0"] == 1 ? "selected" : "").">الموضوع مغلوق</option>";

$template .= "</select>&nbsp;&nbsp;";

$template .= "<select class=\"inputselect\" name=\"hid\">";

$template .= "<option value=\"0\" ".($array["mose"]["1"] == 0 ? "selected" : "").">الموضوع ظاهر</option>";

$template .= "<option value=\"1\" ".($array["mose"]["1"] == 1 ? "selected" : "").">الموضوع مخفي</option>";

$template .= "</select>&nbsp;&nbsp;";

$template .= "<select class=\"inputselect\" name=\"stiky\">";

$template .= "<option value=\"0\" ".($array["mose"]["2"] == 0 ? "selected" : "").">الموضوع غير مثبث</option>";

$template .= "<option value=\"1\" ".($array["mose"]["2"] == 1 ? "selected" : "").">الموضوع مثبث</option>";

$template .= "</select>&nbsp;&nbsp;";

$template .= "<select class=\"inputselect\" name=\"top\">";

$template .= "<option value=\"0\" ".($array["mose"]["3"] == 0 ? "selected" : "").">الموضوع غير متميز</option>";

$template .= "<option value=\"1\" ".($array["mose"]["3"] == 1 ? "selected" : "").">الموضوع متميز بنجمة</option>";

$template .= "<option value=\"2\" ".($array["mose"]["3"] == 2 ? "selected" : "").">الموضوع متميز بميدالية</option>";

$template .= "</select>";

$template .= "</div></td>";

$template .= "</tr>";

}elseif($array["mode"] == true && $array["appc"] == 2){

$template .= "<tr>";

$template .= "<td class=\"tcat\" width=\"10%\"><div class=\"pad\"><nobr>إضافة الرد : </nobr></div></td>";

$template .= "<td class=\"alttext2\"><div class=\"pad\">";

$template .= "&nbsp;+&nbsp;<select class=\"inputselect\" name=\"option\">";

$template .= "<option value=\"\">-- إختر خيار من القائمة --</option>";

if($array["mose"]["0"] == 1){

$template .= "<option value=\"wait\">الموافقة على الموضوع</option>";

}

if($array["mose"]["1"] == 0){

$template .= "<option value=\"lock\">غلق الموضوع</option>";

}elseif($array["mose"]["1"] == 1){

$template .= "<option value=\"nolock\">فتح الموضوع</option>";

}

if($array["mose"]["2"] == 0){

$template .= "<option value=\"hid\">إخفاء الموضوع</option>";

}elseif($array["mose"]["2"] == 1){

$template .= "<option value=\"nohid\">إظهار الموضوع</option>";

}

if($array["mose"]["3"] == 1){

$template .= "<option value=\"nostiky\">إزالة تثبيث الموضوع</option>";

}elseif($array["mose"]["3"] == 0){

$template .= "<option value=\"stiky\">تثبيث الموضوع</option>";

}

$template .= "</select>";

$template .= "</div></td>";

$template .= "</tr>";

}

$template .= "<tr><td class=\"alttext1\" colspan=\"2\">";

$template .= "<table dir=\"ltr\" celpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\"><tr>";

$template .= "<td id=\"editorPlace\" width=\"900\" height=\"400\">";

$template .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"editor/assets/style-1.0.min.css\">";

$template .= "<script type=\"text/javascript\" src=\"editor/dm-1.0.min.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"editor/editor/editor-1.0.min.js\"></script>";

$template .= "<script type=\"text/javascript\" src=\"ajax/editor-func.js\"></script>";

$template .= "<input style=\"display:none;\" name=\"message\" id=\"message\" type=\"hidden\">";

$template .= "<textarea id=\"editorOldContent\" style=\"display:none;\">{$array["message"]}</textarea><script type=\"text/javascript\">";

$template .= "var type = '{$array["type"]}', exitPage = false, maxSize = 102400;";

$template .= "DMEditor.run({setting:{width:'100%',height:'600',previewText:'".title_option."',";

$template .= "userCSS:{textAlign:'".editoralign_user."',fontWeight:'".editorblod_user."',fontFamily:'".editorfont_user."',fontSize:'".editorsize_user."px',color:'".editorcolor_user."'}},";

$template .= "use:{editorMode:".(group_user == 6 ? 'true' : 'false')."}});";

$template .= "DMEditor.setContent($('#editorOldContent').val());";

$template .= "</script>";

$template .= "</td></tr></table></td></tr>";

if($array["admin"] == true){

$template .= "<tr align=\"center\">";

$template .= "<td class=\"tcat\" colspan=\"2\"><div class=\"pad\">المنتديات التي يضاف إليها الموضوع</div></td>";

$template .= "</tr><tr align=\"center\">";

$template .= "<td class=\"alttext1\" colspan=\"2\"><br><div class=\"pad\">";

$template .= "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"99%\" align=\"center\"><tr>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_name , forum_order" , "order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

$addtopic = 0;

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

if($addtopic == 3){$template .= "</tr><tr>";$addtopic = 0;}

$template .= "<td class=\"tcat\"><input type=\"checkbox\" name=\"check[]\" value=\"{$forum_object->forum_id}\" checked> {$forum_object->forum_name}</td>";

$addtopic++;

}}

$template .= "</tr></table>";

$template .= "</div><br></td>";

$template .= "</tr>";

}

$template .= "<tr><td class=\"alttext2\" align=\"center\" colspan=\"2\"><table><tr>";

$template .= "<td align=\"center\"><div class=\"pad\"><input class=\"button\" id=\"status\" name=\"status\" onclick=\"showTextLength(this.form);\" type=\"button\" value=\"حجم النص الحالي\"></div></td>";

$template .= "<td> -- </td>";

$template .= "<td align=\"center\"><div class=\"pad\"><input class=\"button\" onclick=\"setContent(this.form)\" value=\"إدخال النص\" type=\"button\"></div></td>";

$template .= "<td> -- </td>";

$template .= "<td align=\"center\"><div class=\"pad\"><input class=\"button\" onclick=\"chkReset('".self."')\" value=\"إرجاع النص الأصلي\" type=\"button\"></div></td>";

$template .= "</tr></table></tr></form></table>";

return $template;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>