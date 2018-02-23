<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    protected $fillable = ['name', 'soname' , 'email', 'bunche_id'];
	
    public function bunch(){
		return $this->belongsTo(Bunch::class);
	}
	
	public static function boot()
	{
		parent::boot();
		
		static::updating(function ($table) {
			$table->updated_by = Auth::user()->id;
		});
		
		static::creating(function ($table) {
			$table->created_by = Auth::user()->id;
			$table->updated_by = Auth::user()->id;
		});
	}
}
