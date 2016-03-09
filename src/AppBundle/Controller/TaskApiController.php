<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskApiController extends FOSRestController
{
    /**
     * @param $id
     * @return Task|null
     */
    protected function retrieveTask($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AppBundle:Task')
            ->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $task) {
            throw new NotFoundHttpException();
        }

        return $task;
    }

    /**
     * Load new form and return HTML content
     *
     * @ApiDoc(
     *   parameters={
     *     { "name"="id", "dataType"="integer", "required"=true, "description"="Task Database ID" }
     *   },
     *   statusCodes={
     *     200="Loaded new form content",
     *     404="did not found object",
     *     500="Unhandled Exception - something went very wrong"
     *   }
     * )
     */
    public function getTaskAction(Request $request, $id)
    {
        $task = $this->retrieveTask($id);
        $form = $this->createForm(new TaskType(), $task, ['em' => $this->getDoctrine()->getManager()]);

        return $this->render('task/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Updates Task Status as finished
     *
     * @ApiDoc(
     *   parameters={
     *     { "name"="id", "dataType"="integer", "required"=true, "description"="Task Database ID" }
     *   },
     *   statusCodes={
     *     200="Task finished correctly",
     *     404="did not found object",
     *     500="Unhandled Exception - something went very wrong"
     *   }
     * )
     */
    public function finishTaskAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $this->retrieveTask($id);
        $task->setFinished(true);
        $em->persist($task);
        $em->flush();
        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * Delete given task from the database
     *
     * @ApiDoc(
     *   parameters={
     *     { "name"="id", "dataType"="integer", "required"=true, "description"="Task Database ID" }
     *   },
     *   statusCodes={
     *     200="Task deleted",
     *     404="did not found object",
     *     500="Unhandled Exception - something went very wrong"
     *   }
     * )
     */
    public function deleteTaskAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $this->retrieveTask($id);
        $em->remove($task);
        $em->flush();

        return $this->handleView($this->view(['status' => 'ok'], 200));
    }
}
