<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    protected $fillable = ['name', 'description', 'template_id', 'bunche_id'];
	
    public function template(){
		return $this->belongsTo('App\Template');
	}
	
    public function bunche(){
		return $this->belongsTo(Bunche::class);
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
