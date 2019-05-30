<?php
declare(strict_types=1);

namespace App\Tests\Service\Category;

use App\Collection\PostCollection;
use App\Entity\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Service\Category\CategoryPresentationService;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

final class CategoryPresentationServiceTest extends TestCase
{
    private $categoryRepository;

    protected function setUp()
    {
        $this->categoryRepository = $this->getMockBuilder(CategoryRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['findBySlug'])
            ->getMock()
        ;
    }

    public function testGetBySlugNotFound()
    {
        $this->categoryRepository
            ->expects(self::once())
            ->method('findBySlug')
            ->willReturn(null)
        ;

        $service = $this->getService();

        self::assertNull($service->getBySlug('not exists slug'));
    }

    public function testGetBySlug()
    {
        $category = $this->getMockBuilder(Category::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $category->expects(self::once())
            ->method('getId')
            ->willReturn(23)
        ;

        $category->expects(self::once())
            ->method('getSlug')
            ->willReturn('this-is-test')
        ;

        $category->expects(self::once())
            ->method('getTitle')
            ->willReturn('This is test')
        ;

        $category->expects(self::once())
            ->method('getPosts')
            ->willReturn(new ArrayCollection())
        ;

        $this->categoryRepository
            ->expects(self::once())
            ->method('findBySlug')
            ->willReturn($category)
        ;

        $service = $this->getService();
        $expects = new \App\Model\Category(23, 'this-is-test', 'This is test');
        $expects->setPosts(new PostCollection());

        self::assertEquals($expects, $service->getBySlug('test'));
    }

    private function getService(): CategoryPresentationService
    {
        return new CategoryPresentationService($this->categoryRepository);
    }
}
