<?php
session_start();
unset($_SESSION['token']);
unset($_SESSION['username']);
header("location:../index.php");