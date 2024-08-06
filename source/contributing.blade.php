@extends('_layouts.main')

@section('body')

   <!-- ====== Hero Start ====== -->
   <section class="ud-hero" id="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
              <h1 class="ud-hero-title"> 
              {{ $page->t('Contributing Page')}} 
              </h1>
            </div>
        </div>
      </div>
    </section>
  

 <!-- ====== About Start ====== -->
<section id="about" class="ud-about">
  <div class="container">
    <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
      <div class ="row" >
        <div class = "col-12 col-lg-8 p-5" >
                
          <div class="row container-fluid" >

            <div class = "col-12 text-center" >
              <img src="{{ $page->baseUrl }}assets/images/logo/logo-2.svg" width ="400"/>
            </div>

            <div class = "col-12" >

              <h3 class="mt-5 mb-3">{{ $page->t('teste')}}</h3>
              <p class="mb-4">{{ $page->t('Lorem ipsum dolor sit amet consectetur adipisicing elit.Maxime mollitia,molestiae quas vel commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
              optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit ')}}
              </p> 

            </div>

            <div class = "col-12" >
              <div class="row"> 
                <div class = "col-6" ><a href="{{ locale_path($page, $page->baseUrl) }}#faq">{{ $page->t('FAQ')}}</a></div>    
                <div class = "col-6" ><a href="https://t.me/LibreCodeCoop">{{ $page->t('Outros Contatos')}}</a></div>   
              </div>
            </div>                
          </div>                
        </div>

        <div class = "col-12 col-lg-4 p-5 text-center"> 

          <h4 class="me-2 card-title mb-4"><i class="lni lni-protection"></i> {{ $page->t('Safe Donate') }}</h4>

          <div class="row ">
            <div class="col-12">
              <nav>
                
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="text-dark-emphasis nav-link ud-feature-title ud-feature-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{$page->t('Donate one time')}}</button>
                  <button class="text-dark-emphasis nav-link ud-feature-title ud-feature-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{$page->t('Monthly')}}</button>
                  
                </div>
              </nav>
              <div class="tab-content " id="nav-tabContent" >
                <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    
                  <div class="row">
                    @foreach($page->donateValues as $option)
                      @foreach($option['value'] as $item => $value)
                      
                        <div class="col-12 col-sm-6 col-lg-4 mb-2"  >
                          <a class="ud-main-btn" style=" padding: 20px ;width:100" id="donateValue{{$item}}" onclick="getValue({{ $value }})">{{ $value }}</a>
                        </div>

                      @endforeach
                    @endforeach
                  </div>

                  <div class="input-group mb-5 mt-5">
                    <input type="text" class="form-control" aria-label="Text input with dropdown button" id="showValue">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ current_path_locale($page) }}</button>
                    
                    <ul class="dropdown-menu dropdown-menu-end">
                      @foreach($page->donateCoin as $iten)
                        @foreach($iten as $coin)
                          <li><a class="dropdown-item">{{$coin}}</a></li>                  
                        @endforeach
                      @endforeach
                    </ul>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <button type="button" class="ud-main-btn">{{ $page->t('Donate one time') }}</button>
                    </div>
                  </div>
                  
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                      @foreach($page->donateValues as $option)
                        @foreach($option['value'] as $item)
                        
                          <div class="col-12 col-sm-6 col-lg-4 mb-2"  >
                            <a class="ud-main-btn" style=" padding: 20px ;width:100" >{{ $item }}</a>
                          </div>
  
                        @endforeach
                      @endforeach
                    </div>
  
                    <div class="input-group mb-5 mt-5">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button">
                      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ current_path_locale($page) }}</button>
                      
                      <ul class="dropdown-menu dropdown-menu-end">
                        @foreach($page->donateCoin as $iten)
                          @foreach($iten as $coin)
                            <li><a class="dropdown-item" href="#">{{$coin}}</a></li>                  
                          @endforeach
                        @endforeach
                      </ul>
                    </div>
  
                    <div class="row">
                      <div class="col-12">
                        <button type="button" class="ud-main-btn">{{ $page->t('Donate one time') }}</button>
                      </div>
                    </div>

                  </div>                    
                </div>

              </div>
              
              <div class="col-6" style="display:none">teste 4</div>
            </div>
          </div>
        </div>
      </div>          
    </div>          
  </div>
</section>

<script>

  function getValue(showValue){
    document.getElementById("showValue").value = showValue
  }

</script>