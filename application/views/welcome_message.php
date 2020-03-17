
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='<?=base_url()?>packages/core/main.css' rel='stylesheet' />
    <link href='<?=base_url()?>packages/daygrid/main.css' rel='stylesheet' />
    <link href='<?=base_url()?>packages/timegrid/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
<button id="llenar" class="btn btn-success"> <i class="fa fa-save"></i> llenar</button>
<button id="insert" class="btn btn-info"> <i class="fa fa-plus"></i> Insert</button>
<button id="insert2" class="btn btn-info"> <i class="fa fa-plus"></i> Insert</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="guardar">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="title" placeholder="title" value="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto" class="col-sm-2 col-form-label">monto</label>
                        <div class="col-sm-10">
<!--                            <input class="form-control" type="text" id="monto" placeholder="monto" value="monto">-->
                            <select name="monto" id="monto" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                <button type="submit" class="btn btn-success" > <i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label for="title2" class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="title2" placeholder="title">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                <button type="button" class="btn btn-warning" > <i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<div id='calendar'></div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src='<?=base_url()?>packages/core/main.js'></script>
<script src='<?=base_url()?>packages/interaction/main.js'></script>
<script src='<?=base_url()?>packages/daygrid/main.js'></script>
<script src='<?=base_url()?>packages/timegrid/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var star;
        var end;
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            defaultView:'timeGridWeek',
            // defaultDate: '2020-02-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            // selectMirror: true,
            select: function(arg) {
                // var title = prompt('Event Title:');
                // if (title) {
                //     calendar.addEvent({
                //         title: title,
                //         start: arg.start,
                //         end: arg.end,
                //         allDay: arg.allDay
                //     })
                // }
                // calendar.unselect()
                $('#exampleModal').modal('show');
                start= moment(arg.start).format('YYYY-MM-DD HH:mm:ss');
                end= moment(arg.end).format('YYYY-MM-DD HH:mm:ss');
                // console.log(start,end);
                // console.log(day);
                // console.log(moment(end).format('YYYY-MM-DD hh:mm:ss'));
            },
            eventClick: function(info) {
                $('#modificar').modal('show');
                // alert('Event: ' + info.event.title);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.view.type);
                //
                // // change the border color just for fun
                // info.el.style.borderColor = 'red';
            }
            // editable: true,
            // eventLimit: true,  // allow "more" link when too many events
            // events: 'http://localhost/calendario/welcome/events'
        });
        calendar.render();
        $('#insert').click(function (e) {
            calendar.addEvent( {
                id:8,
                title: 'algo',
                start: '2020-03-12 08:30:00',
                end: '2020-03-12 09:30:00',
                // allDay: arg.allDay
            })
        });
        $('#insert2').click(function (e) {
            calendar.addEvent( {
                id:7,
                title: 'algo',
                start: '2020-03-13 08:30:00',
                end: '2020-03-13 09:30:00',
                // allDay: arg.allDay
            })
        });
        llenar();

        async function llenar(){
            var eventSources = calendar.getEvents();
            var len = eventSources.length;
             for  (var i = 0; i < len; i++) {
                 await eventSources[i].remove();
                // console.log(eventSources[i].id)
            }
            await $.ajax({
                url:'Welcome/events',
                success:function (e) {
                    let datos=JSON.parse(e);
                    datos.forEach(e=>{
                        // console.log(e);
                        calendar.addEvent( {
                            id:e.id,
                            title: e.title,
                            start: e.start,
                            end: e.end,
                        })
                    })
                }
            });
        }
        $('#llenar').click(function (e) {

            // var event = calendar.getEventById('1') // an event object!
            // event.remove();
            // // var start = event.start // a property (a Date object)
            // console.log(start.toISOString()) // "2018-09-01T00:00:00.000Z"
            // return false;
            // e.preventDefault;
            var eventSources = calendar.getEvents();
            // console.log(eventSources.length);
            // return false;
            // return false;
            var len = eventSources.length;
            for (var i = 0; i < len; i++) {
                eventSources[i].remove();
                // console.log(eventSources[i].id)
            }
            // return false;
            $.ajax({
                url:'Welcome/events',
                success:function (e) {
                    let datos=JSON.parse(e);
                    datos.forEach(e=>{
                        // console.log(e);
                        calendar.addEvent( {
                            id:e.id,
                            title: e.title,
                            start: e.start,
                            end: e.end,
                            // allDay: arg.allDay
                        })
                    })
                }
            });
        });
        $('#guardar').submit( async function (e) {
            console.log('a');
            // e.preventDefault;
            dat={
                title:$('#title').val(),
                start:start,
                end:end,
                idusuario:1,
                monto:$('#monto').val(),
            };
            await $.ajax({
                url:'Welcome/insert',
                data:dat,
                method:'post',
                success:function(e){
                    console.log(e);
                }
            });
            await llenar();
            $('#exampleModal').modal('hide');
            return false;
        });
    });

</script>
</body>
</html>
