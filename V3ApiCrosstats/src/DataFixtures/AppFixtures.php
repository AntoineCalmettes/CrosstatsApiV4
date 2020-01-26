<?php

namespace App\DataFixtures;

use App\Entity\Box;
use App\Entity\Measure;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\WodType;
use App\Entity\UserBoxId;
use App\Entity\UserRoleId;
use App\Entity\UserWeight;
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
        $typeWodForTime = new WodType();
        $typeWodForTime->setLibelle("For time");
        $this->manager->persist($typeWodForTime);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Amrap");
        $this->manager->persist($typeWodAmrap);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Emom");
        $this->manager->persist($typeWodAmrap);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Amrep");
        $this->manager->persist($typeWodAmrap);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Max wheight");
        $this->manager->persist($typeWodAmrap);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Max distance");
        $this->manager->persist($typeWodAmrap);
        $typeWodAmrap = new WodType();
        $typeWodAmrap->setLibelle("Intervals");
        $this->manager->persist($typeWodAmrap);
        $measure = new Measure();
        $measure->setLibelle("Mètre");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Centimètre");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Inch");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Yard");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Miles");
        $this->manager->persist($measure);
        $kg = new Measure();
        $kg->setLibelle("Kilogramme");
        $this->manager->persist($kg);
        $measure = new Measure();
        $measure->setLibelle("Lbs");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Calories");
        $this->manager->persist($measure);
        $measure = new Measure();
        $measure->setLibelle("Reps");
        $this->manager->persist($measure);
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
       
        
        $this->manager->persist($boxNewArea);
        for($i=0;$i<5;$i++){
           
            $user = new User();
            $userRoleId = new UserRoleId();
            $userBoxId = new UserBoxId();
            $weight = new UserWeight();
            $weight->setUser($user);
            $weight->setWeight(mt_rand(50,100));
            $weight->setDate(new \Datetime('now'));
            $weight->setMeasure($kg);
           

            $user->setFullName($this->faker->firstName());
            $user->setCellphone($this->faker->phoneNumber());
            $user->setPassword($this->encoder->encodePassword($user,"123"));
            $user->setEmail(strtolower($user->getFullName()."@gmail.com"));
            $user->setCreateAt(new \Datetime('now'));
            $user->setSize(mt_rand(160, 190));
            $this->addReference("user".$i,$user);
            $userRoleId->setIdUser($user);
            $userRoleId->setIdRole($roleUser);
         
          
         
            $this->manager->persist($user);
            if ($i%2 == 1){
                $userBoxId->setBoxId($boxNewArea);
                $userBoxId->setUserId($user);
            }else{
                $userBoxId->setBoxId($boxEpsilon);
                $userBoxId->setUserId($user);
            }
            $this->manager->persist($userRoleId);
            $this->manager->persist($userBoxId);
            $this->manager->persist($weight);   
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
        $this->manager->persist($weight);    

    }

}
