<?php

class AdditionController
{
    use Validator;

    /**+
     * @return bool
     * @throws Exception
     */
    public function index(): bool
    {
        $this->validate([
            'a'=> ['numeric', 'required'],
            'b'=> ['numeric', 'required']
        ]);
        $a = Request::get('a');
        $b = Request::get('b');
        $result = getResult(convert($a), convert($b));
        Session::set('result', $result);
        Session::remove('old_values');
        Response::redirect(Request::getReferer());
    }

}