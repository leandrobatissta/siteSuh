<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Screen Video Background</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajusta o vídeo para cobrir toda a tela */
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .instagram-boxes {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: center;
            flex-wrap: wrap; /* Permite que os itens quebrem para a linha seguinte se necessário */
        }

        .instagram-box {
            width: 300px;
            height: 400px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: all 0.3s ease; /* Animação suave ao redimensionar */
        }

        .instagram-box h2 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .instagram-box p {
            font-size: 0.9rem;
            color: #555;
        }

        .instagram-box img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Media query para telas pequenas (abaixo de 768px) */
        @media (max-width: 768px) {
            .instagram-box {
                width: 45%; /* Ajusta a largura para ocupar menos espaço */
                height: 300px;
            }

            .instagram-boxes {
                flex-wrap: wrap; /* Permite que os boxes quebrem para a linha seguinte em telas pequenas */
            }
        }

        /* Media query para telas muito pequenas (abaixo de 480px) */
        @media (max-width: 480px) {
            .instagram-box {
                width: 90%; /* Ajusta para ocupar quase toda a largura da tela */
                height: 250px;
            }

            .instagram-box h2 {
                font-size: 1rem;
            }

            .instagram-box p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Vídeo de fundo que ocupa toda a tela -->
    <video class="video-background" autoplay loop muted>
        <source src="suh.mov" type="video/mp4">
        Seu navegador não suporta a tag de vídeo.
    </video>

    <!-- Conteúdo centralizado sobre o vídeo -->
    <div class="content">
        <h1>Bem-vindo ao Meu Site</h1>
        <p>Este é um exemplo de um plano de fundo em vídeo em tela cheia.</p>

        <div class="instagram-boxes">
            <div class="instagram-box">
                <h2><a href="https://www.instagram.com/leandrobatissta/" target="_blank" style="color: inherit; text-decoration: none;">Leandro Batista</a></h2>
                <!-- Usando PHP para pegar uma imagem aleatória da pasta 'le' -->
                <img src="<?php 
                    // Seleciona um arquivo aleatório da pasta 'le'
                    $images = glob('le/*'); // Pega todos os arquivos na pasta 'le'
                    echo $images[array_rand($images)]; // Exibe uma imagem aleatória
                ?>" alt="Imagem de Leandro">
            </div>
            <div class="instagram-box">
                <h2><a href="https://www.instagram.com/arruda.su/" target="_blank" style="color: inherit; text-decoration: none;">Arruda Su</a></h2>
                <!-- Usando PHP para pegar uma imagem aleatória da pasta 'su' -->
                <img src="<?php 
                    // Seleciona um arquivo aleatório da pasta 'su'
                    $images = glob('su/*'); // Pega todos os arquivos na pasta 'su'
                    echo $images[array_rand($images)]; // Exibe uma imagem aleatória
                ?>" alt="Imagem de Arruda">
            </div>
        </div>
    </div>
</body>
</html>
