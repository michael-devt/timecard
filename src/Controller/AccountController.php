<?php

namespace App\Controller;

use App\Entity\Accounts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Account\AccountType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends AbstractController
{

    public function index(SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(Accounts::class)->findAll();
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
            $this->addFlash(
                'notice',
                'New account was created!'
            );
            return $this->redirectToRoute('accounts');
        }
    }

    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $account = $entityManager->getRepository(Accounts::class)->find($id);

        $form = $this->createForm(AccountType::class, $account);

        return $this->render('account/edit.html.twig',[
            'form' => $form->createView(),
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $account = $entityManager->getRepository(Accounts::class)->find($id);

        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $account = $form->getData();
            $entityManager->persist($account);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Your changes was saved!'
            );
            return $this->redirectToRoute('accounts');
        }
       
    }

    public function show($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $account = $entityManager->getRepository(Accounts::class)->find($id);
        if (!$account){
            throw $this->createNotFoundException('The account does not exist');
        }
        return $this->render('account/show.html.twig',[
            'account' => $account,
        ]);
    }

    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $account = $entityManager->getRepository(Accounts::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($account);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'The selected account was deleted!'
        );
        return $this->redirectToRoute('accounts');
    }
}
