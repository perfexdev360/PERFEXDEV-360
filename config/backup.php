<?php

return [
    'backup' => [
        'name' => env('APP_NAME', 'laravel'),
        'source' => [
            'files' => [
                'include' => [
                    base_path(),
                ],
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                ],
                'follow_links' => false,
            ],
            'databases' => [
                'mysql',
            ],
        ],
        'destination' => [
            'disks' => [
                env('BACKUP_DISK', 'backups'),
            ],
        ],
        'temporary_directory' => storage_path('app/backup-temp'),
    ],

    'cleanup' => [
        'default_strategy' => [
            'keep_all_backups_for_days' => 7,
            'keep_daily_backups_for_days' => 16,
            'keep_weekly_backups_for_weeks' => 8,
            'keep_monthly_backups_for_months' => 4,
            'keep_yearly_backups_for_years' => 2,
            'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
        ],
    ],
];
