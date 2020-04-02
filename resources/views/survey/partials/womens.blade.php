<div class="table-responsive mb-4">
    <table class="table table-hover table-theme">
        <thead>
        <tr>
            <th class="cursor-link">Name <span class="name">
                    <i class="fa fa-caret-up"></i>
                    <i class="fa fa-caret-down"></i></span>
            </th>
            <th class="cursor-link">Address <span class="address">
                    <i class="fa fa-caret-up"></i>
                    <i class="fa fa-caret-down"></i></span></th>
            <th>Contact</th>
            <th>Date of Birth</th>
            <th>Surveyed Date</th>
            @if(Auth()->user()->role == 1)
                <th>Actions</th>
            @endif
        </tr>
        </thead>

        <tbody>
        @if(Auth()->user()->role == 1)
            @foreach($womens as $women)
                <tr>
                    <td>{{ $women->name }}</td>
                    <td>{{ $women->temporary_address }}</td>
                    <td>{{ $women->contact }}</td>
                    <td>{{ $women->date_of_birth }}</td>
                    <td>{{ $women->survey_date }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="/women/{{ $women->id }}" class="btn btn-outline-theme"><i
                                        class="fa fa-eye"></i></a>
                            </div>
                            <div class="col-md-3">
                                <form action="/women/{{ $women->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" onclick="return destroy()"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            @foreach($womens as $women)
                <tr class="row-clickable" data-href="/women/{{ $women->id }}">
                    <td>{{ $women->name }}</td>
                    <td>{{ $women->temporary_address }}</td>
                    <td>{{ $women->contact }}</td>
                    <td>{{ $women->date_of_birth }}</td>
                    <td>{{ $women->survey_date }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

{{ $womens->links() }}
