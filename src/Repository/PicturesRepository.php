<?php

namespace App\Repository;

use App\Entity\Pictures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pictures[]    findAll()
 * @method Pictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PicturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pictures::class);
    }

    public function getCategories(): ?array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT category as name, count(category) as total FROM pictures GROUP BY category';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
