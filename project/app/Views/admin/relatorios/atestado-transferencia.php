<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atestado de Transferência</title>
    <style>
        @page {
            margin-top: 180px;
            margin-bottom: 150px;
            margin-left: 40px;
            margin-right: 40px;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        
        /* Cabeçalho fixo */
        header {
            position: fixed;
            top: -180px;
            left: 0;
            right: 0;
            height: 150px;
            text-align: center;
        }
        
        header img {
            max-width: 100%;
            height: auto;
            max-height: 150px;
        }
        
        /* Rodapé fixo */
        footer {
            position: fixed;
            bottom: -150px;
            left: 0;
            right: 0;
            height: 120px;
            text-align: center;
        }
        
        footer img {
            max-width: 100%;
            height: auto;
            max-height: 120px;
        }
        
        /* Conteúdo principal */
        .content {
            text-align: justify;
            padding: 20px 0;
        }
        
        h1 {
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 40px;
            text-transform: uppercase;
        }
        
        .texto-atestado {
            margin-bottom: 30px;
            text-indent: 50px;
        }
        
        .assinatura {
            margin-top: 80px;
            text-align: center;
        }
        
        .linha-assinatura {
            border-top: 1px solid #000;
            width: 300px;
            margin: 0 auto 5px auto;
        }
        
        .data-local {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 60px;
        }
        
        strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho com imagem -->
    <header>
        <?php 
        $caminhoImagem = FCPATH . 'assets/img.png';
        if (file_exists($caminhoImagem)) {
            $imagemBase64 = base64_encode(file_get_contents($caminhoImagem));
            echo '<img src="data:image/png;base64,' . $imagemBase64 . '" alt="Cabeçalho">';
        }
        ?>
    </header>

    <!-- Rodapé com imagem -->
    <footer>
        <?php 
        // Usando a mesma imagem para rodapé, você pode criar uma imagem específica se necessário
        if (file_exists($caminhoImagem)) {
            echo '<img src="data:image/png;base64,' . $imagemBase64 . '" alt="Rodapé">';
        }
        ?>
    </footer>

    <!-- Conteúdo do atestado -->
    <div class="content">
        <h1>Atestado de Transferência</h1>
        
        <p class="texto-atestado">
            Atesto para os devidos fins de matrícula que <strong><?= strtoupper($aluno->nome ?? 'NOME DO ALUNO') ?></strong> esteve 
            matriculado(a) neste estabelecimento de ensino no <strong><?= strtoupper($turma_atual) ?></strong> – Ano letivo <strong><?= $ano_letivo ?></strong> considerado(a) 
            <strong>CURSANDO(A)</strong>.
        </p>
        
        <p class="texto-atestado">
            O aluno(a) está apto(a) a cursar o <strong><?= strtoupper($turma_transferencia) ?></strong> da Educação Infantil.
        </p>
        
        <p class="texto-atestado">
            Por ser verdade, firmo o presente.
        </p>
        
        <div class="data-local">
            Cuiabá, <?= strftime('%d de %B de %Y', strtotime('today')) ?>.
        </div>
        
        <div class="assinatura">
            <div class="linha-assinatura"></div>
            <p><strong>Secretaria Escolar</strong></p>
        </div>
    </div>
</body>
</html>
