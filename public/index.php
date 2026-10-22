<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DatastokController;
use App\Http\Controllers\KartustokController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\TambahmutasiController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());