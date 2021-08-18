<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Crear nueva carrera</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Datos</strong><br><br>
                    Conductor: {{ $driver->user->getFullName() }} <br>
                    Turno: {{ $driver_shift->shift->name }}<br>
                    Movil: {{ $driver_shift->mobile->mobile }}-{{ $driver_shift->mobile->patent }}
                </p>
                <hr>
                <form class="" role="form" id="driver-race-form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hora de Inicio</label>
                                <div class="row">
                                    <div class="col-5">
                                        <select name="start_time_hour" class="form-control">
                                            <option value="" disabled selected="">Seleccione...</option>
                                            @for($i=0;$i<25;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <center>:</center>
                                    </div>
                                    <div class="col-5">
                                        <select name="start_time_minutes" class="form-control">
                                            @for($i=0;$i<61;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hora de Termino</label>
                                <div class="row">
                                    <div class="col-5">
                                        <select name="end_time_hour" class="form-control">
                                            <option value="" disabled selected="">Seleccione...</option>
                                            @for($i=0;$i<25;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <center>:</center>
                                    </div>
                                    <div class="col-5">
                                        <select name="end_time_minutes" class="form-control">
                                            @for($i=0;$i<61;$i++)
                                                <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Origen</label>
                                <select name="from_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->destination }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Ingreso Manual</label>
                                <input type="text" name="from_text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Destino</label>
                                <select name="to_id" class="form-control">
                                    <option value="" disabled selected="">Seleccione...</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->destination }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Ingreso Manual</label>
                                <input type="text" name="to_text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-label">Pasajeros ( solicitante ) </label>
                                <input type="text" name="passengers" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Cantidad </label>
                                <select name="passengers_count" class="form-control">
                                    @for($i=0;$i<5;$i++)
                                        <option value="{{ numberWithLeadZero($i) }}">{{ numberWithLeadZero($i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">KM Inicio</label>
                                <input type="text" name="start_mileage" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">KM Termino</label>
                                <input type="text" name="end_mileage" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Observaciones del viaje(opcional)</label>
                                <textarea type="text" name="observations" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
{!! makeValidation('#driver-race-form','/addRace/'.$driver->id,'location.reload()') !!}
