<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1)
 * @method static create(string[] $array)
 */
class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'visibility', 'description', 'slug'
    ];

    public static function checkAndSetDefault()
    {
        $default = self::where('slug', 'default')->get();
        if ($default->isEmpty()) {
            return Schedule::create([
                'name' => 'Default Schedule for Users',
                'slug' => 'default',
                'visibility' => 'ROLE_USER',
                'description' => 'default schedule for users'
            ]);
        } else {
            return $default->first();
        }
    }
}
