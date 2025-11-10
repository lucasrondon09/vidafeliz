<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ficha Avaliativa Individual</title>

  <style>
    body{
      font-family: Arial, sans-serif;
      width: 100%;
      border-collapse: collapse;
    }

    .content-table{
      font-size: 6pt;
    }

    table th{
      background-color:#e2e2e2;
    }

      .page {
          margin: auto;
      }

      .header {
          text-align: center;
      }

      .header img {
          width: 100px;
          margin-bottom: 10px;
      }
  </style>
</head>
<body>
  <htmlpagefooter name="rodape">
    <div style="text-align: center;">
        <img src="<?= base_url('assets/dist/img/rodape_relatorio.png') ?>" style="width: 100%;">
    </div>
  </htmlpagefooter>
<?php if (!empty($alunos)):?>
  <?php foreach ($alunos as $index => $aluno): ?>
    <?php $bimestres = (new \App\Models\Admin\AvaliacaoIndividualAlunoTurmaModel())->getBimestres($aluno->id_aluno, $turma->id);?>
    <?php if(!empty($bimestres)):?>
      <?php foreach($bimestres as $bimestre):?>
      <sethtmlpagefooter name="rodape" value="on" />
      <div class="page" style="page-break-after: <?= (@$index === array_key_last(@$alunos)) ? 'avoid' : 'always'; ?>;">
        <div class="header">
            <img src="<?= base_url('assets/dist/img/logo-relatorio.jpg') ?>" alt="Logotipo da Escola" width="150">
        </div>
        <h3>FICHA AVALIATIVA INDIVIDUAL | <?= $bimestre->bimestre?>º BIMESTRE</h3>

        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 50%;">Professor(a): <?= @$professor->nome?></td>
            <td>Auxiliar: <?= @$auxiliar->nome?></td>
          </tr>
          <tr>
            <td style="width: 50%;">Aluno(a): <?= $aluno->nome?></td>
            <td>Período: <?= $turma->nome.' - '.getPeriodos($turma->periodo)?></td>
          </tr>
        </table>

        <?php if(!empty($avaliacoes)):?>
          <?php $itens= 0; $fechaTable = 0; $categoria = 0;?>
          <table style="margin-top: 10px; width: 100%;" class="content-table">
              <tr valign="top" style="vertical-align: top;">
                <td style="width: 50%; vertical-align: top;">
                  <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                  <?php foreach($avaliacoes as $avaliacao):?>
                    <?php $avaliacaoAluno = (new \App\Models\Admin\AvaliacaoIndividualAlunoTurmaModel())->getResposta($aluno->id_aluno, $turma->id, $avaliacao->id, $bimestre->bimestre)?>
                    <?php if($avaliacao->categoria != $categoria):?>
                    <tr><th style="width: 50%;" align="left"><?= getCategoriaAvaliacaoIndividual($avaliacao->categoria)?></th><th align="center">Não</th><th align="center">Parcial</th><th align="center">Sim</th></tr>
                    <?php endif;?>
                    <tr>
                      <td style="width: 50%;"><?= $avaliacao->descricao?></td>
                      <td align="center"><?= @$avaliacaoAluno->resposta == 'n' ? 'X' :'';?></td><td align="center"><?= @$avaliacaoAluno->resposta == 'p' ? 'X' :'';?></td><td align="center"><?= @$avaliacaoAluno->resposta == 's' ? 'X' :'';?></td>
                    </tr>
                  <?php if($itens >= 25):?>
                  </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                  <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;"> 
                    <?php if($avaliacao->categoria != $categoria):?>
                    <tr><th style="width: 50%;" align="left"><?= getCategoriaAvaliacaoIndividual($avaliacao->categoria)?></th><th align="center">Não</th><td align="center">Parcial</th><th align="center">Sim</th></tr>
                    <?php endif;?>
                    <tr>
                      <td style="width: 50%;"><?= $avaliacao->descricao?></td>
                      <td align="center"><?= @$avaliacaoAluno->resposta == 'n' ? 'X' :'';?></td><td align="center"><?= @$avaliacaoAluno->resposta == 'p' ? 'X' :'';?></td><td align="center"><?= @$avaliacaoAluno->resposta == 's' ? 'X' :'';?></td>
                    </tr>
                  <?php $itens = 0; $fechaTable = 1;?>  
                  <?php endif;?>  
            <?php $itens += 1; $categoria = $avaliacao->categoria;?>  
          <?php endforeach;?> 
          <?php if($fechaTable == 1):?>
            </table>
            </td>
          <?php endif;?> 
          </tr>
          </table>

        <?php endif;?>  
        
        <br>
        <p>____________________________________</p>
        <p>Responsável</p>
      </div>
      <?php endforeach;?>
      <?php endif;?>
  <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center; font-size: 18px;">Nenhum aluno encontrado.</p>
<?php endif; ?>
</body>
</html>