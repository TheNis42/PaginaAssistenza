<?php

$externCodMacchina=isset($_GET["extCodMacchina"])?$_GET["extCodMacchina"]:null;
echo json_encode($externCodMacchina);
