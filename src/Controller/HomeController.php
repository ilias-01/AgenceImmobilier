<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController {
    /**
     * @Route ("/",name="home")
     * @return Response 
     */
    public function index(PropertyRepository $repository) : Response
    {   
        $properties=$repository->findLatest();

        return $this->render('pages/homePage.html.twig',[
            'properties' => $properties
        ]);
    }
    


}

?>