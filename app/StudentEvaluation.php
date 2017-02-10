<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentEvaluation extends Pivot
{
    protected $table = 'student_evaluation';
}
