<?php


class View
{
    /**
     * @param string $path
     * @param array $variables
     * @return bool
     * @throws Exception
     */
    public function render(string $path, array $variables): bool
    {
        $filePath = VIEWS_DIR . $path;
        if (!file_exists($filePath)) {
            throw new Exception('File not found');
        }
        if ($variables) {
            extract($variables);
        }
        ob_start();
        require_once $filePath;
        echo ob_get_clean();
        return true;
    }
}