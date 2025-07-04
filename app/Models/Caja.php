<?php

namespace App\Models;

use App\Observers\CajaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;


#[ObservedBy(CajaObserver::class)]

class Caja extends Model
{

    protected $guarded = ['id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
    public function ventas(): HasMany
    {
        return $this->hasMany(venta::class);
    }

    public function getFechaAttribute(): string
    {
        return Carbon::parse($this->fecha_hora_apertura)->format('d-m-Y');
    }
    
    public function getHoraAttribute(): string
    {
        return Carbon::parse($this->fecha_hora_apertura)->format('H:i');
    }
    
    public function getFechaCierreAttribute(): string
    {
        return $this->fecha_hora_cierre 
            ? Carbon::parse($this->fecha_hora_cierre)->format('d-m-Y')
            : '';
    }
    
    public function getHoraCierreAttribute(): string
    {
        return $this->fecha_hora_cierre 
            ? Carbon::parse($this->fecha_hora_cierre)->format('H:i')
            : '';
    }
    


}
