window.onload = (event) => {
    if(document.getElementById("fecha_registro").value == ""){
        document.getElementById("fecha_registro").value = new Date();
    }
    var sel = document.getElementById("tipo_id");
    var str= sel.options[sel.selectedIndex].text;
    if (str == "CON GOCE") {
        var selMotivo = document.getElementById("tipo_motivo");
        var strMotivo= selMotivo.options[selMotivo.selectedIndex].text;
        if(strMotivo == "OTROS"){
            $("#tipo_motivo").css('display', 'block');
            
        }else{
            if(strMotivo == "BAJA MEDICA")
            {
                $("#tipo_motivo").css('display', 'block');
                $("#motivo").css('display', 'none');
                $("#tipo_baja").css('display','block')
            }else{
                $("#tipo_motivo").css('display', 'block');
                $("#motivo").css('display', 'none');
                
            }
        }          
    }else{
        if (str == "VACACION") {
            $("#foot_buttonAdd").css('display', 'block'); 
        }else{
            if (str == "ESPECIAL") {
                $("#div_estado_critico").css('display', 'block');
                $("#tipo_motivo").css('display', 'none');
                $("#motivo").css('display', 'none');
                
                var selEsp = document.getElementById("estado_critico");
                var strEsp= selEsp.options[selEsp.selectedIndex].text;
                    if (strEsp == "CANCER INFANTIL O ADOLESCENTE") {
                        $("#tratamiento_cancer").css('display', 'block');
                    }else{
                        if(strEsp=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE" || 
                        strEsp=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
                        strEsp=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"
                        ){
                            $("#tratamiento_transplante").css('display', 'block');
                        }else{
                            if (strEsp == "INSUFICIENCIA RENAL CRONICA") {
                                var selIns = document.getElementById("tratamiento_insuficiencia");
                                var strIns = selIns.options[selIns.selectedIndex].text;
                                $("#tratamiento_insuficiencia").css('display', 'block');
                                if(strIns == "ESTADO TERMINAL DEL NIÑO/A ADOLESCENTE"){
                                    $("#foot_buttonAdd").css('display', 'block'); 
                                }
                            }else{
                                if (strEsp == "DISCAPACIDAD GRAVE Y MUY GRAVE") {
                                    $("#tratamiento_discapacidad").css('display', 'block');
                                }else{
                                    if (strEsp == "ACCIDENTE GRAVE CON RIESGO DE MUERTE O SECUELA FUNCIONAL SEVERA Y PERMANENTE") {
                                        $("#tratamiento_accidente_muy_grave").css('display', 'block');
                                        $("#foot_buttonAdd").css('display', 'block'); 
                                    }else{
                                        if (strEsp == "ACCIDENTE GRAVE") {
                                            $("#tratamiento_accidente_grave").css('display', 'block');
                                        }
                                    }
                                }         
                            }
                        } 
                    }
            }
        }
    }
};
//cantidad de dias limite para tomar licencia
var limit_days = 3;
//Al cambiar el tipo de licencia
function changeType() {
/*Cuando cambia se vacia el motivo*/
document.getElementById("motivo").value = "";
$("#tipo_baja").css('display', 'none');
$("#div_estado_critico").css('display', 'none');   
document.getElementById('tratamiento_cancer').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_transplante').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_insuficiencia').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_discapacidad').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_accidente_muy_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_accidente_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
$("#tratamiento_cancer").css('display', 'none');
$("#tratamiento_transplante").css('display', 'none');
$("#tratamiento_insuficiencia").css('display', 'none');
$("#tratamiento_discapacidad").css('display', 'none');
$("#tratamiento_accidente_muy_grave").css('display', 'none');
$("#tratamiento_accidente_grave").css('display', 'none');
/*Cuando cambia se elimina los datos de las fechas*/
$('#invoice-details tbody tr:not(:first-child)').remove();
// $("#completo").get(0).type = 'text';
// $("#completo").css('display', 'block');
// document.getElementById('horario').getElementsByTagName('option')['completo'].selected = 'selected';
var sel = document.getElementById("tipo_id");
var str= sel.options[sel.selectedIndex].text;
$("#motivo").css('margin-top', '0px'); 
if (str == "CON GOCE") {
$("#tipo_motivo").css('display', 'block');
document.getElementById('tipo_motivo').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
$("#motivo").css('display', 'none');
$("#divMotivo").css('display', 'block'); 
$("#foot_buttonAdd").css('display', 'none');
limit_days = 3;
document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
}else{
if(str=="ESPECIAL") {
    document.getElementById('estado_critico').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
    $("#div_estado_critico").css('display', 'block'); 
    $("#divMotivo").css('display', 'none');
    document.getElementById('textoLimite').innerText = "Dependiendo del motivo varia la cantidad de días limite de la licencia"
}else{
    $("#tipo_motivo").css('display', 'none');   
    $("#divMotivo").css('display', 'block'); 
    $("#motivo").css('display', 'block'); 
    $('option:contains("OTROS")').prop('selected', true);
    limit_days = 3;
    if (str == "VACACION") {   
        $("#foot_buttonAdd").css('display', 'block');       
        limit_days = 10;
        document.getElementById('textoLimite').innerText = "Se pueden tomar hasta 10 dias continuos o discontinuos de Licencia a Cuenta de Vacacion"
    }else{
        document.getElementById('textoLimite').innerText = "En licencias Sin Goce de Haber solo puede tomarse tres dias seguidos"
        $("#foot_buttonAdd").css('display', 'none');                         
    }
} 
} 
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeMotivo(dias) {
$("#motivo").css('margin-top', '0px'); 
$("#tipo_baja").css('margin-top', '0px'); 
var sel = document.getElementById("tipo_motivo");
var str= sel.options[sel.selectedIndex].text;
$("#tipo_baja").css('display', 'none');
if (str == "OTROS") {
$("#motivo").css('display', 'block');
$("#motivo").css('margin-top', '15px'); 
document.getElementById("motivo").value = "";
limit_days = 3;
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
}else{
$("#motivo").css('display', 'none');
if(str=="BAJA MEDICA"){
    $("#tipo_baja").css('display', 'block');     
    $("#tipo_baja").css('margin-top', '15px'); 
    //marcando maternidad como primera opcion    
    document.getElementById('tipo_baja').getElementsByTagName('option')['maternidad'].selected = 'selected';
    str = "MATERNIDAD";
    limit_days = 90;
    document.getElementById('textoLimite').innerText = "El tiempo de la licencia varia según la recomendación de su doctor"
}else{
    if(str=="NACIMIENTO" || str=="CENSO"){
        limit_days = 2;
    }else{
        if (str == "PATERNIDAD"){
            limit_days = 3;
        }else{
            if (str == "RIP") {
                limit_days = 1;
                
                
            }else{
                 limit_days = 3;
            } 
        }           
        }
        document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
    }     
    document.getElementById("motivo").value = str;
}
//contando los dias segun los limites
countDays();
}
//Cambiando segun el estado critico
function changeTypeEspecial() {
var sel = document.getElementById("estado_critico");
var str= sel.options[sel.selectedIndex].text;
document.getElementById('tratamiento_cancer').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_transplante').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_insuficiencia').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_discapacidad').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_accidente_muy_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
document.getElementById('tratamiento_accidente_grave').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
$("#tratamiento_cancer").css('display', 'none');
$("#tratamiento_transplante").css('display', 'none');
$("#tratamiento_insuficiencia").css('display', 'none');
$("#tratamiento_discapacidad").css('display', 'none');
$("#tratamiento_accidente_muy_grave").css('display', 'none');
$("#tratamiento_accidente_grave").css('display', 'none');
$("#foot_buttonAdd").css('display', 'none');
$("#divMotivo").css('display', 'block');
$("#motivo").css('display', 'none');
$("#tipo_motivo").css('display', 'none');
if (str == "CANCER INFANTIL O ADOLESCENTE") {
$("#tratamiento_cancer").css('display', 'block');
}else{
if(str=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE" || 
str=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
str=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"
){
    $("#tratamiento_transplante").css('display', 'block');
}else{
    if (str == "INSUFICIENCIA RENAL CRONICA") {
        $("#tratamiento_insuficiencia").css('display', 'block');
    }else{
        if (str == "DISCAPACIDAD GRAVE Y MUY GRAVE") {
            $("#tratamiento_discapacidad").css('display', 'block');
        }else{
            if (str == "ACCIDENTE GRAVE CON RIESGO DE MUERTE O SECUELA FUNCIONAL SEVERA Y PERMANENTE") {
                $("#tratamiento_accidente_muy_grave").css('display', 'block');
            }else{
                if (str == "ACCIDENTE GRAVE") {
                    $("#tratamiento_accidente_grave").css('display', 'block');
                }
            }
        }         
    }
} 
}
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeTratamientoCancer() {
var sel = document.getElementById("tratamiento_cancer");
var str= sel.options[sel.selectedIndex].text;
if (str == "TRATAMIENTO DEL CANCER") {           
document.getElementById("motivo").value = str;
limit_days = 5;
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
}
//contando los dias segun los limites
countDays();
}
function changeTypeTratamientoTransplante() {
var selCrit = document.getElementById("estado_critico");
var strCrit = selCrit.options[selCrit.selectedIndex].text;
var sel = document.getElementById("tratamiento_transplante");
var str = sel.options[sel.selectedIndex].text;
if(strCrit=="ENFERMEDAD SISTEMICA QUE REQUIERE TRANSPLANTE")
{
if (str == "PREVIO A LA INTERVENCION QUIRURGICA") {           
    document.getElementById("motivo").value = str;
    limit_days = 3;
}else{
    if (str == "DIA DE LA INTERVENCION QUIRURGICA") {           
        document.getElementById("motivo").value = str;
        limit_days = 1;
    }else{
        if (str == "POSTERIOR A LA INTERVENCION QUIRURGICA") {           
            document.getElementById("motivo").value = str;
            limit_days = 10;
        }
    }
}
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
}else{
if(strCrit=="ENFERMEDAD NEUROLOGICA QUE REQUIERE TRATAMIENTO QUIRURGICO" ||
   strCrit=="ENFERMEDAD OSTEOARTICULAR QUE REQUIERE TRATAMIENTO QUIRURGICO Y REHABILITACION"){
    if (str == "PREVIO A LA INTERVENCION QUIRURGICA") {           
        document.getElementById("motivo").value = str;
        limit_days = 3;
    }else{
        if (str == "DIA DE LA INTERVENCION QUIRURGICA") {           
            document.getElementById("motivo").value = str;
            limit_days = 1;
        }else{
            if (str == "POSTERIOR A LA INTERVENCION QUIRURGICA") {           
                document.getElementById("motivo").value = str;
                limit_days = 3;
            }
        }
    }
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
}
}
//contando los dias segun los limites
countDays();
}
function changeTypeTratamientoInsuficiencia() {
var sel = document.getElementById("tratamiento_insuficiencia");
var str= sel.options[sel.selectedIndex].text;
if (str == "HEMODIALISIS") {           
document.getElementById("motivo").value = str;
limit_days = 2;
$("#foot_buttonAdd").css('display', 'none');
//contando los dias segun los limites
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
countDays();
}else{
if (str == "ESTADO TERMINAL DEL NIÑO/A ADOLESCENTE") {           
    document.getElementById("motivo").value = str;
    limit_days = 30;
    $("#foot_buttonAdd").css('display', 'block');
    document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos"
}  
}
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeTratamientoDiscapacidad() {
var sel = document.getElementById("tratamiento_discapacidad");
var str= sel.options[sel.selectedIndex].text;
if (str == "ATENCIÓN EN SALUD NIÑO/A ADOLESCENTE") {           
document.getElementById("motivo").value = str;
limit_days = 3;
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia"
}
//contando los dias segun los limites
countDays();
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeTratamientoAccidenteMuyGrave() {
var sel = document.getElementById("tratamiento_accidente_muy_grave");
var str= sel.options[sel.selectedIndex].text;
if (str == "ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE O SECUELA") {           
document.getElementById("motivo").value = str;
limit_days = 15;
$("#foot_buttonAdd").css('display', 'block');
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia continuos o discontinuos";
}
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeTratamientoAccidenteGrave() {
var sel = document.getElementById("tratamiento_accidente_grave");
var str= sel.options[sel.selectedIndex].text;
if (str == "ATENCIÓN EN SALUD POSTERIOR AL ACCIDENTE") {           
document.getElementById("motivo").value = str;
limit_days = 3;
document.getElementById('textoLimite').innerText = "Solo puedes tomar como maximo "+limit_days+" dias de licencia";
}
//contando los dias segun los limites
countDays();
}
//Cambiando la cantidad de dias limites a tomar
function changeTypeMotivoBaja() {
var sel = document.getElementById("tipo_baja");
var str= sel.options[sel.selectedIndex].text;   
document.getElementById("motivo").value = str;
//contando los dias segun los limites
}
//activando la fecha de inicio, una vez se
function activeDateFinish() {
if(limit_days == 1){
if(Date.parse(document.getElementsByName("dates[0][datefin]")[0].value) != Date.parse(document.getElementsByName("dates[0][dateinicio]")[0].value)){
    Swal.fire({
            title: 'Advertencia',
            text: 'No puedes pedir mas de '+limit_days+' dias de licencia!!!',
            type: 'warning',
            confirmButtonText: 'OK'
            });
            document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
            $('#numero_dias').val(0);
}
}else{
countDays();
}
}
//contando la cantidad de dias entre inicio y fin
function countDays() { 
var sel = document.getElementById("tipo_id");
var str= sel.options[sel.selectedIndex].text;
if(document.getElementsByName("dates[0][datefin]")[0].value!=''){    
if(Date.parse(document.getElementsByName("dates[0][datefin]")[0].value) >= Date.parse(document.getElementsByName("dates[0][dateinicio]")[0].value))
{
    let start = new Date(document.getElementsByName("dates[0][dateinicio]")[0].value);
    let end = new Date(document.getElementsByName("dates[0][datefin]")[0].value);
    // otherwise, the end date is excluded (error?)
    end.setDate(end.getDate() + 1);
    let interval = end.getTime() - start.getTime();
    // total days
    let days = Math.floor(interval / (1000 * 60 * 60 * 24));
    // create an iterable date period (P1D is equivalent to 1 day)
    let period = [];
    let currentDate = new Date(start);
    while (currentDate <= end) {
        period.push(new Date(currentDate));
        currentDate.setDate(currentDate.getDate() + 1);
    }
    // stored as an array, so you can add more than one holiday
    let holidays = feriados;
    for (let dt of period) {
        let curr = dt.toLocaleDateString('en-US', { weekday: 'short' });
        // check if it's Saturday or Sunday
        if (curr === 'Sat' || curr === 'Sun') {
            days--;
        } else if (holidays.includes(dt.toISOString().slice(0, 10))) {
            days--;
        }
    }
        if(days>limit_days){
            Swal.fire({
            title: 'Advertencia',
            text: 'No puedes pedir mas de '+limit_days+' dias de licencia!!!',
            type: 'warning',
            confirmButtonText: 'OK'
            });
            document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
            $('#numero_dias').val(0);
        } else{
            $('#numero_dias').val(days);
        }
}else{
    Swal.fire({
    title: 'Advertencia',
    text: 'La fecha no puede ser menor a la de inicio!!!',
    type: 'warning',
    confirmButtonText: 'OK'
    });
    document.getElementsByName("dates[0][datefin]")[0].value = document.getElementsByName("dates[0][dateinicio]")[0].value;
    $('#numero_dias').val(0);
}   
}
}
let rowCount = Math.floor(Math.random() * 10000);
// Función para agregar una nueva fila
function addRow() {
    let row = `
        <tr>
            <td><input type="date" class="form-control text-center" id="${rowCount}" name="dates[${rowCount}][dateinicio]" onchange="changeDate(id);" required></td>
            <td><input type="date" class="form-control text-center" id="${rowCount}" name="dates[${rowCount}][datefin]" onchange="changeDate(id);" required></td>
            <td>
            <select id="dates[${rowCount}][horario]" name="dates[${rowCount}][horario]" class="form-control text-center" required>
                <option value="">--   SELECCIONE   --</option>
                @foreach ($horarioLicencia as $horario)
                    <option value="{{$horario->id}}" >{{$horario->descripcion}} </option>
                @endforeach
            </select>
            </td>
            <td><button type="button" class="btn btn-danger remove-row" onclick="deleteRow(this)"><i class="bi bi-trash"></i></button></td>
            
        </tr>
    `;
    $('#invoice-details tbody').append(row);
    rowCount++;
}
function deleteRow(el) {
    $(el).closest('tr').remove();
}
function changeDate(id){
    console.log("CAmbio");
    console.log(id);
    if(document.getElementsByName(`dates[${id}][datefin]`)[0].value!="" && document.getElementsByName(`dates[${id}][dateinicio]`)[0].value!=""){
        if(Date.parse(document.getElementsByName(`dates[${id}][datefin]`)[0].value) < Date.parse(document.getElementsByName(`dates[${id}][dateinicio]`)[0].value))
        {
            Swal.fire({
            title: 'Advertencia',
            text: 'La fecha no puede ser menor a la de inicio!!!',
            type: 'warning',
            confirmButtonText: 'OK'
            });
            document.getElementsByName(`dates[${id}][datefin]`)[0].value = document.getElementsByName(`dates[${id}][dateinicio]`)[0].value;
        }
    }
}
$("#jefe_inmediato").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});