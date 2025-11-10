<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Avaliação Individual</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 10pt;
    }

    .container {
      width: 100%;
      padding: 10mm;
      box-sizing: border-box;
    }

    .header {
      text-align: center;
      font-size: 14pt;
      margin-bottom: 10px;
    }

    .info {
      margin-bottom: 10px;
    }

    .info p {
      margin: 2px 0;
    }

    .columns {
      width: 100%;
      overflow: hidden;
    }

    .column {
      float: left;
      width: 45%;
      padding-right: 5px;
      box-sizing: border-box;
    }

    h3 {
      text-align: center;
      background: #f0f0f0;
      margin: 5px 0;
      font-size: 11pt;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
      font-size: 9pt;
      page-break-inside: avoid;
    }

    th, td {
      border: 1px solid #000;
      padding: 3px;
      text-align: center;
      vertical-align: middle;
    }

    td.label {
      text-align: left;
    }

    .assinatura {
      margin-top: 20px;
      clear: both;
      page-break-inside: avoid;
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

<div class="container">
  <div class="header">FICHA AVALIATIVA INDIVIDUAL</div>

  <div class="info">
    <p><strong>Professor(a):</strong> ANDRIENY</p>
    <p><strong>Auxiliar:</strong> ____________________________________________</p>
    <p><strong>Aluno(a):</strong> ____________________________________________</p>
    <p><strong>Período:</strong> Pré-II MATUTINO</p>
  </div>

  <div class="columns">
    <div class="column">
      <h3>Aspectos Físicos</h3>
      <table>
        <!-- linhas da tabela física -->
        <tr><th>Critério</th><th>Não</th><th>Parcial</th><th>Sim</th></tr>
        <tr><td class="label">Respeita limite da folha e desenho</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Tem equilíbrio e agilidade</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Se expressa corporalmente</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Brinca e interage</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Coordenação motora grossa</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Coordenação motora fina</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Lateralidade definida</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Orientação espacial</td><td></td><td></td><td></td></tr>
      </table>
      <h3>Aspectos Sociais</h3>
      <table>
        <!-- linhas da tabela social -->
        <tr><th>Critério</th><th>Não</th><th>Parcial</th><th>Sim</th></tr>
        <tr><td class="label">Respeita regras e combinados</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Trabalha em equipe</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Ajuda nas tarefinhas dos adultos</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Compartilha brinquedos</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Tem consciência do eu/você/nós</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Manifesta opiniões</td><td></td><td></td><td></td></tr>
      </table>
    </div>

    <div class="column">
      <h3>Aspectos Cognitivos</h3>
      <table>
        <!-- linhas da tabela cognitiva -->
        <tr><th>Critério</th><th>Não</th><th>Parcial</th><th>Sim</th></tr>
        <tr><td class="label">Comunica-se com clareza</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Compara objetos</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Constrói com blocos/cubos</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Ouve histórias atentamente</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Reconta histórias com coerência</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Canta músicas inteiras</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Acompanha ritmos</td><td></td><td></td><td></td></tr>
      </table>
      <h3>Habilidades Linguísticas</h3>
      <table>
        <!-- linhas da tabela linguística -->
        <tr><th>Critério</th><th>Não</th><th>Parcial</th><th>Sim</th></tr>
        <tr><td class="label">Usa pronomes eu/você</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Frases com várias palavras</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Identifica e traça vogais</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Palavras com vogais A/E/I/O/U</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Identifica e escreve nome</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Compreende cantigas</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Identifica alimentos, animais</td><td></td><td></td><td></td></tr>
      </table>
    </div>

    <div class="column">
      <h3>Habilidades Matemáticas</h3>
      <table>
        <!-- linhas da tabela matemática -->
        <tr><th>Critério</th><th>Não</th><th>Parcial</th><th>Sim</th></tr>
        <tr><td class="label">Numerais 1 a 5</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Contagem oral</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Agrupamentos 1 a 5</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Relaciona número/quantidade</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Sequências</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Cores, igual/diferente</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Grande/pequeno, rápido/lento</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Formas geométricas</td><td></td><td></td><td></td></tr>
        <tr><td class="label">Textura, sombra, tamanho</td><td></td><td></td><td></td></tr>
      </table>
    </div>
  </div>

  <div class="assinatura">
    <p><strong>Responsável:</strong> ____________________________________________</p>
  </div>
</div>

</body>
</html>