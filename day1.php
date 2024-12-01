<?php
(array) $input = explode("\n", trim(file_get_contents(file_exists('inputs/1.txt') ? 'inputs/1.txt' : 'samples/1.txt')));
(array) $lists = array('left' => array(), 'right' => array());
(int)   $total_distance = 0;
(int)   $similarity_score = 0;

foreach ($input as $k => $v)
{    
    preg_match_all('/[0-9]*[^ ]/', trim($v), $matches, PREG_SET_ORDER, 0);
    $lists['left'][] = $matches[0][0];
    $lists['right'][] = $matches[1][0];
}

(array) $occurances = array_count_values($lists['right']);

foreach ($lists['left'] as $k => $v)
{
    if (!empty($occurances[$v])) $similarity_score += ($v * $occurances[$v]);
}

asort($lists['left']);
asort($lists['right']);

$lists['left'] = array_values($lists['left']);
$lists['right'] = array_values($lists['right']);

foreach ($lists['left'] as $k => $v)
{
    $total_distance += abs($v - $lists['right'][$k]);
}

print 'Part 1: '.$total_distance.PHP_EOL;
print 'Part 2: '.$similarity_score.PHP_EOL;