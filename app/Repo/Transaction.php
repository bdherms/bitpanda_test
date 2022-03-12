<?php

namespace App\Repo;

use App\Repo\Transaction;

class Transaction
{
    /**
     * return site details
     *
     * @return void
     */
    public function details()
    {
        return [
            'code' => 'AWS',
            'type' => 'dedicated',
            'source' => 'source'
        ];
    }
}