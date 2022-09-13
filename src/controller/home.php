<?php
class HomeController
{
    public function __construct(HomeModel $model)
    {
        $this->model = $model;
    }
}
