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
            $input = 'fri4 end';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_score($input);

            $this->assertEquals($result, 10);
        }

        // function test_check_word_exists() {
        //     $input = 'hypocrite';
        //     $test_scrabble = new Scrabble;
        //
        //     $result = $test_scrabble->check_score($input);
        //
        //     $this->assertEquals(true, $result);
        // }

        function test_check_word_does_not_exist() {
            $input = 'asdf';
            $test_scrabble = new Scrabble;

            $result = $test_scrabble->check_score($input);

            $this->assertEquals(false, $result);
        }


    }

 ?>
