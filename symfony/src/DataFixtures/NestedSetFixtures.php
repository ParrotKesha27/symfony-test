<?php


namespace App\DataFixtures;

use App\Entity\NestedSetCategory;
use Doctrine\Common\Persistence\ObjectManager;

class NestedSetFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $nestedSet = new NestedSetCategory();
        $nestedSet->setTitle('root');
        $nestedSet->setLft(0);
        $nestedSet->setRgt(1);
        $nestedSet->setLvl(1);

        $manager->persist($nestedSet);
        $manager->flush();
    }
}
