<?php

trait Validator
{
    /**
     * @var array
     */
    public array $errors = [];

    /**
     * @var array
     */
    public array $oldValues = [];

    /**
     * @param string $fieldName
     * @return bool
     */
    private function required(string $fieldName): bool
    {
        $value = Request::get($fieldName);
        if (!$value) {
            return false;
        }

        return true;
    }

    /**
     * @param string $fieldName
     * @return bool
     */
    public function numeric(string $fieldName): bool
    {
        $value = Request::get($fieldName);
        if (is_numeric($value)) {
            return true;
        }
        return false;
    }

    /**
     * @param array $rules
     * @return void
     * @throws Exception
     */
    public function validate(array $rules): void
    {
        if (!$rules) {
            return;
        }

        foreach ($rules as $fieldName => $ruleArray) {
            $this->setOldValues($fieldName);
            foreach ($ruleArray as $rule) {
                if ($rule === 'required') {
                    if (!$this->required($fieldName)) {
                        $this->errors[$fieldName] = $this->getErrorMessage('required');
                    }
                }

                if ($rule === 'numeric') {
                    if (!$this->numeric($fieldName)) {
                        $this->errors[$fieldName] = $this->getErrorMessage('numeric');
                    }
                }
            }
        }

        $this->checkErrors();
    }


    /**
     * @return void
     */
    private function checkErrors(): void
    {
        if ($this->errors) {
            Session::set('validation_errors', $this->errors);
            Session::set('old_values', $this->oldValues);
            Response::redirect(Request::getReferer());
        }
    }

    /**
     * @param $fieldName
     * @return void
     */
    private function setOldValues($fieldName): void
    {
        $this->oldValues[$fieldName] = Request::get($fieldName);
    }


    /**
     * @return string[]
     */
    private function errorsMessages(): array
    {
        return [
            'required' => "This field is required",
            'numeric' => "This field should be numeric",
        ];
    }

    /**
     * @param string $key
     * @return string
     * @throws Exception
     */
    private function getErrorMessage(string $key): string
    {
        $messages = $this->errorsMessages();
        if (!isset($messages[$key])) {
            throw new Exception('Invalid error message');
        }
        return $messages[$key];
    }
}