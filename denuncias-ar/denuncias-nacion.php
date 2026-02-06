<?php
// Configuración de Base de Datos
$host = 'localhost';
$user = 'c2632136_tad';
$pass = 'goSO85futa'; // Por defecto en XAMPP
$dbname = 'c2632136_tad';

// Crear conexión
$conn = new mysqli($host, $user, $pass);

// Verificar conexión
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
}

// Crear base de datos si no existe
$sql_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_db) === TRUE) {
    $conn->select_db($dbname);
} else {
    die("Error al crear la base de datos: " . $conn->error);
}

// Crear tabla si no existe
$sql_table = "CREATE TABLE IF NOT EXISTS denuncias (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(20) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(50),
    provincia VARCHAR(50) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    es_anonima TINYINT(1) DEFAULT 0,
    denuncia LONGTEXT NOT NULL,
    archivo_adjunto VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($sql_table)) {
    die("Error creando la tabla: " . $conn->error);
}

$mensaje_estado = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $conn->real_escape_string($_POST['dni']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $provincia = $conn->real_escape_string($_POST['provincia']);
    $localidad = $conn->real_escape_string($_POST['localidad']);
    $es_anonima = isset($_POST['es_anonima']) ? 1 : 0;
    $denuncia = $conn->real_escape_string($_POST['denuncia']);
    
    // Manejo de Archivos
    $archivo_path = "";
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $target_dir = __DIR__ . "/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $archivo_nombre = time() . "_" . basename($_FILES["archivo"]["name"]);
        $target_file = $target_dir . $archivo_nombre;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Permitir ciertos formatos
        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "pdf") {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                // Guardamos ruta relativa para la DB o absoluta según prefieras. 
                // Para links web, mejor relativa desde el root de la web.
                // Pero en la DB estamos guardando lo que sea.
                // Ajustemos para guardar la ruta relativa web: "uploads/" + nombre
                $archivo_path = "uploads/" . $archivo_nombre;
            } else {
                $mensaje_estado = "<div class='alert error'>Hubo un error al subir su archivo. Verifique permisos en la carpeta uploads.</div>";
            }
        } else {
             $mensaje_estado = "<div class='alert error'>Solo se permiten archivos JPG, JPEG, PNG y PDF.</div>";
        }
    }

    if (empty($mensaje_estado)) {
        $sql_insert = "INSERT INTO denuncias (dni, nombre_completo, email, telefono, provincia, localidad, es_anonima, denuncia, archivo_adjunto)
        VALUES ('$dni', '$nombre', '$email', '$telefono', '$provincia', '$localidad', '$es_anonima', '$denuncia', '$archivo_path')";

        if ($conn->query($sql_insert) === TRUE) {
            
            // --- ENVIO DE CORREO AUTOMÁTICO ---
            // IMPORTANTE: Debes configurar aquí la cuenta de correo que creaste en Ferozo
            $email_remitente = "no_responder@tramites-a-distancia.online"; // CAMBIAR POR TU EMAIL REAL

            $to = $email;
            $subject = "Confirmación de Recepción de Denuncia - TAD";
            
            $message_body = "
            <html>
            <head>
                <title>Confirmación de Denuncia</title>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 5px; }
                    .header { background-color: #222d4f; color: white; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
                    .content { padding: 20px; background-color: #fff; }
                    .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;}
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2 style='margin:0;'>Trámites a Distancia</h2>
                    </div>
                    <div class='content'>
                        <p>Estimado/a <strong>" . htmlspecialchars($nombre) . "</strong>,</p>
                        <p>Le confirmamos que su denuncia ha sido registrada correctamente en el sistema del Ministerio Público.</p>
                        <div style='background-color: #f9f9f9; padding: 15px; border-left: 4px solid #28a745; margin: 20px 0;'>
                            <p style='margin: 0;'><strong>ID de Seguimiento:</strong> " . $conn->insert_id . "</p>
                            <p style='margin: 5px 0 0 0;'><strong>Fecha:</strong> " . date('d/m/Y H:i') . "</p>
                        </div>
                        <p>Su caso ha sido derivado al área legal correspondiente. En un plazo de 72 horas hábiles, un representante analizará la información presentada y se pondrá en contacto con usted si fuera necesario.</p>
                        <br>
                        <p>Atentamente,<br><strong>Equipo de Trámites a Distancia y Denuncias Web</strong></p>
                    </div>
                    <div class='footer'>
                        <p>Ministerio Público de la República Argentina<br>Este es un mensaje automático, por favor no responda a este correo.</p>
                    </div>
                </div>
            </body>
            </html>
            ";

            // Cabeceras para enviar email con formato HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: TAD Nacional <" . $email_remitente . ">" . "\r\n";
            $headers .= "Reply-To: " . $email_remitente . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Enviar el correo (usamos @ para suprimir errores en pantalla si falla el servidor de correo)
            @mail($to, $subject, $message_body, $headers);

            // Redirigir a la página de éxito
            header("Location: denuncia-exito.php");
            exit();
        } else {
            $mensaje_estado = "<div class='alert error'>Error: " . $sql_insert . "<br>" . $conn->error . "</div>";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites a Distancia | Nueva Denuncia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Estilos base de index.php */
        :root {
            --primary-blue: #222d4f;
            --dark-blue: #424242;
            --light-gray: #f5f5f5;
            --text-color: #333;
            --white: #ffffff;
            --success: #28a745;
            --danger: #dc3545;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--white);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 800px; /* Ancho más reducido para formularios */
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        .navbar {
            background-color: #222d4f;
            border-bottom: 3px solid var(--primary-blue);
            padding: 15px 0;
            color: white;
            font-family: 'Console', monospace; 
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        /* Estilos del Formulario */
        .form-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .form-section h2 {
            color: var(--primary-blue);
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; 
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            outline: none;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .btn-submit {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1rem;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #1a233b;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .footer {
            background-color: var(--primary-blue);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="../index.php">Argentina.gob.ar <span style="font-size: 1rem;">Trámites a Distancia</span></a>
        </div>
    </nav>

    <div class="container">
        
        <?php echo $mensaje_estado; ?>

        <div class="form-section">
            <h2>Realiza tu denuncia</h2>
            <p>Completa el siguiente formulario para enviar tu denuncia de manera segura. En las proximas 72 horas habiles, recibirás una respuesta a tu correo electrónico por parte de un abogado de nuestro equipo.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="dni" class="form-label">DNI *</label>
                    <input type="text" id="dni" name="dni" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre Completo *</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico *</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">Número de Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" class="form-control">
                </div>

                <div class="form-group">
                    <label for="provincia" class="form-label">Provincia *</label>
                    <select id="provincia" name="provincia" class="form-control" required>
                        <option value="">Seleccione una provincia...</option>
                        <option value="Buenos Aires">Buenos Aires</option>
                        <option value="CABA">Ciudad Autónoma de Buenos Aires</option>
                        <option value="Catamarca">Catamarca</option>
                        <option value="Chaco">Chaco</option>
                        <option value="Chubut">Chubut</option>
                        <option value="Córdoba">Córdoba</option>
                        <option value="Corrientes">Corrientes</option>
                        <option value="Entre Ríos">Entre Ríos</option>
                        <option value="Formosa">Formosa</option>
                        <option value="Jujuy">Jujuy</option>
                        <option value="La Pampa">La Pampa</option>
                        <option value="La Rioja">La Rioja</option>
                        <option value="Mendoza">Mendoza</option>
                        <option value="Misiones">Misiones</option>
                        <option value="Neuquén">Neuquén</option>
                        <option value="Río Negro">Río Negro</option>
                        <option value="Salta">Salta</option>
                        <option value="San Juan">San Juan</option>
                        <option value="San Luis">San Luis</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Santa Fe">Santa Fe</option>
                        <option value="Santiago del Estero">Santiago del Estero</option>
                        <option value="Tierra del Fuego">Tierra del Fuego</option>
                        <option value="Tucumán">Tucumán</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="localidad" class="form-label">Localidad *</label>
                    <input type="text" id="localidad" name="localidad" class="form-control" required>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="es_anonima" name="es_anonima" value="1">
                    <label for="es_anonima" style="margin-bottom: 0;">¿Desea que esta denuncia sea anónima?</label>
                </div>

                <div class="form-group">
                    <label for="denuncia" class="form-label">Detalle de la Denuncia *</label>
                    <textarea id="denuncia" name="denuncia" class="form-control" placeholder="Escriba aquí los detalles de su denuncia sin límite de caracteres..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="archivo" class="form-label">Adjuntar Pruebas (Imagen o PDF)</label>
                    <input type="file" id="archivo" name="archivo" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <p>Esta denuncia sera revisada por el equipo legal del Colegio de Abogados de la provincia de Buenos Aires, con el respaldo del Ministerio Publico de la Republica Argentina.</p>
                <p>El fiscal de turno decidirá sobre la procedencia y seguimiento de la denuncia presentada. El equipo legal puede solicitar documentación o información adicional para completar el proceso.</p>

                <button type="submit" class="btn-submit">Enviar Denuncia</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 - Ministerio Publico de la Republica Argentina</p>
        </div>
    </footer>

</body>
</html>
