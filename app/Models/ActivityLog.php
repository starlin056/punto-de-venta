<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activitylog extends Model
{
  protected $fillable = ['user_id', 'action', 'module', 'data', 'ip_address'];

  protected $casts = ['data' => 'array'];

  public function user(): BelongsTo
  {

    return $this->belongsTo(user::class);
  }
  

}

/* este formato de fecha lo dejare comentado por si decido utilizar mas adelante 

public function getCreatedAtformattedAtribute(): string
{

  return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i');
} */