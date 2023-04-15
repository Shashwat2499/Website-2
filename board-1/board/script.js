const form = document.getElementById("form")

form.addEventListener('submit',(e)=>{
    e.preventDefault() 
    // will same the form as a variable
    const input = e.target
    let stringPattern = /[a-zA-Z]/;
    let phonePattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    let emailPattern = /\S+@\S+\.\S+/g;
    let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[!#$%&'*+-/=?^_`{|}~])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}$/;

// first name alert
   

    if (!input.fname.value.match(stringPattern)) {
        alert("Please provide correct First name!");
       
      }
// last name alert
    if (!input.lname.value.match(stringPattern)) {
        alert("Please provide correct Last name ");
        
      }
// phone alert    
    if(!input.number.value.match(phonePattern)){
           
        }
 // password alert   
    if(!input.password.value.match(passwordPattern)){
            alert("first letter should be capital and consist of special characters")
           
        }

    // email alert 
    if(!input.email.value.match(emailPattern)){
            alert("Password not meeting the expectation")
           
        }




if(input.email.value.match(emailPattern)&&input.password.value.match(passwordPattern)){
    alert("Appointment Booked Thankyou")
}





 
})

