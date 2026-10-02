<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['slug' => 'silaturahmi-akbar-warga-nahdliyin', 'category' => 'syuriyah-tanfidziyah', 'label' => 'MWCNU Gumelar', 'alt_text' => 'Silaturahmi warga Nahdliyin dan tokoh agama di Pendopo Gumelar', 'title' => 'Silaturahmi Akbar Warga Nahdliyin & Temu Tokoh Agama se-Kecamatan Gumelar', 'event_date' => '2025-01-18', 'location' => 'Pendopo Balai Desa Gumelar, Banyumas', 'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1XNMmROTu54T-3YXYmrZnjV6cjxfW6QwezEgQCcs39D8imdgJDxAB-_lGYnBQ5t14GcZOttPrXBK_7hMsl50kEfKbjaAxjmYmOrWuil8dHrEkRBcBE1CHLkboC8IusRL9es6SOHkaHJ1NApsQHUrzOV7tUcyOrcUl-upLbGkeTeGOVBavDmP5YCbfwYDkK80P7RwUPpWjszF6mZ4lAA7v3oBvczxwrIYk-W6wUvoA23xqYT0havVmBivA'],
            ['slug' => 'gotong-royong-ansor-jalan-tani', 'category' => 'ansor', 'label' => 'Ansor & Banser', 'alt_text' => 'Bakti gotong royong Ansor Banser dan warga Gumelar', 'title' => 'Karya Bakti Gotong Royong Perbaikan Akses Jalan Usaha Tani Bersama Masyarakat', 'event_date' => '2025-01-11', 'location' => 'Dusun Petarangan, Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1Ui2HgX4O4WfwQLLSliCoN_9ODJtBR70NUrcMErjm4IpwO0SYxlQN3WnHTAcDDyOFxrlOpZnIszM0eUw9rMg0p6ioZ7EANGYjg81cTaLEJT6AJLF_VD0liyctfD5coJJU0WfX8O6Zt6VbMXPnxRjuLvH3RfqhJv1GZCYqpKLSY8U81sJkiXHyCuI_RJ5j1r8lrYtihwDYt1lRsJjbTphm3bV9NNJhW-O7fpQojDx6gRX4tzBMJ8oar1aT0'],
            ['slug' => 'konsolidasi-kaderisasi-fatayat-muslimat', 'category' => 'fatayat', 'label' => 'Fatayat & Muslimat', 'alt_text' => 'Pertemuan PAC Muslimat dan Fatayat NU Gumelar', 'title' => 'Pertemuan Rutin Triwulan & Konsolidasi Kaderisasi Fatayat-Muslimat NU Gumelar', 'event_date' => '2025-01-05', 'location' => 'Gedung Pertemuan Muslimat Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1XlGxWqrqgZj6F6TwemR0xCCsxePXSLKUTadmJmraRdBZhgxQhyWF2ae6uG3g01eoRJhbTa3RiuiETx4HFtffZuL_A6VbIQkRX9mur8cx-LSgnmE5AdY7rzRIKuuU8jJgiBImMRMGCttZiGWsGzSKh0i7QLC6MoGg7pKpmCl3XpcrGY9TP_CoSin5n2SJ0z8Uhkdz_ETCsKjDZPy4t5sJrWAmBoJkryJ0UviJy3hmDOT9OEArgBIf97-w'],
            ['slug' => 'penyaluran-manfaat-koin-nu', 'category' => 'lazisnu', 'label' => 'LAZISNU Gumelar', 'alt_text' => 'Penyaluran bantuan pangan dan pendidikan UPZIS LAZISNU', 'title' => 'Penyaluran Manfaat Koin NU: Bantuan Santunan Sembako & Beasiswa Yatim Dhuafa', 'event_date' => '2024-12-28', 'location' => 'Desa Samudra Kulon, Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1VF6usZIHmfJhXCiPS6cIe7Yy4lc61lf1OUZRUffLyZNsnaSk1c5i8XmgSOmc-4PgPcBblTSvtXs2DVxciKmDJ6D2Jem5vxzKKTpJ25eRqLnokkLbSchzCrzXOx-4pwPu3UJBCBh6AOga06hB71w5u6oCz5qnrLI6xdo4qMWN7eZgHIkThWuMEl42BdMsWE8ruc2jOfLMJA4ytDKhhl15-EBqYwnnswkz3XOLO1WsmHhb6WCUQO7K1n8PI'],
            ['slug' => 'halaqah-selapanan-majelis-dzikir', 'category' => 'dakwah', 'label' => 'MWCNU Gumelar', 'alt_text' => 'Halaqah selapanan dan majelis dzikir MWCNU', 'title' => 'Majelis Dzikir, Sholawat, & Halaqah Selapanan Tabligh Akbar Jajaran Syuriyah MWC', 'event_date' => '2024-12-22', 'location' => 'Pendopo MWCNU Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuO1W4FzO7NUa7T5uXeMpAqG7n-ZuoKGBJy-v_u8J0wy0etmFNHebnXaNsvikGPrF4Tgonu3R2NDcPT5xCrtPQqYQgi9I_lCs4jKdmpfwe_BHRQRMSqM9OH0WOSPfSk0qFzN0w7EUthShdq1qJgyKPLB11bd5BYmtS8isEdhwraqxwsNwHfSJ-mYiHtz8Z7YeRfvikppwrsfC2FciBAtAHBtha6S5lUfU79jUj6LVDfbDmnGZ3befOSzzPIHU'],
            ['slug' => 'apel-diklatsar-banser-gumelar', 'category' => 'ansor', 'label' => 'Ansor & Banser', 'alt_text' => 'Apel dan diklatsar kaderisasi Banser Satkoryon Gumelar', 'title' => 'Apel Kesetiaan & Diklatsar Kaderisasi Banser Satkoryon Gumelar', 'event_date' => '2024-12-15', 'location' => 'Lapangan Cilangkap, Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDniwq9lvuPWIGvY1RlHcy4McQD7QVai1LDSxmZr6nonT2etRyz5r_alFtTAJf3QyWpDy-znKifbJnlk8MDKIm2yf_JW_rVPH6G-3hYNs65-jhMyZStTCGJX2ilMppbMBoW3A85khlXlT94LIR1IVZfJfKhAC3Bwlk-Mkre9loAOx3c2cB8irQmqBzV4tKkd0gseJfmqc2Yop-3mHQN4QEtZ_y8vnWrA2UHvScOZ8GAIqqHK5fx_Hou'],
            ['slug' => 'pemutakhiran-sensus-kartanu-cihonje', 'category' => 'ranting', 'label' => 'Kegiatan Ranting', 'alt_text' => 'Verifikasi dan pemutakhiran sensus KartaNU di Ranting Cihonje', 'title' => 'Verifikasi & Pemutakhiran Sensus KartaNU Door-to-Door Ranting Cihonje', 'event_date' => '2024-12-02', 'location' => 'Desa Cihonje, Gumelar', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDaordInUCY9uXwN4R06H-zBL9anPFPS2AHdFLWKnLnIM_ZMm_hJIKAONTsFoEAqdcWnz5WCuD65HgL3sAZxVvtggJbgnwptLiF5WVteJ7JsggrjsSOAe-jTlZ7vZOknk1QUS7NsmSHJUq5j2909W7-Qfk3jMnOZETzfaC4mhltSva1kcdEoA9gB5SL7DIUYmCNxK44AfmA5TjP66Bo_e9dijHqJXUfvv2RTwa-Ax4eU3we2DoJ8D35'],
            ['slug' => 'hari-santri-kirab-resolusi-jihad', 'category' => 'syuriyah-tanfidziyah', 'label' => 'MWCNU Gumelar', 'alt_text' => 'Peringatan Hari Santri Nasional dan Kirab Resolusi Jihad', 'title' => 'Peringatan Upacara Hari Santri Nasional & Kirab Resolusi Jihad', 'event_date' => '2024-10-22', 'location' => 'Halaman Gedung Bersama MWCNU', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDZzjA9Ps_PdJT01uhi03nitFZjZCD2lR1cf6g26v6573reng8pIkFo5Gyxx6MS8wgY_qvRinwiHVoR-zw9-Z6pxyc8RsUWL3WP72uZKVil8SIOTn8AgYl6pD20EckiClbcL98kq4EcLnyLc_p7lFlgUa6XeFrpohtdkpJx946janms1m9OoGYCNHYOYoZISjrZbZyFIHcDyxC0XpdF4jpqkpWAtdOKpW6KBKiIJv5zzlFPUMR_dZHa'],
        ];

        foreach ($items as $sortOrder => $item) {
            GalleryItem::firstOrCreate(
                ['slug' => $item['slug']],
                [...$item, 'is_published' => true, 'sort_order' => $sortOrder + 1],
            );
        }
    }
}