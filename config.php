<?php

use Illuminate\Support\Str;
use Mni\FrontYAML\Parser;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

$teamMembers = [
    [
        'name' => 'Crisciany Silva',
        'gravatar' => 'f2f64ea713b5c39cb64268a0eda7e022',
        'bio' => 'I\'m a Developer. I currently study the PHP language with a focus on the Laravel framework. I have professional experience in PHP on a web-oriented system and some system maintenance such as screen creation, reports with jasper reports and mpdf and system versioning with git.',
        'job_title' => 'Software Engineer',
        'social' => [
            'github' => 'https://github.com/Any97Cris',
            'linkedin' => 'https://www.linkedin.com/in/criscianysilva/'
        ],
    ],
    [
        'name' => 'Daiane Alves',
        'gravatar' => 'fe9fbbf8677e78931af9a4a5da35e1ee',
        'bio' => 'CEO at LibreCode, one of the largest Free Software cooperatives in Brazil, she teaches training courses on various free software programs, from basic to enterprise level, and contributes to the organization of events in the PHPRio and PHPWomenBR communities (PHP developer communities).',
        'job_title' => 'CEO',
        'social' => [
            'github' => 'https://github.com/daianealvesrj/',
            'linkedin' => 'https://www.linkedin.com/in/daianealvesrj/',
        ]
    ],
    [
        'name' => 'Vitor Mattos',
        'gravatar' => '35d3d1e49e1939461e2670a4d1fac6a3',
        'bio' => 'With over 20 years of experience as CTO of LibreCode, is a Zend Certified Engineer and expert in PHP, Linux, and FLOSS solutions. Passionate about technology, is an entrepreneur in the IT field and an activist for privacy. As a strong advocate for open-source software, frequently speaks at regional and national events, demonstrating his commitment to sharing knowledge, promoting the adoption of open technologies, and emphasizing the importance of privacy.',
        'job_title' => 'CTO',
        'social' => [
            'github' => 'https://github.com/vitormattos',
            'linkedin' => 'https://www.linkedin.com/in/vitormattos/',
        ]
    ],
];

$authorGravatars = array_column($teamMembers, 'gravatar', 'name');

// Categories that are used as internal filters and should NOT get a dedicated page.
$categoryPageBlocklist = ['featured'];

