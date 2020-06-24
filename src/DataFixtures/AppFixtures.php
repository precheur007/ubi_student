<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
		$user->setApiKey('test_api_key');
		$user->setUsername('test');
		$user->setPassword('test');
		$manager->persist($user);
		
        $manager->flush();
    }
}
