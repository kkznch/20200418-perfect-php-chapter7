<?php

class AccountController extends Controller
{
    public function signupAction()
    {
        return $this->render([
            '_token' => $this->generateCsrftoken('account/signup'),
        ]);
    }
}
