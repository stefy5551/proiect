<?php

namespace App;

session_start(); //  How can I remove this line, so that it doesn't create a new session?

if (isset($_SESSION["username"])) {print "session exists";} // Checks if session exists
else {print "session does not exist";}
