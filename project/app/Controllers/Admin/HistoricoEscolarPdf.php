<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\HistoricoEscolarModel;
use App\Models\Admin\HistoricoEscolarPeriodoModel;
use App\Models\Admin\HistoricoEscolarNotasModel;
use App\Models\Admin\ParametrosModel;

class HistoricoEscolarPdf extends Controller
{
    protected $historicoModel;
    protected $periodoModel;
    protected $notasModel;
    protected $parametrosModel;
    protected $session;

    //--------------------------------------------------------------------
    public function __construct()
    {
        helper('auth');
        helper('parametros');
        permission();
        permissionAdmin();

        $this->historicoModel = new HistoricoEscolarModel();
        $this->periodoModel = new HistoricoEscolarPeriodoModel();
        $this->notasModel = new HistoricoEscolarNotasModel();
        $this->parametrosModel = new ParametrosModel();
        $this->session = session();
    }

    //--------------------------------------------------------------------
    /**
     * Gerar PDF do histórico escolar completo
     */
    public function gerar($idHistorico)
    {
        // Buscar dados do histórico
        $historico = $this->historicoModel->getComAluno($idHistorico);

        if (!$historico) {
            $this->session->setFlashdata('alert', 'error');
            $this->session->setFlashdata('message', 'Histórico não encontrado!');
            return redirect()->to(base_url('Admin/HistoricoEscolar'));
        }

        // Buscar períodos
        $periodos = $this->periodoModel->getByHistorico($idHistorico);

        // Buscar notas de cada período
        foreach ($periodos as &$periodo) {
            $periodo->notas = $this->notasModel->getByPeriodo($periodo->id);
        }

        // Buscar parâmetros da escola
        $parametros = $this->parametrosModel;       
        // Gerar HTML do histórico
        $html = $this->gerarHtmlHistorico($historico, $periodos, $parametros);

        // Gerar PDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 5,
            'margin_footer' => 5
        ]);

        $mpdf->WriteHTML($html);

        $nomeArquivo = 'Historico_Escolar_' . $historico->nome_aluno . '.pdf';
        $mpdf->Output($nomeArquivo, 'I'); // I = inline (abrir no navegador)
        exit;
    }

    //--------------------------------------------------------------------
    /**
     * Gerar HTML do histórico baseado no modelo fornecido
     */
    private function gerarHtmlHistorico($historico, $periodos, $parametros)
    {
        // Preparar dados das disciplinas
        $disciplinas = $this->prepararDisciplinas($periodos);

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 9pt;
                }
                .cabecalho {
                    text-align: center;
                    margin-bottom: 10px;
                }
                .cabecalho h2 {
                    margin: 5px 0;
                    font-size: 14pt;
                    font-weight: bold;
                }
                .cabecalho h3 {
                    margin: 3px 0;
                    font-size: 11pt;
                }
                .info-escola {
                    font-size: 8pt;
                    line-height: 1.4;
                }
                .info-aluno {
                    margin: 10px 0;
                    font-size: 9pt;
                }
                .info-aluno strong {
                    font-weight: bold;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 10px 0;
                    font-size: 7pt;
                }
                table, th, td {
                    border: 1px solid #000;
                }
                th {
                    background-color: #f0f0f0;
                    padding: 3px;
                    text-align: center;
                    font-weight: bold;
                }
                td {
                    padding: 2px 3px;
                    text-align: center;
                }
                .disciplina-nome {
                    text-align: left;
                    padding-left: 5px;
                }
                .periodos-table {
                    margin-top: 10px;
                }
                .periodos-table td {
                    text-align: left;
                    padding: 3px 5px;
                }
                .legenda {
                    font-size: 8pt;
                    margin: 10px 0;
                }
                .assinaturas {
                    margin-top: 30px;
                    font-size: 9pt;
                    width: 100%;
                }

                .assinaturas .linha-data {
                    text-align: left;
                    margin-bottom: 40px;
                }

                .assinaturas-container {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    width: 100%;
                }

                .assinatura-bloco {
                    width: 45%;
                    text-align: center;
                }

                .linha-assinatura {
                    border-top: 1px solid #000;
                    margin-top: 5px;
                    padding-top: 3px;
                }

            </style>
        </head>
        <body>';

        // CABEÇALHO
        $html .= '
            <div class="cabecalho">
                <img src="' . base_url('assets/admin/dist/img/secretaria-digital-logo.png') . '" alt="Logo da Escola" style="height: 110px;"><br>
                <h2>' . mb_strtoupper($parametros->nome ?? 'VIDA FELIZ ESCOLA', 'UTF-8') . '</h2>
                <h3>HISTÓRICO ESCOLAR – ENSINO FUNDAMENTAL</h3>
                <div class="info-escola">
                    <strong>Estabelecimento:</strong> ' . mb_strtoupper($parametros->nome ?? 'VIDA FELIZ ESCOLA', 'UTF-8') . '<br>
                    <strong>Endereço:</strong> ' . ($parametros->endereco ?? 'Rua sete, Lote 15 Quadra 01') . ' | 
                    <strong>Bairro:</strong> ' . ($parametros->bairro ?? 'Morada da Serra') . ' | 
                    <strong>CEP:</strong> ' . ($parametros->cep ?? '78.058-334') . '<br>
                    <strong>Telefone:</strong> ' . ($parametros->telefone ?? '(65) 9 9328-0039') . ' |
                    <strong>Email:</strong> ' . ($parametros->email ?? 'Vidafeliz@gmail.com.br') . '<br>
                    <strong>Município:</strong> ' . ($parametros->cidade ?? 'Cuiabá') . ' – ' . ($parametros->estado ?? 'MT') . ' |
                    <strong>CNPJ:</strong> ' . ($parametros->cnpj ?? '52.060.409/0001-05') . '<br>
                    <strong>Criação:</strong> ' . ($parametros->data_criacao ?? '29/10/2024') . ' | 
                    <strong>Autorização:</strong> ' . ($parametros->autorizacao ?? 'em trâmite processo nº 1925/2024') . ' | 
                    <strong>Credenciamento:</strong> ' . ($parametros->credenciamento ?? 'em trâmite processo 1924/2024') . '
                </div>
            </div>';

        // INFORMAÇÕES DO ALUNO
        $dataNascimento = $historico->data_nascimento ? date('d/m/Y', strtotime($historico->data_nascimento)) : '-';
        $html .= '
            <div class="info-aluno">
                <strong>Aluno(a):</strong> ' . mb_strtoupper($historico->nome_aluno, 'UTF-8') . ' 
                <strong>Data de Nascimento:</strong> ' . $dataNascimento . '<br>
                <strong>Município/UF:</strong> ' . mb_strtoupper($historico->naturalidade ?? 'CUIABÁ-MT', 'UTF-8') . ' 
                <strong>Nacionalidade:</strong> ' . mb_strtoupper($historico->nacionalidade ?? 'BRASILEIRA', 'UTF-8') . '<br>
                <strong>Pai:</strong> ' . mb_strtoupper($historico->nome_pai ?? '-', 'UTF-8') . ' 
                <strong>Mãe:</strong> ' . mb_strtoupper($historico->nome_mae ?? '-', 'UTF-8') . '
            </div>';

        // TABELA DE DISCIPLINAS E NOTAS
        $html .= $this->gerarTabelaNotas($disciplinas, $periodos);

        // TABELA DE PERÍODOS
        $html .= $this->gerarTabelaPeriodos($periodos);

        // LEGENDAS E OBSERVAÇÕES
        $html .= '
            <div class="legenda">
                <strong>Legenda:</strong> N - Nota / CH - Carga Horária / APR - Aprovado / REP - Reprovado / 
                PS - Plenamente Satisfatório / EC - Em Construção<br>';

        if ($historico->observacao_geral) {
            $html .= '<strong>OBS:</strong> ' . mb_strtoupper($historico->observacao_geral, 'UTF-8') . '<br>';
        }

        $html .= '
            </div>';

        // DATA E ASSINATURAS
        $dataAtual = date('d') . ' de ' . $this->mesExtenso(date('m')) . ' de ' . date('Y');
       $html .= '
<div class="assinaturas">
    <p style="text-align: left; margin-bottom: 60px;">' . ($parametros->cidade ?? 'Cuiabá') . ', ' . $dataAtual . '.</p>

    <table style="width: 100%; border: none; border-collapse: collapse; margin-top: 60px;">
        <tr>
            <!-- Assinatura 1 -->
            <td style="width: 40%; text-align: center; border: none; vertical-align: top;">
                <div style="display: inline-block; text-align: center;">
                    <hr style="width: 180px; border: 1px solid #000; margin: 0 auto 5px auto;">
                    '.($parametros->get('SECRETARIA_NOME')).'<br>
                    RG: '.($parametros->get('SECRETARIA_RG')).'<br>
                    Secretário(a)
                </div>
            </td>
            <td style="width: 20%; border: none;"></td>
            <!-- Assinatura 2 -->
            <td style="width: 40%; text-align: center; border: none; vertical-align: top;">
                <div style="display: inline-block; text-align: center;">
                    <hr style="width: 180px; border: 1px solid #000; margin: 0 auto 5px auto;">
                    '.($parametros->get('DIRETOR_NOME')).'<br>
                    RG: '.($parametros->get('SECRETARIA_RG')).'<br>
                    Diretor(a)
                </div>
            </td>
        </tr>
    </table>
