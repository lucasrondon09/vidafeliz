<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ficha Individual</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 40px;
      color: #000;
    }

    .header {
            text-align: center;
    }

    .header img {
        width: 100px;
        margin-bottom: 10px;
    }

    .titulo {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 2px;
    }

    .subtitulo {
      text-align: center;
      font-size: 14px;
      margin-bottom: 20px;
    }

    .info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .info-table td {
      padding: 4px 8px;
      vertical-align: top;
      border: 1;
    }

    .info-label {
      font-weight: bold;
      
    }

    .dados-escolares {
      margin-bottom: 20px;
    }

    .notas-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }

    .notas-table th,
    .notas-table td {
      border: 1px solid #000;
      padding: 4px;
      text-align: center;
    }

    .legenda {
      font-size: 10px;
      margin-top: 10px;
    }

    .rodape {
      margin-top: 30px;
      font-size: 14px;
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

  <div class="header">
      <img src="<?= base_url('assets/dist/img/logo-relatorio.jpg') ?>" alt="Logotipo da Escola" width="150">
  </div>

  <table class="info-table" style="margin-top: 20px;">
  <tr>
    <td colspan="6"><b>Estabelecimento:</b> VIDA FELIZ ESCOLA</td></tr>
  <tr>
    <td colspan="1"><b>Criação:</b> <br> 29/10/2024</td>
    <td colspan="3"><b>Autorização:</b><br>Em trâmite processo nº 1925/2024</td>
    <td colspan="2"><b>Credenciamento:</b><br>Em trâmite processo 1924/2024</td>
  </tr>
  <tr><td colspan="4"><b>Endereço: </b> Rua sete, Quadra 01, Nº 15, CEP: 78.058-334</td><td colspan="2"><b>Fone:</b>(65) 9 9328-0039</td></tr>
  <tr><td colspan="6"><b>Aluno(a):</b> <?= strtoupper($aluno->nome); ?></td></tr>
  <tr>
    <td colspan="3"><b>Nascimento:</b> 
      <?= !empty($aluno->nascimento) ? date('d/m/Y', strtotime($aluno->nascimento)) : '--';?>
    </td>
    <td colspan="3"><b>Naturalidade/Estado:</b> <?= !empty($aluno->naturalidade) ? strtoupper($aluno->naturalidade) : '--';?></td>
  </tr>
  <tr><td colspan="3"><b>Pai:</b> <?= !empty($aluno->pai_nome) ? strtoupper($aluno->pai_nome) : '--';?></td><td colspan="3"><b>Mãe:</b> <?= !empty($aluno->mae_nome) ? strtoupper($aluno->mae_nome) : '--';?></td></tr>
</table>


  <div class="titulo">FICHA INDIVIDUAL</div>
  <div class="subtitulo"><?= strtoupper(getGrau($aluno->grau_turma))?></div>

  <table class="info-table dados-escolares">
    <tr>
      <td><strong>Turma:</strong> <?=  strtoupper($aluno->nome_turma)?></td>
      <td><strong>Turno:</strong> <?= strtoupper(getPeriodos($aluno->turma_periodo));?></td>
      <td><strong>Ano Letivo:</strong> <?= $aluno->ano_letivo?></td>
    </tr>
  </table>

  <table class="notas-table">
    <tr>
      <th rowspan="2">COMPONENTES CURRICULARES</th>
      <th colspan="2">1º BIM</th>
      <th colspan="2">2º BIM</th>
      <th colspan="2">3º BIM</th>
      <th colspan="2">4º BIM</th>
      <th rowspan="2">TF</th>
      <th rowspan="2">MA</th>
      <th rowspan="2">C.H</th>
    </tr>
    <tr>
      <th>N</th><th>F</th><th>N</th><th>F</th><th>N</th><th>F</th><th>N</th><th>F</th>
      
    </tr>
    <?php

                use App\Models\Admin\AlunosFaltasModel;
                use App\Models\Admin\AlunosNotasModel;

 foreach($disciplinas as $disciplina):?>
      
      <tr>
        <td class="text-uppercase"><?= strtoupper($disciplina->descricao) ?></td>
        <?php $nota = new AlunosNotasModel();?>
        <?php $falta = new AlunosFaltasModel();?>
        <?php $notaAluno = $nota->getNotas($id_turma, $id_aluno, $disciplina->id);?>
        <?php $faltaAluno = $falta->getFaltas($id_turma, $id_aluno, $disciplina->id);?>
        <?php for($x = 1; $x <= 4; $x++): ?>
          <td>
            <?php
              $mediaAnual = 0;
              $notaEncontrada = false;
              foreach($notaAluno as $notaAlunoItem):
                if($notaAlunoItem->bimestre == $x):
                    if(isset($notaAlunoItem->nota) && $notaAlunoItem->nota != null):
                    echo number_format($notaAlunoItem->nota, 1, ',', '');
                  else:
                    echo 'X';
                  endif;
                  $notaEncontrada = true;
                endif;
                $mediaAnual += $notaAlunoItem->nota/4;
              endforeach;
              if(!$notaEncontrada) echo 'X';
            ?>
          </td>
          <td>
            <?php
              $faltaEncontrada = false;
              $totalFaltas = 0;
              foreach($faltaAluno as $faltaAlunoItem):
                if($faltaAlunoItem->bimestre == $x):
                  if(isset($faltaAlunoItem->falta) && $faltaAlunoItem->falta != null):
                    echo $faltaAlunoItem->falta;
                  else:
                    echo 'X';
                  endif;
                  $faltaEncontrada = true;
                endif;
                $totalFaltas += $faltaAlunoItem->falta;
              endforeach;
              if(!$faltaEncontrada) echo 'X';
              ?>
          </td>
        <?php endfor; ?> 
        <td><?= !empty($totalFaltas) ? $totalFaltas : 'X';?></td>
        <td><?= !empty($mediaAnual) ? number_format($mediaAnual, 1, ',', '') : 'X';?></td>
        <td><?= $disciplina->carga_horaria?></td>
      </tr>
    <?php endforeach;?>  
    </table>

  <table class="info-table">
    <tr>
      <td colspan="5"><b>Obs:</b> <?= !empty($info->observacao) ? strtoupper($info->observacao) : '--' ?></td>
      <td colspan="1"><b>Res. Final:</b> <?= !empty($info->situacao) ? strtoupper($info->situacao) : '--'?></td>
    </tr>
    <tr>
      <td colspan="3"><b>Dias Letivos:</b> <?= $aluno->turma_dias_letivos;?> dias letivos</td>
      <td colspan="3"><b>Carga Horaria Anual:</b> <?= $aluno->turma_carga_horaria?></td>
    </tr>
  </table>

  <div class="legenda">
    <p><strong>LEGENDA:</strong> N – NOTA | F – FALTA | MB – MÉDIA BIMESTRAL | TF – TOTAL DE FALTAS | MA – MÉDIA ANUAL | C.H. – CARGA HORÁRIA</p>
  </div>

  <div class="rodape">
    
    <p>Cuiabá-MT, <?= dataAtualExtenso(); ?>.</p>
  </div>

</body>
</html>
