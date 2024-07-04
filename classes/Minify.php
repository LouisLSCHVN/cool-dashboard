<?php

namespace Cool_Dashboard\Classes;

use JShrink\Minifier;

class Minify
{

    /**
     * Minify Css
     *
     * @param $content string
     * @return string
     */
    public static function css(string $content): string
    {
        // Remove comments and unnecessary whitespaces
        $content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
        $content = preg_replace('/\s*([{}|:;,])\s+/', '$1', $content);
        $content = preg_replace('/\s\s+(.*)/', '$1', $content);
        return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $content);
    }

    /**
     * Minify Html
     *
     * @param $content string
     * @return string
     */
    public static function html(string $content): string
    {
        // Remove comments and any whitespace between tags
        $content = preg_replace('/<!--.*?-->/', '', $content);
        $content = preg_replace('/\s+/', ' ', $content);
        $content = preg_replace('/>\s</', '><', $content);
        return trim($content);
    }

    /**
     * Minify Javascript
     *
     * @param $content string
     * @return string
     * @throws Exception
     */
    public static function js(string $content): string
    {
        return Minifier::minify($content);
    }

    /**
     * Minify a file based on its type.
     *
     * @param string $filePath Path to the file.
     * @param string $type The type of minification ('css', 'js', 'html').
     * @throws Exception If the file does not exist, cannot be read, or the type is not supported.
     */
    public static function file(string $filePath, string $type): void
    {
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist: {$filePath}");
        }

        $content = file_get_contents($filePath);
        if ($content === false) {
            throw new Exception("Failed to read from file: {$filePath}");
        }

        $content = match ($type) {
            'css' => self::css($content),
            'js' => self::js($content),
            'html' => self::html($content),
            default => throw new Exception("Unsupported type: {$type}"),
        };

        if (file_put_contents($filePath, $content) === false) {
            throw new Exception("Failed to write to file: {$filePath}");
        }
    }
}