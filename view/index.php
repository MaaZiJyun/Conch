<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: ../view/home-view.php');
}else{
	header('Location: ../index.php');
}
?>