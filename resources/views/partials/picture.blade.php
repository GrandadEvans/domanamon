<?php
$imagePath = '/images/' . $filename;
$ext       = last(explode('.', $filename));
$webpPath  = str_replace($ext, 'webp', $imagePath);
$attrString = '';
foreach ($attributes as $attribute => $value) {
    $attrString .= e($attribute) . '="' . e($value) . '" ';
}
?>
<picture>
    <source srcset="{{ $webpPath }}" {!! $attrString !!}>
    <img src="{{ $imagePath }}" {!! $attrString !!}>
</picture>
