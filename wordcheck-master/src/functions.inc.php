<?php
function check($paragraph, $word)
{   
    //find position of first occurence of case insensitive sub-string in a string
    if (stripos($paragraph, $word) !== false)
        //if word exists return '1'
        return 1;
    else
        //word doesnt exist - return '0'
        return 0;
}
