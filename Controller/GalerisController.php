<?php
require_once('Controller.php');
class GalerisController extends Controller{
    public function controller() {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('galeris', ["connectUser" =>  isset($_SESSION["usersessionID"]),  "userRole" => $role]);
    }
}
