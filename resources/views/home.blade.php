@extends('adminlte::page')

@section('title', 'Modelo Vista Controlador')

@section('content_header')
    <div class="text-center py-5">
        <h1 class="display-3 text-black font-weight-bold text-shadow">MODELO VISTA CONTROLADOR</h1>
        <div class="mt-4 futuristic-container">
            <div class="futuristic-text">
                <span class="futuristic-part">TALLER DE SISTEMAS III</span>
                {{-- <span class="futuristic-divider">/</span> --}}
                <br>
                <span class="futuristic-name">JORGE URIZAR RIVERA</span>
            </div>
            <div class="futuristic-glow"></div>
            <div class="futuristic-particles"></div>
        </div>
    </div>
@stop

@section('content')
    <div class="overlay-content text-center py-5 rounded-lg">
        <div class="mb-5">
            <div class="row justify-content-center">
                <!-- Tarjetas sin cambios -->
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        /* ... [otros estilos anteriores] ... */

        .futuristic-container {
            position: relative;
            display: inline-block;
            margin-top: 30px;
            perspective: 1000px;
        }

        .futuristic-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            background: linear-gradient(90deg, #1900ff, #e0c372, #032c2c);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-flow 3s linear infinite, text-float 4s ease-in-out infinite;
            position: relative;
            z-index: 2;
            padding: 15px 40px;
            border-radius: 15px;
            transform-style: preserve-3d;
            transform: rotateX(5deg);
        }

        .futuristic-part {
            color: #161615; /* Dorado */
            text-shadow: 0 0 10px #0c1141, 0 0 20px #161615;
        }

        .futuristic-divider {
            margin: 0 15px;
            color: #58bd4a;
            text-shadow: 0 0 10px #101b4e, 0 0 20px #100a2c;
            animation: pulse 3s infinite alternate;
        }

        .futuristic-name {
            color: #1c1d55; /* Púrpura eléctrico */
            text-shadow: 0 0 10px #c2c475, 0 0 20px #2c3824;
        }

        .futuristic-glow {
            position: absolute;
            top: -15px;
            left: -15px;
            right: -15px;
            bottom: -15px;
            background: radial-gradient(circle,
                rgba(8, 63, 63, 0.3) 0%,
                rgba(1, 5, 37, 0.3) 50%,
                rgba(0, 255, 255, 0.3) 100%);
            filter: blur(25px);
            z-index: 1;
            border-radius: 20px;
            animation: glow-pulse 3s infinite alternate;
        }

        /* Nuevo: Partículas CSS puras */
        .futuristic-particles {
            position: absolute;
            top: -15px;
            left: -15px;
            right: -15px;
            bottom: -15px;
            border-radius: 20px;
            overflow: hidden;
            z-index: 0;
        }

        .futuristic-particles::before,
        .futuristic-particles::after {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255, 215, 0, 0.5) 0px, transparent 2px),
                radial-gradient(circle at 80% 70%, rgba(16, 23, 87, 0.5) 0px, transparent 2px),
                radial-gradient(circle at 40% 10%, rgba(0, 255, 255, 0.5) 0px, transparent 2px),
                radial-gradient(circle at 60% 90%, rgba(235, 16, 16, 0.5) 0px, transparent 2px);
            background-size: 100px 100px;
            animation: particles-rotate 20s linear infinite;
            opacity: 0.7;
        }

        .futuristic-particles::after {
            background-image:
                radial-gradient(circle at 70% 20%, rgba(1, 17, 53, 0.5) 0px, transparent 2px),
                radial-gradient(circle at 30% 80%, rgba(0, 255, 255, 0.5) 0px, transparent 2px),
                radial-gradient(circle at 50% 50%, rgba(179, 148, 46, 0.055) 0px, transparent 2px),
                radial-gradient(circle at 90% 60%, rgba(7, 5, 26, 0.5) 0px, transparent 2px);
            animation: particles-rotate 15s linear infinite reverse;
        }

        /* Animaciones */
        @keyframes gradient-flow {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        @keyframes text-float {
            0%, 100% { transform: rotateX(5deg) translateY(0); }
            50% { transform: rotateX(5deg) translateY(-10px); }
        }

        @keyframes glow-pulse {
            0% { opacity: 0.6; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1.05); }
        }

        @keyframes pulse {
            0% { opacity: 0.7; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1.1); }
        }

        @keyframes particles-rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Efecto de destello adicional */
        .futuristic-flash {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(24, 23, 23, 0.8) 0%, transparent 10%);
            opacity: 0;
            z-index: 3;
            animation: flash-effect 4s infinite;
            pointer-events: none;
        }

        @keyframes flash-effect {
            0%, 100% { opacity: 0; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.5); }
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación para los elementos de tarjeta
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
            });

            setTimeout(() => {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.5s, transform 0.5s';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 200 * index);
                });
            }, 500);

            // Crear efecto de destello
            const flash = document.createElement('div');
            flash.className = 'futuristic-flash';
            document.querySelector('.futuristic-container').appendChild(flash);
        });
    </script>
@stop
