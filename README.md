# HOLA Kasir – UTS Pemrograman Web
**Pembuat:** Muhammad Ashim Dzuhilmi (25091397027) – Kelompok HOLA (Horas Laundry), Rekayasa Perangkat Lunak
**Peran modul:** Kasir (hitung biaya & simpan transaksi), berbagi struktur database yang sama dengan Admin (Ilham) dan Pelanggan (Farahdiba').

## Pemenuhan ketentuan
| Item | Implementasi |
|---|---|
| 2.a | `index.html` – layout responsif (CSS grid/flex + media query, menu burger di mobile), HTML + CSS + jQuery, tanpa Bootstrap. Menu "Simulasi Kasir" & "Transaksi Baru" dimuat dengan Ajax (`$.ajax`). |
| 2.b | `pages/kalkulator.html` – simulasi kasir interaktif: pilih layanan, berat/jumlah, diskon member, antar-jemput, uang diterima → total & kembalian real-time. |
| 2.c | `pages/form-transaksi.html` – form transaksi (tabel `pelanggan` & `transaksi` dari ERD proposal) dengan validasi jQuery (nama, no HP, layanan, berat, metode, status bayar, catatan) sebelum submit via Ajax POST ke `php/simpan_transaksi.php`. |


## Cara menjalankan
1. **Laragon/XAMPP:** salin folder `hola-kasir` ke `www`/`htdocs`, buka `http://localhost/hola-kasir/`.
2. Untuk simpan ke MySQL: import `php/database.sql` (HeidiSQL/phpMyAdmin). Tanpa MySQL, transaksi disimpan di localStorage (mode simulasi).
3. Alternatif cepat: klik `jalankan.bat` (butuh Python).
Catatan: Ajax tidak berjalan jika `index.html` dibuka langsung via `file://`.
