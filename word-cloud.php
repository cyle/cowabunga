<?php

/*

    Community Planit Word Cloud Data Preparation
    
    Because COWABUNGA is important.

*/

// we'll ignore these words eventually
$common_words = array(
    'the', 'to', 'and', 'of', 'a', 'i', 'in', 'that', 'is', 'for', 'with',
    'it', 'my', 'be', 'on', 'as', 'at', 'are', 'have', 'you', 'we', 'but',
    'or', 'was', 'do', 'not', 'would', 'can', 'an', 'me', 'it\'s', 'has',
    'also', 'if', 'they', 'get', 'am', 'i\'d'
);

// this'll hold the actual frequency of each word
$word_frequency = array();

// open up the CSV and start parsing contents
$csv = file_get_contents('emerson-uncommon.csv');
$csv = str_replace("\r\n", "\n", $csv); // sanitize
$lines = explode("\n", $csv); // break it by line

// go through each line
foreach ($lines as $line) {
    
    //echo $line."\n"; // debug
    
    // get the pieces of the row; it's CSV
    $pieces = str_getcsv($line);
    
    //print_r($pieces); // debug
    
    // grab all the words from the row, if there are any
    $all_words = '';
    foreach ($pieces as $piece) {
        if (trim($piece) != '') {
            $all_words .= $piece;
        }
    }
    
    // if this line has nothing, move on
    if (trim($all_words) == '') {
        continue;
    }
    
    // use some regex magic to get words
    $get_words = preg_match_all('/\b\S+\b/', $all_words, $word_matches);
    
    //print_r($word_matches); // debug
    
    // for each word found, add it to the frequency counter
    foreach ($word_matches[0] as $word) {
        $word = strtolower(trim($word));
        if (isset($word_frequency[$word])) {
            $word_frequency[$word]++;
        } else {
            $word_frequency[$word] = 1;
        }
    }
}

// sort the word frequency array so that the most-used are on top
arsort($word_frequency);

// let's rank these
$counter = 1;

// go through each word found
foreach ($word_frequency as $the_word => $word_count) {
    // if the word is not valid, or isn't used enough, skip it
    if (in_array($the_word, $common_words) || $word_count <= 100) {
        continue;
    }
    //echo '#'.$counter.' is '.$the_word.' with '.$word_count.' uses'."\n";
    echo $the_word.':'.$word_count."\n"; // this is the format the word cloud site wants
    $counter++;
}

// that's it. feed the result into the word cloud site.