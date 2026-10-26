# HOLA Kasir – UTS Pemrograman Web
**Pembuat:** Muhammad Ashim Dzulhilmi (25091397027) – Kelompok HOLA (Horas Laundry), Rekayasa Perangkat Lunak
**Peran modul:** Kasir (hitung biaya & simpan transaksi), berbagi struktur database yang sama dengan Admin (Ilham) dan Pelanggan (Farahdiba').

## Pemenuhan ketentuan
| Item | Implementasi |
|---|---|
| 2.a | `index.html` – layout responsif (CSS grid/flex + media query, menu burger di mobile), HTML + CSS + jQuery, tanpa Bootstrap. Menu "Simulasi Kasir" & "Transaksi Baru" dimuat dengan Ajax (`$.ajax`). |
| 2.b | `pages/kalkulator.html` – simulasi kasir interaktif: pilih layanan, berat/jumlah, diskon member, antar-jemput, uang diterima → total & kembalian real-time. |
| 2.c | `pages/form-transaksi.html` – form transaksi (mengacu pada tabel `pelanggan` & `transaksi` dari ERD proposal) dengan validasi jQuery (nama, no HP, layanan, berat, metode, status bayar, catatan) serta aturan bisnis pelunasan sebelum disimpan ke dalam `localStorage` browser. |

## Cara menjalankan
1. **Alternatif cepat (Python):** Klik 2x file `jalankan.bat`, lalu buka `http://localhost:8000` di browser.
2. **VS Code Live Server:** Buka folder proyek di VS Code, klik kanan pada `index.html`, lalu pilih **Open with Live Server**.
3. **Laragon/XAMPP:** Salin folder proyek ke `www`/`htdocs`, lalu akses melalui `http://localhost/PWUTS_A09_25091397027/`.

*Catatan: Karena menggunakan teknik Ajax (`$.ajax`), navigasi halaman tidak dapat berjalan jika `index.html` dibuka langsung melalui klik dua kali (`file://`). Seluruh data transaksi disimpan secara dinamis menggunakan `localStorage` pada browser.*