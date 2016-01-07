<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    public function get() {

        // Check limit IP
        Log::info('Client ' . $_SERVER['REMOTE_ADDR'] . ' Attempt to request for backup');

        if( $_SERVER['REMOTE_ADDR'] == env('ALLOW_BACKUP_IP') ) {

            Log::info('IP matched, prepare to download');

            Log::info('Prepare to dl: '. env('BACKUP_PATH'));

            if( !file_exists(env('BACKUP_PATH')) ) {
                Log::warning('User attemp to access '. env('BACKUP_PATH') . ' but not found');
                abort(404);
            }

            return response()->download(env('BACKUP_PATH'), env('BACKUP_NAME'), [
                'Content-Type: application/plain'
            ]);

        } else {

            Log::warning('IP DO NOT MATCH!');
            abort(451);

        }
    }

    public function log() {

        // Check limit IP
        Log::info('Client ' . $_SERVER['REMOTE_ADDR'] . ' Attempt to request for backup');

        if( $_SERVER['REMOTE_ADDR'] == env('ALLOW_BACKUP_IP') ) {

            Log::info('IP matched, prepare to download');

            Log::info('Prepare to dl: '. env('BACKUP_LOG_PATH'));

            if( !file_exists(env('BACKUP_LOG_PATH')) ) {
                Log::warning('User attemp to access '. env('BACKUP_LOG_PATH') . ' but not found');
                abort(404);
            }

            return response()->download(env('BACKUP_LOG_PATH'), env('BACKUP_LOG_NAME'), [
                'Content-Type: application/plain'
            ]);

        } else {

            Log::warning('IP DO NOT MATCH!');
            abort(451);

        }
    }
}
