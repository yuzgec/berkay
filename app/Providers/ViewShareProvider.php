<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use App\Models\Project;
use App\Models\Service;
use App\Models\Features;
use App\Models\ProjectCategory;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{

    public function boot()
    {

        $Pages = Cache::remember('pages',now()->addYear(1), function () {
            return Page::with('getCategory','media')->get();
        });

        $Service = Cache::remember('service',now()->addYear(1), function () {
            return Service::with('getCategory','media')->get();
        });

        $Blog = Cache::remember('blog',now()->addYear(1), function () {
            return Blog::with('getCategory','media')->get();
        });

        $Project = Cache::remember('project',now()->addYear(1), function () {
            return Project::with('getCategory','media')->get();
        });

        $ProjectCategory = Cache::remember('projectCategory',now()->addYear(1), function () {
            return ProjectCategory::all();
        });

        $Faq = Faq::with('getCategory')->orderBy('rank')->get();


        View::share([
            'Pages' => $Pages,
            'Service' => $Service,
            'Blog' => $Blog,
            'Faq' => $Faq,
            'Project' => $Project,
            'ProjectCategory' => $ProjectCategory,
            'Team' => Team::orderBy('rank')->get()
        ]);
    }
}
