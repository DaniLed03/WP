<?php
include 'db.php';

if(isset($_GET['eliminar_servicio'])){
    $id_servicio = $_GET['eliminar_servicio'];

    // Verificar si hay registros relacionados en la tabla entrada_servicios
    $sql_check_entries = "SELECT COUNT(*) AS total FROM entrada_servicios WHERE id_servicio = $id_servicio";
    $result_check_entries = $conn->query($sql_check_entries);
    $row_check_entries = $result_check_entries->fetch_assoc();
    $total_entries = $row_check_entries['total'];

    if($total_entries > 0) {
        // Mostrar un mensaje indicando que hay registros relacionados
        echo '<script>alert("Este servicio tiene registros relacionados en la tabla de entradas. Por favor, elimina los registros relacionados primero."); window.location.href = "listado_servicios.php";</script>';
        exit; // Salir del script después de la redirección
    } else {
        // No hay registros relacionados, podemos eliminar el servicio
        $sql_eliminar_servicio = "DELETE FROM servicios WHERE id_servicio = $id_servicio";
        $result_eliminar_servicio = $conn->query($sql_eliminar_servicio);

        // Redirigir al listado de servicios después de eliminar el servicio
        header("Location: listado_servicios.php");
        exit; // Salir del script después de la redirección
    }
}

$consulta_servicios = "SELECT * FROM servicios";
$result = $conn->query($consulta_servicios);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Servicios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #333;
            padding: 10px 20px;
        }
        .navbar-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-align: center; /* Centra el texto "Menú Principal" */
            margin-right: center; /* Empuja el texto hacia la izquierda */
            margin-left: center; /* Empuja el texto hacia la derecha */
        }
        .navbar-brand img {
            height: 130px; /* Ajusta la altura de la imagen según tus necesidades */
        }
        .navbar-nav {
            display: flex;
            justify-content: center; /* Centra horizontalmente las opciones de menú */
            align-items: center; /* Centra verticalmente las opciones de menú */
            margin: 0; /* Elimina el margen para alinear correctamente */
            padding: 0; /* Elimina el relleno para alinear correctamente */
        }
        .nav-item {
            margin-left: 10px; /* Ajusta el espacio entre las opciones de menú */
        }
        .nav-link {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }
        .nav-link:hover {
            color: #ccc;
        }
        .content {
            padding: 20px;
        }
        table {
            color: white; /* Letras blancas */
        }
        th {
            background-color: GRAY; /* Fondo negro */
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="index.php"> <!-- Agregamos el enlace al logo -->
                <img src="./images/ledetech.png" alt="Logo">
            </a>
        </div>
        <div class="navbar-brand">
            Listado de Servicios
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="alta_carros.php">Agregar Carro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listado_carros.php">Listado de Carros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listado_servicios.php">Listado de Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="alta_servicio.php">Agregar Servicio</a>
            </li>
        </ul>
    </nav>

<?php
include 'db.php';

if(isset($_GET['eliminar_servicio'])){
    $id_servicio = $_GET['eliminar_servicio'];

    // Eliminar el servicio de la base de datos
    $sql_eliminar_servicio = "DELETE FROM servicios WHERE id_servicio = $id_servicio";
    $result_eliminar_servicio = $conn->query($sql_eliminar_servicio);

    header("Location: listado_servicios.php"); // Redirigir al listado de servicios después de eliminar el servicio
    exit; // Salir del script después de la redirección
}

$consulta_servicios = "SELECT * FROM servicios";
$result = $conn->query($consulta_servicios);
?>

    <div class="content">
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Costo</th>
                        <th>Acciones</th> <!-- Nueva columna para botones -->
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $row['id_servicio']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['costo']; ?></td>
                            <td>
                                <button class="btn btn-primary edit-btn" data-id="<?php echo $row['id_servicio']; ?>">Editar</button>
                                <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id_servicio']; ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="alta_servicio.php" class="btn btn-primary">Agregar Servicio</a>
        </div>
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const deleteButtons = document.querySelectorAll('.delete-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const servicioId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción abrirá la página de edición',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, editar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `editar_servicio.php?id_servicio=${servicioId}`;
                    }
                });
            });
        });

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const servicioId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción eliminará el servicio',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `listado_servicios.php?eliminar_servicio=${servicioId}`;
                    }
                });
            });
        });
    });
</script>


