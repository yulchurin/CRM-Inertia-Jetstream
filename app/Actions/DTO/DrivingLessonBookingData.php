<?php

namespace App\Actions\DTO;

use App\Actions\Interfaces\MainDTO;

class DrivingLessonBookingData implements MainDTO
{
    public int $id;
    public int $place;
    public string $comment;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->place = $data['place'];
        $this->comment = $data['comment'];
    }
}
