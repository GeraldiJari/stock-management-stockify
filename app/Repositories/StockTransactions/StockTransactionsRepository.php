<?php

namespace App\Repositories\StockTransactions;

use Illuminate\Support\Collection;
use LaravelEasyRepository\Repository;

interface StockTransactionsRepository extends Repository{

    // Write something awesome :)
    public function getAll();

    public function store($data);

    public function edit($id);

    public function updateStok($id, $data);

    public function getByMonth($month): Collection;

    public function getByType(string $type);

    public function updateOrCreateQuantity($key, $value);

    public function getStokToday();

    public function getStokOutToday();

    public function requestStokIn();

    public function requestStokOut();

    public function updateOrCreateLogo($key, $value);
}
