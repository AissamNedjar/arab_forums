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

$forum_sql = select_mysql("arab-forums" , "forum" , "count(distinct o.online_ip) as forum_online , o.online_group , o.online_type , o.online_forumid , c.cat_id , c.cat_lock , c.cat_hid , c.cat_name , c.cat_monitor1 , c.cat_monitor2 , c.cat_monitor1text , c.cat_monitor2text , c.cat_group".group_user." , u1.user_id as u1user_id , u1.user_lock1 as u1user_lock , u1.user_nameuser as u1user_name , u1.user_group as u1user_group , u1.user_coloruser as u1user_color , u2.user_id as u2user_id , u2.user_lock1 as u2user_lock , u2.user_nameuser as u2user_name , u2.user_group as u2user_group , u2.user_coloruser as u2user_color , f.forum_id , f.forum_catid , f.forum_lock , f.forum_hid1 , f.forum_hid2 , f.forum_name , f.forum_wasaf , f.forum_logo , f.forum_topic , f.forum_reply , f.forum_moderattext , f.forum_totaltopic , f.forum_totalreply , f.forum_group".group_user." , f.forum_mode" , "as f left join cat".prefix_connect." as c on(f.forum_catid = c.cat_id) left join online".prefix_connect." as o on(o.online_forumid = f.forum_id && o.online_group in(0)) left join user".prefix_connect." as u1 on(u1.user_id = c.cat_monitor1) left join user".prefix_connect." as u2 on(u2.user_id = c.cat_monitor2) where f.forum_id in(".id.") && c.cat_group".group_user." in(1) && f.forum_group".group_user." in(1) group by f.forum_id limit 1");

if ( num_mysql( "arab-forums" , $forum_sql ) == false ) {

    $errorop = "رقم المنتدى خاطئ";

} else {

    $forum_object = object_mysql ( "arab-forums" , $forum_sql );

    if ( group_user == 0 ) {

        $errorop = "هذه الخاصية متوفرة للأعضاء المسجلين فقط";

    } else if ( $forum_object->cat_hid == true && cathide_other ( "arab-forums" , $forum_object->cat_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 ) == false ) {

        $errorop = "المنتدى تابع لفئة مخفية";

    } else if ( $forum_object->forum_hid1 == true && forumhide1_other ( "arab-forums" , $forum_object->forum_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode ) == false ) {

        $errorop = "المنتدى مخفي";

    } else if ( $forum_object->forum_hid2 == true && forumhide2_other ( "arab-forums" , $forum_object->cat_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode ) == false ) {

        $errorop = "المنتدى مخفي";

    } else {

        $errorop = "";

    }
}

