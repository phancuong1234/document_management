<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationUnit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'collaboration_units';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'description',
        'is_active',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
