<?php
$files = array_merge(
    glob(__DIR__ . '/resources/views/**/*.blade.php'),
    glob(__DIR__ . '/resources/views/*.blade.php')
);
foreach ($files as $file) {
    $content = file_get_contents($file);
    // Dark to Light replacements
    $content = str_replace('text-white', 'text-slate-900', $content);
    $content = str_replace('text-gray-300', 'text-slate-600', $content);
    $content = str_replace('text-gray-400', 'text-slate-500', $content);
    $content = str_replace('text-gray-500', 'text-slate-400', $content);
    $content = str_replace('bg-white/5', 'bg-white/60', $content);
    $content = str_replace('bg-white/10', 'bg-white/80', $content);
    $content = str_replace('border-white/10', 'border-slate-200', $content);
    $content = str_replace('bg-dark/80', 'bg-white', $content);
    $content = str_replace('text-rose-200/80', 'text-rose-700', $content);
    $content = str_replace('text-rose-300', 'text-rose-800', $content);
    $content = str_replace('text-emerald-300', 'text-emerald-800', $content);
    $content = str_replace('divide-white/5', 'divide-slate-200', $content);
    $content = str_replace('text-gray-200', 'text-slate-800', $content);
    
    file_put_contents($file, $content);
}
echo "Theme updated to light mode successfully!";
