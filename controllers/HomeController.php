<?php

class HomeController
{

    /**
     * @return bool
     * @throws Exception
     */
    public function index(): bool
    {
        return view('home.php');

    }

}