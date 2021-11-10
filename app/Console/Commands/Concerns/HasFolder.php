<?php

namespace App\Console\Commands\Concerns;

trait HasFolder
{
    public static function existOrCreate(?string $tenant)
    {
       if (! self::isSessionFolderExist($tenant)) {
           \File::makeDirectory(
               storage_path("framework/sessions/$tenant"),
               0777, true, true);
       }
    }

    private static function isSessionFolderExist(?string $tenant): bool
    {
        $path = storage_path("framework/sessions/$tenant");

        return \File::isDirectory($path);
    }
}
