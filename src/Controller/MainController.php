<?php


namespace App\Controller;

use App\Entity\Pictures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Pictures::class);
        /** @var Pictures $pictures */
        $pictures = $repository->findBy(['isMain' => 1]);

        return $this->render('content.html.twig', [
            'pictures' => $pictures,
            'title' => 'main',
            'footerFilters' => false
        ]);
    }

    /**
     * @Route("/category/{categoryValue}")
     */
    public function picture($categoryValue, EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Pictures::class);
        /** @var Pictures $pictures */
        $pictures = $repository->findBy(['category' => $categoryValue]);

        return $this->render('picture.html.twig', [
            'pictures' => $pictures,
            'title' => 'categoryValue',
        ]);
    }

    /**
     * @Route("/about")
     */
    public function about()
    {
        return $this->render('about.html.twig', [
            'title' => 'about',
            'activeItem' => 'isAbout'
        ]);
    }

    /**
     * @Route("/contacts")
     */
    public function contacts()
    {
        return $this->render('contacts.html.twig', [
            'title' => 'contacts',
            'activeItem' => 'isContacts'
        ]);
    }

    /**
     * @Route("/works")
     */
    public function works(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Pictures::class);
        /** @var Pictures $pictures */
        $categories = $repository->getCategories();
        $pictures = $repository->findBy(['isMain' => 1]);

        return $this->render('portfolio.html.twig', [
            'pictures'      => $pictures,
            'categories'    => $categories,
            'title'         => 'works',
            'footerFilters' => true
        ]);
    }
}
