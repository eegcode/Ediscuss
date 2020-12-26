const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');
const cpassmsg = document.getElementById('cpasswordHelp');

const cpasserror = "Passwords didn't match";
const cpasssuccess = "Passwords matched";


cpassword.addEventListener('input',()=>{
	if(password.value === cpassword.value){
		cpassword.style.borderColor = "green";
		cpassmsg.innerHTML = cpasssuccess;
		cpassmsg.style.color = 'green';
	}else{
		cpassword.style.borderColor = "red";
		cpassmsg.innerHTML = cpasserror;
		cpassmsg.style.color = 'red';
	}
})
