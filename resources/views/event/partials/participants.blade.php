<div class="table-responsive mb-4">
    <table class="table table-hover table-theme table-events-records">
        <thead>
        <tr>
            <th class="cursor-link">Name
                <span>
                    <i class="fa fa-caret-up"></i>
                    <i class="fa fa-caret-down"></i>
                </span>
            </th>
            <th>Id</th>
            <th>Sex</th>
            <th>Contact</th>
        </tr>
        </thead>
        <tbody>
        @foreach($participants as $participant)
            <tr id="table_data">
                <td>
                    <img src="{{ $participant->photo }}" class="event-thumbnail">
                    {{ $participant->name }}
                </td>
                <td>{{ $participant->id }}</td>
                <td>{{ $participant->sex }}</td>
                <td>{{ $participant->contact }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $participants->links() }}
