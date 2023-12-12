<?php

namespace Sparkinzy\DcatMarketPlace;

use Dcat\Admin\Admin;
use Illuminate\Support\Str;
use Dcat\Admin\Enums\ExtensionType;
use Dcat\Admin\Extend\ServiceProvider;

class DcatMarketplaceServiceProvider extends ServiceProvider
{

    public function getExtensionType(): ExtensionType
    {
        return ExtensionType::ADDON;
    }

    protected $js = [
    ];
    protected $css = [
    ];

    public function register()
    {
        //

    }

    private function initMarketPlace()
    {
        $current_url = request()->getUri();
        if (Str::endsWith($current_url, '/auth/extensions')){
            $setting = admin_setting_array('sparkinzy:dcat-marketplace');
            $path = $setting['path'] ?? 'dcat-marketplace';
            $marketplaceUrl = admin_url($path);
            Admin::script(<<<JS
$('.icon-shopping-cart').parent().off('click').on('click',function(){
    window.open('{$marketplaceUrl}');
});
JS
            );

        }
    }

    public function init()
    {
        parent::init();
        $this->initMarketPlace();

        //
    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
