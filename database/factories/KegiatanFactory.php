<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Kegiatan>
 */
class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = Str::ucfirst($this->faker->unique()->words(3, true));

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1, 999999),
            'description' => $this->faker->paragraph(),
            'cover_image_path' => null,
            'location' => $this->faker->city().', Gumelar',
            'category' => $this->faker->randomElement([
                'syuriyah-tanfidziyah', 'ansor', 'fatayat', 'ipnu-ippnu', 'lazisnu', 'dakwah', 'ranting',
            ]),
            'scheduled_at' => now()->addWeek(),
            'scheduled_end_at' => now()->addWeek()->addHours(3),
            'is_published' => true,
            'sort_order' => 0,
        ];
    }

    /**
     * Kegiatan yang waktunya sudah lewat, sehingga otomatis pindah ke galeri.
     */
    public function due(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => now()->subDays(2),
            'scheduled_end_at' => now()->subHour(),
        ]);
    }

    /**
     * Kegiatan tanpa "akhir pelaksanaan", jadi batasnya memakai jadwal mulai.
     */
    public function withoutEndTime(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => now()->subHour(),
            'scheduled_end_at' => null,
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => ['is_published' => false]);
    }
}
