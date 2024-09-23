<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{   private $authors;
    public function __construct(){
            $this->authors=[
               ['id'=>1, 'name'=>'Taha Hussain','nbrBooks'=>300,'picture'=>'images/img2.jpg', 'email'=>"taha@gmail.com"],
                               ['id'=>2, 'name'=>'Victor Hugo','nbrBooks'=>200,'picture'=>'images/img1.jpg','email'=>"vh@gmail.com"],
            ];
    }
   #[Route("/library",name:"app_library",methods:["GET"])]
    public function index(){
       return $this->render('author/index.html.twig');
   }

   #[Route("/author/{name}",
       name:"app_author",
       methods:["GET"],
       defaults:["name"=>"taha hussain"])]
   public function showAuthor($name){
       return $this->render('author/show.html.twig',
       array(
           'name'=>$name
       ));
   }

   //return list of authors
   #[Route("/list",name:"app_list",methods:["GET"])]
   public function authorList(){

       return $this->render('author/list.html.twig',
       [
           'authors'=>$this->authors
       ]);
       }
   #[Route("/showDetails/{id}", name:"app_showDetail", methods:["GET"])]
   public function showDetailsAction($id){
       // Rechercher l'auteur en fonction de son ID
       foreach ($this->authors as $author) {
           if ($author['id'] == $id) {
               // Renvoyer les détails de l'auteur à la vue
               return $this->render('author/showDetails.html.twig', [
                   'author' => $author
               ]);
           }
       }

       // Si l'auteur n'est pas trouvé, afficher une erreur 404
       throw $this->createNotFoundException('Auteur non trouvé');
   }


}