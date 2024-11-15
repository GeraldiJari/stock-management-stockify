<form action="{{ route('settings.updateMinQuantity') }}" method="POST">
    @csrf
    @method('PUT')
    <label for="min_quantity">Minimal Quantity:</label>
    <input type="number" name="min_quantity" id="min_quantity" value="{{ getMinQuantity() }}" min="1" required>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>