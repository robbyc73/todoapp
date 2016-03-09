<?php

// file: src/AppBundle/Controller/TaskController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller

{

 public function listAction(Request $request)

 {

$this->denyAccessUnlessGranted('ROLE_USER');

    /* $watch = $this->get('debug.stopwatch');
     $watch->start('Fetching Tasks');*/

 $em = $this->getDoctrine()->getManager();
 //echo 'user is '.$this->getUser()->getId();
 $tasks = $em->getRepository('AppBundle:Task')
 ->createQueryBuilder('t')
 ->where('t.finished = :finished')
 ->andWhere('t.user = :user')
 ->orderBy('t.due_date', 'ASC')
 ->setParameter('finished', false)
 ->setParameter('user', $this->getUser())
 ->getQuery()
 ->getResult();

    /* $watch = $this->get('debug.stopwatch');
     $watch->start('Fetching Tasks');*/
// src/AppBundle/TaskController.php

     //dev only debug code
     if ($this->get('kernel')->getEnvironment() == 'dev') {
         dump(['hello' => 'world!']);
         dump($request);
         dump($tasks);
     }

 //echo 'ID is '.$_GET['id'];
 $newTask = new Task();

 $form = $this->createForm(new TaskType(), $newTask, ['em' => $em]);

 $form->handleRequest($request);

 $taskId = $request->request->get('id');


 if ($form->isValid()) {
 $task = $form->getData();
 if($taskId > 0) $task->setId($taskId);
 $task->setUser($this->getUser());
 $em->persist($task);
 $em->flush();
 return $this->redirect($this->generateUrl('homepage'));

 }

 return $this->render('task/list.html.twig', [
 'tasks' => $tasks,
 'form' => $form->createView()
 ]);

 }
}

?>
