# (ng)Arab V3

**(ng)Arab** adalah solusi tipografi Arab premium untuk setiap website WordPress. Menampilkan teks Arab, ayat Al-Qur'an, atau Hadits dengan berbagai pilihan font berkualitas tinggi, warna kustom, transliterasi, dan dukungan native Gutenberg block.

## Fitur Utama

- **Multi-Font Support**: Mendukung berbagai font Arab standar industri (LPMQ, Amiri, Lateef, dsb) untuk keterbacaan maksimal.
- **Performa Tinggi**: Menggunakan format font `.woff2` yang sangat ringan (kompresi hingga 60%) namun tetap memiliki fallback `.ttf`.
- **Dukungan Multi-baris**: Sekarang mendukung penulisan teks panjang seperti satu Surah penuh tanpa merusak tata letak.
- **Pembaruan Otomatis**: Terintegrasi dengan GitHub Updater untuk memastikan Anda selalu mendapatkan versi terbaru.
- **Optimasi CSS**: Gaya CSS dipaksa (*forced*) menggunakan `!important` agar tidak bentrok dengan tema WordPress yang Anda gunakan.

### Fitur Utama
- **Gutenberg Block**: Dukungan penuh untuk editor blok modern WordPress.
- **Pilihan Font Luas**: Pilih dari berbagai font populer (LPMQ, Amiri, Lateef, Noto, dsb).
- **Terjemahan & Transliterasi**: Tampilkan teks latin and arti secara otomatis.
- **Warna Kustom**: Atur warna teks Arab sesuai keinginan.
- **Tombol Salin**: Memudahkan pengunjung untuk menyalin teks Arab.

## Cara Instalasi

1. Download atau Clone repositori ini ke dalam folder `/wp-content/plugins/arabic/`.
2. Aktifkan plugin **(ng)Arab V3** melalui menu **Plugins** di Dashboard WordPress Anda.

## Cara Penggunaan

Gunakan shortcode `[ngarab]` untuk membungkus teks Arab Anda.

### Penggunaan Shortcode
Gunakan format berikut untuk fitur lengkap:
```
[ngarab font="lateef" color="#c0392b" trans="Bismillah" trj="Dengan menyebut nama Allah" copy="yes"]
بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
[/ngarab]
```

**Atribut Tersedia:**
- `font`: `lpmq`, `amiri`, `amiri-quran`, `lateef`, `noto-nastaliq`, `scheherazade`.
- `color`: Kode warna hex (misal: `#ff0000`).
- `trans`: Teks transliterasi latin.
- `trj`: Teks terjemahan/arti.
- `copy`: Set `yes` untuk memunculkan tombol salin.

### Contoh Teks Pendek:
`[ngarab]بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ[/ngarab]`

### Contoh Teks Multi-baris (Surah):
```text
[ngarab]
بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ١
اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ ٢
الرَّحْمٰنِ الرَّحِيْمِۙ ٣
[/ngarab]
```

## Lisensi & Author
*   **Author**: Khoirul Aksara
*   **Original Author**: Khoirul Anwar a.k.a Loro Sukmo
*   **License**: GNU General Public License v2
*   **URL**: [https://log.serat.us](https://log.serat.us)

---
*Dibuat dengan ❤️ untuk komunitas Muslim di Indonesia.*
