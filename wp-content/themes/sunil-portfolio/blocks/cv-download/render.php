<?php
$heading           = $attributes['heading']          ?? 'Ready to build something exceptional?';
$heading_highlight = $attributes['headingHighlight'] ?? 'exceptional?';
$subtext           = $attributes['subtext']          ?? "I'm currently accepting new projects for Q3 & Q4 2024. Let's discuss your architectural needs.";
$primary_label     = $attributes['primaryLabel']     ?? 'Book a Consultation';
$primary_url       = $attributes['primaryUrl']       ?? '#contact';
$secondary_label   = $attributes['secondaryLabel']   ?? 'Download CV';
$secondary_url     = $attributes['secondaryUrl']     ?? '#';
$cv_file           = $attributes['cvFile']           ?? '';

// If a CV file is uploaded, use it for the secondary button
if ( ! empty( $cv_file ) ) {
    $secondary_url = esc_url( $cv_file );
}

// Split heading to wrap the highlight word(s) in a gradient span
$heading_before = $heading_highlight
    ? str_replace( $heading_highlight, '', $heading )
    : $heading;

// Wrapper carries Gutenberg color/typography/spacing styles
$wrapper_attributes = get_block_wrapper_attributes( [
    'class' => 'mt-24  bg-slate-900 text-white text-center relative overflow-hidden',
    'style' => 'padding:3rem 5rem;',
] );
?>

<div <?php echo $wrapper_attributes; ?>>

    <div class="relative z-10 flex flex-col items-center gap-6">

        <h2 class="text-4xl md:text-6xl font-black max-w-3xl leading-tight">
            <?php echo esc_html( $heading_before ); ?><span class="gradient-text"><?php echo esc_html( $heading_highlight ); ?></span>
        </h2>

        <p class="text-slate-400 text-lg max-w-xl">
            <?php echo esc_html( $subtext ); ?>
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-4">

            <a href="<?php echo esc_url( $primary_url ); ?>"
               class="px-8 py-4 gradient-bg text-white font-bold rounded-full hover:scale-105 transition-transform shadow-xl">
                <?php echo esc_html( $primary_label ); ?>
            </a>

            <a href="<?php echo esc_url( $secondary_url ); ?>"
               <?php if ( ! empty( $cv_file ) ) : ?>download<?php endif; ?>
               class="px-8 py-4 border border-slate-700 font-bold rounded-full hover:bg-white/10 transition-colors">
                <?php echo esc_html( $secondary_label ); ?>
            </a>

        </div>
    </div>

    <!-- Glow blobs -->
    <div class="absolute -bottom-24 -right-24 size-64 bg-primary/20 rounded-full blur-[100px]"></div>
    <div class="absolute -top-24 -left-24 size-64 bg-accent-end/20 rounded-full blur-[100px]"></div>

</div>