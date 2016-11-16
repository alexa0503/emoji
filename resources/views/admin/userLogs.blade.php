@foreach($logs as $log)
    <li>
        <p>
            <a href="#">{{ $log->user->name }}</a> {{ $log->operation }}</a>
            <span class="timeline-icon"><i class="fa fa-file-text-o"></i></span>
            <span class="timeline-date">{{ $log->create_time }}</span>
        </p>
    </li>
@endforeach