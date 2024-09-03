<?php
namespace Lucas\PortalAcademico\Domain\Views;

use Lucas\PortalAcademico\Domain\Entity\Aluno;

class AlunoView extends View
{
    /** @var Aluno[] $alunoList */
    public static function listagem(array $alunoList)
    {
        parent::render([
            'view' => 'Aluno/aluno_listagem',
            'alunoList' => $alunoList
        ]);
    }

    public static function form(Aluno $aluno = null)
    {
        parent::render([
            'view' => 'Aluno/aluno_form',
            'aluno' => $aluno
        ]);
    }
}