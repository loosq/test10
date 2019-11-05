<?php


namespace App\Controller;

use App\Entity\Pictures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PicturesController extends AbstractController
{
    /**
     * @Route("/admin/picture/new")
     * */
    public function new(EntityManagerInterface $em)
    {
        $pictures = new Pictures();
        $pictures->setName('random name'.rand(1,999))
                    ->setUrl('../images/picture-1.jpg')
                    ->setDescription('long description'.rand(1,999))
                    ->setDate(rand(1,31) . '-' . rand(1,12) . '-2019')
                    ->setTools('hui, aqua, brush');

        $em->persist($pictures);
        $em->flush();

        return new Response('Name:' . $pictures->getName());
    }
}
