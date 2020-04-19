<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController{
        
    /**
     * 
     * @var PropertyRepository
     */
    private $repository;
    private $em;

    public function __construct(PropertyRepository $repository,ObjectManager $em)
        {   
            $this->repository=$repository;
            $this->em=$em;
        }
    
    /**
     * 
     * @Route("/admin" , name="admin.property.index")    
     */
    public function index() : Response
    {
        $properties = $this->repository->findAll();
        return $this->render("admin/property/index.html.twig",compact('properties'));
    }

    /**
     * @Route("/admin/property/new", name="admin.property.new") 
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }
        $this->addFlash('success','Votre bien est créé');
        return $this->render("admin/property/new.html.twig",[
            'property'=> $property,
            'form'    => $form->createView()
        ]);
    }
    
    /**
     * 
     * @Route("/admin/property/{id}" , name="admin.property.edit",methods="GET|POST")    
     */
    public function edit(Property $property,Request $request) : Response
    {
        $form = $this->createForm(PropertyType::class,$property);//creation du formulaire avec les valeurs de 'property'
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }
        $this->addFlash('success','Votre bien est modifié');

        return $this->render("admin/property/edit.html.twig",[
            'property'=> $property,
            'form'    => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     */

    public function delete(Property $property,Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token')))//pour la sécurité en suppression
        {
            $this->em->remove($property);
            $this->em->flush();
        }
        $this->addFlash('success','Votre bien est supprimé');
        return $this->redirectToRoute('admin.property.index');
    }
}

?>