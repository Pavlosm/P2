<?php
/**
 * Includes the logic for creating the xkcd style password
 */

require('make_word_DB_lib.php');


$array_of_words = get_word_DB();

$password = make_password(3, $array_of_words);

/*
 * Creates a new password given the specified parameters
 */
function make_password($number_of_words, $array) {

    $rand_word_keys = array_rand($array, $number_of_words);

    $new_password = "";

    foreach($rand_word_keys as $word_key) {
        $new_password .= $array[$word_key]."-";
    }

    return trim($new_password, "-");
}



