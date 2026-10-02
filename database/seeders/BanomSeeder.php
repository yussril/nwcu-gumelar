<?php

namespace Database\Seeders;

use App\Models\Banom;
use Illuminate\Database\Seeder;

class BanomSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [
                'slug' => 'gp-ansor-banser',
                'name' => 'GP Ansor & Banser',
                'category' => 'Badan Otonom Kepemudaan & Kebanseran',
                'title' => 'Pimpinan Anak Cabang GP Ansor & Satkoryon Banser',
                'motto' => 'Kaderisasi Pemuda, Benteng Ulama & Pengawal Tradisi Aswaja',
                'description' => 'Gerakan kepemudaan garda terdepan Nahdlatul Ulama yang memfokuskan khidmat pada penguatan kapasitas kepemimpinan, pengabdian sosial kebencanaan, dan pengamanan marwah ulama serta keutuhan NKRI di 10 desa se-Kecamatan Gumelar.',
                'term' => '2024–2027',
                'member_count' => '385 kader aktif terdaftar',
                'coverage' => '10 ranting lengkap',
                'legal_status' => 'SK pengesahan PC GP Ansor Banyumas',
                'note' => 'Unit Tanggap Darurat dan Banser Tanggap Bencana (BAGANA) terintegrasi 24 jam dengan Posko BPBD Gumelar.',
                'members' => [
                    ['position' => 'Ketua PAC GP Ansor', 'name' => 'Sahabat M. Abdul Rosyid, S.Pd.'],
                    ['position' => 'Sekretaris', 'name' => 'Sahabat Ahmad Fauzan, S.Kom.'],
                    ['position' => 'Bendahara', 'name' => 'Sahabat Tri Wibowo, S.E.'],
                    ['position' => 'Kasatkoryon Banser', 'name' => 'Komandan Slamet Riyadi'],
                    ['position' => 'Wakil Ketua Bidang Organisasi', 'name' => 'Sahabat Ahmad Mubarok, S.Pd.I.'],
                    ['position' => 'Kaderisasi & Kebanseran', 'name' => 'M. Irfan Maulana, M.Pd.'],
                    ['position' => 'Bidang Rijalul Ansor', 'name' => 'Gus H. Mukhlis Ridwan'],
                    ['position' => 'Komandan BAGANA (Banser Tanggap Bencana)', 'name' => 'Sahabat Dwi Haryanto'],
                    ['position' => 'Komandan BALANTAS (Banser Lalu Lintas)', 'name' => 'Sahabat Wahyu Hidayat'],
                    ['position' => 'Ketua Lembaga Bantuan Hukum (LBH) Ansor', 'name' => 'Sahabat Nurrohman, S.H.'],
                    ['position' => 'Komandan BASADA (Banser Husada)', 'name' => 'Sahabat Faisal Anwar'],
                    ['position' => 'Komandan PROVOS Banser', 'name' => 'Sahabat Teguh Prasetyo'],
                    ['position' => 'Ketua Divisi Informasi & Media Siber', 'name' => 'Sahabat Kholid Mawardi'],
                ],
            ],
            [
                'slug' => 'fatayat-nu',
                'name' => 'Fatayat NU',
                'category' => 'Perempuan Muda Nahdliyin',
                'title' => 'Pimpinan Anak Cabang Fatayat NU Kecamatan Gumelar',
                'motto' => 'Pemberdayaan Perempuan Muda, Kesehatan Keluarga & Dakwah Digital',
                'description' => 'Wadah perjuangan perempuan muda Nahdliyin dengan fokus penguatan ketahanan ekonomi keluarga, advokasi kesehatan ibu dan anak, pencegahan stunting di tingkat ranting, serta pengajian rutin risalah An-Nahdliyyah.',
                'term' => '2024–2028',
                'member_count' => '260 kader aktif',
                'coverage' => 'Bina balita mandiri di 10 desa',
                'legal_status' => 'SK Pimpinan Cabang Fatayat NU Banyumas',
                'note' => 'Mitra program posyandu dan pendampingan gizi keluarga balita se-Kecamatan Gumelar.',
                'members' => [
                    ['position' => 'Ketua PAC Fatayat', 'name' => 'Sahabat Hj. Siti Nurjanah, S.Pd.I.'],
                    ['position' => 'Sekretaris', 'name' => 'Sahabat Nida Ul Khasanah, S.Sos.'],
                    ['position' => 'Bendahara', 'name' => 'Sahabat Umi Kulsum, S.E.'],
                    ['position' => 'Pendidikan & Dakwah', 'name' => 'Nyai Faizah Rohmah'],
                    ['position' => 'Ekonomi & Koperasi', 'name' => 'Ratna Juwita, S.E.'],
                    ['position' => 'Kesehatan & Lingkungan', 'name' => 'Bidan Sri Mulyani, A.Md.Keb.'],
                ],
            ],
            [
                'slug' => 'muslimat-nu',
                'name' => 'Muslimat NU',
                'category' => 'Gerakan Ummahat & Sosial',
                'title' => 'Pimpinan Anak Cabang Muslimat NU Kecamatan Gumelar',
                'motto' => 'Pilar Pembinaan Ummahat, Majelis Taklim & Kemandirian Sosial',
                'description' => 'Organisasi kemasyarakatan perempuan NU yang mengakar melalui jaringan majelis taklim desa, pengelolaan santunan dhuafa, bimbingan keluarga sakinah, dan gerakan sedekah subuh beras jumputan.',
                'term' => '2022–2027',
                'member_count' => '1.120 anggota jamaah',
                'coverage' => '14 kelompok majelis taklim',
                'legal_status' => 'SK Pimpinan Cabang Muslimat NU Banyumas',
                'note' => 'Mengampu gerakan infak santunan lansia dan yatim piatu dhuafa di setiap selapanan MWCNU.',
                'members' => [
                    ['position' => 'Ketua PAC Muslimat', 'name' => 'Hj. Aminah Masrur, M.Pd.'],
                    ['position' => 'Sekretaris', 'name' => 'Hj. Siti Fatimah'],
                    ['position' => 'Bendahara', 'name' => 'Hj. Rohmatin, S.Pd.'],
                    ['position' => 'Sosial & Kesejahteraan', 'name' => 'Hj. Nur Asiyah'],
                    ['position' => 'Dakwah & Majelis Taklim', 'name' => 'Ustzh. Marfu’ah'],
                ],
            ],
            [
                'slug' => 'ipnu-ippnu',
                'name' => 'IPNU & IPPNU',
                'category' => 'Kaderisasi Pelajar & Santri',
                'title' => 'Pimpinan Anak Cabang IPNU & IPPNU Kecamatan Gumelar',
                'motto' => 'Belajar, Berjuang, Bertaqwa di Kalangan Pelajar & Santri',
                'description' => 'Basis kaderisasi pelajar SMP/MTs, SMA/MA/SMK, santri pondok pesantren, dan mahasiswa di wilayah Gumelar untuk membina karakter Aswaja yang kritis, santun, dan berprestasi.',
                'term' => '2024–2026',
                'member_count' => '180 pelajar aktif',
                'coverage' => '6 komisariat sekolah dan pesantren',
                'legal_status' => 'SK Pimpinan Cabang IPNU-IPPNU Banyumas',
                'note' => 'Pelaksana program Masa Kesetiaan Anggota (MAKESTA) dan Latihan Kader Muda (LAKMUD) berkala.',
                'members' => [
                    ['position' => 'Ketua PAC IPNU', 'name' => 'Rekan Bagas Saputra'],
                    ['position' => 'Ketua PAC IPPNU', 'name' => 'Rekanita Dwi Lestari'],
                    ['position' => 'Sekretaris Bersama', 'name' => 'Rekan Rizki Maulana & Rekanita Zahra'],
                    ['position' => 'Kaderisasi & Komisariat', 'name' => 'Rekan M. Haidar'],
                    ['position' => 'Minat, Bakat & Olahraga', 'name' => 'Rekanita Anisa Putri'],
                ],
            ],
            [
                'slug' => 'upzis-lazisnu',
                'name' => 'UPZIS LAZISNU',
                'category' => 'Lembaga Amil & Filantropi',
                'title' => 'Unit Pengelola Zakat, Infak, & Sedekah NU Gumelar',
                'motto' => 'Akuntabel, Aman Syar’i, Berdaya Guna untuk Mustahik',
                'description' => 'Lembaga filantropi Nahdlatul Ulama di tingkat kecamatan yang mengelola Gerakan Koin NU Peduli, beasiswa santri dhuafa, layanan ambulans siaga, dan tanggap kebencanaan masyarakat pedesaan.',
                'term' => '2024–2029',
                'member_count' => '45 santri penerima beasiswa',
                'coverage' => 'Layanan filantropi se-Kecamatan Gumelar',
                'legal_status' => 'Unit pengelola zakat, infak, dan sedekah MWCNU',
                'note' => 'Laporan keuangan bulanan diaudit internal Tanfidziyah dan dipublikasikan melalui papan informasi masjid.',
                'members' => [
                    ['position' => 'Direktur / Ketua UPZIS', 'name' => 'H. Ahmad Subekhi, S.Ag.'],
                    ['position' => 'Sekretaris & Pelaporan', 'name' => 'M. Taufiqurrahman, S.E.'],
                    ['position' => 'Bendahara & Kasir', 'name' => 'H. Sudirman'],
                    ['position' => 'Koordinator Lapangan Koin', 'name' => 'Nur Hidayat'],
                    ['position' => 'Penyaluran & Tanggap Darurat', 'name' => 'Sugiyanto, S.Pd.'],
                ],
            ],
            [
                'slug' => 'lbmnu-ldnu',
                'name' => 'LBM & Lembaga Dakwah',
                'category' => 'Kajian Syariat & Dakwah',
                'title' => 'Lembaga Bahtsul Masail & Lembaga Dakwah NU',
                'motto' => 'Rujukan Fikih Kontemporer, Penguatan Risalah Dakwah Ahlussunnah',
                'description' => 'Sayap keilmuan dan kajian fatwa yang menghimpun asatidz serta pengasuh pesantren se-Kecamatan Gumelar untuk mengkaji persoalan hukum syariat waqi’iyyah dan membina standardisasi khatib masjid desa.',
                'term' => '2024–2029',
                'member_count' => '4 sidang pleno per tahun',
                'coverage' => 'Katalog fatwa waqi’iyyah desa',
                'legal_status' => 'Lembaga di bawah naungan MWCNU Gumelar',
                'note' => 'Hasil rumusan Bahtsul Masail terdokumentasi sebagai rujukan takmir masjid dan madrasah.',
                'members' => [
                    ['position' => 'Ketua LBMNU', 'name' => 'K.H. Syarif Hidayatullah'],
                    ['position' => 'Katib / Sekretaris Sidang', 'name' => 'K. Mahrus Ali, S.Pd.I.'],
                    ['position' => 'Mushohih / Pengarah', 'name' => 'K.H. Mas’ud Nawawi (Rais Syuriyah)'],
                    ['position' => 'Ketua LDNU', 'name' => 'K. Ahmad Muslich'],
                    ['position' => 'Jadwal Khutbah & Majelis', 'name' => 'Ust. Wahyudin'],
                ],
            ],
        ];

        foreach ($records as $sortOrder => $record) {
            $members = $record['members'];
            unset($record['members']);

            $banom = Banom::firstOrCreate(
                ['slug' => $record['slug']],
                [...$record, 'sort_order' => $sortOrder + 1, 'is_active' => true],
            );

            foreach ($members as $memberOrder => $member) {
                $banom->members()->firstOrCreate(
                    ['position' => $member['position']],
                    [...$member, 'sort_order' => $memberOrder],
                );
            }
        }
    }
}