<?php

namespace App\Collection;

use Illuminate\Database\Eloquent\Collection;

class InterviewerCollection extends Collection {
    /**
     * @return $this
     */
    public function getAvailableSlots(): self {
        $this->items = array_map(function ($value) {
            return $value->availability;
        }, $this->items);

        if (count($this->items) <= 1) {
            return $this;
        }

        $slots = [];
        foreach ($this->items as $item) {
            $slots = getAvailableSlots($slots, $item);
        }

        $this->items = $slots;

        return $this;
    }
}
