<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ficha de Matrícula (2025)</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 10px;
      font-size: 14px;
    }
    .logo {
      text-align: center;
      margin-bottom: 5px;
    }
    .logo img {
      max-width: 150px;
      height: auto;
    }
    h2 {
      text-align: center;
      margin: 5px 0 10px;
      text-transform: uppercase;
      font-size: 16px;
    }
    h3 {
      margin: 10px 0 5px;
      font-size: 14px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }
    td, th {
      border: 1px solid #000;
      padding: 3px;
      vertical-align: top;
    }
    .foto-box {
      width: 113px;
      height: 151px;
      border: 1px solid #000;
      text-align: center;
      vertical-align: middle;
      line-height: 151px;
      font-size: 12px;
    }
    .assinatura {
      margin-top: 20px;
      text-align: center;
      font-size: 12px;
    }
  </style>
</head>
<body>

  <div class="logo">
    <img src="<?= base_url('/assets/dist/img/logo-relatorio.jpg')?>" alt="Logo da Escola" width="150" height="auto">
  </div>

  <h2>Ficha de Matrícula</h2>

  <table>
    <tr>
      <td colspan="4">Nome do Aluno (a):</td>
      <td rowspan="7" class="foto-box">FOTO</td>
    </tr>
    <tr>
      <td>Data de Nascimento:</td>
      <td>Idade:</td>
      <td>Sexo:</td>
      <td>Tipo Sanguíneo:</td>
    </tr>
    <tr>
      <td colspan="2">Série:</td>
      <td colspan="2">Período: ( ) Matutino &nbsp;&nbsp; ( ) Vespertino</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Doenças Crônicas:</strong> Bronquite ( ) Hipertensão ( ) Asma ( ) Diabetes ( )</td>
    </tr>
    <tr>
      <td colspan="4">Outros:</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Necessidades Especiais:</strong> Física ( ) Visual ( ) Auditiva ( ) Verbal ( )</td>
    </tr>
    <tr>
      <td colspan="4">Outros:</td>
    </tr>
    <tr>
      <td colspan="2">Plano de Saúde: ( ) Sim &nbsp;&nbsp; ( ) Não</td>
      <td colspan="3">Em caso de Emergência Comunicar: </td>
    </tr>
    <tr>
      <td colspan="5">Telefone para Contato Emergencial:</td>
    </tr>
  </table>

  <h3>Dados Familiares</h3>
  <table>
    <tr><td colspan="3">Nome do Pai:</td></tr>
    <tr><td>CPF:</td><td>RG:</td><td>Telefone:</td></tr>
    <tr><td>Profissão:</td><td colspan="2">E-mail:</td></tr>
    <tr><td colspan="3">Endereço: </td></tr>
    <tr><td colspan="3">Nome da Mãe:</td></tr>
    <tr><td>CPF:</td><td>RG:</td><td>Telefone:</td></tr>
    <tr><td>Profissão:</td><td colspan="2">E-mail:</td></tr>
    <tr><td colspan="3">Endereço: </td></tr>
  </table>

  <h3>Dados do Responsável Financeiro</h3>
  <table>
    <tr><td>Nome:</td><td>CPF:</td><td>Celular:</td></tr>
    <tr><td colspan="3">Endereço:</td></tr>
  </table>

  <h3>Responsáveis pela Retirada da Criança</h3>
  <table>
    <tr><td>1 - _____________________________________ Cel: _________________________</td></tr>
    <tr><td>2 - _____________________________________ Cel: _________________________</td></tr>
    <tr><td>3 - _____________________________________ Cel: _________________________</td></tr>
    <tr><td>4 - _____________________________________ Cel: _________________________</td></tr>
    <tr><td>5 - _____________________________________ Cel: _________________________</td></tr>
    <tr><td>6 - _____________________________________ Cel: _________________________</td></tr>
  </table>

  <div class="assinatura">
    <p>Cuiabá/MT, ______ de ______________ de _________</p><br>
    <p>_________________________________________________</p>
    <p>ASSINATURA DO RESPONSÁVEL</p>
  </div>

</body>
</html>
