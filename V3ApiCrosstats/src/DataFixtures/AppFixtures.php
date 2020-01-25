<?php

namespace App\DataFixtures;

use App\Entity\Box;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\UserBoxId;
use App\Entity\UserRoleId;
use Faker\Factory as Factory2;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Migrations\Version\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $manager;
    private $faker;
    private $encoder;
    private $em;
    public function __construct(EntityManagerInterface $em,UserPasswordEncoderInterface $encoder){
        $this->faker=Factory2::create("fr_FR");
        $this->encoder = $encoder;
        $this->em = $em;
    }
    
        

    public function load(ObjectManager $manager)
    {
       $this->manager=$manager;
        $this->loadUser();
        $manager->flush();
    }

 

    public function loadUser(){
        $roleManager = new Role();
        $roleManager->setLibelle("ROLE MANAGER");
        $this->manager->persist($roleManager);
        $roleCoach = new Role();
        $roleCoach->setLibelle("ROLE COACH");
        $this->manager->persist($roleCoach);
        $roleUser = new Role();
        $roleUser->setLibelle("ROLE USER");
        $this->manager->persist($roleUser);
        $roleAdmin = new Role();
        $roleAdmin->setLibelle("ROLE ADMIN");
        $this->manager->persist($roleAdmin);
        $boxNewArea = new Box();
        $boxEpsilon = new Box();
        $boxNewArea->setName("Crossfit New Area");
        $boxEpsilon->setName("Crossfit Epsilon");
        $boxNewArea->setAdress($this->faker->address());
        $boxEpsilon->setAdress($this->faker->address());
        $boxNewArea->setCity($this->faker->city());
        $boxEpsilon->setCity($this->faker->city());
        $boxNewArea->setCodePostal($this->faker->postcode());
        $boxEpsilon->setCodePostal($this->faker->postcode());
        $boxNewArea->setSiret($this->faker->siret());
        $boxEpsilon->setSiret($this->faker->siret());
        $boxNewArea->setCertifate(true);
        $boxEpsilon->setCertifate(false);
        $this->manager->persist($boxEpsilon);
        $this->manager->persist($boxNewArea);
        for($i=0;$i<10;$i++){
           
            $user = new User();
            $userRoleId = new UserRoleId();
            $userBoxId = new UserBoxId();
            $user->setFullName($this->faker->firstName());
            $user->setCellphone($this->faker->phoneNumber());
            $user->setPassword($this->encoder->encodePassword($user,"123"));
            $user->setEmail(strtolower($user->getFullName()."@gmail.com"));
            $user->setCreateAt(new \Datetime('now'));
            $this->addReference("user".$i,$user);
            $userRoleId->setIdUser($user);
            $userRoleId->setIdRole($roleUser);
            if ($i%2 == 1){
                $userBoxId->setBoxId($boxNewArea);
                $userBoxId->setUserId($user);
            }else{
                $userBoxId->setBoxId($boxEpsilon);
                $userBoxId->setUserId($user);
            }
          
            $this->manager->persist($userBoxId);
            $this->manager->persist($user);
            $this->manager->persist($userRoleId);
        }
        $user = new User();
        $userRoleId = new UserRoleId();
        $user->setFullName("test");
        $user->setCellphone("123");
        $user->setPassword($this->encoder->encodePassword($user,"123"));
        $user->setEmail(strtolower($user->getFullName()."@gmail.com"));
        
        $this->addReference("user 11",$user);
        $userRoleId->setIdUser($user);
        $userRoleId->setIdRole($roleAdmin);
        $this->manager->persist($user);
        $this->manager->persist($userRoleId);    

    }

}
