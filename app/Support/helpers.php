<?php

/**
 * @param array $availableSlots
 * @param $day
 * @param int $startTime
 * @return bool
 */
function checkAvailability(array $availableSlots, $day, int $startTime): bool {
    if (array_key_exists($day, $availableSlots)) {
        $slots = $availableSlots[$day];

        foreach ($slots as $key => $timeSlots) {
            if ($startTime == (int) $timeSlots['start']) {
                return true;
            }
        }
    }

    return false;
}

/**
 * @param $array
 * @return int
 */
function max_length($array): int {
    $max = 0;
    foreach ($array as $child) {
        if (count($child) > $max) {
            $max = count($child);
        }
    }

    return $max;
}

/**
 * @param $array
 * @return mixed
 */
function largestArray($array) {
    $max = $array[0];

    $prevChildItems = 0;
    $childItems     = 0;

    for ($i = 1; $i < count($array); $i++) {
        // Previous array child items
        foreach ($array[$i - 1] as $key => $prevItem) {
            if (is_array($prevItem)) {
                $prevChildItems += count($prevItem);
            } else {
                $prevChildItems += 1;
            }
        }

        // Current array child items
        foreach ($array[$i] as $key => $currItem) {
            if (is_array($currItem)) {
                $childItems += count($currItem);
            } else {
                $childItems += 1;
            }
        }

        if ($childItems > $prevChildItems) {
            $max = $array[$i];
        }
    }

    return $max;
}

function smallestArray($array) {
    $min = $array[0];

    $prevChildItems = 0;
    $childItems     = 0;

    for ($i = 1; $i < count($array); $i++) {
        // Previous array child items
        foreach ($array[$i - 1] as $key => $prevItem) {
            if (is_array($prevItem)) {
                $prevChildItems += count($prevItem);
            } else {
                $prevChildItems += 1;
            }
        }

        // Current array child items
        foreach ($array[$i] as $key => $currItem) {
            if (is_array($currItem)) {
                $childItems += count($currItem);
            } else {
                $childItems += 1;
            }
        }

        if ($childItems < $prevChildItems) {
            $min = $array[$i];
        }
    }

    return $min;
}

/**
 * @param $scheduleA
 * @param $scheduleB
 * @return array
 */
function getAvailableSlots($scheduleA, $scheduleB): array {
    // Map through schedules and remove the "start" and "end" keys
    // Time slots should use zero-based numerical indexes as keys
    $_availabilityA = [];
    foreach ($scheduleA as $dayNumber => $a) {
        foreach ($a as $slots) {
            $_availabilityA[$dayNumber][] = [$slots['start'], $slots['end']];
        }
    }

    $_availabilityB = [];
    foreach ($scheduleB as $dayNumber => $a) {
        foreach ($a as $slots) {
            $_availabilityB[$dayNumber][] = [$slots['start'], $slots['end']];
        }
    }

    // Final time slot for both schedules
    $tempSlots = [];

    // Group the time slots, find the slots with the largest and smallest size of items
    $group       = [$_availabilityA, $_availabilityB];
    $largestArr  = largestArray($group);
    $smallestArr = smallestArray($group);

    // Loop through the larger array to enable covering all possible time slots
    foreach ($largestArr as $dayNumber => $availability) {
        // If the day number exists in the smaller array, then it's a good sign
        // Group the available time slots for the larger array and that of the smaller array for the same day using the $dayNumber key
        // Get the smallest of the array. Now, we use smallest because we need to ensure that the resulting array only consists of time
        // that reflects on both array and the easiest way is to use the smallest array
        //
        // Loop through the smallest array and if any of the time slot exists on the larger array,
        // add it to a temp array.
        //
        // Add the end of the loop, add the temp array to the master $tempSlots array (using the day number as the key)
        // This way, we're able to ensure that for the given day number only the days that exists on both arrays are taken.
        if (array_key_exists($dayNumber, $smallestArr)) {
            $_temp = [];
            $g     = [$smallestArr[$dayNumber], $availability];
            $lA    = largestArray($g);
            $sA    = smallestArray($g);

            foreach ($sA as $key => $item) {
                if (in_array($item, $lA)) {
                    $_temp[] = $item;
                }
            }

            $tempSlots[$dayNumber] = $_temp;
        }
    }

    return $tempSlots;
}
