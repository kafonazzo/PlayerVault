function validaLunghezzaPassword() {
    // Verifica se la password ha almeno 6 caratteri
   // Previeni il comportamento predefinito del form
  const password = document.getElementById("psw").value;
    if (password.length < 6) {
        alert("La password deve essere lunga almeno 6 caratteri.");
        return false;
    }else{
      return true;
    }  
}
function validaEmail() {
  var emailValue = document.getElementById('email').value;

  // Verifica se l'email contiene un "@" e un "."
  if (!emailValue.includes('@') || !emailValue.includes('.')) {
      alert("Inserisci un'email valida, con @ e '.', seguito da del testo dietro");
      return false;
  } else {
      return true;
  }
}





