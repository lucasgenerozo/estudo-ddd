<?php
namespace Lucas\PortalAcademico\Infrastructure\Repository;

use Lucas\PortalAcademico\Domain\Entity\Aluno;
use Lucas\PortalAcademico\Domain\Repository\AlunoRepository;
use PDO;
use PDOStatement;

class AlunoRepositoryPDO implements AlunoRepository
{
    public function __construct(
        private PDO $pdo
    ) {}

    public function hydrateAlunoList(PDOStatement $stmt): array
    {
        $alunosList = array();
        while ($aluno = $stmt->fetch()) {
            $alunosList[] = $this->hydrateAluno($aluno);
        }

        return $alunosList;
    }

    public function hydrateAluno(array $aluno): Aluno
    {
        $id = empty($aluno['id']) ? null : (int) $aluno['id'];

        return new Aluno(
            $id,
            $aluno['nome'],
            $aluno['email']
        );
    } 

    public function list(): array
    {
        $stmt = $this->pdo->query('
            SELECT *
            FROM alunos
        ');

        return $this->hydrateAlunoList($stmt);
    }

    private function insert(Aluno $aluno): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO alunos (
                nome, email
            ) VALUES (
                :nome, :email
            );
        ');
        $stmt->bindValue(':nome', $aluno->getNome());
        $stmt->bindValue(':email', $aluno->getEmail());


        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    private function update(Aluno $aluno): void
    {
        $stmt = $this->pdo->prepare('
            UPDATE alunos
            SET nome = :nome,
                email = :email
            WHERE (id = :id);
        ');
        $stmt->bindValue(':nome', $aluno->getNome());
        $stmt->bindValue(':email', $aluno->getEmail());
        $stmt->bindValue(':id', $aluno->getId());

        $stmt->execute();
    }

    public function save(Aluno $aluno): Aluno
    {
        if (is_null($aluno->getId())) {

            $id = $this->insert($aluno);
            $aluno->setId($id);

            return $aluno;
        }

        $this->update($aluno);
        return $aluno;
    }

    public function find(int $id): ?Aluno
    {
        $stmt = $this->pdo->prepare('
            SELECT *
            FROM alunos
            WHERE (id = ?)
        ');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $alunoData = $stmt->fetch();

        if ($alunoData === null) {
            return null;
        }

        return $this->hydrateAluno($alunoData);
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare('
            UPDATE alunos
            SET excluido = 1
            WHERE (id = ?);
        ');
        $stmt->bindValue(1, $id);
        
        $stmt->execute();
    }
}