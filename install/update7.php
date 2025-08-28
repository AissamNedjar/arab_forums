<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$page = (page > 0 ? page : 1);
   
$limit = (($page * 1500) - 1500);

function page1_forum($id , $table , $all , $url1){global $page;

$page=($page == 0 ? 1 : $page);$sql=@mysql_query("select ".$id." from ".$table."");$count=@mysql_num_rows($sql);$paging=ceil($count/$all);$paging=($paging == 0 ? 1 : $paging);if($page > $paging){$page = 1;}if($paging > 0){if($page > 1){$first = '<td class="thead"><nobr><a href="'.$url1.'1">البداية</a></nobr></td>';$prev= '<td class="thead"><nobr><a href="'.$url1.''.($page-1).'">السابق</a></nobr></td>';}else{$first = '';$prev= '';}$check = '<table width="100%" cellpadding="0" cellspacing="1" align="center"><tr><td width="100%"></td><td><table class="tborder" cellpadding="10" cellspacing="2" width="100%" align="center"><tr align="center"><td class="tcat"><nobr>الصفحة '.$page.' من '.$paging.'</nobr></td>'.$first.$prev.'';if($page > 1){$equal = $page-($page == 2 ? 1 : 2);for($x = $equal; $x < $page; $x++){$check .= '<td class="thead"><nobr><a href="'.$url1.''.$x.'">'.$x.'</a></nobr></td>';}}$check .= '<td class="tcat"><nobr>'.$page.'</nobr></td>';if($page < $paging){$equal = $page + ($page == ($paging - 1) ? 1 : 2);for($x = $page + 1 ;$x <= $equal ; $x++){$check .= '<td class="thead"><nobr><a href="'.$url1.''.$x.'">'.$x.'</a></nobr></td>';}$next ='<td class="thead"><nobr><a href="'.$url1.''.($page+1).'">التالي</a></nobr></td>';$last ='<td class="thead"><nobr><a href="'.$url1.''.$paging.'">الأخيرة</a></nobr></td>';}else{$next='';$last='';}$check .= ''.$next.$last.'</tr></table></td></tr></table>';}
		
return $check;

}

echo page1_forum('*' , "".$connect["prefix"]."topic" , 1500 , 'install.php?go=updatec0lddz&type=updatetable5&page=');

$sql  =  @mysql_query("select * from ".$connect["prefix"]."topic limit ".$limit." , 1500");

while($array  =  @mysql_fetch_assoc($sql)){

$message = text_other("arab-forums" , $array[topic_message] , false , true , false , false , true);

$title = text_other("arab-forums" , $array[topic_name] , true , true , true , false , true);

if($array[topic_last_d] == ""){

$array[topic_last_d] = "null";

}else{

$array[topic_last_d] = "\"".$array[topic_last_d]."\"";

}

if($array[topic_last_u] == ""){

$array[topic_last_u] = "null";

}else{

$array[topic_last_u] = "\"".$array[topic_last_u]."\"";

}

insert_mysql("arab-forums" , "topic" , "topic_id , topic_forumid , topic_lock , topic_delete , topic_hid , topic_stiky , topic_top , topic_link , topic_linkorder , topic_icons , topic_text , topic_reply , topic_visit , topic_date , topic_user , topic_lastdate , topic_lastuser , topic_name , topic_message" , "\"".$array[topic_id]."\" , \"".$array[topic_forum_id]."\" , \"".$array[topic_lock]."\" , \"".$array[topic_delete]."\" , \"".$array[topic_hid]."\" , \"".$array[topic_stiky]."\" , \"".$array[topic_top]."\" , \"".$array[topic_link]."\" , \"".$array[topic_linkorder]."\" , \"".$array[topic_icons]."\" , \"".$array[topic_text]."\" , \"".$array[topic_reply]."\" , \"".$array[topic_chouf]."\" , \"".$array[topic_date]."\" , \"".$array[topic_user]."\" , ".$array[topic_last_d]." , ".$array[topic_last_u]." , \"".$title."\" , \"".$message."\"");

}

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال المواضيع بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable6\" method=\"post\">";

echo "<td class=\"tcat\"><nobr><input class=\"button\" value=\"الإنتقال إلى الخطوة التالية\" type=\"submit\"></nobr></td>";

echo "</form>";

echo "</tr>";

echo "</table>";

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>