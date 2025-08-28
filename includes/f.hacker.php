<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

function post_hacker($copi){

if($copi == "arab-forums"){

if($_SERVER["REQUEST_METHOD"] == "POST"){

$get_1 = explode("/" , $GLOBALS["HTTP_REFERER"]);

$get_2 = explode("/" , $GLOBALS["HTTP_HOST"]);

if($get_1[2] != $get_2[0]){

exit(header("location: error.php"));

}}}}

function xss_hacker($copi){

if($copi == "arab-forums"){

foreach($_GET as $xss_get){

if((@eregi("<[^>]*script*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*object*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*iframe*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*applet*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*meta*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*style*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*form*\"?[^>]*>", $xss_get))or(@eregi("<[^>]*img*\"?[^>]*>", $xss_get))){

exit(header("location: error.php"));

}

}
   
unset($xss_get);

}}

function sql_hacker($copi){

if($copi == "arab-forums"){

foreach($_GET as $sql_get){
   
if((@eregi("select", $sql_get))or(@eregi("union", $sql_get))){

exit(header("location: error.php"));

}}

unset($sql_get);

}}

function url_hacker($copi){

if($copi == "arab-forums"){

foreach($_GET as $url){

if((@eregi("<[^>]*script*\"?[^>]*>", $url))or(@eregi("<[^>]*object*\"?[^>]*>", $url))or(@eregi("<[^>]*iframe*\"?[^>]*>", $url))or(@eregi("<[^>]*applet*\"?[^>]*>", $url))or(@eregi("<[^>]*meta*\"?[^>]*>", $url))or(@eregi("<[^>]*style*\"?[^>]*>", $url))or(@eregi("<[^>]*form*\"?[^>]*>", $url))or(@eregi("<[^>]*img*\"?[^>]*>", $url))or(@eregi("<[^>]*noscript*\"?[^>]*>", $url))or(@eregi("<[^>]*applet*\"?[^>]*>", $url))or(@eregi("<[^>]*vbscript*\"?[^>]*>", $url))or(@eregi("<[^>]*embed*\"?[^>]*>", $url))or(@eregi("<[^>]*frame*\"?[^>]*>", $url))or(@eregi("<[^>]*style*\"?[^>]*>", $url))or(@eregi("<[^>]*frameset*\"?[^>]*>", $url))or(@eregi("<[^>]*html*\"?[^>]*>", $url))or(@eregi("<[^>]*body*\"?[^>]*>", $url))or(@eregi("<[^>]*!DOCTYPE*\"?[^>]*>", $url))or(@eregi("<[^>]*form*\"?[^>]*>", $url))or(@eregi("<[^>]*link*\"?[^>]*>", $url))or(@eregi("<[^>]*title*\"?[^>]*>", $url))or(@eregi("<[^>]*bgsound*\"?[^>]*>", $url))or(@eregi("<[^>]*layer*\"?[^>]*>", $url))or(@eregi("<[^>]*XSS*\"?[^>]*>", $url))or(@eregi("<[^>]*background*\"?[^>]*>", $url))or(@eregi("<[^>]*mocha*\"?[^>]*>", $url))or(@eregi("<[^>]*livescript*\"?[^>]*>", $url))or(@eregi("\([^>]*\"?[^)]*\)", $url))or(@eregi("javascript", $url))or(@eregi("onmouseover", $url))or(@eregi("onmouseout", $url))or(@eregi("document.write", $url))or(@eregi(".txt",$url))or(@eregi(".cgi",$url))or(@eregi(".xml",$url))or(@eregi("cmd",$url))or(@eregi(".js",$url))or(@eregi("src=\"",$url))or(@eregi("\"",$url))){

exit(header("location: error.php"));

}}

unset($url);
   
}}

function cracker_hacker($copi){

if($copi == "arab-forums"){

$crack_Track = $_SERVER["QUERY_STRING"];

$ct_Rules = array('chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(','cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20','union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=','esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(','mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm','mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(','chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(','locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall','passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20','insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20','$_request', '$_get', '$request', '$get', '.system', 'HTTP_server1', '&aim', '%20getenv', 'getenv%20','new_password', '/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow','HTTP_USER_AGENT', 'HTTP_HOST', '/bin/ps', 'wget%20', 'uname\x20-a', '/usr/bin/id','/bin/print', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g\+\+', 'bin/python','bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20','/bin/mail', '.conf', 'motd%20', 'HTTP/1.', '.inc.php', 'config.php', 'cgi-', '.eml','file\://', 'window.open', '<SCRIPT>', 'javascript\://','img src', 'img%20src','.jsp','ftp.exe','xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd','servlet', '/etc/passwd', 'wwwacl', '~root', '~ftp', '.js', '.jsp', '.history','bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20','powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con','<script', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from','select from', 'drop%20', '.system', 'getenv', 'http_', '_server1', '<?php', '?>', 'sql=','_global', 'global_', 'global[', '_server', 'server_', 'server[', 'phpadmin','root_path', '_globals', 'globals_', 'globals[', 'ISO-8859-1', 'http://www.google.de/search', '?hl=','.txt', '.exe', 'union','google.de/search', 'yahoo.de', 'lycos.de', 'fireball.de', 'ISO-', 'document.cookie', 'Cscript', 'C/script' , '"' , "'");

$crack_Track = strtolower($crack_Track);

$checkworm = str_replace($ct_Rules, "*", $crack_Track);

if($crack_Track != $checkworm){

$temp = @$_SERVER["argv"];

$temp = @array_Pop($temp);

if($temp != ""){$_SERVER["PHP_SELF"] .= "?" . $temp;}

unset($temp); 

unset($crack_Track , $ct_rules , $checkworm);

exit(header("location: error.php"));

}}}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>