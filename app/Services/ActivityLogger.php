<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{

    public static function log($action, $model, $description = null)
    {
        $log = new ActivityLog([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'description' => $description,
        ]);
        $log->save();
    }
}
