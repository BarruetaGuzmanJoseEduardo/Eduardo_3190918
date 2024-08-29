alert('El script está funcionando');
let numeroMaquina = Math.floor(Math.random()*(10 - 1)+1);
    console.log(numeroMaquina);
 
let numeroUsuario = parseInt ( prompt("Adivina el numero del 1 al 10"));

let vidas= 5;
 while (numeroMaquina !== numeroUsuario && vidas > 1){
    vidas --;
    numeroUsuario = parseInt (prompt ("Mal, te quedan "+vidas + " vidas"));
 }

 if (numeroMaquina === numeroUsuario){
    console.log("ganaste!");
 }else {
    console.log("Perdiste");
    console.log("El numero era: "+numeroMaquina);

}