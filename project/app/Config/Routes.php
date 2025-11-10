<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

//Site
//-------------------------------------------------------------------------
$routes->add('/', 'Site\Home::index');

//Admin - Start Site
//-------------------------------------------------------------------------
$routes->add('/Admin/home', 'Admin\Home::index');
$routes->add('/Admin/home/editar-empresa', 'Admin\Home::editarEmpresa');
$routes->add('/Admin/sobre', 'Admin\Home::sobre');
$routes->add('/Admin', 'Admin\Auth::index');
//-------------------------------------------------------------------------
$routes->add('/Admin/Relatorios', 'Admin\Relatorios::index');
$routes->add('/Admin/Relatorios/testePdfSimples', 'Admin\Relatorios::testePdfSimples');
$routes->add('/Admin/Relatorios/gerarRelatorio', 'Admin\Relatorios::gerarRelatorio');
$routes->add('/Admin/Relatorios/getAlunosPorTurma/(:num)', 'Admin\Relatorios::getAlunosPorTurma/$1');
$routes->add('/Admin/Relatorios/gerarPdf', 'Admin\Relatorios::gerarPdf');
$routes->add('/Admin/Relatorios/declaracao-escolaridade/(:num)', 'Admin\Relatorios::declaracaoEscolaridade/$1');
$routes->add('/Admin/Relatorios/declaracao-escolaridade/(:num)/(:num)', 'Admin\Relatorios::declaracaoEscolaridade/$1/$2');
$routes->add('/Admin/Relatorios/ficha-matricula/(:num)', 'Admin\Relatorios::fichaMatricula/$1');
$routes->add('/Admin/Relatorios/ficha-matricula/(:num)/(:num)', 'Admin\Relatorios::fichaMatricula/$1/$2');
$routes->add('/Admin/Relatorios/ficha-individual/(:num)/(:num)', 'Admin\Relatorios::fichaIndividual/$1/$2');
//-------------------------------------------------------------------------
$routes->add('/Admin/Parametros', 'Admin\Parametros::index');
$routes->add('/Admin/Parametros/cadastrar', 'Admin\Parametros::create');
$routes->add('/Admin/Parametros/editar/(:num)', 'Admin\Parametros::update/$1');
$routes->add('/Admin/Parametros/visualizar/(:num)', 'Admin\Parametros::read/$1');
$routes->add('/Admin/Parametros/excluir/(:num)', 'Admin\Parametros::delete/$1');
$routes->add('/Admin/Ano-Letivo', 'Admin\Parametros::anoLetivo');
$routes->add('/Admin/Ano-Letivo/editar', 'Admin\Parametros::setAnoLetivo');
//-------------------------------------------------------------------------
$routes->add('/Admin/Usuarios', 'Admin\Usuarios::index');
$routes->add('/Admin/Usuarios/cadastrar', 'Admin\Usuarios::create');
$routes->add('/Admin/Usuarios/editar/(:num)', 'Admin\Usuarios::update/$1');
$routes->add('/Admin/Usuarios/visualizar/(:num)', 'Admin\Usuarios::read/$1');
$routes->add('/Admin/Usuarios/excluir/(:num)', 'Admin\Usuarios::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Turmas', 'Admin\Turmas::index');
$routes->add('/Admin/Turmas/cadastrar', 'Admin\Turmas::create');
$routes->add('/Admin/Turmas/lancar-notas/(:num)', 'Admin\Turmas::lancarNotas/$1');
$routes->add('/Admin/Turmas/lancar-notas-alunos/(:num)/(:num)', 'Admin\Turmas::lancarNotasAlunos/$1/$2');
$routes->add('/Admin/Turmas/lancar-notas-alunos/salvar', 'Admin\Turmas::salvarNotasAlunos');
$routes->add('/Admin/Turmas/avaliacao-individual/(:num)', 'Admin\Turmas::avaliacaoIndividual/$1');
$routes->add('/Admin/Turmas/avaliacao-individual/salvar-professor', 'Admin\Turmas::avaliacaoIndividualProfessor/$1');
$routes->add('/Admin/Turmas/avaliacao-individual/excluir-professor/(:num)/(:num)', 'Admin\Turmas::avaliacaoIndividualProfessorExcluir/$1/$2');
$routes->add('/Admin/Turmas/avaliacao-individual/excluir-auxiliar/(:num)/(:num)', 'Admin\Turmas::avaliacaoIndividualAuxiliarExcluir/$1/$2');
$routes->add('/Admin/Turmas/avaliacao-individual-aluno/(:num)/(:num)/(:num)', 'Admin\Turmas::avaliacaoIndividualAluno/$1/$2/$3');
$routes->add('/Admin/Turmas/avaliacao-individual-aluno-salvar', 'Admin\Turmas::salvarAvaliacaoIndividual');
$routes->add('/Admin/Turmas/disciplinas/(:num)', 'Admin\Turmas::disciplinasTurmas/$1');
$routes->add('/Admin/Turmas/disciplinas/incluir-disciplina', 'Admin\Turmas::incluirDisciplina');
$routes->add('/Admin/Turmas/disciplinas/excluir-disciplina/(:num)', 'Admin\Turmas::excluirDisciplina/$1');
$routes->add('/Admin/Turmas/professores/(:num)', 'Admin\Turmas::professoresTurmas/$1');
$routes->add('/Admin/Turmas/professores/incluir-professor', 'Admin\Turmas::incluirProfessor');
$routes->add('/Admin/Turmas/professores/remover-professor/(:num)/(:num)/(:num)', 'Admin\Turmas::removerProfessor/$1/$2/$3');
$routes->add('/Admin/Turmas/professores/excluir/(:num)', 'Admin\Turmas::excluirProfessor/$1');
$routes->add('/Admin/Turmas/alunos/(:num)', 'Admin\Turmas::alunosTurmas/$1');
$routes->add('/Admin/Turmas/alunos/incluir', 'Admin\Turmas::incluirAluno');
$routes->add('/Admin/Turmas/alunos/transferir/(:num)/(:num)', 'Admin\Turmas::transferirAluno/$1/$2');
$routes->add('/Admin/Turmas/alunos/info-complementares/(:num)/(:num)', 'Admin\Turmas::infoComplementarAluno/$1/$2');
$routes->add('/Admin/Turmas/editar/(:num)', 'Admin\Turmas::update/$1');
$routes->add('/Admin/Turmas/visualizar/(:num)', 'Admin\Turmas::read/$1');
$routes->add('/Admin/Turmas/excluir/(:num)', 'Admin\Turmas::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Autenticacao/login', 'Admin\Auth::index');
$routes->post('/Admin/Autenticacao/login', 'Admin\Auth::login');
$routes->add('/Admin/Autenticacao/logout', 'Admin\Auth::logout');
//-------------------------------------------------------------------------
$routes->add('/Admin/Pais', 'Admin\Pais::index');
$routes->add('/Admin/Pais/cadastrar', 'Admin\Pais::create');
$routes->get('/Admin/Pais/visualizar/(:num)', 'Admin\Pais::read/$1');
$routes->add('/Admin/Pais/editar/(:num)', 'Admin\Pais::update/$1');
$routes->add('/Admin/Pais/excluir/(:num)', 'Admin\Pais::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Alunos', 'Admin\Alunos::index');
$routes->add('/Admin/Alunos/(:num)', 'Admin\Alunos::index/$1');
$routes->add('/Admin/Alunos/cadastrar/(:num)', 'Admin\Alunos::create/$1');
$routes->get('/Admin/Alunos/visualizar/(:num)', 'Admin\Alunos::read/$1');
$routes->get('/Admin/Alunos/visualizar/(:num)/(:num)', 'Admin\Alunos::read/$1/$2');
$routes->add('/Admin/Alunos/editar/(:num)', 'Admin\Alunos::update/$1');
$routes->add('/Admin/Alunos/editar/(:num)/(:num)', 'Admin\Alunos::update/$1/$2');
$routes->add('/Admin/Alunos/excluir/(:num)', 'Admin\Alunos::delete/$1');
$routes->add('/Admin/Alunos/cancelar-matricula/(:num)', 'Admin\Alunos::cancelarMatricula/$1');
$routes->add('/Admin/Alunos/historico-escolar/(:num)', 'Admin\Alunos::historicoEscolar/$1');
$routes->add('/Admin/Alunos/historico-escolar/cadastrar/(:num)', 'Admin\Alunos::historicoEscolarCreate/$1');
$routes->add('/Admin/Alunos/historico-escolar/visualizar/(:num)', 'Admin\Alunos::historicoEscolarRead/$1');
$routes->add('/Admin/Alunos/historico-escolar/editar/(:num)', 'Admin\Alunos::historicoEscolarUpdate/$1');
$routes->add('/Admin/Alunos/historico-escolar/excluir/(:num)', 'Admin\Alunos::historicoEscolarDelete/$1');
$routes->add('/Admin/Alunos/historico-escolar/set-create/(:num)', 'Admin\Alunos::historicoEscolarSetCreate/$1');
$routes->add('/Admin/Alunos/historico-escolar/disciplinas-notas/(:num)', 'Admin\Alunos::historicoEscolarNotas/$1');
$routes->add('/Admin/Alunos/historico-escolar/disciplinas-notas/cadastrar/(:num)', 'Admin\Alunos::historicoEscolarNotasCreate/$1');
$routes->add('/Admin/Alunos/historico-escolar/disciplinas-notas/visualizar/(:num)', 'Admin\Alunos::historicoEscolarNotasRead/$1');
$routes->add('/Admin/Alunos/historico-escolar/disciplinas-notas/editar/(:num)', 'Admin\Alunos::historicoEscolarNotasUpdate/$1');
$routes->add('/Admin/Alunos/historico-escolar/disciplinas-notas/excluir/(:num)', 'Admin\Alunos::historicoEscolarNotasDelete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Disciplinas', 'Admin\Disciplinas::index');
$routes->add('/Admin/Disciplinas/cadastrar', 'Admin\Disciplinas::create');
$routes->add('/Admin/Disciplinas/editar/(:num)', 'Admin\Disciplinas::update/$1');
$routes->add('/Admin/Disciplinas/visualizar/(:num)', 'Admin\Disciplinas::read/$1');
$routes->add('/Admin/Disciplinas/excluir/(:num)', 'Admin\Disciplinas::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Categorias', 'Admin\Categorias::index');
$routes->add('/Admin/Categorias/cadastrar', 'Admin\Categorias::create');
$routes->add('/Admin/Categorias/cadastrarAjax', 'Admin\Categorias::createAjax');
$routes->add('/Admin/Categorias/editar/(:num)', 'Admin\Categorias::edit/$1');
$routes->add('/Admin/Categorias/excluir/(:num)', 'Admin\Categorias::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Produtos-Categorias', 'Admin\ProdutosCategorias::index');
$routes->add('/Admin/Produtos-Categorias/cadastrar', 'Admin\ProdutosCategorias::create');
$routes->add('/Admin/Produtos-Categorias/cadastrarAjax', 'Admin\ProdutosCategorias::createAjax');
$routes->add('/Admin/Produtos-Categorias/editar/(:num)', 'Admin\ProdutosCategorias::edit/$1');
$routes->add('/Admin/Produtos-Categorias/excluir/(:num)', 'Admin\ProdutosCategorias::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Produtos', 'Admin\Produtos::index');
$routes->add('/Admin/Produtos/cadastrar', 'Admin\Produtos::create');
$routes->add('/Admin/Produtos/editar/(:num)', 'Admin\Produtos::edit/$1');
$routes->add('/Admin/Produtos/excluir/(:num)', 'Admin\Produtos::delete/$1');
$routes->add('/Admin/Produtos/galeria/(:num)', 'Admin\Produtos::galery/$1');
$routes->post('/Admin/Produtos/uploadImagens/(:num)', 'Admin\Produtos::uploadImages/$1');
$routes->get('/Admin/Produtos/deleteImage/(:num)/(:num)', 'Admin\Produtos::deleteImage/$1/$2');
//-------------------------------------------------------------------------
$routes->add('/Admin/Noticias', 'Admin\Noticias::index');
$routes->add('/Admin/Noticias/cadastrar', 'Admin\Noticias::create');
$routes->add('/Admin/Noticias/editar/(:num)', 'Admin\Noticias::edit/$1');
$routes->add('/Admin/Noticias/excluir/(:num)', 'Admin\Noticias::delete/$1');
$routes->add('/Admin/Noticias/galeria/(:num)', 'Admin\Noticias::galery/$1');
$routes->post('/Admin/Noticias/uploadImagens/(:num)', 'Admin\Noticias::uploadImages/$1');
$routes->get('/Admin/Noticias/deleteImage/(:num)/(:num)', 'Admin\Noticias::deleteImage/$1/$2');
//-------------------------------------------------------------------------
$routes->add('/UploadImage/upload', 'Admin\UploadImage::upload');
//-------------------------------------------------------------------------
$routes->add('/Admin/Servicos', 'Admin\Servicos::index');
$routes->add('/Admin/Servicos/cadastrar', 'Admin\Servicos::create');
$routes->add('/Admin/Servicos/editar/(:num)', 'Admin\Servicos::edit/$1');
$routes->add('/Admin/Servicos/excluir/(:num)', 'Admin\Servicos::delete/$1');
$routes->post('/Admin/Servicos/upload', 'Admin\Servicos::upload');
//-------------------------------------------------------------------------
$routes->add('/Admin/Categorias-galeria', 'Admin\CategoriasGaleria::index');
$routes->add('/Admin/Categorias-galeria/cadastrar', 'Admin\CategoriasGaleria::create');
$routes->add('/Admin/Categorias-galeria/editar/(:num)', 'Admin\CategoriasGaleria::edit/$1');
$routes->add('/Admin/Categorias-galeria/excluir/(:num)', 'Admin\CategoriasGaleria::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/Galerias', 'Admin\Galeria::index');
$routes->add('/Admin/Galerias/cadastrar', 'Admin\Galeria::create');
$routes->add('/Admin/Galerias/editar/(:num)', 'Admin\Galeria::edit/$1');
$routes->add('/Admin/Galerias/excluir/(:num)', 'Admin\Galeria::delete/$1');
$routes->add('/Admin/Galerias/imagens/(:num)', 'Admin\Galeria::images/$1');
$routes->post('/Admin/Galerias/upload', 'Admin\Galeria::upload');
$routes->post('/Admin/Galerias/uploadImagens/(:num)', 'Admin\Galeria::uploadImages/$1');
$routes->get('/Admin/Galerias/deleteImage/(:num)/(:num)', 'Admin\Galeria::deleteImage/$1/$2');
//-------------------------------------------------------------------------
$routes->add('/Admin/Banners', 'Admin\Banners::index');
$routes->add('/Admin/Banners/cadastrar', 'Admin\Banners::create');
$routes->post('/Admin/Banners/upload', 'Admin\Banners::upload');
$routes->add('/Admin/Banners/editar/(:num)', 'Admin\Banners::edit/$1');
$routes->add('/Admin/Banners/excluir/(:num)', 'Admin\Banners::delete/$1');
//-------------------------------------------------------------------------
$routes->add('/Admin/HistoricoEscolar/Disciplinas', 'Admin\HistoricoEscolarDisciplinas::index');
$routes->add('/Admin/HistoricoEscolar/Disciplinas/cadastrar', 'Admin\HistoricoEscolarDisciplinas::create');
$routes->add('/Admin/HistoricoEscolar/Disciplinas/visualizar/(:num)', 'Admin\HistoricoEscolarDisciplinas::read/$1');
$routes->add('/Admin/HistoricoEscolar/Disciplinas/editar/(:num)', 'Admin\HistoricoEscolarDisciplinas::update/$1');
$routes->add('/Admin/HistoricoEscolar/Disciplinas/excluir/(:num)', 'Admin\HistoricoEscolarDisciplinas::delete/$1');
//-------------------------------------------------------------------------

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
