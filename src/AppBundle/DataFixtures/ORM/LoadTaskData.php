<?php

// file: src/AppBundle/DataFixtures/ORM/LoadTaskData.php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
#use Doctrine\Common\DataFixtures\FixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{

 public function load(ObjectManager $manager)

 {

 $obj = new Task();

 $obj->setName('Example task for today');

 $obj->setNotes('This task is created as a fixture and has no real meaning. It\'s only demonstration, sorry to disappoint you');

 $obj->setCreatedAt(new \DateTime());

 $obj->setFinished(false);

 $obj->setDueDate(new \DateTime());

 $obj->addTag($this->getReference('tag:home'));

 $obj->addTag($this->getReference('tag:important'));

 $obj->setUser($this->getReference('user:todo'));
 $manager->persist($obj);

 $manager->flush();

 }

public function getOrder()
 {
 return 10;
 }

}
