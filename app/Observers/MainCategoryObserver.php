<?php

namespace App\Observers;

use App\Models\MainCategory;

class MainCategoryObserver
{
    /**
     * Handle the MainCategory "created" event.
     */
    public function created(MainCategory $mainCategory): void
    {
        $mainCategory -> vendors(['active' => $mainCategory -> active()]);
        $mainCategory -> subCategories(['active' => $mainCategory -> active()]);
        $mainCategory -> add_meal(['active' => $mainCategory -> active()]);


    }

    /**
     * Handle the MainCategory "updated" event.
     */
    public function updated(MainCategory $mainCategory): void
    {
        //
    }

    /**
     * Handle the MainCategory "deleted" event.
     */
    public function deleted(MainCategory $mainCategory): void
    {
        //
    }

    /**
     * Handle the MainCategory "restored" event.
     */
    public function restored(MainCategory $mainCategory): void
    {
        //
    }

    /**
     * Handle the MainCategory "force deleted" event.
     */
    public function forceDeleted(MainCategory $mainCategory): void
    {
        //
    }
}
