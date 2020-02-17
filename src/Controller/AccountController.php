<?php

namespace App\Controller;

use App\Entity\Accounts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Account\AccountType;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{

    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Accounts::class);
        $users = $repository->findAll();

        return $this->render('account/index.html.twig', [
            'users' => $users,
        ]);
    }
    public function new(Request $request){

        $account = new Accounts();

        $form = $this->createForm(AccountType::class, $account);

        return $this->render('account/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function create(Request $request)
    {
        $account = new Accounts();
        
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $account = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
        }
        return $this->redirectToRoute('account_new');

        /*
        $em = $this->getDoctrine()->getManager();

        $account = new Accounts();
        $account->setLastName('Doe');
        $account->setFirstName('John');
        $account->setEmail('mikewatawski@gmail.com');
        $account->setPassword('123456');
        $form = $this->createForm(AccountType::class, $account);
        
        $registration = $form->getData();

        $em->persist($registration);
        $em->flush();*/


        //$em->persist($registration->getAccount());
       // $em->flush();

        
        //create a user object and initializes some data
        /*$account = new Accounts();
        $account->setLastName('Velayo');
        $account->setFirstName('Michael');
        $account->setEmail('mikewatawski@gmail.com');
        $account->setPassword('123456');

        $form = $this->createFormBuilder($account)
            ->add('last_name', TextType::class)
            ->add('first_name', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Account'])
            ->getForm();*/

        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        
        /*$entityManager = $this->getDoctrine()->getManager();

        $account = new Accounts();
        $account->setLastName('Velayo');
        $account->setFirstName('Michael');
        $account->setEmail('mikewatawski@gmail.com');
        $account->setPassword('123456');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($account);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();            
        */
    	
        //return $this->render('account/new.html.twig');
        
        
    }
}
