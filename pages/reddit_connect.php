<?php

/* This file contains the database access information.
 * This file also estables a connection to MySQL,
 * selects the database, and sets the encoding
 */

// Set the database access information as constants
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1'); // 127.0.0.1 has faster TTFB than localhost making the page seem like it updates almost instantaneously
define('DB_NAME', 'reddit');

// Make the connection
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
// Show reason for database connection error, if any
die('Could not connect to MySQL: '.mysqli_connect_error());

// Set the encoding
mysqli_set_charset($dbc, 'utf8');