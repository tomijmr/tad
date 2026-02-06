<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites a Distancia | Procedimiento de Denuncias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #222d4f;
            --dark-blue: #424242;
            --light-gray: #f5f5f5;
            --text-color: #333;
            --white: #ffffff;
            --accent-blue: #3f569b;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--white);
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
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
            margin-bottom: 40px;
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

        /* Content Section */
        .content-section {
            background: #fff;
            padding: 40px;
            margin-bottom: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .page-title {
            color: var(--primary-blue);
            font-size: 2.2rem;
            border-bottom: 3px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .text-block {
            margin-bottom: 30px;
            font-size: 1.1rem;
            text-align: justify;
        }

        .text-block h3 {
            color: var(--dark-blue);
            margin-bottom: 15px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .text-block h3 i {
            color: var(--accent-blue);
        }

        .highlight {
            background-color: rgba(34, 45, 79, 0.05);
            padding: 20px;
            border-left: 5px solid var(--primary-blue);
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }

        /* Button */
        .cta-container {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .btn-start {
            background-color: var(--success);
            background-color: #222d4f; 
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 4px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: inline-block;
        }

        .btn-start:hover {
            background-color: #111625;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        
        .btn-start i {
            margin-left: 10px;
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
        <div class="content-section">
            <h1 class="page-title">Sistema de Denuncias Web y Procedimiento Legal</h1>

            <div class="text-block">
                <h3><i class="fas fa-gavel"></i> Validez Nacional y Acompañamiento Integral</h3>
                <p>
                    En el <strong>portal de denuncias web del Ministerio Público de la Nación</strong>, ciudadanos de todo el territorio pueden realizar denuncias con <strong>validez total a nivel nacional</strong>. Este sistema ha sido diseñado para derribar las barreras burocráticas, permitiendo que cada presentación tenga el mismo peso legal que una denuncia realizada presencialmente en una fiscalía.
                </p>
                <p>
                    El compromiso del Estado no termina en la recepción del formulario: garantizamos <strong>acompañamiento legal constante y asesorías gratuitas</strong> para todos los denunciantes. Nuestro objetivo es brindarle un parte legal claro y accesible, asegurando que cuente con las herramientas necesarias para resolver su caso de la manera más eficiente y justa posible, sin importar su situación económica o ubicación geográfica.
                </p>
            </div>

            <div class="text-block">
                <h3><i class="fas fa-archive"></i> Procesamiento, Archivo e Impugnación</h3>
                <div class="highlight">
                    <p>
                        <strong>Transparencia en el registro:</strong> Todas las denuncias ingresadas al sistema quedan archivadas digitalmente de manera perpetua para garantizar la trazabilidad histórica de los conflictos.
                    </p>
                </div>
                <p>
                    Es fundamental comprender el ciclo de vida de una denuncia. En aquellos casos donde se determine falta de pruebas concluyentes, falta de solidez jurídica en la presentación, o cuando el fiscal de turno considere que los hechos no constituyen delito, el caso podría no avanzar a una instancia de juicio oral. 
                </p>
                <p>
                    Sin embargo, esto no implica la inexistencia del reporte. En dichas circunstancias, <strong>la denuncia quedará impugnada y registrada en el legajo personal de cada persona denunciada</strong>. Este antecedente administrativo sirve como precedente vital para futuras investigaciones, asegurando que conductas reiteradas no pasen desapercibidas por las autoridades.
                </p>
            </div>

            <div class="text-block">
                <h3><i class="fas fa-search"></i> Investigación de Paradero y Ciberseguridad</h3>
                <p>
                    En situaciones críticas que requieran buscar datos certeros sobre el paradero de una persona o rastrear actividades ilícitas digitales, el Estado despliega todos sus recursos. El <strong>Cuerpo de Investigaciones Fiscales (CIF)</strong>, en coordinación con la <strong>Policía de Investigación Cibernética</strong> y el <strong>Poder Judicial de la República Argentina</strong>, activan protocolos de búsqueda avanzada.
                </p>
                <p>
                    Aseguramos un proceso riguroso donde todas las instancias investigativas —desde el rastreo de huellas digitales hasta el análisis de telecomunicaciones— tendrán resultados orientados exclusivamente al bienestar y la seguridad del pueblo argentino. La tecnología de punta se pone al servicio de la verdad y la justicia.
                </p>
            </div>

            <div class="text-block">
                <h3><i class="fas fa-user-shield"></i> Seguridad y Confidencialidad de sus Datos</h3>
                <p>
                    La privacidad es un pilar de este sistema. Realice su denuncia con <strong>total seguridad y confianza</strong>. Todos los datos sensibles presentados, así como las pruebas documentales adjuntas, serán encriptados y vistos e intervenidos <strong>únicamente por los miembros del equipo legal y judicial correspondiente</strong> al caso. Nadie fuera de la cadena de custodia oficial tendrá acceso a su identidad ni a los detalles de su declaración.
                </p>
            </div>

            <div class="cta-container">
                <a href="denuncias-nacion.php" class="btn-start">
                    Realiza tu denuncia ahora <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 - Ministerio Publico de la Republica Argentina</p>
        </div>
    </footer>

</body>
</html>
