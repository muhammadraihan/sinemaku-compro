<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * load ide-helper for non production environment
         */
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // fix mysql string length error
        Schema::defaultStringLength(191);
        // force apps to use secure protocol
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\Blade::directive('i18n', function ($expression) {
            return "<?php
                \$__args = [$expression];
                \$__model = \$__args[0];
                \$__attr = \$__args[1];
                \$__attrEn = \$__attr . '_en';
                if (is_array(\$__model)) {
                    \$__valId = \$__model[\$__attr] ?? '';
                    \$__valEn = \$__model[\$__attrEn] ?? \$__valId;
                } else {
                    \$__valId = \$__model->\$__attr ?? '';
                    \$__valEn = \$__model->\$__attrEn ?? \$__valId;
                }
                echo '<span class=\"dynamic-i18n\" data-lang-id=\"' . htmlspecialchars(\$__valId, ENT_QUOTES) . '\" data-lang-en=\"' . htmlspecialchars(\$__valEn, ENT_QUOTES) . '\">' . \$__valId . '</span>';
            ?>";
        });
    }
}
