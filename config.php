<?php

use Illuminate\Support\Str;
use Mni\FrontYAML\Parser;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

return [
    'production' => false,
    'matomo_container' => '8jNjdh8C_dev_dc9cf71ee2745d3690156798',
    'baseUrl' => '/',
    'accountUrl' => 'http://nginx',
    'form_url' => 'http://localhost/suitecrm-form-middleware/validate.php',
    'url_captcha' => 'http://localhost/suitecrm-form-middleware/captcha.php',
    'url_captcha_audio' => 'http://localhost/suitecrm-form-middleware/audio_captcha.php',
    'title' => 'LibreSign - Electronic signature of digital documents',
    'description' => 'Electronic signature of digital documents',
    'wordPressVersion' => function($page) {
        $version = file_get_contents($page->accountUrl . '/wp-json/libresign/v1/version');
        return json_decode($version)->version;
    },
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
        ],
        [
            'comment' => "Libresign is becoming a fully-featured alternative to expensive cloud services like DocuSign. The nextcloud integration makes it a real option to use for e-signatures.",
            'author' => 'Metheos'
        ],
        [
            'comment' => "LibreSign has come a long way and it is great replacement to most commercial e-signature solutions and it is open source.",
            'author' => '0-bandage-dugouts'
        ],
        [
            'comment' => "It works perfectly with the electronic certificate issued by the Spanish Government. Installation has become very simple and affordable for anyone with minimal knowledge of Nextcloud. Developer support is fantastic. It works on all devices, including mobile devices. It has different options for creating, requesting and signing signatures. Version 9 is a great leap in quality and has a lot of future. It's incredible that this application works so well and is free.",
            'author' => 'Iván Gómez Fernández'
        ],
        [
            'comment' => "A simple and complete solution. It speeds up processes and can eliminate the use of paper. We integrated it with our public management system or e-Cidade, it was absurdly good. Congratulations.",
            'author' => 'Igor Afonso Oliveira Ruas'
        ],


    ],
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
                    $post['url'] = locale_url($page, $page->baseUrl . 'posts/' . Str::slug($post['original_title']));
                } else {
                    $post['url'] = locale_url($page, $page->baseUrl . 'posts/' . Str::slug($post['title']));
                }
                $posts[] = $post;
            }
        }
        return $posts;
    },
    'mergeCollections' => function ($page, ...$collections) {
        $merged = collect();
        foreach ($collections as $collection) {
            foreach ($collection as $post) {
                $merged->add($post);
            }
        }
        return $merged
            ->sortByDesc(fn($post) => $post->date)
            ->values();
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
            'author' => 'LibreSign',
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
        'posts_wordpress' => [
            'extends' => '_layouts.post_wordpress',
            'path' => function($page) {
                foreach ($page->locales as $localeCode => $localeName) {
                    if ($localeCode === $page->lang) {
                        return $page->lang . '/posts/' . $page->slug;
                    } elseif ($localeCode === $page->langSlug) {
                        return $page->langSlug . '/posts/' . $page->slug;
                    }
                }
                return 'posts/' . $page->slug;
            },
            'items' => function ($post) {
                if(empty($post->get('accountUrl'))){
                    return [];
                }
                $categories = json_decode(file_get_contents($post->get('accountUrl') . '/wp-json/wp/v2/categories'));
                $categories = array_filter($categories, fn ($c) => $c->slug === 'article');
                $posts = [];
                foreach ($categories as $category) {
                    $baseUrl = $post->get('accountUrl') . '/wp-json/wp/v2/posts?_embed&categories=' . $category->id . '&lang=' . $category->lang;
                    $headers = get_headers($baseUrl);
                    $totalPages = 1;
                    foreach ($headers as $header) {
                        if (stripos($header, 'X-WP-TotalPages:') !== false) {
                            $totalPages = (int) trim(substr($header, strpos($header, ':') + 1));
                            break;
                        }
                    }
                    $page = 1;
                    while ($page <= $totalPages) {
                        $url = $baseUrl . '&page=' . $page;
                        if (!$response = file_get_contents($url)) {
                            break;
                        }
                        $posts = array_merge($posts, json_decode($response, true));
                        $page++;
                    };
                }

                $wordPressLanguages = json_decode(file_get_contents($post->get('accountUrl') . '/wp-json/pll/v1/languages'));
                return collect($posts)->map(function ($fromApi) use ($wordPressLanguages, $post) {
                    $currentLang = current(array_filter($wordPressLanguages, fn ($l) => $l->slug === $fromApi['lang']));
                    $data = [
                        'title' => $fromApi['title']['rendered'],
                        'slug' => $fromApi['slug'],
                        'date' => Carbon\Carbon::parse($fromApi['date'])->timestamp,
                        'content' => $fromApi['content']['rendered'],
                        'lang' => $currentLang->w3c ?? $fromApi['lang'],
                        'langSlug' => $currentLang->slug ?? $fromApi['lang'],
                        'description' => $fromApi['acf']['description'],
                    ];
                    if (is_array($fromApi['author'])) {
                        $data['gravatar'] = $fromApi['author']['gravatar_hash'];
                        $data['author'] = is_array($fromApi['author']) ? $fromApi['author']['name'] : 'LibreSign';
                    } else {
                        $data['author'] = 'LibreSign';
                    }
                    if (isset($fromApi['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                        $data['banner'] = $fromApi['_embedded']['wp:featuredmedia'][0]['source_url'];
                    } else {
                        $data['banner'] = $post->get('baseUrl') . 'assets/images/logo/logo.svg';
                    }
                    $data['cover_image'] = $data['banner'];
                    return $data;
                });
            },
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
                [
                    'name' => 'Vitor Mattos',
                    'gravatar' => '2656fb55188f5a28ee7a99db0b9e6d8f4b91c7f6b88eead05c57386a3a05ff49' ,
                    'bio' => 'With over 20 years of experience as CTO of LibreCode, is a Zend Certified Engineer and expert in PHP, Linux, and FLOSS solutions. Passionate about technology, is an entrepreneur in the IT field and an activist for privacy. As a strong advocate for open-source software, frequently speaks at regional and national events, demonstrating his commitment to sharing knowledge, promoting the adoption of open technologies, and emphasizing the importance of privacy.',
                    'role' => 'CTO',
                    'social' => [
                        'linkedin' => 'https://www.linkedin.com/in/vitormattos/',
                    ]
                ],
                [
                    'name' => 'LibreSign',
                    'gravatar' => '/source/assets/images/logo/Avatar-LibreSign.png' ,
                    'bio' => '',
                    'role' => 'Cooperativa',
                    'social' => [
                        'linkedin' => 'https://www.linkedin.com/company/libresign/posts/?feedView=all',
                    ]
                ],
            ],
        ],
    ],
];
