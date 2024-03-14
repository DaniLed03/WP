<?php
include 'db.php';

// Verificar si se ha enviado una solicitud de cancelación de servicio
if(isset($_GET['cancelar_servicio'])){
    // Obtener el ID del servicio a cancelar
    $id_servicio_cancelar = $_GET['cancelar_servicio'];
    
    // Realizar la eliminación del servicio específico
    $sql_eliminar_servicio = "DELETE FROM entrada_servicios WHERE id_servicio = $id_servicio_cancelar";
    $result_eliminar_servicio = $conn->query($sql_eliminar_servicio);
}

// Obtener id_carro de la URL
$id_carro = $_GET['id_carro'];

// Consulta para obtener el número de serie del carro
$sql_numero_serie = "SELECT no_serie FROM carros WHERE id_carro = $id_carro";
$result_numero_serie = $conn->query($sql_numero_serie);
$row_numero_serie = $result_numero_serie->fetch_assoc();
$numero_serie = $row_numero_serie['no_serie'];

// Consulta para obtener los servicios pendientes para el id_carro especificado
$consulta_servicios_pendientes = "SELECT entrada_servicios.*, servicios.nombre AS nombre_servicio 
                                    FROM entrada_servicios 
                                    INNER JOIN servicios ON entrada_servicios.id_servicio = servicios.id_servicio 
                                    WHERE entrada_servicios.id_carro = $id_carro";
$result_servicios_pendientes = $conn->query($consulta_servicios_pendientes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Pendientes para Carro <?php echo $numero_serie; ?></title>
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
            text-align: center;
            margin-right: center;
            margin-left: center;
        }
        .navbar-brand img {
            height: 130px;
        }
        .navbar-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .nav-item {
            margin-left: 10px;
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
                <img src="./images/Ledetech.png" alt="Logo">
            </a>
        </div>
        <div class="navbar-brand">
            Servicios Pendientes para Carro con numero de serie <?php echo $numero_serie; ?>
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
                        <th>ID Servicio</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                        <!-- Agrega más columnas si es necesario -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_pagar = 0; // Inicializar la variable para almacenar el total
                    if ($result_servicios_pendientes->num_rows > 0) {
                        // Si hay servicios pendientes, mostrar cada uno
                        while($row_servicio = $result_servicios_pendientes->fetch_assoc()){ 
                            $total_pagar += $row_servicio['total_pagar']; // Sumar el precio de cada servicio
                            ?>
                            <tr>
                                <td><?php echo $row_servicio['id_servicio']; ?></td>
                                <td><?php echo $row_servicio['nombre_servicio']; ?></td>
                                <td><?php echo $row_servicio['fecha_ingreso']; ?></td>
                                <td><?php echo $row_servicio['total_pagar']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger cancelar-btn" data-id="<?php echo $row_servicio['id_servicio']; ?>">Cancelar Servicio</button>
                                </td>
                                <!-- Agrega más columnas si es necesario -->
                            </tr>
                        <?php }
                    } else {
                        // Si no hay servicios pendientes, mostrar un mensaje
                        echo '<tr><td colspan="6">No hay servicios pendientes</td></tr>';
                    } ?>
                    <!-- Agrega una fila adicional para mostrar el total -->
                    <tr>
                        <td colspan="3"></td>
                        <td><strong>Total:</strong></td> <!-- Añadir la etiqueta <strong> para hacer el texto en negrita -->
                        <td><?php echo $total_pagar; ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="listado_carros.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>

    <script>
        // Script para mostrar SweetAlert al hacer clic en "Cancelar Servicio"
        document.addEventListener('DOMContentLoaded', function () {
            const cancelarButtons = document.querySelectorAll('.cancelar-btn');
            cancelarButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const servicioId = this.getAttribute('data-id');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¡No podrás revertir esto!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, cancelarlo'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirige a cancelar_servicio.php con el ID del servicio a cancelar
                            window.location.href = `cancelar_servicio.php?id_servicio=${servicioId}&id_carro=<?php echo $id_carro; ?>`;
                        }
                    });
                });
            });
        });
    </script>

</body>
</html>
