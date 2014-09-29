<?php
/**
 * Includes the logic for creating the xkcd style password
 */


require('make_word_DB_lib.php');

$my_special_chars = "!@#$%^&*()_+)";

$array_of_words = get_word_DB();

// Determine if there is a defince number of words or else default to 4
if (array_key_exists('num_words', $_POST))
    $number_of_words = $_POST['num_words'];
else
    $number_of_words = "4";

// Check if checkboxes have value, and turn them to boolean conditions
$add_number = array_key_exists('number', $_POST);
$add_special_char = array_key_exists('special_char', $_POST);
$capitalize_first_letter = array_key_exists('capital_letter', $_POST);

// Calls the create password method
$password = make_password ( $array_of_words,
                            $number_of_words,
                            $add_number,
                            $add_special_char,
                            $capitalize_first_letter );

/*
 * Creates a new password given the specified parameters
 */
function make_password($word_list, $num_of_words, $add_number, $add_special_char, $capitalize_first_letter ) {

    if ( !is_numeric($num_of_words) || intval($num_of_words) > 6 || intval($num_of_words) < 1  )
        return "Error: the number of words should be a numeric value between [ 1 - 6 ]";

    $number_of_words = intval($num_of_words);

    $rand_word_keys = array_rand($word_list, $number_of_words);

    if ( is_integer($rand_word_keys) ) {
        $new_password = $word_list[$rand_word_keys];
    } else {
        $new_password = "";
        foreach($rand_word_keys as $word_key)
            $new_password .= $word_list[$word_key]."-";
    }

    $new_password = trim($new_password, "-");

    if ($capitalize_first_letter)
        $new_password = ucfirst($new_password);

    if ($add_number)
        $new_password .= strval(rand(0, 9));

    if ($add_special_char)
        $new_password = add_special_char($new_password);

    return $new_password;
}


function add_special_char($password)
{
    $random_index = rand(0, strlen($password) -2);
    $random_special_char = $GLOBALS['my_special_chars'][rand(0, strlen($GLOBALS['my_special_chars'])-1)];
    $new_password = substr($password, 0, $random_index).$random_special_char.substr($password, $random_index);
    return $new_password;
}
