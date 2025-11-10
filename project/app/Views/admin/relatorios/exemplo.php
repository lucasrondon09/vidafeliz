<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Declaração de Escolaridade</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            background-color: #fff;
        }

        .page {
            border: 0px solid #000;
            box-sizing: border-box;
            padding: 40px 60px;
            max-width: 800px;
            height: 100vh; /* ocupa toda a altura visível da página */
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
            margin-top: 40px;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .indent {
            text-indent: 50px;
            text-align: justify;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .signature {
            text-align: right;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="page">
        <div class="header">
            <img src="<?= base_url('assets/dist/img/logo-relatorio.jpg')?>" alt="Logotipo da Escola" width="150">
            
        </div>

        <div class="content">
            <h2>DECLARAÇÃO DE ESCOLARIDADE</h2>

            <p class="indent">
                Declaro a quem possa interessar que, <strong>Lorenzo Miguel Gonçalves Miranda F</strong>, nascido(a) em <strong>01/01/2017</strong> — natural de <strong>Cuiabá-MT</strong>, filho(a) de <strong>Márcio Nathan Rocha Miranda</strong> e <strong>Stefany Gonçalves de Amorim</strong>, aluno(a) deste estabelecimento de ensino, cursando o <strong>3º ano do Ensino Fundamental I</strong> no período <strong>vespertino</strong>, no ano letivo de <strong>2025</strong>, encontra-se frequentando regularmente as aulas.
            </p>

            <p class="indent">
                Nada mais a declarar. Por ser expressão da verdade, firmo a presente.
            </p>
        </div>

        <p class="signature">
            Cuiabá, 16 de junho de 2025.
        </p>
    </div>

</body>
</html>
