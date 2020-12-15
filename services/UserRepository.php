<?php


namespace Services;


interface UserRepository
{
    public function whereStatus($status);
}
