<?php

function mask_cpf($cpf)
{
	$cpf = preg_replace('/\D/', '', $cpf);
	return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

function mask_telefone($phone)
{
	$phone = preg_replace('/\D/', '', $phone);
	if (strlen($phone) === 10) {
		return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
	} elseif (strlen($phone) === 11) {
		return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
	}
	return $phone;
}

function mask_cep($cep)
{
	$cep = preg_replace('/\D/', '', $cep);
	return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
}

function remove_mask_cpf($cpf)
{
	return str_replace(['.', '-'], '', $cpf);
		
}

function remove_mask_telefone($phone)
{
	return str_replace(['(', ')', ' ', '-'], '', $phone);
}

function remove_mask_cep($cep)
{
	return str_replace('-', '', $cep);
}

function format_date($date)
{
	$timestamp = strtotime($date);
	return date('d/m/Y', $timestamp);
}