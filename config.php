<?php
$mysqli = new mysqli('localhost', 'wearbmls_FormMegh', 'qyfwy4-haztyt-ciMmub', 'wearbmls_formMegharise');
if ($mysqli->connect_errno) {
    die('Connect Error: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
session_start();
?>