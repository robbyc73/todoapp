<?php

// src/AppBundle/Collector/TaskDataCollector
namespace AppBundle\Collector;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class TaskDataCollector extends DataCollector
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $em = $this->em;

        $tasks = $em->getRepository('AppBundle:Task')
            ->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $tags = $em->getRepository('AppBundle:Tag')
            ->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $this->data = array(
            'tasks' => $tasks,
            'tags' => $tags
        );
    }

    public function getTasks()
    {
        return $this->data['tasks'];
    }

    public function getTags()
    {
        return $this->data['tags'];
    }

    public function getName()
    {
        return 'tasks';
    }
}