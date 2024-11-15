<?php

namespace App\Services\StockTransactions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use LaravelEasyRepository\BaseService;

interface StockTransactionsService extends BaseService{

    // Write something awesome :)

    public function getAll();

    public function store($data);

    // public function edit($id);

    public function updateStok($id, $data);

    public function getByMonth($month): Collection;

    public function generateWeeksInMonth($date);

    public function getByType(string $type);
    
    public function updateOrCreateQuantity(Request $request);

    public function updateOrCreateLogo();
    
    public function getStokToday();
    
    public function getStokOutToday();

    public function requestIn();

    public function requestOut();
    
}