return [
    'production' => false,
    'matomo_container' => '8jNjdh8C_dev_dc9cf71ee2745d3690156798',
    'baseUrl' => '/',
    'form_url' => '/suitecrm-form-middleware/validate.php',
    'url_captcha' => '/suitecrm-form-middleware/captcha.php',
    'url_captcha_audio' => '/suitecrm-form-middleware/audio_captcha.php',
    'title' => 'LibreSign - Open Source Electronic Signature for Nextcloud',
    'description' => 'LibreSign is a free and open source electronic signature app for Nextcloud. Sign, request, and manage digital documents securely in your own self-hosted environment.',
    'authorGravatars' => $authorGravatars,
    'githubDownloads' => (function() {
        $total = 0;
        $page = 1;
        $token = getenv('GITHUB_TOKEN');
        $headers = ['User-Agent: libresign-site-build'];
        if ($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        $context = stream_context_create(['http' => [
            'header' => implode("\r\n", $headers),
            'timeout' => 15,
        ]]);
        while (true) {
            $url = "https://api.github.com/repos/LibreSign/libresign/releases?per_page=100&page={$page}";
            $json = @file_get_contents($url, false, $context);
            if ($json === false) break;
            $releases = json_decode($json, true);
            if (empty($releases)) break;
            foreach ($releases as $release) {
                foreach ($release['assets'] ?? [] as $asset) {
                    $total += $asset['download_count'] ?? 0;
                }
            }
            if (count($releases) < 100) break;
            $page++;
        }
        return $total > 0 ? $total : null;
    })(),
    'locales' => function ($page) {
        return available_locales($page);
    },
    'markdownListToHtml' => function($page, $list) {
        $list = $page->t($list);
        $list = explode("\n", $list);
        $list = array_map(fn ($r) => ltrim($r, '- '), $list);
        return '<li>' . implode('</li><li>', $list) . '</li>';
    },
    'prices' => [
        'Business' => [
            'price' => 'Custom pricing',
            'description' => 'Contact us for details',
            'isActive' => true,
            'list' => <<<LIST
                - Unlimited accounts
                - Custom storage
                LIST,
        ],
    ],
    'clientLogos' => [
        ['file' => 'ocb.png', 'alt' => 'Sistema OCB/RJ', 'modifier' => 'ud-home-clients__logo--ocb'],
        ['file' => 'oab.png', 'alt' => 'OAB|ESA', 'modifier' => 'ud-home-clients__logo--oab'],
        ['file' => 'fiocruz.png', 'alt' => 'Fiocruz', 'modifier' => 'ud-home-clients__logo--fiocruz'],
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
    'frequentlyQuestions' => [
        [
            'question' => 'Is LibreSign free?',
            'answer' => 'Yes. LibreSign is free and open source software. What you pay for, if needed, is support, managed hosting, and other enterprise services provided by LibreCode.'
        ],
        [
            'question' => 'What does "user" mean for billing?',
            'answer' => 'For billing, a user is a Nextcloud account in your organization. External signers who receive a signing link do not count as users.'
        ],
        [
            'question' => 'Is there a limit to documents or signatures per month?',
            'answer' => 'No. LibreSign does not impose a monthly limit on documents or signatures.'
        ],
        [
            'question' => 'Does LibreSign work without Nextcloud?',
            'answer' => 'No. LibreSign requires Nextcloud to run. If you do not already have a compatible environment, LibreCode can provide a fully managed setup.'
        ],
        [
            'question' => 'What if we cannot install apps in our existing Nextcloud?',
            'answer' => 'In that case, the managed hosting option is the best path. LibreCode can provision and operate a complete LibreSign environment for you, including deployments in Europe or Germany when data residency matters.'
        ],
        [
            'question' => 'Can I define the order of signature for multiple recipients?',
            'answer' => 'Yes. LibreSign supports sequential signing, so you can define the order in which recipients must sign.'
        ],
        [
            'question' => 'Do recipients need an account to sign?',
            'answer' => 'No. Recipients can sign through a secure link without creating a LibreSign or Nextcloud account.'
        ],
        [
            'question' => 'Which signature standards are supported?',
            'answer' => 'LibreSign supports SES, AES, and QES workflows. For QES, a qualified digital certificate in PFX format is required.'
        ],
        [
            'question' => 'Is LibreSign eIDAS compliant?',
            'answer' => 'LibreSign supports signing workflows that can be used in eIDAS-oriented setups, but compliance depends on the full solution: the certificate, identity verification, hosting, and operational process. For qualified signatures, you need a qualified certificate and a trust service setup that matches your legal requirements.'
        ],
        [
            'question' => 'Can LibreSign be used under eIDAS and in court?',
            'answer' => 'Yes, LibreSign can be used in eIDAS-oriented deployments. The legal weight of a signature, whether simple, advanced, or qualified, depends on how the system is configured, including identity verification, certificate type, QSCD usage, and the surrounding operational process.'
        ],
        [
            'question' => 'How is identity verification handled?',
            'answer' => 'LibreSign provides flexible workflows. At the simplest level, signatures can be linked to an email address. For stronger requirements, you can add document validation, approval workflows, or integrations with external identity providers and PKI systems. Each organization can define the level of assurance it needs.'
        ],
        [
            'question' => 'In which countries is it available?',
            'answer' => 'LibreSign is not limited to a specific country. It can be used in any environment, including integrations with national PKI systems or European trust service providers (QTSP).'
        ],
        [
            'question' => 'Can the data be hosted in Europe or Germany?',
            'answer' => 'Yes. LibreSign can be deployed on managed infrastructure in Europe, including Germany, to help meet GDPR and data residency requirements.'
        ],
        [
            'question' => 'Why LibreSign?',
            'answer' => 'LibreSign lets you sign documents securely and with verifiable integrity. The platform generates a cryptographic hash for each signed document, ensuring any tampering can be detected. It also records the timestamp of every signature, creating a complete and auditable signing history. LibreSign is designed with privacy and data sovereignty in mind, following principles aligned with GDPR and LGPD.'
        ],
        [
            'question' => 'What are the key features of LibreSign?',
            'answer' => 'Document creation and upload, signature with personal or system-generated digital certificates, multi-signer workflows, document management, audit trail, document validation, and a full REST API for system integration.'
        ],
        [
            'question' => 'Is a digital signature the same as a digitized signature?',
            'answer' => 'No. The digitized signature is the reproduction of the handwritten signature as an image using a scanner or touchscreen. It does not guarantee the authorship of the electronic document, as there is no cryptographic association between the signer and the content, and it can be easily copied and inserted into another document.'
        ],
        [
            'question' => 'What is the name of the company that LibreSign was developed by?',
            'answer' => 'LibreCode, a Brazilian cooperative of free software developers.'
        ],
        [
            'question' => 'Does the plan have any kind of loyalty?',
            'answer' => 'No. You are free to cancel your plan at any time. LibreSign does not require minimum commitment periods.'
        ],
        [
            'question' => 'What happens if I cancel my plan?',
            'answer' => 'After canceling, your plan will not be renewed and you will not be charged again. You will retain access until the end of your current billing period.'
        ],
        [
            'question' => 'Can I use my personal digital certificate to sign documents?',
            'answer' => 'Yes. You can store your digital certificate in LibreSign and when you sign a document you will be asked for your password.'
        ],
        [
            'question' => 'Do I need a digital certificate to sign documents?',
            'answer' => 'No. LibreSign creates a digital certificate for each user who does not have a personal digital certificate.'
        ],
        [
            'question' => 'What is LibreSign?',
            'answer' => 'LibreSign is an open source platform for electronic and digital document signing, designed to help organizations manage secure, traceable signing workflows. It integrates with Nextcloud and can be fully self-hosted.'
        ],
        [
            'question' => 'What types of digital certificates does LibreSign accept?',
            'answer' => 'LibreSign accepts personal and company digital certificates, including certificates issued by Certificate Authorities in the ICP-Brasil standard. In addition, if you prefer, you can use certificates generated by the system itself.'
        ],
        [
            'question' => 'What is the difference between digital and electronic signatures?',
            'answer' => 'A digital signature uses a digital certificate, which provides greater security and legal validity. Electronic signatures, on the other hand, are made in other ways, such as by e-mail or cell phone, and also have legal validity, depending on the context.'
        ],
        [
            'question' => 'Is LibreSign compatible with mobile devices?',
            'answer' => 'Yes, you can use LibreSign directly from your smartphone or tablet by simply accessing the browser. This allows you to sign your documents from anywhere.'
        ],
        [
            'question' => 'Is it possible to integrate LibreSign with other systems?',
            'answer' => 'Yes. LibreSign provides a full REST API that allows you to integrate the platform with other systems, helping automate signing processes and make workflows more agile.'
        ],
        [
            'question' => 'Can LibreSign be used by public sector organizations?',
            'answer' => 'Yes. LibreSign can support public sector workflows that require traceability, document integrity, and self-hosted infrastructure, depending on the organization\'s legal and technical requirements.'
        ],
        [
            'question' => 'How can I adopt LibreSign for my organization?',
            'answer' => 'LibreSign is free and open source — you can self-host it on your own Nextcloud instance at no cost. If you prefer a managed deployment or support, our team can help you choose the right setup for your organization.'
        ],
        [
            'question' => 'Does LibreSign offer technical support?',
            'answer' => 'Yes, our support team is ready to help you with the configuration and with any questions or problems you may have.'
        ],
        [
            'question' => 'How are documents signed in LibreSign?',
            'answer' => 'It is very simple! All you have to do is upload the document to the platform, choose who is going to sign it and select the form of signature (digital or electronic). The system will record everything and ensure that the process is secure and traceable.'
        ],
        [
            'question' => 'Does LibreSign time-stamp documents?',
            'answer' => 'LibreSign records signing events and timestamps as part of the signing workflow. The legal weight of those timestamps may depend on configuration and applicable law.'
        ],
    ],
    'getFromCategory' => function($page, $category) {
        $files = array_merge(
            glob('source/_posts/*'),
            glob('source/_posts/_translated_tmp/*'),
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
                    $post['url'] = locale_url($page, 'posts/' . Str::slug($post['original_title']));
                } else {
                    $post['url'] = locale_url($page, 'posts/' . Str::slug($post['title']));
                }
                // Resolve cover_image if not in front matter (mirrors posts.map logic)
                if (empty($post['cover_image'])) {
                    $slug = Str::slug($post['original_title'] ?? $post['title'] ?? '');
                    $paths = [
                        'assets/images/posts/' . $slug,
                        'assets/images/posts/' . str_replace($current_path_locale . '_', '', $slug),
                    ];
                    $coverFound = false;
                    foreach ($paths as $p) {
                        foreach (['jpg', 'png', 'webp'] as $ext) {
                            if (file_exists(__DIR__ . '/source/' . $p . '/cover.' . $ext)) {
                                $post['cover_image'] = $page->baseUrl . $p . '/cover.' . $ext;
                                $coverFound = true;
                                break 2;
                            }
                        }
                    }
                    if (!$coverFound) {
                        $post['cover_image'] = $page->baseUrl . 'assets/images/logo/logo.svg';
                    }
                }
                $posts[] = $post;
            }
        }
        return array_map(fn($p) => (object) $p, $posts);
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
                    'from' => '/blog',
                    'to' => '/posts',
                ],
                [
                    'from' => '/solutions',
                    'to' => '/features',
                ],
                [
                    'from' => '/support',
                    'to' => '/contact-us',
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
            'map' => function ($post) use ($authorGravatars) {
                $postLang = current_path_locale($post);
                $path = 'assets/images/posts/'.$post->getFilename();
                $alternativePath = 'assets/images/posts/'. str_replace($postLang . '_', '', $post->getFilename());
                if (!empty($authorGravatars[$post->author] ?? null)) {
                    $post->set('gravatar', $authorGravatars[$post->author]);
                }
                if(empty($post->cover_image)){
                    $coverFound = false;
                    foreach ([$path, $alternativePath] as $p) {
                        foreach (['jpg', 'png', 'webp'] as $ext) {
                            if (file_exists(__DIR__.'/source/'.$p.'/cover.'.$ext)) {
                                $post->set('cover_image', $post->baseUrl.$p.'/cover.'.$ext);
                                $coverFound = true;
                                break 2;
                            }
                        }
                    }
                    if (!$coverFound) {
                        $post->set('cover_image',$post->baseUrl.'assets/images/logo/logo.svg');
                    }
                }

                if(empty($post->banner)){
                    $bannerFound = false;
                    foreach ([$path, $alternativePath] as $p) {
                        foreach (['jpg', 'png', 'webp'] as $ext) {
                            if (file_exists(__DIR__.'/source/'.$p.'/banner.'.$ext)) {
                                $post->set('banner', $post->baseUrl.$p.'/banner.'.$ext);
                                $bannerFound = true;
                                break 2;
                            }
                        }
                    }
                    if (!$bannerFound) {
                        $post->set('banner',$post->baseUrl.'assets/images/logo/logo.svg');
                    }
                }

                return $post;
            }
        ],
        'posts_wordpress' => [
            'extends' => '_layouts.post_wordpress',
            'path' => function($page) {
                foreach ($page->locales() as $localeCode => $localeName) {
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
            'items' => $teamMembers,
        ],
        'categories' => [
            'path' => function($page) {
                return 'category/' . $page->slug;
            },
            'extends' => '_layouts.category-page',
            'items' => (function() use ($categoryPageBlocklist) {
                $files = array_merge(
                    glob('source/_posts/*.md') ?: [],
                    glob('source/_posts/_tmp/*.md') ?: [],
                );
                $parser = new Parser(markdownParser: new MarkdownParser());
                $fp     = new FrontMatterParser($parser);

                $seen = [];
                foreach ($files as $file) {
                    if (!is_file($file)) {
                        continue;
                    }
                    $fm = $fp->getFrontMatter(file_get_contents($file));
                    foreach ($fm['categories'] ?? [] as $cat) {
                        $cat = trim((string) $cat);
                        $slug = Str::slug($cat);
                        if ($slug && !in_array($slug, $categoryPageBlocklist, true) && !isset($seen[$slug])) {
                            $seen[$slug] = [
                                'slug'  => $slug,
                                'label' => Str::headline(str_replace(['-', '_'], ' ', $cat)),
                            ];
                        }
                    }
                }
                return array_values($seen);
            })(),
        ],
    ],
];
