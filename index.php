<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites a Distancia | Portal de Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Variables de color estilo Argentina.gob.ar */
:root {
    --primary-blue: #222d4f;
    --dark-blue: #424242;
    --light-gray: #f5f5f5;
    --text-color: #333;
    --white: #ffffff;
}

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: var(--white);
    color: var(--text-color);
}

.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Navbar */
.navbar {
    background-color: #222d4f;
    border-bottom: 3px solid var(--primary-blue);
    padding: 15px 0;
    color: white;
    font-family: 'Console';
    font-weight: bold;
    font-size: 2rem;

}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-login {
    background-color: white;
    color: #222d4f;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    font-size: 1.2rem;
    text-decoration: none;
    text-align: center;
}

.btn-login :hover {
    background-color: #3f569b;
}
/* Hero Section */
.hero {
    background-color: var(--dark-blue);
    color: white;
    padding: 60px 0;
    text-align: center;
}

.hero h1 { font-size: 2.5rem; margin-bottom: 10px; }

.search-box {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.search-box input {
    width: 60%;
    padding: 15px;
    border: none;
    border-radius: 4px 0 0 4px;
    font-size: 1rem;
}

.search-box button {
    padding: 15px 25px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

/* Grid de Trámites */
.section-title { margin: 40px 0 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 50px;
}

.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s;
}

.card:hover { transform: translateY(-5px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }

.card-body { padding: 20px; flex-grow: 1; }
.card-body h3 { font-size: 1.1rem; color: var(--primary-blue); }

.card-footer { padding: 15px; background: #f9f9f9; border-top: 1px solid #eee; }

.btn-primary {
    display: block;
    text-align: center;
    background-color: #eee;
    color: #333;
    text-decoration: none;
    padding: 8px;
    border-radius: 4px;
    font-weight: bold;
}

.btn-primary:hover { background-color: var(--primary-blue); color: white; }

/* Info Section */
.info-links {
    display: flex;
    justify-content: space-around;
    padding: 40px 0;
    background: var(--light-gray);
    border-radius: 8px;
    margin-bottom: 50px;
    text-align: center;
}

.info-card { width: 30%; }
.info-card i { font-size: 2rem; color: var(--primary-blue); margin-bottom: 15px; }

/* Footer */
.footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    text-align: center;
    font-size: 0.9rem;
}
    </style>
</head>
<body>

    <header class="navbar">
        <div class="container">
            <div class="logo"> 
                <strong>Argentina.gob.ar</strong>
            </div>
            <nav>
                <a href="https://autenticar.gob.ar/auth/realms/renaper/protocol/openid-connect/auth?scope=openid&state=leA1ZDkg0tjyZitCvqRG8qXDnHXEdH_MbzCi-I6P_V8.tad&response_type=code&client_id=renaper-idp&redirect_uri=https%3A%2F%2Fautenticar.gob.ar%2Fauth%2Frealms%2Ftad-renaper%2Fbroker%2Frenaper%2Fendpoint" class="btn-login">Ingresar</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Trámites a Distancia - TAD</h1>
            <p>Realizá tus trámites de manera virtual ante la Administración Pública Nacional.</p>
            <div class="search-box">
                <input type="text" placeholder="Buscar trámite por nombre, organización o palabra clave...">
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    </section>

    <main class="container">
        <h2 class="section-title">Trámites Frecuentes</h2>
        
        <div class="grid">
            <div class="card">
                <div class="card-body">
                    <h3>Portal Denuncias Web</h3>
                    <p>Realiza denuncias a nivel nacional, de manera segura y confidencial. </p>
                </div>
                <div class="card-footer">
                    <a href="denuncias-ar/denuncia.php" class="btn-primary">Realizar denuncia</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Apostilla para Colegios de Escribanos</h3>
                    <p>Solicitud de apostilla o legalización para documentos públicos electrónicos.</p>
                </div>
                <div class="card-footer">
                    <a href="https://tramitesadistancia.gob.ar/tramitesadistancia/detalle-tipo?id=2545" class="btn-primary">Iniciar Trámite</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Certificado Médico Oficial (CMO)</h3>
                    <p>Confección de certificado médico digital para pensiones no contributivas.</p>
                </div>
                <div class="card-footer">
                    <a href="https://tramitesadistancia.gob.ar/tramitesadistancia/detalle-tipo?id=2515" class="btn-primary">Iniciar Trámite</a>
                </div>
            </div>
        </div>

        <section class="info-links">
            <div class="info-card">
                <i class="fa fa-file-text"></i>
               <a href="https://www.argentina.gob.ar/formularios/consulta-de-expedientes"><h4>Consultar Expedientes</h4></a> 
                <p>Consultá expedientes ingresando a nuestro buscador.</p>
            </div>
            <div class="info-card">
                <i class="fa fa-book"></i>
                <a href="https://www.argentina.gob.ar/cnv/registros-publicos"><h4>Registros Públicos</h4></a>
                <p>Consultá registros de Libros Digitales o seguros (SSN).</p>
            </div>
            <div class="info-card">
                <i class="fa fa-question-circle"></i>
                <a href="https://www.argentina.gob.ar/"><h4>Centro de Ayuda</h4></a>
                <p>Tutoriales y preguntas frecuentes para usar la plataforma.</p>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 - Ministerio Publico de la Republica Argentina</p>
        </div>
    </footer>

</body>
</html>