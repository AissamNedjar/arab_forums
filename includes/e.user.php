<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

define("username" , text_other("arab-forums" , get_cookie("arab-forums" , "username") , true , true , true , true , true));

define("userpass" , text_other("arab-forums" , get_cookie("arab-forums" , "userpass") , true , true , true , true , true));

$user_sql = select_mysql("arab-forums" , "user" , "user_id , user_lock1 , user_lock2 , user_wait , user_active , user_bad , user_namelogin , user_nameuser , user_pass , user_group , user_style , user_time , user_post , user_sex , user_days , user_month , user_years , user_country , user_city , user_state , user_hala , user_editorcolor , user_editoralign , user_editorblod , user_editorfont , user_editorsize , user_point , user_datelastpost" , "where user_lock1 in(0) && user_wait in(0) && user_active in(0) && user_bad in(0) && user_namelogin = \"".username."\" && user_pass = \"".userpass."\" limit 1");

if(num_mysql("arab-forums" , $user_sql) != false){

$user_object = object_mysql("arab-forums" , $user_sql);

print_r($user_object);

define("id_user" , $user_object->user_id);

define("lock2_user" , $user_object->user_lock2);

define("name_user" , $user_object->user_nameuser);

define("group_user" , $user_object->user_group);

define("style_user" , $user_object->user_style1);

define("time_user" , $user_object->user_time);

define("post_user" , $user_object->user_post);

define("point_user" , $user_object->user_point);

define("sex_user" , $user_object->user_sex);

define("days_user" , $user_object->user_days);

define("month_user" , $user_object->user_month);

define("years_user" , $user_object->user_years);

define("country_user" , $user_object->user_country);

define("city_user" , $user_object->user_city);

define("state_user" , $user_object->user_state);

define("hala_user" , $user_object->user_hala);

define("editorcolor_user" , $user_object->user_editorcolor);

define("editoralign_user" , $user_object->user_editoralign);

define("editorblod_user" , $user_object->user_editorblod);

define("editorfont_user" , $user_object->user_editorfont);

define("editorsize_user" , $user_object->user_editorsize);

define("datelastpost_user" , $user_object->user_datelastpost);

update_mysql("arab-forums" , "user" , "user_datelastvisite = \"".time()."\" , user_lastadressip = \"".ip_other("arab-forums")."\" where user_id = \"".id_user."\"");

}else{

define("id_user" , 0);

define("group_user" , 0);

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>