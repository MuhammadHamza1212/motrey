<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	  <div class="modal-header" style="direction:ltr;">
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		<div class="login-panel">
			<div class="text-center mb-5">
				<img src="resources/images/logo-light.jpeg" alt="Motarey logo" width="130" height="auto">
				<div class="heading my-4"><?php echo $labels[$currentLanguageIsoCode]['Log_in_to_your_account']; ?></div>
			</div>
			<div class="row mb-3">
				<div class="col-12 px-0 px-sm-3">
					<div id="g_id_onload"
                         data-client_id="800334276476-hba9hh0oqbq077gk6hctft3cm1ppj7u9.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-callback="gmailsignin" data-auto_prompt="false">
                    </div>
                    <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"
                         style="position: absolute;left: 100px;top: 178px;opacity: 0;">
                    </div>
					<a class="btn btn-outline-secondary btn-social <?php echo ($currentLanguageDirection === "rtl" ? "" : "text-start"); ?> p-2 ps-sm-4"> <img src="resources/images/google-icon.png"><?php echo $labels[$currentLanguageIsoCode]['Continue_with_Google']; ?></a>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-12 px-0 px-sm-3">
					<a class="btn btn-outline-secondary btn-social <?php echo ($currentLanguageDirection === "rtl" ? "" : "text-start"); ?> p-2 px-1 px-sm-2 ps-sm-4" onclick="fbLogin();"> <img src="resources/images/facebook-icon.png"><?php echo $labels[$currentLanguageIsoCode]['Continue_with_Facebook']; ?></a>
				</div>
			</div>
			<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0&appId=2175062012883316&autoLogAppEvents=1" nonce="RE7DMWYh"></script>
			<div id="fb-root">
				<div class="fb-login-button" data-width="300" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div>
			</div>-->
			<div class="row mb-5">
				<div class="col-12 px-0 px-sm-3">
					<a class="btn btn-outline-secondary btn-social <?php echo ($currentLanguageDirection === "rtl" ? "text-end pe-5" : "text-start"); ?> p-2 ps-sm-4" style="position:relative;" data-bs-toggle="modal" data-bs-target="#loginByEmailModal">
						<i class="fa fa-envelope" style="color:red; font-size:29px;" aria-hidden="true"></i>
						<span style="position:absolute;"> <?php echo $labels[$currentLanguageIsoCode]['Continue_with_Email']; ?></span>
					</a>
				</div>
			</div>
			<div class="row my-4">
				<a type="button" onclick="openRegisterModal();" class="text-center text-danger text-decoration-none" data-bs-dismiss="modal"><?php echo $labels[$currentLanguageIsoCode]['Donot_have_an_account_Create_one']; ?></a>
			</div>
			<div class="row my-2">
				<p class="text-center" style="color:#999; font-size:13px;"><?php echo $labels[$currentLanguageIsoCode]['Agree_to_TC_and_PP_By_SignUP']; ?></p>
			</div>
		</div>
	  </div>
	</div>
  </div>
</div>

<div class="modal fade" id="loginByEmailModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="direction:ltr;">
        <button class="btn btn-back" data-bs-target="#loginModal" data-bs-toggle="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <div class="login-panel">
			<div class="text-center mb-5">
				<div class="heading my-4"><?php echo $labels[$currentLanguageIsoCode]['Log_in_with_email']; ?></div>
			</div>
			<form id="sign-in-form">
				<div class="mb-3">
				  <input type="email" id="login-email" name="email" class="form-control px-4" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Email_or_username']; ?>" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
				</div>
				<div>
					<input type="password" id="login-password" name="password" class="form-control px-4" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Password']; ?>" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
				</div>
				<div id="invalid-credentials-message" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['Invalid_Credentials']; ?></div>
				<button type="submit" class="mt-4 btn btn-danger btn-theme" style="width: 100%;"><?php echo $labels[$currentLanguageIsoCode]['Log_in']; ?></button>
				<div class="row my-4">
					<a type="button" class="text-center text-danger text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"><?php echo $labels[$currentLanguageIsoCode]['Forgot_your_Password']; ?></a>
				</div>
			</form>
			<div class="row my-2">
				<p class="text-center" style="color:#999; font-size:13px;"><?php echo $labels[$currentLanguageIsoCode]['Agree_to_TC_and_PP_By_SignUP']; ?></p>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
