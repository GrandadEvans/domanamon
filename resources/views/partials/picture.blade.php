<?php
// Normal image path
$imagePath = '/images/' . $filename;
// Get the extension
$ext       = last(explode('.', $filename));
// From the two above work out the webp image path
$webpPath = preg_replace('/\.'.$ext.'$/', '.webp', $imagePath);

// Create a blank string for the attributes
$attrString = '';
foreach ($attributes as $attribute => $value) {
    // For each attribute append the attribute and value
    $attrString .= e($attribute) . '="' . e($value) . '" ';
}
?>
<picture>
    <source srcset="{{ $webpPath }}" {!! $attrString !!}>
    <source srcset="{{ $imagePath }}" {!! $attrString !!}>
    <img src="{{ $imagePath }}" {!! $attrString !!}>
</picture>
