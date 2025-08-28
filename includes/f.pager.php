<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function page_pager($copi , $table , $id , $where , $max , $page , $url){

if($copi == "arab-forums"){

$page_sql = select_mysql("arab-forums" , $table , $id , $where);

$page_num = num_mysql("arab-forums" , $page_sql);

$page_ceil = ceil($page_num / $max);

$page_ceil = ($page_ceil == 0 ? 1 : $page_ceil);

$textpage = "";

$textpage .= "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">الصفحة</span><div class=\"pad\"><select class=\"inputselect\" onchange=\"getst(this)\">";

for($i = 1; $i <= $page_ceil; $i++){

$textpage .= "<option value=\"{$url}page={$i}\" ".($page == $i ? "selected" : "").">{$i} من {$page_ceil}</option>";

}

$textpage .= "</select></div></td>";

return $textpage;

}}

function reply_pager($copi , $numpage , $topicid , $reply){

if($copi == "arab-forums"){

$colsreply = ceil($reply / $numpage);

$colsreply = ($colsreply > 0 ? $colsreply : 1);

if($colsreply > 1){

$getreply  = "";

$getreply .= "<table><tr><td>".img_other("arab-forums" , "images/page.gif" , "موضوع متعدد الصفحات" , "" , "" , "0" , "class=\"title\"" , "")."</td>";

for($xreply = 1; $xreply <= $colsreply; $xreply++){

if($xreply == 18){

$getreply .= "<td>..</td><td>".a_other("arab-forums" , "topic.php?id={$topicid}&page={$colsreply}" , "الصفحة : {$colsreply}" , "{$colsreply}" , "style=\"font-size:10px;color:red\"")."</td>";

break;

}

$getreply .= "<td>".a_other("arab-forums" , "topic.php?id={$topicid}&page={$xreply}" , "الصفحة : {$xreply}" , "{$xreply}" , "style=\"font-size:10px;color:gray\"")."</td>";

}

$getreply .= "</tr></table>";

}else{

$getreply  = "";

}

return $getreply;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>