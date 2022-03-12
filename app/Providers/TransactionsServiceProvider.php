<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repo\Transaction;
use App\Interfaces\TransactionsInterface;

class TransactionsServiceProvider extends ServiceProvider implements TransactionsInterface
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('Transaction', function($app) {
            return new Transaction();
        });
    }

    public function retreiveData(): void
    {
    }
}
