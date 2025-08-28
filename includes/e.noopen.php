<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

if(closeoff_option == 1 && group_user != 6){

online_other("arab-forums" , "home" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "".img_other("arab-forums" , "images/close.png" , "" , "" , "" , "0" , "" , "")."<br><br>".br_other("arab-forums" , closemsg_option)."" ,

"color" => "error" ,

"old" => false ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

disconnect_mysql("arab-forums");

exit();

}

if(pageupdate == true && group_user > 0){

if(sex_user == 0 || days_user == "" || month_user == "" || years_user == "" || hala_user == "" || country_user == "" || city_user == "" || state_user == ""){

online_other("arab-forums" , "home" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "أهلا و سهلا بك يا ".name_user."<br><br>للأسف هناك بيانات تخصك تحتاج للتعديل فالرجاء منك التوجه إلى صفحة بيانتك و ملأ جميع الحقول في البيانات الشخصية و الجنس و تاريخ الإزدياد" ,

"color" => "error" ,

"old" => false ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

disconnect_mysql("arab-forums");

exit();

}}

if(defined("lock2_user") && lock2_user == 1){

online_other("arab-forums" , "home" , "0" , "0" , "0" , "0");

$arraymsg = array(

"login" => true ,

"msg" => "أهلا و سهلا بك يا ".name_user."<br><br>لقد تم تجميد عضويتك بواسطة الإدارة و لا يمكنك عمل شيء بها<br><br>يمكنك التسجيل بعضوية أخرى و مراسلة الإدارة ليتم إرسال لك سبب التجميد و الملاحظآت الأخرى" ,

"color" => "error" ,

"old" => false ,

"auto" => false ,

"text" => "" ,

"url" => "" ,

"array" => "" ,

);

echo msg_template("arab-forums" , $arraymsg);

disconnect_mysql("arab-forums");

exit();

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>