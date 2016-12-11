/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.0
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-default').dataTable({
			"language": {
				"lengthMenu": " _MENU_ ",
				"zeroRecords": "Nenhum registro disponivel",
				"info": "Mostrando Pagina _PAGE_ of _PAGES_",
				"infoEmpty": "Nenhum registro disponível",
				"infoFiltered": "(filtrado de  _MAX_ registros totais)"
			}
		});

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);