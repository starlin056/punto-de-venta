<?php

namespace App\Services;

use App\Models\Activitylog;
use illuminate\Support\Facades\Auth;

class ActivitylogService
{
 /** Registrar un a actividad en mi base de datos */

public static function log(string $action, ?string $module = null, ?array $data = null, ?string $ipAddress = null, ?int $user_id = null): void

{
    Activitylog::create([
        'user_id' => $user_id ?? Auth::user()->id,
        'action' => $action,
        'module' => $module,
        'data' => $data,
        'ip_address' => $ipAddress ?? request()->ip(),

    ]);


}

}