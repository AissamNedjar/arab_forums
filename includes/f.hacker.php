<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if (!defined("error_page_arab_forums")) {
    exit(header("location: ../error.php"));
}

function post_hacker($copi)
{
    if ($copi == "arab-forums") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $get_1 = explode("/", $_SERVER["HTTP_REFERER"] ?? '');
            $get_2 = explode("/", $_SERVER["HTTP_HOST"] ?? '');
            if (!empty($get_1[2]) && $get_1[2] !== $get_2[0]) {
                header("location: error.php");
                exit;
            }
        }
    }
}

function xss_hacker($copi)
{
    if ($copi == "arab-forums") {
        foreach ($_GET as $xss_get) {
            if (
                preg_match("/<[^>]*script[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*object[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*iframe[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*applet[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*meta[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*style[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*form[^>]*>/i", $xss_get) ||
                preg_match("/<[^>]*img[^>]*>/i", $xss_get)
            ) {
                header("Location: error.php");
                exit;
            }
        }
        unset($xss_get);
    }
}

function sql_hacker($copi)
{
    if ($copi == "arab-forums") {
        foreach ($_GET as $sql_get) {
            if (
                preg_match("/select/i", $sql_get) ||
                preg_match("/union/i", $sql_get)
            ) {
                header("location: error.php");
                exit;
            }
        }
        unset($sql_get);
    }
}

function url_hacker($copi)
{
    if ($copi == "arab-forums") {
        foreach ($_GET as $url) {
            if (
                preg_match("/<[^>]*script[^>]*>/i", $url) ||
                preg_match("/<[^>]*object[^>]*>/i", $url) ||
                preg_match("/<[^>]*iframe[^>]*>/i", $url) ||
                preg_match("/<[^>]*applet[^>]*>/i", $url) ||
                preg_match("/<[^>]*meta[^>]*>/i", $url) ||
                preg_match("/<[^>]*style[^>]*>/i", $url) ||
                preg_match("/<[^>]*form[^>]*>/i", $url) ||
                preg_match("/<[^>]*img[^>]*>/i", $url) ||
                preg_match("/<[^>]*noscript[^>]*>/i", $url) ||
                preg_match("/<[^>]*vbscript[^>]*>/i", $url) ||
                preg_match("/<[^>]*embed[^>]*>/i", $url) ||
                preg_match("/<[^>]*frame[^>]*>/i", $url) ||
                preg_match("/<[^>]*frameset[^>]*>/i", $url) ||
                preg_match("/<[^>]*html[^>]*>/i", $url) ||
                preg_match("/<[^>]*body[^>]*>/i", $url) ||
                preg_match("/<[^>]*!DOCTYPE[^>]*>/i", $url) ||
                preg_match("/<[^>]*link[^>]*>/i", $url) ||
                preg_match("/<[^>]*title[^>]*>/i", $url) ||
                preg_match("/<[^>]*bgsound[^>]*>/i", $url) ||
                preg_match("/<[^>]*layer[^>]*>/i", $url) ||
                preg_match("/<[^>]*XSS[^>]*>/i", $url) ||
                preg_match("/<[^>]*background[^>]*>/i", $url) ||
                preg_match("/<[^>]*mocha[^>]*>/i", $url) ||
                preg_match("/<[^>]*livescript[^>]*>/i", $url) ||
                preg_match("/javascript/i", $url) ||
                preg_match("/onmouseover/i", $url) ||
                preg_match("/onmouseout/i", $url) ||
                preg_match("/document.write/i", $url) ||
                preg_match("/\.txt/i", $url) ||
                preg_match("/\.cgi/i", $url) ||
                preg_match("/\.xml/i", $url) ||
                preg_match("/cmd/i", $url) ||
                preg_match("/\.js/i", $url) ||
                preg_match("/src\s*=\s*\"/i", $url)
            ) {
                header("location: error.php");
                exit;
            }
        }
        unset($url);
    }
}

function cracker_hacker($copi)
{
    if ($copi == "arab-forums") {
        $crack_Track = strtolower($_SERVER["QUERY_STRING"] ?? '');
        $ct_Rules = array(
            'chr(', 'chr=', 'wget', 'cmd=', 'rush=', 'union', 'echr', 'esystem',
            'cp ', 'rm ', 'mv ', 'chmod', 'chown', 'chgrp', 'locate', 'grep', 'diff',
            'kill', 'passwd', 'telnet', 'insert into', 'select', 'fopen', 'fwrite',
            'getenv', '/etc/passwd', '/etc/shadow', 'bash_history', '<?php', '?>',
            'config.php', '.inc', '.pl', '.jsp', '.js', '.exe', 'system', 'document.cookie'
        );

        $checkworm = str_replace($ct_Rules, "*", $crack_Track);

        if ($crack_Track != $checkworm) {
            $temp = $_SERVER["argv"] ?? [];
            $temp = array_pop($temp);
            if (!empty($temp)) {
                $_SERVER["PHP_SELF"] .= "?" . $temp;
            }
            unset($temp, $crack_Track, $ct_Rules, $checkworm);
            header("location: error.php");
            exit;
        }
    }
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>