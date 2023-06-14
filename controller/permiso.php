<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['iniciar']) || $_SESSION['iniciar'] !== "ok") {
    // El usuario no está autenticado, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: https://google.com");
    exit();
}