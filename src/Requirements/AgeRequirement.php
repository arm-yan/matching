<?php

declare(strict_types=1);

namespace Armyan\Matching\Requirements;

class AgeRequirement implements Requirement
{
    /**
     * @var int
     */
    protected $value = 30;

    /**
     * @var string
     */
    protected $index = 'Age';

    /**
     * @param array $person
     * @param array $pair
     * @return int
     */
    public function getMatching(array $person, array $pair) : int
    {
        if (abs($person[$this->index] - $pair[$this->index]) <= 5) {
           return $this->value;
        }

        return 0;
    }
}
