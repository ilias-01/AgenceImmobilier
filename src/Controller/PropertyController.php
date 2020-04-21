<?php
namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notifications\ContactNotifications;
use Doctrine\Common\Persistence\ObjectManager;
use  Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController{

   /**
    * @var PropertyRepository
    */
    private $repository;

    /**
     * @var ObjectManager
    */
    private $em;


    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {   
        $this->repository=$repository;
        $this->em=$em;
    }
   
    /**
     * @Route ("/biens",name="property.index") 
     * @return Response 
     */
    public function index(PaginatorInterface $paginator,Request $request) :Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);//le formulaire envoie les données par la méthode spécifié

        $properties = $paginator->paginate(
            $this->repository->findByVisibletyQuery($search),
            $request->query->getInt('page',1),
            9
        );

        return $this->render('property/index.html.twig',[
           'current_menu' => 'properties',
           'properties' =>  $properties,
           'form'    => $form->createView() 
        ]);
    }

    /**
     * @Route ("/biens/{slug}-{id}",name="property.show", requirements={"slug": "[a-z0-9\-]*"}) 
     * @param Property $property
     * @return Response 
     */
    public function show(Property $property ,string $slug,Request $request ,ContactNotifications $notification ,MailerInterface $mailer) :Response
    {
        
        if( $property->getSlug() !== $slug ){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);

            /*********mailer */
            $email = (new Email())
            ->from('noreply@agence.fr')
            ->to('ilyas.mewa@gmail.com')
            ->subject('Test Symfony Mailer! | Agence'.$contact->getProperty()->getTitle())
            ->text($contact->getMessage());
        
            $mailer->send($email);

            /*********mailer */
            $this->addFlash('succes','votre message est bien transférer');
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);

        }

        return $this->render('property/show.html.twig',[
           'property' => $property, 
           'current_menu' => 'properties',
           'form' => $form->createView()
        ]);
    }
}

?>