
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>File Personal</title>
<div class="margin-top" style="border-radius: 20px; border: solid 1px #000;">
    <div style="padding: 12px; background-image: 
         url('assets/img/escudoGobsinletrasOpacity.png');
         background-size: 500px;
         background-repeat: no-repeat;
         background-position: center;">
    <table>
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 10%;"><img src="{{asset('assets/img/escudoGobiernoAutonomo.png')}}" width="60px" alt="Image"/></td>
            <td style="width: 70%;">
                <div style="font-size: 17px; font-weight: bold; text-align:center;" >
                GOBIERNO AUTÓNOMO DEPARTAMENTAL DE LA PAZ</div> 
                <div style="font-size: 16px; font-weight: bold; text-align: center;">FILE - PERSONAL</div>
            </td>
            <td style="width: 10%;"><img src="{{asset('assets/img/escudoCondor.png')}}" width="60px" alt="Image"/></td>
            <td style="width: 5%;"></td>
        </tr>
    </table>
    <br>
    <table style="font-size: 15px;">
        <tr>
            <td><strong>DE:</strong> {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }} {{ $empleado->nombres }}</td>
        </tr>
        <tr>
            <td><strong>FECHA INGRESO:</strong> {{ date('d-m-Y',strtotime($empleado->cargo[0]->pivot->fecha_inicio ))}}</td>
        </tr>
    </table>
    <hr class="hr">
    <div style="font-size: 15px; font-weight: bold; ">1. DOCUMENTACION PERSONAL</div>

    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Hoja de vida(curricular vitae) documentado</li></td>
            <td style="width: 20%;">@if($documentacion->hoja_vida != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"><li>Fotografía 4x4 Fondo Blanco</li></td>
            <td style="width: 20%;">@if($documentacion->foto != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"><li>Fotocopia Carnet Identidad</li></td>
            <td style="width: 20%;">@if($documentacion->fotocopia_carnet_identidad != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"><li>Fotocopia Certificado Nacimiento</li></td>
            <td style="width: 20%;">@if($documentacion->fotocopia_certificado_nacimiento == 'si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"><li>Fotocopia Servicio Militar(varones)</li></td>
            <td style="width: 20%;">@if($documentacion->fotocopia_servicio_militar =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <div style="font-size: 15px; font-weight: bold; ">2. DOCUMENTACION COMPLEMENTARIA</div>

    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Certificado Aymara</li></td>
            <td style="width: 20%;">@if($documentacion->certificado_aymara != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Certificado 1178 Ley Safcoo</li></td>
            <td style="width: 20%;">@if($documentacion->certificado_ley_safco =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario Segip</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_segip =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Cuenta Banco Union</li></td>
            <td style="width: 20%;">@if($documentacion->cuenta_banco_union =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>GESTORA O NUA(si corresponde)</li></td>
            <td style="width: 20%;">@if($documentacion->gestora =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario Seguro AVC-04</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_seguro_avc_04 != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario Baja Seguro AVC-07</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_baja_seguro =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Ciudadanía Digital</li></td>
            <td style="width: 20%;">@if($documentacion->ciudadania_digital =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario Incompatibilidad</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_incompatibilidad =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Certificado de Prevencion de la Violencia</li></td>
            <td style="width: 20%;">@if($documentacion->certificacion_prevencion_violencia =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <div style="font-size: 15px; font-weight: bold; ">3. DOCUMENTACION INSTITUCIONAL PERSONAL</div>

    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Memorándum Designación</li></td>
            <td style="width: 20%;">@if($documentacion->memorandum_designacion != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Otros memorándums que conciernen al Servicio Público</li></td>
            <td style="width: 20%;">@if($documentacion->memorandum_servidor_publico =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Memorándum (Destitución o Retiro)</li></td>
            <td style="width: 20%;">@if($documentacion->memorandum_destitucion =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <div style="font-size: 15px; font-weight: bold; ">4. DOCUMENTACION INSTITUCIONAL</div>

    <table style="font-size: 14px; font-weight: bold;">
       
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario de declaración de incompatibilidades de doble percepción</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_incompatibilidad_percepcion =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario de declaración de incompatibilidades</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_declaracion_incompatibilidades =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Formulario de inducción</li></td>
            <td style="width: 20%;">@if($documentacion->formulario_induccion =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Certificado de SIPASSE y REJAP</li></td>
            <td style="width: 20%;">@if($documentacion->certificado_sipasse_rejap =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Calificación de años de servicio</li></td>
            <td style="width: 20%;">@if($documentacion->cas != null) SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <div style="font-size: 15px; font-weight: bold; ">5. VACACIONES Y LICENCIAS</div>
    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Licencias</li></td>
            <td style="width: 20%;">@if($documentacion->licencias =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Vacaciones</li></td>
            <td style="width: 20%;">@if($documentacion->vacaciones =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 70%;"> <li>Lactancia</li></td>
            <td style="width: 20%;">@if($documentacion->lactancia =='si') SI @else NO @endif</td>
        </tr>
    </table>


    </div>
    
</div>