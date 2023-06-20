<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Transaction;
use App\Entity\Tradesman;
use App\Entity\Date;

class TransactionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create tradesmen
        $tradesman1 = new Tradesman();
        $tradesman1->setName('John Doe');

        $tradesman2 = new Tradesman();
        $tradesman2->setName('Jane Smith');

        $manager->persist($tradesman1);
        $manager->persist($tradesman2);

        // Create dates
        $date1 = new Date();
        $date1->setDate(new \DateTime('2023-01-01'));

        $date2 = new Date();
        $date2->setDate(new \DateTime('2023-01-02'));

        $manager->persist($date1);
        $manager->persist($date2);

        // Create transactions
        $transaction1 = new Transaction();
        $transaction1->setAmount(100.0);
        $transaction1->setTradesman($tradesman1);
        $transaction1->setDate($date1);

        $transaction2 = new Transaction();
        $transaction2->setAmount(200.0);
        $transaction2->setTradesman($tradesman1);
        $transaction2->setDate($date2);

        $transaction3 = new Transaction();
        $transaction3->setAmount(150.0);
        $transaction3->setTradesman($tradesman2);
        $transaction3->setDate($date1);

        $transaction4 = new Transaction();
        $transaction4->setAmount(300.0);
        $transaction4->setTradesman($tradesman2);
        $transaction4->setDate($date2);

        $transaction5 = new Transaction();
        $transaction5->setAmount(250.0);
        $transaction5->setTradesman($tradesman2);
        $transaction5->setDate($date2);

        $manager->persist($transaction1);
        $manager->persist($transaction2);
        $manager->persist($transaction3);
        $manager->persist($transaction4);
        $manager->persist($transaction5);

        $manager->flush();
    }
}
