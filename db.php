<?php
// db.php
$host = "dpg-crd2qu3tq21c73csl160-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "test_bbaj";
$user = "jaime";
$password = "l58ciipdmdX3AsPE319boApTXNzfYoyj";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
