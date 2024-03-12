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
    <title>Listado de Carros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="content">
        <div class="container mt-5">
            <h2>Listado de Carros</h2>
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
                                <a href="editar_carros.php?id_carro=<?php echo $row['id_carro']; ?>" class="btn btn-primary">Editar</a>
                                <a href="crud.php?eliminar_carro=<?php echo $row['id_carro']; ?>" class="btn btn-danger">Eliminar</a>
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
</body>
</html>


<script>
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success ml-2",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
    });

    document.querySelector('.btn-danger').addEventListener('click', function(event) {
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
        swalWithBootstrapButtons.fire(
            "Eliminado",
        ).then((result) => {
            window.location.href = href;
        });
        } else if (
        result.dismiss === Swal.DismissReason.cancel
        ) {
        swalWithBootstrapButtons.fire(
            "Cancelado",
        );
        }
    });
    });
</script>


