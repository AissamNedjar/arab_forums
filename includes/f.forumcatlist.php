<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function list_forumcatlist($copi){

if($copi == "arab-forums"){

$textlist .= "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">إذهب إلى منتدى</span><div class=\"pad\"><select style=\"width:180px\" class=\"inputselect\" onchange=\"getst(this)\">";

$textlist .= "<option value=\"\">إختر منتدى من القائمة</option>";

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_hid , cat_name , cat_order , cat_monitor1 , cat_monitor2 , cat_group".group_user."" , "where cat_group".group_user." in(1) order by cat_order asc");

if(num_mysql("arab-forums" , $cat_sql) != false){

while($cat_object = object_mysql("arab-forums" , $cat_sql)){

if($cat_object->cat_hid == false || ($cat_object->cat_hid == true && cathide_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2) == true)){

$textlist .= "<optgroup class=\"optgroup\" label=\"{$cat_object->cat_name}\"></optgroup>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_catid , forum_hid1 , forum_hid2 , forum_name , forum_order , forum_group".group_user." , forum_mode" , "where forum_catid in({$cat_object->cat_id}) && forum_group".group_user." in(1) order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

if($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums" , $forum_object->forum_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

if($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

$textlist .= "<option value=\"forum.php?id={$forum_object->forum_id}\">{$forum_object->forum_name}</option>";

}}}}}}}

$textlist .= "</select></div></td>";

return $textlist;

}}

function list2_forumcatlist($copi , $ids){

if($copi == "arab-forums"){

$textlist .= "<select class=\"inputselect\" name=\"forumsget\">";

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_hid , cat_name , cat_order , cat_monitor1 , cat_monitor2 , cat_group".group_user."" , "where cat_group".group_user." in(1) order by cat_order asc");

if(num_mysql("arab-forums" , $cat_sql) != false){

while($cat_object = object_mysql("arab-forums" , $cat_sql)){

if($cat_object->cat_hid == false || ($cat_object->cat_hid == true && cathide_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2) == true)){

$textlist .= "<optgroup class=\"optgroup\" label=\"{$cat_object->cat_name}\"></optgroup>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_catid , forum_hid1 , forum_hid2 , forum_name , forum_order , forum_group".group_user." , forum_mode" , "where forum_catid in({$cat_object->cat_id}) && forum_group".group_user." in(1) order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

if($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums" , $forum_object->forum_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

if($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

$textlist .= "<option value=\"{$forum_object->forum_id}\" ".($ids == "" ? "" : ($ids == $forum_object->forum_id ? "selected" : "")).">{$forum_object->forum_name}</option>";

}}}}}}}

$textlist .= "</select>";

return $textlist;

}}

function one_forumcatlist($copi , $ids , $url , $url2){

if($copi == "arab-forums"){

$textlist .= "<td class=\"menu\"><span style=\"color:black;font-size:12px;\">عرض المشاركات في</span><div class=\"pad\"><select style=\"width:180px\" class=\"inputselect\" onchange=\"getst(this)\">";

$textlist .= "<option value=\"{$url2}\">جميع المنتديات</option>";

$cat_sql = select_mysql("arab-forums" , "cat" , "cat_id , cat_hid, cat_name , cat_order , cat_monitor1 , cat_monitor2 , cat_group".group_user."" , "where cat_group".group_user." in(1) order by cat_order asc");

if(num_mysql("arab-forums" , $cat_sql) != false){

while($cat_object = object_mysql("arab-forums" , $cat_sql)){

if($cat_object->cat_hid == false || ($cat_object->cat_hid == true && cathide_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2) == true)){

$textlist .= "<optgroup class=\"optgroup\" label=\"{$cat_object->cat_name}\"></optgroup>";

$forum_sql = select_mysql("arab-forums" , "forum" , "forum_id , forum_catid , forum_hid1 , forum_hid2 , forum_name , forum_order , forum_group".group_user." , forum_mode" , "where forum_catid in({$cat_object->cat_id}) && forum_group".group_user." in(1) order by forum_order asc");

if(num_mysql("arab-forums" , $forum_sql) != false){

while($forum_object = object_mysql("arab-forums" , $forum_sql)){

if($forum_object->forum_hid1 == false || ($forum_object->forum_hid1 == true && forumhide1_other("arab-forums" , $forum_object->forum_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

if($forum_object->forum_hid2 == false || ($forum_object->forum_hid2 == true && forumhide2_other("arab-forums" , $cat_object->cat_id , $cat_object->cat_monitor1 , $cat_object->cat_monitor2 , $forum_object->forum_mode) == true)){

$textlist .= "<option value=\"{$url}value={$forum_object->forum_id}\" ".($ids == "" ? "" : ($ids == $forum_object->forum_id ? "selected" : "")).">{$forum_object->forum_name}</option>";

}}}}}}}

$textlist .= "</select>";

return $textlist;

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>