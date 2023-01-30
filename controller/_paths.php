<?php
// Changed the path variables into constants
// so that the functions can have access to the global variables that are used in the view files.

// FALSE: case-sensitive
DEFINE("ROOT", "index.php?action=", FALSE);
DEFINE("ADMIN_PATH", ROOT . "admin", FALSE);
DEFINE("ADMIN_EDIT_PATH", ROOT . "admin_edit", FALSE);
DEFINE("REGISTER_PATH", ROOT . "register", FALSE);
DEFINE("USER_PROFILE_PATH", ROOT . "my-profile", FALSE);
DEFINE("CREATE_CHALLENGE_PATH", ROOT . "create-challenge", FALSE);
DEFINE("LIST_CHALLENGES_PATH", ROOT . "list-challenges", FALSE);
DEFINE("CHALLENGE_PATH", ROOT . "challenge-specific", FALSE);
DEFINE("EDIT_CHALLENGE_PATH", ROOT . "edit-challenge", FALSE);
DEFINE("LOGIN_PATH", ROOT . "login", FALSE);
DEFINE("ADD_PLACE_PATH", ROOT . "add-place", FALSE);
