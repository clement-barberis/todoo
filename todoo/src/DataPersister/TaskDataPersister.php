<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;


class TaskDataPersister implements  ContextAwareDataPersisterInterface
{
    private $security;
    private $em;


    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;

    }

    public function supports($data, array $context = []): bool
    {
         return $data instanceof Task;
    }

    public function persist($data, array $context = [])
    {
        $user = $this->security->getUser();
        $data->setUser($user);
        $this->em->persist($data);
        $this->em->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}