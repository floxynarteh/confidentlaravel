<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentGateway;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        PaymentGateway::class => PaymentGateway::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['dashboard.index', 'videos.show', 'dashboard'], function ($view){
            $user = request()->user();

            $view->with([
                'watched' => \App\Models\Watch::where('user_id', $user->id)->get()->pluck('video_id'),
                'lessons' => \App\Models\Lesson::orderBy('ordinal', 'asc')->get(),
                'videos' => \App\Models\Video::orderBy('ordinal', 'asc')->get()->groupBy('lesson_id'),
                'user' =>$user
            ]);

        $this->app->bind("path.public", function(){
            return base_path().'/../public_html';
        });

        });
    }
}
