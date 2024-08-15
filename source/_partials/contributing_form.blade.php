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
                                    <div class="col-12">
                                        <div class="input-group mt-5">
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
                                    </div>
                                    <div class="col-12">
                                        <p id="msgError" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                    </div>

                                    <button type="button" class="ud-main-btn mt-5" id="nextBtn" onclick="nextPrev(1)">{{ $page->t('Donate one time') }}</button>
                                </div>



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
                                                <a class="ud-main-btn" style=" padding: 20px ;width:100" id="donateValue2" onclick="getValue({{ $value }})">{{$countryValues["symbol"]." ".$value }}</a>
                                            </div>
                                        @endforeach
                                        @endif

                                        <div class="col-12">
                                            <div class="input-group mt-5">
                                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="showValue2">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ current_path_locale($page) }}</button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                @foreach($page->donateCoin as $iten)
                                                    @foreach($iten as $coin)
                                                        <li><a class="dropdown-item">{{$coin}}</a></li>
                                                    @endforeach
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <p id="msgError2" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                        </div>

                                        <button type="button" class="ud-main-btn mt-5" id="nextBtn" onclick="nextPrev(1)" >{{ $page->t('Donate one time') }}</button>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 tab">
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10">
                                <h4 class="me-2 card-title mb-5">{{ $page->t('Enter your information') }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="first_name" placeholder="{{ $page->t('First Name')}}">
                                    <p id="msgErrorFirstName" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="secondy_name" placeholder="{{ $page->t('Secondy Name')}}">
                                    <p id="msgErrorSecondyName" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-5">
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                    <p id="msgErrorEmailName" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                            </div>
                            <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrevUserField(1)">{{ $page->t('Donate one time') }}</button>
                        </div>
                    </div>

                    <div class="col-12 tab">

                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10">
                                <h4 class="card-title mb-5 pe-3 px-3">{{ $page->t('Enter your address') }}</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="address_1" placeholder="{{ $page->t('Full Address')}}">
                                    <p id="msgErrorAddress_1" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="city" placeholder="{{ $page->t('City')}}">
                                    <p id="msgErrorCity" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="state" placeholder="State">
                                    <p id="msgErrorState" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="postcode" placeholder="Zip Code">
                                    <p id="msgErrorPostcode" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                                <div class="mb-5">
                                    <input type="text" class="form-control" id="country" placeholder="Country">
                                    <p id="msgErrorCountry" style="color: rgb(255, 74, 74);font-size:12px;"></p>
                                </div>
                            </div>

                            <button type="button" class="ud-main-btn" id="nextBtn" onclick="nextPrevAddressField(1)">{{ $page->t('Donate one time') }}</button>
                        </div>
                    </div>

                    <div class="col-12 tab">
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="ud-main-btn" id="prevBtn" onclick="nextPrev(-1)"><i class="lni lni-arrow-left"></i></button>
                            </div>
                            <div class="col-10 pt-3">
                                <h4 class="me-2 card-title mb-5">{{ $page->t('You donate') }}</h4>
                            </div>
                        </div>


                        <div class="row mt-5">
                            <div class="col-12">
                                <span><i class="lni lni-coin h2"></i></span>
                                <p class="h2" id="finaValue"></p>
                            </div>
                            <div class="col-12 mt-5">
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
      document.getElementById("showValue2").value = showValue
      var teste = document.getElementById("finaValue").value = showValue

      document.getElementById("finaValue").innerHTML = teste
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
    }


    function validateForm(){
        var fields = ["name, phone", "compname", "mail", "compphone", "adres", "zip"]

        var i, l = fields.length;
        var fieldname;
        for (i = 0; i < l; i++) {
            fieldname = fields[i];
            if (document.forms["register"][fieldname].value === "") {
            alert(fieldname + " can not be empty");
            return false;
            }
        }
        return true;
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        var fieldValueDonate = document.getElementById('showValue')
        var fieldValueDonateMonthly = document.getElementById('showValue2')

        if (!fieldValueDonate || fieldValueDonate.value < 10) {
            text = "The minimum donation amount is 10";
            document.getElementById("msgError").innerHTML = text;
            return
        }else if(isNaN(fieldValueDonate.value)){
            text = "The value is not valid";
            document.getElementById("msgError").innerHTML = text;
            return
        }if (!fieldValueDonateMonthly || fieldValueDonateMonthly.value < 10) {
            text = "The minimum donation amount is 10";
            document.getElementById("msgError2").innerHTML = text;
            return
        }else if(isNaN(fieldValueDonateMonthly.value)){
            text = "The value is not valid";
            document.getElementById("msgError2").innerHTML = text;
            return
        }else{
            text = ""
            document.getElementById("msgError").innerHTML = text;
            document.getElementById("msgError2").innerHTML = text;
        }

        x[currentTab].style.display = "none";
        currentTab = currentTab + n;

        showTab(currentTab);
    }

    function nextPrevUserField(n) {
        var x = document.getElementsByClassName("tab");
        var firstName = document.getElementById('first_name')
        var secondyName = document.getElementById('secondy_name')
        var emailName = document.getElementById('email')


        if (!firstName.value || !isNaN(firstName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorFirstName").innerHTML = text;
            return
        }else if(firstName.value.length < 5){
            text = "Name must be longer than 5 characters";
            document.getElementById("msgErrorFirstName").innerHTML = text;
            return
        }else if (!secondyName.value || !isNaN(secondyName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorSecondyName").innerHTML = text;
            return
        }else if(secondyName.value.length < 5){
            text = "Secondary name must be longer than 5 characters";
            document.getElementById("msgErrorSecondyName").innerHTML = text;
            return
        }else if(emailName === '') {
            text = "The value is not valid";
            document.getElementById("msgErrorEmailName").innerHTML = text;
            return
        }else if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailName.value)){
            text = "Please enter a valid email address";
            document.getElementById("msgErrorEmailName").innerHTML = text;
            return
        }else{
            text = ""
            document.getElementById("msgErrorFirstName").innerHTML = text;
            document.getElementById("msgErrorSecondyName").innerHTML = text;
            document.getElementById("msgErrorEmailName").innerHTML = text;
        }

        x[currentTab].style.display = "none";
        currentTab = currentTab + n;

        showTab(currentTab);
    }

    function nextPrevAddressField(n){
        var x = document.getElementsByClassName("tab");
        var addressName = document.getElementById('address_1')
        var cityName = document.getElementById('city')
        var stateName = document.getElementById('state')
        var postcodeName = document.getElementById('postcode')
        var countryName = document.getElementById('country')

        if (!addressName.value || !isNaN(addressName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorAddress_1").innerHTML = text;
            return
        }else if(addressName.value.length < 5){
            text = "Address name must be longer than 5 characters";
            document.getElementById("msgErrorAddress_1").innerHTML = text;
            return
        }else if (!cityName.value || !isNaN(cityName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorCity").innerHTML = text;
            return
        }else if(cityName.value.length < 5){
            text = "City name must be longer than 5 characters";
            document.getElementById("msgErrorCity").innerHTML = text;
            return
        }else if (!stateName.value || !isNaN(stateName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorState").innerHTML = text;
            return
        }else if(stateName.value.length < 5){
            text = "State name must be longer than 5 characters";
            document.getElementById("msgErrorState").innerHTML = text;
            return
        }else if (!postcodeName.value || isNaN(postcodeName.value)) {
            text = "Please, enter only numbers";
            document.getElementById("msgErrorPostcode").innerHTML = text;
            return
        }else if(postcodeName.value.length < 8){
            text = "Postcode name must be longer than 8 characters";
            document.getElementById("msgErrorPostcode").innerHTML = text;
            return
        }else if (!countryName.value || !isNaN(countryName.value)) {
            text = "The value is not valid";
            document.getElementById("msgErrorCountry").innerHTML = text;
            return
        }else if(countryName.value.length < 5){
            text = "State name must be longer than 5 characters";
            document.getElementById("msgErrorCountry").innerHTML = text;
            return
        }else{
            text = ""
            document.getElementById("msgErrorAddress_1").innerHTML = text;
            document.getElementById("msgErrorCity").innerHTML = text;
            document.getElementById("msgErrorState").innerHTML = text;
            document.getElementById("msgErrorPostcode").innerHTML = text;
            document.getElementById("msgErrorCountry").innerHTML = text;
        }

        x[currentTab].style.display = "none";
        currentTab = currentTab + n;

        showTab(currentTab);
    }
  </script>