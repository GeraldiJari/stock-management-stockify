<?php

namespace App\Services\StockTransactions;

use App\Models\Setting;
use App\Repositories\StockTransactions\StockTransactionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use LaravelEasyRepository\Service;

class StockTransactionsServiceImplement extends Service implements StockTransactionsService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(StockTransactionsRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAll()
    {
      return $this->mainRepository->getAll();
    }

    // public function store($data)
    // {
    //   return $this->mainRepository->store($data);
    // }

    public function store($data)
    {
        $minQuantity = $this->getMinQuantity();
        $maxQuantity = $this->getMaxQuantity();

        // Validate the incoming data
        $validator = Validator::make($data, [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:Masuk,Keluar',
            'quantity' => 'required|integer|min:' . $minQuantity . '|max:' . $maxQuantity,
            'date' => 'required|date',
            'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Call the repository to store the data
        return $this->mainRepository->store($data);
    }

    protected function getMinQuantity()
    {
        return (int) Setting::where('key', 'min_quantity')->value('value') ?? 1;
    }

    protected function getMaxQuantity()
    {
        return (int) Setting::where('key', 'max_quantity')->value('value') ?? 100;
    }

    public function updateOrCreateQuantity(Request $request)
    {
      $request->validate([
        'min_quantity' => 'required|integer|min:1',
        'max_quantity' => 'required|integer|min:1|gte:min_quantity',
    ]);

    // Update or create settings for min and max quantities
    $this->mainRepository->updateOrCreateQuantity('min_quantity', $request->min_quantity);
    $this->mainRepository->updateOrCreateQuantity('max_quantity', $request->max_quantity);

    return redirect()->back()->with('success', 'Pengaturan quantity berhasil diperbarui.');
    }

    public function updateOrCreateLogo()
    {
        // Periksa apakah ada file gambar yang diunggah
        if (request()->hasFile('logo')) {
            // Validasi file gambar
            $validated = request()->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Mengunggah file gambar dan menyimpan pathnya
            $logoPath = request()->file('logo')->store('logos', 'public'); // Menyimpan di folder 'public/logos'

            // Update atau buat pengaturan logo
            return Setting::updateOrCreate(
                ['key' => 'site_logo'], // 'site_logo' adalah key untuk logo di pengaturan
                ['value' => $logoPath] // Menyimpan path gambar di 'value'
            );
        }

        // Jika tidak ada gambar yang diunggah, Anda bisa mengembalikan nilai sebelumnya
        return Setting::where('key', 'site_logo')->first();
    }

    

    // public function updateStok($id, $data)
    // {
    //   return $this->mainRepository->update($id, $data);
    // }

    public function updateStok($id, $data)
    {
        $minQuantity = $this->getMinQuantity();
        $maxQuantity = $this->getMaxQuantity();

        // Validasi data yang masuk
        $validator = Validator::make($data, [
            'quantity' => 'required|integer|min:' . $minQuantity . '|max:' . $maxQuantity,
        ],
        [
          'quantity.min' => "Stok kurang dari $minQuantity, harap cek ulang lagi persediaan/tambahkan persediaan."
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Panggil repository untuk memperbarui data
        return $this->mainRepository->update($id, $data);
    }


    public function getByMonth($month): Collection
    {
        return $this->mainRepository->getByMonth($month);
    }

    public function generateWeeksInMonth($date)
    {
        $weeks = [];
        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();

        while ($start->lte($end)) {
            $weekStart = $start->copy();
            $weekEnd = $start->copy()->endOfWeek();

            $weeks[] = [
                'start' => $weekStart,
                'end' => $weekEnd->gt($end) ? $end : $weekEnd
            ];

            $start = $weekEnd->addDay();
        }

        return $weeks;
    }

    public function getByType(string $type)
    {
      return $this->mainRepository->getByType($type);
    }

    public function getStokToday()
    {
      return $this->mainRepository->getStokToday();
    }

    public function getStokOutToday()
    {
      return $this->mainRepository->getStokOutToday();
    }

    public function requestIn()
    {
      return $this->mainRepository->requestStokIn();
    }

    public function requestOut()
    {
      return $this->mainRepository->requestStokOut();
    }

    // Define your custom methods :)
}
