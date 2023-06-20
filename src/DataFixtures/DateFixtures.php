<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Date;

class DateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $date1 = new Date();
        $date1->setDate(new \DateTime('2023-06-01'));

        $date2 = new Date();
        $date2->setDate(new \DateTime('2023-06-02'));

        $date3 = new Date();
        $date3->setDate(new \DateTime('2023-06-03'));

        $date4 = new Date();
        $date4->setDate(new \DateTime('2023-06-19'));

        $date5 = new Date();
        $date5->setDate(new \DateTime('2023-06-20'));


        $manager->persist($date1);
        $manager->persist($date2);
        $manager->persist($date3);
        $manager->persist($date4);
        $manager->persist($date5);
        $manager->flush();
    }
}
