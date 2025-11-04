<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function getDifficultyLabelAttribute(): string
    {
        $map = [
            'Easy'   => 'Mudah',
            'Medium' => 'Sedang',
            'Hard'   => 'Sulit',
        ];

        return $map[$this->difficulty] ?? ucfirst($this->difficulty ?? 'Tidak diketahui');
    }

    public function getDifficultyBadgeClassAttribute(): string
    {
        $map = [
            'Easy'   => 'bg-[#19da63] text-white',
            'Medium' => 'bg-[#f59e0b] text-white',
            'Hard'   => 'bg-[#6b21a8] text-white',
        ];

        return $map[$this->difficulty] ?? 'bg-gray-400 text-white';
    }
}