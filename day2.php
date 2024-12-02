<?php
(array) $input = explode("\n", trim(file_get_contents(file_exists('inputs/2.txt') ? 'inputs/2.txt' : 'samples/2.txt')));
(int)   $pass_1_safe = 0;
(int)   $pass_2_safe = 0;

function check_safety(array $array)
{
    (bool) $increasing = ($array[0] < $array[1]) ? TRUE : FALSE;

    foreach ($array as $k => $v)
    {
        if (!isset($array[$k+1])) continue;

        $abs = abs($array[$k+1] - $v);

        if (($abs < 1 || $abs > 3)) return array(FALSE, $k);

        if ($k > 0 && $v < $array[$k+1] && !$increasing) return array(FALSE, $k);
        if ($k > 0 && $v > $array[$k+1] && $increasing) return array(FALSE, $k);
    }

    return array(TRUE);
}

foreach ($input as $k => $v)
{
    preg_match_all('/[0-9]*[^ ]/', trim($v), $matches, PREG_PATTERN_ORDER, 0);

    $safe = check_safety($matches[0]);

    if ($safe[0])
    {
        $pass_1_safe++;
        $pass_2_safe++;
    }
    else
    {
        $copy = $matches[0];
        array_splice($copy, $safe[1], 1);
        if (check_safety($copy)[0])
        {
            $pass_2_safe++;
            continue;
        }

        $copy = $matches[0];
        array_splice($copy, ($safe[1]+1), 1);
        if (check_safety($copy)[0])
        {
            $pass_2_safe++;
            continue;
        }

        if ($safe[1] == 1)
        {
            $copy = $matches[0];
            array_splice($copy, 0, 1);
            if (check_safety($copy)[0])
            {
                $pass_2_safe++;
                continue;
            }
        }
    }
}

print 'Part 1: '.$pass_1_safe.PHP_EOL;
print 'Part 2: '.$pass_2_safe.PHP_EOL;