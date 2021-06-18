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
