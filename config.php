<!-- <?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */


// font-family: proxima-nova,ProximaNova,noto,GESS,GE-SS,sans-serif;

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'motarey_db1.sql');
/* Attempt to connect to MySQL database */
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?> -->