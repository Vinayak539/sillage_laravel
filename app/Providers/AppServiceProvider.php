<?php

namespace App\Providers;

use App\Model\TxnCategory;
use App\Model\TxnKeyword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        $txnCategory = TxnCategory::where('status', true)->orderBy('parent_id')->get();
        $category = array(
            'categories' => array(),
            'parent_cats' => array(),
        );

        foreach ($txnCategory as $key => $value) {
            $category['categories'][$value->id] = $value;
            //creates entry into parent_cats array. parent_cats array contains a list of all categories with children
            $category['parent_cats'][$value->parent_id][] = $value->id;
        }

        // footer only parent start
        $footerDynamicCategory = TxnCategory::where('status', true)->where('parent_id', 0)->orderBy('parent_id')->get();
        // footer only parent end

        $dynamicCategory = $this->buildCategory(0, $category, 0);
        $smallDeviceDynamicCategory = $this->smallDeviceBuildCategory(0, $category, 0);
        $keywords = TxnKeyword::all();
        // $topsections     = TopMasterSection::limit(5)->get();
        view()->share(['keywords' => $keywords, 'dynamicCategory' => $dynamicCategory, 'smallDeviceDynamicCategory' => $smallDeviceDynamicCategory, 'footerDynamicCategory' => $footerDynamicCategory]);
    }
    public function buildCategory($parent, $category, $count)
    {

        $count = $count + 1;
        $html = "";
        if ($count > 3) {
            return $html;
        }
        if (isset($category['parent_cats'][$parent])) {
            if ($count == 2) {
                if (count($category['parent_cats'][$parent]) > 1) {
                    $html .= "<ul class='megamenu two-column'>";
                    foreach ($category['parent_cats'][$parent] as $cat_id) {
                        if (!isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li><a class='megamenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                        }
                        if (isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li><a class='megamenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a>";
                            $html .= $this->buildCategory($cat_id, $category, $count);
                            $html .= "</li>";
                        }
                    }
                } else {
                    $html .= "<ul class='sub-menu'>";
                    foreach ($category['parent_cats'][$parent] as $cat_id) {
                        if (!isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li><a class='submenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                        }
                        if (isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li><a class='submenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a>";
                            $html .= $this->buildCategory($cat_id, $category, $count);
                            $html .= "</li>";
                        }
                    }
                }
            } else if ($count == 1) {
                if (count($category['parent_cats'][$parent]) > 1) {
                    $html .= "<ul class='mainmenu mainmenu--centered'>";
                    foreach ($category['parent_cats'][$parent] as $cat_id) {
                        if (!isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li class='mainmenu__item menu-item-has-children has-children'><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "' class='mainmenu__link'><span class='mm-text '>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                        }
                        if (isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li class='mainmenu__item menu-item-has-children has-children'><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "' class='mainmenu__link'><span class='mm-text '>" . $category['categories'][$cat_id]['name'] . "</span></a></i>";
                            $html .= $this->buildCategory($cat_id, $category, $count);
                            $html .= "</li>";
                        }

                    }
                } else {
                    $html .= "<ul class='mainmenu mainmenu--3'>";
                    foreach ($category['parent_cats'][$parent] as $cat_id) {
                        if (!isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li class='mainmenu__item menu-item-has-children'><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "' class='mainmenu__link'><span class='mm-text '>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                        }
                        if (isset($category['parent_cats'][$cat_id])) {
                            $html .= "<li class='mainmenu__item menu-item-has-children'><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "' class='mainmenu__link'><span class='mm-text '>" . $category['categories'][$cat_id]['name'] . "</span></a></i>";
                            $html .= $this->buildCategory($cat_id, $category, $count);
                            $html .= "</li>";
                        }

                    }
                }
            } else {
                $html .= "<ul>";
                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a>";
                        $html .= $this->buildCategory($cat_id, $category, $count);
                        $html .= "</li>";
                    }
                }
            }

            $html .= "</ul>";
        }
        return $html;
    }
    public function smallDeviceBuildCategory($parent, $category, $count)
    {

        $count = $count + 1;
        $html = "";
        if ($count > 3) {
            return $html;
        }
        if (isset($category['parent_cats'][$parent])) {
            if ($count >= 2) {

                $html .= "<ul class='dl-submenu'>";
                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a class='megamenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a class='megamenu-title' href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a>";
                        $html .= $this->smallDeviceBuildCategory($cat_id, $category, $count);
                        $html .= "</li>";
                    }
                }

            } else if ($count == 1) {

                $html .= "<ul class='dl-menu'>";
                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'>" . $category['categories'][$cat_id]['name'] . "</a></li>";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'>" . $category['categories'][$cat_id]['name'] . "</a></i>";
                        $html .= $this->smallDeviceBuildCategory($cat_id, $category, $count);
                        $html .= "</li>";
                    }

                }

            } else {
                $html .= "<ul class='dl-submenu'>";
                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a></li>";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li><a href='/category/" . $category['categories'][$cat_id]['slug_url'] . "'><span class='mm-text'>" . $category['categories'][$cat_id]['name'] . "</span></a>";
                        $html .= $this->smallDeviceBuildCategory($cat_id, $category, $count);
                        $html .= "</li>";
                    }
                }
            }

            $html .= "</ul>";
        }
        return $html;
    }
}
