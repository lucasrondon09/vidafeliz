<?php

function permission()
{
	$session = session();
		
	if(!isset($session->userId)){
		$session->destroy();
		throw new \CodeIgniter\Exceptions\PageNotFoundException('Você precisa estar logado na aplicação!');
		

	}
}

function permissionAdmin()
{
	$session = session();

	if($session->userPerfil === '3'){
		throw new \CodeIgniter\Exceptions\PageNotFoundException('Você precisa ser um administrador para acessar esta página!');
	}
}