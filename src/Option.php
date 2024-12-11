<?php

declare(strict_types=1);

namespace Serhii\Ago;

enum Option
{
    /**
     * Display "Online" if date interval within 60 seconds.
     * After 60 seconds output will be the same as usually
     * "x time ago" format. Incompatible with option JUST_NOW.
     */
    case ONLINE;

    /**
     * Remove suffix from date and have the output like "5 minutes"
     * instead of "5 minutes ago".
     */
    case NO_SUFFIX;

    /**
     * Prints Just now when time is within 1 minute.
     * For example instead of 34 seconds ago it will print Just now.
     * Incompatible with option ONLINE.
     */
    case JUST_NOW;

    /**
     * This option has no effect anymore if you try to use it. It's
     * just for internal use. Behavior of this option is the same as
     * default behavior, so there is no need to use this option anymore.
     */
    case UPCOMING;

    /**
     * When you call "trans" method with this option, it will reset
     * your configurations to default values. It's especially useful
     * in testing environment when you need to reset configurations
     */
    case RESET_CONF;
}
