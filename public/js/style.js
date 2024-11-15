// Ambil semua tombol edit
document.querySelectorAll('.edit-user-button').forEach(button => {
    button.addEventListener('click', function() {
        // Ambil ID pengguna dari atribut data
        const userId = this.getAttribute('data-user-id');

        // Ambil data pengguna dari server (atau bisa dari array jika data sudah ada)
        // Di sini kita menggunakan array contoh, tapi kamu sebaiknya mendapatkan data dari server
        let user = users.find(u => u.id == userId); // Sesuaikan dengan data asli

        if (user) {
            // Isi input dengan data pengguna
            document.getElementById('user_id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;

            // Update action URL untuk form
            const form = document.getElementById('editUserForm');
            form.action = form.action.replace('user_id_placeholder', user.id);

            // Tampilkan modal
            document.getElementById('edit-user-modal').classList.remove('hidden');
        }
    });
});

   // Contoh data pengguna, bisa diganti dengan data dari server
   let users = [
    { id: 1, name: "John Doe", email: "john@example.com", role: "admin" },
    { id: 2, name: "Jane Smith", email: "jane@example.com", role: "manajer_gudang" }
];

// Event listener untuk tombol edit
document.querySelectorAll('.edit-user-button').forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.getAttribute('data-user-id');
        const user = users.find(u => u.id == userId);
        
        if (user) {
            document.getElementById('user_id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;

            // Update action URL
            const form = document.getElementById('editUserForm');
            form.action = form.action.replace('user_id_placeholder', user.id);

            // Show modal
            document.getElementById('edit-user-modal').classList.remove('hidden');
        }
    });
});


