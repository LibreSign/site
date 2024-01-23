<?php

use Illuminate\Support\Str;
use Mni\FrontYAML\Parser;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

return [
    'production' => false,
    'matomo_container' => '8jNjdh8C_dev_dc9cf71ee2745d3690156798',
    'baseUrl' => '/',
    'title' => 'LibreSign - Electronic signature of digital documents',
    'description' => 'Electronic signature of digital documents',
    'getFromCategory' => function($page, $category) {
        $files = glob('source/_posts/*');
        $parser = new Parser(
            markdownParser: new MarkdownParser()
        );
        $frontMatterParser = new FrontMatterParser($parser);
        $posts = [];
        foreach ($files as $file) {
            $post = $frontMatterParser->getFrontMatter(file_get_contents($file));
            if (is_array($post['categories']) && in_array($category, $post['categories'])) {
                $post['url'] = $page->baseUrl . 'posts/' . Str::slug($post['title']);
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
            'path' => 'posts/{-title}',
            'author' => 'LibreCode',
            'sort' => '-date',
            'map' => function ($post) {
                $path = 'assets/images/posts/'.$post->getFilename();
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
                    }else{
                        $post->set('cover_image',$post->baseUrl.'assets/images/logo/logo.png');
                    }
                }

                if(empty($post->banner)){
                    if(file_exists(__DIR__.'/source/'.$path.'/banner.jpg')){
                        $post->set('banner',$post->baseUrl.$path.'/banner.jpg');
                    }else{
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
        'categories' => [
            'path' => '/categories',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return $post->categories ? in_array($page->getFilename(), $post->categories, true) : false;
                });
            },
        ],
    ],
];
