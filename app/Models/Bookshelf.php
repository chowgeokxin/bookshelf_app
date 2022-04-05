<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    use HasFactory;

    public function getReadStatusOptions(){
        $options = [];

        $options += [
            ""=> "All",
            0 => "Yes",
            1 => "No",
        ];

        return $options;
    }
}
