<?php

declare(strict_types=1);

namespace Armyan\Matching\Requirements;

interface Requirement
{
     public function getMatching(array $person, array $pair) : int;
}
