<?php
/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/

if(!defined("error_page_arab_forums")){exit(header("location: ../error.php"));}

$mysqli = null;

function connect_mysql($copi, $hostname, $username, $userpass, $dbname)
{
    global $mysqli;

    if ($copi == "arab-forums") {
        $mysqli = @new mysqli($hostname, $username, $userpass, $dbname);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    }
}

function disconnect_mysql($copi)
{
    global $mysqli;

    if ($copi == "arab-forums" && $mysqli) {
        $mysqli->close();
        $mysqli = null;
    }
}

function mysql_mysql($copi, $query)
{
    global $mysqli;

    if ($copi == "arab-forums" && $mysqli) {
        $result = @$mysqli->query($query);
        if (!$result) {
            die("Query error: " . $mysqli->error);
        }
        return $result;
    }
    return false;
}

function select_mysql($copi, $tablename, $select, $where = "")
{
    return mysql_mysql($copi, "SELECT {$select} FROM {$tablename} " . prefix_connect . " {$where}");
}

function insert_mysql($copi, $tablename, $fields, $values)
{
    mysql_mysql($copi, "INSERT INTO {$tablename} " . prefix_connect . " ({$fields}) VALUES ({$values})");
}

function update_mysql($copi, $tablename, $set, $where = "")
{
    mysql_mysql($copi, "UPDATE {$tablename} " . prefix_connect . " SET {$set} {$where}");
}

function delete_mysql($copi, $tablename, $where)
{
    mysql_mysql($copi, "DELETE FROM {$tablename} " . prefix_connect . " WHERE {$where}");
}

function num_mysql($copi, $result)
{
    if ($copi == "arab-forums" && $result) {
        return $result->num_rows;
    }
    return 0;
}

function assoc_mysql($copi, $result)
{
    if ($copi == "arab-forums" && $result) {
        return $result->fetch_assoc();
    }
    return null;
}

function array_mysql($copi, $result)
{
    if ($copi == "arab-forums" && $result) {
        return $result->fetch_array();
    }
    return null;
}

function object_mysql($copi, $result)
{
    if ($copi == "arab-forums" && $result) {
        return $result->fetch_object();
    }
    return null;
}

/*#####################################################################*|

|  Arab Forums 0.2                                                      |

|  This Script Is Free Software                                         |

|  Programmed By : Aissam Nedjar                                        |

|  facebook : facebook.com/aissam.nedjar.43                             |

|*#####################################################################*/
?>