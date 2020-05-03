<?php
namespace App\Controller;

use App\Repository\AttachmentRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController {
    /**
     * @Route ("/",name="home")
     * @return Response 
     */
    public function index(PropertyRepository $repository ) : Response
    {   
        $properties = $repository->findLatest();
        return $this->render('pages/homePage.html.twig',[
            'properties' => $properties
        ]);
    }
    

    // $qb =  $this->createQueryBuilder('p');
        
    // $qb->innerJoin('App\Entity\Attachment','a',Join::WITH,'a.property = p.id');
    
    // dump($qb->getQuery()->getResult());
    // return $qb->setMaxResults(4)
    //     ->getQuery()
    //     ->getResult()
    // ;
}

?>