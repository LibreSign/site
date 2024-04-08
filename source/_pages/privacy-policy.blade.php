@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t("Privacy policy",current_path_locale($page))}}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="ud-blog-details-content">
              <h2 class="fs-2 fw-bold mb-5">{{ $page->t("Introdução") }}</h2>

              <p class="text-justify mb-3">
                {{$page->t("O LibreSign é o assinador de documentos livre desenvolvido pela LibreCode, cooperativa de profissionais de TI. O LibreSign foi pensado tendo por base a segurança e a privacidade de seus usuários.")}}
              </p>
              <p class="text-justify mb-3">
                {{$page->t("Estabelecemos este Aviso de Privacidade para informar como os dados pessoais coletados através do nosso formulário de contato no site do LibreSign são tratados, protegidos e utilizados.")}}
              </p>
              <p class="text-justify mb-3">
                {{ $page->t("Vale ressaltar que a forma como tratamos os dados pessoais eventualmente inseridos na solução LibreSign estão descritas no Termo de Uso do LibreSign que você pode acessar aqui: \[link\]")}}
              </p>
              <p class="text-justify mb-5">
                {{$page->t("Este Aviso é regido pelas normas da Lei Geral de Proteção de Dados (LGPD) do Brasil e do Regulamento Geral sobre a Proteção de Dados (GDPR) da União Europeia, refletindo o nosso compromisso em resguardar a privacidade e a integridade dos dados pessoais dos usuários.")}}
              </p>

              <h2 class="fs-2 fw-bold mb-5">{{ $page->t("Coleta de Dados") }}</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog Details End ====== -->
@endsection