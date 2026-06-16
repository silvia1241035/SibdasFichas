<?php
function validar_nome(string $nome): array {
 $erros = [];
 if (empty(trim($nome))) {
 $erros[] = "O campo Nome é obrigatório.";
 } elseif (preg_match('/\d/', $nome)) {
 $erros[] = "O campo Nome não pode conter números.";
 }
 return $erros;
}

function validar_morada(string $morada): array {
 $erros = [];
 if (empty(trim($morada))) {
 $erros[] = "O campo Morada é obrigatório.";
 }
 return $erros;
}

function validar_cp(string $cp): array {
 $erros = [];
 if (empty(trim($cp))) {
 $erros[] = "O campo Código Postal é obrigatório.";
 } elseif (!preg_match('/^\d{4}-\d{3}$/', $cp)) {
 $erros[] = "Código Postal inválido (ex: 4000-007).";
 }
 return $erros;
}

function validar_cidade(string $cidade): array {
 $erros = [];
 if (empty(trim($cidade))) {
 $erros[] = "O campo Cidade é obrigatório.";
 }
 return $erros;
}

function validar_telefone(string $telefone): array {
 $erros = [];
 if (empty(trim($telefone))) {
 $erros[] = "O campo Telefone é obrigatório.";
 } elseif (!preg_match('/^9\d{8}$/', $telefone)) {
 $erros[] = "O número de telefone não é válido. Deve começar por 9 e ter 9 dígitos.";
 }
 return $erros;
}

function validar_email(string $email): array {
 $erros = [];
 if (empty(trim($email))) {
 $erros[] = "O campo Email é obrigatório.";
 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 $erros[] = "O endereço de email não é válido.";
 }
 return $erros;
}

function validar_sexo(string $sexo): array {
 $erros = [];
 if (empty(trim($sexo))) {
 $erros[] = "O campo Género é obrigatório.";
 }
 return $erros;
}

function validar_data_nascimento(string $dnasc): array {
 $erros = [];
 if (empty(trim($dnasc))) {
 $erros[] = "O campo Data de Nascimento é obrigatório.";
 } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dnasc)) {
 $erros[] = "Formato de data inválido. Use AAAA-MM-DD.";
 } else {
 $partes = explode('-', $dnasc);
 if (!checkdate((int)$partes[1], (int)$partes[2], (int)$partes[0])) {
 $erros[] = "Data de nascimento inválida.";
 }
 }
 return $erros;
}

function validar_estado_civil(string $estado): array {
 $erros = [];
 if (empty(trim($estado))) {
 $erros[] = "Estado civil não selecionado.";
 }
 return $erros;
}

function validar_sistema_saude(string $sistema): array {
 $erros = [];
 if (empty(trim($sistema))) {
 $erros[] = "Sistema de saúde não preenchido.";
 }
 return $erros;
}

function validar_profissao(string $profissao): array {
 $erros = [];
 if (empty(trim($profissao))) {
 $erros[] = "Profissão é obrigatória.";
 }
 return $erros;
}