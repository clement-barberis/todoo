<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\Security\Core\Security;

final class TaskItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{


    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;

    public function __construct(Security $security,  TaskRepository $repository)
    {
        $this->repository = $repository;
        $this->user = $security->getUser();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Task::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Task
    {

        $task =$this->repository->find($id);
        if( !in_array("ROLE_ADMIN", $this->user->getRoles()) && $this->user !== $task->getUser() ){
            return null;
        }
        // Retrieve the blog post item from somewhere then return it or null if not found
        return $task ;
    }
}