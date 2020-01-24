<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Faker\Factory as Factory2;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $manager;
    private $faker;
    private $encoder;
    private $roleRepo;
    private $repoUser;
    public function __construct(UserPasswordEncoderInterface $encoder,RoleRepository $roleRepo,UserRepository $repoUser){
        $this->faker=Factory2::create("fr_FR");
        $this->encoder = $encoder;
    }
    
        

    public function load(ObjectManager $manager)
    {
       $this->manager=$manager;
        $this->loadUser();
        $this->loadRole();
        $manager->flush();
    }

 

    public function loadUser(){
        for($i=0;$i<10;$i++){
            $user = new User();
            
            $user->setFullName($this->faker->firstName());
            $user->setCellphone($this->faker->phoneNumber());
            $user->setPassword($this->encoder->encodePassword($user,"147258369"));
            $user->setEmail(strtolower($user->getFullName()."@gmail.com"));
            $this->addReference("user".$i,$user);
            $this->manager->persist($user);
        }
        $user = new User();
        $user->setFullName("test");
        $user->setCellphone("123");
        $user->setPassword($this->encoder->encodePassword($user,"123"));
        $user->setEmail(strtolower($user->getFullName()."@gmail.com"));
        $this->addReference("user 11",$user);
        $this->manager->persist($user);
        $this->manager->flush();

    }

}