</div>';






        $html .= '
        </body>
        </html>';

        return $html;
    }

    //--------------------------------------------------------------------
    /**
     * Preparar estrutura de disciplinas com notas de todos os períodos
     */
    private function prepararDisciplinas($periodos)
    {
        $disciplinas = [];

        foreach ($periodos as $periodo) {
            if (!empty($periodo->notas)) {
                foreach ($periodo->notas as $nota) {
                    $disciplinaId = $nota->id_historico_disciplina;

                    if (!isset($disciplinas[$disciplinaId])) {
                        $disciplinas[$disciplinaId] = [
                            'nome' => $nota->disciplina,
                            'notas' => []
                        ];
                    }

                    $disciplinas[$disciplinaId]['notas'][$periodo->ordem] = [
                        'nota' => $nota->nota,
                        'carga_horaria' => $nota->carga_horaria ?? '-'
                    ];
                }
            }
        }

        return $disciplinas;
    }

    //--------------------------------------------------------------------
    /**
     * Gerar tabela de notas
     */
    private function gerarTabelaNotas($disciplinas, $periodos)
    {
        $maxPeriodos = 9; // 1º ao 9º ano

        $html = '<table>';

        // Cabeçalho
        $html .= '<thead><tr><th rowspan="2" style="width: 25%;">DISCIPLINAS</th>';

        for ($i = 1; $i <= $maxPeriodos; $i++) {
            $html .= '<th colspan="2">' . $i . 'º ANO</th>';
        }

        $html .= '</tr><tr>';

        for ($i = 1; $i <= $maxPeriodos; $i++) {
            $html .= '<th style="width: 4%;">N</th><th style="width: 4%;">CH</th>';
        }

        $html .= '</tr></thead><tbody>';

        // Linhas de disciplinas
        foreach ($disciplinas as $disciplina) {
            $html .= '<tr>';
            $html .= '<td class="disciplina-nome">' . $disciplina['nome'] . '</td>';

            for ($i = 1; $i <= $maxPeriodos; $i++) {
                if (isset($disciplina['notas'][$i])) {
                    $html .= '<td>' . ($disciplina['notas'][$i]['nota'] ?? '---') . '</td>';
                    $html .= '<td>' . ($disciplina['notas'][$i]['carga_horaria'] ?? '---') . '</td>';
                } else {
                    $html .= '<td>---</td><td>---</td>';
                }
            }

            $html .= '</tr>';
        }

        // Linha de Resultado Final
        $html .= '<tr>';
        $html .= '<td class="disciplina-nome"><strong>Resultado Final</strong></td>';

        for ($i = 1; $i <= $maxPeriodos; $i++) {
            $resultado = '-----';
            foreach ($periodos as $periodo) {
                if ($periodo->ordem == $i) {
                    $resultado = strtoupper(substr($periodo->resultado, 0, 3));
                    break;
                }
            }
            $html .= '<td colspan="2"><strong>' . $resultado . '</strong></td>';
        }

        $html .= '</tr>';

        // Linha de Total de Horas
        $html .= '<tr>';
        $html .= '<td class="disciplina-nome"><strong>Total Horas</strong></td>';

        for ($i = 1; $i <= $maxPeriodos; $i++) {
            $cargaTotal = '-----';
            foreach ($periodos as $periodo) {
                if ($periodo->ordem == $i && $periodo->carga_horaria_total) {
                    $cargaTotal = $periodo->carga_horaria_total;
                    break;
                }
            }
            $html .= '<td colspan="2"><strong>' . $cargaTotal . '</strong></td>';
        }

        $html .= '</tr>';

        $html .= '</tbody></table>';

        return $html;
    }

    //--------------------------------------------------------------------
    /**
     * Gerar tabela de períodos (estabelecimentos)
     */
    private function gerarTabelaPeriodos($periodos)
    {
        $html = '<table class="periodos-table">';
        $html .= '<thead><tr>';
        $html .= '<th style="width: 15%;">Ano/Séries</th>';
        $html .= '<th style="width: 55%;">Estabelecimento</th>';
        $html .= '<th style="width: 10%;">Ano</th>';
        $html .= '<th style="width: 20%;">Município/UF</th>';
        $html .= '</tr></thead><tbody>';

        $maxPeriodos = 9;

        for ($i = 1; $i <= $maxPeriodos; $i++) {
            $html .= '<tr>';
            $html .= '<td>' . $i . 'º ANO</td>';

            $encontrou = false;
            foreach ($periodos as $periodo) {
                if ($periodo->ordem == $i) {
                    $html .= '<td>' . mb_strtoupper($periodo->estabelecimento ,'UTF-8') . '</td>';
                    $html .= '<td>' . $periodo->ano_letivo . '</td>';
                    $html .= '<td>' . mb_strtoupper($periodo->municipio, 'UTF-8') . '/' . mb_strtoupper($periodo->uf, 'UTF-8') . '</td>';
                    $encontrou = true;
                    break;
                }
            }

            if (!$encontrou) {
                $html .= '<td>---</td><td>---</td><td>---</td>';
            }

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        return $html;
    }

    //--------------------------------------------------------------------
    /**
     * Converter número do mês para nome por extenso
     */
    private function mesExtenso($mes)
    {
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        return $meses[$mes] ?? '';
    }
}