<script>
	document.getElementById("sign-in-form").addEventListener("submit", function(event){
	  event.preventDefault();
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "sign-in.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	  var formData = "email=" + encodeURIComponent(document.getElementById("login-email").value) +
               "&password=" + encodeURIComponent(document.getElementById("login-password").value);
	  xhr.send(formData);
	  xhr.onload = function() {
		  if (xhr.status === 200) {
			// success
			if(xhr.responseText == 'wrong') {
				document.getElementById("invalid-credentials-message").style.display = 'block';
			} else {
				location.reload(true); // Reload from server
			}
		  } else {
			// error
			console.error(xhr.responseText);
		  }
	  };
	});

	function gmailsignin(response) {
        // const token = response.credential;
        // const base64Url = token.split('.')[1];
        // const base64 = base64Url.replace('-', '+').replace('_', '/');
        // const payload = JSON.parse(window.atob(base64));
        
        var xhr = new XMLHttpRequest();
		xhr.open("POST", "sign-in-with-google.php?credentials="+response.credential, false);
		xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
				if(this.responseText == 'signup' || this.responseText == 'signin') {
					location.reload(true); // Reload from server
				} else {
					alert(this.responseText);
				}
			} else {
				console.error(this.responseText);
			}
		};
		xhr.send();
    }
	
