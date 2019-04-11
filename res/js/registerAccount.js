var lowerCaseValid = false;
var upperCaseValid = false;
var numberValid = false;
var characterCountValid = false;

var passwordValid = false;
var passwordMatching = false;

let pw = document.getElementById('pw');
let cp = document.getElementById('cp');
var letter = document.getElementById('letter');
var capital = document.getElementById('capital');
var number = document.getElementById('number');
var length = document.getElementById('length');
var btn = document.getElementById('register-btn');
var pwError = document.getElementById('pw-error');

function toggleButton() {
	if (passwordValid && passwordMatching) {
		btn.disabled = false;
		btn.style.display = true;
	}
	else {
		btn.disabled = true;
		btn.style.display = false;
	}
}

function check_pass() {
	if (pw.value !== cp.value) {
		pwError.style.display = 'block';
		passwordMatching = false;
	}
	else if (pw.value === cp.value) {
		pwError).style.display = 'none';
		passwordMatching = true;
	}
	toggleButton();
}
	
// When the user starts to type something inside the password field
function validatePassword() {
document.getElementById('message').style.display = 'block'; 
  // Validate lowercase letters
  
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove('invalid');
    letter.classList.add('valid');
	lowerCaseValid = true;
	
  } else {
    letter.classList.remove('valid');
    letter.classList.add('invalid');
	lowerCaseValid = false;
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove('invalid');
    capital.classList.add('valid');
	upperCaseValid = true;
  } else {
    capital.classList.remove('valid');
    capital.classList.add('invalid');
	upperCaseValid = false;
  }
  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove('invalid');
    number.classList.add('valid');
	numberValid = true;
  } else {
    number.classList.remove('valid');
    number.classList.add('invalid');
	numberValid = false;
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove('invalid');
    length.classList.add('valid');
	characterCountValid = true;
  } else {
    length.classList.remove('valid');
    length.classList.add('invalid');
	characterCountValid = false;
  }
  
  // Check if all conditions are satisfied
  if (lowerCaseValid && upperCaseValid && numberValid && characterCountValid) {
		document.getElementById('message').style.display = 'none'; 
		document.getElementById('greyBox').style.height = '1180px';
		passwordValid = true;
  } else {
		document.getElementById('message').style.display = 'block'; 
		document.getElementById('greyBox').style.height = '1400px';
		passwordValid = false;
  }  
  toggleButton();
}