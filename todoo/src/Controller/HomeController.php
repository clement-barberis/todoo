<?php

namespace App\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        dd('test');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("api/tasks/{id}/done", name="task_done", methods={"GET"})
     * @param EntityManagerInterface $em
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function task_done(EntityManagerInterface $em, Task $task) : JsonResponse
    {

        if( !in_array("ROLE_ADMIN", $this->getUser()->getRoles()) && $this->getUser() !== $task->getUser() ){
            return new JsonResponse('Not Found' ,404);
        }

        $task = $task->setDone(!$task->getDone());
        $em->flush();
        return $this->json($task, 200, [], ['groups' => 'read:task']);
    }
}
