<?php
include 'db.php';

if(isset($_POST['registrar_entrada'])){
    $id_carro = $_POST['id_carro'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $id_servicio = $_POST['id_servicio'];
    $total_pagar = $_POST['total_pagar'];

    // Verificar si el servicio ya ha sido solicitado para el carro
    $consulta_existencia_servicio = "SELECT * FROM entrada_servicios WHERE id_carro = $id_carro AND id_servicio = $id_servicio";
    $resultado_existencia_servicio = $conn->query($consulta_existencia_servicio);

    if ($resultado_existencia_servicio->num_rows > 0) {
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Este servicio ya ha sido solicitado para este carro.',
                  confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back(); // Vuelve a la página anterior
                    }
                });
              </script>";
    } else {
        // Si el servicio no ha sido solicitado previamente, procede con el registro
        $sql = "INSERT INTO entrada_servicios (id_carro, fecha_ingreso, id_servicio, total_pagar) VALUES ('$id_carro', '$fecha_ingreso', '$id_servicio', '$total_pagar')";
        $result = $conn->query($sql);

        if($result) {
            echo "<script>
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: '¡Entrada de servicio registrada exitosamente!',
                      showConfirmButton: false,
                      timer: 1500
                    }).then(function() {
                        window.location.href = 'listado_carros.php'; // Redirige a listado_carros.php
                    });
                  </script>";
        } else {
            echo "Error al registrar la entrada de servicio: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada de Servicios</title>
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
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="./images/Ledetech.png" alt="Logo">
        </div>
        <div class="navbar-brand">
            Menú Principal
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
            <h2>Entrada de Servicios</h2>
            <form action="procesar_entrada_servicio.php" method="POST">
                <div class="form-group">
                    <label for="id_carro">ID del Carro:</label>
                    <input type="text" class="form-control" id="id_carro" name="id_carro" value="<?php echo isset($_GET['id_carro']) ? $_GET['id_carro'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                </div>
                <div class="form-group">
                    <label for="id_servicio">Servicio a Realizar:</label>
                    <select class="form-control" id="id_servicio" name="id_servicio" required onchange="updateTotal()">
                        <option value="">Seleccione un Servicio</option>
                        <?php
                            // Aquí puedes cargar dinámicamente los servicios desde la base de datos
                            $consulta_servicios = "SELECT * FROM servicios";
                            $result = $conn->query($consulta_servicios);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['id_servicio']."' data-costo='".$row['costo']."'>".$row['nombre']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_pagar">Total a Pagar:</label>
                    <input type="text" class="form-control" id="total_pagar" name="total_pagar" required readonly>
                </div>
                <button type="submit" class="btn btn-primary" name="registrar_entrada">Registrar Entrada</button>
                <a href="listado_carros.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <script>
        function updateTotal() {
            var servicioSelect = document.getElementById('id_servicio');
            var totalPagarInput = document.getElementById('total_pagar');
            var selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
            var costo = parseFloat(selectedOption.getAttribute('data-costo'));
            totalPagarInput.value = isNaN(costo) ? '' : costo.toFixed(2);
        }
    </script>
    <script>
        <?php if(isset($_POST['registrar_entrada']) && $result) { ?>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '¡Entrada de servicio registrada exitosamente!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'listado_carros.php'; // Redirige a listado_carros.php
            });
        <?php } ?>
    </script>
    <script>
        <?php if($resultado_existencia_servicio->num_rows > 0) { ?>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Este servicio ya ha sido solicitado para este carro.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back(); // Vuelve a la página anterior
                }
            });
        <?php } ?>
    </script>
</body>
</html>



