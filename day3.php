<?php
(array) $input = trim(file_get_contents(file_exists('inputs/3.txt') ? 'inputs/3.txt' : 'samples/3.txt'));
(int)   $mul_inst = 0;
(int)   $mul_inst_adv = 0;

preg_match_all('/(mul\(([0-9]*),([0-9]*)\))/m', $input, $mul, PREG_SET_ORDER, 0);
foreach ($mul as $k => $v) $mul_inst += (isset($v[2]) && isset($v[3]) ? $v[2] * $v[3] : 0);

$adv_mul = preg_replace('/don\'t\(\)(.*?)do\(\)/ms', '', $input);

preg_match_all('/(mul\(([0-9]*),([0-9]*)\))/m', $adv_mul, $mul, PREG_SET_ORDER, 0);
foreach ($mul as $k => $v) $mul_inst_adv += (isset($v[2]) && isset($v[3]) ? $v[2] * $v[3] : 0);

print 'Part 1: '.$mul_inst.PHP_EOL;
print 'Part 2: '.$mul_inst_adv.PHP_EOL;