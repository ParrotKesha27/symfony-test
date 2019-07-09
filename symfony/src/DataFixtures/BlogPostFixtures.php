<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BlogPost;

class BlogPostFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(BlogPost::class, 25, function (BlogPost $post) {
            $post->setTitle($this->faker->text(25));
            $post->setBody($this->faker->text(1000));
            $post->setCategory($this->getRandomReference(Category::class));
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
