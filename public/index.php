<?php

/**
 * Pristine Finserve - Front Controller
 * All requests routed through this file
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../storage/logs/app.log');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Load .env file
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (str_contains($line, '=')) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            // Strip surrounding quotes
            if ((str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                $value = substr($value, 1, -1);
            }
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
        }
    }
}

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'Core\\';
    $baseDir = __DIR__ . '/../core/';

    if (str_starts_with($class, $prefix)) {
        $relativeClass = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) require $file;
        return;
    }

    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (str_starts_with($class, $prefix)) {
        $relativeClass = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) require $file;
        return;
    }
});

// Load helpers
require_once __DIR__ . '/../app/Helpers/functions.php';

// Load config
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/constants.php';

// Core
use Core\Router;
use Core\Request;
use Core\Session;
use Core\View;

// Initialize session
Session::instance();

// Initialize router
$router = new Router();

// Register global middleware
$router->addGlobalMiddleware('App\\Middleware\\CsrfMiddleware');

// =====================================================================
// FRONTEND ROUTES
// =====================================================================
$router->get('/', 'Frontend\\HomeController@index');
$router->get('/about', 'Frontend\\AboutController@index');
$router->get('/services', 'Frontend\\ServicesController@index');
$router->get('/services/{slug}', 'Frontend\\ServicesController@show');
$router->get('/loans', 'Frontend\\LoansController@index');
$router->get('/loans/{slug}', 'Frontend\\LoansController@show');
$router->get('/calculators', 'Frontend\\CalculatorsController@index');
$router->get('/calculators/{type}', 'Frontend\\CalculatorsController@show');
$router->get('/blog', 'Frontend\\BlogController@index');
$router->get('/blog/{slug}', 'Frontend\\BlogController@show');
$router->get('/gallery', 'Frontend\\GalleryController@index');
$router->get('/partners', 'Frontend\\PartnersController@index');
$router->get('/testimonials', 'Frontend\\TestimonialsController@index');
$router->get('/contact', 'Frontend\\ContactController@index');

// Legal / information pages
$router->get('/privacy-policy', 'Frontend\\PageController@show');
$router->get('/terms-of-service', 'Frontend\\PageController@show');
$router->get('/disclaimer', 'Frontend\\PageController@show');
$router->get('/refund-cancellation-policy', 'Frontend\\PageController@show');
$router->get('/sitemap', 'Frontend\\PageController@show');

// Form submissions
$router->post('/contact/submit', 'Frontend\\ContactController@submit');
$router->post('/lead/submit', 'Frontend\\LeadController@submit');
$router->post('/callback/request', 'Frontend\\LeadController@callbackRequest');

// API
$router->post('/api/calculate-emi', 'Frontend\\CalculatorsController@calculateEmi');

// =====================================================================
// ADMIN ROUTES
// =====================================================================
$router->get('/admin/login', 'Admin\\AuthController@loginForm');
$router->post('/admin/login', 'Admin\\AuthController@login');
$router->get('/admin/logout', 'Admin\\AuthController@logout');

// Protected admin routes
$adminMiddleware = ['App\\Middleware\\AuthMiddleware'];

$router->get('/admin', 'Admin\\DashboardController@index', $adminMiddleware);
$router->get('/admin/dashboard', 'Admin\\DashboardController@index', $adminMiddleware);

// Pages
$router->get('/admin/pages', 'Admin\\PageController@index', $adminMiddleware);
$router->get('/admin/pages/create', 'Admin\\PageController@create', $adminMiddleware);
$router->post('/admin/pages/store', 'Admin\\PageController@store', $adminMiddleware);
$router->get('/admin/pages/edit/{id}', 'Admin\\PageController@edit', $adminMiddleware);
$router->post('/admin/pages/update/{id}', 'Admin\\PageController@update', $adminMiddleware);
$router->get('/admin/pages/delete/{id}', 'Admin\\PageController@delete', $adminMiddleware);

// Services
$router->get('/admin/services', 'Admin\\ServiceController@index', $adminMiddleware);
$router->get('/admin/services/create', 'Admin\\ServiceController@create', $adminMiddleware);
$router->post('/admin/services/store', 'Admin\\ServiceController@store', $adminMiddleware);
$router->get('/admin/services/edit/{id}', 'Admin\\ServiceController@edit', $adminMiddleware);
$router->post('/admin/services/update/{id}', 'Admin\\ServiceController@update', $adminMiddleware);
$router->get('/admin/services/delete/{id}', 'Admin\\ServiceController@delete', $adminMiddleware);

// Loan Products
$router->get('/admin/loans', 'Admin\\LoanController@index', $adminMiddleware);
$router->get('/admin/loans/create', 'Admin\\LoanController@create', $adminMiddleware);
$router->post('/admin/loans/store', 'Admin\\LoanController@store', $adminMiddleware);
$router->get('/admin/loans/edit/{id}', 'Admin\\LoanController@edit', $adminMiddleware);
$router->post('/admin/loans/update/{id}', 'Admin\\LoanController@update', $adminMiddleware);
$router->get('/admin/loans/delete/{id}', 'Admin\\LoanController@delete', $adminMiddleware);

// Calculators
$router->get('/admin/calculators', 'Admin\\CalculatorController@index', $adminMiddleware);
$router->get('/admin/calculators/edit/{id}', 'Admin\\CalculatorController@edit', $adminMiddleware);
$router->post('/admin/calculators/update/{id}', 'Admin\\CalculatorController@update', $adminMiddleware);

// Testimonials
$router->get('/admin/testimonials', 'Admin\\TestimonialController@index', $adminMiddleware);
$router->get('/admin/testimonials/create', 'Admin\\TestimonialController@create', $adminMiddleware);
$router->post('/admin/testimonials/store', 'Admin\\TestimonialController@store', $adminMiddleware);
$router->get('/admin/testimonials/edit/{id}', 'Admin\\TestimonialController@edit', $adminMiddleware);
$router->post('/admin/testimonials/update/{id}', 'Admin\\TestimonialController@update', $adminMiddleware);
$router->get('/admin/testimonials/delete/{id}', 'Admin\\TestimonialController@delete', $adminMiddleware);

// Blog
$router->get('/admin/blog', 'Admin\\BlogController@index', $adminMiddleware);
$router->get('/admin/blogs', 'Admin\\BlogController@index', $adminMiddleware);
$router->get('/admin/blogs/create', 'Admin\\BlogController@create', $adminMiddleware);
$router->post('/admin/blogs/store', 'Admin\\BlogController@store', $adminMiddleware);
$router->get('/admin/blogs/edit/{id}', 'Admin\\BlogController@edit', $adminMiddleware);
$router->post('/admin/blogs/update/{id}', 'Admin\\BlogController@update', $adminMiddleware);
$router->get('/admin/blogs/delete/{id}', 'Admin\\BlogController@delete', $adminMiddleware);

// Media
$router->get('/admin/media', 'Admin\\MediaController@index', $adminMiddleware);
$router->post('/admin/media/upload', 'Admin\\MediaController@upload', $adminMiddleware);
$router->get('/admin/media/delete/{id}', 'Admin\\MediaController@delete', $adminMiddleware);

// Partners
$router->get('/admin/partners', 'Admin\\PartnerController@index', $adminMiddleware);
$router->get('/admin/partners/create', 'Admin\\PartnerController@create', $adminMiddleware);
$router->post('/admin/partners/store', 'Admin\\PartnerController@store', $adminMiddleware);
$router->get('/admin/partners/edit/{id}', 'Admin\\PartnerController@edit', $adminMiddleware);
$router->post('/admin/partners/update/{id}', 'Admin\\PartnerController@update', $adminMiddleware);
$router->get('/admin/partners/delete/{id}', 'Admin\\PartnerController@delete', $adminMiddleware);

// Team
$router->get('/admin/team', 'Admin\\TeamController@index', $adminMiddleware);
$router->get('/admin/team/create', 'Admin\\TeamController@create', $adminMiddleware);
$router->post('/admin/team/store', 'Admin\\TeamController@store', $adminMiddleware);
$router->get('/admin/team/edit/{id}', 'Admin\\TeamController@edit', $adminMiddleware);
$router->post('/admin/team/update/{id}', 'Admin\\TeamController@update', $adminMiddleware);
$router->get('/admin/team/delete/{id}', 'Admin\\TeamController@delete', $adminMiddleware);

// Leads
$router->get('/admin/leads', 'Admin\\LeadController@index', $adminMiddleware);
$router->get('/admin/leads/view/{id}', 'Admin\\LeadController@view', $adminMiddleware);
$router->post('/admin/leads/status/{id}', 'Admin\\LeadController@updateStatus', $adminMiddleware);
$router->post('/admin/leads/note/{id}', 'Admin\\LeadController@addNote', $adminMiddleware);
$router->get('/admin/leads/export', 'Admin\\LeadController@export', $adminMiddleware);

// Gallery
$router->get('/admin/gallery', 'Admin\\GalleryController@index', $adminMiddleware);
$router->get('/admin/gallery/create', 'Admin\\GalleryController@create', $adminMiddleware);
$router->post('/admin/gallery/store', 'Admin\\GalleryController@store', $adminMiddleware);
$router->get('/admin/gallery/edit/{id}', 'Admin\\GalleryController@edit', $adminMiddleware);
$router->post('/admin/gallery/update/{id}', 'Admin\\GalleryController@update', $adminMiddleware);
$router->get('/admin/gallery/delete/{id}', 'Admin\\GalleryController@delete', $adminMiddleware);

// Statistics
$router->get('/admin/statistics', 'Admin\\StatisticsController@index', $adminMiddleware);
$router->get('/admin/statistics/create', 'Admin\\StatisticsController@create', $adminMiddleware);
$router->post('/admin/statistics/store', 'Admin\\StatisticsController@store', $adminMiddleware);
$router->get('/admin/statistics/edit/{id}', 'Admin\\StatisticsController@edit', $adminMiddleware);
$router->post('/admin/statistics/update/{id}', 'Admin\\StatisticsController@update', $adminMiddleware);
$router->get('/admin/statistics/delete/{id}', 'Admin\\StatisticsController@delete', $adminMiddleware);

// Settings
$router->get('/admin/settings', 'Admin\\SettingController@index', $adminMiddleware);
$router->post('/admin/settings/update', 'Admin\\SettingController@update', $adminMiddleware);
$router->get('/admin/seo', 'Admin\\SeoController@index', $adminMiddleware);
$router->get('/admin/seo/create', 'Admin\\SeoController@create', $adminMiddleware);
$router->post('/admin/seo/store', 'Admin\\SeoController@store', $adminMiddleware);
$router->get('/admin/seo/edit/{id}', 'Admin\\SeoController@edit', $adminMiddleware);
$router->post('/admin/seo/update/{id}', 'Admin\\SeoController@updateEntry', $adminMiddleware);
$router->get('/admin/seo/delete/{id}', 'Admin\\SeoController@delete', $adminMiddleware);
$router->get('/admin/settings/seo', 'Admin\\SeoController@index', $adminMiddleware);
$router->post('/admin/settings/seo', 'Admin\\SeoController@updateBulk', $adminMiddleware);

// Users & Roles
$router->get('/admin/users', 'Admin\\UserController@index', $adminMiddleware);
$router->get('/admin/users/create', 'Admin\\UserController@create', $adminMiddleware);
$router->post('/admin/users/store', 'Admin\\UserController@store', $adminMiddleware);
$router->get('/admin/users/edit/{id}', 'Admin\\UserController@edit', $adminMiddleware);
$router->post('/admin/users/update/{id}', 'Admin\\UserController@update', $adminMiddleware);
$router->get('/admin/users/delete/{id}', 'Admin\\UserController@delete', $adminMiddleware);

// Activity Logs
$router->get('/admin/activity', 'Admin\\ActivityController@index', $adminMiddleware);
$router->get('/admin/activity-logs', 'Admin\\ActivityController@index', $adminMiddleware);

// Inquiries
$router->get('/admin/inquiries', 'Admin\\InquiryController@index', $adminMiddleware);
$router->get('/admin/inquiries/view/{id}', 'Admin\\InquiryController@view', $adminMiddleware);
$router->post('/admin/inquiries/reply/{id}', 'Admin\\InquiryController@reply', $adminMiddleware);
$router->get('/admin/inquiries/delete/{id}', 'Admin\\InquiryController@delete', $adminMiddleware);

// Notifications
$router->get('/admin/notifications', 'Admin\\NotificationController@index', $adminMiddleware);
$router->post('/admin/notifications/read/{id}', 'Admin\\NotificationController@markRead', $adminMiddleware);

// =====================================================================
// DISPATCH
// =====================================================================
$request = new Request();
try {
    $router->dispatch($request->method(), $request->uri());
} catch (\Throwable $e) {
    if (APP_DEBUG) {
        echo '<h1>Error</h1><p>' . $e->getMessage() . '</p>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    } else {
        http_response_code(500);
        echo View::render('Frontend.errors.500', ['title' => 'Server Error']);
    }
    error_log($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
}
