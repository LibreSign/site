<!-- ====== Contributing Form ====== -->
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
            
            <div class="row">
                <form>
                    <div class="col-12 tab">
                        <h4 class="me-2 card-title mb-4"><i class="lni lni-protection"></i> {{ $page->t('Safe Donate') }}</h4>
                        <nav>                    
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="text-dark-emphasis nav-link ud-feature-title ud-feature-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{$page->t('Donate one time')}}</button>
                                <button class="text-dark-emphasis nav-link ud-feature-title ud-feature-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{$page->t('Monthly')}}</button>
                                
                            </div>
                        </nav>
                        <div class="tab-content " id="nav-tabContent">
                            <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @php 
                                    $countryValues = $page->getCountry(current_path_locale($page));
                                @endphp
                                <div class="row">
                                    @if(!empty($countryValues["value"]))  
                                        @foreach($countryValues["value"] as $value)
                                        <div class="col-12 col-sm-6 col-lg-4 mb-2"  >
                                            <a class="ud-main-btn" style=" padding: 20px ;width:100" id="donateValue" onclick="getValue({{ $value }})">{{$countryValues["symbol"]." ".$value }}</a>
                                        </div>
                                        @endforeach
                                    @endif    
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
            
                                <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrev(1)">{{ $page->t('Donate one time') }}</button>
                                
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @php 
                                        $countryValues = $page->getCountry(current_path_locale($page));
                                    @endphp
                                    <div class="row">
                                        @if(!empty($countryValues["value"]))  
                                        @foreach($countryValues["value"] as $value)
                                            <div class="col-12 col-sm-6 col-lg-4 mb-2"  >
                                                <a class="ud-main-btn" style=" padding: 20px ;width:100" id="donateValue" onclick="getValue({{ $value }})">{{$countryValues["symbol"]." ".$value }}</a>
                                            </div>
                                        @endforeach
                                        @endif
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
                
                                    <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrev(1)" >{{ $page->t('Donate one time') }}</button>
            
                                </div>                    
                            </div>
        
                        </div>
                    </div>                
                    <div class="col-12 tab">
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10 pt-3">
                                <h4 class="me-2 card-title mb-5">{{ $page->t('Enter your information') }}</h4>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="first_name" placeholder="{{ $page->t('First Name')}}">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="secondy_name" placeholder="{{ $page->t('Secondy Name')}}">
                                </div>
                                <div class="mb-5">
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>
                            </div>
                            <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrev(1)">{{ $page->t('Donate one time') }}</button>
                        </div>
                    </div> 

                    <div class="col-12 tab">

                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10 pt-3">
                                <h4 class="me-2 card-title mb-5">{{ $page->t('Enter your address') }}</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="address_1" placeholder="{{ $page->t('Full Address')}}">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="city" placeholder="{{ $page->t('City')}}">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="state" placeholder="State">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="postcode" placeholder="Zip Code">
                                </div>
                                <div class="mb-5">
                                    <input type="text" class="form-control" id="country" placeholder="Country">
                                </div>
                            </div>
                            
                            <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrev(1)">{{ $page->t('Donate one time') }}</button>
                        </div>
                    </div>

                    <div class="col-12 tab">
                        <div class="row">
                            <div class="col-2">
                                <button class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10 pt-3">
                                <h4 class="me-2 card-title mb-5">{{ $page->t('You donate') }}</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 mb-5">
                                <p class="h2">{{ $page->t('R$ 130') }}</p>
                            </div>
                            <div class="col-12">
                                <a class="ud-main-btn pe-5 px-5" type="button"><i class="lni lni-paypal h3"></i> Paypal</a>
                            </div>
                        </div>
                    </div>
                </form>
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

    var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
        
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        // if (n == (x.length - 1)) {
        //     document.getElementById("nextBtn").innerHTML = "Submit";
        // } else {
        //     document.getElementById("nextBtn").innerHTML = "Next";
        // }
      
        // fixStepIndicator(n)
    }


    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");

        // if (n == 1 && !validateForm()) return false;

        x[currentTab].style.display = "none";
        currentTab = currentTab + n;

        if (currentTab >= x.length) {
            document.getElementById("regForm").submit();
            return false;
        }

        showTab(currentTab);
    }
  </script>