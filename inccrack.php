<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: error.php"));}

define("copi_arab_forums" , "Copyright © ".adress_option." ".date ("Y")." All Rights Reserved<br><br>Arab Forums 0.2, Copyright ©2011 - ".date ("Y").",".a_other("arab-forums" , "http://www.facebook.com/aissam.nedjar.43" , "Script Arab Forums - Programmed By Aissam Nedjar" , "Aissam Nedjar" , "")."");

@include("themes/".forum_style."/css/style.php");

@include("themes/".forum_style."/template/body.php");

@include("themes/".forum_style."/template/header.php");

@include("themes/".forum_style."/template/footer.php");

@include("themes/".forum_style."/template/msg.php");

@include("themes/".forum_style."/template/editor.php");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>