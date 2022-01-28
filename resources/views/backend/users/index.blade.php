@extends('backend.layouts.parent')

@section('title', 'Subcategories')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        @include('backend.includes.message')
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                     @foreach ($properties as $property)
                        <th>{{$property}}</th>
                    @endforeach


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td class="
                            @php
                            {{
                            if($user->status == 0)
                                echo 'text-warning';
                            elseif($user->status==1)  
                                echo 'text-success';
                            else
                                echo 'text-danger';
                            }}
                            @endphp
                            ">
                            @php
                            {{
                            if($user->status == 0)
                                echo 'Not Verified';
                            elseif($user->status==1)  
                                echo 'Verified';
                            else
                                echo 'Blocked';
                            }}
                            @endphp
                        </td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning  btn-sm">Edit</a>
                                <form action="{{route('users.destroy',$user->id)}}" method="get" class="d-inline">
                                    @csrf
                                    <button class=" btn btn-danger btn-sm"> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
