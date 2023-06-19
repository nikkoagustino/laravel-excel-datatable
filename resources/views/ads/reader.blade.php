@extends('template')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-2" id="file_tree">
            <a class="btn btn-sm btn-danger mt-3" href="{{ url('logout') }}">
                <i class="fa-solid fa-lock"></i> Logout
            </a>
            <ul class="mt-3">
            @foreach ($file_tree as $dir => $files)
                <li>
                    {{ str_replace('data/', '', $dir) }}
                    <ul>
                        @foreach ($files as $file)
                        <li><a href="{{ url('read-excel') }}?file_dir={{ $dir.'/'.$file }}">{{ $file }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            </ul>
        </div>

        <div class="col-10 p-3">
            <table class="table table-striped datatable">
                @if ($contents)
                <thead>
                    <tr>
                        @foreach ($contents[1] as $index => $value)
                        <th>{{ $value }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $row_index => $rows)
                    <?php if ($row_index == 1) continue; ?> 
                    <tr>
                        @foreach ($rows as $index => $value)
                        <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection