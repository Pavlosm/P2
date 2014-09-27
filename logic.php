<?php
/**
 * Includes the logic for creating the xkcd style password
 */

require('make_word_DB_lib.php');


$array_of_words = get_word_DB();

$special_chars = "!@#$%^&*()_-+)";

$error = "";

if (array_key_exists('num_words', $_POST)) {
    $number_of_words = intval($_POST['num_words']);
} else {
    $number_of_words = 4;
}
$add_number = array_key_exists('number', $_POST);
$add_special_char = array_key_exists('special_char', $_POST);
$capitalize_first_letter = array_key_exists('capital_letters', $_POST);


$password = make_password($array_of_words, $number_of_words, $add_number, $add_special_char, $capitalize_first_letter);


/*
 * Creates a new password given the specified parameters
 */
function make_password($word_list, $number_of_words, $add_number, $add_special_char, $capitalize_first_letter ) {

    $rand_word_keys = array_rand($word_list, $number_of_words);

    $new_password = "";

    if ($add_number) {
        $new_password .= strval(rand(0, 9));
    }

    $i = 0;
    foreach($rand_word_keys as $word_key) {
        if( $i == 0 && $capitalize_first_letter) {
            $new_password .= ucfirst($word_list[$word_key])."-";
        } else {
            $new_password .= $word_list[$word_key]."-";
        }
        $i++;
    }

    if ($add_special_char) {

    }

    return trim($new_password, "-");
}




