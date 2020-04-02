<div class="table-responsive mb-4">
    <table class="table table-hover table-theme table-events-records">
        <thead>
        <tr>
            <th class="cursor-link">Name
                <span class="name">
                    <i class="fa fa-caret-up"></i>
                    <i class="fa fa-caret-down"></i>
                </span>
            </th>
            <th class="cursor-link">Place
                <span class="place">
                    <i class="fa fa-caret-up"></i>
                    <i class="fa fa-caret-down"></i>
                </span>
            </th>
            <th>Number of Participants</th>
            <th>Date</th>
            @if(Auth()->user()->role == 1)
                <th>Actions</th>
            @endif
        </tr>
        </thead>

        <tbody>
        @foreach($events as $event)
            @if(Auth()->user()->role == 1)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->place }}</td>
                    <td>{{ $event->participants->count() }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="/event/{{ $event->id }}" class="btn btn-outline-theme"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                            <div class="col-md-3">
                                <form action="/event/{{ $event->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" onclick="return destroy()"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @else
                <tr class="row-clickable" data-href="/event/{{ $event->id }}">
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->place }}</td>
                    <td>{{ $event->participants->count() }}</td>
                    <td>{{ $event->date }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
{{ $events->links() }}
