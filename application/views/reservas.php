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
                <form  id="formInsert">
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
                            <select name="monto" id="monto" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-minus-circle"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success" > <i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
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
                <form action="" id="update">
                    <div class="form-group row">
                        <label for="title2" class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="title2" placeholder="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto2" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-10">
                            <select name="monto2" id="monto2" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="eliminar" > <i class="fa fa-trash"></i> Eliminar</button>
                        <button type="submit" class="btn btn-warning" > <i class="fa fa-pencil-alt"></i> Modificar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div id='calendar'></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var socket = io('http://localhost:3000/');

        // $('form').submit(function(e){
        //     e.preventDefault(); // prevents page reloading
        //     socket.emit('chat message', $('#m').val());
        //     $('#m').val('');
        //     return false;
        // });

        socket.on('chat message', function(msg){
            // $('#messages').append($('<li>').text(msg));
            // console.log(msg)
            llenar();
        });

        var star;
        var carrera='<?=$_SESSION['carrera']?>';
        var end;
        var id;
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'es',
            defaultView:'timeGridWeek',
            // defaultDate: '2020-02-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            // events: [{
            //     title: 'Meeting',
            //     start: '2020-03-13T11:00:00',
            //     // constraint: 'availableForMeeting', // defined below
            //     color: '#257e4a'
            // }],
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

                if (moment().format('YYYY-MM-DD')>moment(arg.start).format('YYYY-MM-DD')){
                    alert('no puedes selccionar fechas antiguas')
                }else{
                    $('#exampleModal').modal('show');
                    start= moment(arg.start).format('YYYY-MM-DD HH:mm:ss');
                    end= moment(arg.end).format('YYYY-MM-DD HH:mm:ss');

                }
                // console.log(start,end);
                // console.log(day);
                // console.log(moment(end).format('YYYY-MM-DD hh:mm:ss'));
            },
            eventClick: function(info) {
                // $('#tex').append(info);
                if(info.event.extendedProps.carrera==carrera){
                    $('#modificar').modal('show');
                    $('#title2').val(info.event.extendedProps.titulo);
                    $('#monto2').val(parseInt(info.event.extendedProps.monto));
                    // console.log(parseInt(info.event.extendedProps.monto));
                    // console.log(info.event.id);
                    id=info.event.id;
                }else{
                    alert("No Pudes modificar de otras carreras");
                }

                // alert('Event: ' + info.event.carrera);
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
                    let color;

                    datos.forEach(e=>{
                        // console.log(e);
                        if (e.carrera=='SIS') color='#004ba0';
                        if (e.carrera=='GEO') color='#8c0032';
                        if (e.carrera=='ELE') color='#bb4d00';
                        calendar.addEvent( {
                            id:e.id,
                            title: e.title+' '+' '+e.carrera,
                            start: e.start,
                            end: e.end,
                            color: color,
                            textColor:'#fff',
                            carrera:e.carrera,
                            titulo:e.title,
                            monto:e.monto,
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
        $("#formInsert").submit(  function(e){
            dat={
                title:$('#title').val(),
                start:start,
                end:end,
                idusuario:1,
                monto:$('#monto').val(),
            };
            // console.log(dat);
             $.ajax({
                url:'Welcome/insert',
                data:dat,
                method:'post',
                success:function(e){
                    // console.log(e);
                    // llenar();
                    socket.emit('chat message', 'holas como estan');
                }
            });
            $('#exampleModal').modal('hide');
            return false;
             // return false;
        });
        $("#update").submit(  function(e){
            dat={
                title:$('#title2').val(),
                monto:$('#monto2').val(),
            };
            // console.log(dat);
            $.ajax({
                url:'Welcome/update/'+id,
                data:dat,
                method:'post',
                success:function(e){
                    // console.log(e);
                    // llenar();
                    socket.emit('chat message', 'holas como estan');
                    $('#modificar').modal('hide');
                }
            });

            return false;
            // return false;
        });
        $('#eliminar').click(function (e) {
            e.preventDefault();
            if (confirm("Srguro de eliminar?")){
                $.ajax({
                    url:'Welcome/delete/'+id,
                    success:function(e){
                        // llenar();
                        socket.emit('chat message', 'holas como estan');
                        $('#modificar').modal('hide');
                    }
                });
            }
        });
        $('#formInsert2').submit( async function (e) {
            console.log('a');
            // e.preventDefault;
            return false;
            // dat={
            //     title:$('#title').val(),
            //     start:start,
            //     end:end,
            //     idusuario:1,
            //     monto:$('#monto').val(),
            // };
            // await $.ajax({
            //     url:'Welcome/insert',
            //     data:dat,
            //     method:'post',
            //     success:function(e){
            //         console.log(e);
            //     }
            // });
            // await llenar();
            // $('#exampleModal').modal('hide');
            // return false;
        });
    });

</script>
