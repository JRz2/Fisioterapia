<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            padding-bottom: 100px; 
            margin-top: 110px;
            margin-left: -10px;
            margin-right: 10px;
        }
        header {
            position: fixed;
            top: -40px;
            margin-bottom: -20px;
            text-align: center;
        }
        footer {
            position: fixed; 
            left: 0;
            bottom: -40px; 
            width: 100%; 
            text-align: center; 

        }

        .informe-header{
            text-align: center;
        }

        .footer-firm{
            display: flex;
            justify-content: space-between;
        }

        .footer-fecha{
            text-align: left;
        }

        .footer-firma{
            text-align: right;
        }

        .header-content {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .header-text {
            position: absolute;
            top: 120px; /* Ajusta según sea necesario */
            width: 100%;
            text-align: center;
            color: black; /* Cambia el color si es necesario */
        }

        .informe-container{
            margin-left: 60px;
            margin-right: 60px;
        }

    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-text">
                <strong>CENTRO DE FISIOTERAPIA Y KINESIOLOGÍA</strong><br>
                <strong>"FISIOMEDEP"</strong>
            </div>
            <img src="image/imgencabezado.png" style="width: 700px; height: 150px;">
        </div>
    </header>
    
    <main>
        <div class="informe-container">
            <div class="informe-date">
                <strong>INFORME KINESICO</strong>
                <table style="width: 100%; margin-top: 10px;">
                    <tr>
                        <td style="text-align: left; width: 50%;"><strong>Paciente:</strong> {{ $nombre }} {{ $paterno }} {{ $materno }}</td>
                        <td style="text-align: right; width: 50%;"><strong>Edad:</strong> {{ $edad }} años</td>
                        <td style="text-align: right; width: 50%;"><strong>Genero:</strong> {{ $genero }}</td>
                    </tr>
                </table>
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; width: 30%;"><strong>CI:</strong> {{ $ci }}</td>
                        <td style="text-align: right; width: 70%;"><strong>ESPECIALIDAD FISIOTERAPIA Y KINESIOLOGÍA</strong></td>
                    </tr>
                </table>              
            </div>
            <br>
            <div class="informe-body">
                <div class="informe-section">
                    <label><strong>Dx:</strong></label>
                    <p>{{ $dx }}</p>
                </div>
    
                <div class="informe-section">
                    <label><strong>ANÁLISIS CINÉTICO FUNCIONAL:</strong></label>
                    <p> {!! $informe !!}</p>
                </div>
    
                <div class="informe-section">
                    <label><strong>REHABILITACIÓN FISIOTERAPÉUTICA Y KINESIOLOGÍA:</strong></label>
                    <p>{!! $rehabilitacion !!}</p>
                </div>

                <div class="informe-section">
                    <label><strong>RECOMENDACIONES:</strong></label>
                    <p>{!! $recomendacion !!}</p>
                </div>

                <div class="informe-section">
                    <label><strong>NOTA:</strong></label>
                    <p>{!! $nota !!}</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div style="text-align: left">
            <label> Sin otro particular me despido atentamente a quien corresponsa.</label>
        </div>
        <div class="footer-fecha">
            <label> Lugar y fecha: La Paz {{$fecha}} </label>
        </div>
        <div class="footer-firma">
            <label> Firma y sello fisioterapeuta</label>
        </div>
        <img src="image/imgpiepagina.png" style="width: 700px; height: 150px;">
    </footer>
</body>
</html>
