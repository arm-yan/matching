<?php

declare(strict_types=1);

namespace App\Services\MatchingService;

use App\Services\MatchingService\Requirements\AgeRequirement;
use App\Services\MatchingService\Requirements\DivisionRequirement;
use App\Services\MatchingService\Requirements\Requirement;
use App\Services\MatchingService\Requirements\TimezoneRequirement;
use stdClass;

class Matching
{
    /**
     * Stores instances of Requirement,
     * algorithms for matching logic
     *
     * @var array
     */
    protected $requirements = [];

    /**
     * Temporary store for combinations set
     *
     * @var array
     */
    protected $combination = [];

    /**
     * Input data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Highest average combination
     *
     * @var array
     */
    protected $highestAverageCombination = [];

    /**
     * Highest average matching score
     *
     * @var int
     */
    protected $highestAverageScore = 0;

    public function __construct()
    {
        $ageRequirement = new AgeRequirement();
        $timeZoneRequirement = new TimezoneRequirement();
        $divisionRequirement = new DivisionRequirement();

        $this->requirements[] = $ageRequirement;
        $this->requirements[] = $timeZoneRequirement;
        $this->requirements[] = $divisionRequirement;
    }

    /**
     * Determine the set of combination with highest average score,
     * by given employee list.
     *
     * @param array $data
     * @return array
     */
    public function getHighestAverageSet(array $data) : array
    {
        $this->data = $data;

        $participants = array_keys($data);
        $unique_pairs = $this->generateUniquePairs($participants);

        $n = count($unique_pairs);

        $this->generateSets(0, count($participants) / 2, $unique_pairs, $n);

        $return = [
            'score' => $this->highestAverageScore,
            'set'   => $this->highestAverageCombination,
        ];

        return $return;
    }

    /**
     * Generate all the possible pairs
     *
     * @param $participants
     * @return array
     */
    public function generateUniquePairs($participants) {
        $participantCount = count($participants);

        $pairs = [];
        $pos = 0;

        for ($i = 0; $i < $participantCount; $i++) {
            for ($j = $i + 1; $j < $participantCount; $j++) {
                $pairs[$pos++] = [$participants[$i], $participants[$j]];
            }
        }

        return $pairs;
    }

    /**
     * Generate unique sets and calculate their matching score
     *
     * @param $start
     * @param $choose
     * @param $arr
     * @param $n
     */
    protected function generateSets($start, $choose, $arr, $n)
    {

        if ($choose == 0) {
            $participantCounts = new stdClass();
            $hasDuplicates = false;

            foreach($this->combination as $combination) {
                if (!$hasDuplicates) {
                    if (property_exists($participantCounts, (string)$combination[0])) {
                        $hasDuplicates = true;
                    } else {
                        $participantCounts->{$combination[0]} = 1;
                    };

                    if (!$hasDuplicates) {
                        if (property_exists($participantCounts, (string)$combination[1])) {
                            $hasDuplicates = true;
                        } else {
                            $participantCounts->{$combination[1]} = 1;
                        };
                    };
                };
            }

            if (!$hasDuplicates) {
                $this->calculateAverageSetAndScore();
            };
        } else {
            for ($i = $start; $i <= $n - $choose; ++$i) {
                $score = $this->findMatches($this->data[$arr[$i][0]], $this->data[$arr[$i][1]]);
                $arr[$i]['score'] = $score;

                array_push($this->combination, $arr[$i]);
                $this->generateSets($i + 1, $choose - 1, $arr, $n);
                array_pop($this->combination);
            }
        }
    }

    /**
     * Get matching score for given person and pair
     *
     * @param array $person
     * @param array $pair
     * @return int
     */
    protected function findMatches(array $person, array $pair)
    {
        $score = 0;

        foreach ($this->requirements as $requirement) {
            $score += $requirement->getMatching($person, $pair);
        }

        return $score;
    }

    /**
     * Determine the highestAverageScore and highestAverageCombination
     */
    protected function calculateAverageSetAndScore() : void
    {
        $average = 0;

        foreach($this->combination as $item) {
            $average += $item['score'];
        }
        $average = $average/count($this->combination);

        if($average > $this->highestAverageScore) {
            $this->highestAverageScore = $average;
            $this->highestAverageCombination = $this->combination;
        }
    }

    /**
     * Add matching Requirement
     *
     * @param Requirement $requirement
     */
    public function addRequirement(Requirement $requirement) : void
    {
        array_push($this->requirements, $requirement);
    }
}