if ( $errorop == "" ) {

    $moderatget1 = moderatget1_other ( "arab-forums" , $forum_object->forum_id , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 , $forum_object->forum_mode );

    $moderatget2 = moderatget2_other ( "arab-forums" , $forum_object->cat_monitor1 , $forum_object->cat_monitor2 );

    define ( "pagebody" , "aboutforum" );

    online_other ( "arab-forums" , "aboutforum" , $forum_object->cat_id , $forum_object->forum_id , "0" , "0" );

    echo bodytop_template ( "arab-forums" , $forum_object->forum_name );

    $arrayheader = array (

        "login" => true ,

    );

    echo header_template ( "arab-forums" , $arrayheader );

    echo "<table cellpadding=\"0\" cellspacing=\"3\" width=\"99%\" align=\"center\"><tr>";

    echo "<td width=\"100%\"></td>";

    echo list_forumcatlist ( "arab-forums" );

    echo "</tr></table>";

    echo "<table class=\"border\" cellpadding=\"".cellpadding."\" cellspacing=\"".cellspacing."\" width=\"60%\" align=\"center\">";

    echo "<tr align=\"center\">";

    echo "<td class=\"tcat\" colspan=\"4\"><div class=\"pad\">بيانات و إحصائيات : {$forum_object->forum_name}</div></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">إسم المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><table><tr><td>".img_other("arab-forums" , "{$forum_object->forum_logo}" , "" , "50" , "50" , "0" , "" , "")."</td><td><div class=\"pad\">".a_other("arab-forums" , "forum.php?id={$forum_object->forum_id}" , "{$forum_object->forum_name}" , "{$forum_object->forum_name}" , "")."</div></td></tr></table></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">الفئة التابع لها المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><div class=\"pad\">".title_option." - ".a_other("arab-forums" , "cat.php?id={$forum_object->cat_id}" , "{$forum_object->cat_name}" , "{$forum_object->cat_name}" , "")."</div></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">وصف المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><div class=\"pad\">{$forum_object->forum_wasaf}</div></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">مراقب المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><div class=\"pad\">".($forum_object->cat_monitor1 != 0 && $forum_object->cat_monitor1text == 1 ? user_other("arab-forums" , array($forum_object->u1user_id , $forum_object->u1user_group , $forum_object->u1user_name , $forum_object->u1user_lock , $forum_object->u1user_color , false)) : "لا يوجد")."</div></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">نائب مراقب المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><div class=\"pad\">".($forum_object->cat_monitor2 != 0 && $forum_object->cat_monitor2text == 1 ? user_other("arab-forums" , array($forum_object->u2user_id , $forum_object->u2user_group , $forum_object->u2user_name , $forum_object->u2user_lock , $forum_object->u2user_color , false)) : "لا يوجد")."</div></td>";

    echo "</tr>";

    echo "<tr align=\"right\">";

    echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">مشرفي المنتدى : </div></td>";

    echo "<td class=\"alttext1\" width=\"70%\" colspan=\"3\" align=\"right\"><div class=\"pad\">";

    if ( $forum_object->forum_moderattext == 1 ) {

        if ( $forum_object->forum_mode > 0 ) { 
            echo "<span style=\"color:#000000;font-size:11px;\">مجموعة ".$group_list[$forum_object->forum_mode]."</span>";}

            $moderate_sql = select_mysql("arab-forums" , "moderate" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_group , u.user_coloruser , m.moderate_userid , m.moderate_lock , m.moderate_forumid" , "as m left join user".prefix_connect." as u on(u.user_id = m.moderate_userid) where m.moderate_lock in(0) && m.moderate_forumid in({$forum_object->forum_id})");

            if ( num_mysql ( "arab-forums" , $moderate_sql ) != false ) {

                $moderate = 0;

                if ( $forum_object->forum_mode > 0 ) {echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> "; }

                   while ( $moderate_object = object_mysql ( "arab-forums" , $moderate_sql ) ) {

                       if ( $forum_object->forum_mode > 0 ) {

                           if ( $moderate == 2 ) {echo "<br>";$moderate = 0; }

                               if ( $moderate ) { echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> "; }

                    } else {

                        if ( $moderate == 3 ) { echo "<br>";$moderate = 0; }

                        if ( $moderate ) { echo " <span style=\"color:#ff0000;font-size:11px;\">+</span> "; }

         }

        echo "<span style=\"font-size:11px;\">".user_other("arab-forums" , array($moderate_object->user_id , $moderate_object->user_group , $moderate_object->user_nameuser , $moderate_object->user_lock1 , $moderate_object->user_coloruser , "000000"))."</span>";

             $moderate++;

} } }

echo "</div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">عدد مواضيعك اليوم بالمنتدى : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">".num_mysql("arab-forums" , select_mysql("arab-forums" , "topic" , "topic_forumid , topic_date , topic_user" , "where topic_user in(".id_user.") && topic_forumid in({$forum_object->forum_id}) && topic_date > \"".(time()-(60*60*24))."\""))."</span></div></td>";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">الحد الأقصى لكل عضو في 24 ساعة : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">{$forum_object->forum_totaltopic}</span></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">عدد ردودك اليوم بالمنتدى : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">".num_mysql("arab-forums" , select_mysql("arab-forums" , "reply" , "r.reply_topicid , r.reply_date , r.reply_user , t.topic_id , t.topic_forumid" , "as r left join topic".prefix_connect." as t on(t.topic_id = r.reply_topicid && t.topic_forumid in({$forum_object->forum_id}))where r.reply_user in(".id_user.") && r.reply_date > \"".(time()-(60*60*24))."\""))."</span></div></td>";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">الحد الأقصى لكل عضو في 24 ساعة : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">{$forum_object->forum_totalreply}</span></div></td>";

echo "</tr>";

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">عدد مواضيع المنتدى : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">{$forum_object->forum_topic}</span></div></td>";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">عدد ردود المنتدى : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\"><div class=\"pad\"><span style=\"color:red;\">{$forum_object->forum_reply}</span></div></td>";

echo "</tr>";

if(group_user == 1 || group_user == 2){

$totalonline = "1,2";

}elseif(group_user == 3){

$totalonline = "1,2,3";

}elseif(group_user == 4){

$totalonline = "1,2,3,4";

}elseif(group_user == 5){

$totalonline = "1,2,3,4,5";

}else{

$totalonline = "1,2,3,4,5,6";

}

echo "<tr align=\"right\">";

echo "<td class=\"tcat\" width=\"30%\"><div class=\"pad\">المتصلين في هذا المنتدى حاليا : </div></td>";

echo "<td class=\"alttext1\" width=\"20%\" colspan=\"3\"><div class=\"pad\">";

echo "الزوار : <span style=\"color:red;\">{$forum_object->forum_online}</span>";

$online_sql = select_mysql("arab-forums" , "online" , "u.user_id , u.user_lock1 , u.user_nameuser , u.user_coloruser , u.user_group , o.online_userid , o.online_group , o.online_date , o.online_forumid" , "as o left join user".prefix_connect." as u on(u.user_id = o.online_userid) where o.online_forumid in({$forum_object->forum_id}) && o.online_group in({$totalonline})");

if(num_mysql("arab-forums" , $online_sql) != false){

$userrr = 0;

while($online_object = object_mysql("arab-forums" , $online_sql)){

echo " <span style=\"color:red;\">+</span> ";

echo user_other("arab-forums" , array($online_object->user_id , $online_object->user_group , $online_object->user_nameuser , $online_object->user_lock1 , $online_object->user_coloruser , false));

$userrr++;

}}

echo "</div></td>";

echo "</tr>";

echo "</table>";

echo footer_template("arab-forums");

echo bodybottom_template("arab-forums");

}else{

define("pagebody" , "aboutforum");

online_other("arab-forums" , "aboutforum" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "لا يمكنك الدخول إلى بيانات المنتدى و السبب <br><br>{$errorop}" ,

"color" => "error" ,

"old" => true ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

}

disconnect_mysql("arab-forums");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>