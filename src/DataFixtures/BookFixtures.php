<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Author;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [AuthorFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
         $mobydick = new Book();
         $mobydick->setTitle('Moby Dick');
         $mobydick->addAuthor($this->getReference(AuthorFixtures::HEMELVILLE_AUTHOR_REFERENCE, Author::class));
         $mobydick->setNbrPages(635);
         $manager->persist($mobydick);

         $lesmiserables = new Book();
         $lesmiserables->setTitle('Les Misérables');
         $lesmiserables->addAuthor($this->getReference(AuthorFixtures::VHUGO_AUTHOR_REFERENCE, Author::class));
         $lesmiserables->setNbrPages(1232);
         $manager->persist($lesmiserables);
        $manager->flush();  
    }
}
