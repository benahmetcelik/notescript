<?php

namespace App\Providers;

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
        $colors = \App\Models\Setting::where('setting_key','colors')->first();
        if($colors){
            $colors = json_decode($colors->setting_value);
        }else{
            $colors = json_decode(json_encode([
                'primary' => '#007bff',
                'second' => '#6c757d',
                'tertiary' => '#28a745',
            ]));

        }


        $settings = \App\Models\Setting::where('setting_key','general')->first();
        if($settings){
            $settings = json_decode($settings->setting_value);
            if(empty($settings)){
                $settings = json_decode(json_encode([
                    'site_title' => 'Site Name',
                    'site_logo' => 'Site Logo',
                    'site_favicon' => 'Site Favicon',
                    'site_description' => 'Site Description',
                    'site_keywords' => 'Site Keywords',
                    'site_footer' => 'Site Keywords',
                    'register_status' => '1',
                ]));
            }
        }else{
            $settings = json_decode(json_encode([
                'site_title' => 'Site Name',
                'site_logo' => 'Site Logo',
                'site_favicon' => 'Site Favicon',
                'site_description' => 'Site Description',
                'site_keywords' => 'Site Keywords',
                'site_footer' => 'Site Keywords',
                'register_status' => '1',
            ]));
        }


        $banners = \App\Models\Banner::where('status',1)
        ->where('start_date','<=',date('Y-m-d'))
        ->where('end_date','>=',date('Y-m-d'))
        ->get();
        foreach($banners as $banner){
            if($banner->uid == null){
                $banner->uid = uniqid();
                $banner->save();
            }
        }

        view()->share('banners', $banners);

        view()->share('settings', $settings);
        view()->share('colors', $colors);
    }
}
