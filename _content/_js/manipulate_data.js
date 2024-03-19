const constDivInputs = document.getElementById("div-tabCol_id");
const date = new Date();
const obj = {};
let mañana = "" ;
if ((date.getMonth()+1)<10) {//agrega un cero al mes en caso de que corresponda
  mañana = date.getFullYear()+"-0"+(date.getMonth()+1)+"-"+(date.getDate()+1);
}else{//si no se le agrega el  no jala
  mañana = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+(date.getDate()+1);
}
document.getElementById("inp-num-bloqusu-id").oninput = functionNumeroBloqueos;
document.getElementById("form-bloqusu-id").addEventListener("submit", function(e) {
  e.preventDefault();
  const cantFilas = document.getElementById("inp-num-bloqusu-id").value;
  for (var i = 0; i < cantFilas; i++) {
    const inpSap = document.querySelectorAll('.inpSap-class')[i].value;
    const inpFec = document.querySelectorAll('.inpFec-class')[i].value;
    const inpMot = document.querySelectorAll('.inpMot-class')[i].value;
    obj[i] = {
      inpSap,
      inpFec,
      inpMot,        
    };
  }
  let text = "¿Estas seguro de querer bloquear estos usuarios?";
  if (confirm(text) == true) {
    send_action_send_blocked(obj);
  }
});
function functionNumeroBloqueos(){
  nIngresado = document.getElementById("inp-num-bloqusu-id").value;
  nBloqueados = constDivInputs.querySelectorAll('input').length/3;

  if(nIngresado>nBloqueados && nBloqueados<=20){//agregar
    agregarCampos(nIngresado - nBloqueados);
  }else if (nIngresado<nBloqueados) {//quitar
    quitarCampos(nBloqueados-nIngresado);
  }
  document.getElementById("div-inpSav_id").style.display = "block";
}
const send_blocked = (data) =>{
  document.getElementById("form-bloqusu-id").reset();
  filaInputs = constDivInputs.querySelectorAll('div[class="div_FilInp_Class"]');
  for (var i = 0; i < filaInputs.length; i++) {
    constDivInputs.removeChild(filaInputs[i]);
  }
  document.getElementById("inp-num-bloqusu-id").value = "0";
  alert("Usuarios Bloqueados Exitosamente");
  document.getElementById("div-inpSav_id").style.display = "none";
  send_action_print_blocked();
}
const validate_blocked = (data) =>{
  if(data.success){
    alert("El SAP ingresado ya cuenta con un bloqueo activo");
    document.getElementById("btn-savbloqusu-id").style.display = 'none';
  }else{
    document.getElementById("btn-savbloqusu-id").style.display = 'inline';
  }
}
const validate_existed_blocked = (data) =>{
  if(data.success){
    send_action_validate_blocked(data.data.datos[0].cpUsuario);
  }else{
    alert("El SAP ingresado es incorrecto o no existe, vuelve a intentarlo");
    document.getElementById("btn-savbloqusu-id").style.display = 'none';
  }
}
const print_blocked = (data) =>{
  if(data.success){
    result = `
      <tr class="tr_titBlo">
        <th>SAP</th>
        <th>Nombre</th>
        <th>Fecha de bloqueo</th>
        <th>Fecha de desbloqueo</th>
      </tr>`;
    const listaBloqueados = data.data.datos;
    listaBloqueados.forEach(element=>{
      result += `
        <tr class="tr_titCon">
          <td>${element.cpUsuario}</td>
          <td>${element.cpNombre}</td>
          <td>${element.cpFBloqueo}</td>
          <td>${element.cpFDesbloqueo}</td>
        </tr>`
    });
    document.getElementById("tab-lisBlo-id").innerHTML = result;
  }
}
const print_old_blocked = (data) =>{
  if(data.success){
    result = `
      <tr class="tr_titBlo">
        <th>SAP</th>
        <th>Nombre</th>
        <th>Fecha de bloqueo</th>
        <th>Fecha de desbloqueo</th>
      </tr>`;
    const listaBloqueados = data.data.datos;
    listaBloqueados.forEach(element=>{
      result += `
        <tr class="tr_titCon">
          <td>${element.cpUsuario}</td>
          <td>${element.cpNombre}</td>
          <td>${element.cpFBloqueo}</td>
          <td>${element.cpFDesbloqueo}</td>
        </tr>`
    });
    document.getElementById("tab-lisAntBlo-id").innerHTML = result;
  }
}
function agregarCampos(cantidadAgregar){
inputsSAPS = document.querySelectorAll(".inpSap-class");
nid = 0;
if(inputsSAPS){
  nid += inputsSAPS.length;
  
}
  for (var i = 0; i < cantidadAgregar; i++) {
    const divFilInp = document.createElement("div");
    divFilInp.className = "div_FilInp_Class";
    divFilInp.id = 'containerInfo';
    const constNodo1 = document.createElement("input");
    constNodo1.id = 'inpSap'+(nid+i);
    constNodo1.type = "text";
    constNodo1.placeholder = "numero SAP o usuario";
    constNodo1.required = true;
    constNodo1.maxLength = "12";
    constNodo1.className = "inpSap-class";
    constNodo1.onchange="myFunction()";
    const constNodo2 = document.createElement("input");
    constNodo2.id = 'inpFecha';
    constNodo2.type = "date";
    constNodo2.placeholder = "Fecha de desbloqueo";
    constNodo2.required = true;
    constNodo2.className = "inpFec-class";
    constNodo2.min = mañana;
    const constNodo3 = document.createElement("input");
    constNodo3.id = 'inpMotivo';
    constNodo3.type = "text";
    constNodo3.placeholder = "Motivo del bloqueo";
    constNodo3.required = true;
    constNodo3.maxLength = "50";
    constNodo3.className = "inpMot-class";
    divFilInp.appendChild(constNodo1);
    divFilInp.appendChild(constNodo2);
    divFilInp.appendChild(constNodo3);
    document.getElementById("div-tabCol_id").appendChild(divFilInp);
    document.getElementById('inpSap'+(nid+i)).addEventListener('change',function(){
      send_action_validate_existed_blocked(this.value);
    });
  }
}
function quitarCampos(cantidadEliminar){
  filaInputs = constDivInputs.querySelectorAll('div[class="div_FilInp_Class"]');
  for (var i = 0; i < cantidadEliminar; i++) {
    constDivInputs.removeChild(filaInputs[filaInputs.length-1-i]);
    }
}
function showLisBlo() {
  lisBlo = document.getElementById("tab-lisBlo-id");
  if (lisBlo.style.display === "block") {
    lisBlo.style.display = "none";
  } else {
    lisBlo.style.display = "block";
  }
}
function showLisAntBlo() {
  lisBlo = document.getElementById("tab-lisAntBlo-id");
  if (lisBlo.style.display === "block") {
    lisBlo.style.display = "none";
  } else {
    lisBlo.style.display = "block";
  }
}



