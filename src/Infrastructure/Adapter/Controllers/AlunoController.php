<?php
namespace Lucas\PortalAcademico\Infrastructure\Adapter\Controllers;

use InvalidArgumentException;
use Lucas\PortalAcademico\Domain\Repository\AlunoRepository;
use Lucas\PortalAcademico\Domain\Views\AlunoView;
use Lucas\PortalAcademico\Infrastructure\Persistence\PDOCreator;
use Lucas\PortalAcademico\Infrastructure\Repository\AlunoRepositoryPDO;
use PDO;

class AlunoController implements Controller
{   
    private PDO $pdo;
    private AlunoRepository $alunoRepository;

    public function __construct(
    ) {
        $this->pdo = PDOCreator::create();
        $this->alunoRepository = new AlunoRepositoryPDO($this->pdo);
    }

    public function index()
    {
        $alunoList = $this->alunoRepository->list();

        AlunoView::listagem($alunoList);
    }

    public function show()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === null || $id === false) {
            throw new InvalidArgumentException(
                'ID informado vazio ou inválido',
                400
            );
        } 

        $aluno = $this->alunoRepository->find($id);

        // require view
    }

    public function form()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            throw new InvalidArgumentException(
                'ID informado inválido',
                400
            );
        }

        
        $alunoOrNull = (!empty($id) ? $this->alunoRepository->find($id) : null);
        var_dump($alunoOrNull);

        AlunoView::form($alunoOrNull);
    }

    public function save()
    {
        var_dump($_POST);

        $alunoInput = filter_input(INPUT_POST, 'aluno', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($alunoInput === null || $alunoInput == false) {
            throw new InvalidArgumentException(
                'Atributo aluno não definido ou inválido',
                400
            );
        }

        $aluno = $this->alunoRepository->hydrateAluno($alunoInput);

        $this->alunoRepository->save($aluno);

        header('Location: http://localhost/alunos');
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === null || $id === false) {
            throw new InvalidArgumentException(
                'ID informado vazio ou inválido',
                400
            );
        } 

        $this->alunoRepository->delete($id);

        header('Location: http://localhost/alunos');
    }
}