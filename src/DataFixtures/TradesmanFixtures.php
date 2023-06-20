<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tradesman;

class TradesmanFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tradesman1 = new Tradesman();
        $tradesman1->setName('John Doe');

        $tradesman2 = new Tradesman();
        $tradesman2->setName('Jane Smith');

        $tradesman3 = new Tradesman();
        $tradesman3->setName('Robert Johnson');

        $tradesman4 = new Tradesman();
        $tradesman4->setName('Jane Smith');

        $tradesman5 = new Tradesman();
        $tradesman5->setName('Robert Johnson');

        $manager->persist($tradesman1);
        $manager->persist($tradesman2);
        $manager->persist($tradesman3);
        $manager->persist($tradesman4);
        $manager->persist($tradesman5);
        $manager->flush();
    }
}
