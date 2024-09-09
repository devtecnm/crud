<?php
include('db.php');

// Insertar nuevo estudiante
if (isset($_POST['add'])) {
    $no_control = $_POST['no_control'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $semestre = $_POST['semestre'];

    $stmt = $pdo->prepare("INSERT INTO estudiantes (no_control, nombre, ap_paterno, ap_materno, semestre) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$no_control, $nombre, $ap_paterno, $ap_materno, $semestre]);
    header("Location: index.php");
}

// Eliminar estudiante
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM estudiantes WHERE no_control = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
}

// Actualizar estudiante
if (isset($_POST['update'])) {
    $no_control = $_POST['no_control'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $semestre = $_POST['semestre'];

    $stmt = $pdo->prepare("UPDATE estudiantes SET nombre = ?, ap_paterno = ?, ap_materno = ?, semestre = ? WHERE no_control = ?");
    $stmt->execute([$nombre, $ap_paterno, $ap_materno, $semestre, $no_control]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Estudiantes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">CRUD de Estudiantes</h2>
    
    <!-- Formulario para agregar o editar estudiantes -->
    <form method="POST" action="index.php" class="mt-4 mb-4">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="no_control" placeholder="No Control" required>
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="ap_paterno" placeholder="Apellido Paterno" required>
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="ap_materno" placeholder="Apellido Materno" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" class="form-control" name="semestre" placeholder="Semestre" required>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" name="add" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de estudiantes -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No Control</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Semestre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM estudiantes");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['no_control'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['ap_paterno'] . "</td>";
            echo "<td>" . $row['ap_materno'] . "</td>";
            echo "<td>" . $row['semestre'] . "</td>";
            echo "<td>
                    <a href='edit.php?no_control=" . $row['no_control'] . "' class='btn btn-primary btn-sm'>Editar</a>
                    <a href='index.php?delete=" . $row['no_control'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
