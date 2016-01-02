@extends('layouts.layoutuser')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
<ul class="timeline">
    {{-- timeline time label --}}
    @foreach ($diagnosticos as $diagnostico)
    <li class="time-label">
        <span class="bg-red">
            {{ $diagnostico->created_at->format('d-m-Y') }}
        </span>
    </li>
    {{-- /.timeline-label --}}
    {{-- timeline item --}}
    <li>
        {{-- timeline icon --}}
        <i class="fa fa-pencil bg-blue"></i>
        <div class="timeline-item">
            <span class="time">
                <i class="fa fa-clock-o"></i>
                {{ $diagnostico->created_at->format('H:i') }}
            </span>
            <h3 class="timeline-header">
                <a href="#">Se diagnosticó {{ $diagnostico->disease->name }}</a>
            </h3>
        </div>
    </li>
    @endforeach
    {{-- END timeline item --}}
</ul>
@stop
