<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class ProcessImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $fileName;
    protected string $fullPath;

    public function __construct( string $fileName, string $fullPath)
    {
        $this->fileName = $fileName;
        $this->fullPath = $fullPath;
    }

    public function handle(): void
    {

        $imageContent = Storage::disk('public')->get($this->fullPath);
        $image = Image::read($imageContent);
        $sizes = [400,800,1200];
        $compression = 85;
        $variantPathTemplate = 'images/%s';

        foreach ($sizes as $size){

            $resizedImage = $image
                ->scale($size, $size)
                ->toJpeg($compression);

            $variantPath = sprintf($variantPathTemplate, $size);
            $fullVariantPath = $variantPath . '/' . $this->fileName;

            Storage::disk('public')->put($fullVariantPath, $resizedImage);
        }
    }
}
