<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /*
    public function getRouteKeyName() {
        return 'slug';
    } */

    // Allow mass-assignment (to allow reuse of rules or validations on multiple routes):
    protected $fillable = ['title', 'description', 'long_description'];

    // Block fields from being modified (if any defined, the others missing will be all considered fillable which is DANGEROUS):
    //protected $guarded = ['password'];

    public function toggleComplete() {
        $this->completed = !$this->completed;
        $this->save();
    }
}
