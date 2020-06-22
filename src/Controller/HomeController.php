<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Modules;
use App\Entity\Session;
use App\Entity\Categorie;
use App\Entity\Programme;
use App\Form\ModulesType;
use App\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
     * @Route("/")
     */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $user = $repoUser->findBy([], ['id' => 'ASC']);
        $repoSession = $this->getDoctrine()->getRepository(Session::class);
        $session = $repoSession->findBy([], ['id' => 'ASC']);

        return $this->render('home/index.html.twig', [
            "users" => $user,
            "sessions" => $session ]      
        );
    }
    /**
     * @Route("/stagiaire", name="stagiaire_list")
     */
    public function list_stagiaire()
    {
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $user = $repoUser->findBy([], ['id' => 'ASC']);
        

        return $this->render('home/stagiaire.html.twig', [
            "users" => $user]
             
        );
    }
    /**
     * @Route("/session", name="session_list")
     */
    public function list_session()
    {
        $repoSession = $this->getDoctrine()->getRepository(Session::class);
        $session = $repoSession->findBy([], ['id' => 'ASC']);

        return $this->render('home/session.html.twig', [
            "sessions" => $session ]   
             
        );
    }

       /**
     * @Route("/categorie/add", name="categorie_add")
     * @Route("/categorie/{id}/edit", name="categorie_edit")
     */
    public function add_editC(Categorie $categorie = null, Request $request) {
        // si le salarie n'existe pas, on instancie un nouveau Salarie (on est dans le cas d'un ajout)
        if(!$categorie){
           $categorie = new categorie();
       }

       // il faut créer un SalarieType au préalable (php bin/console make:form
       $form = $this->createForm(CategorieType::class, $categorie);

       $form->handleRequest($request);
       // si on soumet le formulaire et que le form est valide
       if ($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
           $categorie = $form->getData();
           // on ajoute le nouveau salarié
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($categorie);
           $entityManager->flush();
           // on redirige vers la liste des salariés (categorie_list étant le nom de la route qui liste tous les salariés dans categorieController)
           return $this->redirectToRoute('home');
       }
       
       /* on renvoie à la vue correspondante : 
           - le formulaire
           - le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
       */
       return $this->render('home/add_edit_categorie.html.twig', [
           'form' => $form->createView(),
           'editMode' => $categorie->getId() !== null
       ]);
   }

       /**
     * @Route("/module/add", name="module_add")
     * @Route("/module/{id}/edit", name="module_edit")
     */
    public function add_editM(Modules $module = null, Request $request) {
        // si le salarie n'existe pas, on instancie un nouveau Salarie (on est dans le cas d'un ajout)
        if(!$module){
           $module = new Modules();
       }

       // il faut créer un SalarieType au préalable (php bin/console make:form
       $form = $this->createForm(ModulesType::class, $module);

       $form->handleRequest($request);
       // si on soumet le formulaire et que le form est valide
       if ($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
           $module = $form->getData();
           // on ajoute le nouveau salarié
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($module);
           $entityManager->flush();
           // on redirige vers la liste des salariés (module_list étant le nom de la route qui liste tous les salariés dans moduleController)
           return $this->redirectToRoute('home');
       }
       
       /* on renvoie à la vue correspondante : 
           - le formulaire
           - le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
       */
       return $this->render('home/add_edit_module.html.twig', [
           'form' => $form->createView(),
           'editMode' => $module->getId() !== null
       ]);
   }


    /**
     * @Route("/stagiaire/{id}", name="stagiaire_show", methods="GET")
     */
    public function schowStagiaire(User $user): Response {
        return $this->render('home/showStagiaire.html.twig',[
            'user'=>$user
            ]);
    }

    /**
     * @Route("/session/{id}", name="session_show", methods="GET")
     */
    public function schowSession(Session $session): Response {
        
        $programme=$session->getProgrammes();

        return $this->render('home/showSession.html.twig',[
            'session'=>$session,
            'programmes'=>$programme
            ]);
    }
}
