$(document).ready(function(){
    $("#btnNuevaOpcion").click(function(){
        $("#divOpcionRespuesta").removeClass("has-error");
        $("#divOpcionRespuesta .help-block").text("");

        if ($("#opcion_respuesta").val() == "") {
            $("#divOpcionRespuesta").addClass("has-error");
            $("#divOpcionRespuesta .help-block").text("La opción no puede estar vacía.");
            return false;
        }

        $.ajax({
            type: "POST",
            url: urlOpcionRespuestaCreate,
            data: {"_csrf": $("[name=_csrf]").val(),
                   "OpcionRespuesta": {"descripcion": $("#opcion_respuesta").val(), "comentario": $("#comentario").val()}
                },
            success: function(data){
                tr = $('<tr><td align="center">'+
                        '<input type="checkbox" class="opcionRespuesta" data-texto="'+data.message.descripcion+
                            '" value="'+data.message.id_opcion_respuesta+'" /></td>'+
                        '<td>'+data.message.descripcion+'</td></tr>');
                $(tr).hide().appendTo("#tbl_opciones_respuesta tbody").fadeIn();
                $("#opcion_respuesta").val("");
                $("#comentario").val("");
                $("#dialogNuevaOpcion").modal("hide");
            },
            dataType: "json"
        }).fail(function(data){
            $("#divOpcionRespuesta").addClass("has-error");
            $("#divOpcionRespuesta .help-block").text('Error al procesar el dato');
        });
    });

    $("#btnAsignarOpciones").click(function(){
        $("#dialogAgregarOpciones").modal("hide");

        opcionesSeleccionadas = $("#tbl_opciones_respuesta tbody .opcionRespuesta:checked");
        filasOpciones = "";

        $(opcionesSeleccionadas).each(function(index, element){
            filasOpciones += '<tr><td>'+
                '<input type="hidden" name="OpcionPregunta[fk_opcion_respuesta][]" value="'+$(this).val()+'" />'+$(this).data('texto')+'</td>'+
                '<td align="center"><input type="radio" name="OpcionPregunta[es_opcion_ideal][]" value="'+$(this).val()+'" /></td>'+
                '<td align="center"><input type="text" name="OpcionPregunta[valor_ideal][]" "class"="form-control" /></td></tr>';
        });

        $("#tbl_asignacion_opciones tbody").html("");
        $(filasOpciones).hide().appendTo("#tbl_asignacion_opciones tbody").fadeIn(800);
    });
});