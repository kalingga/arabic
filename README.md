# (ng)Arab V3

**(ng)Arab** adalah plugin WordPress yang dirancang untuk menampilkan teks Arab dengan tipografi yang elegan dan rapi. Plugin ini sangat cocok untuk menampilkan ayat Al-Qur'an, Hadits, atau teks Arab lainnya pada postingan website Anda.

## Fitur Utama

- **Font LPMQ Isep Misbah**: Menggunakan font standar Kementerian Agama RI untuk keterbacaan yang maksimal.
- **Performa Tinggi**: Menggunakan format font `.woff2` yang sangat ringan (kompresi hingga 60%) namun tetap memiliki fallback `.ttf`.
- **Dukungan Multi-baris**: Sekarang mendukung penulisan teks panjang seperti satu Surah penuh tanpa merusak tata letak.
- **Pembaruan Otomatis**: Terintegrasi dengan GitHub Updater untuk memastikan Anda selalu mendapatkan versi terbaru.
- **Optimasi CSS**: Gaya CSS dipaksa (*forced*) menggunakan `!important` agar tidak bentrok dengan tema WordPress yang Anda gunakan.

## 🛠 Cara Instalasi

1. Download atau Clone repositori ini ke dalam folder `/wp-content/plugins/arabic/`.
2. Aktifkan plugin **(ng)Arab V3** melalui menu **Plugins** di Dashboard WordPress Anda.

## Cara Penggunaan

Gunakan shortcode `[ngarab]` untuk membungkus teks Arab Anda.

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
