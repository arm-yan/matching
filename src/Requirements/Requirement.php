<?php

declare(strict_types=1);

namespace App\Services\MatchingService\Requirements;

interface Requirement
{
     public function getMatching(array $person, array $pair) : int;
}
