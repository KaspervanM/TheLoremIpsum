<?php
if (isset($_POST["session"])){
    session_start();
    session_destroy();
    die();
}
?>
