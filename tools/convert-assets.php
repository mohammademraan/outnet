<?php

// tools/convert-assets.php
// Scans Blade view files and replaces hardcoded asset paths (assets/, user/, admin/) in
// src, href, data-background, and background-image:url(...) with {{ asset('...') }}.

$root = __DIR__.'/../resources/views';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$filesChanged = 0;
$files = [];
foreach ($it as $file) {
    if (!$file->isFile()) {
        continue;
    }
    $path = $file->getPathname();
    if (pathinfo($path, PATHINFO_EXTENSION) !== 'php' && !str_ends_with($path, '.blade.php')) {
        continue;
    }
    $content = file_get_contents($path);
    $orig = $content;

    // Replace src and href attributes
    $content = preg_replace_callback(
        '/\b(src|href)=(["\'])(?!\s*\{\{|\s*https?:\/\/|\/\/)(\/?([^"\'>]*?(?:assets\/|user\/|admin\/)[^"\'>]*))\2/i',
        function ($m) {
            $attr = $m[1];
            $quote = $m[2];
            $path = ltrim($m[3], '/');
            // skip if already using asset or url helpers
            if (str_contains($m[0], '{{ asset(') || str_contains($m[0], '{{ url(') || str_contains($m[0], '{{ mix(')) {
                return $m[0];
            }

            return sprintf('%s=%s{{ asset(\'%s\') }}%s', $attr, $quote, $path, $quote);
        },
        $content
    );

    // Replace background-image:url(...) occurrences
    $content = preg_replace_callback(
        '/url\((\"|\'|)?(?!\s*\{\{|\s*https?:\/\/|\/\/)(\/?([^\)"\']*?(?:assets\/|user\/|admin\/)[^\)"\']*))\1\)/i',
        function ($m) {
            $path = ltrim($m[2], '/');
            if (str_contains($m[0], '{{ asset(')) {
                return $m[0];
            }

            return 'url({{ asset(\''.$path.'\') }})';
        },
        $content
    );

    // Replace data-background attributes (often used with simple paths)
    $content = preg_replace_callback(
        '/\bdata-background=(["\'])(?!\s*\{\{|\s*https?:\/\/|\/\/)(\/?([^"\']*?(?:assets\/|user\/|admin\/)[^"\']*))\1/i',
        function ($m) {
            $quote = $m[1];
            $path = ltrim($m[2], '/');
            if (str_contains($m[0], '{{ asset(')) {
                return $m[0];
            }

            return sprintf('data-background=%s{{ asset(\'%s\') }}%s', $quote, $path, $quote);
        },
        $content
    );

    if ($content !== $orig) {
        file_put_contents($path, $content);
        ++$filesChanged;
        $files[] = substr($path, strlen(__DIR__.'/..') + 1);
    }
}

echo "Changed files: $filesChanged\n";
foreach ($files as $f) {
    echo " - $f\n";
}
