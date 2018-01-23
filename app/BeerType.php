<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BeerType
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Beer[] $beers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BeerType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BeerType whereName($value)
 * @mixin \Eloquent
 */
class BeerType extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function beers()
    {
        return $this->hasMany(Beer::class, 'type_id', 'id');
    }
}
