<?php
// tools/update-brand-content.php
// Comprehensive find-and-replace for Fashion Nova branding and content updates

$replacements = [
    // Sparrow -> Fashion Nova
    'Sparrow' => 'Fashion Nova',
    'sparrow' => 'Fashion Nova',
    'SPARROW' => 'FASHION NOVA',

    // Fincatch references
    'Fincatch' => 'Fashion Nova',
    'fincatch' => 'fashion nova',
    'FINCATCH' => 'FASHION NOVA',

    // RealityMogul -> Fashion Nova
    'RealityMogul' => 'Fashion Nova',
    'RealtyMogul' => 'Fashion Nova',
    'Realty Mogul' => 'Fashion Nova',
    'Realty mogul' => 'Fashion Nova',
    'realty mogul' => 'fashion nova',

    // Fitness content -> Fashion content
    'fitness fun' => 'fashion forward',
    'mobile health trainer' => 'personal stylist',
    'Personal tracker in your pocket' => 'Your Personal Fashion Assistant',
    'training plans' => 'style guides',
    'route planning' => 'outfit planning',
    'fitness app' => 'fashion app',
    'make the most of your sport' => 'express your authentic style',
    'thousands of more active people' => 'millions of fashion lovers',
    'community' => 'community',
    'get inspired' => 'get inspired',
    'physical experts' => 'fashion experts',
    'checkout pro' => 'shop collection',

    // Finance/investment content -> Fashion content
    'commercial real estate' => 'premium fashion',
    'investment' => 'shopping',
    'investor' => 'customer',
    'accredited investors' => 'fashion enthusiasts',

    // Email replacements
    'bhello@fincatch.com' => 'hello@fashionnova.com',
    'support@realtymogul.com' => 'support@fashionnova.com',
];

$root = __DIR__ . '/../resources/views';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$filesChanged = 0;
$files = [];
$changes = [];

foreach ($it as $file) {
    if (!$file->isFile()) continue;
    $path = $file->getPathname();
    if (pathinfo($path, PATHINFO_EXTENSION) !== 'php' && !str_ends_with($path, '.blade.php')) continue;

    $content = file_get_contents($path);
    $orig = $content;

    foreach ($replacements as $old => $new) {
        // Case-sensitive replacement first
        if (strpos($content, $old) !== false) {
            $content = str_replace($old, $new, $content);
            $relPath = substr($path, strlen(__DIR__ . '/..') + 1);
            $changes[$relPath][] = "$old → $new";
        }
    }

    if ($content !== $orig) {
        file_put_contents($path, $content);
        $filesChanged++;
        $files[] = substr($path, strlen(__DIR__ . '/..') + 1);
    }
}

echo "Changed files: $filesChanged\n\n";
foreach ($files as $f) {
    echo "File: $f\n";
    if (isset($changes[$f])) {
        foreach ($changes[$f] as $change) {
            echo "  - $change\n";
        }
    }
    echo "\n";
}
