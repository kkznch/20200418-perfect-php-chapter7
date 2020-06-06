<?php

class MiniBlogApplication extends Application
{
    protected $login_action = ['account', 'signin'];

    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    protected function registerRoutes()
    {
        return [

        ];
    }

    protected function configure()
    {
        $this->db_manager->connect('master', [
            'dsn' => 'mysql:host=db;dbname=laravel',
            'user' => 'root',
            'password' => 'password'
        ]);
    }
}
