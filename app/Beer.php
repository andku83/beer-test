<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Beer
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $type_id
 * @property int $brand_id
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Brand $brand
 * @property-read \App\BeerType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Beer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Beer extends Model
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'text', 'type_id', 'brand_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public static function statusNames()
    {
        return [
            static::STATUS_OFF => 'Off',
            static::STATUS_ON => 'On'
        ];
    }

    public function toggle()
    {
        $this->status = $this->status ? 0 : 1;
        return $this->save();
    }

    public function getStatus()
    {
        return array_get(static::statusNames(), $this->status);
    }

    public function type()
    {
        return $this->hasOne(BeerType::class, 'id', 'type_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
