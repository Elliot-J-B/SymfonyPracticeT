<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Country;

class CountryFixtures extends Fixture
{
    public const USA_COUNTRY_REFERENCE = 'usa-country';
    public const FRANCE_COUNTRY_REFERENCE = 'france-country';
    public function load(ObjectManager $manager): void
    {
        $usa = new Country();
        $usa->setName('United States of America');
        $manager->persist($usa);

        $france = new Country();
        $france->setName('France');
        $manager->persist($france);
        $manager->flush();
        
        $this->addReference(self::USA_COUNTRY_REFERENCE, $usa);
        $this->addReference(self::FRANCE_COUNTRY_REFERENCE, $france);
    }
}
