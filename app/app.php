<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/scrabble.php";

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

    $app->get('/', function() use ($app) {
        return $app["twig"]->render("homepage.html.twig");
    });

    $app->post('/see_score', function() use($app) {
        $new_scrabble = new Scrabble;
        $result = $new_scrabble->check_score($_POST['word']);
        // var_dump($result);
        if(gettype($result) == "integer") {
            return $app["twig"]->render("see_score.html.twig", array("word_score" => $result, "word" => ($_POST['word']), 'type' => 'word'));
        }
        elseif (gettype($result) == "string") {
            return $app["twig"]->render("see_score.html.twig", array("word" => ($_POST['word']), "word_score" => $result, 'type' => 'slang'));
        }
        else {
            return $app["twig"]->render("see_score.html.twig", array("word" => ($_POST['word']), "word_score" => $result, 'type' => 'non_word'));
        }
    });

    return $app;

 ?>
