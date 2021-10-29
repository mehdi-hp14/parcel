<?php return array (
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
    ),
  ),
  'biscolab/laravel-recaptcha' => 
  array (
    'providers' => 
    array (
      0 => 'Biscolab\\ReCaptcha\\ReCaptchaServiceProvider',
    ),
    'aliases' => 
    array (
      'ReCaptcha' => 'Biscolab\\ReCaptcha\\Facades\\ReCaptcha',
    ),
  ),
  'facade/ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Facade\\Ignition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Facade\\Ignition\\Facades\\Flare',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'jimmyjs/laravel-report-generator' => 
  array (
    'providers' => 
    array (
      0 => 'Jimmyjs\\ReportGenerator\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'PdfReport' => 'Jimmyjs\\ReportGenerator\\Facades\\PdfReportFacade',
      'ExcelReport' => 'Jimmyjs\\ReportGenerator\\Facades\\ExcelReportFacade',
      'CSVReport' => 'Jimmyjs\\ReportGenerator\\Facades\\CSVReportFacade::class',
    ),
  ),
  'kalnoy/nestedset' => 
  array (
    'providers' => 
    array (
      0 => 'Kalnoy\\Nestedset\\NestedSetServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'laravel/ui' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Ui\\UiServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
);