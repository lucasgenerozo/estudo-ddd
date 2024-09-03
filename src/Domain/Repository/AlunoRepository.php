<?php
namespace Lucas\PortalAcademico\Domain\Repository;

use Lucas\PortalAcademico\Domain\Entity\Aluno;
use PDOStatement;

interface AlunoRepository
{
    public function hydrateAlunoList(PDOStatement $stmt): array;
    public function hydrateAluno(array $aluno): Aluno;

    /** @return Aluno[] $alunos */
    public function list(): array;
    public function find(int $id): ?Aluno;
    public function save(Aluno $aluno);
    public function delete(int $id);
}