</script>
<div class="modal fade" id="registerModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="direction:ltr;">
        <button class="btn btn-back" data-bs-target="#loginModal" data-bs-toggle="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="login-panel" style="background: #fff;">
			<div class="text-center mb-5">
				<div class="heading my-4"><?php echo $labels[$currentLanguageIsoCode]['Create_an_account']; ?></div>
			</div>
			<form id="sign-up-form">
				<div class="row my-4" style="direction:ltr;">
					<div class="col-6 form-check">
					  <input class="form-check-input ms-0 me-2" type="radio" name="sellerType" value="Private Seller" id="privateSeller" onclick="privateSignUp();" checked>
					  <label class="form-check-label" for="privateSeller"> <?php echo $labels[$currentLanguageIsoCode]['Private_Seller']; ?></label>
					</div>
					<div class="col-6 form-check">
					  <input class="form-check-input ms-0 me-2" type="radio" name="sellerType" value="Dealer Seller" id="dealerSeller" onclick="dealerSignUp();">
					  <label class="form-check-label" for="dealerSeller"> <?php echo $labels[$currentLanguageIsoCode]['Dealer_Seller']; ?></label>
					</div>
				</div>
				<div class="mb-3 text-field-with-validation">
					<input class="form-control px-4" type="text" id="username" name="username" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Username']; ?>*" required="true" style="padding-top: 0.70rem; padding-bottom: 0.75rem;" onfocusout="verifyUserNameandEmail();">
					<img id="correct-checkmark-username" class="text-field-validation-check-mark" src="resources/images/correct-check-mark.png">
					<img id="incorrect-checkmark-username" class="text-field-validation-check-mark" src="resources/images/incorrect-check-mark.png">
				</div>
				<div class="mb-3 text-field-with-validation">
					<input class="form-control px-4" type="email" name="email" id="email" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Email']; ?>*" required="true" style="padding-top: 0.70rem; padding-bottom: 0.75rem;" onfocusout="verifyUserNameandEmail();">
					<img id="correct-checkmark-email" class="text-field-validation-check-mark" src="resources/images/correct-check-mark.png">
					<img id="incorrect-checkmark-email" class="text-field-validation-check-mark" src="resources/images/incorrect-check-mark.png">
				</div>
				<div id="invalid-credentials-message-for-sign-up" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['User_Name_Email_not_available']; ?></div>
				<div class="input-group mb-3 text-field-with-validation">
					<span id="dialing-code-button" type="button" class="input-group-text dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<span id="countryFlag" class="<?php echo $currentCountry->getFlag(); ?>" style="font-size:20px;"></span> 
						<span id="dialingCode" style="height: 80%; margin-left: 5px;"> <?php echo $currentCountry->getDialing_code(); ?></span>
						
					</span>	
					<ul class="dropdown-menu" style="min-width:15px;">
						<?php
							$countries = $countryService->getAllCountries($currentLanguageIsoCode);
						  	for($i=0; $i<count($countries); $i++){
								echo '<li><a class="dropdown-item" href="#" onclick="updateDialingCode(\''. $countries[$i]->getDialing_code() .'\',\''. $countries[$i]->getFlag() .'\')"><span class="'. $countries[$i]->getFlag() .'" style="font-size:20px;"></span> '. $countries[$i]->getDialing_code() .'</a></li>';
						  	}
						?>
					</ul>
					<input id="dialingCodeField" type="text" name="dialingCode" value="<?php echo $currentCountry->getDialing_code(); ?>" style="display:none;">
					<input id="phonenumber" type="text" class="form-control px-4" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Phone']; ?>*" name="phonenumber" style="padding-top: 0.70rem; padding-bottom: 0.75rem;" required="true">
					<img id="phone-verified-badge" class="text-field-validation-check-mark" src="resources/images/verified-badge.png">
					<div id="invalid-phone-message" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['Please_Enter_Valid_Phone_number']; ?></div>
					<div id="message-not-sent" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['Service_Error_Please_try_again_later']; ?></div>
					<div id="verify-phone-message" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['Please_Verify_Phone_number']; ?></div>
				</div>
				<div class="mb-3">
					<div id="recaptcha-container"></div>
				</div>
				<div class="mb-3">
					<!-- <a class="btn btn-danger btn-theme" style="width: 100%;">Send OTP</a> -->
					<a id="sendOtpButton" onclick="checkPhoneNumber();" class="btn btn-danger btn-theme" style="width: 100%;"><?php echo $labels[$currentLanguageIsoCode]['Send_OTP']; ?></a>
				</div>
				<div class="mb-3">
					<input id="password" type="password" class="form-control px-4" name="password" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Password']; ?>*" style="padding-top: 0.70rem; padding-bottom: 0.75rem;" required="true">
				</div>
				<button type="submit" id="submit" class="btn btn-danger btn-theme" style="width: 100%;"><?php echo $labels[$currentLanguageIsoCode]['Sign_up']; ?></button>
			</form>
			<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
			<script>
				var firebaseConfig = {
					apiKey: "AIzaSyDTqOH2bhbN7jfhOveAilITdNQ2bpEJG4Y",
					authDomain: "motarey-d0fc5.firebaseapp.com",
					projectId: "motarey-d0fc5",
					storageBucket: "motarey-d0fc5.appspot.com",
					messagingSenderId: "853000727652",
					appId: "1:853000727652:web:d8469b171b5e7946c74371",
					measurementId: "G-Z82HH32DZ9"
				};
				
				firebase.initializeApp(firebaseConfig);
				
				window.onload = function() {
					window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
					recaptchaVerifier.render();
				}
				
				document.getElementById("sign-up-form").addEventListener("submit", function(event){
	  				event.preventDefault();
					if(document.getElementById("phone-verified-badge").style.display == '') {
						document.getElementById("verify-phone-message").style.display = "block";
					} else {
						var xhr = new XMLHttpRequest();
						xhr.open("POST", "sign-up.php", true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						var formData = "username=" + encodeURIComponent(document.getElementById("username").value) +
									"&email=" + encodeURIComponent(document.getElementById("email").value) +
									"&phonenumber=" + encodeURIComponent(document.getElementById("phonenumber").value) + 
									"&dialingCode=" + encodeURIComponent(document.getElementById("dialingCodeField").value) + 
									"&password=" + encodeURIComponent(document.getElementById("password").value) +
									"&sellerType=" + encodeURIComponent(document.getElementById("privateSeller").checked ? document.getElementById("privateSeller").value : document.getElementById("dealerSeller").value);
						xhr.send(formData);
						xhr.onload = function() {
							if (xhr.status === 200) {
								// success
								console.log(xhr.responseText);
								if(xhr.responseText == 'wrong') {
									document.getElementById("invalid-credentials-message-for-sign-up").style.display = 'block';
								} else if(xhr.responseText == 'right') {
									location.reload(true); // Reload from server
								} else {
									console.log(xhr.responseText);
								}
							} else {
								// error
								console.error(xhr.responseText);
							}
						};
					}
				});
				
				function dealerSignUp() {
					document.getElementById('username').placeholder = '<?php echo $labels[$currentLanguageIsoCode]["Company_Name"]; ?>*';
					document.getElementById('email').placeholder = '<?php echo $labels[$currentLanguageIsoCode]["Company_Email"]; ?>*';
					document.getElementById('invalid-credentials-message-for-sign-up').innerText = '<?php echo $labels[$currentLanguageIsoCode]["Company_Name_Email_not_available"]; ?>';
				}
				function privateSignUp() {
					document.getElementById('username').placeholder = '<?php echo $labels[$currentLanguageIsoCode]["Username"]; ?>*';
					document.getElementById('email').placeholder = '<?php echo $labels[$currentLanguageIsoCode]["Email"]; ?>*';
					document.getElementById('invalid-credentials-message-for-sign-up').innerText = '<?php echo $labels[$currentLanguageIsoCode]["User_Name_Email_not_available"]; ?>';
				}
			</script>
			<div class="row my-2">
				<p class="text-center" style="color:#999; font-size:13px;"><?php echo $labels[$currentLanguageIsoCode]['Agree_to_TC_and_PP_By_SignUP']; ?></p>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="verifyOtp" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="direction:ltr;">
        <button class="btn btn-back" data-bs-target="#registerModal" data-bs-toggle="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="login-panel">
			<div class="text-center mb-5">
				<div class="heading my-4">We have sent you a code</div>
				<div class="">Please enter it below to verify your phone</div>
			</div>
			<form onsubmit="return false;">
				<div class="mb-3">
				  <input type="text" class="form-control px-4" id="mobileOtp" placeholder="Enter here" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
				  <div id="invalid-phone-otp" style="display=none;" class="invalid-feedback">You have entered wrong OTP.</div>
				</div>
				<a class="btn btn-danger btn-theme" style="width: 100%;" onclick="verifyOTP();">Verify</a>
				<div class="row my-4">
					<a type="button" class="text-center text-danger text-decoration-none">Did not receive? Send Again</a>
				</div>
			</form>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="forgotPasswordModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="direction:ltr;">
        <button class="btn btn-back" data-bs-target="#loginByEmailModal" data-bs-toggle="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <div class="login-panel">
			<div class="text-center mb-5">
				<div class="heading my-4"><?php echo $labels[$currentLanguageIsoCode]['Forgot_your_Password']; ?></div>
			</div>
			<form id="forgot-password-form">
				<div class="mb-3">
				  <input type="email" id="forgot-password-email" name="email" class="form-control px-4" placeholder="<?php echo $labels[$currentLanguageIsoCode]['Email']; ?>" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
				  <div id="password-reset-link-sent-message" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['Password_Reset_Link_Sent']; ?></div>
				  <div id="invalid-email-in-forgot-password-form-message" style="display=none;" class="invalid-feedback"><?php echo $labels[$currentLanguageIsoCode]['The_email_does_not_belong_to_any_Account']; ?></div>
				</div>
				
				<button type="submit" class="btn btn-danger btn-theme mb-5" style="width: 100%;"><?php echo $labels[$currentLanguageIsoCode]['Send_Password_Reset_Link']; ?></button>
			</form>
		</div>
      </div>
    </div>
  </div>
</div>
<script>
	var verifyOtpModal =  new bootstrap.Modal("#verifyOtp");
	var registerModal = new bootstrap.Modal("#registerModal");
	var verifyOtpModalShown = false;
	
	document.getElementById('verifyOtp').addEventListener('shown.bs.modal', event => {
		verifyOtpModalShown = true;
	})
	
	document.getElementById('verifyOtp').addEventListener('hidden.bs.modal', event => {
		verifyOtpModalShown = false;
	})
	
	function openRegisterModal() {
		registerModal.show();
	}
	
	function updateDialingCode(dialingCode, countryFlag){
		var dialingCodeElement = document.getElementById("dialingCode");
		var countryFlagElement = document.getElementById("countryFlag");
		var dialingCodeFieldElement = document.getElementById("dialingCodeField");
		dialingCodeElement.innerHTML = dialingCode;
		countryFlagElement.className = countryFlag;
		dialingCodeFieldElement.value = dialingCode;
	}
	
	function checkPhoneNumber() {
		var dialingCode = document.getElementById("dialingCode").innerText;
		var phoneNumber = document.getElementById("phonenumber").value;
		if(phoneNumber.length == 8 || phoneNumber.length == 9 || phoneNumber.length == 10) {
			document.getElementById("invalid-phone-message").style.display = 'none';
			var phone = dialingCode + phoneNumber;
			/*var xhr = new XMLHttpRequest();
	        Making our connection  
    	    var url = 'otp-controller.php?phoneNumber=' + phoneNumber + '&action=send_otp';
        	xhr.open("GET", url, true);
        	// function execute after request is successful 
        	xhr.onreadystatechange = function () {
            	if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					if(this.responseText=="Message Sent"){
						registerModal.hide();
						verifyOtpModal.show();
					}
					else{
						document.getElementById("message-not-sent").style.display = 'block';
					}
	            }
    	    }
        	// Sending our request 
        	xhr.send();*/
			firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier).then(function(confirmationResult){
				window.confirmationResult = confirmationResult;
				registerModal.hide();
				verifyOtpModal.show();
			}).catch(function(error){
				console.log(error.message);
			});
		} else {
			document.getElementById("invalid-phone-message").style.display = 'block';
		}
	}

	function verifyOTP(){
		var mobileOtp = document.getElementById("mobileOtp").value;
		if(mobileOtp.length == 6) {
			document.getElementById("invalid-phone-otp").style.display = 'none';
			/*var xhr = new XMLHttpRequest();
	        // Making our connection  
    	    var url = 'otp-controller.php?mobileOtp=' + mobileOtp + '&action=verify_otp';
        	xhr.open("GET", url, true);
        	// function execute after request is successful 
        	xhr.onreadystatechange = function () {
            	if (this.readyState == 4 && this.status == 200) {
					if(this.responseText=="Success"){
						verifyOtpModal.hide();
						registerModal.show();
						document.getElementById("phone-verified-badge").style.display = "block";
						document.getElementById("phonenumber").disabled = "true";
						document.getElementById("sendOtpButton").style.display = "none";
						document.getElementById("verify-phone-message").style.display = "none";
					}
					else{
						document.getElementById("invalid-phone-otp").style.display = "block";
					}
	            }
    	    }
        	// Sending our request 
        	xhr.send();*/
			window.confirmationResult.confirm(mobileOtp).then((result) => {
				verifyOtpModal.hide();
				registerModal.show();
				document.getElementById("phone-verified-badge").style.display = "block";
				document.getElementById("phonenumber").disabled = "true";
				document.getElementById("sendOtpButton").style.display = "none";
				document.getElementById("verify-phone-message").style.display = "none";
				document.getElementById("recaptcha-container").style.display = "none";
				document.getElementById("dialing-code-button").disabled = "true";
			}).catch((error) => {
			    document.getElementById("invalid-phone-otp").style.display = 'block';
			});
		} else {
			document.getElementById("invalid-phone-otp").style.display = 'block';
		}
	}

	function verifyUserNameandEmail(){
		var userName = document.getElementById("username").value;
		var email = document.getElementById("email").value;
		var xhr = new XMLHttpRequest();
        // Making our connection  
        var url = 'validate-username-email.php?name=' + userName + '&email=' + email;
        xhr.open("GET", url, true);
        // function execute after request is successful 
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
				var response = this.responseText;
				var arr = response.split(',');
				var userNameStatus = arr[0];
				var emailStatus = arr[1];
				if(userNameStatus == "Available" && emailStatus == "Available"){
					document.getElementById("submit").disabled = false;
				}
				if(userNameStatus == "Not Available" || emailStatus == "Not Available"){
					document.getElementById("submit").disabled = true;
				}
				if(userNameStatus == "Available") {
					document.getElementById("incorrect-checkmark-username").style.display = "none";
					document.getElementById("correct-checkmark-username").style.display = "block";
				}
				else if(userNameStatus == "Not Available"){
					document.getElementById("correct-checkmark-username").style.display = "none";
					document.getElementById("incorrect-checkmark-username").style.display = "block";
				}
				else {
					document.getElementById("correct-checkmark-username").style.display = "none";
					document.getElementById("incorrect-checkmark-username").style.display = "none";
				}
				if(emailStatus == "Available") {
					document.getElementById("incorrect-checkmark-email").style.display = "none";
					document.getElementById("correct-checkmark-email").style.display = "block";
				}
				else if(emailStatus == "Not Available"){
					document.getElementById("correct-checkmark-email").style.display = "none";
					document.getElementById("incorrect-checkmark-email").style.display = "block";
				}
				else {
					document.getElementById("correct-checkmark-email").style.display = "none";
					document.getElementById("incorrect-checkmark-email").style.display = "none";
				}

            }
        }
        // Sending our request 
        xhr.send();
	}
	
	document.addEventListener("keydown", function(event) {
	  if (event.keyCode === 13 && verifyOtpModalShown) {
		event.preventDefault();
	  }
	});
	
	document.getElementById("forgot-password-form").addEventListener("submit", function(event){
	  event.preventDefault();
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "password-reset-link-generator.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	  var formData = "email=" + encodeURIComponent(document.getElementById("forgot-password-email").value);
	  xhr.send(formData);
	  xhr.onload = function() {
		  if (xhr.status === 200) {
			// success
			console.log(xhr.responseText);
			if(xhr.responseText == 'link sent') {
				document.getElementById("password-reset-link-sent-message").style.display = 'block';
			} else {
				document.getElementById("invalid-email-in-forgot-password-form-message").style.display = 'block';
			}
		  } else {
			// error
			console.error(xhr.responseText);
		  }
	  };
	});
	
</script>
