<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$sql  =  @mysql_query("select * from ".$connect["prefix"]."user");

while($array  =  @mysql_fetch_assoc($sql)){

$codeyserr = md5(code_other("arab-forums" , 10));

$topics = @mysql_num_rows(@mysql_query("select * from ".$connect["prefix"]."topic where topic_user = '".$array[user_id]."' && topic_delete = '0'"));

$posts = @mysql_num_rows(@mysql_query("select * from ".$connect["prefix"]."reply where reply_user = '".$array[user_id]."' && reply_delete = '0'"));

$sayra = text_other("arab-forums" , $array[user_bio] , true , false , true , false , true);

$sig = text_other("arab-forums" , $array[user_sig] , false , true , false , false , true);

if($array[user_date2] == ""){

$date2 = "null";

}else{

$date2 = "\"".$array[user_date2]."\"";

}

if($array[user_date3] == ""){

$date3 = "null";

}else{

$date3 = "\"".$array[user_date3]."\"";

}

insert_mysql("arab-forums" , "user" , "user_id , user_lock1 , user_namelogin , user_nameuser , user_pass , user_email , user_coderegister , user_group , user_post , user_topics , user_posts , user_point , user_dateregister , user_datelastvisite , user_datelastpost , user_adressip , user_lastadressip , user_photo , user_jobe , user_sex , user_bio , user_sig" , "\"".$array[user_id]."\" , \"".$array[user_lock]."\" , \"".$array[user_name1]."\" , \"".$array[user_name2]."\" , \"".$array[user_pass]."\" , \"".$array[user_email]."\" , \"".$codeyserr."\" , \"".$array[user_group]."\" , \"".$array[user_post]."\" , \"".$topics."\" , \"".$posts."\" , \"".$array[user_point1]."\" , \"".$array[user_date1]."\" , {$date2} , {$date3} , \"".$array[user_adress_ip]."\" , \"".$array[user_last_ip]."\" , \"".$array[user_photo]."\" , \"".$array[user_jobe]."\" , \"".$array[user_sex]."\" , \"".$sayra."\" , \"".$sig."\"");

}

echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"60%\" align=\"center\">";

echo "<tr align=\"center\">";

echo "<td class=\"alttext1\"><nobr><br>تم إدخال الأعضاء بنجآح تام<br><br></nobr></td>";

echo "</tr>";

echo "<tr align=\"center\">";

echo "<form action=\"install.php?go=updatec0lddz&type=updatetable2\" method=\"post\">";

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