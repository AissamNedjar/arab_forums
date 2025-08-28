<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$styledefault_sql = select_mysql("arab-forums" , "style" , "style_fils , style_default , style_lock" , "where style_default in(1) && style_lock in(0) limit 1");

if(num_mysql("arab-forums" , $styledefault_sql) != false){

$styledefault_object = object_mysql("arab-forums" , $styledefault_sql);

define("styledefault_fils" , $styledefault_object->style_fils);

}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>