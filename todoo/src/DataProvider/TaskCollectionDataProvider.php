<?php
// api/src/DataProvider/BlogPostCollectionDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

final class TaskCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Security $security,  TaskRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->user = $security->getUser();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Task::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        if(in_array('ROLE_ADMIN', $this->user->getRoles())){
            $tasks = $this->repository->findAll();
        }else{
            $tasks = $this->userRepository->find($this->user->getId())->getTasks();
        }
        foreach($tasks as $task){
            yield $task;
        }
    }
}