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
            <div class = "col-6 p-5" >
                
                <div class="row align-items-center" >
                    <div class = "col-12" >
                    
                
                    <img
                    src="{{ $page->baseUrl }}assets/images/logo/logo-2.svg"
                    alt="shape"
                    class="shape shape-1"
                    width ="500"/>
                    
                
                    </div>
                    <div class = "col-12" ><h3 class="mt-5 mb-3">
                    {{ $page->t('teste')}}
                    </h3>
                    <p class="text-justify">{{ $page->t('Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                    nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                    tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                    quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos 
                    sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                    recusandae alias error harum maxime adipisci amet laborum. Perspiciatis 
                    minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit ')}}</p> 
                 </div>
                 <div class = "col-12" >
                    <div class="row"> 
                    <div class = "col-6" ><a href="{{ locale_path($page, $page->baseUrl) }}#faq">{{ $page->t('FAQ')}}</a></div>    
                    <div class = "col-6" ><a href="https://t.me/LibreCodeCoop">{{ $page->t('Outros Contatos')}}</a></div>   
                    </div>
                 </div>
                 
                </div>
                
            </div>
            <div class = "col-6 p-5 text-center" > 
            {{ $page->t('Teste2')}}
              <div class="row ">
                      <div class="col-12">
                  <nav>
                 
                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{$page->t('Donate one time')}}</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{$page->t('Monthly')}}</button>
                      
                    </div>
                  </nav>
                  <div class="tab-content " id="nav-tabContent" >
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-5 justify-content-center">
                      @foreach($page->donatevalues as $item => $value )
                      <div class="col-3">
                      <button type="button" class="btn btn-outline-success">{{$item->value}}</button>
                        
                      </div>
                      @endforeach
                      
                    </div>
                    
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-5 justify-content-center">
                      @foreach($page->donatevalues as $item -> $value)
                      <div class="col-3">
                      <button type="button" class="btn btn-outline-success">{{$item->value}}</button>
                        
                      </div>
                      @endforeach
                      
                    </div>

                    </div>                    
                  </div>

                      </div>
                      <div class="col-6" style="display:none">teste 4</div>
                
              </div>
              <div class="input-group mb-3 mt-5">
              <input type="text" class="form-control" aria-label="Text input with dropdown button">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
              <ul class="dropdown-menu dropdown-menu-end">
                @foreach($page->donatevalues as $iten)
              <li><a class="dropdown-item" href="#">{{$iten->coin}}</a></li>
              
              @endforeach
              </ul>
              </div>

            </div>
         </div>
          </div>
          
        </div>
      </div>
    </section>