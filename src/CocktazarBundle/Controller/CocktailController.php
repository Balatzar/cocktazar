<?php

namespace CocktazarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CocktailController extends Controller
{
    public function showAction($id)
    {
        $recipe = $this->getDoctrine()
        ->getRepository('CocktazarBundle:Recipe')
        ->findOneById($id);
        
        $ingredients = $this->getDoctrine()
        ->getRepository('CocktazarBundle:Ingredient')
        ->findByRecipe($recipe->getId());

        return $this->render('CocktazarBundle:Cocktail:show.html.twig', array(
            "recipe" => $recipe,
            "ingredients" => $ingredients,
        ));
    }

}
