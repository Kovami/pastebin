<?php

namespace App\Enums;

enum VisibilityEnum: string
{
    case Public = 'public';
    case Unlisted = 'unlisted';
    case Private = 'private';
}
