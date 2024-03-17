<!DOCTYPE html>
<html>
<head>
    <title>Menú Responsivo con Bootstrap y PHP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Enlaces a los archivos CSS de Bootstrap y Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Enlace al archivo CSS de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <style>
        .navbar {
            background-color: #940202 !important; /* Color de fondo */
        }
        .navbar-brand {
            color: white !important; /* Color del texto */
            font-weight: bold; /* Texto en negrita */
        }
        .navbar-nav .nav-link {
            color: white !important; /* Color del texto */
            font-weight: bold; /* Texto en negrita */
            text-align: center; /* Texto centrado */
        }
        .clock {
            color: white;
            font-weight: bold;
        }
        .navbar-toggler-icon {
            filter: invert(1) !important; /* Esto cambiará el color a blanco */
            font-weight: bold !important; /* Esto hará que el texto sea negrita */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Sitio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="altas.php"><i class="fas fa-folder-plus"></i> Alta de Expedientes</a>
                    </li>
                </ul>
                <span class="navbar-text ml-3">
                    <span class="clock"><i class="fas fa-clock"></i> <span id="current-time"></span></span>
                </span>
            </div>
        </div>
    </nav>

    <!-- Enlaces a los archivos JS de Bootstrap, jQuery y SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script>
        // Función para obtener la hora actual en formato hh:mm:ss AM/PM
        function getCurrentTime() {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // El reloj es de 12 horas
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            return currentTime;
        }

        // Función para actualizar la hora cada segundo
        function updateTime() {
            document.getElementById('current-time').innerHTML = getCurrentTime();
        }

        // Llama a la función updateTime cada segundo
        setInterval(updateTime, 1000);

        // Actualiza la hora al cargar la página
        updateTime();

        // Función para confirmar el cierre de sesión
        function confirmLogout() {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Estás a punto de cerrar la sesión.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.html";
                    
                }
            });
        }
    </script>
</body>
</html>
