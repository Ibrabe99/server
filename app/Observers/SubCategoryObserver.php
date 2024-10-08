<?php

namespace App\Observers;

use App\Models\MainCategory;

class SubCategoryObserver
{
    /**
     * Handle the MainCategory "created" event.
     */
    public function created(MainCategory $subCategory): void
    {
        $subCategory -> vendors(['active' => $subCategory -> active()]);
        $subCategory -> subCategories(['active' => $subCategory -> active()]);
        $subCategory -> meal(['active' => $subCategory -> active()]);
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
