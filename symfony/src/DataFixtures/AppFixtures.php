<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    private $slug;

    public function __construct(SlugifyInterface $slugify)
    {
        $this->faker = Factory::create();
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        //$manager->flush();

        $categories = $this->loadCategory($manager);
        $this->loadBlogPost($manager, $categories);
    }

    public function loadBlogPost(ObjectManager $manager, $categories)
    {
        for ($i = 1; $i < 20; $i++)
        {
            $post = new BlogPost();
            $post->setTitle($this->faker->text(100));
            $post->setSlug($this->slug->slugify($post->getTitle()));
            $post->setBody($this->faker->text(1000));
            $post->setCreatedAt($this->faker->dateTime);
            $post->setCategory($this->faker->randomElement($categories));
            $manager->persist($post);
        }
        $manager->flush();
    }

    public function loadCategory(ObjectManager $manager)
    {
        $categories = array();
        for ($i = 1; $i < 6; $i++)
        {
            $category = new Category();
            $category->setName($this->faker->text(20));
            $manager->persist($category);
            array_push($categories, $category);
        }
        $manager->flush();

        return $categories;
    }
}
