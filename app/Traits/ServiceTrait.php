<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ServiceTrait
{
    const MODELS_PATH = 'App\Models\\';

    private function getModel($accountType, $accountId, $throwException = true)
    {
        $class = $this->getModelClass($accountType);

        $this->throwClassNotfoundException(
            "an invalid account type of $accountType was provided",
            $class, 
            $throwException
        );

        $model = $class::find($accountId);

        $this->throwModelNotfoundException(
            "the $accountType account was not found with the given id of $accountId",
            $model, 
            $throwException
        );

        return $model;
    }

    private function getModelClass($accountType)
    {
        $class = self::MODELS_PATH . $accountType;

        if (class_exists($class)) {
            return $class;
        }

        return null;
    }

    private function throwClassNotfoundException($message, $class, $throw)
    {
        if (!$throw) {
            return;
        }

        if (!is_null($class) || !method_exists($this, 'throwException')) {
            return;
        }

        $this->throwException($message);
    }

    private function throwModelNotfoundException($message, $model, $throw)
    {
        if (!$throw) {
            return;
        }

        if (!is_null($model) || !method_exists($this, 'throwException')) {
            return;
        }

        $this->throwException($message);
    }

    private function getModelBase($model)
    {
        return $this->makeFirstLetterLowercase(basename($model::class));
    }

    private function makeFirstLetterLowercase($string)
    {
        return strtolower(substr($string, 0, 1)) . substr($string, 1);
    }
}
