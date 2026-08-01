<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Admin</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        [
            'text' => 'Dashboard',
            'url'  => '/freelancer/dashboard',
            'icon' => 'fas fa-home',
            'can'  => 'freelancer',
        ],

        [
            'text' => 'Project Management',
            'icon' => 'fas fa-project-diagram',
            'can'  => 'freelancer',

            'submenu' => [

                [
                    'text' => 'Project',
                    'url'  => '/projects',
                    'icon' => 'fas fa-folder-open',
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


            ],
        ],
        [
    'text' => 'My Meetings',
    'url'  => '/freelancer/my-meetings',
    'icon' => 'fas fa-video',
    'can'  => 'freelancer',
],

        [
            'text' => 'Internal Chat System',
            'icon' => 'fas fa-comments',
            'can'  => 'freelancer',
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
            'can'  => 'freelancer',

            'submenu' => [

                [
                    'text' => 'My Tasks',
                    'url'  => '/tasks',
                    'icon' => 'fas fa-list',
                ],

                // [
                //     'text' => 'Create Task',
                //     'url'  => '/tasks/create',
                //     'icon' => 'fas fa-plus-circle',
                // ],

                [
                    'text' => 'Assigned Tasks',
                    'url'  => '/tasks/assigned',
                    'icon' => 'fas fa-user-check',
                ],

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
                // [
                //     'text' => 'Trash Tasks',
                //     'url'  => '/tasks/trash',
                //     'icon' => 'fas fa-trash',
                // ],

            ],
        ],


        [
            'text' => 'File Management',
            'icon' => 'fas fa-folder-open',
            'can'  => 'freelancer',

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

                // [
                //     'text' => 'Trash Files',
                //     'url'  => '/project-files-trash',
                //     'icon' => 'fas fa-trash',
                // ],

            ],
        ],



        [
            'text' => 'Profile',
            'url'  => '/profile',
            'icon' => 'fas fa-user',
            'can'  => 'freelancer',
        ],
        [
            'text' => 'Dashboard',
            'url'  => '/employee/dashboard',
            'icon' => 'fas fa-home',
            'can'  => 'employee',
        ],
        [
            'text' => 'Internal Chat System',
            'icon' => 'fas fa-comments',
            'can'  => 'employee',

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
    'text' => 'My Meetings',
    'url'  => '/employee/my-meetings',
    'icon' => 'fas fa-video',
    'can'  => 'employee',
],
        [
            'text' => 'Task Management',
            'icon' => 'fas fa-tasks',
            'can'  => 'employee',

            'submenu' => [

                [
                    'text' => 'My Tasks',
                    'url'  => '/tasks/assigned',
                    'icon' => 'fas fa-list',
                ],

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

            ],
        ],

        [
            'text' => 'Profile',
            'url'  => '/profile',
            'icon' => 'fas fa-user',
            'can'  => 'employee',
        ],

        [
            'text' => 'Dashboard',
            'url'  => '/client/dashboard',
            'icon' => 'fas fa-home',
            'can'  => 'client',
        ],

        [
            'text' => 'Project Management',
            'icon' => 'fas fa-project-diagram',
            'can'  => 'client',

            'submenu' => [

                [
                    'text' => 'My Projects',
                    'url'  => '/projects',
                    'icon' => 'fas fa-folder-open',
                ],

                [
                    'text' => 'Project Progress',
                    'url'  => '/projects/progress',
                    'icon' => 'fas fa-chart-line',
                ],

                [
                    'text' => 'Timeline',
                    'url'  => '/timeline',
                    'icon' => 'fas fa-calendar',
                ],

                [
                    'text' => 'Daily Updates',
                    'url'  => '/daily-updates',
                    'icon' => 'fas fa-clipboard-list',
                ],

            ],
        ],
        [
    'text' => 'My Meetings',
    'url'  => '/client/my-meetings',
    'icon' => 'fas fa-video',
    'can'  => 'client',
],
        [
            'text' => 'Internal Chat System',
            'icon' => 'fas fa-comments',
            'can'  => 'client',

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
            'text' => 'Profile',
            'url'  => '/profile',
            'icon' => 'fas fa-user',
            'can'  => 'client',
        ],

        [
            'text' => 'Dashboard',
            'url'  => '/admin/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'can'  => 'admin',
        ],
        [
            'text' => 'User Management',
            'icon' => 'fas fa-users-cog',
            'can'  => 'admin',

            'submenu' => [

                [
                    'text' => 'All Users',
                    'url'  => '/admin/users',
                    'icon' => 'fas fa-users',
                ],

                [
                    'text' => 'Add User',
                    'url'  => '/admin/users/create',
                    'icon' => 'fas fa-user-plus',
                ],

                [
                    'text' => 'Trash Users',
                    'url'  => '/admin/users/trash',
                    'icon' => 'fas fa-trash',
                ],

            ],
        ],
        [
            'text' => 'Task Management',
            'icon' => 'fas fa-tasks',
            'can'  => 'admin',

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
            'text' => 'Internal Chat System',
            'icon' => 'fas fa-comments',
            'can'  => 'admin',

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
            'text' => 'Chat Monitoring',
            'icon' => 'fas fa-comments',
            'can'  => 'admin',
            'submenu' => [


                [
                    'text'  => 'Private Chats',
                    'route' => 'admin.chat.private',
                    'icon'  => 'fas fa-user-friends',
                ],
                [
                    'text'  => 'Group Chats',
                    'route' => 'admin.chat.groups',
                    'icon'  => 'fas fa-users',
                ],
                [
                    'text'  => 'Meetings',
                    'route' => 'admin.meetings.index',
                    'icon'  => 'fas fa-video',
                ],
            ],
        ],

        [
            'text' => 'Project Monitoring',
            'icon' => 'fas fa-project-diagram',
            'can'  => 'admin',
            'submenu' => [

                [
                    'text'  => 'All Projects',
                    'route' => 'admin.project.monitoring.index',
                    'icon'  => 'fas fa-list',
                ],
                [
                    'text'  => 'Add Project',
                    'route' => 'projects.create',
                    'icon'  => 'fas fa-plus-circle',
                ],
                [
                    'text' => 'Milestones',
                    'url' => '/milestones',
                    'icon' => 'fas fa-flag-checkered',
                ],
                [
                    'text'  => 'Delayed Projects',
                    'route' => 'admin.project.monitoring.delayed',
                    'icon'  => 'fas fa-exclamation-circle',
                ],

                [
                    'text'  => 'Completed Projects',
                    'route' => 'admin.project.monitoring.completed',
                    'icon'  => 'fas fa-check-circle',
                ],
                [
                    'text' => 'Trash Projects',
                    'url'  => '/projects/trash',
                    'icon' => 'fas fa-trash',
                ],
            ],
        ],

        [
            'text' => 'Reports & Analytics',
            'icon' => 'fas fa-chart-line',
            'can'  => 'admin',
            'submenu' => [

                [
                    'text' => 'Project Summary',
                    'route' => 'admin.reports.project-summary',
                    'icon' => 'fas fa-chart-pie',
                ],
                [
                    'text' => 'Project Status Report',
                    'route' => 'admin.reports.project-status',
                    'icon' => 'fas fa-clipboard-list',
                ],
                [
                    'text' => 'User Wise Report',
                    'route' => 'admin.reports.user-wise',
                    'icon' => 'fas fa-users',
                ],
                [
                    'text'  => 'Milestone Report',
                    'route' => 'admin.reports.milestone-report',
                    'icon'  => 'fas fa-flag-checkered',
                ],
                [
                    'text'  => 'Daily Work Report',
                    'route' => 'admin.reports.daily-work-report',
                    'icon'  => 'fas fa-tasks',
                ],
                [
                    'text'  => 'Activity Log Report',
                    'route' => 'admin.reports.activity-log-report',
                    'icon'  => 'fas fa-history',
                ],
                [
                    'text'  => 'Chat Usage Report',
                    'route' => 'admin.reports.chat-usage-report',
                    'icon'  => 'fas fa-comments',
                ],
                [
                    'text'  => 'Group Chat Report',
                    'route' => 'admin.reports.group-chat-report',
                    'icon'  => 'fas fa-users',
                ],

            ],
        ],

        [
            'text' => 'Subscription Management',
            'icon' => 'fas fa-crown',
            'can'  => 'admin',
            'submenu' => [

                [
                    'text' => 'All Plans',
                    'url'  => 'admin/subscriptions',
                    'icon' => 'fas fa-list',
                ],

                [
                    'text' => 'Add Plan',
                    'url'  => 'admin/subscriptions/create',
                    'icon' => 'fas fa-plus-circle',
                ],

            ],
        ],

        [
            'text' => 'Backup & Restore',
            'url'  => '/admin/backup',
            'icon' => 'fas fa-database',
            'can'  => 'admin',
        ],
        [
            'text' => 'Security',
            'icon' => 'fas fa-shield-alt',
            'can'  => 'admin',
            'submenu' => [
                [
                    'text' => 'Login History',
                    'url'  => 'admin/login-history',
                    'icon' => 'fas fa-user-shield',
                ],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
