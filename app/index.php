<?php 
    require_once "../config/CONFIGURATION.php";
    header("Location: ".(IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL)."app/home_page.php");