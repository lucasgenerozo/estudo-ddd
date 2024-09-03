<?php

use Lucas\PortalAcademico\Domain\Entity\Aluno;

/** @var Aluno[] $alunoList */
?>

<h1>Aluno Listagem</h1>

<a href="/alunos/criar" class="btn btn-primary">Incluir aluno</a>

<?php if (empty($alunoList)) : ?>
    <table>
        <tr>
            <td>Sem alunos cadastrados</td>
        </tr>
    </table>
<?php else: ?>
    <table>
        <tr>
            <td>ID</td>
            <td>NOME</td>
            <td>EMAIL</td>
        </tr>
    <?php foreach ($alunoList as $aluno): ?>
        <tr>
            <td><?= $aluno->getId() ?></td>
            <td><?= $aluno->getNome() ?></td>
            <td><?= $aluno->getEmail() ?></td>
            <td><a href="/alunos/ver?id=<?=$aluno->getId()?>">Ver</a></td>
            <td><a href="/alunos/editar?id=<?=$aluno->getId()?>">Editar</a></td>
            <td><a href="/alunos/excluir?id=<?=$aluno->getId()?>">Excluir</a></td>
        </tr>
    <?php endforeach; ?>
    </table> 
<?php endif; ?>    