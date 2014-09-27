<?php
/**
 * This is a library file containing the functions that create the word database.
 * The database is created from the http://www.paulnoll.com/Books/Clear-English/
 * website (3000 most common english words).
 *
 * All functions here are explicitly developed for the URL of the above website.
 */


function get_word_DB() {
    create_word_DB();
    $words = file_get_contents("word_DB.txt");
    return explode(",", "$words");
}

/*
 * If a word database file name word_DB.txt does not exit in the
 * current directory the it creates a new one with the word data
 * mentioned above.
 */
function create_word_DB() {

    if (! file_exists("word_DB.txt")){

        $word_list = "";

        for ($i=1; $i < 31; $i +=2) {

            $link_to_common_words = format_link($i);

            $contents = file_get_contents($link_to_common_words);

            // get the list items
            preg_match_all("/<li>(.*?)<\/li>/s", $contents, $out);

            // copy each items content to the word list
            foreach($out[1] as $ar1) {
                $word_list .= trim($ar1).",";
            }
        }

        file_put_contents("word_DB.txt", trim($word_list, ","));
    }
}

/*
 * Formats the specific URL given a number.
 */
function format_link($number) {

    $page1 = format_number($number);
    $page2 = format_number($number + 1);

    return "http://www.paulnoll.com/Books/Clear-English/words-".$page1."-".$page2."-hundred.html";
}

/*
 * Formats and returns the string representation of a number.
 *
 * If the number is < 10 it returns it with a "0" in front (ex. 1-> "01")
 * Otherwise it just returns the string representation of the number as it is.
 */
function format_number($number) {

    if ($number >= 10) {
        $number_to_string = strval($number);
    } else {
        $number_to_string =  "0".strval($number);
    }

    return $number_to_string;
}