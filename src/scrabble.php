<?php
    class Scrabble {

        private $dictionary = ['a' => 1, 'b' => 3,'c' => 3, 'd' => 2, 'e' => 1, 'f' => 4, 'g' => 2, 'h' => 4, 'i' => 1, 'j' => 8, 'k' => 5, 'v' => 4, 'w' => 4, 'x' => 8, 'y' => 4, 'z' => 10, 'l' => 1, 'm' => 3, 'n' => 1, 'o' => 1, 'p' => 3, 'q' => 10, 'r' => 1, 's' => 1, 't' => 1, 'u' => 1];

        function check_score($word) {
            $word = strtolower($word);
            $word = preg_replace('/[^a-z]/', '', $word);


            if ($this->check_word($word)) {
                $wordarray = str_split($word);
                $wordscore = 0;

                foreach ($wordarray as $letter1) {
                    foreach ($this->dictionary as $letter2 => $letterscore) {
                        if ($letter1 == $letter2) {
                            $wordscore = $wordscore + $letterscore;
                        }
                    }
                }
                return $wordscore;
            }
            else
            {
                $slang = $this->check_slang($word);
                if($slang) {
                    return $slang;
                }
                else {
                    return false;
                }
            }
        }

        function check_word($word) {
            $word_url = 'http://www.dictionaryapi.com/api/v1/references/collegiate/xml/'.$word.'?key=59c48b7e-eff8-4bd0-9c5b-ad0781f94ca3';
            $response = file_get_contents($word_url);
            if ($response) {
                $word_data = simplexml_load_string($response);

                // return $word_data['@attributes']['entry']['@attributes']['id'];
                if ($word_data->entry->ew == $word) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }

        function check_slang($word) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://mashape-community-urban-dictionary.p.mashape.com/define?term='.$word
            ));

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "X-Mashape-Key: 3pVNO7DLr8mshSYole4ygZE9Ro5fp1YvjcjjsnCJzWQHVxvEzd",
                "Accept: text/plain"
            ));

            $result = curl_exec($curl);
            $result = json_decode($result);
            if ($result->result_type != 'no_results') {
                $def_list = count($result->list);
                $choose = rand(0, $def_list-1);
                return $result->list[$choose]->definition;
                // return $result;
            } else {
                return false;
            }
        }

    }



 ?>
