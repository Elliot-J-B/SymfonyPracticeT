<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Country;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [CountryFixtures::class];
    }

    public const HEMELVILLE_AUTHOR_REFERENCE = 'herman-melville';
    public const VHUGO_AUTHOR_REFERENCE = 'victor-hugo';
    public function load(ObjectManager $manager): void
    {
        $hmelville = new Author();
        $hmelville->setName('Herman Melville');
        $hmelville->setCountry($this->getReference(CountryFixtures::USA_COUNTRY_REFERENCE, Country::class));
        $manager->persist($hmelville);

        $vhugo = new Author();
        $vhugo->setName('Victor Hugo');
        $vhugo->setCountry($this->getReference(CountryFixtures::FRANCE_COUNTRY_REFERENCE, Country::class));
        $manager->persist($vhugo);

        $manager->flush();

        $this->addReference(self::HEMELVILLE_AUTHOR_REFERENCE, $hmelville);
        $this->addReference(self::VHUGO_AUTHOR_REFERENCE, $vhugo);
    }
}
    