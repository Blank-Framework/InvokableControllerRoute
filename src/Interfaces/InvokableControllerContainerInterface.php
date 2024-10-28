<?php

namespace BlankFramework\InvokableControllerRoute\Interfaces;

interface InvokableControllerContainerInterface
{
    public static function make(): InvokableControllerInterface;
}
