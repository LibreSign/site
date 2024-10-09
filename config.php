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
            'question' => 'Why LibreSign?',
            'answer' => 'LibreSign allows documents to be signed securely and with legal validity, since the system generates hashing - an algorithm that ensures that the file has not been altered after being signed - as well as numbers and records the times of each signature carried out in the document. In this way, the system meets all the requirements of the GDPR - General Data Protection Law.'
        ],
        [
            'question' => 'What are the key features of LibreCode signature pads?',
            'answer' => 'File Creation, Signature with Digital Certificate, Signature Management, Document Management, Validation, API'
        ],
        [
            'question' => 'what are the payment methods?',
            'answer' => 'Credit card'
        ],
        [
            'question' => 'Is a digital signature the same as a digitized signature?',
            'answer' => 'No. The digitized signature is the reproduction of the handwritten signature as an image using scanner-type. It does not guarantee the authorship and of the electronic document, as there is no association between the signer and the text, as it can be easily copied and inserted another document.'
        ],
        [
            'question' => 'What is the name of the company that LibreSign was developed by?',
            'answer' => 'LibreCode, a Brazilian cooperative of free software developers.'
        ],
        [
            'question' => 'Does the plan have any kind of loyalty?',
            'answer' => 'You are free to cancel your plan at any time. By canceling, Signater undertakes not to renew the billing for your plan.'
        ],
        [
            'question' => 'What happens if I cancel my plan?',
            'answer' => 'Yes, at any time. After canceling, you will no longer be charged and there will be no automatic renewal.'
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
            'question' => 'What is Libresign?',
            'answer' => 'LibreSign is a platform that makes it easy to sign documents digitally and electronically, guaranteeing security and compliance with the law. With it, you can sign documents using digital certificates, such as e-CPF(Registration of Individuals) or e-CNPJ(National Register of Legal Entities), simply and securely.'
        ],
        [
            'question' => 'What types of digital certificates does LibreSign accept?',
            'answer' => 'LibreSign accepts e-CPF(Registration of Individuals), e-CNPJ(National Register of Legal Entities), and also certificates issued by Certificate Authorities in the ICP-Brasil standard. In addition, if you prefer, you can use certificates generated by the system itself.'
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
            'answer' => 'Absolutely! LibreSign has APIs that allow you to integrate the platform with other systems you already use, helping to automate processes and make everything more agile.'
        ],
        [
            'question' => 'Can LibreSign be used by public bodies?',
            'answer' => 'Yes, LibreSign is perfect for town halls and public bodies that need a secure and legally valid solution for signing documents.'
        ],
        [
            'question' => 'How can I buy LibreSign?',
            'answer' => 'You can purchase LibreSign directly on our website or talk to our sales team, who will help you find the ideal plan for your needs.'
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
            'answer' => 'Yes, LibreSign offers time stamping, which guarantees the exact date and time of the signature, which brings even more security and legal validity.'
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
