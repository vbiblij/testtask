<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Selectable;

class Template extends Model
{
	use Selectable;
	
    protected $fillable = ['name', 'content'];
	
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
