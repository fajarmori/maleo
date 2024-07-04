<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    public function creating(Site $site): void 
    {
        $site->code = str()->upper($site->code);
    }
    public function updating(Site $site): void 
    {
        $site->code = str()->upper($site->code);
    }
}
