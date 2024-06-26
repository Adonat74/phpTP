<?php
// ----isset()---- permet de vérifier si des variable sont bien initialisées avant de s'en servir, permettant d'éviter d'éventuelles erreurs.
if (isset($_GET['page'])) {
    $requested_page = $_GET['page'];
}
else {
    $requested_page = 'home';
}


if ($requested_page == 'home') {
    include 'home.php';
} else if ($requested_page == 'about') {
    include 'about.php';
} else if ($requested_page == 'contact') {
    include 'contact.php';
} else {
    include 'notfound.php';
}

// switch ($requested_page) {
//     case 'home':
//         include 'home.php';
//         break;
//     case 'about':
//         include 'about.php';
//         break;
//     case 'contact':
//         include 'contact.php';
//         break;
//     default:
//         include 'notfound.php';
//         break;
// }
