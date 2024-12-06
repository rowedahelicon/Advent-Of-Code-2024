<?php

class WordSearch
{
    protected array $input = array();

    public int $xmas_count = 0;
    public int $x_mas_count = 0;

    function __construct()
    {
        $this->input = explode("\n", trim(file_get_contents(file_exists('inputs/4.txt') ? 'inputs/4.txt' : 'samples/4.txt')));

        foreach ($this->input as $k => $v)
        {
            foreach (str_split($v) as $lk => $lv)
            {
                if ($lv == "X")
                {
                    if ($this->locate_letter('M', $k-1, $lk-1) && $this->locate_letter('A', $k-2, $lk-2) && $this->locate_letter('S', $k-3, $lk-3)) $this->xmas_count++;
                    if ($this->locate_letter('M', $k-1, $lk) && $this->locate_letter('A', $k-2, $lk) && $this->locate_letter('S', $k-3, $lk)) $this->xmas_count++;
                    if ($this->locate_letter('M', $k-1, $lk+1) && $this->locate_letter('A', $k-2, $lk+2) && $this->locate_letter('S', $k-3, $lk+3)) $this->xmas_count++;

                    if ($this->locate_letter('M', $k, $lk-1) && $this->locate_letter('A', $k, $lk-2) && $this->locate_letter('S', $k, $lk-3)) $this->xmas_count++;
                    if ($this->locate_letter('M', $k, $lk+1) && $this->locate_letter('A', $k, $lk+2) && $this->locate_letter('S', $k, $lk+3)) $this->xmas_count++;

                    if ($this->locate_letter('M', $k+1, $lk-1) && $this->locate_letter('A', $k+2, $lk-2) && $this->locate_letter('S', $k+3, $lk-3)) $this->xmas_count++;
                    if ($this->locate_letter('M', $k+1, $lk) && $this->locate_letter('A', $k+2, $lk) && $this->locate_letter('S', $k+3, $lk)) $this->xmas_count++;
                    if ($this->locate_letter('M', $k+1, $lk+1) && $this->locate_letter('A', $k+2, $lk+2) && $this->locate_letter('S', $k+3, $lk+3)) $this->xmas_count++;
                }
                else if ($lv == "A")
                {
                    if ($this->locate_letter('M', $k-1, $lk-1) && $this->locate_letter('S', $k-1, $lk+1) && $this->locate_letter('M', $k+1, $lk-1) && $this->locate_letter('S', $k+1, $lk+1)) $this->x_mas_count++;
                    if ($this->locate_letter('S', $k-1, $lk-1) && $this->locate_letter('M', $k-1, $lk+1) && $this->locate_letter('S', $k+1, $lk-1) && $this->locate_letter('M', $k+1, $lk+1)) $this->x_mas_count++;
                    if ($this->locate_letter('M', $k-1, $lk-1) && $this->locate_letter('M', $k-1, $lk+1) && $this->locate_letter('S', $k+1, $lk-1) && $this->locate_letter('S', $k+1, $lk+1)) $this->x_mas_count++;
                    if ($this->locate_letter('S', $k-1, $lk-1) && $this->locate_letter('S', $k-1, $lk+1) && $this->locate_letter('M', $k+1, $lk-1) && $this->locate_letter('M', $k+1, $lk+1)) $this->x_mas_count++;
                }
                else continue;
            }
        }
    }

    function locate_letter(string $letter, int $x, int $y)
    {
        return (isset($this->input[$x][$y]) && $this->input[$x][$y] == $letter) ? TRUE : FALSE;
    }
}

$wordsearch = new WordSearch();
print 'Part 1: '.$wordsearch->xmas_count.PHP_EOL;
print 'Part 2: '.$wordsearch->x_mas_count.PHP_EOL;