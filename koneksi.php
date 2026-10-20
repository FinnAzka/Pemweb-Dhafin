<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = new mysqli(
    '127.0.0.1',
    'root',
    '',
    'PBL_TI_2025_C_Kelompok1',
    3306
);
$con->set_charset('utf8mb4');
