<?php

/**
 * @param string $path
 * @param array $variables
 * @return bool
 * @throws Exception
 */
function view(string $path, array $variables = []): bool
{
    $view = new View();
    $view->render($path, $variables);
    return true;
}

/**
 * @param int|float $a
 * @param int|float $b
 * @return int|float
 */
function getResult(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

/**
 * @param string $key
 * @return void
 */
function showError(string $key): void
{
    if (Session::exists('validation_errors')) {
        $errors = Session::get('validation_errors');
        if (array_key_exists($key, $errors)) {
            $html = '<div class="error">';
            foreach ($errors as $keyError => $error) {
                if ($keyError === $key) {
                    $html .= "- $error; <br>";
                }
            }
            $html .= "</div>";

            echo $html;

            Session::removeValidationError($key);
        }
    }
}

/**
 * @param string $key
 * @return string
 */
function old(string $key): string
{
    $result = null;
    if (Session::exists('old_values')) {
        $oldValues = Session::get('old_values');
        if (array_key_exists($key, $oldValues)) {
            foreach ($oldValues as $keyError => $value) {
                if ($keyError === $key) {
                    $result = $value;
                }
            }
        }
    }
    return $result ?? "";
}

/**
 * @param string $sting
 * @return float|int
 */
function convert(string $sting): float|int
{
    if (str_contains($sting, '.')){
        return floatval($sting);
    }
    return intval($sting);
}