<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    public function creating(Site $site): void 
    {
        $site->code = str()->upper($site->code);
        $site->district = str()->title($site->district);
        $site->regency = str()->title($site->regency);
        $site->province = str()->title($site->province);
    }
    public function updating(Site $site): void 
    {
        $site->code = str()->upper($site->code);
        $site->district = str()->title($site->district);
        $site->regency = str()->title($site->regency);
        $site->province = str()->title($site->province);
    }
}