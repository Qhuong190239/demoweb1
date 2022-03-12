<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++) {
            $author = new Author;
            $author->setName("Author $i");
            $author->setAddress("Hanoi");
            $author->setMobile("0658147652");
            $author->setBirthday(\DateTime::createFromFormat('Y-m-d', '1995-05-16'));
            $manager->persist($author);            
        }

        $manager->flush();
    }
}
