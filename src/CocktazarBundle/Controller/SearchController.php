<?php

namespace CocktazarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    public function searchAction()
    {
        $search = $_POST["ingredients"];
        
        $ingredients = $this->getDoctrine()
        ->getRepository('CocktazarBundle:Ingredient')
        ->findBy(array("name" => $search));
        return $this->render('CocktazarBundle:Search:search.html.twig', array(
           "ingredients" => $ingredients,
           "search" => $search,
        ));
    }

}
