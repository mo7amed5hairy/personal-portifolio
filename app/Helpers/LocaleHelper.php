<?php

if (!function_exists('__t')) {
    /**
     * Translate with fallback
     */
    function __t(string $key, array $replace = [], ?string $locale = null): string
    {
        $translation = __($key, $replace, $locale);
        
        if ($translation === $key) {
            $fallback = trans($key, $replace, 'en');
            return $fallback !== $key ? $fallback : $translation;
        }
        
        return $translation;
    }
}

if (!function_exists('is_rtl')) {
    /**
     * Check if current locale is RTL
     */
    function is_rtl(): bool
    {
        return in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur']);
    }
}

if (!function_exists('locale_direction')) {
    /**
     * Get text direction for current locale
     */
    function locale_direction(): string
    {
        return is_rtl() ? 'rtl' : 'ltr';
    }
}

if (!function_exists('locale_route')) {
    /**
     * Generate route with locale prefix
     */
    function locale_route(string $name, array $parameters = [], bool $absolute = true): string
    {
        $locale = app()->getLocale();
        
        // Check if route has locale parameter
        try {
            $route = route($name, array_merge(['locale' => $locale], $parameters), $absolute);
            return $route;
        } catch (\Exception $e) {
            return route($name, $parameters, $absolute);
        }
    }
}

if (!function_exists('switch_locale_url')) {
    /**
     * Get URL for switching locale
     */
    function switch_locale_url(string $locale): string
    {
        $currentUrl = request()->url();
        $currentLocale = app()->getLocale();
        
        // Replace locale in URL
        return str_replace("/{$currentLocale}/", "/{$locale}/", $currentUrl);
    }
}
