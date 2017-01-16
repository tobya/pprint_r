<?php

//Provide input in the form of a string representation of print_R array.
//Origionally provided by Adrian Cid Almaguer as answer to this question
//http://stackoverflow.com/questions/7025909/how-create-an-array-from-the-output-of-an-array-printed-with-print-r/7025941#7025941
//http://stackoverflow.com/a/28687593/6244
function unprint_r(&$output)
{
    $expecting = 0; // 0=nothing in particular, 1=array open paren '(', 2=array element or close paren ')'
    $lines = explode("\n", $output);
    $result = null;
    $topArray = null;
    $arrayStack = array();
    $matches = null;
    while (!empty($lines) && $result === null)
    {
        $line = array_shift($lines);
        $trim = trim($line);
        if ($trim == 'Array')
        {
            if ($expecting == 0)
            {
                $topArray = array();
                $expecting = 1;
            }
            else
            {
                trigger_error("Unknown array.");
            }
        }
        else if ($expecting == 1 && $trim == '(')
        {
            $expecting = 2;
        }
        else if ($expecting == 2 && preg_match('/^\[(.+?)\] \=\> (.+)$/', $trim, $matches)) // array element
        {
            list ($fullMatch, $key, $element) = $matches;
            if (trim($element) == 'Array')
            {
                $topArray[$key] = array();
                $newTopArray =& $topArray[$key];
                $arrayStack[] =& $topArray;
                $topArray =& $newTopArray;
                $expecting = 1;
            }
            else
            {
                $topArray[$key] = $element;
            }
        }
        else if ($expecting == 2 && $trim == ')') // end current array
        {
            if (empty($arrayStack))
            {
                $result = $topArray;
            }
            else // pop into parent array
            {
                // safe array pop
                $keys = array_keys($arrayStack);
                $lastKey = array_pop($keys);
                $temp =& $arrayStack[$lastKey];
                unset($arrayStack[$lastKey]);
                $topArray =& $temp;
            }
        }
        // Added this to allow for multi line strings.
    else if (!empty($trim) && $expecting == 2)
    {
        // Expecting close parent or element, but got just a string
        $topArray[$key] .= "\n".$line;
    }
        else if (!empty($trim))
        {
            $result = $line;
        }
    }

    $output = implode("\n", $lines);
    return $result;
}

/**
* @param string $output : The output of a multiple print_r calls, separated by newlines
* @return mixed[] : parseable elements of $output
*/
function print_r_reverse_multiple($output)
{
    $result = array();
    while (($reverse = unprint_r($output)) !== NULL)
    {
        $result[] = $reverse;
    }
    return $result;
}

?>
