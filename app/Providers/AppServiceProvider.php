<?php

namespace App\Providers;

use App\Interfaces\AI\AIProviderInterface;
use App\Services\Chatbot\DifyAIService;
use App\Services\Chatbot\MockGeminiProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (! empty(env('DIFY_API_KEY')) || ! empty(config('services.dify.api_key'))) {
            $this->app->bind(AIProviderInterface::class, DifyAIService::class);
        } else {
            $this->app->bind(AIProviderInterface::class, MockGeminiProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
