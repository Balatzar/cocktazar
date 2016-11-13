<?php

namespace CocktazarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CocktazarBundle\Entity\Recipe;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $recipes = $this->getDoctrine()
        ->getRepository('CocktazarBundle:Recipe')
        ->findAll();

        $all_ingredients = $this->getDoctrine()
        ->getRepository('CocktazarBundle:Ingredient')
        ->findBy([], ['name' => 'ASC']);

        $ingredients = array();

        foreach ($all_ingredients as $ingredient) {
            $name = $ingredient->getName();
            if (in_array($name, $ingredients) === FALSE) {
                array_push($ingredients, $name);
            }
        }

        return $this->render('CocktazarBundle:Default:index.html.twig', array(
            "recipes" => $recipes,
            "ingredients" => $ingredients,
        ));
    }
}
