<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$page = (page > 0 ? page : 1);
   
$limit = (($page * 5000) - 5000);

function page1_forum($id , $table , $all , $url1){

global $page;

$page=($page == 0 ? 1 : $page);$sql=@mysql_query("select ".$id." from ".$table."");$count=@mysql_num_rows($sql);$paging=ceil($count/$all);$paging=($paging == 0 ? 1 : $paging);if($page > $paging){$page = 1;}if($paging > 0){if($page > 1){$first = '<td class="thead"><nobr><a href="'.$url1.'1">البداية</a></nobr></td>';$prev= '<td class="thead"><nobr><a href="'.$url1.''.($page-1).'">السابق</a></nobr></td>';}else{$first = '';$prev= '';}$check = '<table width="100%" cellpadding="0" cellspacing="1" align="center"><tr><td width="100%"></td><td><table class="tborder" cellpadding="10" cellspacing="2" width="100%" align="center"><tr align="center"><td class="tcat"><nobr>الصفحة '.$page.' من '.$paging.'</nobr></td>'.$first.$prev.'';if($page > 1){$equal = $page-($page == 2 ? 1 : 2);for($x = $equal; $x < $page; $x++){$check .= '<td class="thead"><nobr><a href="'.$url1.''.$x.'">'.$x.'</a></nobr></td>';}}$check .= '<td class="tcat"><nobr>'.$page.'</nobr></td>';if($page < $paging){$equal = $page + ($page == ($paging - 1) ? 1 : 2);for($x = $page + 1 ;$x <= $equal ; $x++){$check .= '<td class="thead"><nobr><a href="'.$url1.''.$x.'">'.$x.'</a></nobr></td>';}$next ='<td class="thead"><nobr><a href="'.$url1.''.($page+1).'">التالي</a></nobr></td>';$last ='<td class="thead"><nobr><a href="'.$url1.''.$paging.'">الأخيرة</a></nobr></td>';}else{$next='';$last='';}$check .= ''.$next.$last.'</tr></table></td></tr></table>';}
		
return $check;

}

echo page1_forum('*' , "".$connect["prefix"]."reply" , 5000 , 'install.php?go=updatec0lddz&type=updatetable6&page=');

$sql  =  @mysql_query("select * from ".$connect["prefix"]."reply limit ".$limit." , 5000");

while($array  =  @mysql_fetch_assoc($sql)){

$message = text_other("arab-forums" , $array[reply_message] , false , true , false , false , true);

insert_mysql("arab-forums" , "reply" , "reply_id , reply_topicid , reply_delete , reply_hid , reply_date , reply_user , reply_message" , "\"".$array[reply_id]."\" , \"".$array[reply_topic_id]."\" , \"".$array[reply_delete]."\" , \"".$array[reply_hid]."\" , \"".$array[reply_date]."\" , \"".$array[reply_user]."\" , \"".$message."\"");

}

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال الردود بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable7\" method=\"post\">";

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