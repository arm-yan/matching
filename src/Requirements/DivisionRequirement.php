<?php

declare(strict_types=1);

namespace App\Services\MatchingService\Requirements;

class DivisionRequirement implements Requirement
{
    /**
     * @var int
     */
    protected $value = 30;

    /**
     * @var string
     */
    protected $index = 'Division';

    /**
     * @param array $person
     * @param array $pair
     * @return int
     */
    public function getMatching(array $person, array $pair) : int
    {
        if ($person[$this->index] == $pair[$this->index]) {
           return $this->value;
        }

        return 0;
    }
}
