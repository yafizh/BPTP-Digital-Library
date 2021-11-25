<?php 
    require_once "../../CONFIGURATION.php";
    header("Location: ".(IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL)."information_system/app/home_page.php");