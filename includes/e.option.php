<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$option_sql = select_mysql("arab-forums" , "option" , "option_name , option_value" , "");

if(num_mysql("arab-forums" , $option_sql) != false){

while($option_object = object_mysql("arab-forums" , $option_sql)){

define($option_object->option_name."_option" , $option_object->option_value);

}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>