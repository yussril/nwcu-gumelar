<?php

namespace App\Console\Commands;

use App\Services\KegiatanMover;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:move-kegiatan-to-galeri')]
#[Description('Pindahkan kegiatan yang sudah melewati akhir pelaksanaannya ke galeri')]
class MoveKegiatanToGaleri extends Command
{
    public function handle(): int
    {
        $moved = KegiatanMover::moveDue();

        if ($moved === []) {
            $this->info('Tidak ada kegiatan yang perlu dipindahkan.');

            return self::SUCCESS;
        }

        foreach ($moved as $kegiatan) {
            $this->info("Kegiatan '{$kegiatan->title}' dipindahkan ke galeri.");
        }

        return self::SUCCESS;
    }
}
