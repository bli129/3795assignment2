<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class LandingPageController extends Controller
{
    public function index()
    {
        $databases = [
            'app' => 'app.db',
            'transactions' => 'transactions.db',
            'bucket' => 'bucket.db',
        ];

        foreach ($databases as $subdir => $database) {
            $dbPath = database_path($database);
            $isNewDatabase = !File::exists($dbPath);

            if ($isNewDatabase) {
                File::put($dbPath, null); // Creates an empty file

                // Construct the migration path using subdirectories
                $migrationPath = 'database/migrations/' . $subdir;
                // Ensure to replace slashes for UNIX/Windows compatibility
                $migrationPath = str_replace('/', DIRECTORY_SEPARATOR, $migrationPath);

                // Determine the connection name based on the subdirectory
                $connection = 'sqlite_' . $subdir;

                Artisan::call('migrate', [
                    '--database' => $connection,
                    '--path' => $migrationPath,
                    '--force' => true, // Use with caution
                ]);
            }
        }

        return view('welcome');
    }
}
