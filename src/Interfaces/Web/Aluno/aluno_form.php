<?php

/** @var ?Aluno $aluno */


$criando = empty($aluno);

?>

<h1>Cadastro de alunos</h1>

<form method="post" action="<?=$criando ? '/alunos/criar' : '/alunos/editar'?>">
    <input type="hidden" name="aluno[id]" value="<?=$criando ? '' : $aluno->getId()?>">
    <label for="nome">Nome:
        <input type="text" name="aluno[nome]" id="nome" value="<?=$criando ? '' : $aluno->getNome()?>">
    </label>
    <label for="email">Email:
        <input type="email" name="aluno[email]" id="email" value="<?=$criando ? '' : $aluno->getEmail()?>">
    </label>
    <input type="submit" value="Gravar">
</form>