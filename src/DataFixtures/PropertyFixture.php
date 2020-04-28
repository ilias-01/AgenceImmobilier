<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\PropertyLike;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PropertyFixture extends Fixture
{
    private $encoder;
    function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $users = [];

        $user = new User();
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($user,'demo'));
        $manager->persist($user);
        $users[] = $user;

        for ($i=0; $i<=20; $i++){
            $user = new User();
            $user->setUsername($faker->email);
            $user->setPassword($this->encoder->encodePassword($user,'demo'));
            $manager->persist($user);
            $users[] = $user;
        }
        
        for ($i=0; $i <100 ; $i++) { 
            $property = new Property();
            $property->setTitle($faker->word(3,true))
                     ->setDescription($faker->sentences(3,true))
                     ->setSurface($faker->numberBetween(20,350))
                     ->setRooms($faker->numberBetween(2,10))
                     ->setBedrooms($faker->numberBetween(1,9))
                     ->setFloor($faker->numberBetween(0,15))
                     ->setPrice($faker->numberBetween(100000,1000000))
                     ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                     ->setCity($faker->city)
                     ->setAddress($faker->address)
                     ->setPostalCode($faker->postcode)
                     ->setSold(false);
            $manager->persist($property);
            for ($j=0; $j < mt_rand(0,10) ; $j++) { 
                $like = new PropertyLike();
                $like->setProperty($property)
                    ->setUser($faker->randomElement($users));
                $manager->persist($like);
            }
        }
        $manager->flush();
    }
}
