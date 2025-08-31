<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class InstallController extends Controller
{
    /**
     * Display the installation form.
     */
    public function show(): View|RedirectResponse
    {
        if (env('APP_INSTALLED')) {
            return redirect('/');
        }

        return view('install');
    }

    /**
     * Handle installation and save credentials.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'db_host' => ['required', 'string'],
            'db_port' => ['required', 'numeric'],
            'db_database' => ['required', 'string'],
            'db_username' => ['required', 'string'],
            'db_password' => ['required', 'string'],
            'admin_name' => ['required', 'string'],
            'admin_email' => ['required', 'email'],
            'admin_password' => ['required', 'confirmed', 'min:8'],
        ]);

        $this->setEnv([
            'DB_HOST' => $data['db_host'],
            'DB_PORT' => $data['db_port'],
            'DB_DATABASE' => $data['db_database'],
            'DB_USERNAME' => $data['db_username'],
            'DB_PASSWORD' => $data['db_password'],
            'APP_KEY' => 'base64:'.base64_encode(random_bytes(32)),
            'APP_INSTALLED' => 'true',
        ]);

        Artisan::call('config:clear');
        Artisan::call('migrate', ['--force' => true]);

        User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => $data['admin_password'],
            'role' => 'ADMIN',
        ]);

        return redirect('/')->with('status', 'installation-complete');
    }

    /**
     * Persist environment values to the .env file.
     *
     * @param array<string,string> $values
     */
    protected function setEnv(array $values): void
    {
        $path = base_path('.env');
        $content = File::exists($path) ? File::get($path) : '';

        foreach ($values as $key => $value) {
            $escaped = preg_quote($key, '/');
            if (preg_match("/^{$escaped}=.*/m", $content)) {
                $content = preg_replace("/^{$escaped}=.*/m", $key.'='.$value, $content);
            } else {
                $content .= PHP_EOL.$key.'='.$value;
            }
        }

        File::put($path, trim($content).PHP_EOL);
    }
}

