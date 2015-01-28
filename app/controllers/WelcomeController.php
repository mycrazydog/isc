<?php

class WelcomeController extends BaseController
{

    /**
     * Returns all the welcome page.
     *
     * @return View
     */
    public function getIndex()
    {
      return View::make('backend/posts/welcome');
    }

}
