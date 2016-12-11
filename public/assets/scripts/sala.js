/**
 * Created by wilson on 23/10/16.
 */
$(document).ready(function () {
    'use strict';

    $('.modal-basic').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true
    });

    /*
     Modal Dismiss
     */
    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

    $("#salvar").click(function (e) {
        var numSala  = $('#nom_sala').val();
        var qtdassento = $("#qtd_assentos").val();

        var route = "{{route('sala.create')}}";
        // var route = " http://localhost:8000/sala/store";
        var dados = ["nom_sala="+numSala , "qtd_assentos="+qtdassento];
        var token = $('#token').val();
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'POST',
            dataType:'json',
            data:dados,
            success:function () {
                if(data.success == 'true'){
                    alert('Cadastro OK')
                }
            },
            error:function (data) {
                // $("error").html("Error);
                $("message-error").fadeIn();
            }
        });

    });

});



    /*
     Modal Confirm
     */
    // $(document).on('click', '.modal-confirm', function (e) {
    //     e.preventDefault();
    //     $.magnificPopup.close();
    //
    //     new PNotify({
    //         title: 'Success!',
    //         text: 'Modal Confirm Message.',
    //         type: 'success'
    //     });
    // });
