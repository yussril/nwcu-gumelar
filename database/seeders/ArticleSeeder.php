<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug' => 'lailatul-ijtima-putaran-ke-12',
                'title' => 'Lailatul Ijtima’ Putaran Ke-12: Mempererat Ukhuwah & Konsolidasi Ranting Nahdlatul Ulama Se-Kecamatan Gumelar',
                'category' => 'Kegiatan Ranting',
                'excerpt' => 'Pertemuan bulanan para kyai, pimpinan syuriyah, tanfidziyah ranting serta tokoh masyarakat berlangsung khidmat di Pendopo Ranting Kedungurang, menyepakati penguatan kaderisasi dan kemandirian filantropi Koin NU.',
                'body' => 'Lailatul Ijtima’ menjadi ruang silaturahmi rutin untuk memperkuat ukhuwah, konsolidasi ranting, kaderisasi, dan kemandirian filantropi Koin NU di Kecamatan Gumelar.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhdssP7apAKTwa6zbpc5KbTcC5Uq45zvvTcusgiFHJHcLxZbQxYLBHJlW3Utf2Hpg47OOoaXHImDQ3uOrhHG3uXtpKx9E8bJyvcceGnv_51RD2AFUkWPWWDyaNTwCPahYfWsRXQAdRzrj9ZlljrYOUv1PH5PG-_ukFplEUrh5VA0ru_K5Y0DawU4RAXoe0AZ6bBcy5g4XNnUk91MJaomKgQlEtyaAcLJ6Mdy6SNfBIEF6zvnK69YJM',
                'author' => 'Redaksi Media MWCNU',
                'published_at' => '2025-05-18 09:00:00',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'aksi-tanggap-bencana-pac-gp-ansor-cihonje',
                'title' => 'Aksi Tanggap Bencana & Kerja Bakti PAC GP Ansor di Ranting Cihonje',
                'category' => 'Kabar Banom',
                'excerpt' => 'Satkoryon Banser diterjunkan membantu perbaikan saluran irigasi warga yang terdampak longsor tebing akibat intensitas hujan tinggi.',
                'body' => 'Kader Ansor dan Banser bergotong royong membantu warga memulihkan saluran irigasi setelah longsor. Kegiatan ini menjadi bagian dari khidmat sosial dan kesiapsiagaan kebencanaan di tingkat ranting.',
                'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1Ui2HgX4O4WfwQLLSliCoN_9ODJtBR70NUrcMErjm4IpwO0SYxlQN3WnHTAcDDyOFxrlOpZnIszM0eUw9rMg0p6ioZ7EANGYjg81cTaLEJT6AJLF_VD0liyctfD5coJJU0WfX8O6Zt6VbMXPnxRjuLvH3RfqhJv1GZCYqpKLSY8U81sJkiXHyCuI_RJ5j1r8lrYtihwDYt1lRsJjbTphm3bV9NNJhW-O7fpQojDx6gRX4tzBMJ8oar1aT0',
                'author' => 'Humas Ansor Gumelar',
                'published_at' => '2025-05-14 09:00:00',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'beasiswa-santri-prasejahtera-tahap-ii',
                'title' => 'Penyaluran Beasiswa Santri Prasejahtera Tahap II oleh UPZIS LAZISNU Gumelar',
                'category' => 'Kajian & Fatwa',
                'excerpt' => 'Sebanyak 45 santri dari 10 ranting desa menerima bantuan dana pendidikan guna menjamin kelangsungan belajar di pesantren mitra.',
                'body' => 'UPZIS LAZISNU Gumelar menyalurkan bantuan pendidikan bagi santri prasejahtera. Program ini menghimpun kepedulian warga melalui Gerakan Koin NU Peduli.',
                'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1VF6usZIHmfJhXCiPS6cIe7Yy4lc61lf1OUZRUffLyZNsnaSk1c5i8XmgSOmc-4PgPcBblTSvtXs2DVxciKmDJ6D2Jem5vxzKKTpJ25eRqLnokkLbSchzCrzXOx-4pwPu3UJBCBh6AOga06hB71w5u6oCz5qnrLI6xdo4qMWN7eZgHIkThWuMEl42BdMsWE8ruc2jOfLMJA4ytDKhhl15-EBqYwnnswkz3XOLO1WsmHhb6WCUQO7K1n8PI',
                'author' => 'Divisi Penyaluran LAZISNU',
                'published_at' => '2025-05-09 09:00:00',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'harlah-fatayat-nu-ke-75',
                'title' => 'Peringatan Hari Lahir Fatayat NU Ke-75: Meneguhkan Kemandirian Ekonomi Keluarga',
                'category' => 'Kabar Banom',
                'excerpt' => 'Pimpinan Anak Cabang Fatayat menyelenggarakan seminar kewirausahaan halal serta bazar produk UMKM binaan kader ranting.',
                'body' => 'Peringatan Harlah Fatayat NU diisi dengan seminar kewirausahaan halal dan bazar produk UMKM kader. Kegiatan ini mendorong kemandirian ekonomi keluarga Nahdliyin.',
                'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1XlGxWqrqgZj6F6TwemR0xCCsxePXSLKUTadmJmraRdBZhgxQhyWF2ae6uG3g01eoRJhbTa3RiuiETx4HFtffZuL_A6VbIQkRX9mur8cx-LSgnmE5AdY7rzRIKuuU8jJgiBImMRMGCttZiGWsGzSKh0i7QLC6MoGg7pKpmCl3XpcrGY9TP_CoSin5n2SJ0z8Uhkdz_ETCsKjDZPy4t5sJrWAmBoJkryJ0UviJy3hmDOT9OEArgBIf97-w',
                'author' => 'PAC Fatayat NU',
                'published_at' => '2025-05-04 09:00:00',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'slug' => 'bahtsul-masail-transaksi-digital-zakat-fitrah',
                'title' => 'Bahtsul Masail Waqi’iyyah: Meninjau Hukum Transaksi Digital dan Zakat Fitrah',
                'category' => 'Kajian & Fatwa',
                'excerpt' => 'Musyawarah ulama menetapkan pedoman fatwa kontekstual terkait akad pembayaran koin digital dan sedekah online berbasis QRIS.',
                'body' => 'Lembaga Bahtsul Masail menghimpun ulama dan asatidz untuk mengkaji persoalan transaksi digital dan zakat fitrah berdasarkan kebutuhan masyarakat.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVeffxoPzJaIEPAq_b0AogShb5uJ24WT-1OKMmO6dr0Vd_FwsLStO8YqMYaQ8jKwedZLW0QEKR8XrtZGIzi61WdRqH8W31Spg0IScS6V4WgeL78xHfMFaZW2YhFpCNiWEoW0fHOgOBRCyrLhUfsEVlRGRB-MgVHbD22VHP-n55VXUKJW6XlgSZruSjl4pN3-OaYUjX62Xyvf8NulZDsKZvJHZUsbkmq659x-MyKTMYnB9sj7YkwaGk',
                'author' => 'LBM NU Gumelar',
                'published_at' => '2025-04-28 09:00:00',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'slug' => 'instruksi-istighosah-serentak-musim-tanam',
                'title' => 'Instruksi Syuriyah MWCNU: Pelaksanaan Istighosah Serentak Musim Tanam',
                'category' => 'Pengumuman',
                'excerpt' => 'Surat edaran resmi menyerukan seluruh musholla dan masjid NU di 10 desa untuk menggelar doa bersama memohon keselamatan dan berkah panen.',
                'body' => 'Syuriyah MWCNU mengajak warga melaksanakan istighosah serentak sebagai ikhtiar spiritual memasuki musim tanam.',
                'image_url' => 'https://lh3.googleusercontent.com/aida/AEtjO1U-dMHgeh4izp0iEXp-HHdXVgbNCO1sDylIWvr9154vBSUEsrYZEGITfvk4BoCuicQi1udrnj3TnqLLhzlecW5OGPXMkJoazxEra71IF4UWc5uNi7jI8W378SIq6ZXc5_RkpLs89d7mm6YdSdFOlnHjaohSRBOSHODT9OOC46GjqcjTgc55192qL-CEJfSKXGsX7-Px5RSfXNIflwDE9gzDyXgG03UAI3Keyq2RfnTtE5YF7BhKtSQSNt0',
                'author' => 'Sekretariat Syuriyah',
                'published_at' => '2025-04-22 09:00:00',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'slug' => 'pelantikan-pengurus-ranting-samudra',
                'title' => 'Pelantikan Pengurus Ranting NU Desa Samudra: Semangat Baru Khidmah',
                'category' => 'Kegiatan Ranting',
                'excerpt' => 'Jajaran pengurus masa khidmah 2025-2030 resmi dibaiat oleh Rais Syuriyah dengan komitmen revitalisasi posko kesehatan desa.',
                'body' => 'Pengurus Ranting NU Desa Samudra dilantik untuk masa khidmah 2025-2030. Pelantikan menjadi awal penguatan program pelayanan dan kesehatan masyarakat.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9FE43SgLPXES63x5FSn1LQVUsaRdSEU5SU76Vvqp4jQ4YQ0OMqsPObQhXPRAfT0GnedPB8riA9kCWQjRJWZgJEOdC4bVjft_zGho-5zejS9I0JtyuSMZjnoVBofgCV-NMSd78arZwqUJeruZn4eZZFrjq9hGMss4I6x1YPk_SjXGBJ0kuPnZCkQZWt4cH4uKWIglvWzLheASvDVouFx5nK70mSVLoWasggRFBARQ3nOfVwzm4ZKd1',
                'author' => 'Tim Dokumentasi MWCNU',
                'published_at' => '2025-04-15 09:00:00',
                'is_published' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($articles as $article) {
            Article::firstOrCreate(['slug' => $article['slug']], $article);
        }
    }
}