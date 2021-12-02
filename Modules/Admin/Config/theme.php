<?php

/*******************************************************************************
    config file that contains the views for the used frontend theme
*******************************************************************************/

return [
  'article_views' => [
                'article',
                'download',
                'welcome_box'

  ],
  'page_views' => [
                'default',
                'solution',
                'welcome',
                'download'
  ],
  'dimensions' => [
                      'thumb' => [
                        'width' => 200,
                        'height' => 200,
                        'operation' => 'fill',
                        'name' => '_thumb',
                      ],
                      'hot' => [
                        'width' => 130,
                        'height' => 80,
                        'operation' => 'crop',
                        'name' => '_hot',
                      ],
                      'tiny' => [
                        'width' => 320,
                        'height' => 200,
                        'operation' => 'resize',
                        'name' => '_tiny',
                      ],
                      'small' => [
                        'width' => 480,
                        'height' => 300,
                        'operation' => 'resize',
                        'name' => '_small',
                      ],
                      'medium' => [
                        'width' => 600,
                        'height' => 400,
                        'operation' => 'resize',
                        'name' => '_medium',
                      ],
                      'regular' => [
                        'width' => 768,
                        'height' => 500,
                        'operation' => 'resize',
                        'name' => '_regular',
                      ],
                      'large' => [
                        'width' => 1024,
                        'height' => 550,
                        'operation' => 'resize',
                        'name' => '_large',
                      ],
                      'huge' => [
                        'width' => 1200,
                        'height' => 600,
                        'operation' => 'resize',
                        'name' => '_huge',
                      ],
                  ]
];
