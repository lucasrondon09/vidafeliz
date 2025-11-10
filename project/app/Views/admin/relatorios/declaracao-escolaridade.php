
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Declaração de Escolaridade</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            background-color: #fff;
        }

        .page {
            padding: 40px 60px;
            max-width: 800px;
            margin: auto;
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
            margin-bottom: 80px;
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

<htmlpagefooter name="rodape">
    <div style="text-align: center;">
        <img src="<?= base_url('assets/dist/img/rodape_relatorio.png') ?>" style="width: 100%;">
    </div>
</htmlpagefooter>

<sethtmlpagefooter name="rodape" value="on" />

<?php if (!empty($alunos)): ?>
    <?php foreach ($alunos as $index => $aluno): ?>
        <div class="page" style="page-break-after: <?= ($index === array_key_last($alunos)) ? 'avoid' : 'always'; ?>;">
            <div class="header">
                <img src="<?= base_url('assets/dist/img/logo-relatorio.jpg') ?>" alt="Logotipo da Escola" width="150">
            </div>

            <div class="content">
                <h2>DECLARAÇÃO DE ESCOLARIDADE</h2>

                <p class="indent">
                    Declaro a quem possa interessar que, <strong><?= $aluno->nome ?? '--'; ?></strong>, nascido(a) em <strong><?= !empty($aluno->nascimento) ? date('d/m/Y', strtotime($aluno->nascimento)) : '--'; ?></strong> — natural de <strong><?= $aluno->naturalidade ?? '--'; ?></strong>, filho(a) de <strong><?= $aluno->mae_nome ?? '--'; ?></strong> e <strong><?= $aluno->pai_nome ?? '--'; ?></strong>, aluno(a) deste estabelecimento de ensino, cursando o <strong><?= $aluno->nome_turma ?? '--'; ?></strong>, no período <strong><?= !empty($aluno->turma_periodo) ? getPeriodos($aluno->turma_periodo) : '--'; ?></strong>, do ano letivo de <strong><?= $aluno->ano_letivo ?? '--'; ?></strong>, encontra-se frequentando regularmente as aulas.
                </p>

                <p class="indent">
                    Nada mais a declarar. Por ser expressão da verdade, firmo a presente.
                </p>

                <p class="signature">
                    Cuiabá-MT, <?= dataAtualExtenso(); ?>.
                </p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center; font-size: 18px;">Nenhum aluno encontrado.</p>
<?php endif; ?>

</body>
</html>
