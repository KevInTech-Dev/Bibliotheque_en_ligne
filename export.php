<?php
    include("table_app_contenant.php");
    $req = $conn->prepare("select * from images  where id=? limit 1");
    $req->setFecthMode(conn::FETH_ASSOC);
    $req->execute(array($_GET["id"]))
?>