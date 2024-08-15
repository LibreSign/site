<?php

use Illuminate\Support\Str;
use Mni\FrontYAML\Parser;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

return [
    'production' => false,
    'matomo_container' => '8jNjdh8C_dev_dc9cf71ee2745d3690156798',
    'baseUrl' => '/',
    'form_url' => 'http://localhost/suitecrm-form-middleware/validate.php',
    'url_captcha' => 'http://localhost/suitecrm-form-middleware/captcha.php',
    'url_captcha_audio' => 'http://localhost/suitecrm-form-middleware/audio_captcha.php',
    'title' => 'LibreSign - Electronic signature of digital documents',
    'description' => 'Electronic signature of digital documents',
    'locales' => [
        '' => 'English',
        'fr' => 'Français',
        'nb-NO' => 'Norsk bokmål',
        'pt-BR' => 'Português Brasil',
    ],
    'markdownListToHtml' => function($page, $list) {
        $list = $page->t($list);
        $list = explode("\n", $list);
        $list = array_map(fn ($r) => ltrim($r, '- '), $list);
        return '<li>' . implode('</li><li>', $list) . '</li>';
    },
    'prices' => [
        'Basic' => [
            'price' => '$ 600/mo',
            'description' => 'STARTING FROM',
            'isActive' => false,
            'list' => <<<LIST
                - Until 5 accounts
                - Storage until 1Gb
                LIST,
        ],
        'Business' => [
            'price' => 'Contact us to more informations',
            'description' => '',
            'isActive' => true,
            'list' => <<<LIST
                - Unlimited accounts
                - Storage customized
                LIST,
        ],
    ],
    'optionsServicesLibresign' => [
        [
            'service' => 'Electronic document management',
            'basic' => true,
            'business' => true,
        ],
        [
            'service' => 'Simple electronic signature (without digital certificate) unlimited',
            'basic' => true,
            'business' => true,
        ],
        [
            'service' => 'Unlimited subscription with A1 digital certificate',
            'basic' => true,
            'business' => true,
        ],
        [
            'service' => 'Sending reminder by email',
            'basic' => true,
            'business' => true,
        ],
        [
            'service' => 'Technical support',
            'basic' => false,
            'business' => true,
        ],
        [
            'service' => 'Online document creation and editing',
            'basic' => false,
            'business' => true,
        ],
        [
            'service' => 'Access management by users or departments',
            'basic' => false,
            'business' => true,
        ],
        [
            'service' => 'Task control and management',
            'basic' => false,
            'business' => true,
        ],
        [
            'service' => 'Customization of visual identity (colors, logo and domain)',
            'basic' => false,
            'business' => true,
        ],
    ],
    'testimonials' => [
        [
            'comment' => "Libresign's nextcloud integration has come a long way in the past year. If you tried it before and found it lacking, give it another chance. I can see it being a real option and alternative to other e-signature services.",
            'author' => 'Matt Nelson'
        ],
        [
            'comment' => "Congratulations to the LibreSign development team for creating such an efficient solution for electronic signatures! LibreSign has an intuitive interface and ease of use, allowing integration with various APIs. I've been following the development and see it improving with each new release. LibreSign makes managing digital signatures a simple and reliable experience. I highly recommend it!",
            'author' => 'Lua Mello'
        ],
        [
            'comment' => "Finally an excellent app for signing documents. Very good!",
            'author' => 'Daiane Alves'
        ]
    ], 
    'donateCoin'=>[
        [
            'BRL'=>"BRL - BRAZILIAN REAL",
            'USD'=>"USD - NORTH-AMERICAN DOLAR",
        ],      
    ],
    'getCountry' => function($page, $country){
        $donateOption = [   
            [            
                'value'=> [1200,120,600,350,170,55],
                'symbol' => 'R$',
                'country' => 'pt-br'
            ],
            [            
                'value'=> [200,100,60,30,20,10],
                'symbol' => '$',
                'country' => 'en'
            ],
            [            
                'value'=> [2000,1000,650,350,200,100],
                'symbol' => 'KR',
                'country' => 'nb-no'
            ],
            [            
                'value'=> [180,90,55,25,20,9],
                'symbol' => '€',
                'country' => 'fr'
            ],
        ];
        
        foreach($donateOption as $option){
            if(strtolower($country) == $option['country']){
                return $option;
            }
        }
    }
    ,
    'getFromCategory' => function($page, $category) {
        $files = array_merge(
            glob('source/_posts/*'),
            glob('source/_posts/_tmp/*'),
        );
        $parser = new Parser(
            markdownParser: new MarkdownParser()
        );
        $frontMatterParser = new FrontMatterParser($parser);

        $defaultLocale = packageDefaultLocale($page);
        $current_path_locale = current_path_locale($page);

        $posts = [];
        foreach ($files as $file) {
            if (!is_file($file)) {
                continue;
            }
            $post = $frontMatterParser->getFrontMatter(file_get_contents($file));
            if ($current_path_locale !== $defaultLocale) {
                if (!str_contains($file, $current_path_locale)) {
                    continue;
                }
            } else {
                $langs = $page->localization->keys()->all();
                foreach ($langs as $lang) {
                    if (str_contains($file, $lang)) {
                        continue 2;
                    }
                }
            }
            if (isset($post['categories']) && is_array($post['categories']) && in_array($category, $post['categories'])) {
                if (!empty($post['original_title'])) {
                    $post['url'] = locale_path($page, $page->baseUrl . 'posts/' . Str::slug($post['original_title']));
                } else {
                    $post['url'] = locale_path($page, $page->baseUrl . 'posts/' . Str::slug($post['title']));
                }
                $posts[] = $post;
            }
        }
        return $posts;
    },
    'collections' => [
        'redirect' => [
            'extends' => '_layouts.redirect301',
            'path' => function($page) {
                return $page->from;
            },
            'items' => [
                [
                    'from' => '/account',
                    'to' => '/',
                ],
                [
                    'from' => '/atendimento-lgpd',
                    'to' => '/',
                ],
                [
                    'from' => '/cadastre-se',
                    'to' => '/',
                ],
                [
                    'from' => '/categoria-produto/cloud',
                    'to' => '/',
                ],
                [
                    'from' => '/doe',
                    'to' => '/',
                ],
                [
                    'from' => '/envolva-se',
                    'to' => '/',
                ],
                [
                    'from' => '/loja',
                    'to' => '/',
                ],
                [
                    'from' => '/password-reset',
                    'to' => '/',
                ],
                [
                    'from' => '/politica-de-privacidade',
                    'to' => '/',
                ],
                [
                    'from' => '/produto/libresign-cloud',
                    'to' => '/',
                ],
                [
                    'from' => '/recursos',
                    'to' => '/',
                ],
                [
                    'from' => '/register',
                    'to' => '/',
                ],
                [
                    'from' => '/sobre',
                    'to' => '/',
                ],
                [
                    'from' => '/suporte',
                    'to' => '/',
                ],
                [
                    'from' => '/termos-e-condicoes',
                    'to' => '/',
                ],
            ],
        ],
        'posts' => [
            'path' => function($page) {
                $langs = $page->localization->keys()->all();
                $lang = array_reduce($langs, function($carry, $lang) use ($page) {
                    if (str_starts_with($page->_meta->filename, $lang . '_')) {
                        return $lang;
                    }
                    return $carry;
                }, '');
                if ($lang) {
                    return $lang . '/posts/' . Str::slug($page->title);
                }
                return 'posts/' . Str::slug($page->title);
            },
            'author' => 'LibreCode',
            'sort' => '-date',
            'map' => function ($post) {
                $postLang = current_path_locale($post);
                $path = 'assets/images/posts/'.$post->getFilename();
                $alternativePath = 'assets/images/posts/'. str_replace($postLang . '_', '', $post->getFilename());
                $items = $post->get('collections')->get('team')->get('items');
                $author = array_filter($items->all(), function($author) use ($post){
                    return $author->name === $post->author;
                });
                if(!empty($author)){
                    $author = current($author);
                    $post->set('gravatar', $author->gravatar);
                }
                if(empty($post->cover_image)){
                    if(file_exists(__DIR__.'/source/'.$path.'/cover.jpg')){
                        $post->set('cover_image',$post->baseUrl.$path.'/cover.jpg');
                    } elseif(file_exists(__DIR__.'/source/'.$alternativePath.'/cover.jpg')){
                        $post->set('cover_image',$post->baseUrl.$alternativePath.'/cover.jpg');
                    } else {
                        $post->set('cover_image',$post->baseUrl.'assets/images/logo/logo.svg');
                    }
                }

                if(empty($post->banner)){
                    if(file_exists(__DIR__.'/source/'.$path.'/banner.jpg')){
                        $post->set('banner',$post->baseUrl.$path.'/banner.jpg');
                    } elseif(file_exists(__DIR__.'/source/'.$alternativePath.'/banner.jpg')){
                        $post->set('banner',$post->baseUrl.$alternativePath.'/banner.jpg');
                    } else {
                        $post->set('banner',$post->baseUrl.'assets/images/logo/logo.svg');
                    }
                }

                return $post;
            }
        ],
        'team' => [
            'path' => function($page){
                return 'team/' . Str::slug($page->name);
            },
            'extends' => '_layouts.team-member',
            'items' => [
                [
                    'name' => 'Crisciany Silva',
                    'gravatar' => 'f2f64ea713b5c39cb64268a0eda7e022',
                    'bio' => 'I\'m a Developer. I currently study the PHP language with a focus on the Laravel framework. I have professional experience in PHP on a web-oriented system and some system maintenance such as screen creation, reports with jasper reports and mpdf and system versioning with git.',
                    'role' => 'Software Engineer',
                    'social' => [
                        'github' => 'https://github.com/Any97Cris',
                        'linkedin' => 'https://www.linkedin.com/in/criscianysilva/'
                    ],
                ],
                [
                    'name' => 'Daiane Alves',
                    'gravatar' => 'fe9fbbf8677e78931af9a4a5da35e1ee' ,
                    'bio' => '',
                    'role' => '',
                    'social' => [
                        'linkedin' => 'https://www.linkedin.com/in/daianealvesrj/',
                    ]
                ],
            ],
        ],
    ],
];
