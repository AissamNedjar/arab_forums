<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

define("method" , server_other("arab-forums" , "REQUEST_METHOD"));

define("referer" , server_other("arab-forums" , "HTTP_REFERER"));

define("self" , server_other("arab-forums" , "REQUEST_URI"));

define("ref" , get_other("arab-forums" , "ref"));

define("id" , sqlolll_other("arab-forums" , get_other("arab-forums" , "id")));

define("go" , get_other("arab-forums" , "go"));

define("type" , get_other("arab-forums" , "type"));

define("value" , get_other("arab-forums" , "value"));

define("re" , get_other("arab-forums" , "re"));

define("page" , sqlolll_other("arab-forums" , get_other("arab-forums" , "page")));

define("gert" , get_other("arab-forums" , "gert"));

define("fort" , get_other("arab-forums" , "fort"));

define("editor" , get_other("arab-forums" , "editor"));

define("quote" , sqlolll_other("arab-forums" , get_other("arab-forums" , "quote")));

define("qtopic" , sqlolll_other("arab-forums" , get_other("arab-forums" , "qtopic")));

define("qreply" , sqlolll_other("arab-forums" , get_other("arab-forums" , "qreply")));

define("code" , sqlolll_other("arab-forums" , get_other("arab-forums" , "code")));

define("msgf" , get_other("arab-forums" , "msgf"));

define("msgu" , get_other("arab-forums" , "msgu"));

define("admin" , get_other("arab-forums" , "admin"));

define("folder" , sqlolll_other("arab-forums" , get_other("arab-forums" , "folder")));

define("sendmy" , sqlolll_other("arab-forums" , get_other("arab-forums" , "sendmy")));

define("sendto" , sqlolll_other("arab-forums" , get_other("arab-forums" , "sendto")));

define("search" , get_other("arab-forums" , "search"));

define("user" , sqlolll_other("arab-forums" , get_other("arab-forums" , "user")));

define("plase" , sqlolll_other("arab-forums" , get_other("arab-forums" , "plase")));

define("orp" , get_other("arab-forums" , "orp"));

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>