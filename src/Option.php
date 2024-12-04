<?php

declare(strict_types=1);

namespace Serhii\Ago;

enum Option
{
    /**
     * Display "Online" if date interval within 60 seconds.
     * After 60 seconds output will be the same as usually "x time ago" format.
     * Incompatible with option JUST_NOW.
     */
    case ONLINE;

    /**
     * Remove suffix from date and have "5 minutes" instead of "5 minutes ago".
     */
    case NO_SUFFIX;

    /**
     * Prints Just now when time is within 1 minute.
     * For example instead of 34 seconds ago it will print Just now.
     * Incompatible with option ONLINE.
     */
    case JUST_NOW;
}
