<?php
session_start();
session_unset(); // Alle Session-Variablen entfernen
session_destroy(); // Die Session zerstören

header("Location: Login.php"); // Weiterleitung zur Admin-Login-Seite
exit();
?>