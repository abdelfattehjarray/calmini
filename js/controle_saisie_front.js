



var btnn = document.querySelector(".avis_button").addEventListener("click", (e)=>{
  
    let inputs = document.getElementsByClassName("inputs");
      let formData = {
         commentaire: inputs[0].value,
         evaluation: inputs[1].value
                     }
        
    let test_verifie= validate(formData);
    if(test_verifie==false){
        e.preventDefault();
       }

})


const validate = (formData) => {
    let test_verifie=false;
    var regex1 = /^\d{1}$/;
    if(regex1.test(formData.evaluation)||formData.evaluation==10||(formData.commentaire.length>1 && formData.commentaire.length<100)){
        
        test_verifie=true;
    }else{
        
        document.getElementById("error_evaluation").innerHTML = "<span style='color:red'>entrez un entier entre 0 est 10</span>"
        document.getElementById("error_comment").innerHTML = "<span style='color:red'>Le commentaire doit contenir entre 3 et 100 caracteres</span>"
    
     
    }


    
    return test_verifie;

}




const checkcomment = (input) => {
    let comment = input.value;
    if(comment.length>0 && comment.length<100){
        document.getElementById("error_comment").innerHTML = "<span style='color:green'>Le commentaire est valide!</span>" 
    }else{
        document.getElementById("error_comment").innerHTML = "<span style='color:red'>Le commentaire doit contenir entre 3 et 100 caracteres</span>"
    
    }
}
const checkevaluation = (input) => {
    let evaluation = input.value;
    var regex = /^\d{1}$/;
    if(regex.test(evaluation)||evaluation=="10"){
        document.getElementById("error_evaluation").innerHTML = "<span style='color:green'>Le evaluation est valide!</span>" 
    }else{
        document.getElementById("error_evaluation").innerHTML = "<span style='color:red'>entrez un entier entre 0 est 10</span>"
    
    }
}
