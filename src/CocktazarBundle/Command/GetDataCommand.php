<?php

namespace CocktazarBundle\Command;

use CocktazarBundle\Entity\Ingredient;
use CocktazarBundle\Entity\Recipe;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
          // the name of the command (the part after "bin/console")
          ->setName('cocktazar:get-data')

          // the short description shown while running "php bin/console list"
          ->setDescription('Get non-alcoolic cocktails from thecocktaildb.com')

          // the full command description shown when running the command with
          // the "--help" option
          ->setHelp("Just run it")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
          'Getting data',
          '============',
          '',
        ]);

        $ids = array();

        $jsonurl = "http://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic";
        $json = file_get_contents($jsonurl);
        $decoded = json_decode($json, true);

        foreach ($decoded["drinks"] as $drink) {
          array_push($ids, $drink["idDrink"]);
        }

        // outputs a message followed by a "\n"

        foreach ($ids as $id) {
          $jsonurl = "http://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=" . $id;
          $json = file_get_contents($jsonurl);
          $decoded = json_decode($json, true);
          
          $fetched = $decoded["drinks"][0];

          $recipe = new Recipe;
          if ($fetched["strDrink"] && $fetched["strDrinkThumb"] &&
            $fetched["strInstructions"] && strlen($fetched["strInstructions"]) < 1000) {
            $output->writeln("Create " . $fetched["strDrink"]);

            $recipe->setTitle($fetched["strDrink"]);
            $recipe->setImageUrl($fetched["strDrinkThumb"]);
            $recipe->setInstructions($fetched["strInstructions"]);

            $em = $this->getContainer()->get('doctrine')->getEntityManager();
            $em->persist($recipe);

            foreach ($fetched as $key => $name) {
              $i = 1;
              if (strpos($key, "strIngredient") !== False) {
                if ($name) {
                  $ingredient = new Ingredient;
                  $ingredient->setName($name);
                  $ingredient->setMeasure($fetched["strMeasure" . $i]);
                  $ingredient->setRecipe($recipe);
                  $em->persist($ingredient);
                  ++$i;
                }
              }
            }
            $em->flush();
          }
        }

        // $output->writeln($ids);
        
    }
}
