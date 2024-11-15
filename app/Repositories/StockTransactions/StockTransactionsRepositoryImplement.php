<?php

namespace App\Repositories\StockTransactions;

use App\Models\Setting;
use App\Models\StockTransactions;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use LaravelEasyRepository\Implementations\Eloquent;

class StockTransactionsRepositoryImplement extends Eloquent implements StockTransactionsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(StockTransactions $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return StockTransactions::all();
    }

    public function store($data)
    {
        return StockTransactions::create($data);
    }

    public function edit($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateStok($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function getByMonth($month): Collection
    {
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        return StockTransactions::whereBetween('date', [$start, $end])->get();
    }

    public function getByType(string $type)
    {
        return StockTransactions::where('type', $type)->orderBy('date', 'desc')->get();
    }

    public function updateOrCreateQuantity($key, $value)
    {
        return Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function updateOrCreateLogo($key, $value)
    {
        return Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function getStokToday()
    {
        return StockTransactions::with('product')
            ->where('type', 'Masuk')
            ->whereDate('date', Carbon::today())
            ->latest()
            ->get();
    }

    public function getStokOutToday()
    {
        return StockTransactions::with('product')
            ->where('type', 'Keluar')
            ->whereDate('date', Carbon::today())
            ->latest()
            ->get();
    }

    public function requestStokIn()
    {
        return StockTransactions::with('product')
            ->where('type', 'Masuk')
            ->where('status', 'Pending')
            ->latest()
            ->get();
    }

    public function requestStokOut()
    {
        return StockTransactions::with('product')
            ->where('type', 'Keluar')
            ->where('status', 'Pending')
            ->latest()
            ->get();
    }
    // Write something awesome :)
}
