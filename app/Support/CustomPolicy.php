<?php

namespace App\Support;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class CustomPolicy extends Basic
{
    public function configure()
    {
        $this->addDirective(Directive::BASE, 'none')
            ->addDirective(Directive::FORM_ACTION, 'self')
            ->addDirective(Directive::FRAME_ANCESTORS, 'self')
            ->addDirective(Directive::REPORT, 'none')
            ->addDirective(Directive::SANDBOX, ['allow-forms', 'allow-modals', 'allow-orientation-lock', 'allow-popups', 'allow-scripts', 'allow-same-origin'])
            ->addDirective(Directive::CONNECT, "'self'")
            ->addDirective(Directive::SCRIPT, "'self' 'unsafe-inline' https://www.googletagmanager.com")
            // ->addDirective(Directive::SCRIPT_ATTR, "'self' https://www.googletagmanager.com 'unsafe-inline'")
            // ->addDirective(Directive::SCRIPT_ELEM, "'self' 'unsafe-inline' https://www.googletagmanager.com https://googleads.g.doubleclick.net")
            ->addDirective(Directive::STYLE, "'self' 'unsafe-inline'")
            ->addDirective(Directive::STYLE, 'https://fonts.googleapis.com')
            ->addDirective(Directive::STYLE, 'https://fonts.bunny.net')
            ->addDirective(Directive::FONT, "'self'")
            ->addDirective(Directive::FONT, 'https://fonts.bunny.net')
            ->addDirective(Directive::FONT, 'https://fonts.gstatic.com')
            // ->addDirective(Directive::FRAME, "*")
            ->addDirective(Directive::IMG, 'self')
            ->addDirective(Directive::OBJECT, "self")
            ->addDirective(Directive::DEFAULT, "self");
            // ->addNonceForDirective(Directive::SCRIPT);
        // ->addNonceForDirective(Directive::STYLE);
    }
}
