<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-4xl">
    <a href="<?php echo e(route('admin.articles.index')); ?>" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke Warta Nahdliyin
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Publikasi</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface"><?php echo e($article->exists ? 'Ubah Warta Nahdliyin' : 'Tulis Warta Nahdliyin Baru'); ?></h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">Kelola berita, kajian, dan pengumuman resmi MWCNU.</p>
    </div>
    <?php if($errors->any()): ?>
        <div class="mb-5 rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 text-sm text-on-error-container" role="alert">
            <p class="font-bold mb-1">Periksa kembali data yang diisi:</p>
            <ul class="list-disc pl-5 space-y-0.5"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>
    <form class="flex flex-col gap-5" action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php if($method === 'PUT'): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Detail Warta Nahdliyin</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="title">Judul Warta Nahdliyin<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="title" name="title" value="<?php echo e(old('title', $article->title)); ?>" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="category">Kategori<select class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="category" name="category" required><option value="" disabled selected>Pilih kategori</option><option value="Kegiatan Ranting" <?php if(old('category', $article->category) === 'Kegiatan Ranting'): echo 'selected'; endif; ?>>Kegiatan Ranting</option><option value="Kajian & Fatwa" <?php if(old('category', $article->category) === 'Kajian & Fatwa'): echo 'selected'; endif; ?>>Kajian & Fatwa</option><option value="Kabar Banom" <?php if(old('category', $article->category) === 'Kabar Banom'): echo 'selected'; endif; ?>>Kabar Banom</option><option value="Pengumuman Resmi" <?php if(old('category', $article->category) === 'Pengumuman Resmi'): echo 'selected'; endif; ?>>Pengumuman Resmi</option></select></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="author">Penulis / Kontributor<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="author" name="author" value="<?php echo e(old('author', $article->author)); ?>"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="published_at">Tanggal terbit<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="published_at" name="published_at" type="datetime-local" value="<?php echo e(old('published_at', $article->published_at?->format('Y-m-d\TH:i'))); ?>"></label>
            </div>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="excerpt">Ringkasan<textarea class="min-h-20 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="excerpt" name="excerpt" required rows="3"><?php echo e(old('excerpt', $article->excerpt)); ?></textarea></label>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="body">Isi Warta Nahdliyin<textarea class="min-h-40 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="body" name="body" required rows="8"><?php echo e(old('body', $article->body)); ?></textarea></label>
        </section>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Media Sosial</h2>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_facebook">Facebook</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_facebook" name="social_facebook" type="url" value="<?php echo e(old('social_facebook', $article->social_facebook)); ?>" placeholder="https://facebook.com/MWCNUGumelar">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_twitter">X (Twitter)</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_twitter" name="social_twitter" type="url" value="<?php echo e(old('social_twitter', $article->social_twitter)); ?>" placeholder="https://x.com/MWCNUGumelar">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_instagram">Instagram</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_instagram" name="social_instagram" type="url" value="<?php echo e(old('social_instagram', $article->social_instagram)); ?>" placeholder="https://instagram.com/MWCNUGumelar">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_youtube">YouTube</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_youtube" name="social_youtube" type="url" value="<?php echo e(old('social_youtube', $article->social_youtube)); ?>" placeholder="https://youtube.com/@MWCNUGumelar">
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_whatsapp">WhatsApp</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_whatsapp" name="social_whatsapp" type="url" value="<?php echo e(old('social_whatsapp', $article->social_whatsapp)); ?>" placeholder="https://wa.me/628xxxx">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="social_website">Website</label>
                    <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="social_website" name="social_website" type="url" value="<?php echo e(old('social_website', $article->social_website)); ?>" placeholder="https://mwcnu-gumelar.or.id">
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="tags">Tag / Topik (dipisahkan koma)</label>
                <input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="tags" name="tags" type="text" value="<?php echo e(old('tags', implode(',', $article->tags ?? []))); ?>" placeholder="#KecamatanGumelar, #WartaNU, #Kajian">
            </div>
        </section>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Featured Image</h2>
            <label class="border-2 border-dashed border-slate-200 bg-slate-50/70 hover:bg-emerald-50/30 hover:border-primary-container transition-all cursor-pointer rounded-xl h-44 flex flex-col items-center justify-center text-center p-4 group" for="image">
                <div class="w-11 h-11 rounded-full bg-emerald-100/70 flex items-center justify-center text-primary-container mb-2.5 group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[22px]">add_photo_alternate</span>
                </div>
                <span class="font-label-md text-label-md text-slate-800 font-semibold group-hover:text-primary-container transition-colors">Klik untuk unggah gambar</span>
                <p class="font-body-sm text-[11px] text-slate-400 mt-1 max-w-[220px]">PNG, JPG, atau WEBP hingga 5MB (Rekomendasi rasio 16:9 atau 1200x675 px)</p>
                <input class="hidden" id="image" name="image" type="file" accept="image/png,image/jpeg,image/webp">
            </label>
            <?php if($article->imageSource()): ?>
                <img class="h-40 w-64 rounded-lg border border-outline-variant object-cover mt-4" src="<?php echo e($article->imageSource()); ?>" alt="Gambar saat ini">
            <?php endif; ?>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-body-sm bg-slate-50 p-2.5 rounded-lg border border-slate-100 mt-3">
                <span class="material-symbols-outlined text-slate-400 text-[16px]">info</span>
                <span>Gambar sampul akan muncul di kartu feed dan banner pembuka warta.</span>
            </div>
        </section>
        <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <a class="inline-flex min-h-11 items-center justify-center rounded-lg border border-outline-variant px-5 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container" href="<?php echo e(route('admin.articles.index')); ?>">Batal</a>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan Warta Nahdliyin</button>
        </div>
    </form>
</div>

<script>
    // Initialize word/char count for editor
    const editorBody = document.getElementById('editor-body');
    const wordCountDisplay = document.getElementById('word-count');
    const charCountDisplay = document.getElementById('char-count');

    if (editorBody && wordCountDisplay && charCountDisplay) {
        editorBody.addEventListener('input', () => {
            const text = editorBody.innerText.trim();
            const words = text ? text.split(/\s+/).length : 0;
            const chars = text.length;
            wordCountDisplay.innerText = \`\${words} Kata\`;
            charCountDisplay.innerText = \`\${chars} Karakter\`;
        });
    }

    // Initialize excerpt counter
    const excerptInput = document.getElementById('article-excerpt');
    const excerptCounter = document.getElementById('excerpt-counter');

    if (excerptInput && excerptCounter) {
        excerptInput.addEventListener('input', (e) => {
            const currentLength = e.target.value.length;
            excerptCounter.innerText = \`\${currentLength} / 250 karakter\`;
        });
    }

    // Social media link preview / validator
    document.querySelectorAll('input[type="url"]').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value && !this.value.startsWith('https://') && !this.value.startsWith('http://')) {
                this.value = 'https://' + this.value;
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/articles/form.blade.php ENDPATH**/ ?>