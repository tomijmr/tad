<?php
// denuncia-exito.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites a Distancia | Denuncia Enviada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #222d4f;
            --dark-blue: #424242;
            --light-gray: #f5f5f5;
            --text-color: #333;
            --white: #ffffff;
            --success: #28a745;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
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

        .success-card {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 50px;
        }

        .icon-success {
            color: var(--success);
            font-size: 4rem;
            margin-bottom: 20px;
        }

        h2 {
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #555;
        }

        .btn-home {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: var(--primary-blue);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-home:hover {
            background-color: #1a233b;
        }

        .footer {
            background-color: var(--primary-blue);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }
        .footer p {
            margin: 0;
            color: white;
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
        <div class="success-card">
            <i class="fas fa-check-circle icon-success"></i>
            <h2>¡Denuncia Registrada!</h2>
            <p>Tu denuncia se ha registrado correctamente.</p>
            <p>En un plazo de 72 horas hábiles un representante legal se pondrá en contacto con vos.</p>
            <p>Codigo de Seguimiento: <strong>76001501824</strong></p>
            
            <a href="../index.php" class="btn-home">Volver al Inicio</a>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 - Ministerio Publico de la Republica Argentina</p>
        </div>
    </footer>

</body>
</html>