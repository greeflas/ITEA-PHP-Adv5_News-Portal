<?php

namespace App\Repository\Category;

use App\Entity\Category;
use App\Repository\Post\PostRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findBySlug(string $slug): ?Category
    {
        try {
            $qb = $this->createQueryBuilder('c')
                ->where('c.slug = :slug')
                ->setParameter('slug', $slug)
                ->leftJoin('c.posts', 'p')
            ;

            $qb->addCriteria(PostRepository::createPublishedCriteria());

            return $qb->addSelect('p')
                ->getQuery()
                ->getOneOrNullResult()
            ;

        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findById(int $id): ?Category
    {
        try {
            return $this->createQueryBuilder('c')
                ->where('c.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
