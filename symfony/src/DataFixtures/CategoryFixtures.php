<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Category::class, 10, function (Category $category) {
            $category->setName($this->faker->text(15));
        });

        $manager->flush();
    }
}
