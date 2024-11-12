<?php

define('DB_NAME', 'varsity_epay');
/** MySQL database username */
define('DB_USER', 'varsity_epay');
/** MySQL database password */
define('DB_PASSWORD', '*x4387794varsL&r');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

$conn = mysqli_connect('mysql.pentest.sitelogin.com','varsity_epay','x4387794varsL&r','varsity_epay');
if($conn){
    // echo 'Connection works';
}