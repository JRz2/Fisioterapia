<!DOCTYPE html>
<html>
<head>
    <style>
        .informe-container {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .informe-header {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .informe-header label {
            display: block;
            margin-bottom: 5px;
        }

        .informe-body {
            font-size: 12px;
        }

        .informe-section {
            margin-bottom: 20px;
        }

        .informe-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-text, textarea {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 12px;
        }

        textarea {
            height: 100px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Mi Página Web</h1>
        <nav>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="informe-container">
        <div class="informe-header">
            <label><strong>Paciente:</strong> {{ $paciente }}</label>
            <label><strong>Edad:</strong> {{ $edad }} años</label>
            <label><strong>Género:</strong> {{ $genero }}</label>
            <label><strong>Fecha:</strong> {{ $fecha }}</label>
        </div>

        <div class="informe-body">
            <div class="informe-section">
                <label><strong>Dx:</strong></label>
                <p>{{ $diagnostico }}</p>
            </div>

            <div class="informe-section">
                <label><strong>Análisis Cinético Funcional:</strong></label>
                <p>{{ $analisis }}</p>
            </div>

            <div class="informe-section">
                <label><strong>Recomendaciones:</strong></label>
                <p>{{ $recomendaciones }}</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Mi Página Web. Todos los derechos reservados.</p>
    </footer>
</body>
</html>



