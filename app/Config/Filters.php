<?php

namespace Config;

use App\Filters\Auth;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, array<int, string>|string> [filter_name => classname]
     *                                               or [filter_name => [classname1, classname2, ...]]
     * @phpstan-var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'Auth'          => Auth::class,
        'FilterAdmin'   => \App\Filters\AdminFilter::class,
        'FilterPic'     => \App\Filters\PicFilter::class,
        'FilterVendor'  => \App\Filters\VendorFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, array<string>>
     * @phpstan-var array<string, list<string>>|array<string, array<string, array<string, string>>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
            // 'Auth' => ['except' => ['login']]
            'FilterAdmin'   => ['except'    => ['LoginController', 'LoginController/*', 'Home', 'Home/*', '/']],
            'FilterPic'     => ['except'    => ['LoginController', 'LoginController/*', 'Home', 'Home/*', '/']],
            'FilterVendor'  => ['except'    => ['LoginController', 'LoginController/*', 'Home', 'Home/*', '/']]
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
            // 'Auth' => ['except' => ['vendor/*', 'Kontrak/*']]
            'FilterAdmin'     => ['except'    => ['LoginController', 'LoginController/*', 'CabangController/*', 'KontrakController/*', 'Home/*', 'VendorController/*', 'PenilaianController/*', '*']],
            'FilterPic'       => ['except'    => ['LoginController', 'LoginController/*', 'PenilaianController/*', 'Home/*', '*']],
            'FilterVendor'    => ['except'    => ['LoginController', 'LoginController/*', 'KontrakController/*', 'PenilaianController/*', 'Home/*', '*']],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
