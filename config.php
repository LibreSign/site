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
                - until 5 users
                - unlimited subscriptions
                - 1 GB
                - Technical support in configuring up to 2 documents
                - Unlimited subscription with A1 digital certificate
                - Cloud storage and electronic document management
                - Triggering email reminders
                - Online document creation and editing
                - Access control by user or sector level
                - Task control and management
                - Customization of visual identity (colors, logo and domain)
                LIST,
        ],
        'Business' => [
            'price' => 'Contact us to more informations',
            'description' => '',
            'isActive' => true,
            'list' => <<<LIST
                - Unlimited user number
                - unlimited subscriptions
                - Starting from 1 GB
                - Chat and Email
                - Unlimited subscription with A1 digital certificate
                - Cloud storage and electronic document management
                - Triggering email reminders
                - Online document creation and editing
                - Access control by user or sector level
                - Task control and management
                - Customization of visual identity (colors, logo and domain)
                LIST,
        ],
    ],
    'getFromCategory' => function($page, $category) {
        $files = glob('source/_posts/*');
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
            if (is_array($post['categories']) && in_array($category, $post['categories'])) {
                $post['url'] = locale_path($page, $page->baseUrl . 'posts/' . Str::slug(__($page, $post['title'])));
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
                    return $lang . '/posts/' . Str::slug(__($page, $page->title, $lang));
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
                        $post->set('cover_image',$post->baseUrl.'assets/images/logo/logo.png');
                    }
                }

                if(empty($post->banner)){
                    if(file_exists(__DIR__.'/source/'.$path.'/banner.jpg')){
                        $post->set('banner',$post->baseUrl.$path.'/banner.jpg');
                    } elseif(file_exists(__DIR__.'/source/'.$alternativePath.'/banner.jpg')){
                        $post->set('banner',$post->baseUrl.$alternativePath.'/banner.jpg');
                    } else {
                        $post->set('banner',$post->baseUrl.'assets/images/logo/logo.png');
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
