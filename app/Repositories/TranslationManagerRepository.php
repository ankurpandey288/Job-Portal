<?php

namespace App\Repositories;

use File;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TranslationManagerRepository
 */
class TranslationManagerRepository
{
    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        $allLanguagesArr = [];
        $languages = File::directories(resource_path().'/lang');
        foreach ($languages as $language) {
            $allLanguagesArr[] = substr($language, -2);
        }

        if (in_array($input['name'], $allLanguagesArr)) {
            throw new UnprocessableEntityHttpException($input['name'].' language already exists.');
        }

        try {
            if (! empty($input['name'])) {
                //Make directory in lang folder
                File::makeDirectory(resource_path().'/lang'.'/'.$input['name']);

                //Copy all en folder files to new folder.
                $filesInFolder = File::files(App::langPath().'/en');
                foreach ($filesInFolder as $path) {
                    $file = basename($path);
                    File::copy(App::langPath().'/en/'.$file, App::langPath().'/'.$input['name'].'/'.$file);
                }
            }

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $selectedLang
     * @param $selectedFile
     * @return mixed
     */
    public function getSubDirectoryFiles($selectedLang, $selectedFile)
    {
        $data['allFiles'] = [];
        try {
            $files = File::allFiles(App::langPath().'/'.$selectedLang.'/');
            foreach ($files as $file) {
                $data['allFiles'][basename($file)] = ucfirst(basename($file));
            }

            $data['languages'] = File::directories(resource_path().'/lang');
            $data['allLanguagesArr'] = [];
            foreach ($data['languages'] as $language) {
                $lName = substr($language, -2);
                $data['allLanguagesArr'][$lName] = strtoupper(substr($language, -2));
                app()->setLocale(substr($selectedLang, -2));
                $data['languages'] = trans(pathinfo($selectedFile, PATHINFO_FILENAME));
            }

            return $data;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $selectedLang
     * @param $selectedFile
     * @return mixed
     */
    public function checkFileExistOrNot($selectedLang, $selectedFile)
    {
        $fileExists = true;
        $data['allFiles'] = [];
        try {
            $files = File::allFiles(App::langPath().'/'.$selectedLang.'/');
            foreach ($files as $file) {
                $data['allFiles'][] = ucfirst(basename($file));
            }

            if (! in_array(ucfirst($selectedFile), $data['allFiles'])) {
                $fileExists = false;
            }

            return $fileExists;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $selectedLang
     * @return bool
     */
    public function checkLanguageExistOrNot($selectedLang)
    {
        $langExists = true;
        $allLanguagesArr = [];
        try {
            $languages = File::directories(resource_path().'/lang');
            foreach ($languages as $language) {
                $allLanguagesArr[] = substr($language, -2);
            }

            if (! in_array($selectedLang, $allLanguagesArr)) {
                $langExists = false;
            }

            return $langExists;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
