

var btn = document.querySelector(".submit-button").addEventListener("click", (e)=>{
  
    let input = document.getElementsByClassName("input");
    let formData = {
        nomCoach: input[0].value,
        prenomCoach: input[1].value,
        tel: input[2].value,
        mail: input[3].value,
        specialite: input[4].value,
        experience: input[5].value,
        details: input[6].value
        }
        
    let test_verifie= validate(formData);
    if(test_verifie==false){
        e.preventDefault();
       }
    
})
const validate = (formData) => {
    let test_verifie=false;
    let regex_nomcoach=/^[a-zA-Z]{2,8}$/;
    let regex_prenomcoach=/^[a-zA-Z]{2,8}$/;
    let regex_tel = /^\d{7}$/;
    let regex_mail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{1,3}$/;
    let regex_experience = /^\d{1}$/;
     let regex_experience1 = /^\d{0}$/;
     let regex_details = /^[a-zA-Z]{8,100}$/;
    if(regex_nomcoach.test(formData.nomCoach)&& regex_prenomcoach.test(formData.prenomCoach)&& formData.tel.length==8 && regex_mail.test(formData.mail)&&formData.specialite!=""&&(formData.experience.length<=3)&& formData.details.length<101 && formData.details.length>0){
        
        test_verifie=true;
    }else{
        if(!regex_nomcoach.test(formData.nomCoach)){
        document.getElementById("error_nomCoach").innerHTML = "<span style='color:red'>Le nom doit contenir entre 3 et 8 caracteres</span>"
        }
        if(!regex_prenomcoach.test(formData.prenomCoach)){
        document.getElementById("error_prenomCoach").innerHTML = "<span style='color:red'>Le prenom doit contenir entre 3 et 8 caracteres</span>"
        }
        if(formData.tel.length!=8){
            document.getElementById("error_tel").innerHTML = "<span style='color:red'>Le numero doit contenir exactement 8 chiffres</span>"
        
        }
        if(!regex_mail.test(formData.mail)){  
            document.getElementById("error_mail").innerHTML = "<span style='color:red'>Respectez le format exemple@gmail.com</span>"
        }
        if (formData.specialite==""){
         document.getElementById("error_specialite").innerHTML =  "<span style='color:red'>Ce champ est obligatoire</span>"
        }
       if(formData.experience.length>=3){
           
            document.getElementById("error_experience").innerHTML = "<span style='color:red'>ce nombre est tres haut</span>"
        
        }
        if(formData.details.length>=101||formData.details.length<0){
          
            document.getElementById("error_details").innerHTML = "<span style='color:red'>la chaine est tres longue</span>"
        
        }
     
    }
    return test_verifie;

}

const checkName = (input) => {
    let nomCoach = input.value;
    var regex = /^[a-zA-Z]{2,8}$/;
    if(regex.test(nomCoach)){
        document.getElementById("error_nomCoach").innerHTML = "<span style='color:green'>Le nom est valide!</span>" 
    }else{
        document.getElementById("error_nomCoach").innerHTML = "<span style='color:red'>Le nom doit contenir entre 3 et 8 caracteres</span>"
    
    }


}

const checkPrenom = (input) => {
    let prenomCoach = input.value;
    var regex = /^[a-zA-Z]{2,8}$/;
    if(regex.test(prenomCoach) ){
        document.getElementById("error_prenomCoach").innerHTML = "<span style='color:green'>Le prenom est valide!</span>" 
    }else{
        document.getElementById("error_prenomCoach").innerHTML = "<span style='color:red'>Le prenom doit contenir au min 3 caractere</span>"
    
    }


}

const checkTel = (input) => {
    let tel = input.value;
   
    var regex = /^\d{7}$/;
    if( regex.test(tel)){
        document.getElementById("error_tel").innerHTML = "<span style='color:green'>Le numero est valide!</span>" 
    }else{
        document.getElementById("error_tel").innerHTML = "<span style='color:red'>Le numero doit contenir exactement 8 chiffres</span>"
    
    }


}

const checkmail = (input) => {
    let mail = input.value;
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{1,}$/;
    if( regex.test(mail)){
        document.getElementById("error_mail").innerHTML = "<span style='color:green'>Mail est valide!</span>" 
    }else{
        document.getElementById("error_mail").innerHTML = "<span style='color:red'>Respectez le format exemple@gmail.com</span>"
    
    }


}

const checkspecialite = (input) => {
    
    let specialite = input.value
    if (specialite!=""){
    document.getElementById("error_specialite").innerHTML = "<span style='color:green'>Valide specialite</span>"
}else{
    document.getElementById("error_specialite").innerHTML =  "<span style='color:red'>Ce champ est obligatoire</span>"
}
}




const checkexperience = (input) => {
    let experience = input.value;
    var regex = /^\d{1}$/; var regex1 = /^\d{0}$/;
    if( regex.test(experience)||regex1.test(experience)){
        document.getElementById("error_experience").innerHTML = "<span style='color:green'>le nombre des années est valide!</span>" 
    }else{
        document.getElementById("error_experience").innerHTML = "<span style='color:red'>ce nombre est tres haut</span>"
    
    }


}

const checkdetails = (input) => {
    let details = input.value;
    
    if( details.length<=50){
        document.getElementById("error_details").innerHTML = "<span style='color:green'>la chaine est valide!</span>" 
    }else{
        document.getElementById("error_details").innerHTML = "<span style='color:red'>la chaine est tres longue</span>"
    
    }


}




document.getElementById('resetBtn').addEventListener('click', function() {
    history.go(-1); // Go back to previous page
  });



















