<?php
include 'db.php';

$consuta_carros = "SELECT * FROM carros";
$result = $conn->query($consuta_carros);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            Listado de Carros
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
    <div class="content">
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. de Serie</th>
                        <th>Marca</th>
                        <th>Submarca</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Capacidad</th>
                        <th>Año</th>
                        <th>Procedencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $row['no_serie']; ?></td>
                            <td><?php echo $row['marca']; ?></td>
                            <td><?php echo $row['submarca']; ?></td>
                            <td><?php echo $row['tipo']; ?></td>
                            <td><?php echo $row['modelo']; ?></td>
                            <td><?php echo $row['color']; ?></td>
                            <td><?php echo $row['capacidad']; ?></td>
                            <td><?php echo $row['año']; ?></td>
                            <td><?php echo $row['procedencia']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="#" class="btn btn-primary editar-btn" data-id="<?php echo $row['id_carro']; ?>">Editar</a>
                                    <a href="crud.php?eliminar_carro=<?php echo $row['id_carro']; ?>" class="btn btn-danger eliminar-btn">Eliminar</a>
                                    <a href="procesar_entrada_servicio.php?id_carro=<?php echo $row['id_carro']; ?>" class="btn btn-warning">Servicio</a>
                                </div>
                                <div class="btn-group mt-2" role="group" aria-label="Acciones">
                                    <a href="ver_servicios.php?id_carro=<?php echo $row['id_carro']; ?>" class="btn btn-info">Ver Servicios Pendientes</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form action="alta_carros.php" method="GET">
                <button type="submit" class="btn btn-primary" name="alta_carros">Agregar Carro</button>
            </form>
        </div>
    </div>


    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ml-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        // Alerta para el botón de eliminar
        document.querySelectorAll('.eliminar-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let href = this.getAttribute('href');
                swalWithBootstrapButtons.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí",
                    cancelButtonText: "No",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire("Eliminado").then((result) => {
                            window.location.href = href;
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire("Cancelado");
                    }
                });
            });
        });

        // Alerta para el botón de editar
        document.querySelectorAll('.editar-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let id = this.getAttribute('data-id');
                swalWithBootstrapButtons.fire({
                    title: "¿Estás seguro?",
                    text: "¡Estás a punto de editar este carro!",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Sí",
                    cancelButtonText: "No",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redireccionar al formulario de edición
                        window.location.href = "editar_carros.php?id_carro=" + id;
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire("Cancelado");
                    }
                });
            });
        });
    </script>
</body>
</html>
