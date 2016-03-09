<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $um = $this->container->get('fos_user.user_manager');

        $obj = $um->createUser();
        $obj->setUsername('todo');
        $obj->setEmail('todo@example.com');
        $obj->setPlainPassword('test');
        $obj->setRoles(['ROLE_USER']);
        $obj->setEnabled(true);

        $um->updateUser($obj);
        $this->addReference('user:'.$obj->getUsername(), $obj);
    }

    public function getOrder()
    {
        return 1;
    }
}

