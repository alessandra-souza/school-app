<?php

namespace Lib;

final class Page
{
    public static function navItems()
    {
        $navItems = array(
            array(
                'url' => '/student',
                'text' => 'Students'
            ),
            array(
                'url' => '/course',
                'text' => 'Courses'
            ),
            array(
                'url' => '/course-registration',
                'text' => 'Register Course'
            ),
            array(
                'url' => '/courses-per-student',
                'text' => 'Show courses by student'
            )
        );
        
        return $navItems;
    }
}