<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Translation\Translator as BaseTranslator;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Facades\Cache;

/**
 * Class JsonTranslator
 * @package App\Translator
 */
class JsonTranslator extends BaseTranslator
{
    /**
     * @param string $key
     * @param array $replace
     * @param null $locale
     * @param bool $fallback
     *
     * @return array|null|string|void
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true)
    {
        $translation = parent::get($key, $replace, $locale, false);
        
        if ($translation === $key) {
            /* Log::warning('Language item could not be found.', [
                'language' => $locale ?? config('app.locale'),
                'id' => $key,
                'url' => config('app.url')
            ]); */

            if (strpos($key,'.')){

                $to_translate_array = explode('.',$key);

                $language_line = LanguageLine::where('group',$to_translate_array[0])->where('key',$to_translate_array[1])->count();

                if( $language_line == 0){
                    Log::info($to_translate_array);
                    $language_keys = array_keys(\LaravelLocalization::getSupportedLocales());
                    $text_arr = [];
    
                    foreach ($language_keys as $lang_key => $code){
    
                        if ( $code == $locale){
                            $text_arr[$code] = $key;
                        }
                        else{
                            $lang_translation = parent::get($key, $replace, $code, false);
                            if ($lang_translation !== $key) {
                                $text_arr[$code] = $lang_translation;
                            }
                            else
                                $text_arr[$code] = $key;
                        }
                        
                    }
                    
                    Log::notice([
                        'group' => $to_translate_array[0],
                        'key' => $to_translate_array[1],
                        'text' => $text_arr //['en' => 'This is a required field', 'nl' => 'Dit is een verplicht veld'],
                    ]);
    
                    LanguageLine::create([
                        'group' => $to_translate_array[0],
                        'key' => $to_translate_array[1],
                        'text' => $text_arr //['en' => 'This is a required field', 'nl' => 'Dit is een verplicht veld'],
                    ]);
    
                    foreach ($language_keys as $lang_key => $code){
                        Cache::forget('spatie.translation-loader.'.$to_translate_array[0].'.'.$code );
                    }   
                }
                
            }
        }
        return $translation;
    }
}