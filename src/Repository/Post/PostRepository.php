<?php

namespace App\Repository\Post;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public static function createPublishedCriteria(): Criteria
    {
        return Criteria::create()->andWhere(
            Criteria::expr()->neq('p.publicationDate', null)
        );
    }

    public function findById(int $id): ?Post
    {
        try {
            $qb = $this->createQueryBuilder('p');

            $qb->addCriteria(self::createPublishedCriteria());

            return $qb->where('p.id = :id')
                ->setParameter('id', $id)
                ->innerJoin('p.category', 'c')
                ->addSelect('c')
                ->getQuery()
                ->getOneOrNullResult()
            ;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function save(Post $post): void
    {
        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }
}
