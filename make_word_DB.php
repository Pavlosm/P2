<?php
/**
 * The code in this file scraps the words from the 3000 most common english words from
 * http://www.paulnoll.com/Books/Clear-English/ and puts them in a text file that serves as a word database.
 *
 * NOTE: if the text-file exists then it does not make a new one.
 */

// If the word database does not exist create a new file
if (! file_exists("word_DB.txt")){

    $word_list = "";

    for ($i=1; $i < 31; $i +=2) {

        $link_to_common_words = forma_link($i);

        $contents = file_get_contents($link_to_common_words);

        // get the list items
        preg_match_all("/<li>(.*?)<\/li>/s", $contents, $out);

        // copy each items content to the word list
        foreach($out[1] as $ar1) {
            $word_list .= $ar1.",";
        }
    }
}

// formats the URL given a number
function format_link($number) {

    $page1 = format_number($number);
    $page2 = format_number($number + 1);

    return "http://www.paulnoll.com/Books/Clear-English/words-".$page1."-".$page2."-hundred.html";
}

// formats and returns as string number to the form 1->01.
// If the number is > 10 then it just returns its string representation.
function format_number($number) {

    if ($number >= 10) {
        $number_to_string = strval($number);
    } else {
        $number_to_string =  "0".strval($number);
    }

    return $number_to_string();
}