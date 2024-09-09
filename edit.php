<?php
include('db.php');

if (isset($_GET['no_control'])) {
    $no_control = $_GET['no_control'];
    $stmt = $pdo->prepare("SELECT * FROM estudiantes WHERE no_control = ?");
    $stmt->execute([$no_control]);
    $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$estudiante) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Editar Estudiante</h2>
    <form method="POST" action="index.php">
        <div class="form-row">
            <input type="hidden" name="no_control" value="<?php echo $estudiante['no_control']; ?>">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="ap_paterno" value="<?php echo $estudiante['ap_paterno']; ?>" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="ap_materno" value="<?php echo $estudiante['ap_materno']; ?>" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" class="form-control" name="semestre" value="<?php echo $estudiante['semestre']; ?>" required>
            </div>
            <div class="form-group col-md-1">
                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
