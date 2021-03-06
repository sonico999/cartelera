@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div id="tablecontainer" class="jtable"></div>
    </div>
    <div class="col-md-3 ultimas_mod"></div>
    <div id="leyenda"></div>
</div>
<script type="application/javascript">

    $(document).ready(function () {

        $("#tablecontainer").jtable({
            title: "Lista de Facultades",
            paging: true,
            sorting: true,
            actions: {
                listAction: "facultades/list"
            },
            messages: {
                addNewRecord: 'Nueva Facultad',
                editRecord: 'Editar Facultad'
            },
            toolbar: {
                items: [{
                    cssClass: 'buscador',
                    text: buscador
                }]
            },
            fields: {
                CodigoFacultad: {
                    key: true,
                    title: 'Código ',
                    width: '5%'
                },
                DescripcionFacultad: {
                    title: 'Facultad ',
                    width: '28%'
                },
                DescripcionFacultadIngles: {
                    title: 'Facultad en Ingles',
                    width: '20%'
                },
                Decano: {
                    title: 'Decano ',
                    width: '37%'
                },
                Abreviatura: {
                    title: 'Abreviatura',
                    width: '10%'
                }
            }
        });

        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#tablecontainer').jtable('load', {
                search: $('#search').val()
            });
        });
        $('#LoadRecordsButton').click();
    });

</script>
@overwrite