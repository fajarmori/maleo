<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    public function creating(Site $site): void 
    {
        $site->slug = str()->slug($site->name.'-'.$site->owner);
    }
}
