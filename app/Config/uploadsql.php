<?php
require_once(dirname(__FILE__) . '/database.php');
$DB = new DATABASE_CONFIG();

// Setup the connection
if($DB->default['driver'] === 'mysqli') {
    // Connect using MySQLi
    print "Connecting to database: ";
    $dbc = new mysqli($DB->default['host'], $DB->default['login'], $DB->default['password'], $DB->default['database']);

    // Make sure we use UTF8 encoding
    if($DB->default['encoding'] == "UTF8") {
        $dbc->set_charset($DB->default['encoding']);
    }

    // At this point you can just run raw queries like:
    $dbc->query("INSERT INTO `student_homeworks` (`id`, `student_id`, `question_type`, `record_location`, `subject_id`) VALUES (NULL, 1, 'R','/app/webroot/design700/assets/scripts/recordings', 6), (2, 'Operations')");

    // Close the database connection
    $dbc->close();
} else {
    die("Please use mysqli");
}
?>