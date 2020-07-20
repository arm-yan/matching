<?php

declare(strict_types=1);

namespace Armyan\Matching\Requirements;

class TimezoneRequirement implements Requirement
{
    /**
     * @var int
     */
    protected $value = 40;

    /**
     * @var string
     */
    protected $index = 'Timezone';

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
