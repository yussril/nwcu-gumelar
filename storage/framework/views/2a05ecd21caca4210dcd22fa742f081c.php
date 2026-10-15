<?php $__env->startSection('title', $article->title . ' - MWCNU Gumelar'); ?>


\
<div class="bg-surface-container-lowest text-on-surface">
    <section class="border-b border-outline-variant/50 px-6 pt-24 pb-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <a href="<?php echo e(route('berita')); ?>" class="mb-6 inline-flex items-center gap-2 rounded-full border border-outline-variant bg-surface-container-lowest px-4 py-2 text-sm font-semibold text-primary hover:bg-primary-fixed/20 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke Halaman Berita
            </a>
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div class="max-w-3xl">
                    <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-primary-fixed/40 px-3 py-1 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Detail Warta
                    </p>
                    <h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-on-surface lg:text-headline-xl"><?php echo e($article->title); ?></h1>
                    <p class="mt-3 font-body-lg text-body-lg leading-relaxed text-on-surface-variant"><?php echo e($article->excerpt); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-10 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <article class="overflow-hidden rounded-2xl border border-outline-variant/40 bg-white">
                <?php if($article->imageSource()): ?>
                <div class="relative aspect-[16/9] overflow-hidden bg-surface-container">
                    <img class="h-full w-full object-cover" src="<?php echo e($article->imageSource()); ?>" alt="<?php echo e($article->title); ?>">
                    <span class="absolute left-4 top-4 rounded-full bg-primary-container px-3 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-white"><?php echo e($article->category); ?></span>
                </div>
                <?php endif; ?>
                <div class="p-6 sm:p-8 lg:p-10">
                    <div class="flex flex-wrap items-center gap-2 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">
                        <span class="text-primary"><?php echo e($article->category); ?></span>
                        <span>•</span>
                        <span><?php echo e($article->published_at?->translatedFormat('d F Y') ?? 'Warta terbaru'); ?></span>
                        <span>•</span>
                        <span><?php echo e($article->author ?: 'Redaksi Media MWCNU'); ?></span>
                    </div>
                    <div class="prose prose-slate mt-8 max-w-none whitespace-pre-line font-body-md text-body-md leading-relaxed text-slate-700">
                        <?php echo e($article->body ?: $article->excerpt); ?>

                    </div>

                    <?php if(!empty($article->tags)): ?>
                    <div class="mt-6 flex flex-wrap items-center gap-2">
                        <span class="font-label-sm text-label-sm font-semibold text-slate-500">Tag:</span>
                        <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="rounded-full bg-primary-fixed/40 px-3 py-1 text-xs font-medium text-primary-container"><?php echo e($tag); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    <?php
                        $sl = $article->getSocialMediaLinks();
                    ?>
                    <?php if(is_array($sl) && count($sl) > 0): ?>
                    <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-6" id="social-media" aria-label="Media sosial resmi MWCNU">
                        <span class="font-label-sm text-label-sm font-semibold text-slate-500">Media Sosial Resmi MWCNU Gumelar</span>
                        <div class="flex flex-wrap items-center gap-2">
                            <?php $__currentLoopData = $sl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($url): ?>
                            <?php
                                $platformLabels = [
                                    'facebook' => 'Facebook',
                                    'twitter' => 'X (Twitter)',
                                    'instagram' => 'Instagram',
                                    'youtube' => 'YouTube',
                                    'whatsapp' => 'WhatsApp',
                                    'website' => 'Website',
                                ];
                                $platformColors = [
                                    'facebook' => 'bg-[#1877F2]/10 text-[#1877F2] hover:bg-[#1877F2] hover:text-white',
                                    'twitter' => 'bg-slate-900/10 text-slate-900 hover:bg-slate-900 hover:text-white',
                                    'instagram' => 'bg-gradient-to-tr from-[#F58529] via-[#DD2A7B] to-[#8134AF]/20 text-[#DD2A7B] hover:bg-gradient-to-tr hover:from-[#F58529] hover:via-[#DD2A7B] hover:to-[#8134AF] hover:text-white',
                                    'youtube' => 'bg-[#FF0000]/10 text-[#FF0000] hover:bg-[#FF0000] hover:text-white',
                                    'whatsapp' => 'bg-[#25D366]/10 text-[#25D366] hover:bg-[#25D366] hover:text-white',
                                    'website' => 'bg-primary/10 text-primary hover:bg-primary hover:text-white',
                                ];
                                $label = $platformLabels[$platform] ?? ucfirst($platform);
                                $color = $platformColors[$platform] ?? 'bg-primary/10 text-primary hover:bg-primary hover:text-white';

                                $svgIcons = [
                                    'facebook' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
                                    'twitter' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                                    'instagram' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
                                    'youtube' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                                    'whatsapp' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>',
                                    'website' => '<svg class="w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm8.485 7h-2.709c-.327-1.044-.79-2.035-1.381-2.954A9.96 9.96 0 0120.485 7zM12 2.03c.79 0 1.782.982 2.336 2.97h-4.672C10.218 3.012 11.21 2.03 12 2.03zM2.25 12c0-.514.047-1.016.138-1.504h3.135c-.063.49-.097.99-.097 1.504s.034 1.014.097 1.504H2.388A9.966 9.966 0 012.25 12zm.265 3h2.709c.327 1.044.79 2.035 1.381 2.954A9.96 9.96 0 012.515 15zM12 21.97c-.79 0-1.782-.982-2.336-2.97h4.672c-.554 1.988-1.546 2.97-2.336 2.97zM14.798 15H9.202c-.076-.49-.122-.989-.122-1.5s.046-1.01.122-1.5h5.596c.076.49.122.989.122 1.5s-.046 1.01-.122 1.5zm.317 4.954c.591-.919 1.054-1.91 1.381-2.954h2.709a9.96 9.96 0 01-4.09 2.954zM17.128 12c0-.514-.034-1.014-.097-1.504h3.135c.091.488.138.99.138 1.504s-.047 1.016-.138 1.504h-3.135c.063-.49.097-.99.097-1.504z"/></svg>',
                                ];
                                $svgIcon = $svgIcons[$platform] ?? '<span class="material-symbols-outlined text-[16px]">open_in_new</span>';
                            ?>
                            <a class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e($color); ?>" href="<?php echo e($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo e($label); ?> MWCNU Gumelar" title="<?php echo e($label); ?> MWCNU Gumelar">
                                <?php echo $svgIcon; ?>                                <span class="hidden sm:inline"><?php echo e($label); ?></span>
                            </a>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </section>
</div>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/public/berita-detail.blade.php ENDPATH**/ ?>