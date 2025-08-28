<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: error.php"));}

@include("includes/f.hacker.php");

@include("includes/f.mysql.php");

@include("includes/f.other.php");

@include("includes/f.otherto.php");

@include("includes/f.date.php");

@include("includes/f.forumcatlist.php");

@include("includes/f.pager.php");

@include("includes/f.cookie.php");

echo post_hacker("arab-forums");

echo xss_hacker("arab-forums");

echo sql_hacker("arab-forums");

echo url_hacker("arab-forums");

echo cracker_hacker("arab-forums");

@include("includes/e.connect.php");

connect_mysql("arab-forums" , hostname_connect , username_connect , userpass_connect , dbname_connect);

@include("includes/e.option.php");

@include("includes/f.datetype.php");

@include("includes/e.get.php");

@include("includes/e.user.php");

@include("includes/e.default.php");

@include("includes/e.cookie.php");

@include("includes/e.list.php");

@include("inccrack.php");

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>