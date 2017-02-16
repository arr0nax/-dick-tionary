<?php

    require_once 'src/scrabble.php';

    class ScrabbleTest extends PHPUnit_Framework_TestCase
    {
        function test_letter_score() {
            $input = 's';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_score($input);

            $this->assertEquals($result, 1);
        }

        function test_word_score() {
            $input = 'suck';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_score($input);

            $this->assertEquals($result, 10);
        }

        function test_remove_non_alphabetical_characters() {
            $input = 'l33t h4x0r';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_score($input);

            $this->assertEquals($result, 15);
        }

        function test_check_word_exists() {
            $input = 'hypocrite';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_word($input);

            $this->assertEquals(1, $result);
        }


    }

 ?>
