<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Licencia;
use App\Models\OrdenSalida;
use App\Models\Parametro;
use App\Models\Publicacion;
use Carbon\Carbon;
class ViewSolicitudesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {

    }
}
