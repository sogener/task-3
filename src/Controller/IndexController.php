<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comments;
use App\Entity\User;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Repository\UserRepository;
use App\Service\MessageInterface;
use App\Service\RandomMessageGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, MessageInterface $messageGenerator): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $articles = $repository->findAll();

        $dailyMessage = $messageGenerator->getRandomMessage();

        return $this->render('index/index.html.twig', [
            'heading' => 'Главная страница',
            'articles' => $articles,
            'dailyMessage' => $dailyMessage
        ]);
    }

}
