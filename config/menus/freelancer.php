<?php

return [

    [
        'text' => 'Dashboard',
        'url'  => '/freelancer/dashboard',
        'icon' => 'fas fa-home',
    ],

    [
        'text' => 'Project Management',
        'icon' => 'fas fa-project-diagram',

        'submenu' => [

            [
                'text' => 'Project',
                'url'  => '/projects',
                'icon' => 'fas fa-folder-open',
            ],

            // [
            //     'text' => 'Team Members',
            //     'url'  => '/projects',
            //     'icon' => 'fas fa-users',

            // ],

            [
                'text' => 'Milestones',
                'url'  => '/milestones',
                'icon' => 'fas fa-flag-checkered',
            ],

            [
                'text' => 'Timeline',
                'url'  => '/timeline',
                'icon' => 'fas fa-calendar',
            ],

            [
                'text' => 'Project Progress',
                'url'  => '/projects/progress',
                'icon' => 'fas fa-chart-line',
            ],

            [
                'text' => 'Daily Updates',
                'url'  => '/daily-updates',
                'icon' => 'fas fa-clipboard-list',
            ],

            [
                'text' => 'Activity Logs',
                'url'  => '/activity-logs',
                'icon' => 'fas fa-history',
            ],

            [
                'text' => 'Trash Projects',
                'url'  => '/projects/trash',
                'icon' => 'fas fa-trash',
            ],
        ],
    ],
    // [
    //     'text' => 'Tasks',
    //     'url'  => '#',
    //     'icon' => 'fas fa-tasks',
    // ],

    [
        'text' => 'Internal Chat System',
        'icon' => 'fas fa-comments',
        'submenu' => [

            [
                'text' => 'One-to-One Chat',
                'url'  => '/messages',
                'icon' => 'fas fa-comment',
            ],

            [
                'text' => 'Group Chat',
                'url'  => '/groups',
                'icon' => 'fas fa-users',
            ],

            [
                'text' => 'Notifications',
                'url'  => '/notifications',
                'icon' => 'fas fa-bell',
            ],


        ],
    ],
    [
        'text' => 'Task Management',
        'icon' => 'fas fa-tasks',

        'submenu' => [

            [
                'text' => 'All Tasks',
                'url'  => '/tasks',
                'icon' => 'fas fa-list',
            ],

            [
                'text' => 'Create Task',
                'url'  => '/tasks/create',
                'icon' => 'fas fa-plus-circle',
            ],

            [
                'text' => 'Assigned Tasks',
                'url'  => '/tasks/assigned',
                'icon' => 'fas fa-user-check',
            ],

            // [
            //     'text' => 'Status Tracking',
            //     'url'  => '/tasks/status',
            //     'icon' => 'fas fa-spinner',
            // ],
            // [
            //     'text' => 'Task Comments',
            //     'url'  => '/comments',
            //     'icon' => 'fas fa-comments',
            // ],
            [
                'text' => 'Task Comments',
                'url'  => '/task-comments',
                'icon' => 'fas fa-comments',
            ],
            [
                'text' => 'Task Attachments',
                'url'  => '/task-attachments',
                'icon' => 'fas fa-paperclip',
            ],
            [
                'text' => 'Trash Tasks',
                'url'  => '/tasks/trash',
                'icon' => 'fas fa-trash',
            ],

        ],
    ],
    [
        'text' => 'File Management',
        'icon' => 'fas fa-folder-open',

        'submenu' => [

            [
                'text' => 'All Files',
                'url'  => '/project-files',
                'icon' => 'fas fa-folder',
            ],

            [
                'text' => 'Upload File',
                'url'  => '/project-files/create',
                'icon' => 'fas fa-upload',
            ],

            [
                'text' => 'Trash Files',
                'url'  => '/project-files-trash',
                'icon' => 'fas fa-trash',
            ],

        ],
    ],



    [
        'text' => 'Profile',
        'url'  => '/profile',
        'icon' => 'fas fa-user',
    ],

];
