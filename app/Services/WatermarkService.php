<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WatermarkService
{
    /**
     * Apply AutoVault watermark to a local stored image.
     * Returns the public URL of the watermarked image.
     */
    public function applyToStoragePath(string $storagePath): ?string
    {
        if (! function_exists('imagecreatefromjpeg')) {
            Log::warning('WatermarkService: GD extension not available. Skipping watermark.');
            return Storage::url($storagePath);
        }

        try {
            $fullPath = storage_path('app/public/' . ltrim($storagePath, '/'));

            if (! file_exists($fullPath)) {
                return null;
            }

            $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
            $source = match ($ext) {
                'jpg', 'jpeg' => imagecreatefromjpeg($fullPath),
                'png'         => imagecreatefrompng($fullPath),
                'webp'        => imagecreatefromwebp($fullPath),
                default       => null,
            };

            if (! $source) {
                return Storage::url($storagePath);
            }

            $this->drawWatermark($source);

            // Save watermarked version (overwrite original)
            match ($ext) {
                'png'  => imagepng($source, $fullPath, 8),
                'webp' => imagewebp($source, $fullPath, 85),
                default => imagejpeg($source, $fullPath, 88),
            };

            imagedestroy($source);

            return Storage::url($storagePath);
        } catch (\Throwable $e) {
            Log::error('WatermarkService error: ' . $e->getMessage());
            return Storage::url($storagePath);
        }
    }

    /**
     * Apply watermark text to an existing GD image resource.
     */
    private function drawWatermark(\GdImage $image): void
    {
        $width  = imagesx($image);
        $height = imagesy($image);

        // Semi-transparent dark background strip at bottom
        $stripHeight = (int) ($height * 0.095);
        $stripHeight = max(28, min($stripHeight, 42));
        $strip = imagecreatetruecolor($width, $stripHeight);
        $black = imagecolorallocate($strip, 0, 0, 0);
        imagefill($strip, 0, 0, $black);
        imagecopymerge($image, $strip, 0, $height - $stripHeight, 0, 0, $width, $stripHeight, 52);
        imagedestroy($strip);

        // Watermark text
        $text  = 'autovault.co.ke';
        $color = imagecolorallocatealpha($image, 255, 255, 255, 18); // near-white, semi-transparent
        $solid = imagecolorallocate($image, 255, 255, 255);

        $fontSize = (int) max(10, $width / 48);

        // Use built-in font (no TTF required)
        $builtIn = 4; // GD built-in font (1-5)
        $charW   = imagefontwidth($builtIn);
        $charH   = imagefontheight($builtIn);
        $textW   = strlen($text) * $charW;

        // Bottom-right position
        $x = $width  - $textW - 10;
        $y = $height - $charH - 8;

        // Subtle shadow
        $shadow = imagecolorallocatealpha($image, 0, 0, 0, 60);
        imagestring($image, $builtIn, $x + 1, $y + 1, $text, $shadow);
        imagestring($image, $builtIn, $x, $y, $text, $solid);

        // Small diagonal tiled watermark across the image
        $tileColor = imagecolorallocatealpha($image, 255, 255, 255, 100);
        $tileText  = 'AutoVault';
        $tileW     = strlen($tileText) * imagefontwidth(2);
        $tileH     = imagefontheight(2);
        $step      = (int) max(180, $width / 3);

        for ($tx = -$step; $tx < $width + $step; $tx += $step) {
            for ($ty = -$step; $ty < $height + $step; $ty += $step) {
                imagestring($image, 2, $tx, $ty, $tileText, $tileColor);
            }
        }
    }

    /**
     * Apply watermark from a temporary uploaded file path before storing.
     * Call this BEFORE moving file to permanent storage.
     *
     * @param string $tmpPath Absolute path to temp file
     * @return void
     */
    public function applyToTempFile(string $tmpPath): void
    {
        if (! function_exists('imagecreatefromjpeg') || ! file_exists($tmpPath)) {
            return;
        }

        try {
            $ext    = strtolower(pathinfo($tmpPath, PATHINFO_EXTENSION));
            $source = match ($ext) {
                'jpg', 'jpeg' => imagecreatefromjpeg($tmpPath),
                'png'         => imagecreatefrompng($tmpPath),
                'webp'        => imagecreatefromwebp($tmpPath),
                default       => null,
            };

            if (! $source) return;

            $this->drawWatermark($source);

            match ($ext) {
                'png'  => imagepng($source, $tmpPath, 8),
                'webp' => imagewebp($source, $tmpPath, 85),
                default => imagejpeg($source, $tmpPath, 88),
            };

            imagedestroy($source);
        } catch (\Throwable $e) {
            Log::error('WatermarkService::applyToTempFile error: ' . $e->getMessage());
        }
    }
}
