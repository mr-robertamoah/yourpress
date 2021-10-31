<?php

namespace App\Services;

use App\Exceptions\FileException;
use App\Traits\ServiceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{
    use ServiceTrait;

    public static function saveUploadedFileAndAttachToItem(UploadedFile $uploadedFile, Model $item)
    {
        $self = new static;

        $fileDetails = $self->getFileDetails($uploadedFile);

        $file = $self->saveUploadedFile($fileDetails);

        $self->storeUploadedFile($uploadedFile, $fileDetails);

        $self->attachFileToItem($file, $item);

        return $item->refresh();
    }

    public static function saveUploadedFilesAndAttachToItem(array $uploadedFiles, Model $item)
    {
        
        return $item;
    }

    public function attachFileToItem($file, $item)
    {
        $method = $this->getModelBase($file) . 's';
        
        $item->$method()->attach($file);

        return $item;
    }

    private function getFileDetails(UploadedFile $uploadedFile)
    {
        return [
            'mime' => $uploadedFile->getClientMimeType(),
            'type' => $this->getMime($uploadedFile->getClientMimeType()),
            'extension' => $uploadedFile->getClientOriginalExtension(),
            'name' => $uploadedFile->getClientOriginalName(),
            'storageName' => Str::kebab(str_replace(
                $uploadedFile->getClientOriginalExtension(),
                '',
                $uploadedFile->getClientOriginalName()
            )) . "-" . (string) time(),
        ];
    }

    private function getPath($details)
    {
        return "{$details['type']}s/{$details['storageName']}";
    }

    private function getMime(string $string)
    {
        if (str_contains($string, 'image')) {
            return 'image';
        }
        
        if (str_contains($string, 'audio')) {
            return 'audio';
        }
        
        if (str_contains($string, 'video')) {
            return 'video';
        }

        return 'file';
    }

    public function saveUploadedFile(array $details)
    {
        $class = static::MODELS_PATH . $details['type'];

        if (! class_exists($class)) {
            return $this->throwException("sorry 😞! {$details['type']} uploading does not exist in this app");
        }

        return $class::create([
            ...$details,
            'path' => $this->getPath($details)
        ]);
    }

    private function throwException($message, $data = null)
    {
        throw new FileException(
            message: $message,
            data: $data
        );
    }

    public function storeUploadedFile(UploadedFile $uploadedFile, array $details)
    {
        $successful = $uploadedFile->storePubliclyAs($this->getPath($details), $details['storageName']);

        if ($successful) {
            return;
        }

        $this->throwException("", $details);
    }
}
