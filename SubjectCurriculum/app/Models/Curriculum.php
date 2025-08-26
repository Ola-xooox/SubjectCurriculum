<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curriculum extends Model
{
    use HasFactory;

    // This line tells Eloquent to use the "curriculums" table.
    protected $table = 'curriculums';

    protected $fillable = [
        'curriculum_name',
        'curriculum_code',
        'academic_year',
        'year_level',
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)
            ->withPivot('year', 'semester')
            ->withTimestamps();
    }
}
